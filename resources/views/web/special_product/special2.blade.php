
<style>

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
  
    .title_change1{
      text-align:left !important;
      font-size:24px !important;
      font-weight:600;
      display:inline-block;
      text-transform:initial !important;
    }

    .title_change2{
     float:right;
     display:inline-block;
     font-size:1rem !important;
      font-weight:500;

    }

    .rec-pro{
      padding-top:60px !important;
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
  height:100% !important;
}
.rec-pro .product-molla-20 article .content {
    padding-bottom: 10px !important;
}

@media screen and (max-width: 992px){
.title_change2 {
    float: none;
    display: block;
    text-align: center;
}
.pro-content .pro-heading-title h2 {
    text-align: center !important;
    display: block;
    margin-bottom: 12px;
}
}

  </style>




<div id="getspecial_loading2" ></div>

<div id="getspecial_product2"></div>

<script>
  getallproductByspecial2();
  function getallproductByspecial2() {
    var type = 'special';
    var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">FEATURED PRODUCTS</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getspecial_loading2').html(content);

    jQuery.ajax({
        url: '{{ URL::to("/getallproductByspecial2")}}',
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: 'type='+type,
          success: function (res) { 
            jQuery('#getspecial_loading2').html(' ');
            jQuery('#getspecial_product2').html(res);
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