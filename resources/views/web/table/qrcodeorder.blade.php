<!DOCTYPE html>
<html>
    <head>
        <title>CATEGORY</title>
        <meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="QRCODE Scanning">
        <meta name="keywords" content="QRCODE Scanning">
        <meta name="author" content="Platinum Code">
		@php
        $color_style = DB::table('settings')->where('id',236)->first();
        $color = DB::table('settings')->where('id',237)->first();
		$inv = DB::table('settings')->where('id',145)->first();
		
		if(session('language_id') == '')
		{
			$language_id = 1;
		}
		else
		{
			$language_id = session('language_id');
		}
        $label1 = DB::table('table_label_value')->where('label_id',11)->where('language_id', '=', $language_id)->first();
        $label2 = DB::table('table_label_value')->where('label_id',12)->where('language_id', '=', $language_id)->first();

        
    @endphp
        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
        <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
        <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
    </head>
	<?php  $color = $color->value; ?>

	<style>
.pc-cat-header-left-main {
    width: auto;
    height: auto;
}

.pc-cat-header-left {
    width: 75%;
}

.pc-in-header-right{
    width: 23%;
}



	.search-button-main {
    position: relative;
    top: 2px;
    right: 5px;
    padding: 0 !important;
    background: #fff;
    width: 30px !important;
    float: right;
}
.cat-main-right-item {
    width: 100% !important;
	margin: 0 5px;
}

.grid-col-new {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 5px;
	width: 99%;
}



	@media only screen 
	and (min-device-width: 768px) 
	and (max-device-width: 1024px) 
	and (-webkit-min-device-pixel-ratio: 1) {

		

	}
	@media only screen 
	and (min-device-width: 768px) 
	and (max-device-width: 1024px) 
	and (-webkit-min-device-pixel-ratio: 2) {


		
	}

	@media only screen 
	and (min-device-width: 834px) 
	and (max-device-width: 1112px)
	and (-webkit-min-device-pixel-ratio: 2) {

		

	}

	@media only screen 
	and (min-device-width: 768px) 
	and (max-device-width: 1366px)
	and (-webkit-min-device-pixel-ratio: 2) {

	}

	@media only screen 
	and (min-device-width: 1024px) 
	and (max-device-width: 1366px)
	and (-webkit-min-device-pixel-ratio: 2) {

		

	}
	@media 
	(min-device-width: 800px) 
	and (max-device-width: 1280px)
	and (-webkit-min-device-pixel-ratio: 2) {

	}
	@media only screen and (min-width: 769px) {
		.grid-col-new {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 5px;
	width: 99%;
}
.cat-main-right-item-img-main {
	width: auto;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}

	}
	@media only screen and (max-width: 768px) {
		.grid-col-new {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 5px;
	width: 98%;
}
.cat-main-right-item-img-main {
	width: auto;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

	}
	@media only screen and (max-width: 600px) {
		.grid-col-new {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 5px;
	width: 97%;
}
.cat-main-right-item-img-main {
	width: auto;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cat-main-right-item-list {
    margin: 2% !important;
    width: 96% !important;
}


	}
	@media only screen and (max-width: 420px) {

		.pc-category-order-bottom-price 
		{
			font-size: 1rem;
		}

	}
	.animate-top{
    position:fixed;
    animation:animatetop 0.4s;
    bottom:0px;
}
@keyframes animatetop{
    from{bottom:-300px;opacity:0} 
    to{bottom:0;opacity:1}
}
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: unset;
  bottom: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  visibility: unset;
  background-color: rgba(0, 0, 0, 0.275);
}

.modal-content {
    margin: 0;
    max-width: 100%;
    border: 1px solid rgba(0, 0, 0, 0.175);
    outline: 0;
    padding: 0;
    left: 0;
    right: 0;
    background: #fff;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
.modal-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: .3rem;
    border-top-right-radius: .3rem;
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    margin-top: 0;
    font-size: 1.25rem;
}
.modal-header .close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
    padding: 1rem;
    margin: -1rem -1rem -1rem auto;
    background-color: transparent;
    border: 0;
}
.close:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.modal-body {
    flex: 1 1 auto;
    padding: 1rem;
}
.modal-body p {
    margin-top: 0;
    margin-bottom: 1rem;
}
.modal-footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 1rem;
    border-top: 1px solid #e9ecef;
}
.modal-footer>*{
    margin: 5px;
}

