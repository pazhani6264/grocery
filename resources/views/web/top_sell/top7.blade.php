
<style>
    .mt50sp{
        margin-top:50px;
    }
    .top7{
        margin-top:66px;
    }
    .top7 .subtitle {
    font-weight: 400;
    font-size: 1.15rem;
    letter-spacing: -0.025em;
    margin-bottom: 1.3rem;
}
.banner-title{
    font-weight: 600;
    font-size: 30px;
    letter-spacing: -.025em;
    margin-bottom: 1.3rem;
    max-width: 265px;
}
.banner-title a{
    line-height: 1.2;
    font-weight:600 !important;
}
.top7 .heading .title {
    margin-bottom: 1.5rem;
    display:block;
    font-size:2.15rem;
    text-transform:initial;
}
 .title-desc {
    font-size: 1.6rem;
    color: rgb(102, 102, 102);
    line-height: 1.7em;
    letter-spacing: -0.01em;
    margin-bottom: 0px;
}
.banner-overlay > a {
    position: relative;
}

.banner-main .banner-content {
    display: block;
    width: 100%;
    transform: translateY(0px);
    position: relative;
    left: auto;
    right: auto;
    top: 0px;
    bottom: auto;
    background-color: rgb(255, 255, 255);
    padding: 3rem;
}

.products-display .heading {
    margin-bottom: 4.3rem;
}
.banner-main .banner-content.right {
    padding-left: 5.3rem;
}

.banner-main-reverse .banner-content {
    float: right;
}

@media screen and (min-width: 1200px){
    .banner-main .banner-content {
        padding-left: 8rem;
        padding-right: 8rem;
    }
    .banner-main .banner-content {
        padding-left: 8rem;
        padding-right: 8rem;
    }
}

@media (min-width: 992px){
    .order-lg-first {
        order: -1;
    }
    .products-display .display-products-col {
        margin-top: 7.1rem;
    }
}

@media screen and (min-width: 768px){
    .banner-main {
        margin-left: 3rem;
        margin-right: 3rem;
    }
    .banner-main .banner-content {
        padding: 4.3rem;
    }
    .banner-main .banner-content {
        padding: 4.3rem;
    }
}

@media screen and (min-width: 576px){
    .banner-main {
        margin-bottom: 2rem;
    }
    .banner-main .banner-content.left {
        width: calc(100% - 65px);
        margin-top: -150px;
    }
    .banner-main .banner-content.right {
        width: calc(100% - 90px);
        margin-top: -120px;
    }
}

@media screen and (max-width: 992px){

    .top7 .heading .title {
        margin-bottom: 1.5rem;
        display: block;
        font-size: 1.8rem;
        text-transform: initial;
    }
    .top7 .col-lg-6{
        padding-left:10px;
        padding-right:10px;
    }
    .top7 .col-sm-4{
        padding-left:10px;
        padding-right:10px;
    }
    .top7 .banner-main img{
        width:100%;
    }
    .banner-main .banner-content {
        display: block;
        width: 100%;
        transform: translateY(0px);
        position: relative;
        left: auto;
        right: auto;
        top: 0px;
        bottom: auto;
        background-color: rgb(255, 255, 255);
        padding: 2rem;
    }      
    .top7 .col-sm-4 .product article .thumb-size {
        height: 390px !important;
    }

    .top7 .display-products-col .product article .thumb-size {
        height: 390px !important;
    }
    .banner-main .banner-content.right {
        padding-left: 2rem;
    }
    .top7  .col-6 {
        position: relative;
        width: 100%;
        padding-right: 10px !important;
        padding-left: 10px !important;
    }
}

  </style>



<div id="gettopselling_7_loading" ></div>

  <div id="gettopselling_7_product"></div>

  <script>
    getallproductBytopselling7();
    function getallproductBytopselling7() {
      var type = 'topselling'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Top Selling</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettopselling_7_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBytopselling7")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettopselling_7_loading').html(' ');
              jQuery('#gettopselling_7_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerytopsell5();
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