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
  
    .title_change_flash{
  text-align:center !important;
  font-size:24px !important;
  font-weight:600;
  margin-bottom:2rem !important;
}

.flash4 {
    width: 35%;
    margin: auto;
}


.flash4 .pro-description{
  margin-top:2rem;
}

.pro-fs-content .product {
  background-color: transparent !important;
}
.product article {
    background-color: transparent !important;
}
.bg-image-flash4 .pro-timer{
  background-color: transparent !important;
}
.bg-image-flash4 .pro-timer span{
  background-color: transparent !important;
  font-size:24px !important;
}
.bg-image-flash4 .pro-timer small{
  background-color: transparent !important;
  font-size:13px !important;
}


.flash-p h4 {
    font-size: 1rem !important;
    font-weight: 400 !important;
    text-align:center;
}
.flash-p .price {
    font-size: 1rem !important;
    font-weight: 400 !important;
    display:block !important;
    text-align:center;
    margin-bottom: 0.5rem !important;
}
.flash-p .price span{
    font-size: 1rem !important;
    font-weight: 400 !important;
    color: #ccc !important;
}

.flash4-p {
  font-size:13px !important;
  margin-bottom:1rem !important;
}

.flash4 .btn-37 {
    padding: 11.5px;
    width: 72.5% !important;
    background-color: transparent !important;

}

.flash4 .btn-37-danger {
    padding: 11.5px;
    width: 72.5% !important;
    background-color: transparent !important;

}
.flash4 .btn-37-danger:hover {
    padding: 11.5px;
    width: 72.5% !important;
    background-color: #dc3545 !important;
}

.flash4  .border-20:hover{
  box-shadow:none;
}

.ptb-80px{
  padding-top:80px !important;
  padding-bottom:33px !important;

}

.flash4 .pro-thumb {
    width: 100%;
    height: 270px
}

@media only screen and (max-width: 992px) {

  .flash4 .btn-37-danger {
      padding: 11.5px;
      width: 72.5% !important;
      background-color: transparent !important;
  }
  .flash4 .pro-thumb {
    width: 100%;
    height: 200px;
  }
  .flash4-p{
    font-size:16px !important;
  }
  .flash4 {
    width: 65% !important;
    margin: auto;
}
}
@media only screen and (max-width: 800px) {
.flash4 {
  width: 65% !important;
  margin: auto;
}
}
@media only screen and (max-width: 600px) {
.flash4  {
      
      width: 100% !important;
      
  }
  .pro-fs-content .product .flash-p {
   padding:0;
}
.flash4 .btn-37-danger {
      padding: 11.5px 2px;
      width: 72.5% !important;
      background-color: transparent !important;
  }
  .flash4 .btn-37-danger:hover {
      padding: 11.5px 2px;
  }
}
  </style>




<div id="getflash_4_loading" style="padding-top: 30px;"></div>

  <div id="getflash_4_product"></div>

  <script>
    getflashsales_4();
    function getflashsales_4() {
      var type = 'flash_4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Flash Sale</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getflash_4_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getflashsales_4")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getflash_4_loading').html(' ');
              jQuery('#getflash_4_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getflashtime_4();
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

function getflashtime_4()
{
  (function (jQuery) {
  var tabCarousel = jQuery('.flash-carousel-js-4');

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
          slidesToShow:  2,
          slidesToScroll:  2,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll:2,
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
   document.getElementById(counter_id_{{$products->products_id}}).innerHTML = "<span class='days common-text'>"+days_{{$products->products_id}} + "<small>@lang('website.Days')</small></span> <span class='hours common-text'>" + hours_{{$products->products_id}} + "<small>@lang('website.Hours')</small></span> <span class='mintues common-text'> "
   + minutes_{{$products->products_id}} + "<small>@lang('website.Minutes')</small></span> <span class='seconds common-text'>" + seconds_{{$products->products_id}} + "<small>@lang('website.Seconds')</small></span> ";

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


