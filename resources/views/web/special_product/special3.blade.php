
<style>

.sp3{
  margin:auto;
  max-width:390px;
}

.sp3-text{
  font-weight:400 !important;
  text-align:center;
  font-size:1.15rem;
  margin-bottom: 0.5rem;
}
.sp3-para{
  font-weight:300 !important;
  text-align:center;
  font-size:1.15rem;
}

.pro-content {
    padding-top: 0px !important;
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
  
    .sp3-title_change1{
      text-align:center !important;
      font-size:30px !important;
      font-weight:600;
      text-transform:initial !important;
      margin-bottom: 1.1rem !important;
    }

    .title_change2{
     float:right;
     display:inline-block;
     font-size:1rem !important;
      font-weight:500;

    }

    .rec-pro{
      padding-top:30px !important;
      padding-bottom:60px !important;
    }

  .rec-pro .border-20 {
    border: 0rem solid #ebebeb;
    background: #fff;
    margin-top: 30px;
    padding-top: 0px !important;
  }

  .rec-pro .products-area .col-lg-3 {
    padding-right: 10px !important;
    padding-left: 10px !important;
}

.rec-pro .product-molla-20 article .thumb {
    height: 278px;
    overflow: hidden;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    position: relative;
}
.rec-pro .content{
  height:115px !important;
}


.sp3 .product-molla-22 article .thumb {
    height: 207px;
}

.demo-2-banner-20-btn-new:hover
{
  background-color: #fff; 
  border: solid 1px #fff; 
}
.demo-2-side-banner-content-outer
{
  position: relative;
}
.demo-2-side-banner-content {
    position: absolute;
    width: 225px;
    height: 300px;
    bottom: 75px;
    z-index: 2;
    left: 50px;
    text-align: left;
}

.demo-2-side-banner-20-title {
    color: #fff;
    font-weight: 600;
    font-size: 24px;
    line-height: 1.2;
    letter-spacing: 0;
    margin-bottom: 26px;
    
}

.demo-2-side-banner-20-p{
     font-size: 12px;
    font-weight: 400;
    letter-spacing: 0;
    margin-bottom: 10px;
    color: #ebebeb;
    text-transform: uppercase;
}
.demo-2-side-banner-20-p3 {
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 0;
    color: #ebebeb;
    margin-bottom: 30px;
}
.demo-2-side-banner-20-p2{
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 0;
    margin-bottom: 25px;
    line-height: 1.2;
    color:#fff;
   
}
.demo-2-side-banner-20-btn-new {
    font-size: 14px;
    font-weight: 400;
    display: inline-block;
    padding: 10px 30px;
    border: solid 2px #fff;
    border-radius: 30px;
    color: #fff !important;
}


.demo-2-side-banner-20-btn-new:hover{
    background-color:#fff;
}


.rec-pro .pro-heading-title {
    padding-bottom: 30px;
    margin-top: 30px !important;
}

.rec-pro .container {
  width: 1185px;
  max-width: 100%;
  padding-right:5px !important
}

  @media screen and (max-width: 992px){

    .rec-pro .container {
    width: 1185px;
    max-width: 100%;
    padding-left: 5px;
    padding-right: 5px;
    }

    .sp3{
      margin:auto;
      max-width:100%;
    }

    .rec-pro .col-6 {
      position: relative;
      width: 100%;
      padding-right: 10px !important;
      padding-left: 10px !important;
    }
    .tp1-banner{
      padding:0px 5px;
    }

  }

  </style>




<div id="getspecial_loading3" ></div>

<div id="getspecial_product3"></div>

<script>
  getallproductByspecial3();
  function getallproductByspecial3() {
    var type = 'special';
    var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">FEATURED PRODUCTS</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getspecial_loading3').html(content);

    jQuery.ajax({
        url: '{{ URL::to("/getallproductByspecial3")}}',
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: 'type='+type,
          success: function (res) { 
            jQuery('#getspecial_loading3').html(' ');
            jQuery('#getspecial_product3').html(res);
            jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
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