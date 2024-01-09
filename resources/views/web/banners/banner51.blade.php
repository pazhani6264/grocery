<style>
 #getbanner_51_product .banner-img-molla-51 .col-lg-6{
    padding-left:5px;
    padding-right:5px;
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

    .col-12tn{
        display:none;
      }
  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  #getbanner_51_product .banner-img-molla-51 .banner-image{
    border-radius:0.3rem !important;
  }
  #getbanner_51_product .banner-51-img{
    height:260px !important;
    border-radius:0.3rem;
  }
  #getbanner_51_product .banner-img-molla-51 .row{
    margin-right: -12px;
    margin-left: -12px;
  }

  #getbanner_51_product .banner-content51 {
    display: flex;
    flex-direction: column;
    padding-top: 0;
    top: 30px;
    left: 30px;
    bottom: 32px;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    position:absolute;
}
#getbanner_51_product .banner-content51-2 {
  width: 50% !important;
}
#getbanner_51_product .banner-content51 .banner-subtitle {
    font-weight: 300;
    font-size: 1rem;
    letter-spacing: 1px;
    margin-bottom: 12px;
    
  }
  #getbanner_51_product .banner-content51 .banner-subtitle a{
    color:#fff !important;
    line-height: 1.25;
  }
  #getbanner_51_product .banner-content51 .banner-title {
    flex-grow: 1;
    font-weight: 600;
    font-size: 24px;
    line-height: 1.25;
    letter-spacing: 1px;
    margin-bottom: 5px;
}
#getbanner_51_product .banner-content51 .banner-title a{
    color:#fff !important;
    line-height: 1.25;
  }
  #getbanner_51_product .banner-content51 .banner-link.banner-link-dark:not(:hover):not(:focus) {
    background-color: rgba(51,51,51,.2);
}
#getbanner_51_product .banner-content51 .banner-link {
    align-self: flex-start;
    width: auto;
    color: #fff;
    fill: #fff;
    font-weight: 400 !important;
    font-size: 1rem;
    line-height: 1.4;
    letter-spacing: -.01em;
    border-radius: 0.3rem;
    padding: 0.55rem 1rem;
    background-color: hwb(0deg 100% 0% / 20%);
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
    border: none;
    text-transform: none;
}
#getbanner_51_product .banner-content51 .banner-link:hover {
    color: #333;
    fill: #333;
    text-decoration: none!important;
    background-color: #fff;
}

@media only screen and (max-width: 992px){
  #getbanner_51_product .banner-content51 {
  width: 50%;
}
#getbanner_51_product .banner-content51 .banner-title {
    font-size: 20px;
  
}
#getbanner_51_product .col-6dtn{
        display:none;
      }
      #getbanner_51_product  .col-12tn{
        display:block;
      }
}

@media only screen and (max-width: 600px){
  #getbanner_51_product .banner-content51 {
  width: 50%;
  left:10px;
  top:10px;
}
#getbanner_51_product .banner-content51-2 {
  width: 100% !important;
}
#getbanner_51_product .banner-sub-hide
{
  display: none;
}
#getbanner_51_product .banner-content51 .banner-title {
    flex-grow: 0;
}

}


 
  </style>
<!-- //banner 31 -->
<style>


    @media only screen and (max-width: 992px){
      #getbanner_51_product .banner-img-molla-51 .col-lg-3 {
        position: relative;
        width: 100%;
        padding-right: 5px !important;
        padding-left: 5px !important;
      }
      #getbanner_51_product .banners-content .banner-img-molla-51 .group-banners .banner-image{
        margin-bottom:0px;
      }
      #getbanner_51_product .banners-content .banner-img-molla-51 .group-banners .imagespace{
        margin-bottom:0px !important;
      }
    }

    @media only screen and (min-width: 700px) and (max-width: 800px){
     
      #getbanner_51_product .colsm4 {
        flex: 0 0 50%;
        max-width: 50%;
      }
      #getbanner_51_product .banner-img-molla-51 .colsm4 {
        position: relative;
        width: 100%;
        padding-right: 10px !important;
        padding-left: 10px !important;
      }
    }

    @media only screen and (max-width: 600px){
    
     
    }
  </style>

<div id="getbanner_51_loading"></div>

  <div id="getbanner_51_product"></div>

  <script>
    getbanner_51();
    function getbanner_51() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_51_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_51")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_51_loading').html(' ');
              jQuery('#getbanner_51_product').html(res);
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