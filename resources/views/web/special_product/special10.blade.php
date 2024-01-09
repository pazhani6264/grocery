
<style>
   
   #getspecial_product10 .col-lg-6{
    display:inline-block;
    vertical-align:top;
   }
   .demo-23-new-b-btn
   {
      fill: #333;
      color: #333 !important;
   }
   .demo-23-new-b-btn:hover
   {
      fill: #fff;
      color: #fff !important;
   }
   .new-men .products {
    padding-left: 0;
    padding-right: 4rem;
  }
  .new-men .banner {
    padding-left: 5rem;
}

.banner-lg .intro3 {
    position: absolute;
    left: 10rem;
    top: 2.5rem;
}

.banner-lg .intro3 .title h3 {
    color: #777;
}
.intro3 .title h3 {
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: .1em;
    color: #fff;
    text-transform: uppercase;
}
.banner-lg .intro3 .content {
    margin-top: 2.3rem;
}
.banner-lg .intro3 .content h4 {
    font-size: 3rem;
    color: #222;
    text-indent: -0.2rem;
    margin-bottom: 0.6rem;
    letter-spacing: .01em;
    text-transform: uppercase;
}
.banner-lg .intro3 .action {
    margin-top: 5.5rem;
}


.banner-lg .intro3 .action a {
    font-weight: 400;
    color: #222;
    padding: 0.9rem 2rem;
    border: 0.1rem solid #c96;
}
.intro3 .action a {
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: .1em;
    color: #fff;
    text-transform: uppercase;
    -webkit-transition: all .3s;
    transition: all .3s;
}

@media screen and (max-width: 992px){
  .new-men .banner {
    padding-left: 1rem;
    order: -1;
  }
  .page-content-div {
      max-width: 100% !important;
      flex: 0 0 100%;
  }
  .new-men .banner {
    padding-left: 0rem;
    padding-right: 0rem;
  }
  #getspecial_product10 .col-sm-6a{
    width: 50%;
  } 
  .new-men .products {
    padding-left: 0;
    padding-right: 0rem;
  }
}

@media screen and (max-width: 768px){

}
  </style>






<div id="getspecial_loading10" ></div>

<div id="getspecial_product10"></div>

<script>
  getallproductByspecial10();
  function getallproductByspecial10() {
    var type = 'special';
    var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Special Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getspecial_loading10').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductByspecial10")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getspecial_loading10').html(' ');
              jQuery('#getspecial_product10').html(res);
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
