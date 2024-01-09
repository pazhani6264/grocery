
@include('web.details.partials.modals') 
<?php
  $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
        $decimal_places = count($currency) > 0 ? $currency[0] : 2;
?>


<style>


.c777{
    fill:#777;
  }
.detail-8-d-btn
{
    padding: 0.6rem 1.5rem !important;
    margin-top: 10px;

}
#back-to-top {
    bottom: 110px !important;
    right: 62px !important;
}

.footer-mb-100 {
    margin-bottom: 100px;
}
  .fancybox1-bg {
    background: rgba(77,77,77,.6) !important;
    opacity: 0;
    transition-duration: inherit;
    transition-property: opacity;
    transition-timing-function: cubic-bezier(.47,0,.74,.71);
}
.pro-content .slick-arrow.slick-disabled {
    cursor: default;
    fill: #ccc !important;
}
.fancybox1-navigation .fancybox1-button div {
    padding: 0 !important;
}
.fancybox1-navigation .fancybox1-button--arrow_right {
    padding: 31px 15px 31px 21px !important;
}
.fancybox1-navigation .fancybox1-button--arrow_left {
    padding: 31px 24px 31px 11px !important;
}
.detail-8-fancy-btn-click:hover
{
  color: #fff;
}
.detail-8-fancy-btn-click-2:hover
{
  color: #fff;
}
.pro-content .general-product {
    overflow: unset;
}
.pro-content {
    overflow: unset;
    padding-top: 100px;
}
.pro-content .slick-arrow {
    z-index: 2;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: transparent !important;
    color: #212529 !important;
    border: none !important;
    border-radius: 0;
    margin-left: 1px;
    height: 24px;
    width: 24px;
    text-align: center;
    line-height: 38px;
    text-decoration: none;
    outline: none;
    opacity: 1;
    top: 48%;
    fill: #777;
}
.detail-8-fancy-btn-click {
    position: absolute;
    right: 30px;
    bottom: 20px;
    width: 40px;
    height: 40px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
    font-size: 20px;
    cursor: pointer;
    border-radius: 0.3rem;
    -webkit-box-shadow: 2px 6px 16px rgb(51 51 51 / 5%);
    box-shadow: 2px 6px 16px rgb(51 51 51 / 5%);
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}
.detail-8-fancy-btn-click-2 {
    position: absolute;
    right: 30px;
    top: 360px;
    width: 40px;
    height: 40px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
    font-size: 20px;
    cursor: pointer;
    border-radius: 0.3rem;
    -webkit-box-shadow: 2px 6px 16px rgb(51 51 51 / 5%);
    box-shadow: 2px 6px 16px rgb(51 51 51 / 5%);
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
    z-index: 1000;
}
.fancybox1-button.fancybox1-button--zoom {
    background: rgba(30,30,30,.6);
    border: 0;
    border-radius: 0;
    box-shadow: none;
    cursor: pointer;
    display: inline-block;
    height: 40px;
    margin: 0;
    padding: 10px;
    position: relative;
    transition: color .2s;
    vertical-align: top;
    visibility: inherit;
    width: 40px;
}
.fancybox1-navigation .fancybox1-button {
    background-clip: content-box;
    height: 100px;
    opacity: 0;
    position: absolute;
    top: calc(50% - 50px);
    width: 70px;
    background: #6c6c6c !important;
}
.fancybox1-button {
    background: transparent !important;
    border: 0;
    border-radius: 0;
    box-shadow: none;
    cursor: pointer;
    display: inline-block;
    height: 44px;
    margin: 0;
    padding: 10px;
    position: relative;
    transition: color .2s;
    vertical-align: top;
    visibility: inherit;
    width: 44px;
}
.fancybox1-button {
    background: transparent;
    border: 0;
    border-radius: 0;
    box-shadow: none;
    cursor: pointer;
    display: inline-block;
    height: 44px;
    margin: 0;
    padding: 10px;
    position: relative;
    transition: color .2s;
    vertical-align: top;
    visibility: inherit;
    width: 44px;
}
  #idForm .form-control {
    display: block;
    width: 100%;
    height: 41px;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
#review_button
{
  min-width: 170px;
}
  .reviews h3 {
    font-size: 16px;
    letter-spacing: 1px;
    margin-bottom: 23px;
}
.ratings > label:before {
    margin: 0;
    font-size: 12px;
    margin-right: 5px;
    cursor: pointer;
}
.detail-8-rating
{
  float: left;
    margin-right: 10px;
}
.review .col-auto {
    width: 120px;
    padding-right: 20px;
}
.reviews .disabled-ratings > label {
    float: left !important;
}
.reviews .disabled-ratings > label:before {
    margin: 0;
    font-size: 10px;
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    content: "\F005";
    margin-right: 3px;
}
.review h4 {
    color: #333;
    font-weight: 400;
    font-size: 16px;
    line-height: 1;
    letter-spacing: 1px;
    margin-bottom: 0.8px;
}
.review .review-date {
    color: #ccc;
    margin-bottom:10px;
}
.review-action {
    font-size: 12px;
}
.review-action i {
    font-size: 14px;
    margin-right: 6px;
}
.review-action a+a {
    margin-left: 16px;
}
.review-action a {
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}
.review-action a:focus, .review-action a:hover {
    -webkit-box-shadow: 0 1px 0;
    box-shadow: 0 1px 0;
}
.review-content {
    margin-bottom: 8px;
}
.review-content p {
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 0;
    color: #777;
}
.review {
    padding-bottom: 13px;
    margin-bottom: 20px;
    border-bottom: 1px solid #ebebeb;
}
.detail-8-sticky-bar {
    display: none;
    width: 100%;
    position: fixed;
    bottom: 0;
    z-index: 500;
    -webkit-animation-name: fixedFooter;
    animation-name: fixedFooter;
    -webkit-animation-duration: .4s;
    animation-duration: .4s;
    background-color: #fff;
    -webkit-box-shadow: -15px 0 43px rgb(51 51 51 / 15%);
    box-shadow: -15px 0 43px rgb(51 51 51 / 15%);
    left:0;
    right:0;
    padding: 10px 0;
}
.detail-8-sticky-bar .detail-8-new-price {
    font-size: 14px;
    margin-right: 0px;
}
.detail-8-sticky-bar .detail-8-old-price {
    color: #ccc;
    text-decoration: line-through;
    font-size: 14px;
    margin-left:10px;
}
.detail-8-sticky-bar  .detail-8-qty-box-inner {
    display: flex;
    width: 100px;
    margin-right: 30px;
    margin-left: 20px;
}
.detail-8-sticky-bar .row{
  padding: 10px 0;
}
.detail-8-sticky-bar .product-title {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 0;
    letter-spacing: 1px;
    margin-top: -5px;
    padding-right: 10px;
}

.detail-8-sticky-bar-col {
    display: flex;
    align-items: center;
}
.detail-8-sticky-bar .product-media {
    width: 60px;
    height: 60px;
    margin-right: 20px;
    margin-bottom: 0;
    flex-shrink: 0;
    background-color: transparent;
    position: relative;
    display: block;
    overflow: hidden;
}
.detail-8-sticky-bar .product-media img{
    width: 100%;
    height: 100%;
    object-fit: contain;
}

  .detail-vertical-thumb.slick-vertical .slick-slide {
    display: block;
    height: auto;
    cursor:pointer;
    /* border: 1px solid; */
    background-color : #fafafa;
    opacity: 0.5;
}
.detail-vertical-thumb .slick-current{
    display: block;
    height: auto;
    border: 1px solid;
    background-color : #fafafa;
    opacity: 1 !important;
}

.detail-vertical-thumb .slick-slide:hover {
  outline: none;
  padding: 0px !important;
  opacity: 1;
}

.detail-8-tab-content {
    border: 1px solid #dadada;
    margin-top: -1px;
    border-radius: 0.3rem;
    padding: 0 !important;
}
.detail-8-product-desc-content a {
    color: #333;
    border-bottom: 1px solid #b8b8b8;
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}
.detail-8-product-desc-content h3 {
    font-size: 16px;
    font-weight: 400;
    letter-spacing: 1px;
    margin-bottom: 18px;
}
.detail-8-product-desc-content p {
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 0;
    color: #777;
}
.detail-8-nav-hover
{
  border-bottom: solid 2px transparent;
  color: #333;
    font-size: 16px;
    padding: 5px 30px;
    text-transform: capitalize;
}
.detail-8-nav-hover+.detail-8-nav-hover
{
  margin-left:20px;
}
.detail-8-nav-hover:hover
{
  border-bottom: solid 2px;
}
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #000;
    background-color: unset;
    border-bottom: solid 2px;
}
.detail-8-tab-pane {
    padding: 27px 30px;
}
.detail-8-display-none-mobile
{
  display: block;
}
.detail-8-display-none-desktop
{
  display: none;
}
.detail-8-sub-btn-design 
{
    background-color: #fff;
    width: 200px;
    display: inline-block;
}
.detail-8-btn-display
{
  display: inline-block;
}
.detail-8-qty-box-inner
{
    display: flex;
    width: 131px;
}
.detail-8-qty-main-outer
{
  margin-bottom:20px;
}

.detail-8-plus-min-width
{
    width: 30px;
    height: 40px;
}
.detail-8-plus-min-width-right
{
    height: 100% !important;
    border-right-width: 0 !important;
    border: 1px solid #ced4da;
    padding: 0 10px;
    font-size: 10px;
}
.detail-8-plus-min-width-left {
    height: 100% !important;
    border-left-width: 0 !important;
    border: 1px solid #ced4da;
    padding: 0 10px;
    font-size: 10px;
}
.detail-8-iput-btn {
    border: 1px solid #ced4da !important;
    height: 40px !important;
    background: #fff !important;
    border-left-width: 0 !important;
    border-right-width: 0 !important;
    text-align: center;
    min-width: 50px;
}
.detail-8-qty-label{
    width: 67px;
    margin-top: 13px;
    display: inline-block;
    font-weight: 400 !important;
    font-size: 14px;
    margin-bottom: 0;
}
.detail-8-qty-box {
    height: 40px !important;
    min-width: 131px;
    display: inline-block;
}
.detail-8-att-label {
    width: 100%;
    margin-right: 0px;
    display: inline-block;
    font-weight: 400 !important;
    font-size: 14px;
    margin-bottom: 10px;
}
.pro-timer {
    z-index: 1;
    display: flex;
    bottom: 0;
    position: relative;
    margin-bottom: 20px;
}
.detail-8-select-control {
    float: unset !important;
    position: relative;
    display: inline-block;
}
.detail-8-att-select {
    height: 40px !important;
    min-width: 131px;
}
.detail-8-old-price {
    color: #ccc;
    text-decoration: line-through;
    font-size: 24px;
}
.detail-8-new-price {
    font-size: 24px;
    margin-right:10px;
}
.detail-8-pro-title {
    font-weight: 400;
    font-size: 24px;
    letter-spacing: 1px;
    margin-bottom: 12px;
    padding-right: 10px;
}

