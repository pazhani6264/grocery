<?php
  $tmp = DB::table('current_theme')->where('template', 0)->first();       
  if($tmp){
?>
<style>

.trendpro-carousel-js16 .border-20 {
  border: 0.1rem solid #ebebeb;
  background: #fff;
  margin: 0px 0px !important;
  padding-top: 0px !important;
}
.trend16b .border-20 {
  border: 0.1rem solid #ebebeb;
  background: #fff;
  margin: 15px 0px !important;
  padding-top: 0px !important;
}
.trend16 .spacer{
  height:5px !important;
}
</style>

<?php } else { ?>

  <style>


  .trendpro-carousel-js16 .border-20 {
  border: 0.1rem solid #ebebeb;
  background: #fff;
  margin: 15px 0px !important;
  padding-top: 0px !important;
}
.trend16b .border-20 {
  border: 0.1rem solid #ebebeb;
  background: #fff;
  margin: 15px 0px !important;
  padding-top: 0px !important;
}

  .trend16 .spacer{
  height:30px !important;
}
</style>

<?php } ?>
<style>

.trend16 .slick-slide {
outline: none;
padding: 0px 10px !important;
}

.sp51 .slick-slide {
outline: none;
padding: 0px 10px !important;
}


#gettrend16_section_product .trend-ban-mt{
  position: sticky; 
  position: -webkit-sticky; 
  z-index: 1; 
  top: 0;
}
.trendpro-carousel-js16 .slick-prev:before {
    content: none !important;
}
.trendpro-carousel-js16 .slick-next:before {
  content: none !important;
}

.demo-14-fill-arrow
{
    fill: #999;
    position: relative;
    top:50%;
}
.product-based-cat-2.top17 .slick-disabled  {
    display: block !important;
    cursor: default;
    fill: #ccc !important;
}

.info-bg-1 {
    background-color: #fafafa !important;
}

.trend16-1{
  margin-top:10px;
}

  .blogtrend16 .blog-padding .slick-slide {
    padding: 0px 0px !important;
}
.blogtrend16 .tag{
  color:#ccc;
}
.blogtrend16 .blog-detial{
  padding:20px 0;
  text-align:center;
}

.blogtrend16 .blog-slick-dots .slick-dots{
  bottom:-30px !important;
}


.read-mores {
    display: inline-block;
    position: relative;
    font-weight: 400;
    letter-spacing: -.01em;
    padding-bottom: 0.1rem;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    color:#777;
}


 .read-mores::after {
    font-family: "Font Awesome 5 Brands";
    content: "\2192";
    font-size: 1.5rem;
    line-height: 1;
    display: block;
    position: absolute;
    right: 0px;
    top: 50%;
    margin-top: -0.75rem;
    opacity: 0;
    transform: translateX(-6px);
    transition: all 0.25s ease 0s;
}

.read-mores:focus:after, .read-mores:hover:after {
    opacity: 1;
    -webkit-transform: translateX(0);
    transform: translateX(0);
}


.read-mores:focus, .read-mores:hover {
    padding-right: 1.8rem;
  
}

 /*  .trend-ban-mt{
    margin-top:-20px;
  } */
/* .trend-mt20{
  margin-top:-3%;
} */
.banners-content .container-fluid figure {
    border-radius: 0;
    overflow: hidden;
    margin-bottom: 0px;
    width: 100%;
    position: relative;
    height: 100%;
}
.banners-content .container-fluid .trend16-ban figure {
    margin-top: 20px;
}
.banners-content #gettrend16_section_product .container-fluid [class^=col] {
    padding-right: 10px;
    padding-left: 10px;
    vertical-align: top;
}
.spmt-40px{
  margin-left:-10px;
  margin-right:-10px;
}
/* .sp15-ban1:first-of-type {
    margin-top: 0px !important;
} */
.trend16 .product-molla-31 {
    margin-bottom: 20px;
    margin-top: 20px;
}
.trend16b:first-of-type {
    margin-top: 0px !important;
}

.trend-ban-mt .banner-content {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 2rem;
    top: 20%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}