/* buttons */
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    cursor: pointer;
}
.btn:focus, .btn:hover {
    text-decoration: none;
}
.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}
.btn-secondary {
    color: #fff;
    background-color: #7c8287;
    border-color: #7c8287;
}
.btn-secondary:hover {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}
.cat-main-right {
    text-align: left;
}

.cat-main-left {
  padding-right: 15px; /* Add some padding to the right to make space for the scrollbar */
}

.lang_img_outer {
    width: 35px;
    height: 35px;
    border-radius: 50% !important;
}
.lang_change
{
	width: 100%;
	height: 100%;
	border-radius: 50% !important;
	object-fit: cover;
}
/* Hide scrollbar but allow scrolling */
.cat-main-left::-webkit-scrollbar {
  width: 1px; /* Set the width of the scrollbar */
}

.cat-main-left::-webkit-scrollbar-thumb {
  background-color: transparent !important; /* Set the color of the thumb */
}

.cat-main-left::-webkit-scrollbar-track {
  background-color: transparent !important; /* Set the color of the track */
}

.cat-main-right {
  padding-right: 15px; /* Add some padding to the right to make space for the scrollbar */
}

/* Hide scrollbar but allow scrolling */
.cat-main-right::-webkit-scrollbar {
  width: 1px; /* Set the width of the scrollbar */
}

.cat-main-right::-webkit-scrollbar-thumb {
  background-color: transparent !important; /* Set the color of the thumb */
}

.cat-main-right::-webkit-scrollbar-track {
  background-color: transparent !important; /* Set the color of the track */
}


.cat-main-right-item-list {
    margin: 2% ;
    width: 98% ;
}

		
		.page-wrapper {
  min-height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}


.page-wrapper button .cart-item {
  position: absolute;
  height: 24px;
  width: 24px;
  top: -10px;
  right: -10px;
  z-index: 1000;
}

.page-wrapper button .cart-item:before {
  content: '1';
  display: block;
  line-height: 24px;
  height: 24px;
  width: 24px;
  font-size: 12px;
  font-weight: 600;
  background: <?php echo $color; ?>;
  color: white;
  border-radius: 20px;
  text-align: center;
}

.page-wrapper button.sendtocart .cart-item {
  display: block;
  animation: xAxis 1s forwards cubic-bezier(1.000, 0.440, 0.840, 0.165);
}

.page-wrapper button.sendtocart .cart-item:before {
  animation: yAxis 1s alternate forwards cubic-bezier(0.165, 0.840, 0.440, 1.000);
}

.page-wrapper-list {
  min-height: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 60px;
}


.page-wrapper-list button .cart-item {
  position: absolute;
  height: 24px;
  width: 24px;
  top: -10px;
  right: -10px;
  z-index: 1000;
}

.page-wrapper-list button .cart-item:before {
  content: '1';
  display: block;
  line-height: 24px;
  height: 24px;
  width: 24px;
  font-size: 12px;
  font-weight: 600;
  background: <?php echo $color; ?>;
  color: white;
  border-radius: 20px;
  text-align: center;
}

.page-wrapper-list button.sendtocart .cart-item {
  display: block;
  animation: xAxis 1s forwards cubic-bezier(1.000, 0.440, 0.840, 0.165);
}

.page-wrapper-list button.sendtocart .cart-item:before {
  animation: yAxis 1s alternate forwards cubic-bezier(0.165, 0.840, 0.440, 1.000);
}

.cart {
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    bottom: 10px;
    z-index: 100;
}

.cart i {
  font-size: 25px;
  color: white;
}

.cart:before {
    content: attr(data-totalitems);
    font-size: 12px;
    font-weight: 600;
    position: absolute;
    top: -8px;
    right: -12px;
    background: <?php echo $color; ?>;
    line-height: 25px;
    padding: 0;
    height: 24px;
    min-width: 24px;
    color: white;
    text-align: center;
    border-radius: 24px;
}

.cart.shake {
  animation: shakeCart .4s ease-in-out forwards;
}


@keyframes shakeCart {
  25% {
    transform: translateX(6px);
  }
  50% {
    transform: translateX(-4px);
  }
  75% {
    transform: translateX(2px);
  }
  100% {
    transform: translateX(0);
  }
}


	.search-input {
		border: 0.1rem solid #ebebeb;
		border-radius: 50px;
		padding: 0.9rem;
		height: 46px;
		width: 100%;
		outline: none;
		font-size: 1rem;
	}
	.header-28-search-input {
		position: relative;
		right: -2px;
	}


	.col-md-4 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
	display:inline-block;
	vertical-align:middle;
}
.col-md-8 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
	display:inline-block;
	vertical-align:middle;
}
.searchdropdown{
	border-bottom:.1rem solid #ebebeb;
	padding:20px 10px;
}