.slider-for-vertical-new {
    float: right;
    width: 80%;
    padding-left: 10px !important;
}
  .fill-color-arrow-btn
  {
    fill: #999;
  }
.product-pager-link:hover .product-detail {
    visibility: visible;
    opacity: 1;
}
.product-pager-link-margin
{
  margin-right:70px;
}
.product-pager-next .product-detail {
    right: 0;
}
.product-pager, .product-pager-link {
    display: flex;
    align-items: center;
}

.ml-auto, .mx-auto {
    margin-left: auto!important;
}
.product-pager-link {
    color: #999;
    position: relative;
    font-weight: 400;
    font-size: 14px;
    line-height: 1.3;
    letter-spacing: 0;
}

.product-pager, .product-pager-link {
    display: flex;
    align-items: center;
}
.product-pager-link+.product-pager-link {
    margin-left: 30px;
}

.product-pager-link {
    color: #999;
    position: relative;
    font-weight: 400;
    font-size: 14px;
    line-height: 1.3;
    letter-spacing: 0;
}
.product-pager, .product-pager-link {
    display: flex;
    align-items: center;
}
.product-pager-link:before {
    position: absolute;
    display: block;
    content: "";
    top: 100%;
    left: 0;
    right: 0;
    height: 10px;
}
.product-pager-link .product-detail {
    position: absolute;
    top: calc(100% + 5px);
    width: 120px;
    padding: 10px;
    z-index: 500;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: opacity .4s;
    transition: opacity .4s;
    background-color: #fff;
    -webkit-box-shadow: 0 1px 4px 4px rgb(51 51 51 / 5%);
    box-shadow: 0 1px 4px 4px rgb(51 51 51 / 5%);
    border-top: 2px solid #a6c76c;
}
.product-pager-link .product-detail img {
    width: 100%;
    height: auto;
}
.product-pager-link .product-detail .product-name {
    max-width: 120px;
    text-align: center;
    font-size: 12px;
    font-weight: 500;
}
  .breadcrumb-nav .breadcrumb-item + .breadcrumb-item::before {
    display: inline-block;
    padding-right: 0.5rem;
    color: #6c757d;
    content: ">";
    padding: 0 10px !important;
}
.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 10px 0;
    margin-bottom: 0;
    list-style: none;
    background-color: #fff;
    border-radius: 0;
}
.product-img--main {
   position: relative;
  overflow: hidden;
  /* margin-bottom: 30px; */
  width: 400px;
  height: 400px;
  float: left;
  margin: 10px;
  cursor: all-scroll;
}
.hover-model-add:hover
{
  fill: #fff !important;
  color: #fff !important;
}
.hover-underline:hover
{
   border-bottom:solid 1px;
}
.btn-new-underline-unset.btn-39-wishlist:hover {
    text-decoration: unset !important;
}
.product-img--main__image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    -webkit-transition: -webkit-transform .5s ease-out;
    transition: -webkit-transform .5s ease-out;
    transition: transform .5s ease-out;
    transition: transform .5s ease-out,-webkit-transform .5s ease-out;
    cursor: all-scroll;
}

#myModal_molla .modal-content {
  height: 650px;
  overflow-y: hidden;
  border-radius:.3rem;
}

#myModal_molla .modal-body {
position: relative;
flex: 1 1 auto;
padding: 2rem;
}
.footer-darks .social-icon {
    justify-content: center;
    font-size: 1rem;
    width: 2.5rem;
    height: 2.5rem;
    color: #777 ;
    margin-right: 10px;
    background-color: transparent;
    border: 0.1rem solid #e1e2e6;
    border-radius: 50%;
    text-decoration: none;
    opacity: 1;
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}

.demo-image-zoom{
  cursor: all-scroll;
}
.demo-image-zoom:hover
{
    transform: scale(1.5);
}

  .quick-view-height {
    max-height: 150px;
    min-height: 30px;
    overflow-y: auto !important;
    margin-bottom:10px;
  }
  .row-scroll  .modal-body {
      position: relative;
      flex: 1 1 auto;
      padding: 2rem;
    }

    .slider-nav-detail8 .slick-slide {
outline: none;
padding: 0px !important;
opacity: 0.5;
}
.slider-nav-detail8 .slick-slide:hover {
outline: none;
padding: 0px !important;
opacity: 1;
}
/* .slider-nav .slick-current {
opacity: 1;
border:1px solid green;
} */
   .row-scroll .slider-wrapper .slider-for-detail8 {
      margin-bottom: 0px;
      height: 465px !important;
      width: 100%;
    }
   .row-scroll .slider-wrapper .slider-for-detail8 .slider-for__item img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .row-scroll .slick-track {
      position: relative;
      top: 0;
      left: 0;
      display: block;
      margin-left: initial;
      margin-right: auto;
    }
    .cart-button{
      width:49.5%;
    }
    .cart-button-width{
         width:100%;
      }

      .pop-height{
      height:100px !important;
      width:100px !important;
      margin-bottom: 10px;
    margin-left: 15px;
    }

    .row-scroll .slider-wrapper .slider-for-detail8 .slider-for__item img {
        width: 100%;
        height: 465px !important;
}

.shop-content .slider-wrapper .slider-for-detail8 .slider-for__item img {
        width: 100%;
        height: 400px !important;
}

    @media only screen and (min-width: 700px) and (max-width: 800px){

      #myModal_molla .modal-content {
        height: 96vh !important;
        border-radius:.3rem;
      }
      .modal-dialog {
max-width: 600px;
margin: 1.75rem auto;
}
.cart-button {
width: 45.5%;
}
      .cart-button-width{
         width:100%;
      }
      .row-scroll
      {
        overflow-y: auto;
        max-height: 95vh !important;
      }
      .new-width {
    max-width: 100% !important;
    flex: 0 0 100% !important;
}
.row-scroll  .modal .modal-dialog {
    width: 75%;
}
.row-scroll .slider-wrapper .slider-for-detail8 {
    margin-bottom: 20px;
    height: 400px;
    width: 100%;
}

.btn-39-wishlist{
      padding: 1rem 0rem !important;
      text-align: center;

    }
    .modal .modal-dialog .modal-body .pro-description .pro-counter {
margin-bottom: 0px;
}

    }
  @media (min-width: 992px){
    #myModal_molla .modal-lg, #myModal_molla .modal-xl {
      max-width: 1000px;
    }
  }

  @media only screen and (max-width: 992px){
    .fancybox1-navigation .fancybox1-button--arrow_left {
    padding: 10px 10px 10px 6px !important;
}
.detail-8-d-flex
{
  display:flex;
  align-items:center;
}
.detail-8-d-btn
{
    padding: 10px;
    margin-top: 10px;
    
}
.detail-8-nav-hover {
    border-bottom: solid 2px transparent;
    color: #333;
    font-size: 12px;
    padding: 5px 30px;
    text-transform: capitalize;
}
.fancybox1-navigation .fancybox1-button {
    background-clip: content-box;
    height: 100px;
    opacity: 0;
    position: absolute;
    top: calc(50% - 50px);
    width: 50px !important;
}
.fancybox1-navigation .fancybox1-button--arrow_right {
    display: none;
}
    .detail-8-display-none-mobile
{
  display: none;
}
.detail-8-sticky-bar {
  
    display: none !important;
}
.detail-8-display-none-desktop
{
  display: block;
}
.slider-nav-detail8 .slick-list {
    height: auto !important;
    margin-top: 10px;
}
.slider-nav-detail8 .slick-track
{
   height: auto !important;
}

.product-img--main {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 400px;
    float: left;
    margin: 10px;
    cursor: all-scroll;
}
.detail-vertical-thumb.slick-vertical .slick-slide {
    display: block;
    height: auto;
    border: 1px solid;
    background-color: #fafafa;
    margin-top: 30px;
    margin-bottom: 30px;
}

  }
  @media only screen and (min-width: 300px) and (max-width: 600px){

    /* .slider-wrapper .slider-for {
      margin-bottom: 20px;
      height: 100% !important;
      width: 100%;
    } */

    .detail-8-nav-align {
    width: 50%;
    text-align: center;
    padding: 10px;
    margin: 0 !important;
}

    #myModal_molla .modal-content {
        height: 96vh !important;
        border-radius:.3rem;
      }

    .pop-height {
height: 100px !important;
}

.cart-button{
      width:67%;
    }
    .btn-39-wishlist{
      padding: 1rem 0rem !important;
      text-align: -webkit-left;

    }

    .modal .modal-dialog .modal-body .pro-description .pro-counter {
margin-bottom: 0px !important;
}

.row-scroll  .modal-content {
      height: 100% !important;
    }
      .row-scroll
      {
        overflow-y: auto;
        max-height: 92vh;
        margin-top:50px;
      }
      .row-scroll  .modal-open .modal {
    overflow-x: hidden;
    overflow-y: hidden;
    height: 97vh !important;
    margin-top: 10px;
}
.row-scroll .modal .modal-dialog .modal-body .close {
    margin: 20px 0;
    position: fixed;
    top: -2px;
}
.qtynewpad
{
  padding:10px !important;
}
 
      .new-width {
    max-width: 100% !important;
    flex: 0 0 100% !important;
}
.row-scroll .modal .modal-dialog {
    width:95%;

}
.row-scroll .modal-body {
    padding: 5px;
}
.row-scroll .slider-wrapper .slider-for {
    margin-bottom: 20px;
    height: 280px;
    width: 100%;
}

    }


    @media only screen and (max-width: 767px){
.pro-content {
padding-top: 50px !important;
}

.quick-view-height {
max-height: 150px;
min-height: 30px;
height:auto;
overflow-y: auto !important;
margin-bottom: 10px;
}

.product-content  .nav {
display: flex;
flex-wrap: wrap;
padding-left: 0;
margin-bottom: 0;
list-style: none;
margin-bottom: 20px;
}

.product-content .slick-slide {
outline: none;
padding: 0 10px;
}

    }


    @media only screen and (max-width: 320px){
  .detail-8-d-btn {
    padding: 10px 10px 10px 0px;
    margin-top: 10px;
}
  }

   
</style>
<div style="background:#fff">
<div class="container">
<div class="row">

