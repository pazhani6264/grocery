@extends('web.layout')
@section('content')


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
  </style>
  
<style>

  .form-group {
    margin-bottom: 1.5rem;
  }

.media-main {
margin-bottom: 30px;
}

.media-main .media {
display: flex;
align-items: center;
background-color: white;
padding: 20px;
}

.media-main .media-body {
margin-left: 15px;
}

.media-main .media-body h4 {
font-size: 1rem;
margin-bottom: 0;
}

.media-main .media-body h4 {
margin-bottom: 0.5rem;
}

.media-main .media-body .detail p {
font-size: 11px;
}

.profile-mobile-content-right {
border: 0px solid #dee2e6;
width: 83%;
display: inline-block;
vertical-align: top;
}

.add_desktop_none
  {
    display:none;
  }
  .add_mobile_none
  {
    display:inline-block;
  }

  .add_profile_desktop_none
  {
    display:none;
  }
  .add_profile_mobile_none
  {
    display:block;
  }

@media only screen and (max-width: 996px) {
  .ship_form_content
  {
    margin-left: 15px !important;
  }
  .ship_form_content h3
  {
    font-size: 20px;
  }
  .add_desktop_none
  {
    display:inline-block;
  }
  .add_mobile_none
  {
    display:none;
  }
  .add_profile_desktop_none
  {
    display:block;
  }
  .add_profile_mobile_none
  {
    display:none;
  }
  .wallet-desktop-content-main {
    border: 0px solid;
    padding: 0;
}
}
@media screen and (min-width: 768px) and (max-width: 1100px){
.wallet-desktop-main {
    margin:0;
}
}

</style>
<style>
  @media only screen and (max-width: 991px)
  {
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
    .pro-content {
      padding-top: 0px !important;
    }
  }
  @media only screen and (max-width: 767px)
  {
    .pro-content {
        padding-top: 0px !important;
    }
  }
</style>

<div class="container-fuild ">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.Shipping Address')</li>
          </ol>
      </div>
    </nav>
</div> 

