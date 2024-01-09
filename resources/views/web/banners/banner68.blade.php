<style>

.banner:hover .banner-content {
    outline: 0px dashed #fff;
}
.playtime-section-new {
    margin-top: -9rem;
}
.mb-4 {
    margin-bottom: 4rem!important;
}
.home-page-banner68 .banner, .home-page-banner68 figure {
    margin-bottom: 0;
    background: transparent;
}
.banner, .banner>a {
    display: block;
    position: relative;
}
.home-page-banner68 .banner, .home-page-banner68 figure {
    margin-bottom: 0;
    background: transparent;
}
.lazy-load-image-background.lazy-load-image-loaded {
    display: inline!important;
    z-index: 2;
}
.lazy-load-image-background {
    position: relative;
    width: 100%;
    z-index: -1;
}
.playtime-section .banner img {
    min-height: 790px;
    -webkit-object-fit: cover;
    object-fit: cover;
}
.home-page-banner68 .banner img {
    width: auto;
    max-width: 100%;
}
.banner img {
    display: block;
    max-width: none;
    width: 100%;
    height: auto;
    -webkit-object-fit: cover;
    object-fit: cover;
}
.home-page-banner68 .banner .banner-content {
    left: 19%;
    top: 58%;
    width: auto;
    padding: 1rem;
    max-width: 500px;

}
.banner-content {
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
.home-page-banner68 .banner .banner-subtitle {
    font-size: 1.7rem;
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: -.025em;
    color: #222;
    margin-bottom: 0.5rem;
}
.home-page-banner68 .banner .banner-title {
    font-size: 4.3rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    color: #222;
}
.home-page-banner68 .banner .banner-text {
    font-size: 1.15rem;
    font-weight: 400;
    letter-spacing: -.01em;
    color: #666;
    margin-bottom: 2.4rem;
}
.mt-4 {
    margin-top: 4rem!important;
}
.home-page-banner68 .info-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    width: 7.2rem;
    height: 7.2rem;
    border: 1px dashed #1e1f20;
    border-radius: 6px;
    color: #222;
    -webkit-transition: all .2s ease;
    transition: all .2s ease;
}
.home-page-banner68 .info-box p {
    color: inherit;
    font-size: 1rem;
    font-weight: 400;
    letter-spacing: -.01em;
    line-height: 1;
    text-transform: uppercase;
    margin-bottom:0;
}
.home-page-banner68 .info-box strong {
    font-size: 3rem;
    font-weight: 700;
    letter-spacing: -.025em;
    line-height: 1.3;
}
.home-page-banner68 .info-box+.info-box {
    margin-left: 2rem;
}
.home-page-banner68 .info-box:hover {
    color: #fff;
    background-color: #222;
}









@media screen and (min-width: 992px){
  .banner-content {
      left: 4rem;
  }
}
@media screen and (min-width: 768px){
  .banner-content {
      left: 3rem;
  }
}

@media only screen and (min-width: 700px) and (max-width: 800px){

.gallery .content-left {
    padding: 0 14% 0 17.3% !important;
}
}

@media screen and (max-width: 768px){

    .home-page-banner68 .banner .banner-content {
        left: 4%;
        top: 58%;
        width: auto;
        padding: 1rem;
        max-width: 500px;
    }

    .home-page-banner68 .banner .banner-title {
    font-size: 3rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    color: #222;
}
}
  
  </style>

<div id="getbanner_68_loading"></div>

  <div id="getbanner_68_product"></div>

  <script>
    getbanner_68();
    function getbanner_68() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_68_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_68")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_68_loading').html(' ');
              jQuery('#getbanner_68_product').html(res);
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