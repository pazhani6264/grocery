<style>

.outer-area{
    background-color: #fff;
    padding: 15px 0 0 0;
}

.catgeory-header-outer {
    background: #fff;
    border-bottom: 1px solid rgba(0,0,0,.05);
    padding: 0 1.25rem;
    padding-bottom: 15px;
}
.catgeory-header-title
{
    font-size: 1rem;
    color: rgb(0 0 0 / 80%);
    font-weight: 500;
    text-transform: uppercase;
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-right: 1.25rem;
}

.home-category-list-outer {
    text-decoration: none;
    color: rgba(0,0,0,.87);
    display: block;
    width: 100%;
    box-sizing: border-box;
}
.home-category-list-grid:hover {
    transform: translateZ(0);
    z-index: 1;
    border-color: rgba(0,0,0,.12);
    box-shadow: 0 0 0.8125rem 0 rgb(0 0 0 / 5%);
}

.home-category-list-grid {
    text-decoration: none;
    color: rgba(0,0,0,.87);
    border-right: 1px solid rgba(0,0,0,.05);
    border-bottom: 1px solid rgba(0,0,0,.05);
    text-align: center;
    background-color: #fff;
    display: block;
    position: relative;
    transition: transform .1s cubic-bezier(.4,0,.6,1),box-shadow .1s cubic-bezier(.4,0,.6,1);
}
.home-category-list-grid:before {
    content: "";
    display: block;
    padding-top: 126%;
}

.home-category-image-outer {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.home-category-image-inner {
    flex-shrink: 1;
    width: 70%;
    height: 70%;
    margin-top: 10%;
}
.home-category-image-inner2 {
    height: 100%;
}
.home-category-image-inner1 {
    position: relative;
}
.home-category-image-inner3 {
    opacity: 1;
    transition: opacity .2s ease;
}
.home-category-name-outer {
    width: 90%;
    height: 3.125rem;
    text-align: center;
}
.home-category-name {
    color: rgba(0,0,0,.8);
    font-size: .875rem;
    text-decoration: none;
    line-height: 1.25rem;
    height: 2.5rem;
    margin-bottom: 0.625rem;
    word-break: break-word;
    overflow: hidden;
    display: -webkit-box;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}

.categories-content2 .slider-next
{
    width: 25px;
    height: 25px;
    line-height: 20px;
    margin-top: -3.5px;
    background-color: #fff !important;
    right: -12.5px;
    top: 50%;
    border-radius: 50%;
    padding: 0px 9px;
    z-index: 100;
}
.categories-content2 .slick-slide {
    outline: none;
    padding: 0 !important; 
}

.categories-content2 .slider-prev:before, .categories-content2 .slider-next:before {
    font-size: 20px;
    line-height: 1;
    opacity: .75;
    color: black;
   
}
.categories-content2 .slider-prev
{
    width: 25px;
    height: 25px;
    line-height: 21px;
    margin-top: -3.5px;
    background-color: #fff !important;
    left:-12.5px;
    top: 50%;
    border-radius: 50%;
    padding: 0px 6px;
    z-index: 100;
}
 .categories-content2:hover .slider-next{
    top: 50%;
    width: 50px;
    height: 50px;
    font-size: 13px;
    border-radius: 50%;
    margin-top: -4px;
    right: -25px;
    box-shadow: 0 1px 12px 0 rgb(0 0 0 / 12%);
    line-height: 70px;
    padding: 0 19px;
} 

.categories-content2:hover .slider-prev{
    top: 50%;
    width: 50px;
    height: 50px;
    font-size: 13px;
    border-radius: 50%;
    margin-top: -4px;
    left : -25px;
    box-shadow: 0 1px 12px 0 rgb(0 0 0 / 12%);
    line-height: 70px;
    padding: 0 16px;
    
} 
.categories-content2:hover .slider-next:before{
    font-size: 35px !important;
    font-weight: 600;
} 
.categories-content2:hover .slider-prev:before
{
    font-size: 35px !important;
    font-weight: 600;
} 
.categories-content2 .slick-slide div {
    margin-bottom: -2.75px;
}


@media only screen and (max-width: 1024px)
{

    .categories-content2:hover .slider-next{
        width: 25px;
    height: 25px;
    line-height: 20px;
    margin-top: -3.5px;
    background-color: #fff !important;
    right: -12.5px;
    top: 50%;
    border-radius: 50%;
    padding: 3px 9px;
    box-shadow: unset;
} 

.categories-content2:hover .slider-prev{
    width: 25px;
    height: 25px;
    line-height: 21px;
    margin-top: -3.5px;
    background-color: #fff !important;
    left:-12.5px;
    top: 50%;
    border-radius: 50%;
    padding: 3px 6px;
    z-index: 100;
    box-shadow: unset;
    
} 
.categories-content2:hover .slider-next:before{
    font-size: 20px !important;
} 
.categories-content2:hover .slider-prev:before
{
    font-size: 20px !important;
} 
 
}

@media only screen and (max-width: 680px)
{
    .catgeory-header-outer {
    border-bottom: none;
}
.home-category-list-grid {
    border-right: none;
    border-bottom: none;
}
.categories-content2 .home-category-list-outer {
    min-height: 100px;
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




<div id="getcategory2_loading"></div>

  <div id="getcategory2_product"></div>

  <script>
    getallproductBycategory2();
    function getallproductBycategory2() {
      var type = 'category_section'
      var content ='';

      content +='<section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory2_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory2")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcategory2_loading').html(' ');
              jQuery('#getcategory2_product').html(res);
              getquerycat();
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

function getquerycat(){
jQuery(document).ready(function () {
    (function (jQuery) {
    var tabCarousel = jQuery('.cat2-carousel-js');

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
         prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
          slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}},
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
			
            settings: {
              slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
              slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}}
            }
          }, {
            breakpoint: 992,
            settings: {
				
              slidesToShow: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}},
              slidesToScroll: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}}
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
