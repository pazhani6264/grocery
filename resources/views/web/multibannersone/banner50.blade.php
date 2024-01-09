<style>
#getmultibannerone_50_product .demo-32-banner-50-section {
    margin-top: 0px;
    background-color: #f9fafc !important;
    padding-bottom: 70px;
    border: none !important;
}
#getmultibannerone_50_product .demo-32-banner-50-container
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
#getmultibannerone_50_product .demo-32-banner-50-row
{
  margin-right: -10px !important;
  margin-left: -10px !important;
  justify-content: center;
}

#getmultibannerone_50_product .demo-32-banner-50-right
{
  margin-right: 10px;
}
#getmultibannerone_50_product .demo-32-banner-50-left
{
  margin-left: 10px;
}
#getmultibannerone_50_product .demo-32-banner-50-col
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
#getmultibannerone_50_product .demo-32-banner-50-content {
    position: absolute;
    width: 185px;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    left: auto;
    right: 2%;
    padding: 7px 0 0 10px;
}
#getmultibannerone_50_product .demo-32-banner-50-icon {
    font-size: 14px;
    margin-left: 10px;
}
#getmultibannerone_50_product .demo-32-banner-50-btn {
   position:relative;
   font-weight: 600 !important;
}
#getmultibannerone_50_product .demo-32-banner-50-btn.hover-menu-13:before {
    height: 2px;
}

#getmultibannerone_50_product .demo-32-banner-50-btn {
    font-size: 14px;
    padding: 10px 0 !important;
   
}
#getmultibannerone_50_product .demo-32-banner-50-outer-con {
    position: relative;
    margin-bottom: 20px;
}

#getmultibannerone_50_product .demo-32-banner-50-image-outer img
{
  height: 100% !important;
}
#getmultibannerone_50_product .demo-32-banner-50-title {
    margin-bottom: 13px;
    font-size: 12px;
    line-height: 1;
    color: #000 !important;
    font-weight: 500!important;
}
#getmultibannerone_50_product .demo-32-banner-50-p1 {
    font-size: 30px;
    color: #000;
    margin-bottom: 5px;
    font-weight: 600!important;
    line-height: 1.2;
    letter-spacing: -1px;
}
#getmultibannerone_50_product .demo-32-banner-50-p {
    font-size: 30px;
    color: #000;
    margin-bottom: 16px;
    font-weight: 600!important;
    line-height: 1.2;
    letter-spacing: -1px;
    background-color: #fdda05!important;
    display: inline-block;
}
@media only screen and (max-width: 1150px)
{
  #getmultibannerone_50_product .demo-32-banner-50-image-outer
  {
      height:370px;
  }

}
@media only screen and (max-width: 991px)
{
  #getmultibannerone_50_product .demo-32-banner-52-p {
    font-size: 24px;
}

#getmultibannerone_50_product .demo-32-banner-52-btn {
    font-size: 12px;
}
#getmultibannerone_50_product .demo-32-banner-52-icon {
    font-size: 12px;
}
}
@media only screen and (max-width: 600px)
{
  

  #getmultibannerone_50_product .demo-32-banner-50-p1 {
    font-size: 20px;
}
#getmultibannerone_50_product .demo-32-banner-50-p {
    font-size: 20px;
}
#getmultibannerone_50_product .demo-32-banner-50-image-outer
  {
      height:270px;
  }
  #getmultibannerone_50_product .demo-32-banner-50-right
{
  margin-right: 0px;
}
#getmultibannerone_50_product .demo-32-banner-50-left
{
  margin-left: 0px;
}
#getmultibannerone_50_product .demo-32-banner-50-content {
    width: 150px;
    right: 6%;
}

}
  </style>
<!-- //banner 23 -->
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

  </style>

<div id="getmultibannerone_50_loading"></div>

  <div id="getmultibannerone_50_product"></div>

  <script>
    getmultibannerone_50();
    function getmultibannerone_50() {
      var type = '3'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannerone_50_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_50")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannerone_50_loading').html(' ');
              jQuery('#getmultibannerone_50_product').html(res);
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
