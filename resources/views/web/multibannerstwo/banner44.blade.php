<style>

#getmultibannertwo_44_product .banner-img-molla-44{
  margin-bottom:2rem;
}
#getmultibannertwo_44_product .banner-img-molla-44 .container {
    width: 1185px;
    max-width: 100%;
    padding-right: 10px;
    padding-left: 10px;
}
.demo-44-banner-overlay:focus:after, .demo-44-banner-overlay:hover:after {
    visibility: visible;
    opacity: 1;
}
.demo-44-banner-overlay:after {
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
#getmultibannertwo_44_product .banner-img-molla-44 .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}
#getmultibannertwo_44_product  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }

  #getmultibannertwo_44_product  .banner-img-molla-44 hr {
    margin-top: 0rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

#getmultibannertwo_44_product .banner-title1{
  font-size:22px;
  text-transform:uppercase;
  margin-bottom:1rem;
}
#getmultibannertwo_44_product .banner-title1 a{
  font-weight:700 !important;
}

#getmultibannertwo_44_product .banner-subtitle1 a{
  font-size:1rem;
  text-transform:uppercase;
  font-weight:300 !important;
  color:#777;
}
#getmultibannertwo_44_product .ml-10{
  margin-left:10px
}
#getmultibannertwo_44_product .btn-outline-white{
  border:1px solid;
  min-width: 140px;
  padding: 0.6rem 1.3rem !important;
  font-size:0.9rem;
  font-weight:400 !important;
}
#getmultibannertwo_44_product .btn-outline-white:hover{
  color: #fff !important;
  fill: #fff !important;
}

#getmultibannertwo_44_product .banner-content1 {
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

  #getmultibannertwo_44_product .banner-img-molla-44 .col-padding {
    padding-left: 10px !important;
    padding-right: 10px !important;
}
#getmultibannertwo_44_product .banner-img-molla-44 .container {
  padding-left: 10px !important;
  padding-right: 10px !important;
}
}


@media only screen and (max-width: 800px) and (min-width: 700px){

  #getmultibannertwo_44_product  .banner-img-molla-44 .col-padding {
      padding-left: 10px !important;
      padding-right: 10px !important;
  }
  #getmultibannertwo_44_product .banner-img-molla-44 .container {
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
}

@media only screen and (max-width: 600px){

  #getmultibannertwo_44_product .banner-img-molla-44 hr {
      margin-top: 1.5rem;
      margin-bottom: 0rem;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  #getmultibannertwo_44_product .banner-img-molla-44 .col-padding {
      padding-left: 10px !important;
      padding-right: 10px !important;
  }
  #getmultibannertwo_44_product .banner-img-molla-44 .container {
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
  #getmultibannertwo_44_product .banner-img-molla-44 {
    margin-bottom: 2rem;
    margin-top: 20px !important;
  }

  #getmultibannertwo_44_product .banner-img-molla-44  .d-none {
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

<div id="getmultibannertwo_44_loading"></div>

  <div id="getmultibannertwo_44_product"></div>

  <script>
    getbanner_44();
    function getbanner_44() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_44_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_44")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_44_loading').html(' ');
              jQuery('#getmultibannertwo_44_product').html(res);
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
