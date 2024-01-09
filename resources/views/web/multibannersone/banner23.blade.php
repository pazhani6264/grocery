<style>
#getmultibannerone_23_product .demo-5-banner-overlay:focus>a:after, #getmultibannerone_23_product .demo-5-banner-overlay:hover>a:after {
    visibility: visible;
    opacity: 1;
}
#getmultibannerone_23_product .demo-5-banner-overlay, .demo-5-banner-overlay>a {
    display: block;
    position: relative;
}
#getmultibannerone_23_product .demo-5-banner-overlay>a:after {
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

#getmultibannerone_23_product .banner-img-molla-23{
  margin-bottom:2rem;
}
#getmultibannerone_23_product .banner-img-molla-23 .container {
    width: 1190px;
    max-width: 100%;
}

#getmultibannerone_23_product .banner-img-molla-23 .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}
#getmultibannerone_23_product  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }

  #getmultibannerone_23_product  .banner-img-molla-23 hr {
    margin-top: 0rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}


#getmultibannerone_23_product .demo-1-banner-20-content {
    position: absolute;
    width: 200px;
    top: 0;
    z-index: 2;
    left: 0;
    bottom: 0;
    margin: auto;
    height: 150px;
    right: 0;
    text-align: center;
}


#getmultibannerone_23_product .demo-1-banner-con {
    position: relative;
   
}


#getmultibannerone_23_product .demo-1-banner-20-title {
    font-weight: 400;
    font-size: 13px;
    color: #fff;
    margin-bottom: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor:pointer;
}
#getmultibannerone_23_product .demo-1-banner-20-p{
    font-weight: 600;
    font-size: 24px;
    line-height: 1.13;
    margin-bottom: 26px;
    letter-spacing: -.025em;
    text-transform: uppercase;
    color: #fff;
    cursor: pointer;
}

#getmultibannerone_23_product .demo-1-banner-20-btn-new
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
#getmultibannerone_23_product .demo-1-banner-20-btn-new:hover
{
  background:#fff;
}
@media only screen and (max-width: 1100px) and (min-width: 800px){

  #getmultibannerone_23_product .banner-img-molla-23 .col-padding {
    padding-left: 10px !important;
    padding-right: 10px !important;
}
#getmultibannerone_23_product .banner-img-molla-23 .container {
  padding-left: 10px !important;
  padding-right: 10px !important;
}
}


@media only screen and (max-width: 800px) and (min-width: 700px){

  #getmultibannerone_23_product .banner-img-molla-23 .col-padding {
      padding-left: 10px !important;
      padding-right: 10px !important;
  }
  #getmultibannerone_23_product .banner-img-molla-23 .container {
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
}

@media only screen and (max-width: 600px){

  #getmultibannerone_23_product .banner-img-molla-23 hr {
      margin-top: 1.5rem;
      margin-bottom: 0rem;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  #getmultibannerone_23_product .banner-img-molla-23 .col-padding {
      padding-left: 10px !important;
      padding-right: 10px !important;
  }
  #getmultibannerone_23_product .banner-img-molla-23 .container {
    padding-left: 10px !important;
    padding-right: 10px !important;
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


<div id="getmultibannerone_23_loading"></div>

  <div id="getmultibannerone_23_product"></div>

  <script>
    getmultibannerone_23();
    function getmultibannerone_23() {
      var type = '3'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannerone_23_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_23")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannerone_23_loading').html(' ');
              jQuery('#getmultibannerone_23_product').html(res);
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
