@extends('web.layout')
@section('content')


<style>


input[type=radio], input[type=checkbox] {
  box-sizing: border-box;
  padding: 0;
  display: inline-block;
  width: 30px;
}

.navbar {
  position: relative;
  min-height: 0px; 
  margin-bottom: 0px;
  border: 1px solid transparent;
}

.cktab {
  display:none;
  width:100%;
}

.checkout-area .checkout-module{
  padding:0px !important
}

.form-row {
display: flex;
flex-wrap: wrap;
margin-right: 0px;
margin-left: 0px;
}

</style>


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
    top: 10px !important;
    height: 40px !important;
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

      #update_cart_form{
        background-color: #ffffff;
        margin: 0px auto;
        border-radius: 10px
      }
      h1{
        text-align: center
      }
      input{
        padding: 10px;
        width: 100%;
        font-size: 17px;
        border: 1px solid #aaaaaa
      }
      input.invalid{
        background-color: #ffdddd
      }
      
      select.invalid{
        background-color: #ffdddd
      }
    
      #prevBtn{
        background-color: #bbbbbb
      }
    
      .step{
        background-color: #e1e1e1;
        padding: 5px;
        padding-left: 35px !important;
        font-size: 15px;
        position: relative;
        padding-left: 30px;
        width: calc(25% - 17px);
        margin-right: 15px;
      }
      .step.active{
        opacity: 1
      }
     
      .all-steps{
        text-align: center;
        margin-bottom: 30px;
        display:flex;
      }
    
      .step:before{
        content: "";
        border-top: 19.7px solid transparent;
        border-bottom: 19.7px solid transparent;
        border-left: 18px solid #f5f5f5;
        position: absolute;
        left: 0;
        top: 0;
        transition: 0.4s;
      }

      .step:after{
        content: "";
        border-top: 19.7px solid transparent;
        border-bottom: 19.7px solid transparent;
        border-left: 18px solid #e1e1e1;
        position: absolute;
        right: -18px;
        top: 0px;
        z-index: 1;
        transition: 0.4s;
      }

      @media only screen and (max-width: 768px) {
      .checkout-area .checkout-module .form-group .form-check-inline {
    margin-right: 5px;
    background-color: white;
    height: auto !important;
    padding-left: 10px;
    padding-right: 10px;
    display: inline-block;
    justify-content: center;
    align-items: center;
     float: unset; 
    width: 32%;
}
      }

      @media only screen and (max-width: 600px) {
.pac-container.pac-logo {
    width: 300px !important;
    right: 32px;
    left: unset !important;
}
#pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 0px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 200px;
    top: 55px !important;
    height: 40px !important;
    left: unset !important;
    right:10px;
}
}


      @media only screen and (max-width: 600px) {
      .checkout-area .checkout-module .form-group .form-check-inline {
    margin-right: 5px;
    background-color: white;
    height: auto !important;
    padding-left: 10px;
    padding-right: 10px;
    display: inline-block;
    justify-content: center;
    align-items: center;
     float: unset; 
    width: 48%;
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

  <div class="container pro-content">
    <div class="page-heading-title">
      <h2> @lang('website.Checkout') </h2>
    </div>
  </div>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-9 checkout-left">
            <form method='POST' class="checkout-module" id="update_cart_form"  action='{{ URL::to('/place_order')}}' enctype="multipart/form-data">
            {!! csrf_field() !!}
                <div class="all-steps" id="all-steps"> 
                  <span class="step"><span class="d-flex d-lg-none">1</span>
                    <span class="d-none d-lg-flex">@lang('website.Shipping Address')</span></span> 
                  <span class="step"><span class="d-flex d-lg-none">2</span>
                    <span class="d-none d-lg-flex">@lang('website.Billing Address')</span></span> 
                  <span class="step"><span class="d-flex d-lg-none">3</span>
                    <span class="d-none d-lg-flex">@lang('website.Shipping Methods')</span></span> 
                  <span class="step"><span class="d-flex d-lg-none">4</span>
                    <span class="d-none d-lg-flex">@lang('website.Order Detail')</span></span> 
                </div>

                <div class="cktab">
                  <div class="form-group">
                      <label for=""> @lang('website.Shipping_Address')</label>
                      {{-- <div class="input-group select-control row"> --}}
                          <select class="form-control" id="default_address_id" onChange="getDefaultaddress();" name="default_address_id" aria-describedby="countryHelp">
                            <option value="" selected>@lang('website.Select_Shipping')</option>
                            @if(!empty($result['address']))
                              @foreach($result['address'] as $address)
                                  <option value="{{$address->address_id}}" @if(!empty($result['default'])) @if($result['default']->address_id == $address->address_id) selected @endif @endif >{{$address->firstname}} {{$address->lastname}} ({{$address->street}})</option>
                              @endforeach
                            @endif
                            </select>
                      {{--  </div> --}}
                      <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your shipping address')</span>
                  </div>
                  <input type="hidden" required name="address_book_id" id="address_book_id" value="@if(!empty($result['default']->address_id)){{$result['default']->address_id}}@endif" />
                  <div class="form-row">
                    <div class="form-group">
                      <label for=""> @lang('website.First Name') <span style="color:red;">*</span></label>
                      <input type="text"  required class="form-control field-validate" id="firstname" name="firstname" value="@if(!empty(session('shipping_address'))){{session('shipping_address')->firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
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
                        <input type="text" required class="form-control field-validate" data-toggle="modal" data-target="#mapModal" name="location" id="location" aria-describedby="addressHelp" placeholder="@lang('website.Please enter your location or click here to open map')" value="{{$result['default']->street}}">
                      </div>
                    <?php }?>
                    <input type="hidden" name="latitude" id="latitude" value="@if(!empty(session('shipping_address')) && isset(session('shipping_address')->latitude) ) {{session('shipping_address')->latitude}} @else {{$result['default']->latitude}} @endif">
                    <input type="hidden" name="longitude" id="longitude" value="@if(!empty(session('shipping_address')) && isset(session('shipping_address')->longitude)  ) {{session('shipping_address')->longitude}} @else {{$result['default']->latitude}} @endif">
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
                      <input required type="number" class="form-control field-validate" id="postcode" aria-describedby="zpcodeHelp" placeholder="@lang('website.Enter Your Zip / Postal Code')" name="postcode" value="@if(!empty($result['default'])){{$result['default']->postcode}}@endif">
                      <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your Zip/Postal Code')</span>
                    </div>
                    <div class="form-group">
                      <label for=""> @lang('website.Phone')</label>
                      <input required type="text" class="form-control field-validate" id="delivery_phone" aria-describedby="numberHelp" placeholder="@lang('website.Enter Your Phone Number')" name="delivery_phone" value="@if(!empty($result['default'])){{$result['default']->entry_phone}}@endif">
                      <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                    </div>                         
                  </div>
                </div>

                <div class="cktab">
                  <div class="form-row">

                    <div class="form-group">
                      <label for=""> @lang('website.First Name')</label>
                        <input type="text" class="form-control same_address field-validate" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif  id="billing_firstname" name="billing_firstname" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                        <span class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                    </div>

                    <div class="form-group">
                      <label for=""> @lang('website.Last Name')</label>
                        <input type="text" class="form-control same_address field-validate" id="billing_lastname" aria-describedby="NameHelp2" placeholder="Enter Your Name" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif  id="billing_lastname" name="billing_lastname" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_lastname}}@endif">
                        <span class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                    </div>

                    <div class="form-group">
                      <label for=""> @lang('website.Company')</label>
                        <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif  id="billing_company" name="billing_company" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_company}}@endif" id="exampleInputCompany1" aria-describedby="companyHelp" placeholder="Enter Your Company Name">
                        <span class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                    </div>

                    <div class="form-group">
                      <label for=""> @lang('website.Address')</label>
                        <input type="text" class="form-control same_address field-validate" id="billing_street" aria-describedby="addressHelp" placeholder="Enter Your Address" @if(!empty(session('22'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif  id="billing_street" name="billing_street" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_street}}@endif">
                        <span class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                    </div>

                    <div class="form-group">
                      <label for=""> @lang('website.Country')</label>
                        <div class="input-group select-control">
                        <select required class="form-control same_address_select field-validate" id="billing_countries_id" aria-describedby="countryHelp" onChange="getBillingZones();" name="billing_countries_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif>
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
                          <select required class="form-control same_address_select field-validate" name="billing_zone_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif id="billing_zone_id" aria-describedby="stateHelp">
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
                          <input type="text" class="form-control same_address field-validate" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif  id="billing_city" name="billing_city" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_city}}@endif" placeholder="Enter Your City">
                          <span class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                    </div>

                    <div class="form-group">
                      <label for=""> @lang('website.Zip/Postal Code')</label>
                        <input type="text" class="form-control same_address field-validate" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif  id="billing_zip" name="billing_zip" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_zip}}@endif" aria-describedby="zpcodeHelp" placeholder="Enter Your Zip / Postal Code">
                        <small id="zpcodeHelp" class="form-text text-muted"></small>
                    </div>

                    <div class="form-group">
                      <label for=""> @lang('website.Phone')</label>
                        <input type="text" class="form-control same_address field-validate" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else  @endif  id="billing_phone" name="billing_phone" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_phone}}@endif" aria-describedby="numberHelp" placeholder="Enter Your Phone Number">
                        <span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="form-check p-0">
                          <input class="form-check-input" style="position:unset;" type="checkbox" id="same_billing_address" value="1" name="same_billing_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) checked @endif @else   @endif > @lang('website.Same shipping and billing address')
                          <small id="checkboxHelp" class="form-text text-muted"></small>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="cktab">
                  <div class="col-12 col-sm-12">
                    <div class="row"> 
                      <p>@lang('website.Please select a prefered shipping method to use on this order')</p>
                    </div>
                  </div>
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
                          <input type="hidden" name="shipping_km" id="shipping_km" value="0">
                          <input type="hidden" name="shipping_weight" id="shipping_weight" value="0">
                            <input class="shipping_data shipping_mehtods_form" id="Free Shipping" type="radio" name="shipping_method" value="freeShipping" shipping_price="0" method_name="Free Shipping" checked="">
                            <label for="Free Shipping">Free Shipping ---    {{Session::get('symbol_left')}}0{{Session::get('symbol_right')}}</label>
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
                                <input type="hidden" name="shipping_km" id="shipping_km" value="0">
                                <input type="hidden" name="shipping_weight" id="shipping_weight" value="{{$shipping_methods['weight']}}">
                                @foreach($shipping_methods['services'] as $services)
                                  <?php
                                    if($services['shipping_method']=='upsShipping')
                                        $method_name=$shipping_methods['name'].'('.$services['name'].')';
                                    else{
                                      $method_name=$services['name'];
                                      }
                                  ?>
                                  @if($services['shipping_method']== 'shippingByKM')
                                    <input type="hidden" name="shipping_km" id="shipping_km" value="{{$services['km']}}">
                                    <input type="hidden" name="shipping_weight" id="shipping_weight" value="0">
                                    <li>
                                      <input class="shipping_data shipping_mehtods_form" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0) @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif @elseif($shipping_methods['is_default']==1) checked @endif @if($shipping_methods['is_default']==1) checked @endif >      
                                      <label for="{{$method_name}}">{{$services['name']}} ---    {{Session::get('symbol_left')}}{{$services['rate']* session('currency_value')}}{{Session::get('symbol_right')}}                                                    </label>
                                    </li>
                                    <!-- <li> 
                                      <div class="heading" style="margin-top:15px;margin-bottom:15px;">
                                        <h2>Note :</h2>    
                                      </div>
                                    </li>    
                                    <ul>
                                      @foreach($services['getallkm'] as $km)
                                        <li>{{$km->km_from}} KM to {{ $km->km_to }} KM = RM {{ $km->km_price }}</li>
                                      @endforeach
                                    </ul> -->
                                  @else
                                    <li>
                                      <input class="shipping_data shipping_mehtods_form" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0) @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif @elseif($shipping_methods['is_default']==1) checked @endif  @if($shipping_methods['is_default']==1) checked @endif >
                                      <label for="{{$method_name}}">{{$services['name']}} ---    {{Session::get('symbol_left')}}{{$services['rate']* session('currency_value')}}{{Session::get('symbol_right')}}                                                     </label>
                                    </li>
                                  @endif
                                @endforeach     
                              </ul>               
                            @else
                              <ul class="list"style="list-style:none; padding: 0px;">
                                <li>@lang('website.Your location does not support this') {{$shipping_methods['name']}}.</li>
                                @if($shipping_methods['success']==3)
                                  <?php  $getallkm = DB::table('products_shipping_rates_km')->where('km_status', 1)->get();?>
                                  <!-- <li> 
                                    <div class="heading" style="margin-top:15px;margin-bottom:15px;">
                                      <h2>Note :</h2> 
                                    </div>
                                  </li>
                                  <ul>
                                    @foreach($getallkm as $km)
                                      <li>{{$km->km_from}} KM to {{ $km->km_to }} KM = RM {{ $km->km_price }}  </li>
                                    @endforeach
                                  </ul> -->
                                @endif
                              </ul>
                            @endif
                          </div>
                        </div>
                      @endforeach
                    @endif
                            <ul class="list"style="list-style:none; padding: 0px;">
                              @if($result['commonContent']['settings']['checkout_shipping_detail'] !='')
                                <li> 
                                  <div class="heading" style="margin-top:15px;margin-bottom:15px;">
                                    <h2>Note :</h2> 
                                  </div>
                                </li>
                                <ul>
                                <?php
                                    $sevalue = DB::table('settings')
                                    ->where('id', 230)
                                    ->first();
                                ?>
                                    <p><?=stripslashes($sevalue->value)?> </p>
                                </ul>
                              @endif
                            </ul>
                  @endif
                </div>

                <div class="cktab">
                  <?php $price = 0; ?>
                  <table class="table top-table">
                    @foreach( $result['cart'] as $products)
                    <?php
                      $orignal_price = $products->final_price * session('currency_value');
                      $price+= $orignal_price * $products->customers_basket_quantity;
                    ?>

                    <tbody>

                    <tr class="d-flex" style="align-items: center;">
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
                              <?php
                                  $uniqueOptions = [];


                                foreach($products->attributes as $attributes){

                                    $options = $attributes->attribute_name;
                                    $values = $attributes->attribute_value;

                                    if (!isset($uniqueOptions[$options])) {
                                      $uniqueOptions[$options] = [];
                                    }

                                    $uniqueOptions[$options][] = $values;

                                }

                                  ?>

                                @foreach($uniqueOptions as $option => $values)
                                <small style="text-align:left"><b>{{ $option }} :</b> ({{ implode(', ', $values) }})</small><br>
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
                    <tr>
                      <td style="text-align:left">
                      @if($products->products_type == 3)
                        <?php
                          $comboPro = DB::table('product_combo')
                          ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                          ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                          ->where('products_description.language_id', Session::get('language_id'))
                          ->where('categories_description.language_id', Session::get('language_id'))
                          ->where('product_combo.pro_id', $products->products_id)
                          ->get();
                        ?>
                          @foreach($comboPro as $comboProd)
                            <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                          @endforeach
                      @endif

                      @if($products->products_type == 4)
                        <?php
                          $comboProbuyx = DB::table('product_buy_x')
                          ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                          ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                          ->where('products_description.language_id', Session::get('language_id'))
                          ->where('categories_description.language_id', Session::get('language_id'))
                          ->where('product_buy_x.pro_id', $products->products_id)
                          ->get();

                          $comboProgetx = DB::table('product_get_x')
                          ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                          ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                          ->where('products_description.language_id', Session::get('language_id'))
                          ->where('categories_description.language_id', Session::get('language_id'))
                          ->where('product_get_x.pro_id', $products->products_id)
                          ->get();

                        ?>
                        <h5>Buy X </h5>
                          @foreach($comboProbuyx as $comboProdbuyx)
                            <small><b>Product Name :</b> {{$comboProdbuyx->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProdbuyx->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProdbuyx->qty}}</small><br>
                          @endforeach

                        <h5>Get X </h5>
                          @foreach($comboProgetx as $comboProdgetx)
                            <small><b>Product Name :</b> {{$comboProdgetx->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProdgetx->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProdgetx->qty}}</small><br>
                          @endforeach
                      @endif
                      </td>
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
                                      
                                         <div class="form-group" style="width:100%; padding:0;margin-bottom:50px">
                                          <label for="exampleFormControlTextarea1" style="width:100%;">@lang('website.Please select a prefered payment method to use on this order')</label>
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
                                                
                            @if(!empty(session('coupon')))
                              @foreach(session('coupon') as $coupons_show)
                                @if($payment_methods['payment_method'] == $coupons_show->payment_type)
                                                  
                                  <div class="form-check form-check-inline">
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
                              @endforeach
                            @else
                              <div class="form-check form-check-inline">
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
                            @endif

                          @endforeach 
                                                                  
                                        </div>
                                         </form>
                                          
                                           <div class="button mobile-align-check-btn">

                                           <button style="background-color: #bbbbbb;" class="btn swipe-to-top btn-secondary" type="button" onclick="nextPrev(-1)">Previous</button> 

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
                                                <?php 
                                                  $user = DB::table('users')->where('id',auth()->user()->id)->first();
                                                  if($user->wallet_amount >= $total_price){
                                                ?>
                                                  <button id="wallet_button" class="btn btn-dark payment_btns btn_disables" style="display: none">@lang('website.Order Now')</button>
                                                <?php } ?>
                                                <button id="razor_pay_button" class="razorpay-payment-button btn btn-dark payment_btns"  style="display: none"  type="button">@lang('website.Order Now')</button>
                                                <a href="{{ URL::to('/store_paytm')}}" id="pay_tm_button" class="btn btn-dark payment_btns btn_disable"  style="display: none"  type="button">@lang('website.Order Now')</a>

                                                <button id="instamojo_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#instamojoModel">@lang('website.Order Now')</button>

                                                <a href="{{ URL::to('/checkout/hyperpay')}}" id="hyperpay_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</a>

                                                <button id="banktransfer_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>
                                                <button id="paystack_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

                                                <button id="midtrans_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

                                                 <a id="ipay88_button" class="btn btn-dark payment_btns btn_disable ipay88_form_submit" style="display: none;color:#fff;">@lang('website.Order Now')</a>

                                                 <a id="senangpay_button" class="btn btn-dark payment_btns btn_disable senangpay_form_submit" style="display: none;color:#fff;">@lang('website.Order Now')</a>

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

                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:left;margin-bottom:30px;"> <button class="btn swipe-to-top btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> <button class="btn swipe-to-top btn-secondary" type="button" id="nextBtn" onclick="nextPrev(1)">Continue</button> </div>
                </div>
            </form>
        </div>

        <div class="col-12 col-xl-3 checkout-right cart-page-one cart-area">

          <?php $price = 0; ?>
         
                    @foreach( $result['cart'] as $products)
                      <?php
                        $orignal_price = $products->final_price * session('currency_value');
                        $price+= $orignal_price * $products->customers_basket_quantity;
                      ?>
       
                          <?php                                                      
                            $orignal_price = $products->final_price * session('currency_value');
                          ?>
        
                    @endforeach
          <?php
                    if(!empty(session('coupon_discount'))){
                      $coupon_amount = session('currency_value') * session('coupon_discount');  
                    }else{ $coupon_amount = 0; }
                    if(!empty(session('points_discount'))){
                      $points_amount = session('currency_value') * session('points_discount'); }else{ $points_amount =0; }
                    if(!empty(session('tax_rate'))){
                      $tax_rate = session('tax_rate'); }else{ $tax_rate = 0; }
                    if(!empty(session('shipping_detail')) and !empty(session('shipping_detail'))>0){
                      $shipping_price = session('shipping_detail')->shipping_price*session('currency_value');
                      $shipping_name = session('shipping_detail')->mehtod_name;
                    }else{ $shipping_price = 0; $shipping_name = ''; }

                    // dd($price,$tax_rate,$shipping_price);
                    $tax_rate = number_format((float)$tax_rate, 2, '.', '');
                    $coupon_discount = number_format((float)$coupon_amount, 2, '.', '');
                    $points_discount = number_format((float)$points_amount, 2, '.', '');
                    //$total_price = ($price+$tax_rate+($shipping_price*session('currency_value')))-$coupon_discount;
                    $total_price = ($price+$tax_rate+$shipping_price)-$coupon_discount-$points_discount; 
                    $total_price_checkout3_sec = ($price+$tax_rate)-$coupon_discount-$points_discount; 
                    session(['total_price'=>($total_price)]);
                  ?>
          <table class="table right-table">
            <thead>
              <tr>
                <th scope="col" colspan="2" align="center">@lang('website.Order Summary')</th>                    
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">@lang('website.SubTotal')</th>
                <td align="right">{{Session::get('symbol_left')}} {{$price+0}} {{Session::get('symbol_right')}}</td>
              </tr>
              @if($result['commonContent']['settings']['Loyalty']=='1')
              <tr>
              <th scope="row">@lang('website.Discount(Promo Code)')</th>
                <td align="right">{{Session::get('symbol_left')}} {{number_format((float)$coupon_discount, 2, '.', '')+0}} {{Session::get('symbol_right')}}</td>
              </tr>
              <tr>
              <th scope="row">@lang('website.Discount(Voucher)')</th>
                <td align="right">{{Session::get('symbol_left')}} {{number_format((float)$points_discount, 2, '.', '')+0}}  {{Session::get('symbol_right')}}</td>
              </tr>
              @endif
              @if($result['commonContent']['settings']['tax_class']=='2')
                <tr>
                  <th scope="row">@lang('website.Tax')</th>
                  <td align="right">{{Session::get('symbol_left')}} {{$tax_rate}} {{Session::get('symbol_right')}}</td>
                </tr>
              @elseif($result['commonContent']['settings']['tax_class']=='1')
                @if(count($result['commonTax'])>0)
                  @foreach ($result['commonTax'] as $jescomtax)
                  @php
                    $view_tax=$jescomtax->tax_rate / 100 * $price * session('currency_value');
                  @endphp
                    <tr>
                        <th scope="row">{{$jescomtax->tax_class_title}} ({{$jescomtax->tax_rate}} %)</th>
                        <td align="right">{{Session::get('symbol_left')}} {{$view_tax}} {{Session::get('symbol_right')}}</td>
                    </tr>
                  @endforeach
                @else
                <tr>
                <th scope="row">@lang('website.Tax')</th>
                <td align="right">{{Session::get('symbol_left')}} {{$tax_rate}} {{Session::get('symbol_right')}}</td>
              </tr>
                @endif
            @else
                <tr>
                <th scope="row">@lang('website.Tax')</th>
                <td align="right">{{Session::get('symbol_left')}} {{$tax_rate}} {{Session::get('symbol_right')}}</td>
              </tr>
            @endif
              <tr>
                  <th scope="row">@lang('website.Shipping Cost')</th>
                  <td align="right">{{Session::get('symbol_left')}} <span id="shipping_price_checkout3">{{$shipping_price}}</sapn> {{Session::get('symbol_right')}}</td>
              </tr>
              <tr class="item-price">
                <th scope="row">@lang('website.Total')</th>
                <td class="subtitle-total" align="right" >{{ Session::get('symbol_left') }} <span id="total_price_checkout3"> {{ number_format( (float)$total_price_checkout3_sec, 2, '.', '')  }} </span>{{Session::get('symbol_right')}}</td>

                <input type="hidden" id="total_price_checkout3_new" value="{{ number_format( (float)$total_price_checkout3_sec, 2, '.', '')  }}">
              <input type="hidden" name="total_order_price" id="totalresultorder" value="{{ number_format( (float)$total_price, 2, '.', '')  }}">

              <input type="hidden" name="senang_amount" id="senang_amount" value="{{ number_format( (float)$total_price, 2, '.', '')  }}">

              </tr>
            </tbody>
          </table>
       </div>

    </div>