.search_outer_con {
    position: absolute;
    z-index: 9999;
    background: #fff;
    top: 37px;
    width: 100%;
    border: 1px solid rgba(0, 0, 0, 0.15);
    min-width: 10rem;
    padding: 0.5rem 0.5rem;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #111;
    display: none;
    max-height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
}

.cat-main-right-item-title {
	margin-right: -10px;
    width: 99%;
}
.enable_search {
    display: block;
}

.pc-cat-header {
	border: 0px solid;
	padding: 5px 5px 5px 15px;
	box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.05);
}
.pc-category-order-bottom {
	box-shadow: 0px -3px 5px 0px rgba(0,0,0,0.05);
}

.cat-main-right-title {
	color: #9576AB;
	margin-bottom: 0px;
	text-align: left;
	padding: 10px 10px;
}

.no-stock::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgb(0 0 0 / 77%);;
  z-index: 1;
}

.no-stock-content {
    position: absolute;
    z-index: 1;
    width: 100%;
    color: #fff;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.pc-category-order-bottom {
    background-color: #fff;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 102;
}
.pc-category-order-bottom-new
{
background-color: #fff;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 0;
}
.cat-main-left {
    padding: 0 0 250px 0 !important;
	overflow-x: hidden;
}
.cat-main-right {
	padding: 0 0 250px 0 !important;
	overflow-x: hidden;
}



