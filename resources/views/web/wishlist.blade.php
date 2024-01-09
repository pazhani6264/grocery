@extends('web.layout')
@section('content')
<!-- wishlist Content -->
<style>
/* .wishlist-content .media-main .media img {
    width: auto; !important;
    height: 160px;
    border: 1px solid #ddd;
    margin-right: 1rem;
}
.wishlist-content .media-main .media {
    padding: 20px 2px; !important;
} */
.my-4 {
    margin-top: 10px !important;
}
.price span {
    color: #6c757d;
    text-decoration: line-through;
    margin-left: 10px;
    font-size: 1.075rem;
    line-height: 1.5;
	color: #6c757d !important;
}
h5 {
    line-height: 20px;
	
}

@media screen and (min-width: 768px) and (max-width: 1100px){

	.wishlist-main-right-side {
		border: 0px solid;
		width: 57% !important;
		height: 98px;
		display: inline-block;
		vertical-align: top;
		position: relative;
	}
}


@media screen and (max-width: 600px){

.profile-content .media-main .media-body .detail span {
    display: initial;
    font-size: 0.875rem;
}
.profile-content .media-main {
    margin-bottom: 5px;
}
.media-main {
  margin-bottom: 5px;
}

}

@media screen and (max-width: 600px){

	.wislsist-main-item {
		border: 0px solid;
		width: 100%;
		display: inline-block;
		vertical-align: top;
		margin: 0px 6px 19px 0px;
	}
	.wishlist-main-right-side {
		border: 0px solid;
		width: 58%;
		height: 98px;
		display: inline-block;
		vertical-align: top;
		position: relative;
	}
}

</style>


<div class="container-fuild">
  <nav aria-label="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
        <li class="breadcrumb-item active" aria-current="page">@lang('website.Wishlist')</li>

      </ol>
    </div>
  </nav>
</div> 


