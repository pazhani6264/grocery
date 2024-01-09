<style>
  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
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

 #getmultibannertwo_39_product .banner-content {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 0;
    right:0;
    top: 60%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}
#getmultibannertwo_39_product .home-page .banner-display .banner-link {
    bottom: auto;
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
}
#getmultibannertwo_39_product .group-banners .banner-link {
    font-size: 1.15rem;
    font-weight: 400 !important;
    display: inline-block;
    background-color: #fff;
    padding: 0.9rem 1rem;
    text-align: center;
    min-width: 154px;
    border-radius: 0.2rem;
    position: absolute;
    top: auto;
    bottom: 0;
    right: auto;
    left: 50%;
    -webkit-transform: translateX(-50%) translateY(0);
    transform: translateX(-50%) translateY(0);
    -ms-transform: translateX(-50%) translateY(0);
    overflow: hidden;
}
#getmultibannertwo_39_product .banner-title {
    color: #333;
    font-weight: 500 !important;
    font-size: 1.15rem;
    line-height: 1.3;
    margin-bottom: 1.5rem;
    letter-spacing: -.03em;
}
#getmultibannertwo_39_product .group-banners .banner-link-text {
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    transform: translateY(100%);
    -webkit-transform: translateY(100%);
}
#getmultibannertwo_39_product .mb-0, .my-0 {
    margin-bottom: 0 !important;
}

#getmultibannertwo_39_product .group-banners .banner-link:hover .banner-title {
    opacity: 0;
    transform: translateY(100%);
    -webkit-transform: translateY(100%);
}
#getmultibannertwo_39_product .group-banners .banner-link:hover .banner-link-text {
    opacity: 1;
    background-color: #c96;
    transform: translateY(0);
    -webkit-transform: translateY(0);
}
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

  </style>
<div id="getmultibannertwo_39_loading"></div>

  <div id="getmultibannertwo_39_product"></div>

  <script>
    getbanner_39();
    function getbanner_39() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_39_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_39")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_39_loading').html(' ');
              jQuery('#getmultibannertwo_39_product').html(res);
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