</style>


	<body>
        <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        <div class="pc-mobile-tab">
		<?php 
			$languagesall = DB::table('languages')->select('languages.*')->get(); 

			$languages_new = DB::table('languages')
			->leftJoin('image_categories', 'languages.image', 'image_categories.image_id')
			->select('languages.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
			->where('languages.is_default', '1')
			->first();

			$currency = DB::table('currencies')->where('is_default',1)->first();
			$currencyall = DB::table('currencies')->get();
			
		?>
    
   
<!-- The Modal -->
<div id="modalDialog" class="modal">
    <div class="modal-content animate-top">
    	<div class="modal-body" style="padding: 0;">
        	<div class="dropdown-menu lang_drop_down" style="color: #777;top: 40px;padding: 0 1rem;">
				@foreach($languagesall as $language)

				<?php if(session('language_image') != '') { ?>
					<a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item color-13-top <?php if($language->languages_id == session('language_id')) {?> common-text <?php }?>" style="font-size: 1rem;display:block;padding:1rem 0;border-bottom:solid 0.5px #777;" >                      
				{{$language->name}} 
				</a>   
				<?php } else { ?>

					<a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item color-13-top <?php if($language->languages_id == $languages_new->languages_id) {?> common-text <?php }?>" style="font-size: 1rem;display:block;padding:1rem 0;border-bottom:solid 0.5px #777;" >                      
				{{$language->name}} 
				</a>   

			

				<?php } ?>

							
				@endforeach     
				@include('web.common.scripts.changeLanguage')              
			</div>
        </div>
    </div>
</div>
<!-- The Modal -->


   
<!-- The Modal -->
<div id="modalDialog2" class="modal">
    <div class="modal-content animate-top">
    	<div class="modal-body" style="padding: 0;">
        	<div class="dropdown-menu lang_drop_down" style="color: #777;top: 40px;padding: 0 1rem;">
				@foreach($currencyall as $curn)

				<?php if(session('language_image') != '') { ?>
					<a onclick="myFunction2({{$curn->id}})" class="dropdown-item color-13-top" style="font-size: 1rem;display:block;padding:1rem 0;border-bottom:solid 0.5px #777;" >                      
				{{$curn->code}} 
				</a>   
				<?php } else { ?>

					<a onclick="myFunction2({{$curn->id}})" class="dropdown-item color-13-top <?php if($curn->id == $currency->id) {?> common-text <?php }?>" style="font-size: 1rem;display:block;padding:1rem 0;border-bottom:solid 0.5px #777;" >                      
					{{$curn->code}} 
				</a>   

			

				<?php } ?>

							
				@endforeach     
				@include('web.common.scripts.changeCurrency') 
			</div>
        </div>
    </div>
</div>
<!-- The Modal -->

            <div class="pc-in-main1">
                <div class="pc-cat-header">
                    <div class="pc-cat-header-left">
                        <div class="pc-cat-header-left-main" style="position:relative">
							<div style="display: flex;align-items: center;">
									
								@if(count($languagesall) > 1)
									<div class="lang_img_outer" id="mbtn">
										<img  class="lang_change" src="{{asset(session('language_image'))}}" alt="{{	session('language_name')}}">
									</div>
								@endif
								<div style="display: inline-block;margin-left: 10px;" >Welcome -<span class="common-text"> @if(auth()->guard('customer')->check())  <a class="common-text" href="{{url('/qrcodeprofile')}}">{{auth()->guard('customer')->user()->first_name}} </a> @else Guest @endif </span></div>

								@if(count($currencyall) > 1)
									<div class="" id="mbtn2" style="margin-left:5%;">
										<?php if(session('currency_code') != '') { ?>
											{{	session('currency_code')}}
										<?php } else { ?>

										{{$currency->code}}

										<?php } ?>

									</div>
									<svg xmlns="http://www.w3.org/2000/svg" class="common-text" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m7 10l5 5l5-5H7Z"/></svg>
									
									
                            	@endif


							</div>
							
                        </div>
                    </div>
                    <div class="pc-in-header-right">
						<form class="form-inline-search header-28-form" action="#" method="get">
							<div class="input-main" id="searchbuttons">
								<div  class="search-inputs"></div>
							</div>
							<input type="hidden" class="category-value" name="categories_id" value="" /> 
							<div class="input-main" id="searchbutton" style="display:none;position:absolute;top:2px;right:5px;left:5px">
								<input autocomplete="off" name="search" type="text" class="search-input typeheads1 header-28-search-input" value="{{ app('request')->input('search') }}" placeholder="Search Product ..... ">
								<div class="search_outer_con">
									<div id="viewsearchproduct"></div>
								</div>
							</div>
							<button id="dropdownCartButton" class="btn search-button-main header-28-search-button" type="button"> 
							<svg xmlns="http://www.w3.org/2000/svg" onclick="myFunction()"  width="30" height="30" viewBox="0 0 24 24"><path fill="rgba(0, 0, 0, 0.54)" fill-rule="evenodd" d="M14.385 15.446a6.75 6.75 0 1 1 1.06-1.06l5.156 5.155a.75.75 0 1 1-1.06 1.06l-5.156-5.155Zm-7.926-1.562a5.25 5.25 0 1 1 7.43-.005l-.005.005l-.005.004a5.25 5.25 0 0 1-7.42-.004Z" clip-rule="evenodd"/></svg>

							
							</button>
                  		</form>

                        <div class="">
                            <!-- <img src="{{asset('web/table/img/search.png')}}" alt="Search"> -->
                        </div>
                        <div class="pc-cat-header-right-main1">
                            <a href="{{url('/orderhistory')}}">
                                <img src="{{asset('web/table/img/notes.png')}}" alt="Notes">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="cat-banner-main">
                    <img src="{{asset('web/table/img/banner.jpg')}}" alt="Banner">
                </div> -->
                <div class="cat-main">
                    <div class="cat-main-left">
						
						@if(count($result['categories']) > 0)
							@foreach($result['categories'] as $jescate)
								@php
									if($jescate->image_path_type=='aws'){
										$image=$jescate->image_path;
									}else{
										$image=asset('').$jescate->image_path;
									}
								@endphp
								<div class="cat-main-left-item" onclick="city(event, '{{$jescate->categories_id}}')">
									<div class="cat-img-left-item-img-main">
										<img src="{{$image}}" alt="Category Name">
									</div>
									<div class="cat-main-left-title">{{$jescate->categories_name}}</div>
								</div>
							@endforeach
						@endif
                    </div>

					@if(count($result['categories']) > 0)
						@foreach($result['categories'] as $jescate)
							@php
								$product = DB::table('products')
									->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
									->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
									->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
									->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*')
									->where('products_to_categories.categories_id', '=', $jescate->categories_id)
									->whereIn('product_view', [0, 3])
									->groupBy('products_description.products_id')
									->orderBy('products.productOrder', 'ASC')
									->get();
								//print_r($product);die();
							@endphp
							<div class="cat-main-right" id="{{$jescate->categories_id}}">

							<div style="display: flex;align-items: center;margin-top: 10px;justify-content: space-between;">
								


								<div class="cat-main-right-title">{{$jescate->categories_name}}</div>
								
								<div style="display: flex;align-items: center;">

									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="grid-btn fill-black common-fill"><path d="M8.75 13A2.25 2.25 0 0 1 11 15.25v3.5A2.25 2.25 0 0 1 8.75 21h-3.5A2.25 2.25 0 0 1 3 18.75v-3.5A2.25 2.25 0 0 1 5.25 13h3.5Zm10 0A2.25 2.25 0 0 1 21 15.25v3.5A2.25 2.25 0 0 1 18.75 21h-3.5A2.25 2.25 0 0 1 13 18.75v-3.5A2.25 2.25 0 0 1 15.25 13h3.5Zm-10-10A2.25 2.25 0 0 1 11 5.25v3.5A2.25 2.25 0 0 1 8.75 11h-3.5A2.25 2.25 0 0 1 3 8.75v-3.5A2.25 2.25 0 0 1 5.25 3h3.5Zm10 0A2.25 2.25 0 0 1 21 5.25v3.5A2.25 2.25 0 0 1 18.75 11h-3.5A2.25 2.25 0 0 1 13 8.75v-3.5A2.25 2.25 0 0 1 15.25 3h3.5Z"/></svg>
									
									<svg class="list-btn fill-black" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 20 20"><g><path d="M6.5 6a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0Zm0 4a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0Zm0 4a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0Z"/><path fill-rule="evenodd" d="M7.5 6a1 1 0 0 1 1-1h7a1 1 0 1 1 0 2h-7a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h7a1 1 0 1 1 0 2h-7a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h7a1 1 0 1 1 0 2h-7a1 1 0 0 1-1-1Z" clip-rule="evenodd"/></g></svg>
								</div>
							</div>

							<div class="change-view grid-col-new">


									@if(!$product->isEmpty())
										@foreach($product as $jesproduct)
											@php
												if($jesproduct->image_path_type=='aws'){
													$proimage=$jesproduct->image_path;
												}else{
													$proimage=asset('').$jesproduct->image_path;
												}
											@endphp

											<?php 

											$stocks = 0;
											$stockOut = 0;
											$defaultStock = 0;
											$stockarray = [];
											if ($jesproduct->products_type == '0') {
												if($inv->value == 1)
												{
													if($jesproduct->stock_status == 1)
													{

													$stocks = DB::table('inventory')->where('products_id', $jesproduct->products_id)->where('stock_type', 'in')->sum('stock');
													$stockOut = DB::table('inventory')->where('products_id', $jesproduct->products_id)->where('stock_type', 'out')->sum('stock');
													$defaultStock = $stocks - $stockOut;
													}
													else
													{
														$defaultStock = '1';
													}
													
												}
												else
												{
													$defaultStock = '1';
												}
											} 
											elseif($jesproduct->products_type == 1){
												$defaultStock = '1';
											}
											elseif($jesproduct->products_type == 3){
												
						  
												$comboPro = DB::table('product_combo')->where('pro_id', $jesproduct->products_id)->get();
						  
												foreach($comboPro as $key=>$comboProd){
						  
													$stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
													$stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
													$stocks = $stocksin - $stockOut;
													$stockarray[$key] = $stocks;
												} 
												if(in_array('0',$stockarray))
												{
													$defaultStock = '0';
												}
												else
												{
													$defaultStock = '1';
												}
											}
											else if($jesproduct->products_type == 4)
											{
												$stocks = 0;
												$stockarray = [];
						  
												$comboPro = DB::table('product_buy_x')->where('pro_id', $jesproduct->products_id)->get();
						  
												foreach($comboPro as $key=>$comboProd){
						  
													$stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
													$stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
													$stocks = $stocksin - $stockOut;
													$stockarray[$key] = $stocks;
													//print_r($stockarray);
												} 
					
												$stocksgetx = 0;
												$stockarraygetx = [];
						  
												$comboProgetx = DB::table('product_get_x')->where('pro_id', $jesproduct->products_id)->get();
						  
												foreach($comboProgetx as $key=>$comboProdgetx){
						  
													$stocksingetx = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'in')->sum('stock');
													$stockOutgetx = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'out')->sum('stock');
													$stocksgetx = $stocksingetx - $stockOutgetx;
													$stockarraygetx[$key] = $stocksgetx;
													//print_r($stockarray);
												}
												if((in_array('0',$stockarray)) || (in_array('0',$stockarraygetx)))
												{
													$defaultStock = '0';
												}
												else
												{
													$defaultStock = '1';
												}
											}

											else{
												//$attristock = $authController->getPosAttributesStock($products_data->products_id);
												$defaultStock = '0';
											}



											?>
											

