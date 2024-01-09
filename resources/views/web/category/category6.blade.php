<style>

.category6{
  margin-top:30px;
}
.category6 .tab-rows .col-padding{
    padding-left:15px !important;
    padding-right:15px !important;
  }

  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
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

<!-- //banner 26 -->
<style>
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}

.demo-12-cat-6 .title {
    font-weight: 600;
    display: block !important;
    font-size: 20px;
    letter-spacing: 1px;
    margin-bottom: 7px;
}
.demo-12-cat-6 .heading {
    margin-bottom: 40px;
    text-align: center;
}
.demo-12-cat-6 .title-desc {
    color: #777;
    font-weight: 300;
    font-size: 14px;
    line-height: 1.5;
    letter-spacing: 1px;
    margin-bottom: 0;
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

    #getcategory6_product figure .banner-content {
      -webkit-transition: all .3s ease;
      transition: all .3s ease;
    }
    .banner-big .banner-content.banner-content-center, .banner-content-center.banner-content {
    max-width: none;
    left: 0;
    right: 0;
    text-align: center;
}
#getcategory6_product .banner-content {
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
#getcategory6_product .banner-image:hover .banner-content {
    padding-bottom: 40px;
}
#getcategory6_product .banner-title.text-white a {
    color: #fff;
    font-weight: 600 !important;
    font-size: 1.15rem;
    letter-spacing: -.025em;
}


#getcategory6_product .banner-subtitle.text-white a {
    color: #fff;
    font-weight: 300 !important;
    font-size: 1rem;
    letter-spacing: 0;
    margin-bottom: 0.5rem;
    margin-top: 0;
}

.category6 .banner-overlay .btn.banner-link {
    text-transform: none;
    min-width: 126px;
}
#getcategory6_product figure .banner-content-center .banner-link {
    left: 50%;
    -webkit-transform: translateY(-20px) translateX(-50%);
    transform: translateY(-20px) translateX(-50%);
    -ms-transform: translateY(-20px) translateX(-50%);
}
#getcategory6_product figure .banner-link {
    opacity: 0;
    position: absolute;
    bottom: 0;
    left: 0;
    min-width: 130px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    -webkit-transform: translateY(-20px);
    transform: translateY(-20px);
    -ms-transform: translateY(-20px);
}
#getcategory6_product .btn.banner-link {
    font-size: 1rem;
    line-height: 1;
    padding: 0.6rem 1.4rem;
    min-width: 0;
    text-transform: initial;
    text-decoration: none!important;
}
.category6 .banner-overlay .btn.banner-link {
    text-transform: none;
    min-width: 126px;
}
#getcategory6_product figure:hover .banner-content-center .banner-link {
    -webkit-transform: translateY(0) translateX(-50%);
    transform: translateY(0) translateX(-50%);
    -ms-transform: translateY(0) translateX(-50%);
}
#getcategory6_product figure:hover .banner-link {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -ms-transform: translateY(0);
}
#getcategory6_product figure .banner-link {
    opacity: 0;
    position: absolute;
    bottom: 0;
    left: 0;
    min-width: 130px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    -webkit-transform: translateY(-20px);
    transform: translateY(-20px);
    -ms-transform: translateY(-20px);
}
.category6 .banner-overlay .btn.banner-link {
    text-transform: none;
    min-width: 126px;
}


#getcategory6_product .btn-outline-white {
    color: #fff;
    background-color: transparent;
    background-image: none;
    border-color: #fff;
    -webkit-box-shadow: none;
    box-shadow: none;
}



    @media screen and (max-width: 992px){
      .category6 .tab-rows .col-padding{
        padding-left:10px !important;
        padding-right:10px !important;
      }
    }

  </style>

<div id="getcategory6_loading"></div>

  <div id="getcategory6_product"></div>

  <script>
    getallproductBycategory6();
    function getallproductBycategory6() {
      var type = 'category_section'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory6_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory6")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcategory6_loading').html(' ');
              jQuery('#getcategory6_product').html(res);
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
