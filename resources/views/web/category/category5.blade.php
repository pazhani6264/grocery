

  <style>
    .demo-34-cat-btn-nn span:hover
    {
      border-bottom: solid 1px !important;
    }
    .demo-34-cat-btn-nn span
    {
      border-bottom: 1px solid transparent !important;
    }
    .demo-34-cat-btn-nn:hover
    {
      color: #d33e3e !important;
    }
    .demo-34-cat-btn-nn
    {
      
      display: inline-block;
      text-transform: initial;
      font-size: 15px;
      width: 100%;
    text-align: left;
    color: #2f4787 !important;
    min-width: auto;
    padding-left: 0;
    padding-right: 0;
    font-weight: 400;

    }

    
    .demo-34-cat-btn-nn i {
    margin-left: 0;
    font-size: 15px;
    margin-right: 15px;
}
    .demo-34-pt-5
    {
      padding-top: 55px;
    }
    .demo-34-s-cat-sec-content
    {
        overflow: hidden;
    }
    .demo-34-s-cat-sec-content .slick-slide {
        outline: none;
        padding: 0px !important;
        margin-right: 20px !important;
    }
    .demo-34-s-cat-content {
    padding: 20px 20px;
}
.demo-34-s-cat-list {
    margin-bottom: 5px;
    font-size: 15px;
    line-height: 1.6;
    color: #666;
}
.demo-34-s-cat-list a:before {
    position: absolute;
    font-family: Font Awesome\ 5 Free;
    content: "";
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    left: 0;
    font-weight: 600;
    font-size: 12px;
}
.demo-34-s-cat-list a {
    display: block;
    position: relative;
    padding-left: 15px;
    text-align: left;
    font-size: 15px;
    color: inherit;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.btn.btn-cat-link {
    min-width: auto;
    padding-left: 0;
    padding-right: 0;
    font-weight: 400;
    font-size: 15px;
    color: #2f4787;
    border-bottom: 1px solid transparent;
}
.btn.btn-cat-link i {
    margin-left: 0;
    font-size: 15px;
    margin-right: 15px;
}
.font-weight-bolder a {
    font-weight: 600!important;
}
.demo-34-s-cat-content .demo-34-s-cat-title {
    margin-bottom: 20px;
    font-size: 18px;
    text-align: left;
    color: #222;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
    .demo-34-s-cat-con-pad
    {
      padding-left: 10px !important;
    padding-right: 10px !important;
    }
    .demo-34-s-cat-title
    {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 0px;
    }
    .demo-34-s-cat-p{
    width: 100%;
    font-size: 15px;
    color: #999 !important;
    letter-spacing: .01em;
    margin-bottom: 30px !important;
}
    .demo-34-s-slick  .slick-dots .slick-active button
{
   width: 18px !important;
   -webkit-transition: all .3s ease;
    transition: all .3s ease;
}

.demo-34-s-slick  .slick-dots li button {
    font-size: 0;
    line-height: 0;
    display: block;
    width: 8px !important;
    height: 8px !important;
    padding: 0px;
    cursor: pointer;
    color: transparent;
    border: 0;
    outline: none;
    background: transparent;
    border-radius: 20px;
    margin: 5px 6px;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
}
.demo-34-s-slick .slick-dots li button::after {
    content: unset;
}
.demo-34-s-slick  .slick-dots li {
    position: relative;
    display: inline-block;
    width: auto;
    height: auto;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
   
}
.demo-34-s-cat-content .btn.btn-cat-link
{
    width: 100%;
    text-align: left;
}
.demo-34-s-cat-lazy-overlay {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: #f4f4f4;
}
.demo-34-s-cat-bg-transparent {
    background-color: transparent!important;
}
.demo-34-s-cat-block:hover {
    -webkit-box-shadow: 0 5px 8px 0 rgb(0 0 0 / 15%);
    box-shadow: 0 5px 8px 0 rgb(0 0 0 / 15%);
}
.demo-34-s-cat-block figure {
    position: relative;
    padding: 15px 0;
    height: 170px;
}
.demo-34-s-cat-block figure img {
   object-fit: contain;
}
.demo-34-s-cat-block {
    background-color: #fff;
    border-radius: 0.4rem;
    -webkit-box-shadow: 0 5px 8px 0 rgb(0 0 0 / 5%);
    box-shadow: 0 5px 8px 0 rgb(0 0 0 / 5%);
    border: 2px solid transparent;
    -webkit-transition: border-color .35s,-webkit-box-shadow .35s;
    transition: border-color .35s,-webkit-box-shadow .35s;
    transition: box-shadow .35s,border-color .35s;
    transition: box-shadow .35s,border-color .35s,-webkit-box-shadow .35s;
    height: 365px;
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
  </style>




<div id="getcategory5_loading"></div>

  <div id="getcategory5_product"></div>

  <script>
    getallproductBycategory5();
    function getallproductBycategory5() {
      var type = 'category_section'
      var content ='';

      content +='<section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory1_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory5")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcategory5_loading').html(' ');
              jQuery('#getcategory5_product').html(res);
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
