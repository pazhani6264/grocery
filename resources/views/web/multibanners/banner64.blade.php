<style>
 .trending .lazy-media {
  background-size: contain;
    background-repeat: no-repeat;
    height:100%;
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
    margin-bottom: 3rem;
}
.banner-title {
    text-transform: uppercase;
    margin-bottom: 1.5rem;
}

.banner-subtitle {
    font-size:1.15rem;
}

.banner-title {
    font-size:2.85rem;
}

#getmultibanner_64_product .btn-outline-primary-2 {
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
    border-top:0rem solid;
    border-left:0rem solid;
    border-right:0rem solid;
    border-bottom:.1rem solid;
}
.css-1b7c46 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 100ms;
    animation-name: animation-6oza6e;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
    width: 50%;
    margin: auto;
}
.trending p{
  font-size:1rem;
  font-weight:300 !important;
  line-height:2;
  margin-bottom:2rem;
}
#getmultibanner_64_product .btn-outline-primary-2:hover {
    color: #fff !important;
    border-bottom:0px solid;
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
      height: 500px;
      background-position: 34%;
    }
    .trending .banner-title {
      font-size: 2.15rem;
    }
  }

  
  @media screen and (max-width: 600px){
   
   
    .trending .lazy-media {
     
      height: 550px;
      
    }
    
  }

  </style>

<div id="getmultibanner_64_loading"></div>

  <div id="getmultibanner_64_product"></div>

  <script>
    getbanner_64();
    function getbanner_64() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_64_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_64")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_64_loading').html(' ');
              jQuery('#getmultibanner_64_product').html(res);
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