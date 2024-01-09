<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />

@if(!empty($result['commonContent']['setting'][72]->value))
<title><?=stripslashes($result['commonContent']['setting'][72]->value)?></title>
@else
<title><?=stripslashes($result['commonContent']['setting'][18]->value)?></title>
@endif

@if(!empty($result['commonContent']['setting'][86]->value))
<link rel="icon" type="image/png" href="{{asset('').$result['commonContent']['setting'][86]->value}}">
@endif


<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Core CSS Files -->
<link rel="stylesheet" type="text/css" href="https://common.platinum24.net/web/css/{{$result['commonContent']['setting'][81]->value}}.css">
<link rel="stylesheet" type="text/css" href="https://common.platinum24.net/web/css/{{$result['commonContent']['setting'][153]->value}}.css">
<link rel="stylesheet" type="text/css" href="https://common.platinum24.net/web/css/product_card.css">
<link rel="stylesheet" type="text/css" href="https://common.platinum24.net/web/css/tbmstyle.css">


<link rel="stylesheet" type="text/css" href="https://common.platinum24.net/web/css/select2.css">
  <script src="https://common.platinum24.net/web/js/select2.js"></script>



	




@if(Request::path() == 'checkout')
	<!--------- stripe js ------>
	<script src="https://js.stripe.com/v3/"></script>

	<link rel="stylesheet" type="text/css" href="https://common.platinum24.net/web/remembirdme/css/stripe.css" data-rel-css="" />

	<!------- razorpay ---------->
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

@endif
 
<!---- onesignal ------>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
var OneSignal = window.OneSignal || [];
OneSignal.push(function() {
	OneSignal.init({
	appId: "{{$result['commonContent']['setting'][55]->value}}",
	notifyButton: {
		enable: true,
	},
	allowLocalhostAsSecureOrigin: true,
	});
});

</script>	

@if(!empty($result['commonContent']['settings']['before_head_tag']))
	<?=stripslashes($result['commonContent']['settings']['before_head_tag'])?>
@endif

<style>
	.form-validate .form-row .has-error .form-control {
		color: red !important;
		border-color: red !important;
	}
	.has-error .error-content{
		color: red !important;
		float: left;
		width: 100%;
	}

	.media-main .media h3{
		border-radius: 100%;
		padding: 4px 10px 2px;
		margin-top: 0px;
		margin-bottom: 1px;
		background-color: #dbdbdb;
		text-transform: uppercase;

	}
	.avatar h3 {
		border-radius: 100%;
		padding: 1px 5px 0px;
		margin-top: 0px;
		margin-bottom: 0px;
		background-color: #dbdbdb;
		text-transform: uppercase;
		color: #333;
		font-size: 16px;
	}
	.footer-one .mail li a {
		word-break: break-all;
	}
</style>


<!-- product card style 1 -->
<style>
  
</style>

<!-- product card 2 -->

<style>
  .ajax_product_2 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
  .ajax_product_2 .pricetag .price {
    font-size: 1rem;
}
.ajax_product_2 .pricetag .price span {
    font-size: 0.8rem;
}
 
  @media only screen and (max-width: 1024px)
{
  

  .ajax_product_2 article .content .title {
    font-size: 14px;
}
.form-inline {
    flex-flow: unset;
}

 .ajax_product_2 .pricetag .price  {
      font-size: 0.8rem !important;
    }
     .ajax_product_2 .pricetag .price span {
      font-size: 0.7rem !important;
    }
    .col-6 .ajax_product_2  .pricetag .price  {
        font-size: 0.8rem !important;
    }
    .col-6 .ajax_product_2 .pricetag .price span {
      font-size: 0.7rem !important;
    }


.griding4 .ajax_product_2 .pricetag .price {
    font-size: 0.8rem;
}
.griding4 .ajax_product_2 .pricetag .price span {
    font-size: 0.7rem;
}
.griding4 .ajax_product_2 .pricetag .icon {
    width: 35px !important;
    height: 35px !important;
  }
 
}
@media only screen and (max-width: 420px)
{
  .ajax_product_2 article .content .title {
    font-size: 11px;
}

.ajax_product_2 .pricetag .price {
    font-size: 0.9rem;
}
.ajax_product_2 .pricetag .price span {
    font-size: 0.6rem;
}

}

