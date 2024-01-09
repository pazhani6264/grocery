<!-- //banner six -->
<style>
  #getbanner_62_product .btn-outline-white {
    border: 2px solid;
    min-width: 140px;
    padding: 0.6rem 1.3rem !important;
    font-size: 0.9rem;
    font-weight: 400 !important;
    border-radius: 5px;
}
#getbanner_62_product .btn-outline-white:hover, #getbanner_62_product .btn-outline-white:not(:disabled):not(.disabled).active, #getbanner_62_product .btn-outline-white:not(:disabled):not(.disabled):active, .show>.btn-outline-white.dropdown-toggle {
    color: #000 !important;
    border: solid 2px transparent !important;
}
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}
.demo-24-banner-62-h
{
  height: 300px;
}
.demo-24-banner-62-h-1
{
  height: 600px;
}
.demo-24-banner-62-h-1 img
{
  object-fit: cover;
}
.demo-24-banner-62-h img
{
  object-fit: cover;
}
.demo-62-lazy-overlay {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: #f4f4f4;
}
 .demo-62-banner-overlay>a:after, .demo-62-banner-overlay>figure:after {
    z-index: 0 !important;
}
.demo-62-banner-overlay:focus>a:after, .demo-62-banner-overlay:focus>figure:after, .demo-62-banner-overlay:hover>a:after, .demo-62-banner-overlay:hover>figure:after {
    visibility: visible;
    opacity: 1;
}

.demo-62-banner-overlay>a:after, .demo-62-banner-overlay>figure:after {
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
    .banner62 .col-md-6{
      padding-right: 0px;
      padding-left: 0px;
    }

    .banner62  .ban-row  .row{
      margin-left:0px;
    }





    .banner-sm, .banners.stretch .banner-lg {
    padding: 0;
}
.banner-lg, .banner-sm {
    position: relative;
}
.banners.stretch .banner-lg .intro62 {
    left: 50%;
    -webkit-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
}
.banners.stretch .intro62 {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    text-align:center;
}
.banners.stretch .banner-lg .title {
    margin-bottom: 0.5rem;
}
.banners.stretch .banner-lg .title h3 {
    font-size: 2.15rem;
    font-weight: 700;
    letter-spacing: 0;
    text-transform: none;
    color:#fff;
}
.banners.stretch .banner-lg .content h4 {
    font-size: 3.6rem;
    margin-bottom: 1rem;
}
.banners.stretch .content h4 {

    letter-spacing: -.01em;
    text-transform: uppercase;
    line-height: 1.2em;
    color:#fff;
}
.banners.stretch .banner-lg p {
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 0;
    color: #e7e6ea;
}


.banner-sm.font-black .intro62 {
    left: 3rem;
}

.banner-sm-div .intro62 {
    padding-top: 0.65rem;
    padding-bottom: 1.3rem;
}
.banner-sm.font-black .content h4 {
    color: #222;
}

.banner-sm.font-white .intro62 {
    right: 3rem;
}

.banner-sm-div .intro62 {
    padding-top: 0.65rem;
    padding-bottom: 1.3rem;
}

.banner-sm-div .intro62 .title h3{
  font-size:.9rem;
}
.banner-sm-div .intro62 .content h4{
  font-size:2.15rem;
}

@media only screen and (max-width: 600px){

  .banners-content #getmultibanner_62_product .group-banners .banner-image {
      margin-bottom: 0px !important;
  }
  .banner-sm .mar-top-mobile {
    margin-top: 0px !important;
}
}

  </style>


<div id="getbanner_62_loading"></div>

  <div id="getbanner_62_product"></div>

  <script>
    getbanner_62();
    function getbanner_62() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_62_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_62")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_62_loading').html(' ');
              jQuery('#getbanner_62_product').html(res);
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