<!--Shipping Content -->
<section class="shipping-content pro-content" style="padding-top:10px;margin-bottom:30px;">
  <div class="container">
    <div class="row">


    <div class="wallet-desktop-main">
        <div class="wallet-dektop-header add_profile_mobile_none">
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

        <div class="col-12 media-main add_profile_desktop_none">
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

        <div class="wallet-desktop-content-main">
          <div class="wallet-desktop-content-left add_mobile_none">
            <div class="wallet-desktop-content-left-main">
              <div class="wallet-desktop-content-left-title">Account Settings</div>
              <div class="wallet-desktop-content-menu-main">
                <a href="{{ URL::to('/profile')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-user wallet-icon"></i> @lang('website.Profile')</div>
                </a>
                <a href="{{ URL::to('/shipping-address')}}">
                  <div class="wallet-desktop-content-menu-item wallet-active"> <i class="fas fa-map-marker-alt wallet-icon"></i> <span style="vertical-align:text-bottom">@lang('website.Shipping Address')</span></div>
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
                  <div class="wallet-desktop-content-menu-item"> <i class="fas fa-heart  wallet-icon"></i> @lang('website.Wishlist')</div>
                </a>
                <a  href="{{ URL::to('/orders')}}">
                  <div class="wallet-desktop-content-menu-item"> <i class="fas fa-shopping-cart  wallet-icon"></i> @lang('website.Orders')</div>
                </a>
                <?php if($result['commonContent']['settings']['appointment'] == '1') { ?>
                  <a  href="{{ URL::to('/view_appointment')}}">
                    <div class="wallet-desktop-content-menu-item"><i class="fas fa-check  wallet-icon"></i> View Appointment</div>
                  </a>
                <?php } ?>
                <?php if($result['commonContent']['settings']['Loyalty'] == '1') { ?>
                  <a  href="{{ URL::to('/point-transaction')}}">
                    <div class="wallet-desktop-content-menu-item"><i class="fas fa-gift  wallet-icon"></i> @lang('website.point_transaction')</div>
                  </a>
                <?php } ?>
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

          <div class="wallet-mobile-content-left add_desktop_none">
            <div class="wallet-mobile-content-left-main">
              <div class="wallet-mobile-content-menu-main">
                <a href="{{ URL::to('/profile')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-user wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a href="{{ URL::to('/shipping-address')}}">
                  <div class="wallet-mobile-content-menu-item wallet-active-mobile">
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
                  <div class="wallet-mobile-content-menu-item"> 
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
                <?php if($result['commonContent']['settings']['Loyalty'] == '1') { ?>
                  <a  href="{{ URL::to('/point-transaction')}}">
                    <div class="wallet-mobile-content-menu-item">
                      <div><i class="fas fa-gift  wallet-icon-mobile"></i></div>
                    </div>
                  </a>
                <?php } ?>
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


          <div class="shipping-desktop-content-right">
            <div  style="padding-top: 10px;margin-left:30px;">
                <h3 style="margin:10px 0px 30px 10px"><i onclick="history.back()" class="fa fa-arrow-left" style="margin-right:30px;"></i> Edit Address</h3>
                 <div class="shipping-main">

                <form name="addMyAddress" class="form-validate" enctype="multipart/form-data" action="{{ URL::to('/update-address')}}" method="post">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                    @if(!empty($result['editAddress']))
                    <input type="hidden" name="address_book_id" value="{{$result['editAddress'][0]->address_id}}">
                    @endif
                        @if( count($errors) > 0)
                          @foreach($errors->all() as $error)
                              <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">@lang('website.Error'):</span>
                                    {{ $error }}
                              </div>
                            @endforeach
                      @endif
                      @if(session()->has('error'))
                      <div class="alert alert-success">
                          {{ session()->get('error') }}
                      </div>
                    @endif
                      @if(Session::has('error'))

                          <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">@lang('website.Error'):</span>
                                {{ session()->get('error') }}
                            </div>

                      @endif
                      

                      @if(Session::has('error'))
                          <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">@lang('website.Error'):</span>
                                {!! session('loginError') !!}
                          </div>
                      @endif

                      @if(session()->has('success') )
                          <div class="alert alert-success">
                              {{ session()->get('success') }}
                          </div>
                      @endif
                      @if(Session::has('adderror'))

                    <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <span class="sr-only">@lang('website.Error'):</span>
                          {{ session()->get('adderror') }}
                      </div>

                    @else
                    @if(!empty($result['action']) and $result['action']=='update')
                       <div class="alert alert-success">

                           @lang('website.Your address has been updated successfully')
                       </div>
                   @endif


                    @endif

                

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="shipping-label" for="inputfirstname">@lang('website.First Name')</label>
                      <input type="text" name="entry_firstname" class="form-control-shipping field-validate" id="entry1_firstname" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->firstname}}" @else value="{{ old('entry_firstname') }}" @endif>
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your first name')</span>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="shipping-label"  for="inputlastname">@lang('website.Last Name')</label>
                      <input type="text" name="entry_lastname" class="form-control-shipping field-validate" rid="entry1_lastname" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->lastname}}" @else value="{{ old('entry_lastname') }}"@endif>
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your address')</span>                  </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-4 col-md-2">
                      <label class="shipping-label"  for="inputState">@lang('website.Phone')</label>
                      <?php 
                        $code = DB::table('countries')->get();
                      ?>
                      <select name="entry_cc_code" class="form-control-country-code field-validate" style="border:none !important">
                          @if(!empty($code))
                            @foreach($code as $jescode)
                              <option value="{{$jescode->country_code}}" @if($jescode->country_code == $result['editAddress'][0]->entry_cc_code) selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
                            @endforeach
                            @endif
                      </select>
                    </div>
                    <div class="form-group col-8 col-md-4">
                      <label class="shipping-label"  for="inputaddress" style="color:#fff">@lang('website.Phone')</label>
                      <input type="text" name="phone_number"  class="form-control-shipping field-validate" id="phone_number1" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->entry_phone}}" @endif onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )" maxlength="10" minlength="9">
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your valid phone number')</span>
                    </div>
                    <div class="form-group select-control-shipping col-md-6">
                      <label class="shipping-label"  for="inputState">@lang('website.Country')</label>
                      <select name="entry_country_id"  onChange="getZones();" id="entry_country_id" class="form-control-shipping field-validate">
                          <option value="{{ old('entry_country_id') }}">@lang('website.select Country')</option>
                          @foreach($result['countries'] as $countries)
                          <option value="{{$countries->countries_id}}" @if(!empty($result['editAddress'])) @if($countries->countries_id==$result['editAddress'][0]->countries_id) selected @endif @endif>{{$countries->countries_name}}</option>
                          @endforeach
                      </select>
                      <span class="help-block error-content1" hidden>@lang('website.Please select your country')</span>
                    </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                        <label class="shipping-label"  for="inputcomapnyname">@lang('website.Address')</label>
                        <input type="text"  name="entry_street_address"  class="form-control-shipping field-validate" aria-describedby="addressHelp" placeholder="House Number, Building, Street Name" id="entry1_street_address"  value="{{$result['editAddress'][0]->street}}">
                      </div>
                    </div>

                    <!-- <input type="hidden"  class="form-control-shipping" data-toggle="modal" data-target="#mapModal" name="location" id="location" aria-describedby="addressHelp" placeholder="map picker" value="{{$result['editAddress'][0]->latitude}},{{$result['editAddress'][0]->longitude}}"> -->

                    <input type="hidden" name="latitude" id="latitude" value="{{$result['editAddress'][0]->latitude}}">
                    <input type="hidden" name="longitude" id="longitude" value="{{$result['editAddress'][0]->longitude}}">

                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <div class="form-control-shipping-height">
                          <div data-toggle="modal" data-target="#mapModal" class="location-button"><i class="fa fa-plus"></i> Add Location</div>
                        </div>
                      </div>
                    </div>

                  <div class="form-row">

                    <div class="form-group select-control-shipping col-md-6">
                      <label class="shipping-label"  for="inputState">@lang('website.State')</label>
                      <select name="entry_zone_id"  id="entry_zone_id" class="form-control-shipping field-validate">
                          <option value="{{ old('entry_zone_id') }}">Others</option>
                          @if(!empty($result['zones']))
                          @foreach($result['zones'] as $zones)
                          <option value="{{$zones->zone_id}}" @if(!empty($result['editAddress'])) @if($zones->zone_id==$result['editAddress'][0]->zone_id) selected @endif @endif>{{$zones->zone_name}}</option>
                          @endforeach
                          @endif
                      </select>
                      <span class="help-block error-content6" hidden>@lang('website.Please select your state')</span>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="shipping-label" for="inputState">@lang('website.City')</label>
                      <input type="text" name="entry_city"  class="form-control-shipping field-validate" id="entry_city1" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->city}}" @endif>
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your city')</span>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="shipping-label" for="inputaddress">@lang('website.Zip/Postal Code')</label>
                      <input type="text" name="entry_postcode"  class="form-control-shipping field-validate" id="entry_postcode1" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->postcode}}" @endif onkeydown="return ( event.ctrlKey || event.altKey
                      || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                      || (95<event.keyCode && event.keyCode<106)
                      || (event.keyCode==8) || (event.keyCode==9)
                      || (event.keyCode>34 && event.keyCode<40)
                      || (event.keyCode==46) )" maxlength="10" minlength="4">
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your Zip/Postal Code')</span>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="shipping-label" for="inputaddress">Landmark ( if any )</label>
                      <input type="text" name="landmark" value="{{$result['editAddress'][0]->landmark}}" class="form-control-shipping">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group-checkbox col-md-12">
                      @if($result['editAddress'][0]->default_address != 1)
                        <input type="checkbox" name="default_set"  value="1" @if($result['editAddress'][0]->default_address == 1) checked @endif id="addr" style="margin-right:10px"> <label for="addr"><b>Set as Default Address<b></label>
                      @else
                      <input type="checkbox" style="margin-right:10px" id="addr" disabled="disabled" checked><label for="addr"><b>Set as Default Address<b></label>
                        <input  type="hidden" name="default_set"  value="1">
                      @endif
                    </div>
                  </div>
                  <div class="button" style="margin:0px 10px;">
                      <button style="width:100%;border-radius: 5px;padding: 10px;" type="submit" class="btn btn-secondary swipe-to-top">Update</button>
                  </div>
                </form>

                 </div>
              </div>

          </div>
        </div>
      </div>
      
 <!--- Mobile View --->

    </div>
  </div>