<nav class="breadcrumb-nav w-100 border-0 mb-0">
  <div class="d-flex align-items-center container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
      @if(!empty($result['category_name']) and !empty($result['sub_category_name']))
        <li class="breadcrumb-item active"><a href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ URL::to('/shop?category='.$result['sub_category_slug'])}}">{{$result['sub_category_name']}}</a></li>
      @elseif(!empty($result['category_name']) and empty($result['sub_category_name']))
        <li class="breadcrumb-item active"><a href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a></li>
      @endif
      @if($result['detail']['product_data'])
      <li class="breadcrumb-item active">{{$result['detail']['product_data'][0]->products_name}}</li>
      @endif
    
    </ol>
    <?php  
          $next_product_id  = DB::table('products_to_categories')->where('products_id','>', $result['detail']['product_data'][0]->products_id)->where('categories_id', $result['detail']['product_data'][0]->categories[0]->categories_id)->orderBy('products_id')->first();
       

          $prev_product_id  = DB::table('products_to_categories')->where('products_id','<', $result['detail']['product_data'][0]->products_id)->where('categories_id', $result['detail']['product_data'][0]->categories[0]->categories_id)->orderBy('products_id')->first();

          if($next_product_id != '')
          {
            $next_record = DB::table('products')
            ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->select('products_description.products_name as name', 'products.products_slug as slug', 'image_categories.path as img')
            ->where('products.products_id',$next_product_id->products_id)
            ->where('image_categories.image_type', '=', 'ACTUAL')
            ->where('products_description.language_id',Session::get('language_id'))
            ->first();
          }
          else
          {
            $next_record = '';
          }

          if($prev_product_id != '')
          {
            $prev_record = DB::table('products')
            ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->select('products_description.products_name as name', 'products.products_slug as slug', 'image_categories.path as img')
            ->where('products.products_id',$prev_product_id->products_id)
            ->where('image_categories.image_type', '=', 'ACTUAL')
            ->where('products_description.language_id',Session::get('language_id'))
            ->first();
          }
          else
          {
            $prev_record = '';
          }

          
         
     ?>
     <nav class="product-pager ml-auto">
      <?php if($prev_record !='') { ?>
        <a class="product-pager-link product-pager-prev @if($next_record =='') product-pager-link-margin @endif common-hover fill-color-arrow-btn common-fill-hover" href="{{ URL::to('/product-detail/'.$prev_record->slug)}}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow" style="margin-right:5px;" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg><span>Prev</span>
        <div class="product-detail common-border-top-2px">
          <figure style="background-color:#fafafa"><img src="{{asset($prev_record->img)}}" alt="{{$prev_record->name}}" width="300" height="300"></figure>
          <h3 class="product-name mb-0">{{$prev_record->name}}</h3>
        </div>
        </a>
        <?php } if($next_record !='') {?>
        <a class="product-pager-link product-pager-next  common-hover fill-color-arrow-btn common-fill-hover" href="{{ URL::to('/product-detail/'.$next_record->slug)}}"><span>Next</span><svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow" style="margin-left:5px;" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>
        <div class="product-detail common-border-top-2px">
          <figure style="background-color:#fafafa">
            <img src="{{asset($next_record->img)}}" alt="{{$next_record->name}}" width="300" height="300">
          </figure>
          <h3 class="product-name mb-0">{{$next_record->name}}</h3>
        </div>
      </a>
      <?php }?>
    </nav> 
  </div>
</nav>

</div> 
</div> 


<!-- Below we include the jQuery Library -->


<!-- Add fancyBox -->

<link rel="stylesheet" type="text/css" href="{{asset('web/css/fancybox1.css')}}">
<script type="text/javascript" src="{!! asset('web/js/fancybox1.js') !!}"></script>



<script>
$(document).ready(function() {


  $('[data-fancybox1="gallery"]').fancybox1({
  buttons: [
    "zoom",
    "close"
  ],
  loop: true,
  protect: true
});
});
</script>
<meta property="og:title" content="{{$result['detail']['product_data'][0]->products_name}}" />
<meta property="og:image" content="{{asset($result['detail']['product_data'][0]->default_images) }}" />
<div class="container">
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="row ">


        <div class="slider-wrapper pd2 slider-outer-border detail-8-display-none-mobile" style="position:relative">
       
          <div class="slider-for-vertical slider-for-vertical-new" style="position:relative">
            <a class="slider-for__item  ex1 " style="background-color:#fafafa;">
              <div  class="product-img--main" data-scale="2.2" src="{{asset($result['detail']['product_data'][0]->default_images) }}" ></div>
            </a>
            @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
              @if($images->image_type == 'ACTUAL')
              <a class="slider-for__item   ex1 " style="background-color:#fafafa;">
                <div  class="product-img--main" data-scale="2.2" src="{{asset($images->image_path) }}" ></div>
              </a>
              @endif
            @endforeach
          
          </div>
         
          <div class="detail-8-fancy-btn-click common-bg-hover"  href="{{asset($result['detail']['product_data'][0]->default_images)}}" data-fancybox1="gallery" class="btn-product-gallery"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
            @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
              @if($images->image_type == 'ACTUAL')
              <a href="{{asset($images->image_path) }}" data-fancybox1="gallery" ></a>
              @endif
            @endforeach



        

          <!-- <a class="fancybox-button fancy-btn-new expand-fancy-thumb " href="{{asset('').$result['detail']['product_data'][0]->default_images }}" data-fancybox-group="fancybox-button"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a> -->

          <div class="slider-nav-vertical detail-vertical-thumb">
            <div class="slider-nav__item common-color pop-height" style="padding:0px !important">
              <img style="width:100%;height:100% !important;object-fit:contain;" src="{{asset($result['detail']['product_data'][0]->default_thumb) }}" alt="Zoom Image"/>
            </div>
            @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
              @if($images->image_type == 'THUMBNAIL')
                <div class="slider-nav__item common-color pop-height" style="padding:0px !important">
                  <img style="width:100%;height:100% !important" src="{{asset($images->image_path) }}" alt="Zoom Image" />
                </div>
              @endif
            @endforeach
          </div>
        </div>


        <div class="slider-wrapper pd2 slider-outer-border detail-8-display-none-desktop" style="position:relative">
          <div class="slider-for-detail8 " style="position:relative;margin: 0 15px;">
            <a class="slider-for__item  ex1 " style="background-color:#fafafa;">
              <div  class="product-img--main" data-scale="2.2" src="{{asset($result['detail']['product_data'][0]->default_images) }}" ></div>
            </a>
            @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
              @if($images->image_type == 'ACTUAL')
              <a class="slider-for__item   ex1 " style="background-color:#fafafa;">
                <div  class="product-img--main" data-scale="2.2" src="{{asset($images->image_path) }}" ></div>
              </a>
              @endif
            @endforeach
          </div>

          <div class="detail-8-fancy-btn-click-2 common-bg-hover"  href="{{asset($result['detail']['product_data'][0]->default_images)}}" data-fancybox1="gallery" class="btn-product-gallery"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
            @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
              @if($images->image_type == 'ACTUAL')
              <a href="{{asset($images->image_path) }}" data-fancybox1="gallery" ></a>
              @endif
            @endforeach

          <!-- <a class="fancybox-button fancy-btn-new expand-fancy-thumb " href="{{asset('').$result['detail']['product_data'][0]->default_images }}" data-fancybox-group="fancybox-button"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a> -->

          <div class="slider-nav-detail8 detail-vertical-thumb">
            <div class="slider-nav__item common-color pop-height" style="padding:0px !important">
              <img style="width:100%;height:100% !important;object-fit:contain;" src="{{asset($result['detail']['product_data'][0]->default_thumb) }}" alt="Zoom Image"/>
            </div>
            @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
              @if($images->image_type == 'THUMBNAIL')
                <div class="slider-nav__item common-color pop-height" style="padding:0px !important">
                  <img style="width:100%;height:100% !important" src="{{asset($images->image_path) }}" alt="Zoom Image" />
                </div>
              @endif
            @endforeach
          </div>
        </div>



    </div>

    @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)
      @if($result['detail']['product_data'][0]->products_type == 0)
        @if($result['commonContent']['settings']['Inventory'])
          @if($result['detail']['product_data'][0]->defaultStock <= 0)
            @if($result['detail']['product_data'][0]->stock_status == 1)
              <span class="badge badge-success bage-22-out" style="margin:25px 10px;font-size:0.9rem;height:30px;position:absolute;top:0">@lang('website.Out of Stock')</span>
            @else @endif
          @endif
        @endif
      @endif
    @endif
  </div>


        <div class="col-12 col-md-6 col-lg-6">
          <div class="row">
              <div class="col-12 col-md-12">
                <div class="badges">

                  <?php 
                  //dd($result['detail']['product_data'][0]->flash_start_date);
                  $current_date = date("Y-m-d", strtotime("now"));

                  $string = substr($result['detail']['product_data'][0]->products_date_added, 0, strpos($result['detail']['product_data'][0]->products_date_added, ' '));
                  $date=date_create($string);
                  date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

                  $after_date = date_format($date,"Y-m-d");

                  if($after_date>=$current_date){
                    print '<span class="badge badge-info">';
                    print __('website.New');
                    print '</span>';
                  }
                ?>

                <?php
                $discount_percentage = 0;
                if(!empty($result['detail']['product_data'][0]->discount_price)){
                  $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
                }
                $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');

                if(!empty($result['detail']['product_data'][0]->discount_price)){

                if(($orignal_price+0)>0){
                  $discounted_price = $orignal_price-$discount_price;
                  $discount_percentage = $discounted_price/$orignal_price*100;
                }else{
                  $discount_percentage = 0;
                  $discounted_price = 0;
                }
                
                ?>             
                
                <?php }
                
                ?>
                @if($discount_percentage>0)
                <span class="badge badge-danger" id="dis_special"><?php echo (int)$discount_percentage; ?>%</span>
                @endif
                @if($result['detail']['product_data'][0]->is_feature == 1)
                <span class="badge badge-success">@lang('website.Featured')</span>     
                @endif
                
                
              </div>

             
                <h5 class="pro-title detail-8-pro-title">{{$result['detail']['product_data'][0]->products_name}}</h5>

                @if($result['detail']['product_data'][0]->products_type == 3)
                  <?php
                        $comboPro = DB::table('product_combo')
                        ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_combo.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();
                      ?>
                        @foreach($comboPro as $comboProd)
                          <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                          <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                          <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                          @if($comboProd->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProd->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProd->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                        @endforeach
                @endif

                @if($result['detail']['product_data'][0]->products_type == 4)
                  <?php
                        $comboPro = DB::table('product_buy_x')
                        ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_buy_x.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();

                        $getX = DB::table('product_get_x')
                        ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_get_x.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();

                      ?>
                      <h5>Buy X :</h5>
                        @foreach($comboPro as $comboProd)
                          <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                          <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                          <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                          @if($comboProd->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProd->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProd->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                        @endforeach

                        <br><h5>Get X :</h5>
                        @foreach($getX as $comboProdgetX)
                          <small><b>Product Name :</b> {{$comboProdgetX->products_name}}</small><br>
                          <small><b>Category Name :</b> {{$comboProdgetX->categories_name}}</small><br>
                          <small><b>Qty :</b> {{$comboProdgetX->qty}}</small><br>
                          @if($comboProdgetX->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProdgetX->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProdgetX->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                        @endforeach
                @endif
          

                <div class="pro-rating" style="margin: 10px 0px;">
      <fieldset class="disabled-ratings-19">                            
      <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
      <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>   
      <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>   
      <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>  
      <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>   
      <span style="font-size:13px;color:#cccccc">( {{$result['detail']['product_data'][0]->total_user_rated}} @lang('website.Reviews') )</span>
  </div>

          
          <div class="price">                     
            <?php

            if(!empty($result['detail']['product_data'][0]->discount_price)){
              $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
            }
            if(!empty($result['detail']['product_data'][0]->flash_price)){
              $flash_price = $result['detail']['product_data'][0]->flash_price * session('currency_value');
            }
              $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');


             if(!empty($result['detail']['product_data'][0]->discount_price)){

              if(($orignal_price+0)>0){
                $discounted_price = $orignal_price-$discount_price;
                $discount_percentage = $discounted_price/$orignal_price*100;
                $discounted_price = $result['detail']['product_data'][0]->discount_price;

             }else{
               $discount_percentage = 0;
               $discounted_price = 0;
             }
            }
            else{
              $discounted_price = $orignal_price;
            }
            //  dd($result['currency_value']);
            ?>
            @if(!empty($result['detail']['product_data'][0]->flash_price))
            <price class="total_price common-color detail-8-new-price" id="total_dis_price">{{Session::get('symbol_left')}}{{$flash_price}}{{Session::get('symbol_right')}}</price>
            <span class="detail-8-old-price">{{Session::get('symbol_left')}}{{number_format($orignal_price,$decimal_places)}}{{Session::get('symbol_right')}} </span> 

            @elseif(!empty($result['detail']['product_data'][0]->discount_price))
            <price class="total_price common-color detail-8-new-price" id="total_dis_price">{{Session::get('symbol_left')}}{{$discount_price}}{{Session::get('symbol_right')}}</price>
            <span class="detail-8-old-price" id="total_org_price">{{Session::get('symbol_left')}}{{number_format($orignal_price,$decimal_places)}}{{Session::get('symbol_right')}} </span> 
            @else
            
            <price class="total_price common-color detail-8-new-price" id="total_dis_price">{{Session::get('symbol_left')}} {{ number_format($orignal_price,$decimal_places) }} {{Session::get('symbol_right')}}</price>
            @endif
                               
            </div>

           <!--  <div class="pro-rating">
            <fieldset class="disabled-ratings">  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>    
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>                                       
                <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
                                                   
                                                       
               
               
      </fieldset>                                        
              <a href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link">{{$result['detail']['product_data'][0]->total_user_rated}} @lang('website.Reviews') </a>
            </div>
 -->

 
<div class="popup-detail-info quick-view-height">
<p style="font-size:14px !important;line-height:2">
<?php 
  $descriptions = strip_tags($result['detail']['product_data'][0]->products_description);
  echo stripslashes($descriptions);
?>
</p>
</div>

 <!--          <div class="pro-infos">
              <div class="pro-single-info"><b>@lang('website.Product ID') : </b>{{$result['detail']['product_data'][0]->products_id}}</div>
              <div class="pro-single-info"><b>@lang('website.Categroy')  : </b>
             
                <?php
                $cates = '';  
                ?>
                @foreach($result['detail']['product_data'][0]->categories as $key=>$category)
                    
                  <?php
                    $cates =  "<a class='common-hover' href=".url('shop?category='.$category->categories_slug).">".$category->categories_name."</a>";
                  ?>  
                  
               
                <?php 
                echo $cates.',';
                ?>
                 @endforeach
                </div>
                
                <div class="pro-single-info"><b>@lang('website.Available') : </b>
              
           
                @if($result['detail']['product_data'][0]->products_type == 0)
                  @if($result['commonContent']['settings']['Inventory'])
                    @if($result['commonContent']['settings']['stock_availability'] == 1)
                      <span class="text-secondary">{{ $result['detail']['product_data'][0]->defaultStock }}</span>
                    @else
                      @if($result['detail']['product_data'][0]->defaultStock <= 0)
                        <span class="text-secondary">@lang('website.Out of Stock')</span>
                      @else
                        <span class="text-secondary">@lang('website.In stock')</span>
                      @endif
                    @endif
                    @else 
                      <span class="text-secondary">@lang('website.In stock')</span>    
                    @endif
                @endif

                @if($result['detail']['product_data'][0]->products_type == 1)
          
                @if($result['commonContent']['settings']['Inventory'])
                  @if($result['commonContent']['settings']['stock_availability'] == 1)
                    <span class="text-secondary" id="variable-count"></span>
                  @else
                    <span class="text-secondary" id="variable-status"></span>  
                  @endif
              @endif
              @endif

             

                @if($result['detail']['product_data'][0]->products_type == 2)
                <span class="text-secondary">@lang('website.External Link')</span>
                @endif
              </div>
              <p>
              @if($result['detail']['product_data'][0]->products_min_order>0)
                  
                    
                  <div class="pro-single-info" id="min_max_setting3"><b>@lang('website.Min Order Limit') : </b>{{$result['detail']['product_data'][0]->products_min_order}}</div>
                    
                 
                @endif
               
                 
                    
                  <div class="pro-single-info"  @if($result['detail']['product_data'][0]->products_max_stock==9999) style="display:none;" @endif id="min_max_setting2"><b>@lang('website.Max Order Limit') : </b>
                  
                  @if($result['detail']['product_data'][0]->products_max_stock == 0)
                  {{$result['detail']['product_data'][0]->products_max_stock}} (unlimited)
                  
                  @else{{$result['detail']['product_data'][0]->products_max_stock}} @endif</div>
                    
                 
                
                </p>
          </div> -->

          <form name="attributes" id="add-Product-form" method="post" >
            <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}">
            <input type="hidden" name="special_discount" id="special_discount" value="no">
            <input type="hidden" name="special_price" id="special_price" value="">
            <input type="hidden" name="org_price" id="org_price" value="">

            <input type="hidden" value="{{ number_format($result['detail']['product_data'][0]->products_filter_price,$decimal_places) }}" id="total_org_price_new">
            <input type="hidden" name="option_name_new" class="option_name_new" value="">
            <input type="hidden" name="option_id_new" class="option_id_new" value="">
            <input type="hidden" name="attributes_id_new" class="attributes_id_new" value="">
            <input type="hidden" name="function_id_new" class="function_id_new" value="">
            <input type="hidden" name="products_id" class="products_id_new" value="{{$result['detail']['product_data'][0]->products_id}}">
            <input type="hidden" name="products_type" class="products_type" value="{{$result['detail']['product_data'][0]->products_type}}">


            <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

            <input type="hidden" name="checkout" id="checkout_url" value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif" >

            <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)){{ $result['detail']['product_data'][0]->products_max_stock }}@else 0 @endif" >
             @if(!empty($result['cart']))
              <input type="hidden"  name="customers_basket_id" value="{{$result['cart'][0]->customers_basket_id}}" >
             @endif


          @if(count($result['detail']['product_data'][0]->attributes)>0)
          <div class="pro-options">
          <?php
              $index = 0;
          ?>
            @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
            <?php
                $functionValue = 'function_'.$key++;
            ?>
            <input type="hidden" name="option_name[]" value="{{ $attributes_data['option']['name'] }}" >
            <input type="hidden" name="option_id[]" value="{{ $attributes_data['option']['id'] }}" >
            <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}" value="0" >
            <input id="attributeid_<?=$index?>" type="hidden" value="">
            <input id="attribute_sign_<?=$index?>" type="hidden" value="">
            <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >

            <style>

            body { 
/* 	font-family: 'Ubuntu', sans-serif; */
	font-weight: bold;
}
.select2-container {
  min-width: 400px;
}