.trend16 .product-molla-31 article .thumb{
  height:222px;
}

.trendpro-carousel-js16 .slick-next {
    right: 0px;
    height: calc(95%) !important;
    background:hsla(0,0%,100%,.75);
    box-shadow: -10px 0 2px -5px #f1f1f1 !important;
    width:25px !important;
  }
  .sp51 .product-molla-31 {
    margin-bottom: 20px;
    margin-top: 0px;
}

.trendpro-carousel-js16 .slick-next:hover, .slick-next:focus {
  background:#fff !important;
}


.trendpro-carousel-js16  .slick-next:before {
    content: '\203A';
    font-size:3rem;
    color:#000;
}


 .trendpro-carousel-js16 .slick-prev {
    left: 10px !important;
    height: calc(95%) !important;
    background:hsla(0,0%,100%,.75);
    box-shadow: 10px 0 2px -5px #f1f1f1 !important;
    width:25px !important;
    left:0;
    z-index:9;
  }


.trendpro-carousel-js16 .slick-prev:hover, .slick-prev:focus {
  background:#fff !important;
}
.demo-14-mobile-show
{
  display:none;
}
.demo-14-mobile-hide
{
  display:block;
}

.trendpro-carousel-js16  .slick-prev:before {
    content: '\2039';
    font-size:3rem;
    color:#000;
} 


.col-xl-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
    display:inline-block;
    padding-left:0px !important;
}
.col-xl-9 {
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%;
    display:inline-block;
    padding-left:0px !important;
    padding-right:0px !important;
}
#gettrend16_section_product .sp15-ban{
  margin-top:60px;
}

.special-15-recent-row{
  margin-left:-10px;
  margin-right:-10px;
}
.special-15-recent-col .pbc-2-header{
  border-bottom: 0.1rem solid #ebebeb;
}

.special-15-recent-col .pbc-2-title {
    font-size: 20px;
    font-weight: 600 !important;
    padding: 15px 0;
    position:relative;
    display:inline-block;
}

.special-15-recent-col .topselling-main16{
  padding:0 5px;
  margin-top: -20px;
}

.special-15-recent-col .product-molla-31 article .thumb{
  height:300px;
}

.special-15-recent-col .product-molla-31 {
    margin-bottom: 0;
    margin-top: 30px;
    border-bottom: 0.1rem solid #ebebeb;
}

.special-15-recent-col .pbc-2-header .pbc-2-title:after {
    content: "";
    position: absolute;
    display: block;
    left: 0;
    right: 0;
    bottom: -0.1rem;
    height: 1px;
    background-color: #fcb941;
}


.css-16ph7t8 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 200ms;
    animation-name: animation-1ujkkqi;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
}

.sp-carousel-new .icon-box {
    -webkit-box-align: start;
    margin-bottom: 3.6rem;
}
.sp-carousel-new .icon-box figure {
    flex: 0 0 40px;
}
.item img {
    display: block;
    width: 100%;
}
.sp-carousel-new .icon-box-content {
    margin-left: 1.5rem;
    font-size: 1rem;
}
.sp-carousel-new .icon-box-content .icon-title {
    margin-bottom: 4px;
    font-size: 1.15rem;
    font-weight: 600;
    line-height: 1.1;
}
.letter-spacing-normal {
    letter-spacing: 0!important;
}
.mb-1 {
    margin-bottom: 1rem!important;
}
.service-section .icon-box-content p {
    line-height: 1.7em;
}
.icon-box-content p:last-child {
    margin-bottom: 0;
}
.font-weight-light {
    font-weight: 200!important;
}
.text-light {
    color: #999!important;
}

.sp5 .product-molla-31 {
    margin-bottom: 20px;
    margin-top: 30px;
}

.sp5 .product-molla-31 article .thumb{
  height:222px;
}

.sp51 .product-molla-31 article .thumb {
    height: 222px;
}