</section>




<!-- map model code start -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-modal="true">
       
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
             <div class="modal-body">
                <div class="container" style="width:100% !important">
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
                <button type="button" class="btn btn-primary" onclick="setUserLocation1()"><i class="fas fa-location-arrow"></i></button>
                <button type="button" class="btn btn-secondary" onclick="saveAddress1()">Save</button>
                </div>
            </div>
       </div>
    </div>
<!-- map modal code end -->
<script src="https://maps.googleapis.com/maps/api/js?key=<?=$result['commonContent']['settings']['google_map_api']?>&libraries=places&callback=initialize" async defer></script>

<script>



var markers;
    var myLatlng;
    var map;
    var geocoder;
   function setUserLocation1(){
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
   function saveAddress1(){
    
    var latlng = markers.getPosition();
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
      $('#mapModal').modal('hide');
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
              $("#entry_postcode1").val(postal_code);
              $("#entry1_street_address").val(street);
              $("#entry_city1").val(city);

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
					showData += ("<option value=''>Select</option>");
					for (i = 0; i < res.length; ++i) {
						var j = i + 1;
						showData += "<option value='"+res[i].zone_id+"'>"+res[i].zone_name+"</option>";
					}
					showData += ("<option value='-1'>@lang('website.Other')</option>");
					jQuery("#entry_zone_id").html(showData);
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
            lat: '3.1544586902967247',
            lng: '101.59651500860105'
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






function getZonesMob() {
		jQuery(function ($) {
			jQuery('#loader').show();
			var country_id = jQuery('#entry_country_id_mob').val();
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
					jQuery("#entry_zone_id_mob").html(showData);
					jQuery('#loader').hide();
				},
			});
		});
};



jQuery(document).on('submit', '.form-validate_mob', function(e){
  var error = "";
  jQuery(".field-validate_mob").each(function() {
      if(this.value == '') {
        jQuery(this).css('border-color', 'red');
        jQuery(this).parents(".input-group").addClass('has-error');
        jQuery(this).next(".error-content").removeAttr('hidden');
        error = "has error";
      }else{
        jQuery(this).css('border-color', '#dee2e6');
        jQuery(this).parents(".input-group").removeClass('has-error');
        jQuery(this).next(".error-content").attr('hidden', true);
      }
  });
});

</script>

@endsection