.select2-results__option {
  padding-right: 20px;
  vertical-align: middle;
}
.select2-results__option:before {
  content: "";
  display: inline-block;
  position: relative;
  height: 20px;
  width: 20px;
  border: 1px solid #495057;
  border-radius: 4px;
  background-color: #fff;
  margin-right: 20px;
  vertical-align: middle;
}
span.select2.select2-container.select2-container--default {
  width: auto !important;
    min-width: 131px;
     max-width: 400px; 
}
.detail-8-select-control1.select-control::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\F107";
    position: absolute;
    color: #6c757d;
    bottom: 36%;
    right: 10px;
    z-index: 1;
    font-size: 12px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    display: none !important;
}
.select2-results__option[aria-selected=true]:before {
  font-family:fontAwesome;
  content: "\2713";
  color: #fff;
  background-color: #f77750;
  border: 0;
  display: inline-block;
  padding-left: 5px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
	background-color: #fff;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
	background-color: #eaeaeb;
	color: #272727;
}
.select2-container--default .select2-selection--multiple .select2-selection__clear {
  display: none !important;
}
.select2-container--default .select2-selection--multiple {
	margin-bottom: 10px;
}
.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
	border-radius: 4px;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
	border-color: #f77750;
	border-width: 1px;
}
.select2-container--default .select2-selection--multiple {
	border-width: 1px;
}
.select2-container--open .select2-dropdown--below {
	
	border-radius: 6px;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);

}
.select2-selection .select2-selection--multiple:after {
	content: 'hhghgh';
}
/* select with icons badges single*/
.select-icon .select2-selection__placeholder .badge {
	display: none;
}
.select-icon .placeholder {
/* 	display: none; */
}
.select-icon .select2-results__option:before,
.select-icon .select2-results__option[aria-selected=true]:before {
	display: none !important;
	/* content: "" !important; */
}
.select-icon  .select2-search--dropdown {
	display: none;
}



.btn-group .select {
  position: relative;
}
/* .btn-group .select input:checked + label {
  background-color: #ffc107;
} */
.btn-group .select input:checked + label:hover, .btn-group .select input:checked + label:focus, .btn-group .select input:checked + label:active {
  background-color: #ffc107;
}


.btn-group .select input:checked + label .tick-active{
  color: #000;
  background: none;
  position: absolute;
  right: 10px;
  bottom: 10px;
  width: 20px;
  border-bottom: 20px solid #ffc107;
  border-left: 20px solid transparent;
  border-right: 0px solid transparent;
}

.btn-group .select input:checked + label .tick-active:before {
  content: "\2713";
  position: absolute;
  right: 1px;
  top: 4.5px;
  color: #000;
  font-family: 'Font Awesome 5 Brands';
  font-weight: 900;
  transform: rotate(5deg);
}


.btn-group .select input {
  opacity: 0;
  position: absolute;
}
.btn-group .select .button_select {
  margin: 0 10px 10px 0;
  display: flex;
  background-color: transparent;
}
.btn-group .select .button_select:hover, .btn-group .select .button_select:focus, .btn-group .select .button_select:active {
  background-color: transparent;
}

.option {
  position: relative;
}
.option input {
  opacity: 0;
  position: absolute;
}
/* .option input:checked + span {
  background-color: #ffc107;
} */
.option input:checked + span:hover, .option input:checked + span:focus, .option input:checked + span:active {
  background-color: #ffc107;
}
.option .btn-option {
  margin: 0 10px 10px 0;
  display: flex;
  background-color: transparent;
}
.option .btn-option:hover, .option .btn-option:focus, .option .btn-option:active {
  background-color: transparent;
}


.option input:checked + span .tick-active{
  color: #000;
  background: none;
  position: absolute;
  right: 10px;
  bottom: 10px;
  width: 20px;
  border-bottom: 20px solid #ffc107;
  border-left: 20px solid transparent;
  border-right: 0px solid transparent;
}

