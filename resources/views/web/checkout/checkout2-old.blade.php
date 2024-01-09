@extends('web.layout')
@section('content')

<style>
      .table tbody + tbody {
    border-top: none;
}
.btn-disabled-new {
    background-color: rgb(149,149,149);
    border: rgb(149,149,149);
    color: #fff !important;
}
.checkout-2-main .checkout-2-left-side
{
  width: 60%;
  border-right: solid 1px #ddd;
  display: inline-grid;
}
.d-flex-new {
    display: flex !important;
    justify-content: space-between;
    align-items: center;
  
}
.checkout-2-main {
    padding-left: 60px;
}
.checkout-2-main .checkout-2-right-side
{
  width: 39%;
  display: inline-grid;
}
.checkout-2-main .checkout-2-inner
{
  padding: 66px;
}
.checkout-2-main 
.nav-pills .nav-link.active, .checkout-2-main .nav-pills .show > .checkout-2-main .nav-link {
    color: #000;
    background-color: #fff;
    font-weight: 700 !important;
}
.checkout-2-main .nav-pills .nav-link {
    font-size: 12px;
    padding: 0 !important;
}
.checkout-2-main .checkout-2-breadcrum-inner
{
  width:12px;
  height:10px;
  margin-top:-5px;
}
.checkout-2-info-outer {
    display: block;
    position: relative;
}
.checkout-2-info-inner 
{
   position: relative;
   grid-gap: 1.4rem;
   gap: 1.4rem;
   display: grid;
}

.checkout-2-info-title {
    margin: 0;
    font-size: 16px;
    color: rgb(64,51,49);
    font-weight: 500;
    letter-spacing: 0.5px;
}
.checkout-2-info-img-outer 
{
   position: relative;
   grid-gap: 1.4rem;
   gap: 1.4rem;
   display: grid;
}
.checkout-2-info-img-inner 
{
   position: relative;
   justify-content: flex-start;
   display: flex;

}
.checkout-2-info-img-outer-circle
{
  justify-content: flex-start;
  min-height: 100%;
  flex-wrap: wrap;
  display: flex;
  align-items: center;
   grid-gap: 1.4rem;
   gap: 1.4rem;
   
}
.checkout-2-info-img-left
{
  grid-template-columns: minmax(0,1fr);
  grid-gap: 1.4rem;
   gap: 1.4rem;
   display: grid;
}
.checkout-2-img
{
  width: 50px;
  height: 50px;
  border-radius: 10px;
  overflow: hidden;
  background-color: rgb(217,217,217);
    background-size: cover;
}
.checkout-2-info-img-right
{
  grid-template-columns: minmax(0,1fr);
  grid-gap: 0;
   gap: 0;
   display: grid;
}
.checkout-2-info-img-title {
}
.checkout-2-info-logout-outer {
  position: relative;
   justify-content: flex-start;
   display: flex;
}
.checkout-2-info-logout-a {
  background-color: transparent;
    color: rgb(17,17,17);
}
.checkout-2-info-select-outer
{
  display: flex;
  position: relative;
}
.checkout-2-info-select-inner
{
  width:calc(22.2px*18/14);
  height:calc(22.2px*18/14);
  position: relative;
}
.checkout-2-info-select-input
{

  display: block;
  cursor: pointer;
  margin-top: 5px;
}
.checkout-2-info-select-label
{
  cursor: pointer;
  
}
.checkout-2-shipmethod-new
{
  border: solid 1px #aaa;
    border-radius: 3px;
    padding: 15px;
    margin-bottom: 15px;
    position: relative;
}
.checkout-2-shipmethod-new-span {
    text-align: right;
    position: absolute;
    right: 15px;
}
/* .checkout-2-info-select-input
{
  box-shadow: 0 0 0 0.7142857142857143em rgb(17,17,17) inset;
  border-right-width: 1px;
  border-left-width: 1px;
  border-right-style: solid;
  border-left-style: solid;
  border-right-color: transparent;
  border-left-color: transparent;
  background-color: #fff;
  border-radius:15px;
  border-bottom-width:1px;
  border-top-width: 1px;
  border-inline-end-width: 1px;
  border-inline-start-width: 1px;
  border-bottom-style: solid;
  border-bottom-style: solid;
  border-inline-end-style: solid;
  border-inline-start-style: solid;
  border-bottom-color: transparent;
  border-top-color: transparent;
  border-inline-end-color: transparent;
  border-inline-start-color: transparent;
  background-clip: padding-box;
  transition-timing-function: cubic-bezier(0.3,0.5,0.5,1);
  transition-property: all;
  transition-duration: 133.333ms;
  width: 100%;
  display: block;
  cursor: pointer;
  box-sizing: content-box;
  height: 100%;
  padding: 0;
}
.checkout-2-info-select-input:before {
    content: "";
    display: block;
    border-radius: 1px;
    border-radius:15px;
    width: 100%;
    height: 100%;
    pointer-events: none;
    opacity: .3;  
}
.checkout-2-input-tick-outer
{
  opacity: 1;
  left: calc(50% + 1px);
  color: #fff;
  top: calc(50% + 1px);
  inset-inline-start: calc(50% + 1px);
  transform: translate(-50%,-50%);
  position: absolute;
  transition-timing-function: ease-in-out;
  transition-property: all;
  transition-duration: 133.333ms;
  transform-origin: center;
  pointer-events: none;
}
.checkout-2-input-tick-span
{
    min-width: calc(1.4rem *0.71429);
    min-height: calc(1.4rem *0.71429);
    width: calc(1.4rem *0.71429);
    height: calc(1.4rem *0.71429);
    max-width: 100%;
    max-width: 100%;
    display: block;
} */

.checkout-2-shipaddress-title
{
margin-top: 30px;
    color: rgb(64,51,49);
    font-weight: 700;
    margin-bottom: 15px;
    letter-spacing: 0.5px;
    font-size: 18px;
}
.checkout-2-position
{
    position: relative;
}
.checkout-2-shipaddress-select-label
{
  position: absolute;
    left: 10px;
    font-size: 11px;
    margin-bottom: 0;
    top: 5px;
}
.checkout-2-shipaddress-select {
    padding-top: 20px;
    border-radius: 6px;
    padding-left: 10px;
    padding-right: 35px;
    height: auto;
    line-height: inherit;
}
.checkout-2-shipaddress-input-label
{
  position: absolute;
    left: 10px;
    font-size: 11px;
    margin-bottom: 0;
    top: 5px;
}
.checkout-2-shipaddress-input {
    padding-top: 20px;
    border-radius: 6px;
    padding-left: 10px;
    padding-right: 10px;
    height: auto;
    line-height: inherit;
}
.checkout-2-grid
{
display: grid;
    grid-template-columns: auto auto;
}
.checkout-2-margin-r10
{
  margin-right:10px;
}
.checkout-2-shipping-btn-outer
{
  justify-content: space-between;
    flex-direction: row-reverse;
    align-items: center;
    display: flex;
    grid-gap: 2.6rem;
    gap: 2.6rem;
    margin-top: 2.1rem;
}
.checkout-2-shipping-con-btn
{
  padding: 20px 30px;
    border-radius: 6px;
    text-transform: none !important;
}
.checkout-2-shipping-a
{
  text-align: left;
  min-width: 100%;
}
.checkout-2-shipping-a:before {
    content: "";
    position: absolute;
    pointer-events: unset;
    box-shadow: 0 0 0 0 transparent;
    transition: inherit;
}
.checkout-2-shipping-a-1{
    display: flex;
    justify-content: center;
}
.checkout-2-shipping-a-2{
    display: flex;
    position: relative;
    justify-content: flex-start;
}
.checkout-2-shipping-a-3{
    display: flex;
    position: relative;
    align-items: center;
    grid-gap: 0.9rem;
    gap: 0.9rem;
    justify-content: flex-start;
    flex-wrap: wrap;
}
.checkout-2-shipping-a-4{
    width: 12px;
    height: 12px;
    display: block;
    margin-top: -5px;
}
.checkout-2-right-section-outer
{
  margin-left:44px;
  margin-right:96px;
}
.checkout-2-tumb-img-outer
{
    border: solid 1px #ddd;
    width: 60px;
    height: 60px;
    border-radius: 3px;
    position: relative;
    margin-bottom:20px;
}
.checkout-2-tumb-img
{
  width: 100% !important;
  height: 100% !important;
  object-fit: contain;
}
.checkout-2-round-qty
{
  position: absolute;
  width: 20px;
  height: 20px; 
  border-radius: 50%;
  background: #737373e6;
  color : #fff;
  top: -10px;
  right: -10px;
}
.checkout-2-pro-title
{
  font-size: 12px;
}
.checkout-2-table td
{
  padding: 0 !important;
}
.checkout-2-coupon-apply-btn
{
  padding: 11px 15px;
    border-radius: 6px;
}
.checkout-2-coupon-input
{
  margin-right: 10px;
    padding: 11px 25px;
    border-radius: 6px;
  
}
.checkout2-total-price-tb {
    border-bottom: solid 1px #ddd;
    border-top: solid 1px #ddd;
}
@media only screen and (max-width: 768px)
{
  .checkout-2-main .checkout-2-left-side
{
  width: 100%;
}
.checkout2-total-price-tb {
    border-bottom: none;
}
.checkout-2-main {
    padding-left: 40px;
}
.checkout-2-main .checkout-2-right-side
{
  width: 100%;
}
.checkout-2-table{
    width: 100%;
    margin-bottom: 38px;
    color: #111;
}
.checkout-2-table-2{
    margin-bottom: 0px;
    margin-top: 10px;
}
}
@media only screen and (max-width: 540px)
{
  .checkout-2-main .checkout-2-left-side
{
  width: 100%;
  border: none;
}
.checkout-2-table{
    width: 100%;
    margin-bottom: 20px;
    color: #111;
}
.checkout-2-main {
    padding-left: 10px;
    padding-right: 10px;
}
.checkout-2-main .checkout-2-right-side
{
  width: 100%;
}
.checkout-2-main .checkout-2-inner {
    padding: 66px 0;
}
.checkout-2-right-section-outer {
    margin-left: 10px;
    margin-right: 10px;
}
}

</style>

<!-- checkout Content -->
<section class="checkout-area">

@if(session::get('paytm') == 'success')
@php Session(['paytm' => 'sasa']); @endphp
<script>
jQuery(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready
 jQuery("#update_cart_form").submit();
});


