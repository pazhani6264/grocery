<style>
 #getmultibanner_63_product .css-16ph7t8 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 200ms;
    animation-name: animation-1ujkkqi;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
}
#getmultibanner_63_product .no-gutters {
    margin-left: 0;
    margin-right: 0;
}
#getmultibanner_63_product .no-gutters>.col, #getmultibanner_63_product .no-gutters>[class*=col-] {
    padding-left: 0;
    padding-right: 0;
}
#getmultibanner_63_product .home-page .banner-title {
      font-size: 2.85rem;
  }
#getmultibanner_63_product .lazy-media {
    position: relative;
}

#getmultibanner_63_product .btn-outline-primary-2 {
    border-bottom: solid 2px;
    border-top: none;
    border-left: none;
    border-right: none;
}
#getmultibanner_63_product .banner, #getmultibanner_63_product .banner>a {
    display: block;
    position: relative;
}
#getmultibanner_63_product .home-page .banner-group .lazy-media:before {
    padding-top: 128.2051282051%;
}
#getmultibanner_63_product .lazy-media:before {
    content: "";
    display: block;
    padding-top: 100%;
    width: 100%;
    background-color: #f4f4f4;
}
#getmultibanner_63_product .lazy-media>figure, #getmultibanner_63_product .lazy-media img {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
#getmultibanner_63_product .lazy-overlay {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: #f4f4f4;
}
#getmultibanner_63_product .lazy-media .lazy-load-image-background {
    position: static;
    display: inline!important;
}
#getmultibanner_63_product .lazy-load-image-background.lazy-load-image-loaded {
    display: inline!important;
    z-index: 2;
}
#getmultibanner_63_product .lazy-media img {
    width: 100%;
    height: 100%;
    -webkit-transition: all .3s;
    transition: all .3s;
    -webkit-object-fit: contain;
    object-fit: contain;
}
#getmultibanner_63_product .lazy-media>figure, #getmultibanner_63_product .lazy-media img {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
#getmultibanner_63_product .banner img {
    display: block;
    max-width: none;
    width: 100%;
    height: auto;
    -webkit-object-fit: contain;
    object-fit: contain;
}
#getmultibanner_63_product .bg-image {
    background-color: #789;
    background-size: contain;
    background-position: 50%;
    background-repeat: no-repeat;
}
#getmultibanner_63_product .home-page .banner-middle:before {
    content: "";
    display: block;
    width: 100%;
    padding-top: 128.2051282051%;
}
#getmultibanner_63_product .banner-big .banner-content.banner-content-center, #getmultibanner_63_product .banner-content-center.banner-content {
    max-width: none;
    left: 0;
    right: 0;
    text-align: center;
    top: 50%;
}
#getmultibanner_63_product .banner-content.banner-content-right {
    right: 7.5%;
}
#getmultibanner_63_product .banner-content.banner-content-right {
    left: auto;
    right: 30px;
}
#getmultibanner_63_product .home-page .banner-content {
    font-size: 1rem;
    max-width: 400px;
    width: 100%;
}
#getmultibanner_63_product .btn-outline-primary-2:hover {
    color: #fff !important;
    border-bottom: solid 2px transparent;
}
#getmultibanner_63_product .banner:hover .banner-content {
    outline: 0px dashed #fff;
}
#getmultibanner_63_product .home-page .btn-dark {
    padding: 0.7rem 2.4rem;
    background-color: transparent;
    border: 0.2rem solid transparent;
    border-bottom-color: #333;
    color: #333;
    min-width: 130px;
}
#getmultibanner_63_product .font-size-normal {
    font-size: 0.9rem;
}
#getmultibanner_63_product .home-page .btn-dark:hover {
    color: #fff;
    background-color: #333;
    border-color: #333;
    text-decoration: none!important;
}

#getmultibanner_63_product .home-page .banner-subtitle {
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 0rem;
}




@media screen and (min-width: 768px){
    #getmultibanner_63_product .my-md-n5 {
      margin-top: -4rem!important;
      margin-bottom: -4rem!important;
      position: relative;
      z-index: 2;
  }
}



@media only screen and (max-width: 991px){
    #getmultibanner_63_product .home-page .container {
    padding-left: 10px;
    padding-right: 10px;
  }
  #getmultibanner_63_product .home-page .banner-content.banner-content-right {
    right: auto;
    left: 62%;
    max-width: 475px;
    -webkit-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
}
#getmultibanner_63_product .home-page .banner-title {
      font-size: 2.15rem;
  }

}


  </style>

<div id="getmultibanner_63_loading"></div>

  <div id="getmultibanner_63_product"></div>

  <script>
    getbanner_63();
    function getbanner_63() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_63_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_63")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_63_loading').html(' ');
              jQuery('#getmultibanner_63_product').html(res);
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