.option input:checked + span .tick-active:before {
  content: "\2713";
  position: absolute;
  right: 1px;
  top: 4.5px;
  color: #000;
  font-family: 'Font Awesome 5 Brands';
  font-weight: 900;
  transform: rotate(5deg);
}

 .tick-active-new:before {
    content: "\2713";
    position: absolute;
    right: 1px;
    top: 4.5px;
    color: #000;
    font-family: 'Font Awesome 5 Brands';
    font-weight: 900;
    transform: rotate(5deg);
}
.tick-active-new {
right:0;bottom:0;height: 20px;background: none;position: absolute;width: 20px;border-bottom: 20px solid;border-left: 20px solid transparent;border-right: 0px solid transparent;
}

</style>


           
  <script>

$(".js-select2").select2({
			closeOnSelect : false,
			placeholder : "Placeholder",
			// allowHtml: true,
			allowClear: true,
			tags: true // создает новые опции на лету
		});
  </script>
            
              <div class="box mb-3">
            

              <label class="detail-8-att-label">{{ $attributes_data['option']['name'] }} @if($attributes_data['option']['options_required'] == 0) * @endif  @if($attributes_data['option']['options_select_type'] == 0) (Pick 1) @endif @if($attributes_data['option']['options_select_type'] == 1) (Pick Multiple) @endif</label>

              @if($attributes_data['option']['options_select_type'] == 0)

                <ul class="size-list js-size-list" data-select-id="SingleOptionSelector-<?=$index?>">
                  @foreach($attributes_data['values'] as $values_data)
                    <li class="pc-category-variable-item-main  var-{{$values_data['id']}} common-color new-{{ $attributes_data['option']['id'] }}  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" style="display:inline-block;height: 40px !important;border: solid 1px;margin: 0 10px 10px 0;position:relative;">

                      <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="radio_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" >

                      <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                      <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                      
                      <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                      <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">


                      <label>
                        <input type="radio" class="radio-{{$values_data['id']}}" name="{{ $attributes_data['option']['id'] }}" style="display:none;"  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif value="{{ $values_data['id'] }}" @if($attributes_data['option']['options_required'] == 0) onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @else onclick="updateActiveClassradio(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @endif>

                        <!-- <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div> -->
                        <div class="pc-category-variable-item cursor-pointer" style="text-align:center !important;width:100%;padding: 0.6rem 1.8rem;color: #212529;text-transform: uppercase;">{{ $values_data['value'] }}</div>
                      </label>
                      <span class="common-color @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) tick-active-new @endif @endif tick-common-{{ $attributes_data['option']['id'] }} tick-{{$values_data['id']}}"></span>
                    </li>
                  @endforeach
                </ul>

                @else


                  <ul class="size-list js-size-list">
                    @foreach($attributes_data['values'] as $values_data)
                      <li class="pc-category-variable-item-main  common-color var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" style="display:inline-block;height: 40px !important;border: solid 1px;margin: 0 10px 10px 0;position:relative;">
                      <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="check_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                      <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                      <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                      <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                      <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                    
                        <label>
                          <input type="checkbox" style="display:none;" @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif name="{{ $attributes_data['option']['id'] }}" value="{{ $values_data['id'] }}" onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'checkbox', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')"> 
                         <!--  <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div> -->
                          <div class="pc-category-variable-item cursor-pointer" style="text-align:center !important;width:100%;padding: 0.6rem 1.8rem;color: #212529;text-transform: uppercase;">{{ $values_data['value'] }}</div>
                          <span class="common-color @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) tick-active-new @endif @endif  tick-common-{{ $attributes_data['option']['id'] }} tick-{{$values_data['id']}}"></span>
                        </label>
                      </li>
                    @endforeach
                  </ul>

                @endif

     
                </div>                 
            
            @endforeach
          </div>
          @endif
        
      
         @if(!empty($result['detail']['product_data'][0]->flash_start_date))
          <div class="countdown pro-timer" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Countdown Timer')" id="counter_{{$result['detail']['product_data'][0]->products_id}}" >                               
            <span class="days">0<small>@lang('website.Days') </small></span>
            <span class="hours">0<small>@lang('website.Hours')</small></span>
            <span class="mintues">0<small>@lang('website.Minutes')</small></span>
            <span class="seconds">0<small>@lang('website.Seconds')</small></span>
          </div>
          @endif


          <div class="pro-counter" @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ) style="display: none" @endif>

          @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)

       <div class="detail-8-qty-main-outer">   
      
  <span class="detail-8-qty-label">Qty :</span>  
  <div class="detail-8-qty-box">
  <div class="detail-8-qty-box-inner">
    <span class="input-group-btn detail-8-plus-min-width">        
      <button type="button" class="quantity-minus1 btn qtyminus qtynewpad detail-8-plus-min-width-right">
          <i class="fas fa-minus"></i>
        </button>
      </span>

                           
                  {{-- <input type="text" id="quantity1" name="quantity" class="form-control" value="10">                       --}}
                   @if($result['detail']['product_data'][0]->products_type == 0)
                   @if($result['detail']['product_data'][0]->stock_status == 1)

                   @if($result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_max_stock && $result['detail']['product_data'][0]->products_max_stock !=0)
                  <input type="text"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
                    @else

                    <input type="text"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->defaultStock}}">    <span class="input-group-btn">

                    @endif
                    @else

<input type="text"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="99999">    <span class="input-group-btn">

@endif

                  @elseif($result['detail']['product_data'][0]->products_type == 1)

                  <input type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">


                  @elseif($result['detail']['product_data'][0]->products_type == 3 || $result['detail']['product_data'][0]->products_type == 4)
                    @if($result['commonContent']['settings']['Inventory'])
                    @if($result['detail']['product_data'][0]->stock_status == 1)
                  <?php

                    $inventory_ref_id = '';
                    $products_id = $result['detail']['product_data'][0]->products_id;
                    $productsType = DB::table('products')->join('product_combo','product_combo.product_id','=','products.products_id')->where('product_combo.pro_id', $products_id)->get();

                    $resattributes = array();
                    foreach($productsType as $proCType){
                      if($proCType->attractive_id !=0){
                        $resattributes[] = $proCType->attractive_id;
                      }
                    }


                    // Normal Product stocks

                    $norstocks = array();
                    foreach($productsType as $proCType){
                      if($proCType->products_type == 0) { 

                        $stocksin = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'in')->sum('stock');
                        $stockOut = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'out')->sum('stock');
                        $norstocks[] = $stocksin - $stockOut;

                      }
                    }
                    $workArray = implode(",", $norstocks);
                    $array = explode(',', $workArray);
                    $NorStock = min($array);

                    // Variable Product stocks

                    $stocks = array();
                    $VarStock = '';
                    foreach($productsType as $proCType){
                      $attrcount = DB::table('products_attributes')->where('products_id', $proCType->product_id)->get();
                      $acount = count($attrcount);

                      if ($proCType->products_type == 1 && $acount > 0) {

                        $attributes = array_filter($resattributes);
                        $attributeid = implode(',', $attributes);

                        $postAttributes = count($attributes);

                        $inventories = DB::table('inventory')->where('products_id', $proCType->product_id)->get();
                        $reference_ids = array();
                        
                        $stockIn = 0;
                        foreach ($inventories as $inventory) {

                            $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
                            $totalAttributes = count($totalAttribute);

                            if ($postAttributes > $totalAttributes) {
                                $count = $postAttributes;
                            } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
                                $count = $totalAttributes;
                            }


                            $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
                                ->selectRaw('inventory.*')
                                ->whereIn('inventory_detail.attribute_id', [$attributeid])
                                ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeid . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
                                ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
                                ->groupBy('inventory_detail.inventory_ref_id')
                                ->get();

                            if (count($individualStock) > 0) {
                                $inventory_ref_id = $individualStock[0]->inventory_ref_id;
                                $stockIn += $individualStock[0]->stock;
                            }
                            
                        }

                        $options_names = array();
                        $options_values = array();
                        foreach ($resattributes as $attribute) {
                            $productsAttributes = DB::table('products_attributes')
                                ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                ->where('products_attributes_id', $attribute)->get();

                            $options_names[] = $productsAttributes[0]->options_name;
                            $options_values[] = $productsAttributes[0]->options_values;
                        }

                        $options_names_count = count($options_names);
                        $options_names = implode("','", $options_names);
                        $options_names = "'" . $options_names . "'";
                        $options_values = "'" . implode("','", $options_values) . "'";
                        

                        //orders products
                        $orders_products = DB::table('orders_products')->where('products_id', $proCType->product_id)->get();
                        $stockOut = 0;
                        foreach ($orders_products as $orders_product) {
                            $totalAttribute = DB::table('orders_products_attributes')->where('orders_products_id', '=', $orders_product->orders_products_id)->get();
                            $totalAttributes = count($totalAttribute);

                            if ($postAttributes > $totalAttributes) {
                                $count = $postAttributes;
                            } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
                                $count = $totalAttributes;
                            }

                            $products = DB::select("select orders_products.* from `orders_products` left join `orders_products_attributes` on `orders_products_attributes`.`orders_products_id` = `orders_products`.`orders_products_id` where `orders_products`.`products_id`='" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and (select count(*) from `orders_products_attributes` where `orders_products_attributes`.`products_id` = '" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and `orders_products_attributes`.`orders_products_id`= '" . $orders_product->orders_products_id . "') = " . $count . " and `orders_products`.`orders_products_id` = '" . $orders_product->orders_products_id . "' group by `orders_products_attributes`.`orders_products_id`");

                            if (count($products) > 0) {
                                $stockOut += $products[0]->products_quantity;
                            }
                        }
                        $stocks[] = $stockIn - $stockOut;
                      } 
                    }

                    $VarworkArray = implode(",", $stocks);
                    $Vararray = explode(',', $VarworkArray);
                    $VarStock = min($Vararray);


                    if($NorStock >= $VarStock ){
                      $totalStock = $VarStock;
                    } else if($NorStock <= $VarStock){
                      $totalStock = $NorStock;
                    } else {
                      $totalStock = 1;
                    }
                  ?>

                <input type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 
              
                min="@if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}  @endif" 
                
                max="@if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $totalStock >$result['detail']['product_data'][0]->products_max_stock){{ $result['detail']['product_data'][0]->products_max_stock}}@else{{ $totalStock }}@endif">     <span class="input-group-btn">

              @else

                  <input type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
               @endif
               @else