<?php
                  
				  $hold = DB::table('hold')->where('session_id', session('table_qrcode'))->first();
				  
				  
			  ?>
			 
											@if($defaultStock == 0)
											<div class="cat-main-right-item-list list-data" style="position:relative;z-index:1;display:none;">

												
												@else
												<div class="cat-main-right-item-list list-data" style="display:none;">
												@endif

													<div class="cat-main-left-name">
													@if($hold->hold_status != 2)
								
									
													<a href="{{ URL::to('/qrcodedetail')}}/{{$jesproduct->products_slug}}">
													@endif
														<div class="cat-main-right-item-title-list" style="font-size:11px;">{{ substr($jesproduct->products_name, 0, 30) }}</div>
														@if($hold->hold_status != 2)
														</a>
														@endif
														<div class="cat-main-right-item-price-list" style="font-size:14px;">
														
														@php 
														$or_pr = $jesproduct->products_filter_price * session('currency_value');
        												$org_price_new = number_format($or_pr, 2);
														@endphp

														{{Session::get('symbol_left')}} 
														{{$org_price_new }} {{Session::get('symbol_right')}}</div>
														@if($jesproduct->products_type == 0)
														@if($defaultStock != 0)

														<div class="page-wrapper-list" style="position:relative;z-index:100;">
													<button class="addtocart" id="list-{{$jesproduct->products_id}}" style="background: transparent;padding: 0;"><div class="add-but">+ Add</div>
													<span class="cart-item cart-item-{{$jesproduct->products_id}}" style="display:none;"></span></button>

													
													</div>



													

													
													

													@else
													<div class="add-but">+ Add</div>

													@endif

														
													
													@else
													@if($hold->hold_status != 2)
													<a href="{{ URL::to('/qrcodedetail')}}/{{$jesproduct->products_slug}}">
														@endif
													<div class="add-but">+ Add</div>
													@if($hold->hold_status != 2)
													<a>
														@endif

													@endif

														
													</div>
													@if($defaultStock == 0)
													<div class="cat-main-right-item-img-main-list no-stock" style="position:relative;">
													<h5 class="no-stock-content">No Stock</h5>
													@else
													<div class="cat-main-right-item-img-main-list" >
												@endif
												@if($hold->hold_status != 2)
												<a href="{{ URL::to('/qrcodedetail')}}/{{$jesproduct->products_slug}}">
													@endif
														<img src="{{ $proimage }}" alt="Product Name">
														@if($hold->hold_status != 2)
										</a>
										@endif
													</div>
												</div>

												@if($defaultStock == 0)
											

												<div class="cat-main-right-item grid-data no-stock" style="padding: 5px 10px 10px 10px;position:relative;z-index:1;">

												<h5 class="no-stock-content">No Stock</h5>
												@else

												

												<div class="cat-main-right-item grid-data" style="padding: 5px 10px 10px 10px;">

												@endif
												@if($hold->hold_status != 2)
												<a href="{{ URL::to('/qrcodedetail')}}/{{$jesproduct->products_slug}}">
													@endif
													<div class="cat-main-right-item-img-main">
														<img src="{{ $proimage }}" alt="Product Name">
													</div>
												
											
													<div class="cat-main-right-item-title" style="border:none !important;"><b>{{ substr($jesproduct->products_name, 0, 30) }}</b></div>
													@if($hold->hold_status != 2)
													</a>
													@endif
													<div style="display: flex;align-items: center;margin-top: 15px;justify-content: space-between;">
													<div class="cat-main-right-item-price" >

												
												
													@php $or_pr = $jesproduct->products_filter_price * session('currency_value');
        												$org_price_new = number_format($or_pr, 2);
														@endphp
														{{Session::get('symbol_left')}} {{$org_price_new}} {{Session::get('symbol_right')}}</div>
													@if($jesproduct->products_type == 0)
													@if($hold->hold_status != 2)

													@if($defaultStock != 0)

													<div class="page-wrapper" style="position:relative;z-index:100;">
													<button class="addtocart" id="grid-{{$jesproduct->products_id}}" style="background: transparent;padding: 0;"><svg  xmlns="http://www.w3.org/2000/svg" class="common-fill" width="24" height="24" viewBox="0 0 256 256"><path  d="M208 32H48a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16Zm-24 104h-48v48a8 8 0 0 1-16 0v-48H72a8 8 0 0 1 0-16h48V72a8 8 0 0 1 16 0v48h48a8 8 0 0 1 0 16Z"/></svg>
													<span class="cart-item cart-item-{{$jesproduct->products_id}}" style="display:none;"></span></button>

													
													</div>

													@else
													<div>
														<svg  xmlns="http://www.w3.org/2000/svg" class="common-fill" width="24" height="24" viewBox="0 0 256 256"><path  d="M208 32H48a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16Zm-24 104h-48v48a8 8 0 0 1-16 0v-48H72a8 8 0 0 1 0-16h48V72a8 8 0 0 1 16 0v48h48a8 8 0 0 1 0 16Z"/></svg>
													</div>

													@endif
           
													
													
													@endif
													
													@else
													
													@if($hold->hold_status != 2)
													
														<a href="{{ URL::to('/qrcodedetail')}}/{{$jesproduct->products_slug}}">
															@endif
														<svg xmlns="http://www.w3.org/2000/svg" class="common-fill" width="24" height="24" viewBox="0 0 256 256"><path  d="M208 32H48a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16Zm-24 104h-48v48a8 8 0 0 1-16 0v-48H72a8 8 0 0 1 0-16h48V72a8 8 0 0 1 16 0v48h48a8 8 0 0 1 0 16Z"/></svg>
														@if($hold->hold_status != 2)
														</a>
													
														@endif
														

													@endif
													</div>
												</div>

												

												@if($hold->hold_status != 2)
									
									
											
											@endif
										@endforeach
									@endif
								</div>
								</div>

								
						@endforeach
					@endif
                    
					
					<?php
						$qrcount = DB::table('customers_basket')->where('session_id', '=', session('table_qrcode'))->where('order_status', '=', 0)->sum('customers_basket_quantity');

					?>

					
                    <div class="pc-category-order-bottom class-new">
                        <div class="pc-category-order-bottom-main">
							@if($hold->hold_status != 2)
								<a href="{{url('/qrcodecart')}}">
									<div id="cart" class="cart" data-totalitems="{{$qrcount}}">
										<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path fill="currentColor" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607L1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4a2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2a1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2a1 1 0 0 1 0-2z"/></svg>					
									</div>
								</a>
							@else
								<div id="cart" class="cart" data-totalitems="{{$qrcount}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path fill="currentColor" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607L1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4a2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2a1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2a1 1 0 0 1 0-2z"/></svg>					
								</div>
							@endif
							<?php 
							
                        $final_price =  $result['total_amount'];
                        $total_amount_new = number_format($final_price, 2);?>
                            <div class="pc-category-order-bottom-price">{{$label1->label_value}} : {{Session::get('symbol_left')}} <span id="total_table_price">{{ $total_amount_new }} </span> {{Session::get('symbol_right')}}</div>
                            <div class="pc-category-button-main">
							
								@if($hold->hold_status != 2)
									<a href="{{url('/qrcodecart')}}">
										<button type="submit" class="pc-category-order-button modal-toggle">{{$label2->label_value}}</button>
									</a>
								@else
									
										<button type="submit" class="pc-category-order-button" style="background: gray;cursor: default;">{{$label2->label_value}}</button>
									
								@endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
	
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>

	
// Get the modal
var modal = $('#modalDialog');
var modal2 = $('#modalDialog2');
// Get the button that opens the modal
var btn = $("#mbtn");
var btn2 = $("#mbtn2");