</div>




<!-- map model code start -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-modal="true">
       
       <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
         <div class="modal-content">
             <div class="modal-body">

                 <div class="container">
                     <div class="row align-items-center">                   
                  
                     <div class="form-group">
    <input type="text" id="pac-input" name="address_address" class="form-control map-input" placeholder="Search Your Location">
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
        
        <button type="button" class="btn btn-primary" onclick="setUserLocation2()"><i class="fas fa-location-arrow"></i></button>
        <button type="button" class="btn btn-secondary" onclick="saveAddress2()">Save</button>
      </div>
         </div>
       </div>
       </div>
<!-- map modal code end -->

<script>

  


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
     function setUserLocation2(){
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
     function saveAddress2(){
      
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
               
                $("#location").val(street);

                $("#entry_country_id option").filter(function() {
                //may want to use $.trim in here
                return $(this).text() == country;
              }).prop('selected', true);
 
             
             
              $("#entry_zone_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == state;
                }).prop('selected', true); 
 
                /*  if(getZones1("no_loader")){
                $("#entry_zone_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == state;
                }).prop('selected', true); 
              
              } */

              getZones1(state);

                $('#mapModal').modal('hide');

            } else {
              console.log('No results found');
            }
          } else {
            console.log('Geocoder failed due to: ' + status);
          }
        });
     }

     function getZones1(state) {
		jQuery(function ($) {
			jQuery('#loader').show();
    
			var country_id = jQuery('#entry_country_id').val();
			jQuery.ajax({
				beforeSend: function (xhr) { // Add this line
								xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
				 },
				url: '{{ URL::to("/ajaxZones")}}',
				type: "POST",
				//data: '&country_id='+country_id,
				 data: {'country_id': country_id,"_token": "{{ csrf_token() }}"},

				success: function (res) {
					var i;
					var showData = [];
					for (i = 0; i < res.length; ++i) {
						var j = i + 1;
						showData[i] = "<option value='"+res[i].zone_id+"'>"+res[i].zone_name+"</option>";
					}
					showData.push("<option value='-1'>@lang('website.Other')</option>");
					jQuery("#entry_zone_id").html(showData);
          jQuery("#billing_zone_id").html(showData);
          $("#entry_zone_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == state;
                }).prop('selected', true); 
					jQuery('#loader').hide();
				},
			});
		});
};

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

        $('#firstname').val(res[0].entry_firstname);
        $('#lastname').val(res[0].entry_lastname);
        $('#company').val(res[0].entry_company);
        $('#location').val('('+res[0].entry_latitude + ',' + res[0].entry_longitude +')');
        $('#latitude').val(res[0].entry_latitude);
        $('#longitude').val(res[0].entry_longitude);
        $('#street').val(res[0].entry_street_address);
        $('#entry_country_id').val(res[0].entry_country_id);
        $('#entry_zone_id').val(res[0].entry_zone_id);
        $('#city').val(res[0].entry_city);
        $('#postcode').val(res[0].entry_postcode);
        $('#delivery_phone').val(res[0].entry_phone);
         //window.location = 'checkout';
      },

    });
    }


  </script>

