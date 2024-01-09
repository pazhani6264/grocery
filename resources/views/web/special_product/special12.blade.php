<?php $tpm = DB::table('current_theme')->where('template','0')->first(); ?>
@if($tpm)
<style>
  @media screen and (min-width: 992px){
    .mb-lg-7 {
        padding-top: 3rem!important;
        padding-bottom: 3rem!important;
    }
  }
</style>
@else
<style>
  @media screen and (min-width: 992px){
    .mb-lg-7 {
        padding-bottom: 5rem!important;
    }
  }
</style>
@endif


<style>
.css-16ph7t8 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 200ms;
    animation-name: animation-1ujkkqi;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
}
.demo-26-special-arrow-fill
{
    color: #999;
}
.home-page .product-group .heading.heading-flex {
    margin-bottom: 2.3rem;
}
.heading.heading-flex {
    display: flex;
    flex-direction: column;
    text-align: center;
}
/* .title {
    font-size: 2rem;
    letter-spacing: -.01em;
    line-height: 1.2;
    margin-bottom: 3.3rem;
} */
.home-page .title-link {
    color: #999;
    font-size:.9rem;
}
.home-page .product-group .products {
    padding: 1rem 2rem 1.7rem 0.2rem;
    height: calc(100% - 4rem);
    border: 0.1rem solid #eee;
}
.flex-column {
    -ms-flex-direction: column!important;
    flex-direction: column!important;
}
.d-flex {
    display: block !important;
}
.flex-row {
    flex-direction: row !important;
}

.special12 .heading h2 {
    font-size: 1.4rem;
    font-weight:700;
    text-transform:initial;
}

.special12 .product-list .product .thumb{
  width:35%;
  display:inline-block;
   vertical-align:top;
}

.special12 .product-list .product .content{
  width:65%;
  display:inline-block;
  vertical-align:top;
}

.special12 .product {
    margin-top: 0px;
    margin-bottom: 0px !important;
}
.special12 .product-list .product .btn-38 {
    padding: 6px !important;
    display: none;
}
.special12 .product-list .product .btn-38-danger {
padding: 6px !important;
display: none;
}

.special12 .product article .desktop-hover{
  display:none !important;
}
.special12 .product-list .product article .content {
    height: 100%;
    text-align:left !important;
}
.special12 .product-list .product article .thumb {
    height: 100%;
}

.special12 .product article .content .tag{
  text-align:left !important;
  display:block !important;
}
.special12 .product article .content .title{
  text-align:left !important;
}
.special12 .product article .content .price{
  text-align:left !important;
  display:block !important;
}

.special12 .product article .content .btn{
  display:none !important;
}

.special12 .product-list .product article:hover .product-action-vertical {
    visibility: hidden;
    opacity: 0;
    transform: translateX(0);
}
.special12 .arrivals{
  padding-left:10px;
  padding-right:10px;
}
.special12{
  background-color: rgb(250, 250, 250);
}
.special12 .row{
  margin-left:-10px;
  margin-right:-10px;
}

@media screen and (min-width: 992px){

  .demo-26-special-recent-order
  {
    order: -1;
  }
  .heading.heading-flex {
    align-items: center;
    flex-direction: row;
    text-align: left;
}
.heading-right {
    margin-top: 0;
    margin-left: auto;
}
}

@media screen and (min-width: 700px) and (max-width: 800px){

.order-md-first {
    -ms-flex-order: -1;
    order: -1;
}
.recomm {
    flex: 0 0 100%;
    max-width: 100%;
}
}


@media screen and (max-width: 992px){

.banners-content #getspecial_product12 .container-fluid {
    padding-left: 10px;
    padding-right: 10px;
}
.product9.product .thumb .product-action-vertical {
    visibility: hidden;
    opacity: 0;
    transform: translateX(0);
}
.special12 .heading h2 {
    font-size: 1.15rem;
    font-weight: 700;
    text-transform: initial;
}
.home-page .title-link {
    color: #999;
    font-size: .7rem;
}
.heading.heading-flex {
    display: block;
    flex-direction: column;
    text-align: center;
}
.special12 .heading-left{
  float:left;
  display:inline-block;
}
.special12 .heading-right{
  float:right;
  display:inline-block;
}

}

  </style>






<div id="getspecial_loading12" ></div>

<div id="getspecial_product12"></div>

<script>
  getallproductByspecial12();
  function getallproductByspecial12() {
    var type = 'special';
    var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Trending Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getspecial_loading12').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductByspecial12")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getspecial_loading12').html(' ');
              jQuery('#getspecial_product12').html(res);
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