</script>
@endif
<div class="checkout-2-main">
  <div class="checkout-2-left-side">
    <div class="checkout-2-inner">
      <ul class="nav nav-pills mb-3 checkoutd-nav d-none d-lg-flex" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0)  @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">
          <span class="d-flex d-lg-none">1</span>
          <span class="d-none d-lg-flex">@lang('website.Shipping Address')</span></a>
        </li>
        <li style="margin:0 10px;"><span class="checkout-2-breadcrum-outer"><svg viewBox="0 0 10 10" class="checkout-2-breadcrum-inner" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg></span></li>
        <li class="nav-item">
          <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >@lang('website.Billing Address')</a>
          
        </li>
        <li style="margin:0 10px;"><span class="checkout-2-breadcrum-outer"><svg viewBox="0 0 10 10" class="checkout-2-breadcrum-inner" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg></span></li>
        
        <li class="nav-item">
          <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2)  @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif> @lang('website.Shipping Methods')</a>
        </li>
        <li style="margin:0 10px;"><span class="checkout-2-breadcrum-outer"><svg viewBox="0 0 10 10" class="checkout-2-breadcrum-inner" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg></span></li>
        <li class="nav-item">
            <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>@lang('website.Order Detail')</a>
          </li>

      </ul>
      <ul class="nav nav-pills mb-3 checkoutd-nav d-flex d-lg-none" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">Address</a>
        </li>
        <li style="margin:0 10px;"><span class="checkout-2-breadcrum-outer"><svg viewBox="0 0 10 10" class="checkout-2-breadcrum-inner" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg></span></li>
        <li class="nav-item second">
          <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >Billing</a>
        </li>
        <li style="margin:0 10px;"><span class="checkout-2-breadcrum-outer"><svg viewBox="0 0 10 10" class="checkout-2-breadcrum-inner" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg></span></li>
        <li class="nav-item third">
          <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif>shipping</a>
        </li>
        <li style="margin:0 10px;"><span class="checkout-2-breadcrum-outer"><svg viewBox="0 0 10 10" class="checkout-2-breadcrum-inner" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg></span></li>
        <li class="nav-item fourth">
          <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) active-check @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>Detail</a>
          </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade @if(session('step') == 0) show active @endif" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">

        <section class="checkout-2-info-outer">
          <div class="checkout-2-info-inner">
            <h2 class="checkout-2-info-title">Contact information</h2>
            <div class="checkout-2-info-img-outer">
              <div class="checkout-2-info-img-inner">
                <div class="checkout-2-info-img-outer-circle">
                  <div class="checkout-2-info-img-left">
                    <div aria-label="Avatar" role="img" class="checkout-2-img" style="background-image: url(&quot;https://cdn.shopify.com/proxy/8fd84d9684b7353bc500df5beabc5e2d8cbd58741408ee462ae60065ff6b8a2a/www.gravatar.com/avatar/56168e59f5c73859acafa16b7882b5d1.jpg?s=100&amp;d=https%3A%2F%2Fcdn.shopify.com%2Fshopifycloud%2Fshopify%2Fassets%2Fno-gravatar-new-04e7c2331218ac202e79e31be502fd5631bc96cb0206580dbcb0720ebbbd7c73_100x100.png&quot;);"></div>
                  </div>
                  <div class="checkout-2-info-img-right">
                    <span class="checkout-2-info-img-title">{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}} ({{auth()->guard('customer')->user()->email}})</span>
                    <div class="checkout-2-info-logout-outer">
                      <div class="checkout-2-info-logout-inner">
                        <a class="checkout-2-info-logout-a"  href="{{ URL::to('/logout')}}">Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div>
            <div class="checkout-2-info-select-outer">
              <div class="checkout-2-info-select-inner">
                <input type="checkbox" id="marketing_opt_in" name="marketing_opt_in" class="checkout-2-info-select-input">
                <!-- <div class="checkout-2-input-tick-outer">
                  <span class="checkout-2-input-tick-span">
                    <svg viewBox="0 0 20 20" class="checkout-2-input-tick-inner" focusable="false" aria-hidden="true">
                      <path d="M20 5.347L7.647 17.462 0 9.962l2.393-2.347 5.254 5.154L17.607 3z"></path>
                    </svg>
                  </span>
                </div> -->
              </div>
              <label for="marketing_opt_in" class="checkout-2-info-select-label">Sign up for order updates, exclusive offers and news on Email</label>
            </div>
          </div>
        </div>
      </div>
    </section>


    <h2 class="checkout-2-shipaddress-title">Shipping address</h2>

          <div class="form-group checkout-2-position">
            <label for="" class="checkout-2-shipaddress-select-label">Saved address</label>
            <select class="form-control checkout-2-shipaddress-select" id="default_address_id" onChange="getDefaultaddress();" name="default_address_id" aria-describedby="countryHelp">
              <option value="" selected>@lang('website.Select_Shipping')</option>
                @if(!empty($result['address']))
                  @foreach($result['address'] as $address)
                    <option value="{{$address->address_id}}" @if(!empty($result['default'])) @if($result['default']->address_id == $address->address_id) selected @endif @endif >{{$address->lastname}}.{{$address->firstname}}({{$address->street}})\
                    </option>
                  @endforeach
                @endif
            </select>
            <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your shipping address')</span>
          </div>
          <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/checkout_shipping_address')}}" method="post">
            <input type="hidden" required name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="hidden" required name="address_book_id" id="address_book_id" value="@if(!empty($result['default']->address_id)){{$result['default']->address_id}}@endif" />
            <div class="">

              <div class="checkout-2-grid">
                <div class="form-group checkout-2-position checkout-2-margin-r10">
                  <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.First Name') <span style="color:red;">*</span></label>
                  <input type="text"  required class="form-control checkout-2-shipaddress-input field-validate" id="firstname" name="firstname" value="@if(!empty($result['default']->firstname)){{$result['default']->firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                  <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                </div>
                <div class="form-group checkout-2-position">
                  <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Last Name') <span style="color:red;">*</span></label>
                  <input type="text" required class="form-control checkout-2-shipaddress-input field-validate" id="lastname" name="lastname" value="@if(!empty($result['default'])){{$result['default']->lastname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Last Name">
                  <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                </div>
              </div>
              <?php if(Session::get('guest_checkout') == 1){ ?>
                <div class="form-group checkout-2-position">
                  <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Email')</label>
                  <input type="text" required class="form-control checkout-2-shipaddress-input field-validate" id="email" name="email" value="@if(!empty(session('shipping_address'))){{session('shipping_address')->email}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Email">
                  <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your email')</span>
                </div>
              <?php } ?>
              <div class="form-group checkout-2-position">
                <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Company')</label>
                <input type="text" class="form-control checkout-2-shipaddress-input" id="company" aria-describedby="companyHelp" placeholder="Enter Your Company Name" name="company" value="@if(!empty($result['default'])){{$result['default']->company}}@endif">
                <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
              </div>
              <?php if($result['commonContent']['settings']['is_enable_location'] == 1){ ?>
                      <div class="form-group">
                        <label for=""> @lang('website.Location') <span style="color:red;">*</span></label>
                        <input type="text" required class="form-control field-validate" data-toggle="modal" data-target="#mapModal" name="location" id="location" aria-describedby="addressHelp" placeholder="@lang('website.Please enter your location or click here to open map')" value="@if( !empty(session('shipping_address'))  && isset (session('shipping_address')->location) ) {{session('shipping_address')->location}} @else @if(!empty($result['default']))({{$result['default']->latitude}},{{$result['default']->longitude}})@endif
                        @endif">
                       
                      </div>
                      <?php }?>
                      <input type="hidden" name="latitude" id="latitude" value="@if(!empty(session('shipping_address')) && isset(session('shipping_address')->latitude) ) {{session('shipping_address')->latitude}} @else {{$result['default']->latitude}} @endif">
                      <input type="hidden" name="longitude" id="longitude" value="@if(!empty(session('shipping_address')) && isset(session('shipping_address')->longitude)  ) {{session('shipping_address')->longitude}} @else {{$result['default']->latitude}} @endif">
              <div class="form-group checkout-2-position">
                <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Address') <span style="color:red;">*</span></label>
                <input type="text" required class="form-control checkout-2-shipaddress-input field-validate" name="street" id="street" aria-describedby="addressHelp" placeholder="@lang('website.Please enter your address')" value="@if(!empty($result['default'])){{$result['default']->street}}@endif">
                <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
              </div>
              <div class="checkout-2-grid">

              <div class="form-group checkout-2-position checkout-2-margin-r10">
                <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Country') <span style="color:red;">*</span></label>
                
                  <select required class="form-control checkout-2-shipaddress-input field-validate" id="entry_country_id" onChange="getZones();" name="countries_id" aria-describedby="countryHelp">
                    <option value="" selected>@lang('website.Select Country')</option>
                    @if(!empty($result['countries']))
                      @foreach($result['countries'] as $countries)
                          <option value="{{$countries->countries_id}}" @if(!empty($result['default'])) @if($result['default']->countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                      @endforeach
                    @endif
                  </select>
                
                <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your country')</span>
              </div>

              
                <div class="form-group checkout-2-position ">
                  <label for=""  class="checkout-2-shipaddress-input-label"> @lang('website.State')</label>
                 
                    <select required class="form-control checkout-2-shipaddress-input field-validate" id="entry_zone_id"  name="zone_id" aria-describedby="stateHelp">
                      <option value="">@lang('website.Select State') <span style="color:red;">*</span></option>
                        @if(!empty($result['zones']))
                        @foreach($result['zones'] as $zones)
                            <option value="{{$zones->zone_id}}" @if(!empty($result['default'])) @if($result['default']->zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                        @endforeach
                      @endif
                      <option value="-1" @if(!empty(session('shipping_address'))) @if(session('shipping_address')->zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                    </select>
                  
                  <small id="stateHelp" class="form-text text-muted"></small>
                </div>
                </div>
                <div class="checkout-2-grid">

                  <div class="form-group checkout-2-position checkout-2-margin-r10">
                    <label for=""  class="checkout-2-shipaddress-input-label"> @lang('website.City') <span style="color:red;">*</span></label>
                      <input required type="text" class="form-control checkout-2-shipaddress-input field-validate" id="city" name="city" value="@if(!empty($result['default'])){{$result['default']->city}}@endif" placeholder="Enter Your City">
                      <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                  </div>
              
              

                  <div class="form-group checkout-2-position">
                <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Zip/Postal Code')</label>
                <input required type="number" class="form-control checkout-2-shipaddress-input" id="postcode" aria-describedby="zpcodeHelp" placeholder="@lang('website.Enter Your Zip / Postal Code')" name="postcode" value="@if(!empty($result['default'])){{$result['default']->postcode}}@endif">
                <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your Zip/Postal Code')</span>
              </div>
              </div>   
              <div class="form-group checkout-2-position">
                <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Phone')</label>
                <input required type="text" class="form-control checkout-2-shipaddress-input" id="delivery_phone" aria-describedby="numberHelp" placeholder="@lang('website.Enter Your Phone Number')" name="delivery_phone" value="@if(!empty($result['default'])){{$result['default']->entry_phone}}@endif">
                <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
              </div>                           
              </div>   
              
              <div class="checkout-2-shipping-btn-outer">
                <div>
                  <button type="submit" value="no" name="continue" class="hide-load-time-btn btn swipe-to-top btn-secondary checkout-2-shipping-con-btn">
                    <span class="checkout-2-shipping-btn-span">Continue to Billing</span>
                  </button>
                </div>
                <div>
                  <a class="checkout-2-shipping-a" href="{{ URL::to('/viewcart')}}">
                    <span class="checkout-2-shipping-a-1">
                      <div class="checkout-2-shipping-a-2">
                        <div class="checkout-2-shipping-a-3">
                          <span class="checkout-2-shipping-a-4">
                            <svg viewBox="0 0 10 10" class="checkout-2-shipping-a-5" focusable="false" aria-hidden="true">
                              <path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4"></path>
                            </svg>
                          </span>
                          <span class="checkout-2-shipping-a-span">Return to cart</span>
                        </div>
                      </div>
                    </span>
                  </a>
                </div>
              </div>
            
            <!-- <div class="form-row">
              <div class="form-group">
                <button type="submit" value="no" name="continue" class="hide-load-time-btn btn swipe-to-top btn-secondary">@lang('website.Continue')</button>
                <button type="submit" value="yes" name="save" class="hide-load-time-btn btn swipe-to-top btn-secondary">@lang('website.Save_Continue')</button>
              </div>
            </div> -->
          </form>
        </div>
                 <div class="tab-pane fade @if(session('step') == 1) show active @endif"  id="pills-billing" role="tabpanel" aria-labelledby="pills-billing-tab">

                 <section class="checkout-2-info-outer">
          <div class="checkout-2-info-inner">
            <h2 class="checkout-2-info-title">Contact information</h2>
            <div class="checkout-2-info-img-outer">
              <div class="checkout-2-info-img-inner">
                <div class="checkout-2-info-img-outer-circle">
                  <div class="checkout-2-info-img-left">
                    <div aria-label="Avatar" role="img" class="checkout-2-img" style="background-image: url(&quot;https://cdn.shopify.com/proxy/8fd84d9684b7353bc500df5beabc5e2d8cbd58741408ee462ae60065ff6b8a2a/www.gravatar.com/avatar/56168e59f5c73859acafa16b7882b5d1.jpg?s=100&amp;d=https%3A%2F%2Fcdn.shopify.com%2Fshopifycloud%2Fshopify%2Fassets%2Fno-gravatar-new-04e7c2331218ac202e79e31be502fd5631bc96cb0206580dbcb0720ebbbd7c73_100x100.png&quot;);"></div>
                  </div>
                  <div class="checkout-2-info-img-right">
                    <span class="checkout-2-info-img-title">{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}} ({{auth()->guard('customer')->user()->email}})</span>
                    <div class="checkout-2-info-logout-outer">
                      <div class="checkout-2-info-logout-inner">
                        <a class="checkout-2-info-logout-a"  href="{{ URL::to('/logout')}}">Log out</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div>
           
          </div>
        </div>
      </div>
    </section>
                     <form name="signup" enctype="multipart/form-data" action="{{ URL::to('/checkout_billing_address')}}" method="post">
                       <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                       <div class="">
                       <div class="checkout-2-grid">
                        <div class="form-group checkout-2-position checkout-2-margin-r10">
                  
                            <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.First Name')</label>
                             <input type="text" class="form-control checkout-2-shipaddress-input same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_firstname" name="billing_firstname" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                           </div>
                           <div class="form-group checkout-2-position">
                            <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Last Name')</label>
                             <input type="text" class="form-control checkout-2-shipaddress-input same_address" id="exampleInputName2" aria-describedby="NameHelp2" placeholder="Enter Your Name" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_lastname" name="billing_lastname" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_lastname}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                           </div>
                           </div>

                           <div class="form-group checkout-2-position">
                            <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Company')</label>
                             <input type="text" class="form-control checkout-2-shipaddress-input same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_company" name="billing_company" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_company}}@endif" id="exampleInputCompany1" aria-describedby="companyHelp" placeholder="Enter Your Company Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                           </div>

                           <div class="form-group checkout-2-position">
                            <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Address')</label>
                             <input type="text" class="form-control checkout-2-shipaddress-input same_address" id="exampleInputAddress1" aria-describedby="addressHelp" placeholder="Enter Your Address" @if(!empty(session('22'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_street" name="billing_street" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_street}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                           </div>
                           <div class="checkout-2-grid">
                        <div class="form-group checkout-2-position checkout-2-margin-r10">
                            <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Country')</label>
                             
                                 <select required class="form-control  checkout-2-shipaddress-input same_address_select" id="billing_countries_id" aria-describedby="countryHelp" onChange="getBillingZones();" name="billing_countries_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif>
                                   <option value=""  >@lang('website.Select Country')</option>
                                   @if(!empty($result['countries']))
                                     @foreach($result['countries'] as $countries)
                                         <option value="{{$countries->countries_id}}" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                                     @endforeach
                                   @endif
                                   </select>
                             
                             <span class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                           </div>
                           <div class="form-group checkout-2-position">
                            <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.State')</label>
                             
                                 <select required class="form-control checkout-2-shipaddress-input same_address_select" name="billing_zone_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif id="billing_zone_id" aria-describedby="stateHelp">
                                   <option value="" >@lang('website.Select State')</option>
                                   @if(!empty($result['zones']))
                                     @foreach($result['zones'] as $key=>$zones)
                                         <option value="{{$zones->zone_id}}" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                                     @endforeach
                                   @endif
                                     <option value="-1" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                                   </select>
                            
                             <span class="help-block error-content" hidden>@lang('website.Please select your state')</span>
                           </div>
                           </div>
                           <div class="checkout-2-grid">
                        <div class="form-group checkout-2-position checkout-2-margin-r10">
                            <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.City')</label>
                               <input type="text" class="form-control checkout-2-shipaddress-input same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_city" name="billing_city" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_city}}@endif" placeholder="Enter Your City">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                           </div>
                             <div class="form-group checkout-2-position">
                              <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Zip/Postal Code')</label>
                               <input type="text" class="form-control checkout-2-shipaddress-input same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_zip" name="billing_zip" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_zip}}@endif" aria-describedby="zpcodeHelp" placeholder="Enter Your Zip / Postal Code">
                               <small id="zpcodeHelp" class="form-text text-muted"></small>
                             </div>
                             </div>
                             <div class="form-group checkout-2-position">
                              <label for="" class="checkout-2-shipaddress-input-label"> @lang('website.Phone')</label>
                               <input type="text" class="form-control checkout-2-shipaddress-input same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_phone" name="billing_phone" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_phone}}@endif" aria-describedby="numberHelp" placeholder="Enter Your Phone Number">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                             </div>
                            </div>
                             <div class="form-row">
                             <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="same_billing_address" value="1" name="same_billing_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) checked @endif @else checked  @endif > @lang('website.Same shipping and billing address')
                                     <small id="checkboxHelp" class="form-text text-muted"></small>
                                   </div>
                             </div>
                             </div>


                             <div class="checkout-2-shipping-btn-outer">
                <div>
                  <button type="submit" value="no" name="continue" class="hide-load-time-btn btn swipe-to-top btn-secondary checkout-2-shipping-con-btn">
                    <span class="checkout-2-shipping-btn-span">Continue to shipping</span>
                  </button>
                </div>
                <div>
                  <a class="checkout-2-shipping-a" href="{{ URL::to('/viewcart')}}">
                    <span class="checkout-2-shipping-a-1">
                      <div class="checkout-2-shipping-a-2">
                        <div class="checkout-2-shipping-a-3">
                          <span class="checkout-2-shipping-a-4">
                            <svg viewBox="0 0 10 10" class="checkout-2-shipping-a-5" focusable="false" aria-hidden="true">
                              <path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4"></path>
                            </svg>
                          </span>
                          <span class="checkout-2-shipping-a-span">Return to cart</span>
                        </div>
                      </div>
                    </span>
                  </a>
                </div>
              </div>
                            <!--  <div class="form-row">
                              <div class="form-group">
                               <button type="submit"  class="hide-load-time-btn btn swipe-to-top btn-secondary"><span>@lang('website.Continue')</span></button>
                              </div>
                             </div> -->
                       </form>
                 </div>
                 <div class="tab-pane fade  @if(session('step') == 2) show active @endif" id="pills-method" role="tabpanel" aria-labelledby="pills-method-tab">

        <section class="checkout-2-info-outer">
          <div class="checkout-2-info-inner">
            <h2 class="checkout-2-info-title">Contact information</h2>
            <div class="checkout-2-info-img-outer">
              <div class="checkout-2-info-img-inner">
                <div class="checkout-2-info-img-outer-circle">
                  <div class="checkout-2-info-img-left">
                    <div aria-label="Avatar" role="img" class="checkout-2-img" style="background-image: url(&quot;https://cdn.shopify.com/proxy/8fd84d9684b7353bc500df5beabc5e2d8cbd58741408ee462ae60065ff6b8a2a/www.gravatar.com/avatar/56168e59f5c73859acafa16b7882b5d1.jpg?s=100&amp;d=https%3A%2F%2Fcdn.shopify.com%2Fshopifycloud%2Fshopify%2Fassets%2Fno-gravatar-new-04e7c2331218ac202e79e31be502fd5631bc96cb0206580dbcb0720ebbbd7c73_100x100.png&quot;);"></div>
                  </div>
                  <div class="checkout-2-info-img-right">
                    <span class="checkout-2-info-img-title">{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}} ({{auth()->guard('customer')->user()->email}})</span>
                    <div class="checkout-2-info-logout-outer">
                      <div class="checkout-2-info-logout-inner">
                        <a class="checkout-2-info-logout-a"  href="{{ URL::to('/logout')}}">Log out</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div>
           
          </div>
        </div>
      </div>
    </section>

                             <div class="col-12 col-sm-12 ">
                                <div class="row"> <p>@lang('website.Please select a prefered shipping method to use on this order')</p></div>
                             </div>

                             <form name="shipping_mehtods" method="post" id="shipping_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/checkout_payment_method')}}">
                              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                               @if(!empty($result['shipping_methods'])>0)
                               <input type="hidden" name="mehtod_name" id="mehtod_name">
                                    <input type="hidden" name="shipping_price" id="shipping_price">
                                    @if((float)$result['commonContent']['settings']['free_shipping_limit']*$result['currency_value'] <= session('total_price'))
                                    <div class="heading">
                                            <h2>Free Shipping</h2>
                                           
                                        </div>
                                        <div class="">
                                            <div class="checkout-2-shipmethod-new">
                                              <ul class="list"style="list-style:none; padding: 0px;margin:0;">
                                              <li>
                                                  <input class="shipping_data" id="Free Shipping" type="radio" name="shipping_method" value="freeShipping" shipping_price="0" method_name="Free Shipping" checked="">
                                                
                                                  
                                                  <label for="Free Shipping" style="margin:0;">Free Shipping <span class="checkout-2-shipmethod-new-span">   {{Session::get('symbol_left')}}0{{Session::get('symbol_right')}} </span>                                          
                                                  </label>
                                              </li>
                                              </ul>
                                            </div>
                                        </div>
                                    @else
                                     @foreach($result['shipping_methods'] as $shipping_methods)
                                        <div class="heading">
                                            <h2>{{$shipping_methods['name']}}</h2>
                                            
                                        </div>
                                        <div class="">

                                            <div class="checkout-2-shipmethod-new">
                                                @if($shipping_methods['success']==1)
                                                <ul class="list"style="list-style:none; padding: 0px;">
                                                <input type="hidden" name="shipping_km" value="0">
                                               <input type="hidden" name="shipping_weight" value="{{$shipping_methods['weight']}}">
                                                @foreach($shipping_methods['services'] as $services)
                                                     <?php
                                                         if($services['shipping_method']=='upsShipping')
                                                            $method_name=$shipping_methods['name'].'('.$services['name'].')';
                                                         else{
                                                            $method_name=$services['name'];
                                                            }
                                                        ?>

                                                        @if($services['shipping_method']== 'shippingByKM')

                                                        <input type="hidden" name="shipping_km" value="{{$services['km']}}">
                                                        <input type="hidden" name="shipping_weight" value="0">

                                                        <li>
                                                          
                                                              <input class="shipping_data" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0)
                                                              @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif
                                                              @elseif($shipping_methods['is_default']==1) checked @endif
                                                              @if($shipping_methods['is_default']==1) checked @endif
                                                              >
                                                            
                                                              
                                                              <label for="{{$method_name}}" style="margin:0;">{{$services['name']}} <span class="checkout-2-shipmethod-new-span">      {{Session::get('symbol_left')}}{{$services['rate']* session('currency_value')}}{{Session::get('symbol_right')}}  
                                                                
                                                          </span>
                                                              </label>
                                                          </li>
                                                          <li> <div class="heading" style="margin-top:15px;margin-bottom:15px;">
                                            <h2>Note :</h2>
                                            
                                        </div></li>
                                                          
                                                          <ul>
                                                          @foreach($services['getallkm'] as $km)
                                                          <li>{{$km->km_from}} KM to {{ $km->km_to }} KM = RM {{ $km->km_price }}  </li>
                                                          @endforeach
                                                          </ul>

                                                       

                                                        @else
                                                         <li>
                                                              <input class="shipping_data" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0)
                                                              @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif
                                                              @elseif($shipping_methods['is_default']==1) checked @endif
                                                              @if($shipping_methods['is_default']==1) checked @endif
                                                              >
                                                            
                                                              
                                                              <label for="{{$method_name}}" style="margin:0;">{{$services['name']}} <span class="checkout-2-shipmethod-new-span">      {{Session::get('symbol_left')}}{{$services['rate']* session('currency_value')}}{{Session::get('symbol_right')}}               </span>                                       
                                                              </label>
                                                          </li>
                                                          @endif
                                                    @endforeach
                                                    
                                                </ul>
                                                
                                                @else
                                                    <ul class="list"style="list-style:none; padding: 0px;">
                                                        <li>@lang('website.Your location does not support this') {{$shipping_methods['name']}}.</li>
                                                    
                                                    @if($shipping_methods['success']==3)
                                                    <?php  $getallkm = DB::table('products_shipping_rates_km')->where('km_status', 1)->get();?>
                                                    <li> <div class="heading" style="margin-top:15px;margin-bottom:15px;">
                                            <h2>Note :</h2>
                                            
                                        </div></li>
                                                    <ul>
                                                          @foreach($getallkm as $km)
                                                          <li>{{$km->km_from}} KM to {{ $km->km_to }} KM = RM {{ $km->km_price }}  </li>
                                                          @endforeach
                                                         
                                                          </ul>

                                                    @endif
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                @endif
                                <div class="alert alert-danger alert-dismissible error_shipping" role="alert" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @lang('website.Please select your shipping method')
                                </div>


                                <div class="checkout-2-shipping-btn-outer">
                <div>
                  <button type="submit" value="no" name="continue" class="hide-load-time-btn btn swipe-to-top btn-secondary checkout-2-shipping-con-btn">
                    <span class="checkout-2-shipping-btn-span">Continue to Payment</span>
                  </button>
                </div>
                <div>
                  <a class="checkout-2-shipping-a" href="{{ URL::to('/viewcart')}}">
                    <span class="checkout-2-shipping-a-1">
                      <div class="checkout-2-shipping-a-2">
                        <div class="checkout-2-shipping-a-3">
                          <span class="checkout-2-shipping-a-4">
                            <svg viewBox="0 0 10 10" class="checkout-2-shipping-a-5" focusable="false" aria-hidden="true">
                              <path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4"></path>
                            </svg>
                          </span>
                          <span class="checkout-2-shipping-a-span">Return to cart</span>
                        </div>
                      </div>
                    </span>
                  </a>
                </div>
              </div>

                               <!--  <div class="row">
                                  <div class="col-12 col-sm-12">
                                  <button type="submit"class="hide-load-time-btn btn swipe-to-top btn-secondary">@lang('website.Continue')</button>
                                  </div>
                                </div> -->











                              </form>

                 </div>
                 <div class="tab-pane fade @if(session('step') == 3) show active @endif" id="pills-order" role="tabpanel" aria-labelledby="pills-method-order">

                 @if(session()->has('message'))
       <div class="col-md-12">
       <div class="row">
      	<div class="alert alert-success alert-dismissible" style="width:100%;">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> {{ trans('labels.Successlabel') }}</h4>
            {{ session()->get('message') }}
        </div>
        </div>
        </div>
        @endif
        @if(session()->has('errorimage'))
        <div class="col-md-12">
      	<div class="row">
        	<div class="alert alert-warning alert-dismissible" style="width:100%;">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> {{ trans('labels.WarningLabel') }}</h4>
                {{ session()->get('errorimage') }}
            </div>
          </div>
         </div>
        @endif
         
          
                               <?php
                                   $price = 0;
                               ?>
                               <form method='POST' id="update_cart_form" action='{{ URL::to('/place_order')}}' enctype="multipart/form-data">
                                 {!! csrf_field() !!}

                                       <table class="table top-table">
                                           
                                           @foreach( $result['cart'] as $products)
                                           <?php
                                              $orignal_price = $products->final_price * session('currency_value');
                                              $price+= $orignal_price * $products->customers_basket_quantity;
                                           ?>

                                           <tbody>

                                            <tr class="d-flex">
                                              <td class="col-12 col-md-2" >
                                                <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
                                                <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-thumb">
                                                @if($products->image_path_type == 'aws')
                                                    <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}" alt="">
                                                    @else
                                                    <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}" alt="">
                                                    @endif

                                                </a>
                                              </td>
                                              <td class="col-12 col-md-5 justify-content-start">
                                                  <div class="item-detail">
                                                    <!--   <span class="pro-info">
                                                        @foreach($products->categories as $key=>$category)
                                                            {{$category->categories_name}}@if(++$key === count($products->categories)) @else, @endif
                                                        @endforeach  
                                                      </span> -->
                                                      <h5 class="checkout-2-pro-title">
                                                          
                                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                                                          {{$products->products_name}}
                                                        </a>
                                                       
                                                      </h5>
                                                      
                                                      <!-- <div class="item-attributes">
                                                        @if(isset($products->attributes))
                                                          @foreach($products->attributes as $attributes)
                                                            <small>{{$attributes->attribute_name}} : {{$attributes->attribute_value}}</small>
                                                          @endforeach
                                                        @endif
                                                      </div> -->
                                                    </div>
                                                </td>
                                                <?php                                                      
                                                    $orignal_price = $products->final_price * session('currency_value');
                                                ?>
                                              <td class="item-price col-12 col-md-2"><span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span></td>
                                              <td class="col-12 col-md-1">
                                                  <div class="input-group item-quantity">                                                      
                                                    <input type="text" id="quantity" readonly name="quantity" class="form-control input-number" value="{{$products->customers_basket_quantity}}">                    
                                                  </div>
                                              </td>
                                              <td class="align-middle item-total col-12 col-md-2 ">{{Session::get('symbol_left')}}{{$orignal_price*$products->customers_basket_quantity}}{{Session::get('symbol_right')}}</td>
                                            </tr>

                                           </tbody>
                                           @endforeach
                                       </table>
                                                   <?php
                                                      if(!empty(session('coupon_discount'))){
                                                        $coupon_amount = session('currency_value') * session('coupon_discount');  
                                                      }else{
                                                        $coupon_amount = 0;
                                                      }

                                                      if(!empty(session('points_discount'))){
                                                        $points_amount = session('currency_value') * session('points_discount');
                                                      }else{
                                                          $points_amount =0;
                                                      }


                                                      if(!empty(session('tax_rate'))){
                                                        $tax_rate = session('tax_rate');  
                                                      }else{
                                                        $tax_rate = 0;
                                                      }

                                                       if(!empty(session('shipping_detail')) and !empty(session('shipping_detail'))>0){
                                                        $shipping_price = session('shipping_detail')->shipping_price*session('currency_value');
                                                           $shipping_name = session('shipping_detail')->mehtod_name;
                                                       }else{
                                                           $shipping_price = 0;
                                                           $shipping_name = '';
                                                       }

                                                      // dd($price,$tax_rate,$shipping_price);
                                                       $tax_rate = number_format((float)$tax_rate, 2, '.', '');

                                                       $coupon_discount = number_format((float)$coupon_amount, 2, '.', '');

                                                       $points_discount = number_format((float)$points_amount, 2, '.', '');

                                                       //$total_price = ($price+$tax_rate+($shipping_price*session('currency_value')))-$coupon_discount;
                                                       $total_price = ($price+$tax_rate+$shipping_price)-$coupon_discount-$points_discount;
                                                       session(['total_price'=>($total_price)]);

                                                    ?>