@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_2 .height768{
    height: 300px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_2 .height768 {
    height: 300px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_2 .height768 {
    height: 200px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_2 .height768 {
    height: 200px !important;
}
}
  </style>

  <!-- product card style 3 -->

  <style>
  .ajax_product_3 article .desktop-hover .icon {
    margin: 10px !important;
  }
  .ajax_product_3 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_3 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_3 article .desktop-hover .icon {
    margin: 10px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_3 .form-inline {
    flex-flow: unset;
}
.ajax_product_3 article .content .title {
    font-size: 14px;
}
.ajax_product_3 article .content .price {
    font-size: 1rem;
}
.ajax_product_3 article .content .price span {
    font-size: 1rem;
}
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_3 .height768{
    height: 330px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_3 .height768 {
    height: 450px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_3 .height768 {
    height: 325px !important;
}
.ajax_product_3 article .content .title {
    font-size: 11px;
}
.ajax_product_3 .btn-hover {
    position: relative !important;
}

.ajax_product_3 article .content .price {
    font-size: 0.9rem;
}
.ajax_product_3 article .content .price span {
    font-size: 0.9rem;
}
.ajax_product_3 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.col-6 .ajax_product_3 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_3 article .content .price  span{
    font-size: 0.9rem !important;
}
}
@media only screen and (max-width: 367px)
{
  .ajax_product_3 .height768 {
    height: 285px !important;
}
}

@media only screen and (max-width: 320px)
{
 
.col-6 .ajax_product_3 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_3 article .content .price  span{
    font-size: 0.8rem !important;
}

}
  </style>

  <!-- product card style 4 -->
  <style>
  .ajax_product_4 article .desktop-hover .icon {
    margin: 10px !important;
  }
  .ajax_product_4 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_4 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}
  @media only screen and (max-width: 1024px)
{
  .ajax_product_4 .form-inline {
    flex-flow: unset;
}
.ajax_product_4 article .content .title {
    font-size: 14px;
}
.ajax_product_4 article .content .price {
    font-size: 1rem;
}
.ajax_product_4 article .content .price span {
    font-size: 1rem;
}
  
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_4 .height768{
    height: 340px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_4 .height768 {
    height: 465px !important;
}
}

@media only screen and (max-width: 420px)
{
  .ajax_product_4 .height768 {
    height: 335px !important;
  }
  .ajax_product_4 article .content .title {
    font-size: 11px;
}

.ajax_product_4 article .content .price {
    font-size: 0.9rem;
}
.ajax_product_4 article .content .price span {
    font-size: 0.9rem;
}
.ajax_product_4 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.ajax_product_4 .product-action {
    position: relative;
 
}
.col-6 .ajax_product_4 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_4 article .content .price  span{
    font-size: 0.8rem !important;
}
}

@media only screen and (max-width: 367px)
{
  .ajax_product_4 .height768 {
    height: 300px !important;
}
}
@media only screen and (max-width: 320px)
{
 
.col-6 .ajax_product_4 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_4 article .content .price  span{
    font-size: 0.9rem !important;
}

}
  </style>

   <!-- product card style 5 -->

   <style>
   .ajax_product_5 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_5 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}
 
  @media only screen and (max-width: 1024px)
{
  .ajax_product_5 article .content .title {
    font-size: 14px;
}
.ajax_product_5 .fa-shopping-bag
{
  margin-right: 3px;
}
.ajax_product_5 .form-inline {
    flex-flow: unset;
}

.ajax_product_5 article .content .price {
    font-size: 1rem;
}
.ajax_product_5 article .content .price span {
    font-size: 1rem;
}
.ajax_product_5 .btn {
    padding: 0.4rem 0.7rem;
    font-size: 0.75rem;
}
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_5 .height768{
    height: 325px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_5 .height768 {
    height: 445px !important;
}
}

@media only screen and (max-width: 420px)
{
  .ajax_product_5 .height768 {
    height: 290px !important;
}
.ajax_product_5 article .content .title {
    font-size: 11px;
}

.ajax_product_5 article .content .price {
    font-size: 0.9rem;
}
.ajax_product_5 article .content .price span {
    font-size: 0.9rem;
}
.ajax_product_5 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.col-6 .ajax_product_5 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_5 article .content .price  span{
    font-size: 0.9rem !important;
}
}
@media only screen and (max-width: 367px)
{
  .ajax_product_5 .height768 {
    height: 285px !important;
}
}
@media only screen and (max-width: 320px)
{
 
.col-6 .ajax_product_5 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_5 article .content .price  span{
    font-size: 0.8rem !important;
}

}
  </style>

<!-- product card style 6 -->

<style>
  .ajax_product_6 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_6 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}
.ajax_product_6 article .desktop-hover .icon {
    margin: 10px !important;
  }
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_6 article .desktop-hover .icon {
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_6 .form-inline {
    flex-flow: unset;
}
.ajax_product_6 .fa-shopping-bag
{
  margin-right: 3px;
}
.ajax_product_6 .product article .content .title {
    font-size: 14px;
}
.ajax_product_6 article .content .price {
    font-size: 1rem;
}
.ajax_product_6 article .content .price span {
    font-size: 1rem;
}
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
   .height768{
    height: 290px !important;
}
}

@media only screen and (max-width: 768px)
{
   .height768 {
    height: 300px !important;
}
}

@media only screen and (max-width: 420px)
{
   .height768 {
    height: 200px !important;
}
.ajax_product_6 .product article .content .title {
    font-size: 11px;
}
.ajax_product_6 .btn-hover {
    position: relative !important;
}

.ajax_product_6 article .content .price {
    font-size: 0.9rem;
}
.ajax_product_6 article .content .price span {
    font-size: 0.9rem;
}
.col-6 ..ajax_product_6 article .content .price {
    font-size: 0.9rem;
}
.col-6 .ajax_product_6 article .content .price  span{
    font-size: 0.9rem;
}
.ajax_product_6 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.col-6 .ajax_product_6 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_6 article .content .price  span{
    font-size: 0.9rem !important;
}
}

@media only screen and (max-width: 367px)
{
   .height768 {
    height: 250px !important;
}
}

@media only screen and (max-width: 320px)
{
 
.col-6 .ajax_product_6 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_6 article .content .price  span{
    font-size: 0.8rem !important;
}

}
  </style>

  <!-- product card style 7 -->
  <style>

.ajax_product_7 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.listing .ajax_product_7 .thumb{
  width: 35% !important;
  display:inline-block;
}

.listing .ajax_product_7 .content{
  width: 65% !important;
  display:inline-block;
  text-align:left !important;
}
.listing .ajax_product_7 article .content .title {
  text-align:left !important;
}
 
  @media only screen and (max-width: 1024px)
{
  .ajax_product_7 article .content .title {
    font-size: 14px;
}
.ajax_product_7 .fa-shopping-bag
{
  margin-right: 3px;
}
.ajax_product_7 .form-inline {
    flex-flow: unset;
}

.ajax_product_7 article .content .price {
    font-size: 1rem;
}
.ajax_product_7 article .content .price span {
    font-size: 1rem;
}
.ajax_product_7 .btn {
    padding: 0.4rem 0.7rem;
    font-size: 0.75rem;
}
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_7 .height768{
    height: 325px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_7 .height768 {
    height: 445px !important;
}
}

@media only screen and (max-width: 420px)
{
  .ajax_product_7 .height768 {
    height: 290px !important;
}
.ajax_product_7 article .content .title {
    font-size: 11px;
}

.ajax_product_7 article .content .price {
    font-size: 0.9rem;
}
.ajax_product_7 article .content .price span {
    font-size: 0.9rem;
}
.ajax_product_7 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.col-6 .ajax_product_7 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_7 article .content .price  span{
    font-size: 0.9rem !important;
}
}

@media only screen and (max-width: 367px)
{
  .ajax_product_7 .height768 {
    height: 285px !important;
}
}
@media only screen and (max-width: 320px)
{
 
.col-6 .ajax_product_7 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_7 article .content .price  span{
    font-size: 0.8rem !important;
}

}
  </style>

   <!-- product card style 8 -->

   <style>
 
  @media only screen and (max-width: 1024px)
{
  .ajax_product_8 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_8 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}
.ajax_product_8 .height768 {
    border-radius: 10px;
}
.ajax_product_8 article .content .title {
    font-size: 14px;
}
.ajax_product_8 .fa-shopping-bag
{
  margin-right: 3px;
}
.ajax_product_8 .form-inline {
    flex-flow: unset;
}
.griding4 .ajax_product_8 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }

  .ajax_product_8 article .content .price {
    font-size: 1rem;
}
.ajax_product_8 article .content .price span {
    font-size: 1rem;
}
.ajax_product_8 .btn {
    padding: 0.4rem 0.7rem;
    font-size: 0.75rem;
}
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_8 .height768{
    height: 305px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_8 .height768 {
    height: 453px !important;
}
}


@media only screen and (max-width: 420px)
{
  .ajax_product_8 .height768 {
    height: 300px !important;
}
.ajax_product_8 article .content .title {
    font-size: 11px;
}

.ajax_product_8 article .content .price {
    font-size: 0.9rem;
}
.ajax_product_8 article .content .price span {
    font-size: 0.9rem;
}
.ajax_product_8 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.col-6 .ajax_product_8 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_8 article .content .price  span{
    font-size: 0.9rem !important;
}
}
@media only screen and (max-width: 367px)
{
  .ajax_product_8 .height768 {
    height: 295px !important;
}
}
@media only screen and (max-width: 320px)
{
 
.col-6 .ajax_product_8 article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_8 article .content .price  span{
    font-size: 0.8rem !important;
}

}
  </style>

 <!-- product card style 9 -->

 <style>
  .ajax_product_9 .pricetag .price {
    font-size: 1rem !important;
}
.ajax_product_9 .pricetag .price span {
    font-size: 1rem !important;
}
.ajax_product_9 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
 
  @media only screen and (max-width: 1024px)
{
  

  .ajax_product_9 article .content .title {
    font-size: 14px;
}
.ajax_product_9 .form-inline {
    flex-flow: unset;
}

.griding4 .ajax_product_9 .pricetag .price {
    font-size: 0.8rem !important;
}
.griding4 .ajax_product_9 .pricetag .price span {
    font-size: 0.7rem !important; 
}
.griding4 .ajax_product_9 .pricetag .icon {
    width: 35px !important;
    height: 35px !important;
  }
 
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_9 .height768{
    height: 305px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_9 .height768 {
    height: 425px !important;
}
}

@media only screen and (max-width: 420px)
{
  .ajax_product_9 .height768 {
    height: 260px !important;
}

.ajax_product_9 article .content .title {
    font-size: 11px;
}

.ajax_product_9 .pricetag .price {
    font-size: 0.8rem !important;
}
.ajax_product_9 .pricetag .price span {
    font-size: 0.6rem !important;
}
}
@media only screen and (max-width: 367px)
{
  .ajax_product_9 .height768 {
    height: 260px !important;
}
}
@media only screen and (max-width: 320px)
{
  .ajax_product_9 article .content .title {
    font-size: 11px;
}

.ajax_product_9 .pricetag .price {
    font-size: 0.7rem  !important;
}
.ajax_product_9 .pricetag .price span {
    font-size: 0.6rem !important;
}

}
  </style>

  <!-- product card style 10 -->
  <style>
.ajax_product_10 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
</style>


<style>
  .ajax_product_10 .pricetag .price {
    font-size: 1rem;
}
.ajax_product_10 .pricetag .price span {
    font-size: 0.8rem;
}
 
  @media only screen and (max-width: 1024px)
{
  

  .ajax_product_10 article .content .title {
    font-size: 14px;
}
.form-inline {
    flex-flow: unset;
}

.griding4 .ajax_product_10 .pricetag .price {
    font-size: 0.8rem;
}
.griding4 .ajax_product_10 .pricetag .price span {
    font-size: 0.7rem;
}
.griding4 .ajax_product_10 .pricetag .icon {
    width: 35px !important;
    height: 35px !important;
  }
 
}
@media only screen and (max-width: 420px)
{
  .ajax_product_10 article .content .title {
    font-size: 11px;
}

.ajax_product_10 .pricetag .price {
    font-size: 0.6rem !important;
}
.ajax_product_10 .pricetag .price span {
    font-size: 0.6rem !important;
}

}


@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_10 .height768{
    height: 300px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_10 .height768 {
    height: 300px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_10 .height768 {
    height: 200px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_10 .height768 {
    height: 200px !important;
}
}
  </style>

    <!-- product card style 11 -->

	<style>
.ajax_product_11 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_11 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_11 .height768{
    height: 305px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_11 .height768 {
    height: 425px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_11 .height768 {
    height: 270px !important;
}



}
@media only screen and (max-width: 367px)
{
  .ajax_product_11 .height768 {
    height: 270px !important;
}
}
.ajax_product_11 article .desktop-hover .icon {
    margin: 10px !important;
  }

  .ajax_product_11 .btn-danger{
    border-radius:5px;
  }
  .ajax_product_11 .btn-secondary{
    border-radius:5px;
  }

  .ajax_product_11 .icon{
    border-radius:50%;
  }
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_11 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_11 .form-inline {
    flex-flow: unset;
}
.ajax_product_11 article .content .title {
    font-size: 14px;
}
.ajax_product_11 article .content .price {
    font-size: 1rem;
}
.ajax_product_11 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_11 article .content .title {
    font-size: 11px;
}

.ajax_product_11  article .content .price {
    font-size: 0.8rem  !important;
}
.ajax_product_11  article .content .price span {
    font-size: 0.8rem !important;
}
.col-6 .ajax_product_11  article .content .price {
  font-size: 0.8rem  !important;
}
.col-6 .ajax_product_11  article .content .price span {
  font-size: 0.8rem  !important;
}
.ajax_product_11 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
}

@media only screen and (max-width: 320px)
{
 
.ajax_product_11  article .content .price {
    font-size: 0.8rem  !important;
}
.ajax_product_11  article .content .price span {
    font-size: 0.8rem !important;
}
.col-6 .ajax_product_11  article .content .price {
  font-size: 0.8rem  !important;
}
.col-6 .ajax_product_11  article .content .price span {
  font-size: 0.8rem  !important;
}

}
  </style>

 <!-- product card style 12 -->

<style>
.ajax_product_12 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
</style>
<style>
.ajax_product_12 .disabled-ratings > label {
    float: none !important;
}
.listing .ajax_product_12 article .content .btn {
position: absolute;
left: 280px;
bottom: 20px !important;
}
.listing .ajax_product_12 article .content .title {
  text-align:left !important;
}

@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_12 .height768{
    height: 368px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_12 .height768 {
    height: 486px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_12 .height768 {
    height: 335px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_12 .height768 {
    height: 325px !important;
}
}
</style>

<style>
  .ajax_product_12 article .desktop-hover .icon {
    margin: 10px !important;
  }
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_12 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .form-inline {
    flex-flow: unset;
}
.ajax_product_12 article .content .title {
    font-size: 14px;
}
.ajax_product_12 article .content .price {
    font-size: 1rem;
}
.ajax_product_12 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_12 article .content .title {
    font-size: 11px;
}

.ajax_product_12 article .content .price {
    font-size: 0.8rem !important;
}
.ajax_product_12 article .content .price span {
    font-size: 0.8rem !important;
}
.ajax_product_12 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.ajax_product_12 .btn-fs12 {
        padding: 10px 15px !important;
        font-size: 0.75rem;
    }
}

  </style>

   <!-- product card style 13 -->
   <style>
.ajax_product_13 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_13 .height768{
    height: 300px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_13 .height768 {
    height: 420px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_13 .height768 {
    height: 270px !important;
}


}
@media only screen and (max-width: 367px)
{
  .ajax_product_13 .height768 {
    height: 270px !important;
}
}
  .ajax_product_13 .btn {
    padding: 0.6rem 1.8rem !important;
}

.ajax_product_13 article .desktop-hover .icon {
    margin: 10px !important;
  }
  .griding .ajax_product_13 article .content .title {
text-align: left !important;
}
.shop-content .ajax_product_13 .col-lg-3{
  padding-right: 5px;
padding-left: 5px;
}
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_13 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_13 .form-inline {
    flex-flow: unset;
}
.ajax_product_13 article .content .title {
    font-size: 14px;
}
.ajax_product_13 article .content .price {
    font-size: 1rem;
}
.ajax_product_13 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_13 article .content .title {
    font-size: 11px;
}

.ajax_product_13 article .content .price {
    font-size: 0.9rem !important;
}
.ajax_product_13 article .content .price span {
    font-size: 0.9rem !important;
}
.col-6 .ajax_product_13   article .content .price {
            font-size: 0.8rem !important;
        }
        .col-6  .ajax_product_13  article .content .price span {
          font-size: 0.8rem !important;
        }
.ajax_product_13 .btn-pd {
    padding: 5px 12px !important;
}
.ajax_product_13 .btn {
    padding: 5px 12px !important;
}
.ajax_product_13 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
}
  </style>
   <!-- product card style 14 -->

   <style>
.ajax_product_14 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_14 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}

@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_14 .height768{
    height: 368px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_14 .height768 {
    height: 486px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_14 .height768 {
    height: 330px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_14 .height768 {
    height: 290px !important;
}
}
.ajax_product_14 article .desktop-hover .icon {
    margin: 10px !important;
  }
  .ajax_product_14 article .content .title {
text-align: center !important;
}
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_14 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_14 .form-inline {
    flex-flow: unset;
}
.ajax_product_14 article .content .title {
    font-size: 14px;
}
.ajax_product_14 article .content .price {
    font-size: 1rem;
}
.ajax_product_14 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_14 article .content .title {
    font-size: 11px;
}

.ajax_product_14 article .content .price {
    font-size: 0.8rem !important;
}
.ajax_product_14 article .content .price span {
    font-size: 0.8rem !important;
}
.ajax_product_14 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
}
  </style>
   <!-- product card style 15 -->
   <style>
.ajax_product_15 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_15 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}


@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_15 .height768{
    height: 325px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_15 .height768 {
    height: 450px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_15 .height768 {
    height: 280px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_15 .height768 {
    height: 280px !important;
}
}

.ajax_product_15 article .desktop-hover .icon {
    margin: 10px !important;
  }

  .listing .ajax_product_15 article:hover .listing-show {
    display:block;
  }
  .listing .ajax_product_15 .griding-show {
    display:none;
}
.ajax_product_15  .listing-show {
    display:none;
  }
 
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_15 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_15 .form-inline {
    flex-flow: unset;
}
.ajax_product_15 article .content .title {
    font-size: 14px;
}
.ajax_product_15 article .content .price {
    font-size: 1rem;
}
.ajax_product_15 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_15 article .content .title {
    font-size: 11px;
}

.ajax_product_15 article .content .price {
    font-size: 0.8rem !important;
    margin-bottom: 10px;
}
.ajax_product_15 article .content .price span {
    font-size: 0.8rem !important;
}
.ajax_product_15 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
}
  </style>
   <!-- product card style 16 -->

   <style>
.ajax_product_16 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.ajax_product_16 article .content {
    padding: 10px !important;
}


@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_16 .height768{
    height: 325px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_16 .height768 {
    height: 450px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_16 .height768 {
    height: 290px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_16 .height768 {
    height: 290px !important;
}
}

.ajax_product_16 article .desktop-hover .icon {
    margin: 10px !important;
  }
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_16 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_16 .form-inline {
    flex-flow: unset;
}
.ajax_product_16 article .content .title {
    font-size: 14px;
}
.ajax_product_16 article .content .price {
    font-size: 1rem;
}
.ajax_product_16 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_16 article .content .title {
    font-size: 11px;
}

.ajax_product_16 article .content .price {
    font-size: 0.8rem !important;
}
.ajax_product_16 article .content .price span {
    font-size: 0.8rem !important;
}
.ajax_product_16 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
}
  </style>
   <!-- product card style 17 -->
   <style>
.ajax_product_17 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}


@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_17 .height768{
    height: 335px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_17 .height768 {
    height: 455px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_17 .height768 {
    height: 300px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_17 .height768 {
    height: 300px !important;
}
}
  .ajax_product_17 article .desktop-hover .icon {
    margin: 10px !important;
  }
  .ajax_product_17 article .content .title {
text-align: center !important;
}
.listing .ajax_product_17 article .content .title {
text-align: left !important;
}
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_17 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .ajax_product_17 .form-inline {
    flex-flow: unset;
}
.ajax_product_17 article .content .title {
    font-size: 14px;
}
.ajax_product_17 article .content .price {
    font-size: 1rem;
}
.ajax_product_17 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{

  .ajax_product_17 .item-quantity {
width: 80px;
height: 44px;
}

.ajax_product_17 article .content .btn-secondary {
width: 40px;
height: 40px;
}

.ajax_product_17 article .content .title {
    font-size: 11px;
}

.ajax_product_17 article .content .price {
    font-size: 0.8rem !important;
}
.ajax_product_17 .content .price span {
    font-size: 0.8rem !important;
}
.ajax_product_17 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
.ajax_product_17 .fa-plus{
  vertical-align:super;
}
.ajax_product_17 .fa-minus{
  vertical-align:super;
}

}
  </style>

   <!-- product card style 18 -->
   <style>
.ajax_product_18 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .ajax_product_18 article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}

@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_18 .height768{
    height: 290px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_18 .height768 {
    height: 410px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_18 .height768 {
    height: 360px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_18 .height768 {
    height: 360px !important;
}
}
.ajax_product_18 article .desktop-hover .icon {
    margin: 10px !important;
  }
  @media only screen and (max-width: 1024px)
{
  .griding4 .ajax_product_18 article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .form-inline {
    flex-flow: unset;
}
.ajax_product_18 article .content .title {
    font-size: 14px;
}
.ajax_product_18 article .content .price {
    font-size: 1rem;
}
.ajax_product_18 article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_18 article .content .title {
    font-size: 11px;
}

.ajax_product_18 article .content .price {
    font-size: 0.8rem !important;
}
.ajax_product_18 article .content .price span {
    font-size: 0.8rem !important;
}
.ajax_product_18 article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
}
  </style>
   <!-- product card style 19 -->

   <style>
.ajax_product_19 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.ajax_product_19 .product_molla_viewall
{
  padding-top: 0 !important
}
 .pro-content .ajax_product_19 {
    padding-top: 0 !important;
    margin-top: 30px;
}

.ajax_product_19 .height768{
    height: 395px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_19 .height768{
    height: 394px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_19 .height768 {
    height: 401px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_19 .height768 {
    height: 366px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_19 .height768 {
    height: 320px !important;
}
}
</style>

   <!-- product card style 20 -->
   <style>
.ajax_product_20 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_20 .height768{
    height: 379px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_20 .height768{
    height: 378px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_20 .height768 {
    height: 374px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_20 .height768 {
    height: 293px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_20 .height768 {
    height: 304px !important;
}
}
</style>
   <!-- product card style 21 -->
   <style>
.ajax_product_21 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_21 .height768{
    height: 379px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_21 .height768{
    height: 378px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_21 .height768 {
    height: 374px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_21 .height768 {
    height: 293px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_21 .height768 {
    height: 304px !important;
}
}
</style>
   <!-- product card style 22 -->
   <style>
.ajax_product_22 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_22 .height768{
    height: 474px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_22 .height768{
    height: 474px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_22 .height768 {
    height: 470px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_22 .height768 {
    height: 272px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_22 .height768 {
    height: 272px !important;
}
}
</style>
   <!-- product card style 23 -->
   <style>
.ajax_product_23 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.ajax_product_23 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_23 .height768{
    height: 410px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_23 .height768{
    height: 410px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_23 .height768 {
    height: 406px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_23 .height768 {
    height: 260px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_23 .height768 {
    height: 260px !important;
}
}
</style>

   <!-- product card style 24 -->
   <style>
.ajax_product_24 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.ajax_product_24 .product_molla_viewall
{
  padding-top: 0 !important
}

.ajax_product_24 .height768{
    height: 429px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_24 .height768{
    height: 427px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_24 .height768 {
    height: 422px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_24 .height768 {
    height: 347px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_24 .height768 {
    height: 347px !important;
}
}
</style>
   <!-- product card style 25 -->
   <style>
.ajax_product_25 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_25 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_25 .height768{
    height: 500px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_25 .height768{
    height: 498px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_25 .height768 {
    height: 443px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_25 .height768 {
    height: 309px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_25 .height768 {
    height: 309px !important;
}
}
</style>
   <!-- product card style 26 -->
   <style>
.ajax_product_26 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}


.ajax_product_26 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_26 .height768{
    height: 487px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_26 .height768{
    height: 487px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_26 .height768 {
    height: 481px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_26 .height768 {
    height: 301px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_26 .height768 {
    height: 301px !important;
}
}
</style>
   <!-- product card style 27 -->
   <style>
.ajax_product_27 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_27 .listing article:hover .footer-27-hover-trans {
    visibility: visible;
    transform: translateY(0px) !important;
    transition: all .35s ease;
    }

    .ajax_product_27 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_27 .height768{
    height: 330px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_27 .height768{
    height: 250px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_27 .height768 {
    height: 350px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_27 .height768 {
    height: 405px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_27 .height768 {
    height: 405px !important;
}
}
</style>
   <!-- product card style 28 -->
   <style>
.ajax_product_28 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_28 .height768{
    height: 370px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_28 .height768{
    height: 352px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_28 .height768 {
    height: 342px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_28 .height768 {
    height: 377px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_28 .height768 {
    height: 377px !important;
}
}
</style>
   <!-- product card style 29 -->
   <style>
.ajax_product_29 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_29 .product_molla_viewall
{
  padding-top: 0 !important
}
.ajax_product_29 .height768{
    height: 465px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_29 .height768{
    height: 466px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_29 .height768 {
    height: 360px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_29 .height768 {
    height: 261px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_29 .height768 {
    height: 261px !important;
}
}
</style>
   <!-- product card style 30 -->
   <style>
.ajax_product_30 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}


.ajax_product_30 .product_molla_viewall
{
  padding-top: 0 !important
}
.ajax_product_30 .height768{
    height: 367px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_30 .height768{
    height: 367px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_30 .height768 {
    height: 367px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_30 .height768 {
    height: 334px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_30 .height768 {
    height: 334px !important;
}
}
</style>
   <!-- product card style 31 -->
   <style>
.ajax_product_31 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}


.ajax_product_31 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_31 .height768{
    height: 316px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_31 .height768{
    height: 316px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_31 .height768 {
    height: 316px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_31 .height768 {
    height: 320px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_31 .height768 {
    height: 320px !important;
}
.ajax_product_31 .btn-31:hover {
    padding: 10px;
    width: 100%;
    background-color: #333 !important;
    color: #fff;
    border: 0.1rem solid #333;
    border-radius: 4px;
}

}
</style>
   <!-- product card style 32 -->
   <style>
.ajax_product_32 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_32 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_32 .height768{
    height: 420px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_32 .height768{
    height: 420px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_32 .height768 {
    height: 420px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_32 .height768 {
    height: 315px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_32 .height768 {
    height: 315px !important;
}
}
</style>
   <!-- product card style 33 -->
   <style>
.ajax_product_33 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}



.ajax_product_33 .height768{
    height: 532px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_33 .height768{
    height: 532px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_33 .height768 {
    height: 501px !important;
}
.ajax_product_33 .wislist-hover-33 {
    font-size: 0.8rem;
    color: #777;
}
.banners-content {
    padding-top: 30px !important;
}
}
@media (max-width: 600px)
{
  .col-6 .btn-33:hover {
    padding: 10px 5px;
    width: 100%;
    border-radius: 4px;
    font-size: 0.875rem !important;
}
.col-6 .btn-33 {
    padding: 10px 5px;
    width: 100%;
    border-radius: 4px;
    font-size: 0.875rem !important;
}
.btn-33 {
    padding: 10px 5px;
    width: 100%;
    border-radius: 4px;
    font-size: 0.875rem !important;
}
.btn-33:hover {
    padding: 10px 5px;
    width: 100%;
    border-radius: 4px;
    font-size: 0.875rem !important;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_33 .height768 {
    height: 407px !important;
}
.banners-content {
    padding-top: 30px;
}


}
@media only screen and (max-width: 367px)
{
  .ajax_product_33 .height768 {
    height: 407px !important;
}
}
</style>

<style>
  .ajax_product_33 article .content {
padding-bottom: 0px !important;
}
</style>
   <!-- product card style 34 -->
   <style>
.ajax_product_34 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_34 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_34 .height768{
    height: 530px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_34 .height768{
    height: 450px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_34 .height768 {
    height: 450px !important;
}

}
@media only screen and (max-width: 420px)
{
  .ajax_product_34 .height768 {
    height: 405px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_34 .height768 {
    height: 405px !important;
}
}
</style>
   <!-- product card style 35 -->
   <style>
.ajax_product_35 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_35 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_35 .height768{
    height: 330px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_35 .height768{
    height: 250px !important;
}
.ajax_product_35 article .content {
    height: 140px !important;
  } 
}

@media only screen and (max-width: 768px)
{
  .ajax_product_35 .height768 {
    height: 450px !important;
}
.ajax_product_35 article .content {
    height: 140px !important;
  }
}

@media only screen and (max-width: 600px)
{
.ajax_product_35 article .content {
    height: 170px !important;
  }
}
@media only screen and (max-width: 420px)
{
  .ajax_product_35 .height768 {
    height: 405px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_35 .height768 {
    height: 405px !important;
}
}
</style>
   <!-- product card style 36 -->
   <style>
.ajax_product_36 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

@media (max-width: 600px){
  .ajax_product_36 .mobileshow-all {
    position: unset;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: transparent;
    z-index: 10;
    transition: all 0.35s ease;
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(10%) !important;
    display: inline-block;
  }
}


.ajax_product_36 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_36 .height768{
    height: 435px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_36 .height768{
    height: 426px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_36 .height768 {
    height: 423px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_36 .height768 {
    height: 375px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_36 .height768 {
    height: 375px !important;
}
}

</style>

   <!-- product card style 37 -->

   <style>
.ajax_product_37 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}


.ajax_product_37 .product_molla_viewall
{
  padding-top: 0 !important
}


.ajax_product_37 .height768{
    height: 574px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_37 .height768{
    height: 574px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_37 .height768 {
    height: 520px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_37 .height768 {
    height: 386px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_37 .height768 {
    height: 386px !important;
}
}
</style>
   <!-- product card style 38 -->
   <style>
.ajax_product_38 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.ajax_product_38 .review_text_38
{
  font-size: 0.9rem;
}

.ajax_product_38 .product_molla_viewall
{
  padding-top: 0 !important
}
.ajax_product_38 {
    margin-top: 30px;
    margin-bottom:0px !important;
}


.ajax_product_38 .height768{
    height: 489px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_38 .height768{
    height: 488px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_38 .height768 {
    height: 488px !important;
}
.ajax_product_38 .review_text_38
{
  font-size: 0.65rem;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_38 .height768 {
    height: 411px !important;
}
.ajax_product_38 {
    margin-top: 15px;
    margin-bottom: 0px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_38 .height768 {
    height: 411px !important;
}
}
</style>
   <!-- product card style 39 -->
   <style>
.ajax_product_39 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.ajax_product_39 .review_text_39
{
  font-size: 0.9rem;
}

.listing .ajax_product_39 .product-action {
  left: 0% !important;
  background-color: transparent !important;
box-shadow: none !important;
}  



.ajax_product_39 .height768{
    height: 416px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_39 .height768{
    height: 458px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_39 .height768 {
    height: 458px !important;
}
.ajax_product_39 .review_text_39
{
  font-size: 0.7rem;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_39 .height768 {
    height: 411px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_39 .height768 {
    height: 411px !important;
}
}
@media only screen and (max-width: 320px)
{
  .ajax_product_39 .review_text_39
{
  font-size: 0.6rem;
}
}


</style>
   <!-- product card style 40 -->
   <style>
.ajax_product_40 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_40 .product_molla_viewall
{
  padding-top: 0 !important
}
.ajax_product_40 .height768{
    height: 477px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_40 .height768{
    height: 430px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_40 .height768 {
    height: 430px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_40 .height768 {
    height: 264px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_40 .height768 {
    height: 264px !important;
}
}

</style>
   <!-- product card style 41 -->
   <style>
.ajax_product_41 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_41 .product_molla_viewall
{
  padding-top: 0 !important
}
.ajax_product_41 .height768{
    height: 588px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_41 .height768{
    height: 448px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_41 .height768 {
    height: 448px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_41 .height768 {
    height: 292px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_41 .height768 {
    height: 292px !important;
}
}

</style>
   <!-- product card style 42 -->
   <style>
.ajax_product_42 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.ajax_product_42 .product_molla_viewall
{
  padding-top: 0 !important
}
.ajax_product_42 .height768{
    height: 494px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_42 .height768{
    height: 394px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_42 .height768 {
    height: 394px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_42 .height768 {
    height: 334px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_42 .height768 {
    height: 334px !important;
}
}

</style>
   <!-- product card style 43 -->
   <style>
.ajax_product_43 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.ajax_product_43 .btn {
  padding: 10px !important;
}

.ajax_product_43 .product_molla_viewall
{
  padding-top: 0 !important
}
.ajax_product_43 .height768{
    height: 400px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_43 .height768{
    height: 370px !important;
}
}

@media only screen and (max-width: 768px)
{
  .ajax_product_43 .height768 {
    height: 370px !important;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_43 .height768 {
    height: 315px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_43 .height768 {
    height: 315px !important;
}
}

</style>
   <!-- product card style 44 -->

   <style>
.ajax_product_44 article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.review_text_ajax
{
  font-size:0.9rem;
}
.ajax_product_44 article .content .price span {
  color: #6c757d;
  text-decoration: line-through;
  margin-left: 0px;
  font-size: 0.9rem;
  line-height: 1.5;
}
.ajax_product_44 .btn-44 {
padding: 12px 0px;
width: 100%;
color: #fff;
margin-top: 10px;
font-size: 0.7rem;
border-radius: 5px;
}
.ajax_product_44 .btn-44-danger {
  font-size: 0.7rem;
}
.shop-content .listing .ajax_product_44 article .thumb {
width: 32% !important;
display:inline-block
}

.ajax_product_44 .listing .main-44-sty{
  width:100% !important;
  display:inline-block;
}
.shop-content .listing .ajax_product_44 article .content {
width: 62% !important;
background-color: transparent !important;
vertical-align:top;
}

.ajax_product_44 .listing .left-44 {
width: 40%;
display: inline-block;
vertical-align: middle;
}

.ajax_product_44 .listing .right-44 {
width: 12%;
display: inline-block;
vertical-align: text-top;
text-align: center;
}

.ajax_product_44 .listing .pricetag-44 {
justify-content: space-between;
display: inline-block !important;
align-items: center;
width: 100%;
height: 50px;
vertical-align: middle;
}

.ajax_product_44 .listing .pro-rating-44 {
display: inline-block !important;
width: 100%;
height: 50px;
vertical-align: middle;
text-align: left;
}

.ajax_product_44 .categories-carousel-js .slick-slide {
outline: none;
padding: 0px !important;
margin: 0px 5px;
}

.ajax_product_44  article .badges {
  position: absolute;
  top: 20px;
  left: 0 !important;
}
.ajax_product_44 .content{
  width:100% !important;
}

.ajax_product_44 .height768{
    height: 416px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .ajax_product_44 .height768{
    height: 416px !important;
}
}



@media only screen and (max-width: 768px)
{
  .ajax_product_44 .height768 {
    height: 392px !important;
}
.review_text_ajax
{
  font-size:0.7rem;
}
}
@media only screen and (max-width: 420px)
{
  .ajax_product_44 .height768 {
    height: 350px !important;
}

}
@media only screen and (max-width: 367px)
{
  .ajax_product_44 .height768 {
    height: 350px !important;
}
}
@media only screen and (max-width: 367px)
{
  .review_text_ajax
{
  font-size:0.6rem;
}
}

</style>

  <!-- product card style 45 -->

  <style>



</style>