// Get the <span> element that closes the modal
var span = $(".close");

$(document).ready(function(){
    // When the user clicks the button, open the modal 
    btn.on('click', function() {
        modal.show();
		modal2.fadeOut();
    });
	btn2.on('click', function() {
        modal2.show();
		modal.fadeOut();
    });
    
    // When the user clicks on <span> (x), close the modal
    span.on('click', function() {
        modal.fadeOut();
		modal2.fadeOut();
    });
});



// When the user clicks anywhere outside of the modal, close it
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.fadeOut();
		modal2.fadeOut();
		
    }
});


$(document).ready(function(){

	

	

	

	$('.addtocart').on('click', function() {

		var button = $(this);
		var id = this.id;
		
		var array = id.split('-');
		var pid = array[1];
		
		var quantity = 1;
		var cart = $('#cart');
		var cartTotal = cart.attr('data-totalitems');
		var newCartTotal = parseInt(cartTotal) + 1;

		var addbtnPosition = button.offset();
  		var carticonPosition = cart.offset();
  		var targetX = carticonPosition.left - addbtnPosition.left;
    	var targetY = carticonPosition.top - addbtnPosition.top;

		var dynamicXAxisKeyframes = '@keyframes xAxis { 100% { transform: translateX(' + targetX + 'px); }}';
    $('style').append(dynamicXAxisKeyframes);

    // Inject dynamic keyframe rules for yAxis animation
    var dynamicYAxisKeyframes = '@keyframes yAxis { 100% { transform: translateY(' + targetY + 'px); }}';
    $('style').append(dynamicYAxisKeyframes);


	$('.class-new').removeClass('pc-category-order-bottom');
	$('.class-new').addClass('pc-category-order-bottom-new');
	



		jQuery.ajax({
		url: '{{ URL::to("/addtocarttable")}}',
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+pid+'&quantity='+quantity,

			success: function (res) {
				if(res['status'] == 'exceed')
				{
				notificationWishlist("@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')");
				}
				else {
				
					
					button.addClass('sendtocart');
					$('.cart-item-' + pid).show();
					
					setTimeout(function() {
						button.removeClass('sendtocart');
						cart.addClass('shake').attr('data-totalitems', newCartTotal);
						$('.cart-item-' + pid).hide();
						$('#total_table_price').html(res);
						
						setTimeout(function() {
							
						cart.removeClass('shake');
						$('.class-new').addClass('pc-category-order-bottom');
						$('.class-new').removeClass('pc-category-order-bottom-new');
						}, 500);
					}, 1000);

				}

			}
 		}); 
	});


  
});




