
<style>

.demo-1-banner-20-content {
position: absolute;
width: 185px;
top: 36px;
z-index: 2;
left: 40px;
padding: 7px 0 0 10px;
}
.demo-1-banner-20-outer-2 .demo-1-banner-20-title {
color: #ebebeb !important;
}
.demo-1-banner-20-title {
margin-bottom: 6px;
font-size: 14px;
line-height: 1;
color: #666 !important;
font-weight: 300!important;
}
.demo-1-banner-20-outer-2 .demo-1-banner-20-p {
color: #fff;
}
.demo-1-banner-20-p {
font-size: 24px;
color: #333;
margin-bottom: 14px;
font-weight: 600!important;
line-height: 1.2;
}
.demo-1-banner-20-p2 {
font-size: 24px;
color: #666;
margin-bottom: 13px;
font-weight: 300!important;
line-height: 1.25;
}
.demo-1-banner-20-outer-2 .demo-1-banner-20-btn-new {
border: solid 0.5px #aaa;
color: #fff;
fill: #fff;
}
.demo-1-banner-20-btn-new {
border: solid 0.5px #aaa;
padding: 8px 14px;
}
.demo-1-banner-20-btn-new {
text-transform: initial;
}

.demo-1-banner-20-btn-new:hover{
background-color: transparent;
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

@media only screen and (min-width: 700px) and (max-width: 800px){
  .flash1 .tab-button-50 {
    width: 100%;
    margin: unset;
    }
    .flash1 .col-md-9 {
      flex: 0 0 100% !important;
      max-width: 100% !important;
    }
}

@media only screen and (max-width: 600px){
  .flash1 .tab-button-50 {
    width: 50%;
    margin: auto;
    }
}
  </style>




<div id="getflash_1_loading"></div>

  <div id="getflash_1_product" style="background-color: #f8f8f8!important;padding: 1.5rem 0rem 3.5rem 0rem;margin: 3rem 0rem;"></div>

  <script>
    getflashsales_1();
    function getflashsales_1() {
      var type = 'flash_1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Flash Sale</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getflash_1_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getflashsales_1")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getflash_1_loading').html(' ');
              jQuery('#getflash_1_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getflashtime_1();
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

function getflashtime_1()
{
  (function (jQuery) {
  var tabCarousel = jQuery('.flash-carousel-js-1');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,

		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  1.5,
          slidesToScroll:  1.5,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);

  function convertTZ(date, tzString) {
    return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
}

  jQuery(document).ready(function(e) {

@if(!empty($result['flash_sale']['success']) and $result['flash_sale']['success']==1)
    @foreach($result['flash_sale']['product_data'] as $key=>$products)
  @if( date("Y-m-d",$products->server_time) >= date("Y-m-d",$products->flash_start_date))
   var product_div_{{$products->products_id}} = 'product_div_{{$products->products_id}}';
 var  counter_id_{{$products->products_id}} = 'counter_{{$products->products_id}}';
 var inputTime_{{$products->products_id}} = "{{date('M d, Y H:i:s' ,$products->flash_expires_date)}}";
 

 // Set the date we're counting down to
 var countDownDate_{{$products->products_id}} = new Date(inputTime_{{$products->products_id}}).getTime();

 // Update the count down every 1 second
 var x_{{$products->products_id}} = setInterval(function() {
  var new_now = convertTZ(new Date(), "Asia/Kuala_Lumpur");
   // Get todays date and time
   var now = new_now.getTime();

   



   // Find the distance between now and the count down date
   var distance_{{$products->products_id}} = countDownDate_{{$products->products_id}} - now;

   // Time calculations for days, hours, minutes and seconds
   var days_{{$products->products_id}} = Math.floor(distance_{{$products->products_id}} / (1000 * 60 * 60 * 24));
   var hours_{{$products->products_id}} = Math.floor((distance_{{$products->products_id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
   var minutes_{{$products->products_id}} = Math.floor((distance_{{$products->products_id}} % (1000 * 60 * 60)) / (1000 * 60));
   var seconds_{{$products->products_id}} = Math.floor((distance_{{$products->products_id}} % (1000 * 60)) / 1000);
   var days_text = "@lang('website.Days')";
   // Display the result in the element with id="demo"
   document.getElementById(counter_id_{{$products->products_id}}).innerHTML = "<span class='days'>"+days_{{$products->products_id}} + "<small>@lang('website.Days')</small></span> <span class='hours'>" + hours_{{$products->products_id}} + "<small>@lang('website.Hours')</small></span> <span class='mintues'> "
   + minutes_{{$products->products_id}} + "<small>@lang('website.Minutes')</small></span> <span class='seconds'>" + seconds_{{$products->products_id}} + "<small>@lang('website.Seconds')</small></span> ";

   // If the count down is finished, write some text
   if (distance_{{$products->products_id}} < 0) {
   clearInterval(x_{{$products->products_id}});
   //document.getElementById(counter_id_{{$products->products_id}}).innerHTML = "EXPIRED";
   document.getElementById('product_div_{{$products->products_id}}').remove();
   }
 }, 1000);
    @endif
@endforeach
@endif

@if(!empty($result['detail']['product_data'][0]->flash_start_date))
 @if( $result['detail']['product_data'][0]->server_time >= $result['detail']['product_data'][0]->flash_start_date)

   var inputTime = "{{date('M d, Y H:i:s' ,$result['detail']['product_data'][0]->flash_expires_date)}}";

   var countDownDate = new Date(inputTime).getTime();

   // Update the count down every 1 second
   var x = setInterval(function() {

     // Get todays date and time
     var now = new Date().getTime();

     // Find the distance between now and the count down date
     var distance = countDownDate - now;

     // Time calculations for days, hours, minutes and seconds
     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
     var seconds = Math.floor((distance % (1000 * 60)) / 1000);

     // Display the result in the element with id="demo"
     document.getElementById("counter_product").innerHTML = days + "d " + hours + "h "
     + minutes + "m " + seconds + "s ";
     document.getElementById("counter_product").style.display = 'block';
     // If the count down is finished, write some text
     if (distance < 0) {
     clearInterval(x);
     document.getElementById("counter_product").innerHTML = "EXPIRED";
     document.getElementById("add-to-Cart").style.display = 'none';
     }
   }, 1000);
 @endif
@endif
});

}




  </script>