.cat-banner .banner-content {
    display: flex;
    flex-direction: column;
    padding-top: 0;
    top: 4.5rem;
    left: 4rem;
    right: 4rem;
    bottom: 5rem;
    -webkit-transform: translateY(0);
    transform: translateY(0);
}
.cat-banner .banner-subtitle {
    font-weight: 300;
    font-size: 1rem;
    letter-spacing: -.01em;
    margin-bottom: 1.1rem;
}
.cat-banner .banner-title1 {
    font-weight: 600;
    font-size: 1.45rem;
    line-height: 1.3;
    letter-spacing: -.025em;
    margin-bottom: 0rem;
}
.cat-banner .banner-title {
    font-weight: 600;
    font-size: 1.45rem;
    line-height: 1.3;
    letter-spacing: -.025em;
    margin-bottom: 0rem;
}
.cat-banner .banner-title {
    flex-grow: 1;
}
.cat-banner .banner-link {
  width: auto;
  min-width: 150px;
  text-align: center;
  text-transform: uppercase;
  color: #fff !important;
  font-weight: 400;
  font-size: 1rem;
  line-height: 1.4;
  letter-spacing: -.01em;
  border-radius: .3rem;
  padding: .5rem 1.2rem .5rem;
  background-color: hsla(0,0%,100%,.2);
  -webkit-transition: all .35s;
  transition: all .35s;
  margin-top:1rem;
}

#gettrend16_section_product .banner-link {
font-weight: 400;
display: inline-block;
}

.cat-banner .banner-link svg {
display: inline-block;
width: 0;
line-height: 1;
overflow: hidden;
margin-left: 0;
margin-bottom: -1px;
-webkit-transition: width .35s,margin .35s,color 0s;
transition: width .35s,margin .35s,color 0s;
}

.cat-banner .banner-link:focus, .cat-banner .banner-link:hover {
  color: #333;
  text-decoration: none!important;
}
.cat-banner .banner-link:focus svg, .cat-banner .banner-link:hover svg {
width: auto;
margin-left: .7rem;
}





.demo-26-banner-2-h  .banner-link {
  width: auto;
  min-width: 150px;
  text-align: center;
  text-transform: uppercase;
  color: #fff !important;
  font-weight: 400;
  font-size: 1rem;
  line-height: 1.4;
  letter-spacing: -.01em;
  border-radius: .3rem;
  padding: .5rem 1.2rem .5rem;
  background-color: hsla(0,0%,100%,.2);
  -webkit-transition: all .35s;
  transition: all .35s;
  margin-top:1rem;
}

#gettrend16_section_product .banner-link {
font-weight: 400;
display: inline-block;
}

.demo-26-banner-2-h  .banner-link svg {
display: inline-block;
width: 0;
line-height: 1;
overflow: hidden;
margin-left: 0;
margin-bottom: -1px;
-webkit-transition: width .35s,margin .35s,color 0s;
transition: width .35s,margin .35s,color 0s;
}

.demo-26-banner-2-h  .banner-link:focus, .demo-26-banner-2-h  .banner-link:hover {
  color: #333;
  text-decoration: none!important;
}
.demo-26-banner-2-h  .banner-link:focus svg, .demo-26-banner-2-h  .banner-link:hover svg {
width: auto;
margin-left: .7rem;
}









.cat-banner1 .banner-subtitle {
    font-weight: 300;
    font-size: 1rem;
    letter-spacing: -.01em;
    margin-bottom: 1.1rem;
}
.cat-banner1 .banner-title {
    font-weight: 600;
    font-size: 1.45rem;
    line-height: 1.3;
    letter-spacing: -.025em;
    margin-bottom: 0rem;
}

.cat-banner1 .banner-link {
  width: auto;
  min-width: 150px;
  text-align: center;
  text-transform: uppercase;
  color: #fff !important;
  font-weight: 400;
  font-size: 1rem;
  line-height: 1.4;
  letter-spacing: -.01em;
  border-radius: .3rem;
  padding: .5rem 1.2rem .5rem;
  background-color: hsla(0,0%,100%,.2);
  -webkit-transition: all .35s;
  transition: all .35s;
  margin-top:1rem;
}

#gettrend16_section_product .banner-link {
font-weight: 400;
display: inline-block;
}

