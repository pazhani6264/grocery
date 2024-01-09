<style>
.btn-36-wishlist {
color: #ccc !important;
font-size: 0.9rem;
padding: 10px 0;
text-transform:initial;
}   
.heading-cat {
    font-size: 0.9rem;
    font-weight: 500;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: #777;
    margin-bottom: 0.5rem;
    text-align:center;
}
.pbc-2-title{
  font-size:30px;
  margin-bottom: 2rem;
}
.recent21{
  background-color:#f8f8f8;
  padding-top: 4.5rem;
    padding-bottom: 4.5rem;
}

.products .col-lg-6 {
    flex: 0 0 50%;
    max-width: 50%;
    display:inline-block;
    padding-left: 10px;
    padding-right: 10px;
}
.recent21 .product-molla-36 {
    margin-bottom: 0;
    margin-top: 15px;
}
.product-lg .product-molla-36 article .thumb{
  height: 555px;
}

.recent21 .col-lg-7 {
    flex: 0 0 58.3333333333%;
    max-width: 58.3333333333%;
    padding-left: 0px;
    padding-right: 0px;

}

.recent21 .product-lg{
  padding-left: 10px;
    padding-right: 10px;
}
.recent21 .product-lg article:hover .up-36-hover-trans {
    transform: translateY(0);
    transition: all .35s ease;
    background: #fff !important;
}

.recent21 .product-lg  article:hover .product-action {
    visibility: visible;
    opacity: 1;
    transform: translateY(-90px) !important;
}
.recent21 .product-lg  article .product-action {
    visibility: visible;
    opacity: 1;
    transform: translateY(-90px) !important;
    width: 60%;
    text-align: center;
    margin: auto;
}
.recent21 .product-lg .content{
  height:315px;
}

.recent21 .product-molla article .content {
    padding: 1.3rem 1rem;
}

@media screen and (max-width: 768px){
  .recent21 .col-lg-7 {
    flex: 0 0 100%;
    max-width: 100%;
    padding-left: 5px;
    padding-right: 5px;
}
.product-lg .product-molla-36 article .thumb {
    height: 400px !important;
}
  .recent21 .product-lg .content{
    height:250px !important;
  }

  .recent21 .product-lg article .product-action {
    visibility: visible;
    opacity: 1;
    transform: translateY(-190px) !important;
    width: 60%;
    text-align: center;
    margin: auto;
    display: flex;
}

.product-lg .up-36-hover-trans {
    transform: translateY(100px);
}

}
  </style>





<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest21();
    function getallproductBynewest21() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">New Arrival</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest21")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
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
