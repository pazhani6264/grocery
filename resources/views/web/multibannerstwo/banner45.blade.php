<style>
.demo-33-banner-45-section
{
  margin-top: 65px;
  margin-bottom: 41px;

}
.demo-33-banner-45-container
{
  padding-left:10px !important;
  padding-right:10px !important;
}
.demo-33-banner-45-row
{
  display: flex;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}
.demo-33-banner-45-col-padding
{
  padding-left:10px !important;
  padding-right:10px !important;
}
.demo-33-banner-45-banner-image
{
 width: 58em !important;

}
.demo-33-banner-45-content {
    position: absolute;
    top: 100px;
    left: 100px;
}
.demo-33-banner-45-left-title
{
  font-size: 50px;
  font-weight: 500 !important;
}
.demo-33-banner-45-heading
{
  font-size: 50px;
  font-weight: 400;
  margin-bottom: 32px;
  color: #222!important;
  line-height: 1;
}
.demo-33-banner-45-right-outer
{
  padding-top: 100px;
  margin-right: 30px; 
}

.demo-33-banner-45-right-btn  {
    border-bottom: 2px solid #222;
    padding: 10px 0;
    vertical-align: middle;
    text-align: center;
    font-size: 14px;
}
.demo-33-banner-45-right-btn-outer  {
    text-align: center;
    margin-top:10px;
}
.demo-33-banner-45-icon {
    font-size: 16px;
    margin-left: 10px;
}

.demo-33-banner-45-left-btn-outer
{
  position: absolute;
  bottom: 50px;
    left: 45%;
    right: 0;
}
.demo-33-banner-45-left-btn  {
    border-bottom: 2px solid #222;
    padding: 10px 0;
    vertical-align: middle;
    text-align: center;
    font-size: 14px;
}
  .banner-img-molla-44 hr {
    margin-top: 0rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.banner-title1{
  font-size:22px;
  text-transform:uppercase;
  margin-bottom:1rem;
}
.banner-title1 a{
  font-weight:700 !important;
}

.banner-subtitle1 a{
  font-size:1rem;
  text-transform:uppercase;
  font-weight:300 !important;
  color:#777;
}
.ml-10{
  margin-left:10px
}
.btn-outline-white{
  border:1px solid #eea287;
  min-width: 140px;
  padding: 0.6rem 1.3rem !important;
  font-size:0.9rem;
  font-weight:400 !important;
  color:#eea287;
}
.btn-outline-white:hover{
  background-color:#eea287;
  color:#fff;
}

.banner-content1 {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 3rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}

@media only screen and (max-width: 1100px) and (min-width: 800px){

.banner-img-molla-44 .col-padding {
    padding-left: 10px !important;
    padding-right: 10px !important;
}
.banner-img-molla-44 .container {
  padding-left: 10px !important;
  padding-right: 10px !important;
}
}


@media only screen and (max-width: 800px) and (min-width: 700px){

  .banner-img-molla-44 .col-padding {
      padding-left: 10px !important;
      padding-right: 10px !important;
  }
  .banner-img-molla-44 .container {
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
}

@media only screen and (max-width: 600px){

  .banner-img-molla-44 hr {
      margin-top: 1.5rem;
      margin-bottom: 0rem;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  .banner-img-molla-44 .col-padding {
      padding-left: 10px !important;
      padding-right: 10px !important;
  }
  .banner-img-molla-44 .container {
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
  .banner-img-molla-44 {
    margin-bottom: 2rem;
    margin-top: 20px !important;
  }

  .banner-img-molla-44  .d-none {
    display: block !important;
  }
  .banners-content .banner-img-molla-44 .group-banners .banner-image {
    margin-bottom: 0px;
}

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
  </style>
<!-- //banner 23 -->
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

<div id="getmultibannertwo_45_loading"></div>

  <div id="getmultibannertwo_45_product"></div>

  <script>
    getbanner_45();
    function getbanner_45() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_45_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_45")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_45_loading').html(' ');
              jQuery('#getmultibannertwo_45_product').html(res);
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
