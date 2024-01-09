<style>
  #getmultibanner_57_product .banner-img-molla-57{
    margin-top:20px;
  }
  #getmultibanner_57_product .col-padding-57{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  #getmultibanner_57_product .banner-content {
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
#getmultibanner_57_product a.banner-link:hover {
    text-decoration: none;
    color: #333 !important;
    background-color: #fff !important;
}
#getmultibanner_57_product .demo-20-banner-2-arrow-fill:hover {
    fill: #333;
}
#getmultibanner_57_product .demo-20-banner-2-arrow-fill {
    fill: #fff;
}
  #getmultibanner_57_product .banner-30-img{
    height:560px !important;
  }
  #getmultibanner_57_product .banner-30-img-right{
    height:270px !important;
  }
  </style>
<!-- //banner 30 -->
<style>
  #getmultibanner_57_product .banner-57-row{
    margin-left:-10px;
    margin-right:-10px;
  }
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

    #getmultibanner_57_product .banner-img-molla-57 .banner-subtitle {
    font-size: 1rem;
    font-weight: 300;
    color: #fff;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 0.5rem;
}
#getmultibanner_57_product .demo-20-banner-1-content-1
{
  width: 50%;
}
#getmultibanner_57_product .banner-img-molla-57 .banner-title {
    font-size: 40px;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 30px;
}
#getmultibanner_57_product .banner-img-molla-57 .banner-title2 {
    font-size: 24px;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 30px;
}
#getmultibanner_57_product .banner-img-molla-57 a.banner-link {
    font-size: 1rem;
    letter-spacing: -.01em;
    color: #fff;
    background-color: transparent;
    text-transform: uppercase;
    padding: 0.5rem 1.55rem;
    border-radius: 5px;
    -webkit-transition: all .3s;
    transition: all .3s;
    border: 1px solid #fff;
}
#getmultibanner_57_product .demo-20-banner-1-con-2
{
  width:70%;
}
.demo-20-banner-overlay:focus>a:after, .demo-20-banner-overlay:focus>figure:after, .demo-20-banner-overlay:hover>a:after, .demo-20-banner-overlay:hover>figure:after {
    visibility: visible;
    opacity: 1;
}

.demo-20-banner-overlay>a:after, .demo-20-banner-overlay>figure:after {
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

#getmultibanner_57_product .banner-content.banner-content-stretch {
    top: 3rem;
    bottom: 5rem;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    padding-bottom: 4rem;
 
}
.banner-content.banner-content-stretch .banner-link {
    position: absolute;
    bottom: 0;
    left: 0;
}
@media only screen and (max-width: 991px){
  #getmultibanner_57_product  .banner-img-molla-57 .banner-title {
    font-size: 30px;
}
#getmultibanner_57_product  .banner-img-molla-57 {
    margin-top: 0px;
  }
  .banners-content #getmultibanner_57_product .group-banners .banner-image {
    margin-bottom: 0px;
  }
  .banners-content #getmultibanner_57_product .container-fluid {
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
  #getmultibanner_57_product  .col-padding-57 {
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
}

@media only screen and (max-width: 600px){
  #getmultibanner_57_product .banner-img-molla-57 .banner-title {
    font-size: 24px;
}
#getmultibanner_57_product .demo-20-banner-1-content-1
{
  width: 70%;
}
}

  </style>

<div id="getmultibanner_57_loading"></div>

  <div id="getmultibanner_57_product"></div>

  <script>
    getbanner_57();
    function getbanner_57() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_57_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_57")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_57_loading').html(' ');
              jQuery('#getmultibanner_57_product').html(res);
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