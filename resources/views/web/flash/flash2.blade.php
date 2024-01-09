<style>

.bg-flash2 {
  background-color: #F4F7FF;
}
.bg-flash3 .container {
    width: 1160px !important;
    max-width: 100%;
}

.demo-4-flash-product-action-vertical {
    display: flex;
    flex-direction: column;
    position: absolute;
    right: 10px;
    top: 10px;
    background-color: transparent;
    z-index: 10;
    visibility: hidden;
    opacity: 0;
    transition: all 0.35s ease;
    transform: translateX(-15px);
}
.flash-shop-button {
  padding: 12px 15px !important;
}

.bg-flash3 .col-xl, .bg-flash3 .col-xl-auto, .bg-flash3 .col-xl-12, .bg-flash3 .col-xl-11, .bg-flash3 .col-xl-10, .bg-flash3 .col-xl-9, .bg-flash3 .col-xl-8, .bg-flash3 .col-xl-7, .bg-flash3 .col-xl-6, .bg-flash3 .col-xl-5, .bg-flash3 .col-xl-4, .bg-flash3 .col-xl-3, .bg-flash3 .col-xl-2, .bg-flash3 .col-xl-1, .bg-flash3 .col-lg, .bg-flash3 .col-lg-auto, .bg-flash3 .col-lg-12, .bg-flash3 .col-lg-11, .bg-flash3 .col-lg-10, .bg-flash3 .col-lg-9, .bg-flash3 .col-lg-8, .bg-flash3 .col-lg-7, .bg-flash3 .col-lg-6, .bg-flash3 .col-lg-5, .bg-flash3 .col-lg-4, .bg-flash3 .col-lg-3, .bg-flash3 .col-lg-2, .bg-flash3 .col-lg-1, .bg-flash3 .col-md, .bg-flash3 .col-md-auto, .bg-flash3 .col-md-12, .bg-flash3 .col-md-11, .bg-flash3 .col-md-10, .bg-flash3 .col-md-9, .bg-flash3 .col-md-8, .bg-flash3 .col-md-7, .bg-flash3 .col-md-6, .bg-flash3 .col-md-5, .bg-flash3 .col-md-4, .bg-flash3 .col-md-3, .bg-flash3 .col-md-2, .bg-flash3 .col-md-1, .bg-flash3 .col-sm, .bg-flash3 .col-sm-auto, .bg-flash3 .col-sm-12, .bg-flash3 .col-sm-11, .bg-flash3 .col-sm-10, .bg-flash3 .col-sm-9, .bg-flash3 .col-sm-8, .bg-flash3 .col-sm-7, .bg-flash3 .col-sm-6, .bg-flash3 .col-sm-5, .bg-flash3 .col-sm-4, .bg-flash3 .col-sm-3, .bg-flash3 .col-sm-2, .bg-flash3 .col-sm-1, .bg-flash3 .col, .bg-flash3 .col-auto, .bg-flash3 .col-12, .bg-flash3 .col-11, .bg-flash3 .col-10, .bg-flash3 .col-9, .bg-flash3 .col-8, .bg-flash3 .col-7, .bg-flash3 .col-6, .bg-flash3 .col-5, .bg-flash3 .col-4, .bg-flash3 .col-3, .bg-flash3 .col-2, .bg-flash3 .col-1 {
    position: relative;
    width: 100%;
    padding-right: 10px;
    padding-left: 10px;

}