<script>

  var currentTab = 0;
  document.addEventListener("DOMContentLoaded", function(event) {
    showTab(currentTab);
  });

  function showTab(n) {
    var x = document.getElementsByClassName("cktab");
    x[n].style.display = "block";
    // if (n == 0) {
    //   document.getElementById("prevBtn").style.display = "none";
    // } else {
    //   document.getElementById("prevBtn").style.display = "inline";
    // }
    // if (n == (x.length - 1)) {
    //   document.getElementById("nextBtn").innerHTML = "Order Now";
    // } else {
    //   document.getElementById("nextBtn").innerHTML = "Continue";
    // }
    if(n == 0){
      document.getElementById("prevBtn").style.display = "none";
      document.getElementById("nextBtn").style.display = "inline";
    }
    else if(n == 1){
      document.getElementById("prevBtn").style.display = "inline";
      document.getElementById("nextBtn").style.display = "inline";
    }
    else if(n == 2){
      document.getElementById("prevBtn").style.display = "inline";
      document.getElementById("nextBtn").style.display = "inline";
    }
    else if(n == 3){
      document.getElementById("prevBtn").style.display = "none";
      document.getElementById("nextBtn").style.display = "none";
    }else{
      document.getElementById("prevBtn").style.display = "none";
      document.getElementById("nextBtn").style.display = "inline";
    }
    fixStepIndicator(n)
  }

  function nextPrev(n) {
    var x = document.getElementsByClassName("cktab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
       //document.getElementById("update_cart_form").submit();
      // return false;
      //alert("sdf");
      document.getElementById("nextprevious").style.display = "none";
      document.getElementById("all-steps").style.display = "none";
      // document.getElementById("text-message").style.display = "block";
      
    }
    showTab(currentTab);
  }

  function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("cktab");
    y = x[currentTab].getElementsByClassName("field-validate");
    for (i = 0; i < y.length; i++) {
      if (y[i].value == "") {
        y[i].className += " invalid";
        valid = false;
      }
    }
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid;
  }
  function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    x[n].className += " active";
  }


