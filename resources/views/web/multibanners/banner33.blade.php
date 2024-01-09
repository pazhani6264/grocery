<style>
  .banner-img-molla-33{
    margin-top:15px;
  }
  .container-banner-33 {
    max-width: 96%;
    width: 100%;
    margin: auto;
}
  .banner-img-molla-33 .banner-content {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 0;
    top: 50%;
    right: 0;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    text-align:center;
}
.banner-img-molla-33 .banner-title {
    flex-grow: 0.4;
    font-weight: 600;
    font-size: 40px;
    line-height: 1.25;
    letter-spacing: -.025em;
    margin-bottom: 1rem;
}
.banner-img-molla-33 .banner-title1 {
    flex-grow: 0.4;
    font-weight: 600;
    font-size: 40px;
    line-height: 1.25;
    letter-spacing: -.025em;
    margin-bottom: 0rem;
}
.banner-img-molla-33 .banner-subtitle {
    flex-grow: 0.4;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.25;
    letter-spacing: -.025em;
    margin-bottom: 0rem;
}

.banner-img-molla-33 .banner-content .btn {
    font-size: 1rem;
    color: #fff;
}

.banner-img-molla-33 .banner-group .btn {
    padding: 0.6rem 1rem;
    border-bottom: 2px solid #fff;
    -webkit-transition: color .35s,background-color .35s,border-color .35s;
    transition: color .35s,background-color .35s,border-color .35s;
}


.banner-img-molla-33  .banner-group1 .btn-outline-white {
    padding: 0.6rem 2rem;
    border: 2px solid #fff;
    font-size: 1.1rem;
    color: #fff;
}
.banner-img-molla-33  .btn-outline-white:hover, .banner-img-molla-33  .btn-outline-white:not(:disabled):not(.disabled).active, .banner-img-molla-33  .btn-outline-white:not(:disabled):not(.disabled):active, .show>.btn-outline-white.dropdown-toggle{
  color:#000;
  background:#fff;
}


.banner-img-molla-33 .banner-group .btn:focus, .banner-img-molla-33 .banner-group .btn:hover, .banner-img-molla-33 .banner-group .btn:not(:disabled):not(.disabled):active {
    color: #000 !important;
    background-color: #fff;
    text-decoration: none;
    border-color: #fff;
}



    .col-padding{
      padding-left:10px !important;
      padding-right:10px !important;
    }

    .banner-33-img-top{
      height:340px !important;
    }
    .banner-33-img-bottom{
      height:340px !important;
    }
    .banner-33-img-right{
      height:700px !important;
    }
  </style>
<!-- //banner 33 -->
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


    @media only screen and (max-width: 600px){

    .container-banner-33 {
max-width: 96%;
width: 100%;
margin: auto;
padding: 0px 10px;
}
    }

  </style>

<div id="getmultibanner_33_loading"></div>

  <div id="getmultibanner_33_product"></div>

  <script>
    getbanner_33();
    function getbanner_33() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_33_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_33")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_33_loading').html(' ');
              jQuery('#getmultibanner_33_product').html(res);
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