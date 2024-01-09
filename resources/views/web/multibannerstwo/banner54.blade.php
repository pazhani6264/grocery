<!-- //banner four -->
<style>
  .banner-fiftyfour .container{
    width:1180px;
    max-width:100%;
  }
  .banner-fiftyfour{
    padding:30px 0px 0px 0px;
  }

  .banner-fiftyfour .info-boxes-contents .info-box .panel .fas {
    font-size: 35px;
    margin-bottom: 0;
    text-align: center;
    align-self: center;
    margin: 0px 15px 0px 0px;
}

.banner-fiftyfour .info-boxes-contents .info-box .panel .block h4 {
    font-size: 1rem;
    font-weight: 500 !important;
}

.banner-fiftyfour .info-boxes-contents .info-box .panel .block p{
  font-weight: 300 !important;
}

.banner-fiftyfour .group-banners .imagespace {
    margin-bottom: 20px;
}

.banner-fiftyfour .col-md-5{
  padding-left:10px;
  padding-right:10px;
}
.banner-fiftyfour .col-md-7{
  padding-left:10px;
  padding-right:10px;
}
.banner-fiftyfour .col-md-6{
  padding-left:10px;
  padding-right:10px;
}


.banner-content-bottom {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 2rem;
    right: 2rem;
    bottom: 0%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}

.banner-fiftyfour .banner-content {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 2rem;
    right: 2rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}


.banner-fiftyfour .banner-subtitle{
  font-size:0.9rem;
}

.banner-fiftyfour .banner-title{
  font-size:1.7rem;
}

.banner-fiftyfour .banner-titles1{
  font-size:1.5rem;
}

.banner-fiftyfour .banner-link:hover {
    color: #fff;
    text-decoration: none!important;
    -webkit-box-shadow: 0 1px 0 0 #fff;
    box-shadow: 0 1px 0 0 #fff;
}

.padding-0-banner{
  padding-left:0;
  padding-right:0;
}
.banner-margin10{
  margin-left:-10px;
  margin-right:-10px
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

  </style>

<div id="getmultibannertwo_54_loading"></div>

  <div id="getmultibannertwo_54_product"></div>

  <script>
    getbanner_54();
    function getbanner_54() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_54_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_54")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_54_loading').html(' ');
              jQuery('#getmultibannertwo_54_product').html(res);
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