<input type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="999999">    <span class="input-group-btn">
@endif

              @else

                  <input type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">

              @endif

                  <input type="hidden" id="max_stock_one" value="{{$result['detail']['product_data'][0]->products_max_stock}}">

                  <span class="input-group-btn detail-8-plus-min-width">
          <button type="button" class="quantity-plus1 btn qtyplus qtynewpad detail-8-plus-min-width-left">
              <i class="fas fa-plus"></i>
          </button>
      </span>
                </div>
                </div>
                </div>





            @if($result['commonContent']['setting'][226]->value == 2)
              <?php
                $res = $result['commonContent']['setting']['227']->value;
                $time = explode('-',$res);
                $startTime = strtotime($time[0]);
                $endTime = strtotime($time[1]);
                $currentTime = time();
              ?>
              @if($currentTime >= $startTime && $currentTime <= $endTime)
                <?php $ck = 0 ?>
              @else
                <?php $ck = 1; ?>
              @endif
            @else
              <?php $ck = 0; ?>
            @endif      

            @if($ck == 0)
              <div class="detail-8-btn-display">

                
                @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date )
                  @else
                    @if($result['detail']['product_data'][0]->products_type == 0)
                    
                      @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if($result['detail']['product_data'][0]->defaultStock <= 0)
                            <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>
                          @else
                              <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                              <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                              </svg>@lang('website.Add to Cart')</button>
                          @endif
                        @else
                          <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                          <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                          </svg>@lang('website.Add to Cart')</button>
                        @endif
                      @else
                      <button class="btn btn-secondary btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart detail-8-sub-btn-design "  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                      @endif

                      @elseif($result['detail']['product_data'][0]->products_type == 1)
                        @if($result['commonContent']['settings']['Inventory'])
                          @if($result['detail']['product_data'][0]->stock_status == 0)
                            <button class="btn btn-secondary btn-lg common-color detail-8-sub-btn-design common-bg-hover hover-model-add common-fill  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                            <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                            </svg>@lang('website.Add to Cart')</button>
                          @else
                            <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill  add-to-Cart stock-cart"  hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                            <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                            </svg>@lang('website.Add to Cart')</button>

                            <div class="stock-out-cart" hidden style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                            <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" data-toggle="modal" data-target="#notifyModal" hidden type="button">@lang('website.notify')</button>
                          @endif
                        @else
                          <button class="btn btn-secondary btn-lg common-color detail-8-sub-btn-design common-bg-hover hover-model-add common-fill  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                          @endif
                    @endif
                  @endif

                  @if($result['detail']['product_data'][0]->products_type == 2)
                    <a href="{{$result['detail']['product_data'][0]->products_url}}" target="_blank" class="btn btn-secondary btn-lg detail-8-sub-btn-design  common-bg-hover hover-model-add common-fill">@lang('website.External Link')</a>
                  @endif     
                  
                  @if($result['detail']['product_data'][0]->products_type == 3)

                    <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_combo')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }
                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if(in_array('0',$stockarray))

                          <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                            <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                          <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                        </svg>@lang('website.Add to Cart')</button>

                        @endif
                        @else

<button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
<path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
</svg>@lang('website.Add to Cart')</button>

@endif
                    @else

                      <button class="btn btn-secondary btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart detail-8-sub-btn-design "  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>

                    @endif   
                  @endif   


                  @if($result['detail']['product_data'][0]->products_type == 4)

                    <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_buy_x')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }

                      $stocksgetx = 0;
                      $stockarraygetx = [];

                      $comboProgetx = DB::table('product_get_x')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboProgetx as $key=>$comboProdgetx){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocksgetx = $stocksin - $stockOut;
                          $stockarraygetx[$key] = $stocksgetx;
                          //print_r($stockarraygetx);
                      }
                      

                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if((in_array('0',$stockarray)) || (in_array('0',$stockarraygetx)))

                          <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                            <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                          <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                        </svg>@lang('website.Add to Cart')</button>

                        @endif
                        @else

<button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
<path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
</svg>@lang('website.Add to Cart')</button>

@endif
                    @else

                      <button class="btn btn-secondary btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart detail-8-sub-btn-design "  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>

                    @endif   
                  @endif   
        
          </div>

          @endif   

          @if($result['detail']['product_data'][0]->button_type == 2)
            <button type="button" class="btn btn-secondary btn-lg detail-8-sub-btn-design  common-bg-hover hover-model-add common-fill modal_show3" products_id="{{$result['detail']['product_data'][0]->products_id}}" style="color: #111;"  products_name="{{$result['detail']['product_data'][0]->products_name}}" >Book Appointment</button>
          @endif
          @if($result['detail']['product_data'][0]->button_type == 4)
            <input type="hidden"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="1">
          @endif

      @endif

         

          <div class="pro-sub-buttons detail-8-btn-display">
              <div class="buttons detail-8-d-flex">

              <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
                  {
                    $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $result['detail']['product_data'][0]->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
                    if($is_liked_products == '')
                    { ?>
                      <span type="button" id="detail_wish_molla_show_{{$result['detail']['product_data'][0]->products_id}}" class="wish_molla_show btn btn-link detail-8-d-btn cursor-pointer is_liked_molla_1" products_id="{{$result['detail']['product_data'][0]->products_id}}"><i class="fa fa-heart-o common-text" style="margin-right:10px"></i><spans class="hover-underline">ADD TO WISHLIST</spans></span>

                      <a href="{{url('wishlist')}}" ><span type="button" id="detail_wish_molla_hide_{{$result['detail']['product_data'][0]->products_id}}" class="wish_molla_hide btn btn-link detail-8-d-btn cursor-pointer is_liked_molla_1" style="display:none;"><i class="fa fa-heart common-text" style="margin-right:10px"></i><spans class="hover-underline">GO TO WISHLIST</spans></span></a>
              <?php } else { ?>
                      <a href="{{url('wishlist')}}" ><span type="button"  class="btn btn-link detail-8-d-btn cursor-pointer is_liked_molla_1"><i class="fa fa-heart common-text" style="margin-right:10px"></i><spans class="hover-underline">GO TO WISHLIST</spans></span></a>
              <?php } } else { ?>
                      <span type="button" class="btn btn-link detail-8-d-btn cursor-pointer is_liked_molla_1"  products_id="{{$result['detail']['product_data'][0]->products_id}}"><i class="fa fa-heart-o common-text" style="margin-right:10px"></i><spans class="hover-underline">ADD TO WISHLIST</spans></span>
              <?php } ?>

                  <!-- <span class="btn btn-link detail-8-d-btn cursor-pointer" products_id="{{$result['detail']['product_data'][0]->products_id}}"><i class="fa fa-heart-o common-text" style="margin-right:10px"></i><p class="hover-underline" style="display: inline;">ADD TO WISHLIST </p></span> -->

                  

                  
                  <button type="button" class="btn btn-link common-fill detail-8-d-btn" onclick="myFunction3({{$result['detail']['product_data'][0]->products_id}})"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 43.999 46.058" style="margin-right:10px">
          <path id="compare" d="M35.917,40.161H27.343L22.074,29.623l1.567-3.051,5.521,10.589h6.755V30.434L44,38.515l-8.082,7.543ZM0,40.161v-3H10.48l7.535-14.226L9.924,9.4H0v-3H11.626l8.031,13.437L26.5,6.908h9.413V0L44,8.081l-8.082,7.543V9.907H28.31L12.286,40.161Z" />
        </svg><span class="hover-underline">@lang('website.Add to Compare')</span></button>
              
              </div>

              </div>
          
        </form>

        



              <br>
<hr/>

