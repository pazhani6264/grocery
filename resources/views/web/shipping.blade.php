@extends('web.layout')
@section('content')

<style>

.media-main {
margin-bottom: 30px;
}

.shipping-add-main {
    border: 0.24rem dotted #EEEEEE;
    width: 192px;
    margin-top: 16px;
    height: 192px;
    display: inline-block;
    border-radius: 4px;
    background: #fff;
    padding: 35px;
    vertical-align: top;
    margin-right: 10px;
    padding-top: 40px;
}
.shipping-view-main {
    width: 192px;
    margin-top: 16px;
    height: 192px;
    display: inline-block;
    background: #fff;
    padding: 10px;
    vertical-align: top;
    margin: 16px 10px 0px 0px;
    background: #E5FBF5;
    position: relative;
    cursor: pointer;
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


@media screen and (max-width:600px){
  
  .shipping-add-main {
  border: 0.24rem dotted #EEEEEE;
  width: 100%;
  margin-top: 16px;
  display: inline-block;
  border-radius: 4px;
  background: #fff;
  padding: 25px;
  vertical-align: top;
  margin-right: 0px;
  }

  .shipping-view-main {
border: 1px solid #c96;
width: 100%;
margin-top: 16px;
display: inline-block;
background: #fff;
padding: 10px;
vertical-align: top;
margin: 16px 0px 0px 0px;
background: #E5FBF5;
position: relative;
cursor: pointer;
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
<section class="shipping-content pro-content" style="padding-top:10px;">
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
          <div class="shipping-desktop-content-right">
            <div  style="padding-top: 10px;margin-left:30px;">
                <h3 style="margin:10px 0px 30px 0px">Select Delivery Address</h3>
                 <div class="shipping-main">
                  <div class="shipping-title">Select or add an address</div>

                  <a href="{{ URL::to('/add_shipping')}}">
                    <div class="shipping-add-main">
                      <div class="shipping-add-imag-main">
                        <img width="100%" height="100%" style="object-fit:contain" src="{{ asset('images/mailbox.png') }}" alt="">
                      </div>
                      <div class="shipping-add-name">Add new address</div>
                    </div>
                  </a>

                  @if(!empty($result['address']) and count($result['address'])>0)
                    @foreach($result['address'] as $key=>$address_data)
                     <?php 
                        $address = $address_data->street.','.$address_data->city.','.$address_data->zone_name;
                     ?>
                      <div class="shipping-view-main">
                        @if($address_data->default_address == 1)
                          <div class="title-card1"><i class="fa fa-tick"></i></div>
                        @endif
                        <div class="default_address" address_id="{{$address_data->address_id}}">
                          <div class="shipping-view-main-title"><b>Address {{ $key + 1}} @if($address_data->default_address == 1) <span style="font-size:13px">(Default)</span>@endif</b></div>
                          <div class="shipping-view-main-addr-main">
                            <div class="shipping-view-main-addr-cont">{{$address_data->firstname}} {{$address_data->lastname}}</div>
                            <div class="shipping-view-main-addr-cont">
                              <?php 
                                if (strlen($address) > 60)
                                {
                                    echo substr($address, 0, 60)."..";
                                }
                                else
                                {
                                    echo $address;
                                }
                              ?>
                            </div>
                            <div class="shipping-view-main-addr-cont">{{$address_data->country_name}} - {{$address_data->postcode}}</div>
                          </div>
                          <div class="shipping-view-main-addr-phone">Mobile : {{$address_data->entry_cc_code}} {{$address_data->entry_phone}}</div>
                        </div>
                        <div class="shipping-view-main-addr-button">
                          <?php if($address_data->default_address !=1){ ?>
                            <a style="color:#5a5e5e; !important" href="{{url('delete-address')}}/{{$address_data->address_id}}" ><i class="fa fa-trash" style="margin-right:15px"> Remove</i> </a>
                          <?php } ?>
                          <a style="color:#5a5e5e; !important" href="{{ URL::to('/edit_shipping?address_id='.$address_data->address_id)}}"> <i class="fa fa-pencil"> Edit</i></a> 
                        </div>
                      </div>
                    @endforeach
                  @endif

                 </div>
              </div>

          </div>
        </div>
      </div>
      

      <!--- Mobile view --->

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
                  <div class="wallet-mobile-content-menu-item  wallet-active-mobile">
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
          <div class="profile-mobile-content-right">
            <div  style="background:#fff;margin-left:0px;">

              <div class="col-12 col-lg-9 ">
                  <div class="heading mobile-mt-10">
                      <h2>
                      Select Delivery Address
                      </h2>
                      <hr >
                    </div>
                    
              <div style="margin-bottom:20px">
                 <div class="shipping-main">
                  <div class="shipping-title">Select or add an address</div>

                  <a href="{{ URL::to('/add_shipping')}}">
                    <div class="shipping-add-main">
                      <div class="shipping-add-imag-main">
                        <img width="100%" height="100%" style="object-fit:contain" src="{{ asset('images/mailbox.png') }}" alt="">
                      </div>
                      <div class="shipping-add-name">Add new address</div>
                    </div>
                  </a>

                  @if(!empty($result['address']) and count($result['address'])>0)
                    @foreach($result['address'] as $key=>$address_data)
                     <?php 
                        $address = $address_data->street.','.$address_data->city.','.$address_data->zone_name;
                     ?>
                      <div class="shipping-view-main">
                        @if($address_data->default_address == 1)
                          <div class="title-card1"><i class="fa fa-tick"></i></div>
                        @endif
                        <div class="default_address" address_id="{{$address_data->address_id}}">
                          <div class="shipping-view-main-title"><b>Address {{ $key + 1}} @if($address_data->default_address == 1) <span style="font-size:13px">(Default)</span>@endif</b></div>
                          <div class="shipping-view-main-addr-main">
                            <div class="shipping-view-main-addr-cont">{{$address_data->firstname}} {{$address_data->lastname}}</div>
                            <div class="shipping-view-main-addr-cont">
                              <?php 
                                if (strlen($address) > 60)
                                {
                                    echo substr($address, 0, 60)."..";
                                }
                                else
                                {
                                    echo $address;
                                }
                              ?>
                            </div>
                            <div class="shipping-view-main-addr-cont">{{$address_data->country_name}} - {{$address_data->postcode}}</div>
                          </div>
                          <div class="shipping-view-main-addr-phone">Mobile : {{$address_data->entry_cc_code}} {{$address_data->entry_phone}}</div>
                        </div>
                        <div class="shipping-view-main-addr-button">
                          <?php if($address_data->default_address !=1){ ?>
                            <a style="color:#5a5e5e; !important" href="{{url('delete-address')}}/{{$address_data->address_id}}" ><i class="fa fa-trash" style="margin-right:15px"> Remove</i> </a>
                          <?php } ?>
                          <a style="color:#5a5e5e; !important" href="{{ URL::to('/edit_shipping?address_id='.$address_data->address_id)}}"> <i class="fa fa-pencil"> Edit</i></a> 
                        </div>
                      </div>
                    @endforeach
                  @endif

                 </div>
              </div>
                  
                  
                </div>
                <!-- ............the end..... -->
              </div>
    </div>
  </div>
</section>


@endsection