.cat-banner1 .banner-link svg {
display: inline-block;
width: 0;
line-height: 1;
overflow: hidden;
margin-left: 0;
margin-bottom: -1px;
-webkit-transition: width .35s,margin .35s,color 0s;
transition: width .35s,margin .35s,color 0s;
}

.cat-banner1 .banner-link:focus, .cat-banner1 .banner-link:hover {
  color: #333;
  text-decoration: none!important;
}
.cat-banner1 .banner-link:focus svg, .cat-banner1 .banner-link:hover svg {
width: auto;
margin-left: .7rem;
}



@media screen and (min-width: 768px){
.mb-md-0 {
    margin-bottom: 0!important;
}
}


.mainspecial5 .pbc-2-outer-pad {
    padding: 0 0px 5rem 0px;
}
.quick-view-39{
  opacity:0;
}
article:hover .quick-view-39{
  opacity:1;
}

/* .col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1
{
  padding-left:10px;
  padding-right:10px;
} */

.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}

.btnspecial5 {
  color: #ccc;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}


.product-based-cat-2 .pbc-2-header1 {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    padding:0px 10px;
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
.trend{
  margin-bottom:10px;
}


.sp5 .product-molla-20 article .thumb{
  height: 217px;
}

.sp5 .product-molla-20 article .content{
  height: 143px;
}

.sp5 .pbc-2-title {
     font-size: 22px;
     font-weight: 600 !important;
     margin:auto;
   }

   .special5 {
    border-bottom: 1px solid #000;
    color: #000 !important;
}

.sp5  .product-molla-26 {
    margin-bottom: 0;
    margin-top: 5px;
}
.sp5  .tp1-banner {
    margin-top: 0px;
}

.sp5 .slick-slide {
    outline: none;
    padding: 0px 10px !important;
}

.sp5 .tp1-bqnner-img {
    height: 535px !important;
}

.sp5 .pbc-2-header1 {
    padding: 0px 0px 0px 10px;
}
.sp5 .row{
  margin-left:0px;
  margin-right:0px;
}

.sp5  hr {
    border: 0;
    margin: 3.5rem auto 0 auto;
    width: 98%;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

@media screen and (min-width: 1200px){
  .col-md-3trend {
      flex: 0 0 25%;
      max-width: 25%;
      padding: 0px 10px;
  }
  .col-md-9trend {
    flex: 0 0 75%;
    max-width: 75%;
  }
}

@media screen and (max-width: 992px){
   
  .mainspecial5{
    margin-top:35px !important;
  }
    .mainspecial5 .pbc-2-outer-pad {
      padding: 0 0px ;
    }
    .mainspecial5 .pbc-2-header1 {
      padding: 0px 0px !important;
      width: 100%;
    }
    .sp5 hr {
      border: 0;
      margin: 3.5rem auto 0 auto;
      width: 100%;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .col-md-3trend {
      flex: 0 0 25%;
      max-width: 25%;
      padding-left:15px;
    padding-right:10px;
  }
  .col-md-9trend {
    flex: 0 0 75%;
    max-width: 75%;
    padding-left:0px;
    padding-right:10px;
  }
   
    .sp5 .row {
      margin-left: -15px;
      margin-right: -15px;
    }
    .sp5{
  padding: 0 0 4rem 0 !important;
}
.mbdn{
  display:none;
}


.col-xl-3 {
    -ms-flex: 0 0 100% !important;
    flex: 0 0 100% !important;
    max-width: 100% !important;
    display: inline-block;
    padding-left: 0px !important;
}
.col-xl-9 {
  -ms-flex: 0 0 100% !important;
    flex: 0 0 100% !important;
    max-width: 100% !important;
    display: inline-block;
    padding-left: 0px !important;
    padding-right: 0px !important;
}
#gettrend16_section_product .mb-20 {
    margin-bottom: 40px;
}
.trend16-ban{
  padding-right:0px !important;
}
.sp15-ban1{
  padding-right:0px !important;
}

}

@media only screen and (min-width: 700px) and (max-width: 800px){

.sp-carousel-new .slick-slide {
    outline: none;
    padding: 0px 10px !important;
}
.trend-mt20 {
    margin-top: 0px !important;
}

}
@media screen and (max-width: 992px){
  .sp51 .product-molla-31 {
    margin-bottom: 20px;
    margin-top: 20px;
}
.demo-14-mobile-show
{
  display:flex;
}
.demo-14-mobile-hide
{
  display:none !important;
}
}

@media screen and (max-width: 600px){

.col-md-3trend {
      flex: 0 0 100%;
      max-width: 100%;
      padding:0px 15px;
    }
    .col-md-9trend {
      flex: 0 0 100%;
      max-width: 100%;
      margin-top: 15px;
      padding: 0px 5px;
    }
    .sp5 .product article .thumb-size {
      height:240px !important;
    }
   .product-based-cat-2 .pbc-2-title {
        font-size: 16px;
        text-align: center !important;
    }

.banners-content .container-fluid figure img {
    max-width: 100%;
    width:auto !important;
}
.slick-slide img {
    display: initial;
}
.sp5{
  padding: 0 0 4rem 0 !important;
}

#gettrend16_section_product .col-6 {
    position: relative;
    width: 100%;
    padding-right: 10px !important;
    padding-left: 10px !important;
    flex: 0 0 100%;
    max-width: 100%;
}

.trend16-ban{
  padding-right:0px !important;
}
.sp15-ban1{
  padding-right:0px !important;
}
.trend-mt20 {
    margin-top: 0px !important;
}
.slick-slide {
    outline: none;
    padding: 0 0px;
}
#gettrend16_section_product .mb-20 {
    margin-bottom: 80px;
}


#gettrend16_section_product .info-boxes-contents .info-box {
    display: block;
    position: relative;
    align-items: center;
    justify-content: center;
    padding-right: 0px;
    margin: auto;
    text-align: center;
}
#gettrend16_section_product .info-boxes-contents .info-box .panel {
    display: block;
    align-items: center;
    width: 100%;
    margin-bottom: 0px;
    text-align: center;
    margin: auto;
}


  }
     </style>
   
   
   
   
   <div id="gettrend16_section_loading" ></div>
   
     <div id="gettrend16_section_product"></div>
   
     <script>
       getalltrendproduct16_section();
       function getalltrendproduct16_section() {
         var type = '2'
         var content ='';
   
         content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Hot Deals Products</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
         jQuery('#gettrend16_section_loading').html(content);
         
         jQuery.ajax({
             url: '{{ URL::to("/getalltrendproduct16_section")}}',
             headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
             type: "POST",
             data: 'type='+type,
               success: function (res) { 
                 jQuery('#gettrend16_section_loading').html(' ');
                 jQuery('#gettrend16_section_product').html(res);
                 jQuery('.add-to-cart-d-hide').show();
                 jQuery('.added-to-cart-d-hide').hide();
                 gettrend16();
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
   
   function gettrend16(){
    jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.trendpro-carousel-js16');

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
          prevArrow: '<div class="slick-prev slick-arrow"><svg xmlns="http://www.w3.org/2000/svg" class="arrowmainprev1 fill-left-arrow  common-fill-hover demo-14-fill-arrow" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg></div>',
    	  nextArrow: '<div class="slick-next slick-arrow"><svg xmlns="http://www.w3.org/2000/svg" class="arrowmainnext2 fill-right-arrow common-fill-hover demo-14-fill-arrow" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg></div>',
          //rtl:true,
          speed: 300,
          slidesToShow: 3,
          slidesToScroll: 1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow:  3,
              slidesToScroll: 1
            }
            }, {
            breakpoint: 600,
            settings: {
              slidesToShow: itemmobile || mobile_count,
              slidesToScroll: itemmobile || mobile_count
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
});


jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.blog-carousel-jss');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          arrows: false,
          infinite: false,
          autoplay: false,
          //rtl:true,
          speed: 300,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },  {
            breakpoint: 992,
            settings: {
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },{
            breakpoint: 768,
            settings: {
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 650,
            settings: {
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); // aboutus section



}
   
   
   
   
     </script>
   