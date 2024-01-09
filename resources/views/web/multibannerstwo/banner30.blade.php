<style>
  #getmultibannertwo_30_product .banner-img-molla-30{
    margin-top:50px;
  }
  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  #getmultibannertwo_30_product .banner-30-img{
    height:560px !important;
  }
  #getmultibannertwo_30_product .banner-30-img-right{
    height:270px !important;
  }
  </style>
<!-- //banner 30 -->
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



    #getmultibannertwo_30_product .banner-hover .banner-title {
      opacity: 0;
      -webkit-transform: translateY(50px);
      transform: translateY(50px);
    }
    #getmultibannertwo_30_product .banner-hover .banner-title {
        font-weight: 600;
        font-size: 1.45rem;
        line-height: 1.25;
        margin-bottom: 0.6rem;
        letter-spacing: -.025em;
        -webkit-transition: all .35s ease;
        transition: all .35s ease;
    }
    #getmultibannertwo_30_product .banner-hover .banner-content {
      text-align: center;
      padding-top: 0;
      top: 50%;
      left: 0;
      right: 0;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
    }
    #getmultibannertwo_30_product .banner-hover:hover .banner-title {
      opacity: 1;
      -webkit-transform: translateY(0);
      transform: translateY(0);
    }

    #getmultibannertwo_30_product .banner-hover .banner-link {
      opacity: 0;
      -webkit-transform: translateY(50px);
      transform: translateY(50px);
    } 

    #getmultibannertwo_30_product .banner-hover:hover .banner-link {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
}
#getmultibannertwo_30_product .banner-image:hover .banner-content {
    padding-bottom: 0px;
}

#getmultibannertwo_30_product figure .banner-link {
    font-weight: 300;
    font-size: 0.9rem;
    line-height: 1.5;
    letter-spacing: .1em;
    color: #ebebeb;
    text-transform: uppercase;
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
    position: unset;
    min-width: 0;
    padding: 0;
}
#getmultibannertwo_30_product figure .banner-link:hover {
    color: #ebebeb;
    text-decoration: none!important;
    -webkit-box-shadow: 0 1px 0 0 #fff;
    box-shadow: 0 1px 0 0 #fff;
}
#getmultibannertwo_30_product .banner-30-rows .col-lg-12{
  padding-left:10px;
  padding-right:10px;
}
@media only screen and (max-width: 991px){

  .banners-content #getmultibannertwo_30_product .container {
      padding-left: 10px;
      padding-right: 10px;
  }
}

  </style>

<div id="getmultibannertwo_30_loading"></div>

  <div id="getmultibannertwo_30_product"></div>

  <script>
    getbanner_30();
    function getbanner_30() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_30_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_30")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_30_loading').html(' ');
              jQuery('#getmultibannertwo_30_product').html(res);
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