.pro-content {
    overflow: hidden;
    padding-top: 70px !important;
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
  
    .title_changes{
  text-align:center !important;
  font-size:24px !important;
  font-weight:600 !important;
  letter-spacing: -.03em;
  text-transform:initial !important;
  margin-bottom:0.5rem !important;
}

 .title-desc {
    font-size: 1.6rem;
    font-weight: 300;
    letter-spacing: -.01em !important;
    color: #777;
}

.demo-3-flash-pad {
    padding: 0 10px;
}

.ml-10{
  margin-left:10px;
}
.pb-70px {
    padding-bottom: 70px;
}

.flash3 .flash-height {
    height: 430px;
}
.flash2-text-size{
  font-size:20px !important; 
  font-weight:600 !important; 
  margin-bottom:0px !important;
}
.flash-p h4 {
  font-size: 1.15rem !important;
  font-weight: 400 !important;
}

.flash-p .price{
  font-size: 1.45rem !important;
  font-weight: 300 !important;
  margin-bottom:0.5rem !important;
}

.flash-p .price span {
    font-size: 1.45rem !important;
    font-weight: 300 !important;
}

.flash3 .pro-description {
    z-index: 2;
    width: 100%;
    padding: 1rem;
    position: relative;
    display: inline-block;
}

.product-cat {
    color: #ccc !important;
    font-weight: 300 !important;
    font-size: 0.9rem !important;
    line-height: 1.2;
    letter-spacing: -.01em;
    margin-bottom: 0.3rem;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    text-transform:initial !important;
}
.pro-title {
    font-weight: 400 !important;
    font-size: 1.6rem;
    line-height: 1.25;
    letter-spacing: -.01em !important;
    color: #333 !important;
    margin-bottom: 0.2rem;
}
.pro-fs-content .product .flash-p1 {
    z-index: 99;
    display: flex;
    justify-content: space-between;
    padding: 0px;
    margin-bottom:10px;
}

.product-flash-hover .btn
{
  padding-left: 0 !important;
}

.flash2 .pro-thumb {
    width: 100%;
    height: 275px;
    overflow: hidden;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    position: relative;
}

.prod-title {
    font-weight: 400 !important;
    font-size: 1.15rem;
    line-height: 1.25;
    letter-spacing: -.01em !important;
    color: #333 !important;
    margin-bottom: 0rem;
}

.flash2 .pro-description {
    z-index: 2;
    width: 100%;
    padding: 1.25rem 1.7rem;
    position: relative;
    height:144px;
}

.flash2  .price {
    display: flex;
    align-items: center;
    font-size: 1.15rem !important;
    font-weight: 400 !important;
    color: #9ACE69;
    margin-bottom: 0.6rem !important;
}

.flash2 .price span {
    color: #6c757d;
    text-decoration: line-through;
    margin-left: 10px;
    font-size: 1.15rem !important;
    line-height: 1.5;
}
.mt-40 {
    margin-top: 40px;
}
.flash-border{
  border:.1rem solid #ebebeb;
}
.flash-border:hover{
  box-shadow: 0 5px 15px rgb(0 0 0 / 5%);
}
.btn-links {
    padding: 0rem 0rem;
    text-decoration: none;
    border: none;
    border-bottom: 0.1rem solid transparent;
    letter-spacing: 0;
    font-size: 1rem;
    min-width: 0;
    font-weight:400 !important;
    text-transform:initial !important;
}
.flash3-p {
    color: #6c757d !important;
    margin-bottom: 75px;
    width: 100%;
}
.mb-5{
  margin-bottom:5rem !important;
}

@media only screen and (max-width: 992px) {
.col-6 {
    position: relative;
    width: 100%;
    padding-right: 10px !important; 
    padding-left: 10px !important; 
}
.flash2 .price {
    display: flex;
    align-items: center;
    font-size: 0.8rem !important;
    font-weight: 400 !important;
    margin-bottom: 0.6rem !important;
}
}
@media only screen and (max-width: 600px)
{
.flash3 .pro-thumb {
    width: 100%;
    overflow: hidden;
    text-align: center;
    display: inline-block;
    justify-content: center;
    align-items: center;
    padding: 0;
    position: relative;
    vertical-align: top;
    position: absolute;
    right: 0px;
    bottom: 0;
}

.flash2 .price {
  font-size: 0.8rem !important;
}
.flash2 .price span {
  font-size: 0.8rem !important;
}

.pro-fs-content .product .flash-p {
  width: 100%;
}
.flash3 .flash-height {
    height: 430px !important;
}
}

@media only screen and (max-width: 400px)
{


}

  </style>




<div id="getflash_2_loading"></div>

  <div id="getflash_2_product"></div>

  <script>
    getflashsales_2();
    function getflashsales_2() {
      var type = 'flash_2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Flash Sale</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getflash_2_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getflashsales_2")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getflash_2_loading').html(' ');
              jQuery('#getflash_2_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getflashtime_2();
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

function getflashtime_2()
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
              slidesToShow: 1.5,
              slidesToScroll: 1.5,
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


