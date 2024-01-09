<!-- //banner 25 -->
<?php
$theme = DB::table('current_theme')->where('template',0)->first();
if($theme){
?>
<style>
.banner-img-molla61{
  margin-top: 0rem;
}
</style>
<?php } else { ?>
  <style>
.banner-img-molla61{
  margin-top: -12rem;
}
</style>
  <?php } ?>

<style>
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}
#getmultibanner_61_product .demo-61-margin-auto {
    margin-top: 20px;
}
#getmultibanner_61_product .demo-61-content {
    width: 50%;
    margin: auto;
}
#getmultibanner_61_product .demo-61-new-title
{
  text-transform: uppercase;
  letter-spacing: 1px !important;
}
#getmultibanner_61_product .demo-61-percent {
    background: -webkit-linear-gradient(#27b9e5, #f3b45b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 90px;
    font-weight: 900;
}
#getmultibanner_61_product .demo-24-banner-61-h-1
{
  height: 498px;
}
#getmultibanner_61_product .demo-24-banner-61-h-2
{
  height: 541px;
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
    #getmultibanner_61_product .demo-24-banner-61-pad-2
{
  padding:  0 !important;
}
#getmultibanner_61_product .demo-24-banner-61-pad-1
{
  padding: 0 10px !important;
}
#getmultibanner_61_product .demo-1-banner-20-content {
    position: absolute;
    width: 80%;
    top: 0;
    z-index: 2;
    left: 0px;
    bottom: 0;
    margin: auto;
    height: 150px;
    right: 0;
    text-align: center;
}
#getmultibanner_61_product .btn-outline-white {
    border: 1px solid ;
    min-width: 140px;
    padding: 0.6rem 1.3rem !important;
    font-size: 0.9rem;
    font-weight: 400 !important;
    border-radius:5px;
}
#getmultibanner_61_product  .btn-outline-white:hover
{
  fill: #fff !important;
  color: #333 !important;
}


#getmultibanner_61_product .demo-1-banner-con {
    position: relative;
   
}


#getmultibanner_61_product .demo-1-banner-20-title {
    font-weight: 300 !important;
    text-transform: uppercase;
    margin-bottom: 10px;
    font-size: 13px;
    color: #fff !important;
    letter-spacing: 1px;
    cursor: pointer;
}
#getmultibanner_61_product .demo-1-banner-20-p{
    font-weight: 700;
    font-size: 30px;
    line-height: 1.13;
    margin-bottom: 15px;
    letter-spacing: -.025em;
    text-transform: initial;
    color: #fff;
    cursor: pointer;
}
#getmultibanner_61_product .demo-1-banner-20-p2{
    font-weight: 300;
    font-size: 22px;
    line-height: 1.13;
    margin-bottom: 40px;
    letter-spacing: -.025em;
    text-transform: uppercase;
    color: #333;
    cursor: pointer;
}
#getmultibanner_61_product .demo-1-banner-20-btn-new
{
    padding-top: 14px;
    padding-bottom: 10px;
    color: #fff;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: .1em;
    min-width: 130px;
    border-bottom:solid 2px #fff; 
}
#getmultibanner_61_product .demo-1-banner-20-btn-new:hover
{
  background:#fff;
}



#getmultibanner_61_product .banner.percent .intro61 {
    width: 76.7%;
    max-height: 100%;
    background-color: #fff;
    padding-top: 4rem;
    padding-bottom: 4rem;
    position: absolute;
    top:10%;
    bottom:10%;
    left:0;
    right:0;
    margin:auto;
    text-align:center;
}

#getmultibanner_61_product .banners.center .title {
    margin-bottom: 1rem;
}
#getmultibanner_61_product .title {
    letter-spacing: -.03em;
}
#getmultibanner_61_product .banner.percent .img-percent {
    width: 19rem;
    max-width: 80%;
    height: 7.5rem;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 2rem;
}
#getmultibanner_61_product .banner.percent .content h4 {
    font-size: 0.8rem;
    font-weight: 400;
    letter-spacing: .01em;
    color: #666;
    text-transform: none;
}
#getmultibanner_61_product .banner.percent .action {
    margin-top: 2rem;
}
.intro61 .title h3{
  font-size:.9rem;
}
.intro61 .title h4{
  font-size:1.8rem;
}


@media only screen and (max-width: 992px){
  #getmultibanner_61_product .demo-24-banner-61-h-2
{
  height: 498px;
}
#getmultibanner_61_product .demo-61-margin-auto {
    margin-top: 0px;
}
#getmultibanner_61_product .demo-61-content {
    width: 75%;
}
#getmultibanner_61_product .demo-24-banner-61-pad-1
{
  padding: 0 10px !important;
}
#getmultibanner_61_product .demo-24-banner-61-pad-2
{
  padding: 0 10px 0 0 !important;
}
}

    @media only screen and (max-width: 600px){
      #getmultibanner_61_product .banners-content .banner-img-molla .container {
          padding-left: 10px;
          padding-right: 10px;
      }
      #getmultibanner_61_product .tab-banner-col-md-6s{
        padding-left: 10px !important;
          padding-right: 10px !important;
      }
      #getmultibanner_61_product  .banners-content .group-banners .banner-image {
    margin-bottom: 10px;
}
#getmultibanner_61_product .banner-img-molla61 .mb-20{
  margin-bottom:0px;
}
    }

  </style>

<div id="getmultibanner_61_loading"></div>

  <div id="getmultibanner_61_product"></div>

  <script>
    getbanner_61();
    function getbanner_61() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_61_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_61")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_61_loading').html(' ');
              jQuery('#getmultibanner_61_product').html(res);
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
  </script>
