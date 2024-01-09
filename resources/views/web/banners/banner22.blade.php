<style>
 #getbanner_22_product .banner-img-molla-22{
    margin-top: 3.5rem;
    margin-bottom: 3rem;
  }
  #getbanner_22_product .demo-1-banner-20-icon {
    font-size: 14px;
    margin-left: 10px;
}
#getbanner_22_product .demo-1-banner-20-btn:hover {
    border-bottom: solid 2px;
}
#getbanner_22_product .demo-1-banner-20-content-w {
    position: absolute;
    width: 185px;
    top: 0;
    z-index: 2;
    left: 80px;
    bottom: 0;
    margin: auto;
    height: 150px;
}
#getbanner_22_product .col-paddings {
    padding-left: 10px !important;
    padding-right: 10px !important;
}
#getbanner_22_product .col-row {
    
    margin-right: -10px !important;
    margin-left: -10px !important;
}

#getbanner_22_product .demo-1-banner-20-content {
    position: absolute;
    width: 215px;
    top: 0;
    z-index: 2;
    left: 80px;
    bottom: 0;
    margin: auto;
    height: 150px;
}

#getbanner_22_product .demo-1-banner-20-btn {
    font-size: 14px;
    padding: 10px 0 !important;
    border-bottom: solid 2px transparent;
}
#getbanner_22_product .demo-1-banner-con {
    position: relative;
   
}
#getbanner_22_product .demo-1-banner-20-outer-2 .demo-1-banner-20-title {
    color: #ebebeb !important;
}
#getbanner_22_product .demo-1-banner-20-outer-2 .demo-1-banner-20-p {
    color: #fff;
}
#getbanner_22_product .demo-1-banner-20-outer-2 .demo-1-banner-20-p2 {
    color: #fff;
}

#getbanner_22_product .demo-1-banner-20-title {
    margin-bottom: 10px;
    font-size: 16px;
    line-height: 1;
    color: #333 !important;
    font-weight: 300!important;
}

#getbanner_22_product .demo-1-banner-20-p{
    font-size: 20px;
    color: #333;
    margin-bottom: 17px;
    font-weight: 600!important;
    line-height: 1.2;
   
}

#getbanner_22_product .demo-1-banner-20-p2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 13px;
    font-weight: 300!important;
    line-height: 1.25;
   
}
#getbanner_22_product .demo-1-banner-20-btn-new
{
  color: #333;
  fill: #333;
  padding :8px 0 !important;
  font-size: 16px;
}
#getbanner_22_product .demo-1-banner-20-btn-new:hover
{
  border-bottom:solid 1px;
}


#getbanner_22_product .demo-1-banner-20-title-w {
    margin-bottom: 10px;
    font-size: 16px;
    line-height: 1;
    color: #fff !important;
    font-weight: 300!important;
}

#getbanner_22_product .demo-1-banner-20-p-w {
    font-size: 20px;
    color: #fff;
    margin-bottom: 17px;
    font-weight: 600!important;
    line-height: 1.2;
   
}
#getbanner_22_product .d-h-100
{
  height: 305px;
}
#getbanner_22_product .d1-h-100
{
  height: 630px;
}

#getbanner_22_product .demo-1-banner-20-p2-w {
    font-size: 24px;
    color: #fff;
    margin-bottom: 13px;
    font-weight: 300!important;
    line-height: 1.25;
   
}
#getbanner_22_product .demo-1-banner-20-btn-new-w
{
  color: #fff;
  fill: #fff;
  padding :8px 0 !important;
  font-size: 16px;
}
#getbanner_22_product .demo-1-banner-20-btn-new-w:hover
{
  border-bottom:solid 1px;
}

#getbanner_22_product  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }

  @media only screen and (max-width: 992px){
    #getbanner_22_product  .demo-1-banner-20-content-w {
    height: 120px;
}

#getbanner_22_product .demo-1-banner-20-content {
    height: 120px;
}
  }

  @media only screen and (max-width: 600px){
    #getbanner_22_product .demo-1-banner-20-content-w {
    left: 50px;
}
#getbanner_22_product .d-h-100
{
  height: 100%;
}
#getbanner_22_product .d1-h-100
{
  height: 100%;
}


#getbanner_22_product .demo-1-banner-20-content {
  left: 50px;
}
  }
  </style>

<!-- //banner 22 -->
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


    #getbanner_22_product .banner-img-molla-22 .container {
      width: 1185px;
      max-width: 100%;
    }

  </style>
<div id="getbanner_22_loading"></div>

  <div id="getbanner_22_product"></div>

  <script>
    getbanner_22();
    function getbanner_22() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_22_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_22")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_22_loading').html(' ');
              jQuery('#getbanner_22_product').html(res);
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