<div class="pro-single-info pro-catgory" style="display:-webkit-box !important;font-size:14px;color:#777777"> @lang('website.Categroy')  : 
    @foreach($result['detail']['product_data'][0]->categories as $key=>$category)
    <a style="line-height:24px;color:#777777" class="hover-underline common-hover" href="{{url('shop?category='.$category->categories_slug)}}">{{$category->categories_name}}</a>,&nbsp;&nbsp;
    @endforeach

    </div> 
    <br>

        <div class="footer-darks" style="background:#fff">
          <div class="pro-single-info" style="margin-bottom:30px float:left;margin:0px 20px 0px 0px;font-size:14px">Share : 
            <div class="social-icons social-icons-color">
            @if($result['commonContent']['setting'][50]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-facebook common-hover" href="{{$result['commonContent']['setting'][50]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-facebook-f common-hover"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][52]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-twitter common-hover" href="{{$result['commonContent']['setting'][52]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-twitter"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][51]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-instagram common-hover" href="{{$result['commonContent']['setting'][51]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-google common-hover"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][53]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-youtube common-hover" href="{{$result['commonContent']['setting'][53]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-linkedin common-hover"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][216]->value!='')
                      <a style="width:2rem;height:2rem"  target="_blank" class="c777 social-icon social-youtube common-hover common-fill-hover" href="{{$result['commonContent']['setting'][216]->value}}">
                      <svg class='fontawesomesvg' width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][218]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-youtube common-hover" href="{{$result['commonContent']['setting'][218]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-instagram common-hover"></i>
                      </a>
                    @endif
            </div>
          </div>
              <!-- AddToAny BEGIN -->
              <!-- <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_email"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script> -->
                <!-- AddToAny END -->
              
          </div>
          
          </div>
        </div>


      </div>
    </div>

   
</div>
</div>

<section class="product-content pro-content">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-12">
        <div class="nav nav-pills justify-content-center  tab-active-common-color" role="tablist">
          <a class="nav-link nav-item detail-8-nav-hover detail-8-nav-align active" href="#description" id="description-tab" data-toggle="pill" role="tab">Description</a> 
          <a class="nav-link nav-item detail-8-nav-hover detail-8-nav-align" href="#addinfo" id="addinfo-tab" data-toggle="pill" role="tab" > Additional information</a>
          <a class="nav-link nav-item detail-8-nav-hover detail-8-nav-align" href="#shipreturn" id="shipreturn-tab" data-toggle="pill" role="tab" > Shipping & Returns</a>
          <a class="nav-link nav-item detail-8-nav-hover detail-8-nav-align" href="#review" id="review-tab" data-toggle="pill" role="tab" >@lang('website.Reviews') ({{$result['detail']['product_data'][0]->total_user_rated}})</a>
        </div> 
        

        <div class="tab-content detail-8-tab-content">
          <div role="tabpanel" class="tab-pane detail-8-tab-pane fade active show" id="description" aria-labelledby="description-tab">
            <?=stripslashes($result['detail']['product_data'][0]->products_description)?>                        
          </div>  
         
          <div role="tabpanel" class="tab-pane detail-8-tab-pane fade" id="addinfo" aria-labelledby="daddinfo-tab">
          <div class="pro-single-info pro-catgory" style="display:-webkit-box !important;font-size:14px;color:#777777">@lang('website.Product ID'):
    <span >{{$result['detail']['product_data'][0]->products_id}}</span></div>
          <div class="pro-single-info pro-catgory" style="display:-webkit-box !important;font-size:14px;color:#777777"> @lang('website.Categroy')  : 
    @foreach($result['detail']['product_data'][0]->categories as $key=>$category)
    <a style="line-height:24px;color:#777777" class="hover-underline common-hover" href="{{url('shop?category='.$category->categories_slug)}}">{{$category->categories_name}}</a>,&nbsp;&nbsp;
    @endforeach

    </div> 
    <div class="pro-single-info pro-catgory" style="display:-webkit-box !important;font-size:14px;color:#777777">     @lang('website.Available'):
          @if($result['detail']['product_data'][0]->products_type == 0)
            
            @if($result['commonContent']['settings']['Inventory'])
              @if($result['commonContent']['settings']['stock_availability'] == 1)
                  <span class="prd-in-stock">{{ $result['detail']['product_data'][0]->defaultStock }}</span>
              @else
                @if($result['detail']['product_data'][0]->defaultStock < 0)
                @if($result['detail']['product_data'][0]->stock_status == 1)
                  <span class="prd-in-stock" data-stock-status="">@lang('website.Out of Stock')</span>
                @else
                  <span class="prd-in-stock" data-stock-status="">@lang('website.In stock')</span>
                @endif
                @else
                  <span class="prd-in-stock" data-stock-status="">@lang('website.In stock')</span>
                @endif
              @endif
            @else 
              <span class="prd-in-stock" data-stock-status="">@lang('website.In stock')</span>    
            @endif
          @endif

          @if($result['detail']['product_data'][0]->products_type == 1)
          
            @if($result['commonContent']['settings']['Inventory'])
            @if($result['detail']['product_data'][0]->stock_status == 1)
              @if($result['commonContent']['settings']['stock_availability'] == 1)
                <span class="prd-in-stock" id="variable-count"></span>
              @else
                <span class="prd-in-stock" id="variable-status"></span>  
              @endif
              @else
                <span class="prd-in-stock" id="variable-status"></span>  
              @endif
          @endif
          @endif

              @if($result['detail']['product_data'][0]->products_type == 2)
              <span class="prd-in-stock" data-stock-status="">@lang('website.External Link')</span>
              @endif

              
    
    </div> 
    <div class="pro-single-info pro-catgory" style="display:-webkit-box !important;font-size:14px;color:#777777"> 
    @if($result['detail']['product_data'][0]->products_min_order>0)
    @lang('website.Min Order Limit'):
      <span>{{$result['detail']['product_data'][0]->products_min_order}}</span>
    
    @endif
    </div> 
    <div class="pro-single-info pro-catgory" style="display:-webkit-box !important;font-size:14px;color:#777777"> 
    @if($result['detail']['product_data'][0]->products_max_stock != 9999)
   @lang('website.Max Order Limit'):
      <span>{{$result['detail']['product_data'][0]->products_max_stock}}</span>
   
    @endif</div>
    <br>
                           
          </div>  
       
          <div role="tabpanel" class="tab-pane detail-8-tab-pane fade" id="shipreturn" aria-labelledby="shipreturn-tab">

            <div class="detail-8-product-desc-content">
              <h3>Delivery &amp; returns</h3>
              <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a>
              <br>
              We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
            </div>
                            
          </div>  
                <div role="tabpanel" class="tab-pane detail-8-tab-pane fade " id="review" aria-labelledby="review-tab">
                @if(isset($result['detail']['product_data'][0]->reviewed_customers))
                  <div class="reviews">
                    <h3>Reviews ({{$result['detail']['product_data'][0]->total_user_rated}})</h3>
                    @foreach($result['detail']['product_data'][0]->reviewed_customers as $key=>$rev)
                    <div class="review">
                      <div class="row no-gutters">
                        <div class="col-auto">
                          <h4><a href="#">{{$rev->customers_name}}</a></h4>
                          <div class="ratings-container">
                            <div class="pro-rating">
                              <fieldset class="disabled-ratings">  
                              <label class = "full fa @if($rev->reviews_rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>         
                              <label class = "full fa @if($rev->reviews_rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>
                              <label class = "full fa @if($rev->reviews_rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>  
                              <label class = "full fa @if($rev->reviews_rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>        
                                                                 
                                <label class = "full fa @if($rev->reviews_rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>
                                                                     
                                                                     
                               
                              </fieldset>                                          
                            </div>
                          </div>
                          <span class="review-date mb-1">{{date("d-M-Y", strtotime($rev->created_at))}}</span>
                        </div>
                        <div class="col">
                        
                          <div class="review-content">
                            <p>{{$rev->reviews_text}}</p>
                          </div>
                          <div class="review-action">
                            <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Helpful (2)</a>
                            <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>Unhelpful (0)</a>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    @endforeach   
                  </div>
                  @endif

                  @if(Auth::guard('customer')->check())

                  <div class="reply">
                    <div class="title-wrapper text-left">
                      <h3 class="title title-simple text-left text-normal">Add a Review</h3>
                      <p>Your email address will not be published. Required fields are marked *</p>
                    </div>
                  

                    <form id="idForm">
                            {{csrf_field()}}
                            <input value="{{$result['detail']['product_data'][0]->products_id}}" type="hidden" name="products_id">
                            <input type="hidden" name="products_name" value="{{$result['detail']['product_data'][0]->products_name}}">
                        
                          <div class="write-review-box">
                              <div class="from-group row mb-3">
                                  <div class="col-12">  <label for="rating" class="detail-8-rating text-dark">Your rating * </label>
                                  

                                    <fieldset class="ratings">
                                      
                                      <input type="radio" id="star5" name="rating" value="5" class="rating"/>
                                      <label class = "full fa" for="star5" title="@lang('website.awesome_5_stars')"></label>

                                      <input type="radio" id="star4" name="rating" value="4" class="rating"/>
                                      <label class="full fa" for="star4" title="@lang('website.pretty_good_4_stars')"></label>

                                      <input type="radio" id="star3" name="rating" value="3" class="rating"/>
                                      <label class = "full fa" for="star3" title="@lang('website.good_3_stars')"></label>

                                      <input type="radio" id="star2" name="rating" value="2" class="rating"/>
                                      <label class="full fa" for="star2" title="@lang('website.average_2_stars')"></label>

                                      <input type="radio" id="star1" name="rating" value="1" class="rating"/>
                                      <label class = "full fa" for="star1" title="@lang('website.bad_1_stars')"></label> 
                                    
                                  </fieldset>                                     
                                  </div>      
                                 
                              </div> 
                              <div class="from-group row mb-3">  
                                <div class="col-12">    
                                  <textarea id="reviews_text" name="reviews_text"  cols="30" rows="6" class="form-control mb-2" placeholder="Comment *" required=""></textarea>
                                </div>
                              </div>

                              <div class="from-group row mb-3">  
                                <div class="col-12">    
                                  <div class="row">
                                    <div class="col-md-6">
                                   
                                      <input type="text" class="form-control" id="name" name="name" placeholder="Name *" required="">
                                    </div>
                                    <div class="col-md-6">
                                      <input type="email" class="form-control" id="email" name="email" placeholder="Email *" required="">
                                    </div>
                                  </div>
                                </div>
                              </div>
                                           
                             
                             

                                <div class="alert alert-danger" hidden id="review-error" role="alert">
                                 @lang('website.Please enter your review')
                                </div>

                                <div class="form-checkbox d-flex align-items-start mb-2">
                          <input type="checkbox" class="custom-checkbox" id="signin-remember" name="signin-remember">
                          <label class="form-control-label ml-3" for="signin-remember">Save my name, email, and website in this browser for the next time I comment.</label>
                        </div>

                                <div class="from-group">
                                    <button type="submit" id="review_button" disabled class="btn btn-secondary swipe-to-top">@lang('website.Submit')</button>                                    
                                </div>
                          </div>
                          
                        </form>


                 
                    </div>


                    @endif


                
                      
                    </div>

                      
                  </div> 
              </div>
          </div>  



<section class="product-content pro-content" style="padding-bottom:40px;">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-12 col-lg-6">
              <div class="pro-heading-title">
                <h2> @lang('website.Related Products')
                </h2>
                <!-- <p> 
                  @lang('website.Related Products Text') -->
                </div>
          </div>
    
        </div>
  </div>
  <div class="general-product">
    <div class="container p-0">
        <div class="product-carousel-js">      
              @foreach($result['simliar_products']['product_data'] as $key=>$products)
                @if($result['detail']['product_data'][0]->products_id != $products->products_id)                     
                <div class="slik">
                  @include('web.common.product')
                </div>  
                @endif
                @endforeach  
          </div>  
    </div>
  </div>  


  </section>

  <div class="detail-8-sticky-bar sticky-bar-script">
    <div class="container">
      <div class="row">
        <div class="col-6 detail-8-sticky-bar-col">
          <figure class="product-media">
            <a href="{{ URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}"><img src="{{asset($result['detail']['product_data'][0]->default_images) }}" alt="{{$result['detail']['product_data'][0]->products_name}}" width="300" height="300"></a>
          </figure>
          <h3 class="product-title"><a href="{{ URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}">{{$result['detail']['product_data'][0]->products_name}}</a></h3>
        </div>
        <div class="col-6 justify-content-end detail-8-sticky-bar-col">
          <div class="product-price"> 
            
          <div class="price">                     
            <?php

            if(!empty($result['detail']['product_data'][0]->discount_price)){
              $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
            }
            if(!empty($result['detail']['product_data'][0]->flash_price)){
              $flash_price = $result['detail']['product_data'][0]->flash_price * session('currency_value');
            }
              $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');


             if(!empty($result['detail']['product_data'][0]->discount_price)){

              if(($orignal_price+0)>0){
                $discounted_price = $orignal_price-$discount_price;
                $discount_percentage = $discounted_price/$orignal_price*100;
                $discounted_price = $result['detail']['product_data'][0]->discount_price;

             }else{
               $discount_percentage = 0;
               $discounted_price = 0;
             }
            }
            else{
              $discounted_price = $orignal_price;
            }
            //  dd($result['currency_value']);
            ?>
            @if(!empty($result['detail']['product_data'][0]->flash_price))
            <price class="total_price common-color detail-8-new-price" id="total_dis_price">{{Session::get('symbol_left')}}{{$flash_price}}{{Session::get('symbol_right')}}</price>
            <span class="detail-8-old-price">{{Session::get('symbol_left')}}{{number_format($orignal_price,$decimal_places)}}{{Session::get('symbol_right')}} </span> 

            @elseif(!empty($result['detail']['product_data'][0]->discount_price))
            <price class="total_price common-color detail-8-new-price" id="total_dis_price">{{Session::get('symbol_left')}}{{$discount_price}}{{Session::get('symbol_right')}}</price>
            <span class="detail-8-old-price" id="total_org_price">{{Session::get('symbol_left')}}{{number_format($orignal_price,$decimal_places)}}{{Session::get('symbol_right')}} </span> 
            @else
            
            <price class="total_price common-color detail-8-new-price" id="total_dis_price">{{Session::get('symbol_left')}} {{ number_format($orignal_price,$decimal_places) }} {{Session::get('symbol_right')}}</price>
            @endif
                               
            </div>
          </div>
          @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)
          <div class="product-details-quantity "> <div class="detail-8-qty-box-inner">
    <span class="input-group-btn detail-8-plus-min-width">        
      <button type="button" class="quantity-minus1 btn qtyminus qtynewpad detail-8-plus-min-width-right">
          <i class="fas fa-minus"></i>
        </button>
      </span>

                           
                  {{-- <input type="text" id="quantity1" name="quantity" class="form-control" value="10">                       --}}
                   @if($result['detail']['product_data'][0]->products_type == 0)

                   @if($result['commonContent']['settings']['Inventory'] == 0)
                    @if($result['detail']['product_data'][0]->products_max_stock == 0)
                        <input type="text" style="background: #f7f7f8;height:40px !important;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="9999999">    <span class="input-group-btn">
                      @else
                        <input type="text" style="background: #f7f7f8;height:40px !important;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
                      @endif
                    @else
                        
                    @if($result['detail']['product_data'][0]->products_max_stock == 0)
                        <input type="text" style="background: #f7f7f8;height:40px !important;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="9999999">    <span class="input-group-btn">
                      @else
                      <input type="text" style="background: #f7f7f8;height:40px !important;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->defaultStock}}">    <span class="input-group-btn">

                    @endif
                    @endif
                    

                  @elseif($result['detail']['product_data'][0]->products_type == 1)

                  <input type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">

                  @else

                  <input type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">

                  @endif

                  <input type="hidden" id="max_stock_one" value="{{$result['detail']['product_data'][0]->products_max_stock}}">

                  <span class="input-group-btn detail-8-plus-min-width">
          <button type="button" class="quantity-plus1 btn qtyplus qtynewpad detail-8-plus-min-width-left">
              <i class="fas fa-plus"></i>
          </button>
      </span>
                </div></div>
          
          <div class="product-details-action">
          @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date )
                  @else
                    @if($result['detail']['product_data'][0]->products_type == 0)
                    
                      @if($result['commonContent']['settings']['Inventory'])
                      @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if($result['detail']['product_data'][0]->defaultStock <= 0)
                         <!--  <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div> -->
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>
                          @else
                              <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                          @endif
                      @else
                      <button class="btn btn-secondary btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart detail-8-sub-btn-design "  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                      @endif

                      @elseif($result['detail']['product_data'][0]->products_type == 1)
                            @if($result['commonContent']['settings']['Inventory'])
                            @if($result['detail']['product_data'][0]->stock_status == 1)
                            <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill  add-to-Cart stock-cart"  hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                        <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                      </svg>@lang('website.Add to Cart')</button>
                           <!--  <div class="stock-out-cart" hidden style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div> -->
                            <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" data-toggle="modal" data-target="#notifyModal" hidden type="button">@lang('website.notify')</button>
                            @else
                            <button class="btn btn-secondary btn-lg common-color detail-8-sub-btn-design common-bg-hover hover-model-add common-fill  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                        <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                      </svg>@lang('website.Add to Cart')</button>
                            @endif
                            @else
                            <button class="btn btn-secondary btn-lg common-color detail-8-sub-btn-design common-bg-hover hover-model-add common-fill  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                        <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                      </svg>@lang('website.Add to Cart')</button>
                            @endif
                    @endif
                 

                  @if($result['detail']['product_data'][0]->products_type == 2)
                    <a href="{{$result['detail']['product_data'][0]->products_url}}" target="_blank" class="btn btn-secondary btn-lg detail-8-sub-btn-design  common-bg-hover hover-model-add common-fill">@lang('website.External Link')</a>
                  @endif        
                  
                  
                  @if($result['detail']['product_data'][0]->products_type == 3)

                    <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_combo')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }
                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if(in_array('0',$stockarray))

                          <!-- <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div> -->
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                              <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                            <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                          </svg>@lang('website.Add to Cart')</button>
                        @endif
                        @else

                              <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                            <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                          </svg>@lang('website.Add to Cart')</button>
                        @endif
                    @else

                      <button class="btn btn-secondary btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart detail-8-sub-btn-design "  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>

                    @endif   
                  @endif   


                  @if($result['detail']['product_data'][0]->products_type == 4)

                    <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_buy_x')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }
                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if(in_array('0',$stockarray))

                          <!-- <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div> -->
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                              <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                            <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                          </svg>@lang('website.Add to Cart')</button>
                        @endif
                        @else

                              <button class="btn btn-secondary detail-8-sub-btn-design  btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart" type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                            <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                          </svg>@lang('website.Add to Cart')</button>
                        @endif
                    @else

                      <button class="btn btn-secondary btn-lg common-color common-bg-hover hover-model-add common-fill add-to-Cart detail-8-sub-btn-design "  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>

                    @endif   
                  @endif   
        
          </div>

          @endif   
          @endif   

          @if($result['detail']['product_data'][0]->button_type == 2)
            <button type="button" class="btn btn-secondary btn-lg detail-8-sub-btn-design  common-bg-hover hover-model-add common-fill modal_show3" style="color: #111;margin-left:20px;" products_id="{{$result['detail']['product_data'][0]->products_id}}"  products_name="{{$result['detail']['product_data'][0]->products_name}}" >Book Appointment</button>
          @endif
          @if($result['detail']['product_data'][0]->button_type == 4)
            <input type="hidden"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="1">
          @endif

          <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
                  {
                    $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $result['detail']['product_data'][0]->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
                    if($is_liked_products == '')
                    { ?>
                      <span id="detail_sticky_wish_molla_show_{{$result['detail']['product_data'][0]->products_id}}" class="wish_molla_show cursor-pointer is_liked_molla_1" products_id="{{$result['detail']['product_data'][0]->products_id}}" style="margin-left: 20px;"><i class="fa fa-heart-o common-text" style="margin-right:10px;font-size:16px;"></i></span>

                      <a href="{{url('wishlist')}}" ><span id="detail_sticky_wish_molla_hide_{{$result['detail']['product_data'][0]->products_id}}" class="wish_molla_hide cursor-pointer is_liked_molla_1" style="display:none;margin-left: 20px;"><i class="fa fa-heart common-text" style="margin-right:10px;font-size:16px;"></i></span></a>
              <?php } else { ?>
                      <a href="{{url('wishlist')}}" ><span class="cursor-pointer is_liked_molla_1" style="margin-left: 20px;"><i class="fa fa-heart common-text" style="margin-right:10px;font-size:16px;"></i></span></a>
              <?php } } else { ?>
                      <span class="cursor-pointer is_liked_molla_1"  products_id="{{$result['detail']['product_data'][0]->products_id}}" style="margin-left: 20px;"><i class="fa fa-heart-o common-text" style="margin-right:10px;font-size:16px;"></i></span>
              <?php } ?>

        <!--   <span class="is_liked cursor-pointer" products_id="{{$result['detail']['product_data'][0]->products_id}}" style="
    margin-left: 20px;"><i class="fa fa-heart-o common-text" style="margin-right:10px;font-size:16px;"></i></span> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>



  <script>

    

  jQuery(window).scroll(function() {
    // declare variable
    var topPos = jQuery(this).scrollTop();


	if (topPos < 500) {
	  jQuery(".sticky-bar-script").css("display", "none");

    } else {
	  jQuery(".sticky-bar-script").css("display", "block");
    }
  });



$('.product-img--main')
        // tile mouse actions
        .on('mouseover', function(){
          $(this).children('.product-img--main__image').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
        })
        .on('mouseout', function(){
          $(this).children('.product-img--main__image').css({'transform': 'scale(1)'});
        })
        .on('mousemove', function(e){
          $(this).children('.product-img--main__image').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
        })
        // tiles set up
        .each(function(){
          $(this)
            // add a image container
            .append('<div class="product-img--main__image"></div>')
            // set up a background image for each tile based on data-image attribute
            .children('.product-img--main__image').css({'background-image': 'url('+ $(this).attr('src') +')'});
        });

// Product SLICK
jQuery('.slider-for-detail8').slick({
  slidesToShow: 1,
  slidesToScroll:1,
  arrows: false,
  infinite: false,
  draggable: false,
  fade: true,
asNavFor: '.slider-nav-detail8',
adaptiveHeight: true
});
jQuery('.slider-nav-detail8').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for-detail8',
  centerMode: false,
  centerPadding: '0px',
  draggable: false,
  infinite: false,
  dots: false,
  arrows: false,
  vertical: false,
  focusOnSelect: true
 
});
</script>



  <script>
 jQuery(document).ready(function(e) {
$(".slick-arrow").click(function(){
  $('iframe').each(function(index) {
   $(this).attr('src', $(this).attr('src'));
  
 });
 
});

});

