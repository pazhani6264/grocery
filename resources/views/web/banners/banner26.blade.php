<style>

#getbanner_26_product .banner-img-molla-26{
  margin-top:30px;
}
#getbanner_26_product .banner-img-molla-26 .tab-rows .col-padding{
    padding-left:15px !important;
    padding-right:15px !important;
  }

  #getbanner_26_product  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  #getbanner_26_product .demo-9-banner-overlay:focus>a:after, #getbanner_26_product .demo-9-banner-overlay:hover>a:after {
    visibility: visible;
    opacity: 1;
}
#getbanner_26_product .demo-9-banner-overlay, #getbanner_26_product .demo-9-banner-overlay>a {
    display: block;
    position: relative;
}
#getbanner_26_product .demo-9-banner-overlay>a:after {
    content: "";
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(51,51,51,.25);
    z-index: 1;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
}

  #getbanner_26_product  .demo-9-banner-outer .banner-content {
    max-width: 150px;
    top: auto;
    bottom: 70px;
    right: 40px;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: absolute;
    padding-top: 4px;
    z-index: 2;
    padding-bottom: 0;
    left: 3rem;
    padding-left: 0;
    padding-right: 0;
}

#getbanner_26_product .demo-9-banner-outer1 .banner-content {
    top: 70px !important;
    bottom: auto !important;
}
#getbanner_26_product .demo-9-banner-outer
{
  position: relative;
}

#getbanner_26_product .demo-9-banner-outer .banner-title {
    color: #333;
    font-weight: 500;
    border-bottom: 1px solid #fff;
    font-size: 20px;
    line-height: 1.3;
    margin-bottom: 15px;
    
}


#getbanner_26_product .demo-9-banner-outer .product-cat h4 {
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 12px;
}
#getbanner_26_product .demo-9-banner-outer .product-price h4 {
    font-size: 22px;
    font-weight: 600;
    letter-spacing: 1px;
    margin-bottom: 2px;
    line-height:1;
}
#getbanner_26_product .demo-9-banner-outer .btn.banner-link:hover {
    border: 2px solid transparent;
}
#getbanner_26_product .demo-9-banner-outer .btn.banner-link {
    font-size: 13px;
    letter-spacing: 1px;
    border: 2px solid #fff;
    min-width: 100%;
    margin-top: 25px;
    color: #fff;
    padding: 8px 14px;
    line-height: 1;
    text-transform: uppercase;
}
#getbanner_26_product .demo-9-banner-outer .product-cat {
    color: #777;
    font-weight: 300;
    font-size: 13px;
    line-height: 1.2;
 
    margin-bottom: 5px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}


#getbanner_26_product .demo-9-banner-outer .banner-bottom p{
  font-size: 22px;
    font-weight: 300;
    letter-spacing: 1px;
    margin-bottom: 1px;
    text-transform: uppercase;
    line-height:1;
}
  /* .col-padding-1{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  @media only screen and (min-width: 700px) and (max-width: 800px){
    .col-padding-1{
      padding-left:10px !important;
      padding-right:10px !important;
    }
  } */
  </style>

<!-- //banner 26 -->
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

    @media screen and (max-width: 992px){
      #getbanner_26_product  .banner-img-molla-26 .tab-rows .col-padding{
        padding-left:10px !important;
        padding-right:10px !important;
      }
    }

  </style>

<div id="getbanner_26_loading"></div>

  <div id="getbanner_26_product"></div>

  <script>
    getbanner_26();
    function getbanner_26() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_26_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_26")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_26_loading').html(' ');
              jQuery('#getbanner_26_product').html(res);
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