$('.grid-btn').on('click', function() {
	$('.list-btn').removeClass('common-fill');
	$('.grid-btn').addClass('common-fill');
	$('.change-view').removeClass('grid-col-new');
	$('.change-view').addClass('grid-col-new');
	$('.grid-data').show();
	$('.list-data').hide();
});
$('.list-btn').on('click', function() {
	$('.grid-btn').removeClass('common-fill');
	$('.list-btn').addClass('common-fill');
	$('.change-view').removeClass('grid-col-new');
	$('.grid-data').hide();
	$('.list-data').show();
});


    var button = document.getElementsByClassName('cat-main-left-item'),
    tabContent = document.getElementsByClassName('cat-main-right');
    button[0].classList.add('active');
    tabContent[0].style.display = 'block';


    function city(e, city) {
        var i;
        for (i = 0; i < button.length; i++) {
            tabContent[i].style.display = 'none';
            button[i].classList.remove('active');
        }
        document.getElementById(city).style.display = 'block';
        e.currentTarget.classList.add('active');
    }
</script>

<script>


  function myFunction() {
  var x = document.getElementById("searchbutton");
  var y = document.getElementById("searchbuttons");

  var a = document.getElementById("searchbuttonfixed");
  var b = document.getElementById("searchbuttonsfixed");



  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    a.style.display = "block";
    b.style.display = "none";
    $('.fa-search').addClass('active-30-button');
  } else {
    x.style.display = "none";
    y.style.display = "block";
    a.style.display = "none";
    b.style.display = "block";
    $('.fa-search').removeClass('active-30-button');
  }
}