function pauseVideo() {
 
 // changes the iframe src to prevent playback or stop the video playback in our case
 $('iframe').each(function(index) {
   $(this).attr('src', $(this).attr('src'));
  
 });
 
//click function


   }
   function convertTZ(date, tzString) {
    return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
}



    jQuery(document).ready(function(e) {
    
      @if(!empty($result['detail']['product_data'][0]->flash_start_date))
         @if( date("Y-m-d",$result['detail']['product_data'][0]->server_time) >= date("Y-m-d",$result['detail']['product_data'][0]->flash_start_date))
          var product_div_{{$result['detail']['product_data'][0]->products_id}} = 'product_div_{{$result['detail']['product_data'][0]->products_id}}';
        var  counter_id_{{$result['detail']['product_data'][0]->products_id}} = 'counter_{{$result['detail']['product_data'][0]->products_id}}';
        var inputTime_{{$result['detail']['product_data'][0]->products_id}} = "{{date('M d, Y H:i:s' ,$result['detail']['product_data'][0]->flash_expires_date)}}";
    
        // Set the date we're counting down to
        var countDownDate_{{$result['detail']['product_data'][0]->products_id}} = new Date(inputTime_{{$result['detail']['product_data'][0]->products_id}}).getTime();
    
        // Update the count down every 1 second
        var x_{{$result['detail']['product_data'][0]->products_id}} = setInterval(function() {
    
          var new_now = convertTZ(new Date(), "Asia/Kuala_Lumpur");
   // Get todays date and time
   var now = new_now.getTime();
    
          // Find the distance between now and the count down date
          var distance_{{$result['detail']['product_data'][0]->products_id}} = countDownDate_{{$result['detail']['product_data'][0]->products_id}} - now;
    
          // Time calculations for days, hours, minutes and seconds
          var days_{{$result['detail']['product_data'][0]->products_id}} = Math.floor(distance_{{$result['detail']['product_data'][0]->products_id}} / (1000 * 60 * 60 * 24));
          var hours_{{$result['detail']['product_data'][0]->products_id}} = Math.floor((distance_{{$result['detail']['product_data'][0]->products_id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes_{{$result['detail']['product_data'][0]->products_id}} = Math.floor((distance_{{$result['detail']['product_data'][0]->products_id}} % (1000 * 60 * 60)) / (1000 * 60));
          var seconds_{{$result['detail']['product_data'][0]->products_id}} = Math.floor((distance_{{$result['detail']['product_data'][0]->products_id}} % (1000 * 60)) / 1000);
          var days_text = "@lang('website.Days')";
          // Display the result in the element with id="demo"
          document.getElementById(counter_id_{{$result['detail']['product_data'][0]->products_id}}).innerHTML = "<span class='days'>"+days_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Days')</small></span> <span class='hours'>" + hours_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Hours')</small></span> <span class='mintues'> "
          + minutes_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Minutes')</small></span> <span class='seconds'>" + seconds_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Seconds')</small></span> ";
    
          // If the count down is finished, write some text
          if (distance_{{$result['detail']['product_data'][0]->products_id}} < 0) {
          clearInterval(x_{{$result['detail']['product_data'][0]->products_id}});
          //document.getElementById(counter_id_{{$result['detail']['product_data'][0]->products_id}}).innerHTML = "EXPIRED";
          document.getElementById('product_div_{{$result['detail']['product_data'][0]->products_id}}').remove();
          }
        }, 1000);
           @endif
       @endif
    
  
    });
    </script>

    
    