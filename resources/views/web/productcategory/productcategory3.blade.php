
<style>

.pcate3 .pbc-2-header1 {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      padding: 0px 0px !important;
      border-bottom: .1rem solid #ebebeb;
      width:98%;
      margin:auto;
  }

  #getcategory3_section_product .btntabtrend {
    color: #ccc;
    padding: 10px;
    text-decoration: none;
    margin: 0px 5px;
    display: inline-block;
    cursor: pointer;
    font-size: 1rem;
    text-transform: uppercase;
    font-weight: 600;
}

.demo-13-active
{
  border-bottom: solid 1px;
}

/* .col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1
{
  padding-left:10px;
  padding-right:10px;
} */
.pbc-2-title{
  font-size:24px;
  font-weight:600 !important;
}
.product-based-cat-2 .pbc-2-header {
margin-bottom: 5px;
display: flex;
align-items: center;
}

.title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>
}

.btntab {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}


.Cate{
  margin-bottom:10px;
}
.spacer {
  clear: both;
  height: 20px;
}


.pcate3 .slick-disabled {
    display: block !important;
}

.pcate3 .slick-next {
    right: -30px;
    width:25px !important;
  }

.pcate3 .slick-next:hover, .pcate3 .slick-next:focus {
  background:transparent !important;
}


.pcate3  .slick-next:before {
    content: '\203A';
    font-size:4rem;
}


 .pcate3 .slick-prev {
    left: -30px !important;
    width:25px !important;
    z-index:9;
  }

.pcate3 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.pcate3 .slick-prev:hover, .pcate3 .slick-prev:focus {
  background:transparent !important;
}


.pcate3 .slick-prev:before {
    content: '\2039';
    font-size:4rem;
} 

.pcate3 .slick-slide {
    outline: none;
    padding: 10px !important;
}
   

.pcate3 .slick-next:before {
    font-family: 'slick';
    line-height: 1;
    opacity: .75;
    color: #999;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.pcate3 .slick-prev:before, .pcate3 .slick-next:before {
    font-family: 'slick';
    line-height: 1;
    opacity: .75;
    color: #999;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.pcate3.active{
  border-bottom: 1px solid #9ACE69;
    color: #9ACE69 !important;
}
  </style>




<div id="getcategory3_section_loading" ></div>

  <div id="getcategory3_section_product"></div>

  <script>
    getallproductBycategory3_section();
    function getallproductBycategory3_section() {
      var type = '2'
      var tabtype = 'topseller'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Product Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory3_section_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory3_section")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type+'&tabtype='+tabtype,
            success: function (res) { 
              jQuery('#getcategory3_section_loading').html(' ');
              jQuery('#getcategory3_section_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getcatepro3();
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





function top_slick_reload($catID)
    {
      var type = '2'
      var tabtype = 'topseller'
      var catID = $catID
      var content ='';

      content +='<div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>';
      jQuery('#categoryreload'+catID).hide();
      jQuery('#categoryreloadid'+catID).html(content);
      jQuery('.demo-13-active-remove'+catID).removeClass("common-color demo-13-active");
      jQuery('.top_slick_active'+catID).addClass("common-color demo-13-active");

      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory3_section1")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type+'&tabtype='+tabtype+'&catID='+catID,
            success: function (res) { 
              jQuery('#categoryreloadid'+catID).html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getcatepro4(catID);
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

function most_slick_reload($catID)
    {
      var type = '2'
      var tabtype = 'mostliked'
      var catID = $catID
      var content ='';

      content +='<div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>';
      jQuery('#categoryreload'+catID).hide();
      jQuery('#categoryreloadid'+catID).html(content);
      jQuery('.demo-13-active-remove'+catID).removeClass("common-color demo-13-active");
      jQuery('.most_slick_active'+catID).addClass("common-color demo-13-active");

      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory3_section1")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type+'&tabtype='+tabtype+'&catID='+catID,
            success: function (res) { 
              jQuery('#categoryreloadid'+catID).html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();

              getcatepro4(catID);
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

    function special_slick_reload($catID)
    {
      var type = '2'
      var tabtype = 'special'
      var catID = $catID
      var content ='';

      content +='<div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>';
      jQuery('#categoryreload'+catID).hide();
      jQuery('#categoryreloadid'+catID).html(content);
      jQuery('.demo-13-active-remove'+catID).removeClass("common-color demo-13-active");
      jQuery('.special_slick_active'+catID).addClass("common-color demo-13-active");

      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory3_section1")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type+'&tabtype='+tabtype+'&catID='+catID,
            success: function (res) { 
              jQuery('#categoryreloadid'+catID).html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getcatepro4(catID);
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

function getcatepro3(){
  

  jQuery(document).ready(function () {

  (function (jQuery) {
    var tabCarousel1 = jQuery('.demo-13-categories-carousel-js3');

    
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


    if (tabCarousel1.length) {
      tabCarousel1.each(function () {
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

function getcatepro4($catID){
  
var catID =$catID;
  jQuery(document).ready(function () {

  (function (jQuery) {
    var tabCarousel1 = jQuery('.demo-13-categories-carousel-js4'+catID);

    
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


    if (tabCarousel1.length) {
      tabCarousel1.each(function () {
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
