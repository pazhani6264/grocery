<!-- //banner 25 -->
<style>
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}

#getmultibannertwo_25_product .demo-5-banner-overlay:focus>a:after, #getmultibannertwo_25_product .demo-5-banner-overlay:hover>a:after {
    visibility: visible;
    opacity: 1;
}
#getmultibannertwo_25_product .demo-5-banner-overlay, #getmultibannertwo_25_product .demo-5-banner-overlay>a {
    display: block;
    position: relative;
}
#getmultibannertwo_25_product .demo-5-banner-overlay>a:after {
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


    #getmultibannertwo_25_product .demo-1-banner-20-content {
    position: absolute;
    width: 165px;
    top: 0;
    z-index: 2;
    left: 40px;
    bottom: 0;
    margin: auto 0;
    height: 150px;
    right: 0;
    text-align: left;
}
#getmultibannertwo_25_product .btn-outline-white {
    border: 1px solid;
    min-width: 140px;
    padding: 0.6rem 1.3rem !important;
    font-size: 0.9rem;
    font-weight: 400 !important;
}
#getmultibannertwo_25_product .btn-outline-white:hover {
    fill: #fff !important;
    color: #fff !important;
}


#getmultibannertwo_25_product .demo-1-banner-con {
    position: relative;
   
}


#getmultibannertwo_25_product .demo-1-banner-20-title {
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 20px;
    font-size: 13px;
    color: #777;
    letter-spacing: 1px;
    cursor:pointer;
}
#getmultibannertwo_25_product .demo-1-banner-20-p{
    font-weight: 700;
    font-size: 24px;
    line-height: 1.13;
    margin-bottom: 5px;
    letter-spacing: -.025em;
    text-transform: uppercase;
    color: #333;
    cursor: pointer;
}
#getmultibannertwo_25_product .demo-1-banner-20-p2{
    font-weight: 300;
    font-size: 22px;
    line-height: 1.13;
    margin-bottom: 40px;
    letter-spacing: -.025em;
    text-transform: uppercase;
    color: #333;
    cursor: pointer;
}
#getmultibannertwo_25_product .demo-1-banner-20-btn-new
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
#getmultibannertwo_25_product .demo-1-banner-20-btn-new:hover
{
  background:#fff;
}

    @media only screen and (max-width: 600px){
      #getmultibannertwo_25_product  .banners-content .banner-img-molla .container {
          padding-left: 10px;
          padding-right: 10px;
      }
    }

  </style>

<div id="getmultibannertwo_25_loading"></div>

  <div id="getmultibannertwo_25_product"></div>

  <script>
    getbanner_25();
    function getbanner_25() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_25_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_25")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_25_loading').html(' ');
              jQuery('#getmultibannertwo_25_product').html(res);
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