// ajax call shipping method

    $( document ).ready(function() {
        $(".hide-load-time-btn").hide();
    });
 
    $( window ).on( "load", function() {
        $(".hide-load-time-btn").show();
    });
    </script>

    <script>



jQuery(document).on('click', '.ipay88_form_submit', function(e){
  var formData = jQuery("#update_cart_form").serialize();
  jQuery.ajax({
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    url: '{{ URL::to("/checkout/ipay88")}}',
    type: "POST",
    data: formData,

    success: function (res) {

      var data = JSON.parse(res);
			var amount = data.amount;
			var product_name = data.product_name;
			var orders_id = data.orders_id;
			var amount = data.amount;
      
    
      var response_url = '{{ URL::to("/onlinepay/response")}}';

      var url = "https://platinum24.online/request.php?spayid="+orders_id+"&samount="+amount+"&product_name="+product_name+"&response_url="+response_url+"";
       

        window.location.href = url;
      
    },
  });
});

jQuery(document).on('click', '.senangpay_form_submit', function(e){
  var formData = jQuery("#update_cart_form").serialize();
  jQuery('#loader').show();
  jQuery.ajax({
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    url: '{{ URL::to("/checkout/senangpay")}}',
    type: "POST",
    data: formData,
    success: function (res) {
        jQuery('#loader').hide();
        var url = '{{ URL::to("/senangpay/requests")}}/'+res;
        window.location.href = url;
    },
  });
});