@foreach( $result['cart'] as $products)
  @if($products->button_type == 3)
    <div class="col-12 col-sm-12">
        <div class="row">
            <h4>Upload Prescription</h4>
          
          <div class="form-group" style="width:100%; padding:0;">
            <label>Please upload your prescrption below</label>
              <input type="file" name="pres_image[]" multiple  class="form-control" id="files"></input>
            </div>
        </div>
    </div>
  @endif
@endforeach
<span style="color:red" id="preresponse"></span>

<br>
                               </form>

                               <div class="col-12 col-sm-12">
                                    <div class="row">
                                        <div class="heading">
                                            <h4>@lang('website.orderNotesandSummary')</h4>
                                            
                                          </div>
                                      
                                      <div class="form-group" style="width:100%; padding:0;">
                                        <label for="exampleFormControlTextarea1">@lang('website.Please write notes of your order')</label>
                                        {{-- id="exampleFormControlTextarea1" --}}
                                          <textarea name="comments"   class="form-control" id="order_comments" rows="3">@if(!empty(session('order_comments'))){{session('order_comments')}}@endif</textarea>
                                        </div>
                                    </div>
                                      
                                </div>

                                   <div class="col-12 col-sm-12 mb-3">
                                       <div class="row">
                                         <div class="heading" style="width:100%;">
                                           <h2>@lang('website.Payment Methods')</h2>
                                           <hr>
                                         </div>

                                         <div class="alert alert-danger error_payment" style="display:none" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            @lang('website.Please select your payment method')
                                         </div>

                                         
                                         <form name="shipping_mehtods" method="post" id="payment_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/order_detail')}}" style="width:100%;" >
                                          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                      
                                         <div class="form-group" style="width:100%; padding:0;">
                                          <label for="exampleFormControlTextarea1" style="width:100%; margin-bottom:30px;">@lang('website.Please select a prefered payment method to use on this order')</label>
                                          <input id="payment_currency" type="hidden" onClick="paymentMethods();" name="payment_currency" value="{{session('currency_code')}}">
                                          @foreach($result['payment_methods'] as $payment_methods)
                                          
                                            @if($payment_methods['active']==1)
                                                
                                              @if($payment_methods['payment_method']=='braintree')

                                                  <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                  <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">
                                          
                                          
                                                <div class="form-check form-check-inline">
                                                    <input id="{{$payment_methods['payment_method']}}_label" type="radio" onClick="paymentMethods();" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                    <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label"><img src="{{asset('web/images/miscellaneous').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}"></label>
                                                </div>
                                              @else
                                              
                                                  <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                  <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">

                                                 @if($payment_methods['payment_method']=='PremierPay')

                    <input id="{{$payment_methods['payment_method']}}_store_id" type="hidden" name="store_id" value="{{$payment_methods['store_id']}}">

                    <input id="{{$payment_methods['payment_method']}}_store_key" type="hidden" name="store_key" value="{{$payment_methods['store_key']}}">

                    <input id="{{$payment_methods['payment_method']}}_redirect_url" type="hidden" name="redirect_url" value="{{$payment_methods['redirect_url']}}">

                    <input id="{{$payment_methods['payment_method']}}_callback_url" type="hidden" name="callback_url" value="{{$payment_methods['callback_url']}}">

                    @endif
                                                
                                                  
                                                  <div class="form-check form-check-inline" style="height:100%;">
                                                    <input onClick="paymentMethods();" id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                    <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label">
                                                      @if(file_exists( 'web/images/miscellaneous/'.$payment_methods['payment_method'].'.png'))
                                                        <img width="100px" src="{{asset('web/images/miscellaneous/').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}">
                                                      @else
                                                      {{$payment_methods['name']}}
                                                      @endif
                                                    </label>
                                                  </div>
                                              @endif  
                                            @endif

                                          @endforeach 
                                                                                 
                                        </div>
                                         </form>
                                          
                                           <div class="button mobile-align-check-btn">
                                            @foreach($result['payment_methods'] as $payment_methods)
                                          
                                              @if($payment_methods['active']==1 and $payment_methods['payment_method']=='banktransfer')
                                              <div class="alert alert-info alert-dismissible" id="payment_description" role="alert" style="display: none">
                                              <span>{{$payment_methods['descriptions']}}</span>
                                              </div>
                                              @endif

                                            @endforeach

                                                <!--- paypal -->
                                                <div id="paypal_button" class="payment_btns" style="display: none"></div>

                                                <button id="braintree_button" style="display: none" class="btn btn-dark payment_btns" data-toggle="modal" data-target="#braintreeModel" >@lang('website.Order Now')</button>
                                                <input type="hidden" id="hide_pay_btn_new" value="0">
                                                <button id="stripe_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#stripeModel" >@lang('website.Order Now')</button>

                                                <button id="cash_on_delivery_button" class="btn btn-dark payment_btns btn_disables" style="display: none">@lang('website.Order Now')</button>
                                                <button id="wallet_button" class="btn btn-dark payment_btns btn_disables" style="display: none">@lang('website.Order Now')</button>
                                                <button id="razor_pay_button" class="razorpay-payment-button btn btn-dark payment_btns"  style="display: none"  type="button">@lang('website.Order Now')</button>
                                                <a href="{{ URL::to('/store_paytm')}}" id="pay_tm_button" class="btn btn-dark payment_btns btn_disable"  style="display: none"  type="button">@lang('website.Order Now')</a>

                                                <button id="instamojo_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#instamojoModel">@lang('website.Order Now')</button>

                                                <a href="{{ URL::to('/checkout/hyperpay')}}" id="hyperpay_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</a>

                                                <button id="banktransfer_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>
                                                <button id="paystack_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

                                                <button id="midtrans_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

                                                 <a href="{{ URL::to('/checkout/ipay88')}}" id="ipay88_button" class="btn btn-dark payment_btns btn_disable" style="display: none">@lang('website.Order Now')</a>

                                                 <a href="{{ URL::to('/checkout/paynetfpx')}}" id="paynet_fpx_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</a>

                                              
                                                 <a href="{{ URL::to('/checkout/premierpay')}}" id="PremierPay_button" class="btn btn-dark payment_btns btn_disable" style="display: none">@lang('website.Order Now')</a>

                                                <input type="hidden" id="midtransToken" value="">
                                                {{-- payment error content show --}}
                                                <div class="alert alert-danger alert-dismissible" id="payment_error" role="alert" style="display: none">
                                                  <span class="sr-only">@lang('website.Error'):</span>
                                                    <span id="payment_error-error-text"></span>
                                                </div>

                                              </div>
                                       </div>
                                       <!-- The braintree Modal -->
                                       <div class="modal fade" id="braintreeModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="checkout" method="post" action="{{ URL::to('/place_order')}}">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                   <!-- Modal Header -->
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">@lang('website.BrainTree Payment')</h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                   <div class="modal-body">
                                                         <div id="payment-form"></div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="submit" class="btn btn-dark">@lang('website.Pay') {{ Session::get('symbol_left') }} {{ number_format( (float)$total_price+0, 2, '.', '') }} {{ Session::get('symbol_right') }}</button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                       <!-- The instamojo Modal -->
                                       <div class="modal fade" id="instamojoModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="instamojo_form" method="post" action="">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                 <input type="hidden" name="amount" value="{{number_format((float)$total_price+0, 2, '.', '')}}">
                                                   <!-- Modal Header -->
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">@lang('website.Instamojo Payment')</h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                  <div class="modal-body">
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Full Name')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="firstName" id="firstName" placeholder="@lang('website.Full Name')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your full name')</span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Email')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="email_id" id="email_id" placeholder="@lang('website.Email')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your email address')</span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Phone Number')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="phone_number" id="insta_phone_number" placeholder="@lang('website.Phone Number')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                                    								 </div>
                                    								</div>                                                       

                                                       <div class="alert alert-danger alert-dismissible" id="insta_mojo_error" role="alert" style="display: none">
                                                            <span class="sr-only">@lang('website.Error'):</span>
                                                            <span id="instamojo-error-text"></span>
                                                        </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" id="pay_instamojo" class="btn btn-dark">@lang('website.Pay') {{ Session::get('symbol_left') }} {{ number_format( (float)$total_price+0, 2, '.', '') }} {{ Session::get('symbol_right') }}</button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                       <!-- The stripe Modal -->
                                       <div class="modal fade" id="stripeModel">
                                           <div class="modal-dialog">
                                               <div class="modal-content">

                                               <main>
                                               <div class="container-lg">
                                                   <div class="cell example example2">
                                                       <form>
                                                         <div class="row">
                                                           <div class="field">
                                                             <div id="example2-card-number" class="input empty"></div>
                                                             <label for="example2-card-number" data-tid="elements_examples.form.card_number_label">@lang('website.Card number')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                         <div class="row">
                                                           <div class="field half-width">
                                                             <div id="example2-card-expiry" class="input empty"></div>
                                                             <label for="example2-card-expiry" data-tid="elements_examples.form.card_expiry_label">@lang('website.Expiration')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                           <div class="field half-width">
                                                             <div id="example2-card-cvc" class="input empty"></div>
                                                             <label for="example2-card-cvc" data-tid="elements_examples.form.card_cvc_label">@lang('website.CVC')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                       <button type="submit" class="btn btn-dark" data-tid="elements_examples.form.pay_button">@lang('website.Pay') {{$web_setting[19]->value}}{{number_format((float)$total_price+0, 2, '.', '')}}</button>

                                                         <div class="error" role="alert"><svg xmlns="https://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                                             <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                                             <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                                           </svg>
                                                           <span class="message"></span></div>
                                                       </form>
                                                                   <div class="success">
                                                                     <div class="icon">
                                                                       <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                                                         <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                                                                         <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                                                                       </svg>
                                                                     </div>
                                                                     <h3 class="title" data-tid="elements_examples.success.title">@lang('website.Payment successful')</h3>
                                                                     <p class="message"><span data-tid="elements_examples.success.message">@lang('website.Thanks You Your payment has been processed successfully')</p>
                                                                   </div>

                                                               </div>
                                                           </div>
                                                       </main>
                                                   </div>
                                             </div>
                                         </div>

                                   </div>

                 </div>
               </div>
         </div>
         </div>

  <div class="checkout-2-right-side"> 
  <section class="checkout-2-right-section-outer">

  <table class="table top-table checkout-2-table" style="border-bottom: solid 1px #ddd;">
                                           
                                           @foreach( $result['cart'] as $products)
                                        

                                           <tbody>

                                            <tr class="d-flex d-flex-new">
                                              <td class="" style="padding: 0 !important;">
                                                <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
                                                <div class="checkout-2-tumb-img-outer">
                                                <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-thumb">
                                              
                                                    <img class="checkout-2-tumb-img" src="{{asset($products->image_path)}}" alt="{{$products->products_name}}" alt="">
                                                  

                                                </a>
                                                <div class="checkout-2-round-qty">{{$products->customers_basket_quantity}}
                                                      </div>
                                                </div>
                                              </td>
                                              <td class="" style="padding: 0 10px 10px 10px !important;">
                                                  <div class="item-detail">
                                                    <!--   <span class="pro-info">
                                                        @foreach($products->categories as $key=>$category)
                                                            {{$category->categories_name}}@if(++$key === count($products->categories)) @else, @endif
                                                        @endforeach 
                                                      </span> -->
                                                      <h5 class="checkout-2-pro-title">
                                                          
                                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                                                          {{$products->products_name}}
                                                        </a>
                                                       
                                                      </h5>
                                                      
                                                     <!--  <div class="item-attributes">
                                                        @if(isset($products->attributes))
                                                          @foreach($products->attributes as $attributes)
                                                            <small>{{$attributes->attribute_name}} : {{$attributes->attribute_value}}</small>
                                                          @endforeach
                                                        @endif
                                                      </div> -->
                                                    </div>
                                                </td>
                                                <?php                                                      
                                                    $orignal_price = $products->final_price * session('currency_value');
                                                ?>
                                              <td class="item-price" style="padding: 0 10px 10px 10px !important;"><span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span></td>
                                              <!-- <td class="col-12 col-md-1">
                                                  <div class="input-group item-quantity">                                                      
                                                    <input type="text" id="quantity" readonly name="quantity" class="form-control input-number" value="{{$products->customers_basket_quantity}}">                    
                                                  </div>
                                              </td>
                                              <td class="align-middle item-total col-12 col-md-2 ">{{Session::get('symbol_left')}}{{$orignal_price*$products->customers_basket_quantity}}{{Session::get('symbol_right')}}</td> -->
                                            </tr>

                                           </tbody>
                                           @endforeach
                                       </table>


                                       @if(!empty(session('coupon')))
              <div class="form-group">
                    @foreach(session('coupon') as $coupons_show)

                        <div class="alert alert-success">
                            <a href="{{ URL::to('/removeCoupon/'.$coupons_show->coupans_id)}}" class="close"><span aria-hidden="true">&times;</span></a>
                          @lang('website.Coupon Applied') {{$coupons_show->code}}.@lang('website.If you do note want to apply this coupon just click cross button of this alert.')
                        </div>

                    @endforeach
                </div>
            @endif
            @if(!empty(session('transaction_id')) && $result['commonContent']['settings']['voucher_redeem']=='1')
              <div class="form-group">
                <div class="alert alert-success">
                  <a href="{{ URL::to('/removeLoyalty/'.session('transaction_id'))}}" class="close"><span aria-hidden="true">&times;</span></a>
                  @lang('website.Redeem has been applied successfully') {{session('points_discount')}}.@lang('website.If you do note want to apply this coupon just click cross button of this alert.')
                </div>
              </div>
            @elseif(!empty(session('transaction_id'))) 
              <div class="form-group">
                <div class="alert alert-success">
                <a href="{{ URL::to('/removeactivateredeem/'.session('transaction_id'))}}" class="close"><span aria-hidden="true">&times;</span></a>
                  @lang('website.Redeem has been applied successfully') {{session('points_discount')}}.@lang('website.If you do note want to apply this coupon just click cross button of this alert.')
                </div>
              </div>
            @endif
            <div class="col-12 col-lg-12 mb-4">
              <div class="row justify-content-between click-btn">
              @if($result['commonContent']['settings']['Loyalty']=='1')
                <div class="col-12 col-lg-12" style="border-bottom: solid 1px #ddd;">
                  <form id="apply_coupon" class="form-validate" style="margin-bottom:20px;">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="coupon_code" class="form-control checkout-2-coupon-input demo-35-input-val" id="coupon_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="coupon-code" style="height:100%;">

                            <div class="demo-35-apply-active">
                              <button class="btn btn-secondary swipe-to-top checkout-2-coupon-apply-btn" type="submit" id="coupon-code" style="height:100%;">@lang('website.APPLY')</button>
                            </div>
                           
                            <div class="demo-35-apply-inactive">
                              <span class="btn btn-disabled-new swipe-to-top checkout-2-coupon-apply-btn" id="coupon-code" style="height:100%;">@lang('website.APPLY')</span>
                            </div>
                        </div>
                        <div id="coupon_error" class="help-block" style="display: none;color:red;"></div>
                        <div  id="coupon_require_error" class="help-block" style="display: none;color:red;">@lang('website.Please enter a valid coupon code')</div>
                    </div>
                 </form>
                </div>
                @endif

                                       <table class="table checkout-2-table-2">
       
        <tbody>
          <tr>
            <th scope="row">@lang('website.SubTotal')</th>
            <td align="right">{{Session::get('symbol_left')}}{{$price+0}}{{Session::get('symbol_right')}}</td>

          </tr>
           @if($result['commonContent']['settings']['Loyalty']=='1')
          <tr>
          <th scope="row">@lang('website.Discount(Promo Code)')</th>
            <td align="right">{{Session::get('symbol_left')}}{{number_format((float)$coupon_discount, 2, '.', '')+0}}{{Session::get('symbol_right')}}</td>

          </tr>
          <tr>
          <th scope="row">@lang('website.Discount(Voucher)')</th>
            <td align="right">{{Session::get('symbol_left')}}{{number_format((float)$points_discount, 2, '.', '')+0}}{{Session::get('symbol_right')}}</td>

          </tr>
          @endif
          <tr>
              <th scope="row">@lang('website.Tax')</th>
              <td align="right">{{Session::get('symbol_left')}}{{$tax_rate}}{{Session::get('symbol_right')}}</td>

            </tr>
            <tr>
                <th scope="row">@lang('website.Shipping Cost')</th>
                <td align="right">{{Session::get('symbol_left')}}{{$shipping_price}}{{Session::get('symbol_right')}}</td>

              </tr>
          <tr class="item-price checkout2-total-price-tb" >
            <th scope="row">@lang('website.Total')</th>
            <td align="right" style="font-size:20px;">{{ Session::get('symbol_left') }} {{ number_format( (float)$total_price, 2, '.', '')  }} {{Session::get('symbol_right')}}</td>

            <input type="hidden" name="total_order_price" id="totalresultorder" value="{{ number_format( (float)$total_price, 2, '.', '')  }}">

          </tr>
      
        </tbody>
        
      </table>


  </section>
 <!--  <table class="table right-table">
        <thead>
          <tr>
            <th scope="col" colspan="2" align="center">@lang('website.Order Summary')</th>                    
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">@lang('website.SubTotal')</th>
            <td align="right">{{Session::get('symbol_left')}}{{$price+0}}{{Session::get('symbol_right')}}</td>

          </tr>
           @if($result['commonContent']['settings']['Loyalty']=='1')
          <tr>
          <th scope="row">@lang('website.Discount(Promo Code)')</th>
            <td align="right">{{Session::get('symbol_left')}}{{number_format((float)$coupon_discount, 2, '.', '')+0}}{{Session::get('symbol_right')}}</td>

          </tr>
          <tr>
          <th scope="row">@lang('website.Discount(Voucher)')</th>
            <td align="right">{{Session::get('symbol_left')}}{{number_format((float)$points_discount, 2, '.', '')+0}}{{Session::get('symbol_right')}}</td>

          </tr>
          @endif
          <tr>
              <th scope="row">@lang('website.Tax')</th>
              <td align="right">{{Session::get('symbol_left')}}{{$tax_rate}}{{Session::get('symbol_right')}}</td>

            </tr>
            <tr>
                <th scope="row">@lang('website.Shipping Cost')</th>
                <td align="right">{{Session::get('symbol_left')}}{{$shipping_price}}{{Session::get('symbol_right')}}</td>

              </tr>
          <tr class="item-price">
            <th scope="row">@lang('website.Total')</th>
            <td align="right" >{{ Session::get('symbol_left') }} {{ number_format( (float)$total_price, 2, '.', '')  }} {{Session::get('symbol_right')}}</td>

            <input type="hidden" name="total_order_price" id="totalresultorder" value="{{ number_format( (float)$total_price, 2, '.', '')  }}">

          </tr>
      
        </tbody>
        
      </table> -->
  </div>
   </div>
