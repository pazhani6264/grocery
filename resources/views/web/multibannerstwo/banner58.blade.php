<style>
 #getmultibannertwo_58_product .banner-img-molla-58{
    margin-top:50px;
  }
  #getmultibannertwo_58_product .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  #getmultibannertwo_58_product .demo-20-banner-overlay:focus>a:after, #getmultibannertwo_58_product .demo-20-banner-overlay:focus>figure:after, #getmultibannertwo_58_product .demo-20-banner-overlay:hover>a:after, #getmultibannertwo_58_product .demo-20-banner-overlay:hover>figure:after {
    visibility: visible;
    opacity: 1;
}

#getmultibannertwo_58_product .demo-20-banner-overlay>a:after, #getmultibannertwo_58_product .demo-20-banner-overlay>figure:after {
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
#getmultibannertwo_58_product .banner-img-molla-58 .col-md-4{
    padding-left:10px;
    padding-right:10px;
  }
  
  #getmultibannertwo_58_product .banner-img-molla-58 .row{
    margin-left:-10px;
    margin-right:-10px;
    justify-content:center;
  }
  #getmultibannertwo_58_product  .demo-20-banner-2-subtitle {
    font-size: 1rem;
    font-weight: 400;
    color: #fff;
    text-transform: initial;
    margin-top: 0;
    margin-bottom: 0.5rem;
    letter-spacing: 0;
}

#getmultibannertwo_58_product .demo-20-banner-2-arrow-fill
{
  fill: #fff;
}
#getmultibannertwo_58_product .demo-20-banner-2-arrow-fill:hover
{
  fill: #333;
}
#getmultibannertwo_58_product .demo-20-banner-2-content-left {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 2rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    width: 60%;
}
#getmultibannertwo_58_product .banner-58-img{
    border-radius:.4rem;
  }
@media only screen and (max-width: 992px) {
  #getmultibannertwo_58_product .demo-20-banner-2-img
{
  height:240px !important;
}
#getmultibannertwo_58_product .demo-20-banner-2-content-left {
    width: 70%;
}
#getmultibannertwo_58_product  .banner-img-molla-58{
    margin-top:50px;
  }
  #getmultibannertwo_58_product .banners-content #getmultibanner_58_product .container-fluid {
    padding-left: 10px;
    padding-right: 10px;
  }
}
 
  </style>
<!-- //banner 31 -->
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

    #getmultibannertwo_58_product  .banner-subtitle {
    font-size: 1rem;
    font-weight: 400;
    color: #fff;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 0.5rem;
}
#getmultibannertwo_58_product .banner-price {
    font-size: 1.45rem;
    font-weight: 600;
    letter-spacing: -.01em;
    text-transform: initial;
    color: #fff;
    margin-bottom: 1.8rem;
}
#getmultibannertwo_58_product  a.banner-link {
    font-size: 1rem;
    letter-spacing: -.01em;
    color: #333;
    background-color: transparent;
    text-transform: uppercase;
    padding: 0.5rem 1.55rem;
    border-radius: 5px;
    -webkit-transition: all .3s;
    transition: all .3s;
    border:1px solid #fff;
}
#getmultibannertwo_58_product .banner-content-right {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    right: 2rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}
#getmultibannertwo_58_product .banner-content-left {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 2rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}
#getmultibannertwo_58_product a.banner-link:hover {
    text-decoration: none;
    color: #333 !important;
    background-color: #fff;
}


  </style>

<div id="getmultibannertwo_58_loading"></div>

  <div id="getmultibannertwo_58_product"></div>

  <script>
    getbanner_58();
    function getbanner_58() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_58_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_58")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_58_loading').html(' ');
              jQuery('#getmultibannertwo_58_product').html(res);
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