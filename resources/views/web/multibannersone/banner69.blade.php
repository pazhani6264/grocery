<style>
#getmultibannerone_69_product .css-16ph7t8 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 200ms;
    animation-name: animation-1ujkkqi;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
}
#getmultibannerone_69_product.gallery {
    background-repeat: no-repeat;
}
#getmultibannerone_69_product .bg-transparent {
    background-color: transparent!important;
}

#getmultibannerone_69_product .gallery .content-left {
    padding: 0 14% 0 1.3%;
}
#getmultibannerone_69_product .mt-3 {
    margin-top: 30px !important;
}
#getmultibannerone_69_product .heading {
    margin-bottom: 16px;
}
#getmultibannerone_69_product .home-page-ban69 .heading .subtitle {
    font-size: 24px;
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: -.025em;
    color: #222;
    margin-bottom: 10px;
}
#getmultibannerone_69_product .home-page-ban69 .heading .title {
    font-size: 60px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    color: #222;
    margin-bottom: 20px !important;
}
#getmultibannerone_69_product .home-page-ban69 .heading .content {
    font-size: 16px;
    font-weight: 400;
    line-height: 1.9;
    letter-spacing: -.01em;
}
.#getmultibannerone_69_product gallery .heading p {
    color: #666;
}
#getmultibannerone_69_product .mb-6 {
    margin-bottom: 60px !important;
}
#getmultibannerone_69_product .gallery .lazy-media.media-1:before {
    padding-top: 112.3%;
}
/* .lazy-media:before {
    content: "";
    display: block;
    padding-top: 100%;
    width: 100%;
    background-color: #f4f4f4;
} */
#getmultibannerone_69_product .lazy-media .lazy-load-image-background {
    position: static;
    display: inline!important;
}
#getmultibannerone_69_product .lazy-load-image-background.lazy-load-image-loaded {
    display: inline!important;
    z-index: 2;
}
#getmultibannerone_69_product .lazy-load-image-background {
    position: relative;
    width: 100%;
    z-index: -1;
}

/* .lazy-media>figure, .lazy-media img {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
} */
#getmultibannerone_69_product .lazy-media img {
    width: 100%;
    height: 100%;
    -webkit-transition: all .3s;
    transition: all .3s;
    -webkit-object-fit: cover;
    object-fit: contain;
}
#getmultibannerone_69_product .home-page-ban69 .banner, .home-page-ban69 figure {
    margin-bottom: 0;
    background: transparent;
}
#getmultibannerone_69_product .gallery .lazy-media.media-2:before {
    padding-top: 90.17%;
}








@media screen and (min-width: 992px){
    #getmultibannerone_69_product  .pt-lg-10 {
      padding-top: 100px !important;
  }
}

@media screen and (min-width: 768px){
    #getmultibannerone_69_product .gallery .lazy-media.media-1 {
      max-width: 472px;
  }
  #getmultibannerone_69_product .gallery .content-right {
    margin-left: -10px;
  }
  #getmultibannerone_69_product .gallery .lazy-media.media-2 {
    max-width: 590px;
}
#getmultibannerone_69_product .mb-md-12 {
    margin-bottom: 120px !important;
}
#getmultibannerone_69_product .gallery .lazy-media.media-3 {
    max-width: 471px;
}
}


@media screen and (max-width: 768px){

    #getmultibannerone_69_product .home-page-ban69 .heading .title {
        font-size: 42px;
        font-weight: 700;
        line-height: 1;
        letter-spacing: -.025em;
        color: #222;
    }

    #getmultibannerone_69_product .home-page-ban69 .heading .subtitle {
        font-size: 21px;
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: -.025em;
        color: #222;
        margin-bottom: 10px;
    }
    #getmultibannerone_69_product .mb-md-12 {
    margin-bottom: 120px !important;
}
#getmultibannerone_69_product .home-page-ban69 .col-md-6{
        padding-left:10px !important;
        padding-right:10px !important;
    }
    #getmultibannerone_69_product .media-1{
        margin-bottom:15px !important;
    }
}
@media screen and (max-width: 600px){


    #getmultibannerone_69_product .mb-md-12 {
margin-bottom: 15px !important;
}
#getmultibannerone_69_product .gallery .content-left {
     padding: 0; 
}

}

</style>






<div id="getmultibannerone_69_loading"></div>

  <div id="getmultibannerone_69_product"></div>

  <script>
    getbanner_69();
    function getbanner_69() {
      var type = '3'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannerone_69_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_69")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannerone_69_loading').html(' ');
              jQuery('#getmultibannerone_69_product').html(res);
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