if ($(".shipping_mehtods_form").is(":checked")) {

var shipping_method = $("input[name='shipping_method']:checked").val();
var mehtod_name = $("input[name='shipping_method']:checked").attr("method_name");
var shipping_price = $("input[name='shipping_method']:checked").attr("shipping_price");
var shipping_km = $("#shipping_km").val();
var shipping_weight = $("#shipping_weight").val();

$("#shipping_price_checkout3").html(shipping_price);

var total_price = $("#total_price_checkout3_new").val();
var total_price_sum = parseFloat(total_price) + parseFloat(shipping_price);
var total_price_sums = total_price_sum.toFixed(2);
$("#total_price_checkout3").html(total_price_sums);


jQuery.ajax({
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    url: '{{ URL::to("/checkout_payment_method_checkout3")}}',
    type: "POST",
    data: '&mehtod_name='+mehtod_name+'&shipping_price='+shipping_price+'&shipping_km='+shipping_km+'&shipping_weight='+shipping_weight+'&shipping_method='+shipping_method+'&total_price='+total_price_sums,

    success: function (res) {
     
    },

  });  

}

$('.shipping_mehtods_form').click(function (e) {


  var mehtod_name = $(this).attr('method_name');
  var shipping_price = $(this).attr('shipping_price');
  var shipping_km = $("#shipping_km").val();
  var shipping_weight = $("#shipping_weight").val();
  var shipping_method = this.value;

  $("#shipping_price_checkout3").html(shipping_price);

  var total_price = $("#total_price_checkout3_new").val();
  var total_price_sum = parseFloat(total_price) + parseFloat(shipping_price);
  var total_price_sums = total_price_sum.toFixed(2);
  $("#total_price_checkout3").html(total_price_sums);

 
    jQuery.ajax({
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    url: '{{ URL::to("/checkout_payment_method_checkout3")}}',
    type: "POST",
    data: '&mehtod_name='+mehtod_name+'&shipping_price='+shipping_price+'&shipping_km='+shipping_km+'&shipping_weight='+shipping_weight+'&shipping_method='+shipping_method+'&total_price='+total_price_sums,

    success: function (res) {
     
    },

  });  
  });


  </script>
@endsection