<section class="my-4 profile-content">
	<div class="container">
		<div class="row">

			<div class="wallet-desktop-main mobile-display-none-web">
				<div class="wallet-dektop-header">
				<div class="wallet-desktop-header-left">
					<div class="wallet-header-desktop-img-left">
						<?php $avatar = auth()->guard('customer')->user()->avatar; ?>
					@if($avatar == '' )
						<img class="wallet-header-left-img2" src="{{ asset('images/user.png') }}" alt="">
					@else
						<img class="wallet-header-left-img2"  src="{{ asset('').$avatar }}" alt="">
					@endif
					</div>
					<div class="wallet-header-img-right">
					<div class="wallet-header-desktop-title common-text">{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}}</div>
					@if($result['commonContent']['settings']['Loyalty']=='1')
						<div class="wallet-header-desktop-name">@lang('website.Loyalty_Points'): {{ auth()->guard('customer')->user()->loyalty_points }} </div>
					@endif
					</div>
				</div>
				<div class="wallet-desktop-header-right">
					<div class="wallet-desktop-header-right-name">@lang('website.E-mail') : <span>{{auth()->guard('customer')->user()->email}}</span></div>
					@if($result['commonContent']['settings']['Membertype']=='1')
					<div class="wallet-desktop-header-right-name">Member Type : <?php  $level = DB::table('member_type')->where('id', auth()->guard('customer')->user()->users_level)->first(); if($level != ''){ echo $level->member_type_name;}else {echo 'Normal';} ?> </div>
					@endif
				</div>
				</div>

				<div class="wallet-desktop-content-main">
				<div class="wallet-desktop-content-left">
					<div class="wallet-desktop-content-left-main">
					<div class="wallet-desktop-content-left-title">Account Settings</div>
					<div class="wallet-desktop-content-menu-main">
						<a href="{{ URL::to('/profile')}}">
						<div class="wallet-desktop-content-menu-item"><i class="fas fa-user wallet-icon"></i> @lang('website.Profile')</div>
						</a>
						<a href="{{ URL::to('/shipping-address')}}">
						<div class="wallet-desktop-content-menu-item"> <i class="fas fa-map-marker-alt wallet-icon"></i> <span style="vertical-align:text-bottom">@lang('website.Shipping Address')</span></div>
						</a>
						<!-- <a  href="{{ URL::to('/change-password')}}">
						<div class="wallet-desktop-content-menu-item"><i class="fas fa-unlock-alt wallet-icon"></i> @lang('website.Change Password')</div>
						</a> -->
						<a  href="{{ URL::to('/logout')}}">
						<div class="wallet-desktop-content-menu-item"><i class="fas fa-power-off wallet-icon"></i> <span style="vertical-align:text-bottom">@lang('website.Logout')</span></div>
						</a>
					</div>
					</div>

					<div class="wallet-desktop-content-left-main">
					<div class="wallet-desktop-content-left-title">Others</div>
					<div class="wallet-desktop-content-menu-main">
						<a  href="{{ URL::to('/wishlist')}}">
						<div class="wallet-desktop-content-menu-item wallet-active"> <i class="fas fa-heart  wallet-icon"></i> @lang('website.Wishlist')</div>
						</a>
						<a  href="{{ URL::to('/orders')}}">
						<div class="wallet-desktop-content-menu-item"> <i class="fas fa-shopping-cart  wallet-icon"></i> @lang('website.Orders')</div>
						</a>
						<?php if($result['commonContent']['settings']['appointment'] == '1') { ?>
							<a  href="{{ URL::to('/view_appointment')}}">
								<div class="wallet-desktop-content-menu-item"><i class="fas fa-check  wallet-icon"></i> View Appointment</div>
							</a>
						<?php } ?>
						<a  href="{{ URL::to('/point-transaction')}}">
						<div class="wallet-desktop-content-menu-item"><i class="fas fa-gift  wallet-icon"></i> @lang('website.point_transaction')</div>
						</a>
						<a  href="{{ URL::to('/tickets')}}">
						<div class="wallet-desktop-content-menu-item"> <i class="fas fa-ticket-alt  wallet-icon"></i> @lang('website.tickets')</div>
						</a>
						<?php if($result['commonContent']['settings']['wallet'] == '1') { ?>
							<a  href="{{ URL::to('/wallet')}}">
								<div class="wallet-desktop-content-menu-item"><i class="fa fa-google-wallet  wallet-icon"></i> Wallet</div>
							</a>
						<?php } ?>
					</div>
					</div>

				</div>
				<div class="wallet-desktop-content-right">
					<div  style="background:#fff;padding-top: 10px;margin-left:17px;">
						<h3 style="margin:10px 0px 30px 0px;text-align:center">Wishlist</h3>

						<div class="wislist-main"> 
							@if(!empty($result['products']['product_data']) and count($result['products']['product_data'])>0)
								@foreach($result['products']['product_data'] as $key=>$products) 
									<div class="wislsist-main-item">
										<div class="wishlist-main-left-side">
											@if($products->image_path_type == 'aws')
												<img class="wishlist-img" src="{{$products->image_path}}" alt="{{$products->products_name}}">
											@else
												<img class="wishlist-img" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}">
											@endif
										</div>
										<div class="wishlist-main-right-side">
											<div class="wishlist-main-right-side-product-name">
												<a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a>
											</div>
											<div class="wishlist-main-right-side-product-name">
												<?php
													if(!empty($products->discount_price)){
														$discount_price = $products->discount_price * session('currency_value');
													}
													if(!empty($products->flash_price)){
														$flash_price = $products->flash_price * session('currency_value');
													}
													$orignal_price = $products->products_price * session('currency_value');

													if(!empty($products->discount_price)){
														if(($orignal_price+0)>0){
															$discounted_price = $orignal_price-$discount_price;
															$discount_percentage = $discounted_price/$orignal_price*100;
															$discounted_price = $products->discount_price;

														}else{
															$discount_percentage = 0;
															$discounted_price = 0;
														}
													}
													else{
														$discounted_price = $orignal_price;
													}
												?>
												@if(!empty($products->flash_price))
													<sub class="wishlist-total-price">{{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}</sub>
													<span class="wishlist-special-price">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}} </span> 
												@elseif(!empty($products->discount_price))
													<price class="wishlist-total-price">{{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}</price>
													<span class="wishlist-special-price">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}} </span> 
												@else
													<price class="wishlist-total-price">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</price>
												@endif
											</div>
											<div class="wishlist-main-right-side-product-name">
												<!--  -->
											</div>
											<div class="wishlist-main-right-side-footer">
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
													<div class="wishlist-main-right-footer-but">
														@if($products->button_type == 1 || $products->button_type == 3)
															@if($products->products_type==0)
																@if(!in_array($products->products_id,$result['cartArray']))
																	@if($result['commonContent']['settings']['Inventory'])
																	@if($products->stock_status == 1)
																		@if($products->defaultStock <= 0)
																			<button type="button" class="btn wishlist-but" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
																		@else
																			<button type="button" class="btn  cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
																		@endif
																	@else
																		<button type="button" class="btn cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
																	@endif
																	@else
																		<button type="button" class="btn cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
																	@endif
																@else
																	<button type="button" class="btn active wishlist-but">@lang('website.Added')</button>
																@endif
															@elseif($products->products_type==1)
																<a class="btn wishlist-but" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
															@elseif($products->products_type==2)
																<a href="{{$products->products_url}}" target="_blank" class="btn wishlist-but">@lang('website.External Link')</a>
															@elseif($products->products_type==3)
																@if(!in_array($products->products_id,$result['cartArray']))
																	<?php
																		$stocks = 0;
																		$stockarray = [];

																		$comboPro = DB::table('product_combo')->where('pro_id', $products->products_id)->get();

																		foreach($comboPro as $key=>$comboProd){

																			$stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
																			$stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
																			$stocks = $stocksin - $stockOut;
																			$stockarray[$key] = $stocks;
																			//print_r($stockarray);

																		} 
																	?>

																	@if($result['commonContent']['settings']['Inventory'])
																		@if(in_array('0',$stockarray))
																			<button type="button" class="btn wishlist-but" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
																		@else
																			<button type="button" class="btn  cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
																		@endif
																	@else
																		<button type="button" class="btn cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
																	@endif
																@else
																	<button type="button" class="btn active wishlist-but">@lang('website.Added')</button>
																@endif
															@elseif($products->products_type==4)
																@if(!in_array($products->products_id,$result['cartArray']))
																<?php
																	$stocks = 0;
																	$stockarray = [];

																	$comboPro = DB::table('product_buy_x')->where('pro_id', $products->products_id)->get();

																	foreach($comboPro as $key=>$comboProd){

																		$stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
																		$stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
																		$stocks = $stocksin - $stockOut;
																		$stockarray[$key] = $stocks;
																		//print_r($stockarray);

																	} 

																	$stocksgetx = 0;
																			$stockarraygetx = [];
															
																			$comboProgetx = DB::table('product_get_x')->where('pro_id', $products->products_id)->get();
															
																			foreach($comboProgetx as $key=>$comboProdgetx){
															
																				$stocksin = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'in')->sum('stock');
																				$stockOut = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'out')->sum('stock');
																				$stocksgetx = $stocksin - $stockOut;
																				$stockarraygetx[$key] = $stocksgetx;
																				//print_r($stockarraygetx);
																			}

																	?>

																	@if($result['commonContent']['settings']['Inventory'])
																		@if((in_array('0',$stockarray)) || (in_array('0',$stockarraygetx)))
																			<button type="button" class="btn wishlist-but" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
																		@else
																			<button type="button" class="btn  cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
																		@endif
																	@else
																		<button type="button" class="btn cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
																	@endif
																@else
																	<button type="button" class="btn active wishlist-but">@lang('website.Added')</button>
																@endif
															@endif
														@elseif($products->button_type == 2)
															<button type="button" class="btn  wishlist-but modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
														@elseif($products->button_type == 4)
															<a class="btn wishlist-but" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
														@endif 
													</div>
												@endif
												<div class="butt-trash">
													<a href="{{ URL::to("/UnlikeMyProduct")}}/{{$products->products_id}}"><i class="fas fa-trash-alt" style="color:red;font-size:13px;"></i></a>
												</div>

											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						
					</div>
				</div>
				</div>
			</div>


	<!--- mobile view --->

	<div class="desktop-display-none-web">
        <div class="col-12 media-main">
          <div class="media">
              <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
              @if($avatar == '' )
                <img class="wallet-header-left-img2" src="{{ asset('images/user.png') }}" alt="">
              @else
                <img class="wallet-header-left-img2"  src="{{ asset('').$avatar }}" alt="">
              @endif
              <div class="media-body">
                <div class="row">
                  <div class="col-12 col-sm-4 col-md-6">
                    <h4>{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}}<br>
                    <small>@lang('website.Phone'): {{ auth()->guard('customer')->user()->phone }} </small><br>
                    @if($result['commonContent']['settings']['Loyalty']=='1')
                    <small>@lang('website.Loyalty_Points'): {{ auth()->guard('customer')->user()->loyalty_points }} </small><br>
                    @endif
                    @if($result['commonContent']['settings']['Membertype']=='1')
                    <small>Member Type: <?php  $level = DB::table('member_type')->where('id', auth()->guard('customer')->user()->users_level)->first(); if($level != ''){ echo $level->member_type_name;}else {echo 'Normal';} ?> </small><br>
                    @endif
                  </h4>
                  </div>
                  <div class="col-12 col-sm-8 col-md-6 detail">                  
                    <p class="mb-0">@lang('website.E-mail'):<span>{{auth()->guard('customer')->user()->email}}</span></p>
                  </div>
                  </div>
              </div>
              
          </div>
        </div>

    

        <div class="wallet-mobile-content-main">
          <div class="wallet-mobile-content-left">
            <div class="wallet-mobile-content-left-main">
              <div class="wallet-mobile-content-menu-main">
                <a href="{{ URL::to('/profile')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-user wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a href="{{ URL::to('/shipping-address')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-map-marker-alt wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <!-- <a  href="{{ URL::to('/change-password')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-unlock-alt wallet-icon-mobile"></i> @lang('website.Change Password')</div>
                </a> -->
                <a  href="{{ URL::to('/logout')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-power-off wallet-icon-mobile"></i></div>
                  </div>
                </a>
              </div>
            </div>

            <div class="wallet-mobile-content-left-main">
              <div class="wallet-mobile-content-menu-main">
                <a  href="{{ URL::to('/wishlist')}}">
                  <div class="wallet-mobile-content-menu-item wallet-active-mobile"> 
                    <div><i class="fas fa-heart  wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a  href="{{ URL::to('/orders')}}">
                  <div class="wallet-mobile-content-menu-item"> 
                    <div><i class="fas fa-shopping-cart  wallet-icon-mobile"></i> </div>
                  </div>
                </a>
				<?php if($result['commonContent']['settings']['appointment'] == '1') { ?>
					<a  href="{{ URL::to('/view_appointment')}}">
						<div class="wallet-mobile-content-menu-item">
							<div><i class="fas fa-check  wallet-icon-mobile"></i></div>
						</div>
					</a>
				<?php } ?>
                <a  href="{{ URL::to('/point-transaction')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-gift  wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a  href="{{ URL::to('/tickets')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-ticket-alt  wallet-icon-mobile"></i></div>
                  </div>
                </a>
				<?php if($result['commonContent']['settings']['wallet'] == '1') { ?>
					<a  href="{{ URL::to('/wallet')}}">
						<div class="wallet-mobile-content-menu-item">
							<div><i class="fa fa-google-wallet  wallet-icon-mobile"></i></div>
						</div>
					</a>
				<?php } ?>
              </div>
            </div>

          </div>
          <div class="profile-mobile-content-right">
            <div  style="background:#fff;margin-left:0px;">

                <h3 style="margin:10px 0px 30px 0px;text-align:center">Wishlist</h3>

				<div class="wislist-main"> 
					@if(!empty($result['products']['product_data']) and count($result['products']['product_data'])>0)
						@foreach($result['products']['product_data'] as $key=>$products) 
							<div class="wislsist-main-item">
								<div class="wishlist-main-left-side">
									@if($products->image_path_type == 'aws')
                      					<img class="wishlist-img" src="{{$products->image_path}}" alt="{{$products->products_name}}">
									@else
										<img class="wishlist-img" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}">
									@endif
								</div>
								<div class="wishlist-main-right-side">
									<div class="wishlist-main-right-side-product-name">
										<a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a>
									</div>
									<div class="wishlist-main-right-side-product-name">
										<?php
											if(!empty($products->discount_price)){
												$discount_price = $products->discount_price * session('currency_value');
											}
											if(!empty($products->flash_price)){
												$flash_price = $products->flash_price * session('currency_value');
											}
											$orignal_price = $products->products_price * session('currency_value');

											if(!empty($products->discount_price)){
												if(($orignal_price+0)>0){
													$discounted_price = $orignal_price-$discount_price;
													$discount_percentage = $discounted_price/$orignal_price*100;
													$discounted_price = $products->discount_price;

												}else{
													$discount_percentage = 0;
													$discounted_price = 0;
												}
											}
											else{
												$discounted_price = $orignal_price;
											}
										?>
										@if(!empty($products->flash_price))
											<sub class="wishlist-total-price">{{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}</sub>
											<span class="wishlist-special-price">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}} </span> 
										@elseif(!empty($products->discount_price))
											<price class="wishlist-total-price">{{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}</price>
											<span class="wishlist-special-price">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}} </span> 
										@else
											<price class="wishlist-total-price">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</price>
										@endif
									</div>
									<div class="wishlist-main-right-side-product-name">
										<!--  -->
									</div>
									<div class="wishlist-main-right-side-footer">
										<div class="wishlist-main-right-footer-but">
											@if($products->button_type == 1 || $products->button_type == 3)
												@if($products->products_type==0)
													@if(!in_array($products->products_id,$result['cartArray']))
														@if($result['commonContent']['settings']['Inventory'])
															@if($products->defaultStock <= 0)
																<button type="button" class="btn wishlist-but" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
															@else
																<button type="button" class="btn  cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
															@endif
														@else
															<button type="button" class="btn cart wishlist-but" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
														@endif
													@else
														<button type="button" class="btn active wishlist-but">@lang('website.Added')</button>
													@endif
												@elseif($products->products_type==1)
													<a class="btn wishlist-but" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
												@elseif($products->products_type==2)
													<a href="{{$products->products_url}}" target="_blank" class="btn wishlist-but">@lang('website.External Link')</a>
												@endif
											@elseif($products->button_type == 2)
												<button type="button" class="btn  wishlist-but modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
											@elseif($products->button_type == 4)
												<a class="btn wishlist-but" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
											@endif 
										</div>
										<div class="butt-trash">
											<a href="{{ URL::to("/UnlikeMyProduct")}}/{{$products->products_id}}"><i class="fas fa-trash-alt" style="color:red;font-size:13px;"></i></a>
										</div>

									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
                 
              </div>
			
          </div>
        </div>

      </div>

	</div>
</section>
@endsection
