<style>
 .trending .lazy-media {
    background-size: cover;
    background-repeat: no-repeat;
    height:470px;
}


.lazy-media {
    position: relative;
}
.trending .lazy-media:before {
    padding-top: 46.6rem;
    background-color: transparent;
}
.lazy-media:before {
    content: "";
    display: block;
    padding-top: 100%;
    width: 100%;
    background-color: #f4f4f4;
}

.trending .banner {
    position: static;
}
.banner-big {
    color: #666;
    font-size: 1.5rem;
    line-height: 1.6;
}
.trending .banner-content {
    left: 0;
    right:0;
    top: 49%;
}

.banner-subtitle{
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 1.2rem;
}
.banner-title {
    text-transform: uppercase;
    margin-bottom: 1rem;
}

.banner-subtitle {
    font-size:1rem;
}

.banner-title {
    font-size:3.55rem;
}

.btn-primary-white {
    color: #fff;
    background-color: transparent;
    border-color: #fff;
    -webkit-box-shadow: none;
    box-shadow: none;
    margin-top: 1.5rem;
    padding: 11px 30px;
    min-width: 160px;
    font-size: 1rem;
    font-weight: 400;
    border: solid 2px;
    fill: #fff;
}
.css-1b7c46 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 100ms;
    animation-name: animation-6oza6e;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
    width: 29%;
    margin: auto;
}
.trending p{
  font-size:0.9rem;
  font-weight:300 !important;
}
.btn-primary-white:hover {
    background-color: #fff;
    color: #222;
    border-color: #fff;
    fill: #222;
    text-decoration: none;
}
.ml-10{
  margin-left:10px;
}

  @media screen and (max-width: 992px){
    .css-1b7c46 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 100ms;
    animation-name: animation-6oza6e;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
    width: 100%;
    margin: auto;
}
    .trending .lazy-media {
      background-size: cover;
      background-repeat: no-repeat;
      height: 470px;
      background-position: 34%;
    }
  }

  </style>

<div id="getmultibanner_43_loading"></div>

  <div id="getmultibanner_43_product"></div>

  <script>
    getbanner_43();
    function getbanner_43() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_43_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_43")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_43_loading').html(' ');
              jQuery('#getmultibanner_43_product').html(res);
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