</script>


<script>
$(".typeheads1").keyup(function(){

var search = $(".typeheads1").val();
var cat = $(".category-value").val();
$('.btn-close-search-40').show();
$("#search-width-hide").removeClass("search-field-module-width-show");
$("#search-width-hide").addClass("search-field-module-width-hide");
var pro = "{{ URL::to('/qrcodedetail')}}";


if(search != "")
{
	var content ='';
  jQuery.ajax({
		 url: '{{ URL::to("/autocomplete")}}',
		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		 type: "GET",
		  data: 'search='+search+'&cat='+cat,
		  dataType: 'JSON',
		  success: function (data) { 
			if(data !="")
				{
			$.each(data, function(index, item) 
			{
				content += '<a href="'+pro+'/'+item.slug+'"><div class="searchdropdown">';
				content += '<div class="row">';
				content += '<div class="col-4 col-md-4">';
				if(item.image_path_type == 'aws')
	  {
		content += '<img src="'+item.img+'"/ style="height:44px;width:65px;">';
	  }
	  else
	  {
		content += '<img src="'+imagep+item.img+'"/ style="height:44px;width:65px;">';
	  }
				content += '</div>';
				content += '<div class="col-8 col-md-8">';
				content += '<span style="white-space: normal;">'+item.name+'</span>';
				content += '</div>';
				content += '</div>';
				content += '</div></a>';
			
			});
		  }
		  else
		  {
			content += '<div class="row">';
			content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
			content += '</div>';
			content += '</div>';
		  }

			jQuery('.search_outer_con').addClass('enable_search');
			$('#viewsearchproduct').html(content);
		
		   
	},
	});

}
else
{
	jQuery('.search_outer_con').removeClass('enable_search');
$('.btn-close-search-40').hide();
$("#search-width-hide").addClass("search-field-module-width-show");
$("#search-width-hide").removeClass("search-field-module-width-hide");
}


});
</script>