</div>








<!-- <div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('website.Checkout')</a></li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">
                @if(session('step')==0)
                      @lang('website.Shipping Address')
                    @elseif(session('step')==1)
                      @lang('website.Billing Address')
                    @elseif(session('step')==2)
                      @lang('website.Shipping Methods')
                    @elseif(session('step')==3)
                      @lang('website.Order Detail')
                    @endif
              </a>
            </li>
          </ol>
      </div>
    </nav>
</div>  -->









<!-- <section class="pro-content">

  <div class="container">
    <div class="page-heading-title">
      <h2> @lang('website.Checkout') </h2>

      </div>
  </div>
 
 <section class="checkout-area">
 <div class="container">
   <div class="row">
     
     <div class="col-12 col-xl-9 checkout-left">
       <input type="hidden" id="hyperpayresponse" value="@if(!empty(session('paymentResponse'))) @if(session('paymentResponse')=='success') {{session('paymentResponse')}} @else {{session('paymentResponse')}}  @endif @endif">
       
       <div class="alert alert-danger alert-dismissible" id="paymentError" role="alert" style="display:none;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           @if(!empty(session('paymentResponse')) and session('paymentResponse')=='error') {{session('paymentResponseData') }} @endif
       </div>
         <div class="row">
           <div class="checkout-module">
             <ul class="nav nav-pills mb-3 checkoutd-nav d-none d-lg-flex" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0)  @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">
                    <span class="d-flex d-lg-none">1</span>
                    <span class="d-none d-lg-flex">@lang('website.Shipping Address')</span></a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >@lang('website.Billing Address')</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2)  @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif> @lang('website.Shipping Methods')</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>@lang('website.Order Detail')</a>
                   </li>
               </ul>
               <ul class="nav nav-pills mb-3 checkoutd-nav d-flex d-lg-none" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">1</a>
                 </li>
                 <li class="nav-item second">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >2</a>
                 </li>
                 <li class="nav-item third">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif>3</a>
                 </li>
                 <li class="nav-item fourth">
                   <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) active-check @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>4</a>
                   </li>
               </ul>
               @if(Session::has('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="">@lang('website.Error'):</span>
									{!! session('error') !!}

									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
					@endif
               <div class="tab-content" id="pills-tabContent">
                 <div class="tab-pane fade @if(session('step') == 0) show active @endif" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                   <div class="form-group">
                        <label for=""> @lang('website.Shipping_Address')</label>
                        {{-- <div class="input-group select-control row"> --}}
                            <select class="form-control" id="default_address_id" onChange="getDefaultaddress();" name="default_address_id" aria-describedby="countryHelp">
                              <option value="" selected>@lang('website.Select_Shipping')</option>
                              @if(!empty($result['address']))
                                @foreach($result['address'] as $address)
                                    <option value="{{$address->address_id}}" @if(!empty($result['default'])) @if($result['default']->address_id == $address->address_id) selected @endif @endif >{{$address->lastname}}.{{$address->firstname}}({{$address->street}})</option>
                                @endforeach
                              @endif
                              </select>
                       {{--  </div> --}}
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your shipping address')</span>
                      </div>
                   <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/checkout_shipping_address')}}" method="post">
                     <input type="hidden" required name="_token" id="csrf-token" value="{{ Session::token() }}" />
                     <input type="hidden" required name="address_book_id" id="address_book_id" value="@if(!empty($result['default']->address_id)){{$result['default']->address_id}}@endif" />
                     <div class="form-row">
                      <div class="form-group">
                        <label for=""> @lang('website.First Name') <span style="color:red;">*</span></label>
                        <input type="text"  required class="form-control field-validate" id="firstname" name="firstname" value="@if(!empty($result['default']->firstname)){{$result['default']->firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                      </div>
                      <div class="form-group">
                        <label for=""> @lang('website.Last Name') <span style="color:red;">*</span></label>
                        <input type="text" required class="form-control field-validate" id="lastname" name="lastname" value="@if(!empty($result['default'])){{$result['default']->lastname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Last Name">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                      </div>
                      
                      <?php if(Session::get('guest_checkout') == 1){ ?>
                      <div class="form-group">
                        <label for=""> @lang('website.Email')</label>
                        <input type="text" required class="form-control field-validate" id="email" name="email" value="@if(!empty(session('shipping_address'))){{session('shipping_address')->email}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Email">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your email')</span>
                      </div>
                      <?php } ?>
                      <div class="form-group">
                        <label for=""> @lang('website.Company')</label>
                        <input type="text" class="form-control" id="company" aria-describedby="companyHelp" placeholder="Enter Your Company Name" name="company" value="@if(!empty($result['default'])){{$result['default']->company}}@endif">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                      </div>
                      <?php if($result['commonContent']['settings']['is_enable_location'] == 1){ ?>
                      <div class="form-group">
                        <label for=""> @lang('website.Location') <span style="color:red;">*</span></label>
                        <input type="text" required class="form-control field-validate" data-toggle="modal" data-target="#mapModal" name="location" id="location" aria-describedby="addressHelp" placeholder="@lang('website.Please enter your location or click here to open map')" value="@if( !empty(session('shipping_address'))  && isset (session('shipping_address')->location) ) {{session('shipping_address')->location}}@endif">
                       
                      </div>
                      <?php }?>
                      <input type="hidden" name="latitude" id="latitude" value="@if(!empty(session('shipping_address')) && isset(session('shipping_address')->latitude) ) {{session('shipping_address')->latitude}}@endif">
                      <input type="hidden" name="longitude" id="longitude" value="@if(!empty(session('shipping_address')) && isset(session('shipping_address')->longitude)  ) {{session('shipping_address')->longitude}}@endif">
                      <div class="form-group">
                        <label for=""> @lang('website.Address') <span style="color:red;">*</span></label>
                        <input type="text" required class="form-control field-validate" name="street" id="street" aria-describedby="addressHelp" placeholder="@lang('website.Please enter your address')" value="@if(!empty($result['default'])){{$result['default']->street}}@endif">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                      </div>
                      
                     
                     
                      <div class="form-group">
                        <label for=""> @lang('website.Country') <span style="color:red;">*</span></label>
                        <div class="input-group select-control">
                            <select required class="form-control field-validate" id="entry_country_id" onChange="getZones();" name="countries_id" aria-describedby="countryHelp">
                              <option value="" selected>@lang('website.Select Country')</option>
                              @if(!empty($result['countries']))
                                @foreach($result['countries'] as $countries)
                                    <option value="{{$countries->countries_id}}" @if(!empty($result['default'])) @if($result['default']->countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                                @endforeach
                              @endif
                              </select>
                        </div>
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                      </div>
                      <div class="form-group">
                        <label for=""> @lang('website.State')</label>
                        <div class="input-group select-control">
                            <select required class="form-control field-validate" id="entry_zone_id"  name="zone_id" aria-describedby="stateHelp">
                              <option value="">@lang('website.Select State') <span style="color:red;">*</span></option>
                                @if(!empty($result['zones']))
                                @foreach($result['zones'] as $zones)
                                    <option value="{{$zones->zone_id}}" @if(!empty($result['default'])) @if($result['default']->zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                                @endforeach
                              @endif

                                <option value="-1" @if(!empty(session('shipping_address'))) @if(session('shipping_address')->zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                              </select>
                        </div>
                          <small id="stateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                          <label for=""> @lang('website.City') <span style="color:red;">*</span></label>
                            <input required type="text" class="form-control field-validate" id="city" name="city" value="@if(!empty($result['default'])){{$result['default']->city}}@endif" placeholder="Enter Your City">
                            <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                        </div>
                        <div class="form-group">
                          <label for=""> @lang('website.Zip/Postal Code')</label>
                          <input required type="number" class="form-control" id="postcode" aria-describedby="zpcodeHelp" placeholder="@lang('website.Enter Your Zip / Postal Code')" name="postcode" value="@if(!empty($result['default'])){{$result['default']->postcode}}@endif">
                          <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your Zip/Postal Code')</span>
                        </div>
                        <div class="form-group">
                          <label for=""> @lang('website.Phone')</label>
                          <input required type="text" class="form-control" id="delivery_phone" aria-describedby="numberHelp" placeholder="@lang('website.Enter Your Phone Number')" name="delivery_phone" value="@if(!empty($result['default'])){{$result['default']->entry_phone}}@endif">
                          <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                        </div>
                                                
                      </div>
                      <div class="form-row">
                        <div class="form-group">
                          <button type="submit" value="no" name="continue" class="hide-load-time-btn btn swipe-to-top btn-secondary">@lang('website.Continue')</button>
                          <button type="submit" value="yes" name="save" class="hide-load-time-btn btn swipe-to-top btn-secondary">@lang('website.Save_Continue')</button>
                        </div>
                      </div>
                   </form>
                 </div>
                 <div class="tab-pane fade @if(session('step') == 1) show active @endif"  id="pills-billing" role="tabpanel" aria-labelledby="pills-billing-tab">
                     <form name="signup" enctype="multipart/form-data" action="{{ URL::to('/checkout_billing_address')}}" method="post">
                       <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                       <div class="form-row">
                         <div class="form-group">
                            <label for=""> @lang('website.First Name')</label>
                             <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_firstname" name="billing_firstname" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                           </div>
                           <div class="form-group">
                            <label for=""> @lang('website.Last Name')</label>
                             <input type="text" class="form-control same_address" id="exampleInputName2" aria-describedby="NameHelp2" placeholder="Enter Your Name" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_lastname" name="billing_lastname" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_lastname}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                           </div>

                           <div class="form-group">
                            <label for=""> @lang('website.Company')</label>
                             <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_company" name="billing_company" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_company}}@endif" id="exampleInputCompany1" aria-describedby="companyHelp" placeholder="Enter Your Company Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                           </div>

                           <div class="form-group">
                            <label for=""> @lang('website.Address')</label>
                             <input type="text" class="form-control same_address" id="exampleInputAddress1" aria-describedby="addressHelp" placeholder="Enter Your Address" @if(!empty(session('22'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_street" name="billing_street" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_street}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                           </div>
                           <div class="form-group">
                            <label for=""> @lang('website.Country')</label>
                             <div class="input-group select-control">
                                 <select required class="form-control same_address_select" id="billing_countries_id" aria-describedby="countryHelp" onChange="getBillingZones();" name="billing_countries_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif>
                                   <option value=""  >@lang('website.Select Country')</option>
                                   @if(!empty($result['countries']))
                                     @foreach($result['countries'] as $countries)
                                         <option value="{{$countries->countries_id}}" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                                     @endforeach
                                   @endif
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                           </div>
                           <div class="form-group">
                            <label for=""> @lang('website.State')</label>
                             <div class="input-group select-control">
                                 <select required class="form-control same_address_select" name="billing_zone_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif id="billing_zone_id" aria-describedby="stateHelp">
                                   <option value="" >@lang('website.Select State')</option>
                                   @if(!empty($result['zones']))
                                     @foreach($result['zones'] as $key=>$zones)
                                         <option value="{{$zones->zone_id}}" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                                     @endforeach
                                   @endif
                                     <option value="-1" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden>@lang('website.Please select your state')</span>
                           </div>
                           <div class="form-group">
                            <label for=""> @lang('website.City')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_city" name="billing_city" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_city}}@endif" placeholder="Enter Your City">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                           </div>
                             <div class="form-group">
                              <label for=""> @lang('website.Zip/Postal Code')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_zip" name="billing_zip" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_zip}}@endif" aria-describedby="zpcodeHelp" placeholder="Enter Your Zip / Postal Code">
                               <small id="zpcodeHelp" class="form-text text-muted"></small>
                             </div>
                             <div class="form-group">
                              <label for=""> @lang('website.Phone')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_phone" name="billing_phone" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_phone}}@endif" aria-describedby="numberHelp" placeholder="Enter Your Phone Number">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                             </div>
                            </div>
                             <div class="form-row">
                             <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="same_billing_address" value="1" name="same_billing_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) checked @endif @else checked  @endif > @lang('website.Same shipping and billing address')
                                     <small id="checkboxHelp" class="form-text text-muted"></small>
                                   </div>
                             </div>
                             </div>
                             <div class="form-row">
                              <div class="form-group">
                               <button type="submit"  class="hide-load-time-btn btn swipe-to-top btn-secondary"><span>@lang('website.Continue')</span></button>
                              </div>
                             </div>
                       </form>
                 </div>
                 <div class="tab-pane fade  @if(session('step') == 2) show active @endif" id="pills-method" role="tabpanel" aria-labelledby="pills-method-tab">

                             <div class="col-12 col-sm-12 ">
                                <div class="row"> <p>@lang('website.Please select a prefered shipping method to use on this order')</p></div>
                             </div>

                             <form name="shipping_mehtods" method="post" id="shipping_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/checkout_payment_method')}}">
                              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                               @if(!empty($result['shipping_methods'])>0)
                               <input type="hidden" name="mehtod_name" id="mehtod_name">
                                    <input type="hidden" name="shipping_price" id="shipping_price">
                                    @if((float)$result['commonContent']['settings']['free_shipping_limit']*$result['currency_value'] <= session('total_price'))
                                    <div class="heading">
                                            <h2>Free Shipping</h2>
                                            <hr>
                                        </div>
                                        <div class="form-check">
                                            <div class="form-row">
                                              <ul class="list"style="list-style:none; padding: 0px;">
                                              <li>
                                                  <input class="shipping_data" id="Free Shipping" type="radio" name="shipping_method" value="freeShipping" shipping_price="0" method_name="Free Shipping" checked="">
                                                
                                                  
                                                  <label for="Free Shipping">Free Shipping ---    {{Session::get('symbol_left')}}0{{Session::get('symbol_right')}}                                               
                                                  </label>
                                              </li>
                                              </ul>
                                            </div>
                                        </div>
                                    @else
                                     @foreach($result['shipping_methods'] as $shipping_methods)
                                        <div class="heading">
                                            <h2>{{$shipping_methods['name']}}</h2>
                                            <hr>
                                        </div>
                                        <div class="form-check">

                                            <div class="form-row">
                                                @if($shipping_methods['success']==1)
                                                <ul class="list"style="list-style:none; padding: 0px;">
                                                <input type="hidden" name="shipping_km" value="0">
                                               <input type="hidden" name="shipping_weight" value="{{$shipping_methods['weight']}}">
                                                @foreach($shipping_methods['services'] as $services)
                                                     <?php
                                                         if($services['shipping_method']=='upsShipping')
                                                            $method_name=$shipping_methods['name'].'('.$services['name'].')';
                                                         else{
                                                            $method_name=$services['name'];
                                                            }
                                                        ?>

                                                        @if($services['shipping_method']== 'shippingByKM')

                                                        <input type="hidden" name="shipping_km" value="{{$services['km']}}">
                                                        <input type="hidden" name="shipping_weight" value="0">

                                                        <li>
                                                          
                                                              <input class="shipping_data" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0)
                                                              @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif
                                                              @elseif($shipping_methods['is_default']==1) checked @endif
                                                              @if($shipping_methods['is_default']==1) checked @endif
                                                              >
                                                            
                                                              
                                                              <label for="{{$method_name}}">{{$services['name']}} ---    {{Session::get('symbol_left')}}{{$services['rate']* session('currency_value')}}{{Session::get('symbol_right')}}                                                      
                                                              </label>
                                                          </li>
                                                          <li> <div class="heading" style="margin-top:15px;margin-bottom:15px;">
                                            <h2>Note :</h2>
                                            
                                        </div></li>
                                                          
                                                          <ul>
                                                          @foreach($services['getallkm'] as $km)
                                                          <li>{{$km->km_from}} KM to {{ $km->km_to }} KM = RM {{ $km->km_price }}  </li>
                                                          @endforeach
                                                          </ul>

                                                       

                                                        @else
                                                         <li>
                                                              <input class="shipping_data" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0)
                                                              @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif
                                                              @elseif($shipping_methods['is_default']==1) checked @endif
                                                              @if($shipping_methods['is_default']==1) checked @endif
                                                              >
                                                            
                                                              
                                                              <label for="{{$method_name}}">{{$services['name']}} ---    {{Session::get('symbol_left')}}{{$services['rate']* session('currency_value')}}{{Session::get('symbol_right')}}                                                      
                                                              </label>
                                                          </li>
                                                          @endif
                                                    @endforeach
                                                    
                                                </ul>
                                                
                                                @else
                                                    <ul class="list"style="list-style:none; padding: 0px;">
                                                        <li>@lang('website.Your location does not support this') {{$shipping_methods['name']}}.</li>
                                                    
                                                    @if($shipping_methods['success']==3)
                                                    <?php  $getallkm = DB::table('products_shipping_rates_km')->where('km_status', 1)->get();?>
                                                    <li> <div class="heading" style="margin-top:15px;margin-bottom:15px;">
                                            <h2>Note :</h2>
                                            
                                        </div></li>
                                                    <ul>
                                                          @foreach($getallkm as $km)
                                                          <li>{{$km->km_from}} KM to {{ $km->km_to }} KM = RM {{ $km->km_price }}  </li>
                                                          @endforeach
                                                         
                                                          </ul>

                                                    @endif
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                @endif
                                <div class="alert alert-danger alert-dismissible error_shipping" role="alert" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @lang('website.Please select your shipping method')
                                </div>

                                <div class="row">
                                  <div class="col-12 col-sm-12">
                                  <button type="submit"class="hide-load-time-btn btn swipe-to-top btn-secondary">@lang('website.Continue')</button>
                                  </div>
                                </div>
                              </form>

                 </div>
                 <div class="tab-pane fade @if(session('step') == 3) show active @endif" id="pills-order" role="tabpanel" aria-labelledby="pills-method-order">

                 @if(session()->has('message'))
       <div class="col-md-12">
       <div class="row">
      	<div class="alert alert-success alert-dismissible" style="width:100%;">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> {{ trans('labels.Successlabel') }}</h4>
            {{ session()->get('message') }}
        </div>
        </div>
        </div>
        @endif
        @if(session()->has('errorimage'))
        <div class="col-md-12">
      	<div class="row">
        	<div class="alert alert-warning alert-dismissible" style="width:100%;">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> {{ trans('labels.WarningLabel') }}</h4>
                {{ session()->get('errorimage') }}
            </div>
          </div>
         </div>
        @endif
         
          
                              
                               <form method='POST' id="update_cart_form" action='{{ URL::to('/place_order')}}' enctype="multipart/form-data">
                                 {!! csrf_field() !!}

                                       <table class="table top-table">
                                           
                                           @foreach( $result['cart'] as $products)
                                        

                                           <tbody>

                                            <tr class="d-flex">
                                              <td class="col-12 col-md-2" >
                                                <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
                                                <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-thumb">
                                                @if($products->image_path_type == 'aws')
                                                    <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}" alt="">
                                                    @else
                                                    <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}" alt="">
                                                    @endif

                                                </a>
                                              </td>
                                              <td class="col-12 col-md-5 justify-content-start">
                                                  <div class="item-detail">
                                                      <span class="pro-info">
                                                        @foreach($products->categories as $key=>$category)
                                                            {{$category->categories_name}}@if(++$key === count($products->categories)) @else, @endif
                                                        @endforeach 
                                                      </span>
                                                      <h5 class="pro-title">
                                                          
                                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                                                          {{$products->products_name}}
                                                        </a>
                                                       
                                                      </h5>
                                                      
                                                      <div class="item-attributes">
                                                        @if(isset($products->attributes))
                                                          @foreach($products->attributes as $attributes)
                                                            <small>{{$attributes->attribute_name}} : {{$attributes->attribute_value}}</small>
                                                          @endforeach
                                                        @endif
                                                      </div>
                                                    </div>
                                                </td>
                                                <?php                                                      
                                                    $orignal_price = $products->final_price * session('currency_value');
                                                ?>
                                              <td class="item-price col-12 col-md-2"><span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span></td>
                                              <td class="col-12 col-md-1">
                                                  <div class="input-group item-quantity">                                                      
                                                    <input type="text" id="quantity" readonly name="quantity" class="form-control input-number" value="{{$products->customers_basket_quantity}}">                    
                                                  </div>
                                              </td>
                                              <td class="align-middle item-total col-12 col-md-2 ">{{Session::get('symbol_left')}}{{$orignal_price*$products->customers_basket_quantity}}{{Session::get('symbol_right')}}</td>
                                            </tr>

                                           </tbody>
                                           @endforeach
                                       </table>
                                                   <?php
                                                      if(!empty(session('coupon_discount'))){
                                                        $coupon_amount = session('currency_value') * session('coupon_discount');  
                                                      }else{
                                                        $coupon_amount = 0;
                                                      }

                                                      if(!empty(session('points_discount'))){
                                                        $points_amount = session('currency_value') * session('points_discount');
                                                      }else{
                                                          $points_amount =0;
                                                      }


                                                      if(!empty(session('tax_rate'))){
                                                        $tax_rate = session('tax_rate');  
                                                      }else{
                                                        $tax_rate = 0;
                                                      }

                                                       if(!empty(session('shipping_detail')) and !empty(session('shipping_detail'))>0){
                                                        $shipping_price = session('shipping_detail')->shipping_price*session('currency_value');
                                                           $shipping_name = session('shipping_detail')->mehtod_name;
                                                       }else{
                                                           $shipping_price = 0;
                                                           $shipping_name = '';
                                                       }

                                                      // dd($price,$tax_rate,$shipping_price);
                                                       $tax_rate = number_format((float)$tax_rate, 2, '.', '');

                                                       $coupon_discount = number_format((float)$coupon_amount, 2, '.', '');

                                                       $points_discount = number_format((float)$points_amount, 2, '.', '');

                                                       //$total_price = ($price+$tax_rate+($shipping_price*session('currency_value')))-$coupon_discount;
                                                       $total_price = ($price+$tax_rate+$shipping_price)-$coupon_discount-$points_discount;
                                                       session(['total_price'=>($total_price)]);

                                                    ?>


@if($products->button_type == 3)

<div class="col-12 col-sm-12">
    <div class="row">
        <h4>Upload Prescription</h4>
      
      <div class="form-group" style="width:100%; padding:0;">
        <label>Please upload your prescrption below</label>
          <input type="file" name="pres_image[]" multiple  class="form-control" id="files"></input>
        </div>
    </div>
</div>
@endif
<span style="color:red" id="preresponse"></span>

<br>
                               </form>

                               <div class="col-12 col-sm-12">
                                    <div class="row">
                                        <div class="heading">
                                            <h4>@lang('website.orderNotesandSummary')</h4>
                                            
                                          </div>
                                      
                                      <div class="form-group" style="width:100%; padding:0;">
                                        <label for="exampleFormControlTextarea1">@lang('website.Please write notes of your order')</label>
                                        {{-- id="exampleFormControlTextarea1" --}}
                                          <textarea name="comments"   class="form-control" id="order_comments" rows="3">@if(!empty(session('order_comments'))){{session('order_comments')}}@endif</textarea>
                                        </div>
                                    </div>
                                      
                                </div>

                                   <div class="col-12 col-sm-12 mb-3">
                                       <div class="row">
                                         <div class="heading" style="width:100%;">
                                           <h2>@lang('website.Payment Methods')</h2>
                                           <hr>
                                         </div>

                                         <div class="alert alert-danger error_payment" style="display:none" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            @lang('website.Please select your payment method')
                                         </div>

                                         
                                         <form name="shipping_mehtods" method="post" id="payment_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/order_detail')}}" style="width:100%;" >
                                          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                      
                                         <div class="form-group" style="width:100%; padding:0;">
                                          <label for="exampleFormControlTextarea1" style="width:100%; margin-bottom:30px;">@lang('website.Please select a prefered payment method to use on this order')</label>
                                          <input id="payment_currency" type="hidden" onClick="paymentMethods();" name="payment_currency" value="{{session('currency_code')}}">
                                          @foreach($result['payment_methods'] as $payment_methods)
                                          
                                            @if($payment_methods['active']==1)
                                                
                                              @if($payment_methods['payment_method']=='braintree')

                                                  <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                  <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">
                                          
                                          
                                                <div class="form-check form-check-inline">
                                                    <input id="{{$payment_methods['payment_method']}}_label" type="radio" onClick="paymentMethods();" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                    <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label"><img src="{{asset('web/images/miscellaneous').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}"></label>
                                                </div>
                                              @else
                                              
                                                  <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                  <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">

                                                 @if($payment_methods['payment_method']=='PremierPay')

                    <input id="{{$payment_methods['payment_method']}}_store_id" type="hidden" name="store_id" value="{{$payment_methods['store_id']}}">

                    <input id="{{$payment_methods['payment_method']}}_store_key" type="hidden" name="store_key" value="{{$payment_methods['store_key']}}">

                    <input id="{{$payment_methods['payment_method']}}_redirect_url" type="hidden" name="redirect_url" value="{{$payment_methods['redirect_url']}}">

                    <input id="{{$payment_methods['payment_method']}}_callback_url" type="hidden" name="callback_url" value="{{$payment_methods['callback_url']}}">

                    @endif
                                                
                                                  
                                                  <div class="form-check form-check-inline" style="height:100%;">
                                                    <input onClick="paymentMethods();" id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                    <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label">
                                                      @if(file_exists( 'web/images/miscellaneous/'.$payment_methods['payment_method'].'.png'))
                                                        <img width="100px" src="{{asset('web/images/miscellaneous/').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}">
                                                      @else
                                                      {{$payment_methods['name']}}
                                                      @endif
                                                    </label>
                                                  </div>
                                              @endif  
                                            @endif

                                          @endforeach 
                                                                                 
                                        </div>
                                         </form>
                                          
                                           <div class="button mobile-align-check-btn">
                                            @foreach($result['payment_methods'] as $payment_methods)
                                          
                                              @if($payment_methods['active']==1 and $payment_methods['payment_method']=='banktransfer')
                                              <div class="alert alert-info alert-dismissible" id="payment_description" role="alert" style="display: none">
                                              <span>{{$payment_methods['descriptions']}}</span>
                                              </div>
                                              @endif

                                            @endforeach

                                               
                                                <div id="paypal_button" class="payment_btns" style="display: none"></div>

                                                <button id="braintree_button" style="display: none" class="btn btn-dark payment_btns" data-toggle="modal" data-target="#braintreeModel" >@lang('website.Order Now')</button>
                                                <input type="hidden" id="hide_pay_btn_new" value="0">
                                                <button id="stripe_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#stripeModel" >@lang('website.Order Now')</button>

                                                <button id="cash_on_delivery_button" class="btn btn-dark payment_btns btn_disables" style="display: none">@lang('website.Order Now')</button>
                                                <button id="wallet_button" class="btn btn-dark payment_btns btn_disables" style="display: none">@lang('website.Order Now')</button>
                                                <button id="razor_pay_button" class="razorpay-payment-button btn btn-dark payment_btns"  style="display: none"  type="button">@lang('website.Order Now')</button>
                                                <a href="{{ URL::to('/store_paytm')}}" id="pay_tm_button" class="btn btn-dark payment_btns btn_disable"  style="display: none"  type="button">@lang('website.Order Now')</a>

                                                <button id="instamojo_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#instamojoModel">@lang('website.Order Now')</button>

                                                <a href="{{ URL::to('/checkout/hyperpay')}}" id="hyperpay_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</a>

                                                <button id="banktransfer_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>
                                                <button id="paystack_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

                                                <button id="midtrans_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

                                                 <a href="{{ URL::to('/checkout/ipay88')}}" id="ipay88_button" class="btn btn-dark payment_btns btn_disable" style="display: none">@lang('website.Order Now')</a>

                                                 <a href="{{ URL::to('/checkout/paynetfpx')}}" id="paynet_fpx_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</a>

                                              
                                                 <a href="{{ URL::to('/checkout/premierpay')}}" id="PremierPay_button" class="btn btn-dark payment_btns btn_disable" style="display: none">@lang('website.Order Now')</a>

                                                <input type="hidden" id="midtransToken" value="">
                                                {{-- payment error content show --}}
                                                <div class="alert alert-danger alert-dismissible" id="payment_error" role="alert" style="display: none">
                                                  <span class="sr-only">@lang('website.Error'):</span>
                                                    <span id="payment_error-error-text"></span>
                                                </div>

                                              </div>
                                       </div>
                                       
                                       <div class="modal fade" id="braintreeModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="checkout" method="post" action="{{ URL::to('/place_order')}}">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                  
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">@lang('website.BrainTree Payment')</h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                   <div class="modal-body">
                                                         <div id="payment-form"></div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="submit" class="btn btn-dark">@lang('website.Pay') {{ Session::get('symbol_left') }} {{ number_format( (float)$total_price+0, 2, '.', '') }} {{ Session::get('symbol_right') }}</button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                       
                                       <div class="modal fade" id="instamojoModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="instamojo_form" method="post" action="">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                 <input type="hidden" name="amount" value="{{number_format((float)$total_price+0, 2, '.', '')}}">
                                                   
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">@lang('website.Instamojo Payment')</h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                  <div class="modal-body">
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Full Name')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="firstName" id="firstName" placeholder="@lang('website.Full Name')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your full name')</span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Email')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="email_id" id="email_id" placeholder="@lang('website.Email')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your email address')</span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Phone Number')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="phone_number" id="insta_phone_number" placeholder="@lang('website.Phone Number')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                                    								 </div>
                                    								</div>                                                       

                                                       <div class="alert alert-danger alert-dismissible" id="insta_mojo_error" role="alert" style="display: none">
                                                            <span class="sr-only">@lang('website.Error'):</span>
                                                            <span id="instamojo-error-text"></span>
                                                        </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" id="pay_instamojo" class="btn btn-dark">@lang('website.Pay') {{ Session::get('symbol_left') }} {{ number_format( (float)$total_price+0, 2, '.', '') }} {{ Session::get('symbol_right') }}</button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                     
                                       <div class="modal fade" id="stripeModel">
                                           <div class="modal-dialog">
                                               <div class="modal-content">

                                               <main>
                                               <div class="container-lg">
                                                   <div class="cell example example2">
                                                       <form>
                                                         <div class="row">
                                                           <div class="field">
                                                             <div id="example2-card-number" class="input empty"></div>
                                                             <label for="example2-card-number" data-tid="elements_examples.form.card_number_label">@lang('website.Card number')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                         <div class="row">
                                                           <div class="field half-width">
                                                             <div id="example2-card-expiry" class="input empty"></div>
                                                             <label for="example2-card-expiry" data-tid="elements_examples.form.card_expiry_label">@lang('website.Expiration')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                           <div class="field half-width">
                                                             <div id="example2-card-cvc" class="input empty"></div>
                                                             <label for="example2-card-cvc" data-tid="elements_examples.form.card_cvc_label">@lang('website.CVC')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                       <button type="submit" class="btn btn-dark" data-tid="elements_examples.form.pay_button">@lang('website.Pay') {{$web_setting[19]->value}}{{number_format((float)$total_price+0, 2, '.', '')}}</button>

                                                         <div class="error" role="alert"><svg xmlns="https://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                                             <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                                             <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                                           </svg>
                                                           <span class="message"></span></div>
                                                       </form>
                                                                   <div class="success">
                                                                     <div class="icon">
                                                                       <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                                                         <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                                                                         <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                                                                       </svg>
                                                                     </div>
                                                                     <h3 class="title" data-tid="elements_examples.success.title">@lang('website.Payment successful')</h3>
                                                                     <p class="message"><span data-tid="elements_examples.success.message">@lang('website.Thanks You Your payment has been processed successfully')</p>
                                                                   </div>

                                                               </div>
                                                           </div>
                                                       </main>
                                                   </div>
                                             </div>
                                         </div>

                                   </div>

                 </div>
               </div>
         </div>
         </div>
     </div>
     
     <div class="col-12 col-xl-3 checkout-right cart-page-one cart-area">
      <table class="table right-table">
        <thead>
          <tr>
            <th scope="col" colspan="2" align="center">@lang('website.Order Summary')</th>                    
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">@lang('website.SubTotal')</th>
            <td align="right">{{Session::get('symbol_left')}}{{$price+0}}{{Session::get('symbol_right')}}</td>

          </tr>
           @if($result['commonContent']['settings']['Loyalty']=='1')
          <tr>
          <th scope="row">@lang('website.Discount(Promo Code)')</th>
            <td align="right">{{Session::get('symbol_left')}}{{number_format((float)$coupon_discount, 2, '.', '')+0}}{{Session::get('symbol_right')}}</td>

          </tr>
          <tr>
          <th scope="row">@lang('website.Discount(Voucher)')</th>
            <td align="right">{{Session::get('symbol_left')}}{{number_format((float)$points_discount, 2, '.', '')+0}}{{Session::get('symbol_right')}}</td>

          </tr>
          @endif
          <tr>
              <th scope="row">@lang('website.Tax')</th>
              <td align="right">{{Session::get('symbol_left')}}{{$tax_rate}}{{Session::get('symbol_right')}}</td>

            </tr>
            <tr>
                <th scope="row">@lang('website.Shipping Cost')</th>
                <td align="right">{{Session::get('symbol_left')}}{{$shipping_price}}{{Session::get('symbol_right')}}</td>

              </tr>
          <tr class="item-price">
            <th scope="row">@lang('website.Total')</th>
            <td align="right" >{{ Session::get('symbol_left') }} {{ number_format( (float)$total_price, 2, '.', '')  }} {{Session::get('symbol_right')}}</td>

            <input type="hidden" name="total_order_price" id="totalresultorder" value="{{ number_format( (float)$total_price, 2, '.', '')  }}">

          </tr>
      
        </tbody>
        
      </table>

       </div>
   </div>
 </div>
</section>
</section> -->





<!-- map model code start -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-modal="true">
       
       <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
         <div class="modal-content">
             <div class="modal-body">

                 <div class="container">
                     <div class="row align-items-center">                   
                  
                     <div class="form-group">
    <input type="text" id="pac-input" name="address_address" class="form-control map-input">
</div>
<div id="address-map-container" style="width:100%;height:400px; ">
    <div style="width: 100%; height: 100%" id="map"></div>
</div>
                   </div>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                     </button>
                 </div>
               </div>
               <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" onclick="setUserLocation()"><i class="fas fa-location-arrow"></i></button>
        <button type="button" class="btn btn-secondary" onclick="saveAddress()">Save</button>
      </div>
         </div>
       </div>
       </div>
<!-- map modal code end -->
<style>
      .pac-container{
        z-index: 1052 !important;
      }
      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
  </style>
<script>
  
    jQuery('.demo-35-apply-active').hide();
    jQuery('.demo-35-apply-inactive').show();

    $(".demo-35-input-val").keyup(function(){
      var cpval = jQuery(".demo-35-input-val").val();
      if(cpval != '')
      {
      jQuery('.demo-35-apply-active').show();
      jQuery('.demo-35-apply-inactive').hide();
      }
      else
      {
        jQuery('.demo-35-apply-active').hide();
    jQuery('.demo-35-apply-inactive').show();
      }
    });

  jQuery(document).on('click', '.btn_disable', function(e){
 
    var val = jQuery("#hide_pay_btn_new").val();
    if(val == 0)
    {
      jQuery(".btn_disable").prop("disabled", false);
    }
    else
    {
    jQuery(this).off("click").attr('href', "javascript: void(0);");
    }
    jQuery("#hide_pay_btn_new").val('1');
    });


jQuery(document).on('click', '#cash_on_delivery_button, #banktransfer_button, #wallet_button', function(e){
  
  jQuery(".btn_disables").attr("disabled", true);
  jQuery("#update_cart_form").submit();
});

jQuery(document).on('click', '.btn_disable', function(e){
 
  var val = jQuery("#hide_pay_btn_new").val();
  if(val == 0)
  {
    jQuery(".btn_disable").prop("disabled", false);
  }
  else
  {
  jQuery(this).off("click").attr('href', "javascript: void(0);");
  }
  jQuery("#hide_pay_btn_new").val('1');
});


</script>
<script>
    $('#rzp-footer-form').submit(function (e) {
        var button = $(this).find('button');
        var parent = $(this);
        button.attr('disabled', 'true').html('Please Wait...');
        $.ajax({
            method: 'get',
            url: this.action,
            data: $(this).serialize(),
            complete: function (r) {
                jQuery("#update_cart_form").submit();
                console.log(r);
            }
        })
        return false;
    })
</script>

<script>
    function padStart(str) {
        return ('0' + str).slice(-2)
    }

    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        jQuery("#paymentDetail").removeAttr('style');
        jQuery('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        jQuery('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );

        jQuery.ajax({
            method: 'post',
            url: "{!!route('dopayment')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
                "razorpay_payment_id": transaction.razorpay_payment_id
            },
            complete: function (r) {
                jQuery("#update_cart_form").submit();
                console.log(r);
            }
        })
    }
</script>
<?php

if(!empty($result['payment_methods'][6]) and $result['payment_methods'][6]['active'] == 1){

$rezorpay_key =  $result['payment_methods'][6]['RAZORPAY_KEY'];

if(!empty($result['commonContent']['setting'][79]->value)){
  $name = $result['commonContent']['setting'][79]->value;
}else{
  $name = Lang::get('website.Ecommerce');
}

$logo = $result['commonContent']['setting'][15]->value;
 ?>
<script>
    var options = {
        key: "{{ $rezorpay_key }}",
        amount: '<?php echo (float) round($total_price, 2)*100;?>',
        name: '{{$name}}',
        image: '{{$logo}}',
        handler: demoSuccessHandler
    }
</script>
<script>
    window.r = new Razorpay(options);
    document.getElementById('razor_pay_button').onclick = function () {
        r.open()
    }
</script>

<?php
}

foreach($result['payment_methods'] as $payment_methods){
  if($payment_methods['active']==1 and $payment_methods['payment_method']=='midtrans'){
    if($payment_methods['environment'] == 'Live'){
      print '<script src="https://app.midtrans.com/snap/snap.js" data-client-key="'.$payment_methods['public_key'].'"></script>';
    }else{
      print '<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="'.$payment_methods['public_key'].'"></script>';

    }
  }
}
                                          
                                            

?>

<script>
jQuery( document ).ready( function () {
  var midtrans_environment = jQuery('#midtrans_environment').val();
  if(midtrans_environment !== undefined){
    midtrans_environment = midtrans_environment;
  }else{
    midtrans_environment = ';'
  }
});

</script>


<script type="text/javascript">
  document.getElementById('midtrans_button').onclick = function(){
    var tokken = jQuery('#midtransToken').val();
      // SnapToken acquired from previous step
      snap.pay(tokken, {
          // Optional
          onSuccess: function(result){
           // alert('onSuccess');
              // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
              paymentSuccess(JSON.stringify(result, null, 2));
          },
          // Optional
          onPending: function(result){
           // alert('onPending');
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            jQuery('#payment_error').show();
            var response = JSON.stringify(result, null, 2);
           // alert('error');
              /* You may add your own js here, this is just example */ document.getElementById('payment_error-error-text').innerHTML += result.status_message;
          }
      });
  };
</script>
  @if($result['commonContent']['settings']['google_map_api'])
    <script src="https://maps.googleapis.com/maps/api/js?key=<?=$result['commonContent']['settings']['google_map_api']?>&libraries=places&callback=initialize" async defer></script>
    <script>
      var markers;
      var myLatlng;
      var map;
      var geocoder;
     function setUserLocation(){
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            myLatlng = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            markers.setPosition(myLatlng);
            map.setCenter(myLatlng);

          }, function() {
          });
        } 
     } 
     function saveAddress(){
      
      var latlng = markers.getPosition();
      geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
             var street = "";
             var state = "";
             var country = "";
             var city = "";
             var postal_code = "";

                for (var i = 0; i < results[0].address_components.length; i++) {
                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                        switch (results[0].address_components[i].types[b]) {
                            case 'locality':
                                city = results[0].address_components[i].long_name;
                                break;
                            case 'administrative_area_level_1':
                                state = results[0].address_components[i].long_name;
                                break;
                            case 'country':
                                country = results[0].address_components[i].long_name;
                                break;
                            case 'postal_code':
                              postal_code =  results[0].address_components[i].long_name; 
                              break;
                            case 'route':
                              if (street == "") {
                                street = results[0].address_components[i].long_name;
                              }
                            break;

                            case 'street_address':
                              if (street == "") {
                                street += ", " + results[0].address_components[i].long_name;
                              }
                            break;
                        }
                    }
                }
                $("#postcode").val(postal_code);
                $("#street").val(street);
                $("#city").val(city);

               

                $("#latitude").val(markers.getPosition().lat());
                $("#longitude").val(markers.getPosition().lng());

                // $("#entry_country_id").val(country);
               
                $("#location").val(latlng);

                $("#entry_country_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == country;
                }).prop('selected', true);

               
                  $("#entry_zone_id option").filter(function() {
                    //may want to use $.trim in here
                    return $(this).text() == state;
                  }).prop('selected', true);

                  if(getZones("no_loader")){
                  $("#entry_zone_id option").filter(function() {
                    //may want to use $.trim in here
                    return $(this).text() == state;
                  }).prop('selected', true);
                }
               

                $('#mapModal').modal('hide');

            } else {
              console.log('No results found');
            }
          } else {
            console.log('Geocoder failed due to: ' + status);
          }
        });
     }

     function initialize() {
      defaultPOS = {
              lat: <?=$result['commonContent']['setting'][126]->value?>,
              lng: <?=$result['commonContent']['setting'][127]->value?>
            };
      map = new google.maps.Map(document.getElementById('map'), {
          center: defaultPOS,
          zoom: 13,
          mapTypeId: 'roadmap'
        });
      geocoder = new google.maps.Geocoder;
      markers = new google.maps.Marker({
          map: map,
          draggable:true,
          position: defaultPOS
        });

        
        
        var infowindow = new google.maps.InfoWindow;
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

          searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          var bounds = new google.maps.LatLngBounds();

          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };
            console.log(place.geometry.location);
            // Create a marker for each place.
            markers.setPosition(place.geometry.location);
            markers.setTitle(place.name);
            

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    </script>
  @endif
  <script type="text/javascript">
    function getDefaultaddress()
    {
      var address_id = $('#default_address_id :selected').val();
      //alert(address_id);
      jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      url: '{{ URL::to("/myDefaultAddress")}}',
      type: "POST",
      data: '&address_id='+address_id,

      success: function (res) {
         window.location = 'checkout';
      },

    });
    }
  </script>

<script>
    $( document ).ready(function() {
        $(".hide-load-time-btn").hide();
    });
 
    $( window ).on( "load", function() {
        $(".hide-load-time-btn").show();
    });
    </script>
@endsection