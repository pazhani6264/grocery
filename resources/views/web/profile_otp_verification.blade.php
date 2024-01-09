@extends('web.layout')
@section('content')

<style>
  @media screen and (min-width: 768px) and (max-width: 1100px){

    .otp-form-input {
        margin: 7px;
        height: 42px;
        width: 42px;
        border-top: 0px solid;
        border-bottom: 2px solid #E8E8E8;
        border-left: 0px solid;
        border-right: 0px solid;
        border-radius: 0px;
        text-align: center;
        font-size: 2rem;
        background: #fff;
        outline: none;
        padding: 0px;
    }
  }
  input[type=text]:focus {
    border-bottom: 2px solid #CACACA;
  }

  @media screen and (max-width: 992px){

  .profile-otp-button {
    border: 0px solid;
    border-radius: 8px;
    padding: 12px 20px;
    font-size: 1rem;
    color: #fff;
    font-weight: 500;
    letter-spacing: 0.5px;
    margin-top: 20px;
    cursor: pointer;
    width: 50%;
    margin-bottom: 20px;
  }
  .otp-form-input {
        margin: 7px;
        height: 42px;
        width: 35px;
        border-top: 0px solid;
        border-bottom: 2px solid #E8E8E8;
        border-left: 0px solid;
        border-right: 0px solid;
        border-radius: 0px;
        text-align: center;
        font-size: 2rem;
        background: #fff;
        outline: none;
        padding: 0px;
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



<div class="container-fuild">
  <nav aria-label="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
        <li class="breadcrumb-item active" aria-current="page">@lang('website.myProfile')</li>

      </ol>
    </div>
  </nav>
</div> 
<section class="pro-content"  style="padding-top:10px;">
<!-- Profile Content -->
<section class="profile-content">
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
            <div class="wallet-desktop-header-right-name">Email  : <span>{{auth()->guard('customer')->user()->email}}</span></div>
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
                  <div class="wallet-desktop-content-menu-item wallet-active"><i class="fas fa-user wallet-icon"></i> @lang('website.Profile')</div>
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
          <div class="profile-desktop-content-right">
            <div  style="background:#fff;padding-top: 10px;margin-left:18px;">
              
              <div id="material-tabs" class="profile-main-tab">
                <a href="{{ URL::to('/profile')}}" class="profile-table-title-normal"><i class="fas fa-user" style="color:#9FE09A"></i> @lang('website.Profile')</a>
                <a href="{{ URL::to('/edit_profile')}}" class="profile-table-title-normal"><i class="fas fa-user-plus" style="color:#DC6CED"></i> Edit Profile</a>
                <a href="{{ URL::to('/phone_ver')}}" class="profile-table-title-normal profile-table-title"><i class="fas fa-phone" style="color:#A4D7EC"></i> Phone Verification</a>
                <a  href="{{ URL::to('/change-password')}}" class="profile-table-title-normal"><i class="fas fa-unlock-alt" style="color:#CAC0ED"></i> @lang('website.Change Password')</a>
              </div>
              <div class="tab-content" style="padding: 20px 0px !important;">
                @if(session()->has('success') )
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session()->get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif

                @if(session()->has('error') )
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session()->get('error') }}
                  </div>
                @endif     
                <div id="tab3">

                

                  <div class="profile-otp-header">
                    <i onclick="history.back()" class="fa fa-arrow-left" style="font-size:1.5rem;cursor:pointer"></i>
                  </div>



                  <form id="ajaxFormOtpVer" style="padding:0px !important" name="signup" enctype="multipart/form-data" action="{{ URL::to('/update_otp_profile')}}" method="post">
                  {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$result['user_data']->user_id}}" id="id">
                    <input type="hidden" name="ccode" value="{{$result['user_data']->ccode}}" id="ccode">
                    <input type="hidden" name="phone" value="{{$result['user_data']->phone}}" id="phone">


                    <div class="profile-otp-main">
                      <div class="profile-otp-title">Please enter the One-Time Password to<br>Verify your phone number</div>

                      <div class="profile-otp-content">A One-Time Password send has been sent to <br> {{ $result['user_data']->ccode }}{{ $result['user_data']->phone }} </div>

                      
                    <div id="error_otp"></div>
                      
                      <div class="userInput">
                        <input class="otp-form-input" name="otp1" type="text" id='ist' maxlength="1" onkeyup="clickEvent(this,'sec')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp2" type="text" id="sec" maxlength="1" onkeyup="clickEvent(this,'third')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp3" type="text" id="third" maxlength="1" onkeyup="clickEvent(this,'fourth')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp4" type="text" id="fourth" maxlength="1" onkeyup="clickEvent(this,'fifth')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp5" type="text" id="fifth" maxlength="1" onkeyup="clickEvent(this,'sixth')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp6" type="text" id="sixth" maxlength="1" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                      </div>

                      <?php 
                           $ipaddress = '';
                           if (getenv('HTTP_CLIENT_IP'))
                               $ipaddress = getenv('HTTP_CLIENT_IP');
                           else if(getenv('HTTP_X_FORWARDED_FOR'))
                               $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                           else if(getenv('HTTP_X_FORWARDED'))
                               $ipaddress = getenv('HTTP_X_FORWARDED');
                           else if(getenv('HTTP_FORWARDED_FOR'))
                               $ipaddress = getenv('HTTP_FORWARDED_FOR');
                           else if(getenv('HTTP_FORWARDED'))
                              $ipaddress = getenv('HTTP_FORWARDED');
                           else if(getenv('REMOTE_ADDR'))
                               $ipaddress = getenv('REMOTE_ADDR');
                           else
                               $ipaddress = 'UNKNOWN';
                               $date = date('Y-m-d');
  
                            $user_id = DB::table('user_ip')->where('user_ip', $ipaddress)->where('user_id', $result['user_data']->user_id)->whereDate('created_at','=',$date)->get();
                            $count = count($user_id);
                           
                          if($count < 5)
                          {
                      ?>

                  <div style="color:red;font-size:1rem;text-align:center" id="otpres"></div>

                        <button type="button" id="btn_dis" class="profile-otp-button btn-secondary">Validate</button>
                        <a style="color:#fff" href="{{ URL::to('/profile_resendotp_verification/' . $result['user_data']->user_id . '/' . $result['user_data']->phone )}}">
                          <div style="margin:20px auto;" class="profile-otp-button btn-secondary" id="link_dis">
                            @lang('website.Resend otp')
                          </div>
                        </a>
                        <div class="profile-otp-timer"><span id="timer"></span></div>

                      <?php } else { ?>
                        <span class="profile-otp-button btn-secondary" style="display: inline-block;" id="" onclick="error_otp()">
                          @lang('website.Resend otp')
                      </span>  
                      <?php } ?>

                    </div>
                  </form>

                </div>
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
                  <div class="wallet-mobile-content-menu-item wallet-active-mobile">
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
              
              <div id="material-tabs" class="profile-main-tab">
                <a style="padding:15px 0px !important" href="{{ URL::to('/profile')}}" class="profile-table-title-normal"><i class="fas fa-user" style="color:#9FE09A"></i> </a>
                <a style="padding:15px 0px !important" href="{{ URL::to('/edit_profile')}}" class="profile-table-title-normal "><i class="fas fa-user-plus" style="color:#DC6CED"></i></a>
                <a style="padding:15px 0px !important" href="{{ URL::to('/phone_ver')}}" class="profile-table-title-normal profile-table-title"><i class="fas fa-phone" style="color:#A4D7EC"></i> </a>
                <a style="padding:15px 0px !important" href="{{ URL::to('/change-password')}}" class="profile-table-title-normal"><i class="fas fa-unlock-alt" style="color:#CAC0ED"></i></a>
              </div>
              <div class="tab-content" style="padding: 20px 0px !important;">
                @if(session()->has('success') )
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session()->get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif

                @if(session()->has('error') )
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session()->get('error') }}
                  </div>
                @endif     
                <div id="tab1">
                 

                  <form id="mobajaxFormOtpVer" style="padding:0px !important" action="{{ URL::to('/update_otp_profile')}}"  name="signup" enctype="multipart/form-data" method="post">
                  {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$result['user_data']->user_id}}" id="id">
                    <input type="hidden" name="ccode" value="{{$result['user_data']->ccode}}" id="ccode">
                    <input type="hidden" name="phone" value="{{$result['user_data']->phone}}" id="phone">

                    <div class="profile-otp-main">
                      <div class="profile-otp-title">Please enter the One-Time Password to Verify your phone number</div>
                      <div class="profile-otp-content">A One-Time Password send has been sent to {{ $result['user_data']->ccode }}{{ $result['user_data']->phone }} </div>
                      <div id="error_otp"></div>
                      
                      <div class="userInput">
                        <input class="otp-form-input" name="otp1" type="text" id='mobist' maxlength="1" onkeyup="mobclickEvent(this,'mobsec')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp2" type="text" id="mobsec" maxlength="1" onkeyup="mobclickEvent(this,'mobthird')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp3" type="text" id="mobthird" maxlength="1" onkeyup="mobclickEvent(this,'mobfourth')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp4" type="text" id="mobfourth" maxlength="1" onkeyup="mobclickEvent(this,'mobfifth')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp5" type="text" id="mobfifth" maxlength="1" onkeyup="mobclickEvent(this,'mobsixth')" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                        <input class="otp-form-input" name="otp6" type="text" id="mobsixth" maxlength="1" required onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )">
                      </div>

                      <?php 
                           $ipaddress = '';
                           if (getenv('HTTP_CLIENT_IP'))
                               $ipaddress = getenv('HTTP_CLIENT_IP');
                           else if(getenv('HTTP_X_FORWARDED_FOR'))
                               $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                           else if(getenv('HTTP_X_FORWARDED'))
                               $ipaddress = getenv('HTTP_X_FORWARDED');
                           else if(getenv('HTTP_FORWARDED_FOR'))
                               $ipaddress = getenv('HTTP_FORWARDED_FOR');
                           else if(getenv('HTTP_FORWARDED'))
                              $ipaddress = getenv('HTTP_FORWARDED');
                           else if(getenv('REMOTE_ADDR'))
                               $ipaddress = getenv('REMOTE_ADDR');
                           else
                               $ipaddress = 'UNKNOWN';
                               $date = date('Y-m-d');
  
                            $user_id = DB::table('user_ip')->where('user_ip', $ipaddress)->where('user_id', $result['user_data']->user_id)->whereDate('created_at','=',$date)->get();
                            $count = count($user_id);
                           
                          if($count <= 5)
                          {
                      ?>

                      <div style="color:red;font-size:1rem;text-align:center" id="mobotpres"></div>

                        <button type="button" id="btn_dis_mob" class="profile-otp-button btn-secondary">Validate</button>
                        <a style="color:#fff" href="{{ URL::to('/profile_resendotp_verification/' . $result['user_data']->user_id . '/' . $result['user_data']->phone )}}">
                          <div style="margin:20px auto;" class="profile-otp-button btn-secondary" id="link_dis_mob">
                            @lang('website.Resend otp')
                          </div>
                        </a>
                        <div class="profile-otp-timer"><span id="mobiletimer"></span></div>

                      <?php } else { ?>
                        <span class="profile-otp-button btn-secondary" id=""  style="display: inline-block;" onclick="error_otp()">
                          @lang('website.Resend otp')
                      </span>  
                      <?php } ?>

                    </div>
                  </form>

                </div>
             
              </div>

            </div>
          </div>
        </div>

      </div>

     </div>

    </div>
  </section>
</div>
 </section>

<script>
  function clickEvent(first,last){
    if(first.value.length){
      document.getElementById(last).focus();
    }
	}

  function mobclickEvent(first,last){
    if(first.value.length){
      document.getElementById(last).focus();
    }
	}
</script>

<script>

function error_otp()
  {
    var content='';

    content +='<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    content +='<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
    content +='<span class="">@lang('website.error'):</span>';
    content +='“Tried many times “ please try again later.';
    content +='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    content +='<span aria-hidden="true">&times;</span>';
    content +=' </button>';
    content +='</div>';

    $("#error_otp").html(content);
   
  }

let timerOn = true;
$("#link_dis").hide();
$("#link_dis_mob").hide();

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = 'Resend OTP in '+m + ':' + s;
  document.getElementById('mobiletimer').innerHTML = 'Resend OTP in '+m + ':' + s;

  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  $("#link_dis").show();
  $("#link_dis_mob").show();

  $("#btn_dis").hide();
  $("#btn_dis_mob").hide();

}

timer(60);
</script>

<script>
  jQuery("#btn_dis").click(function(){ 
    var id = jQuery("#id").val();
    var ccode = jQuery("#ccode").val();
    var phone = jQuery("#phone").val();
    var ist = jQuery("#ist").val();
    var sec = jQuery("#sec").val();
    var third = jQuery("#third").val();
    var fourth = jQuery("#fourth").val();
    var fifth = jQuery("#fifth").val();
    var sixth = jQuery("#sixth").val();
    jQuery(function ($) {
      jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: '{{ URL::to("/ck_otp_isvalid")}}',
        type: "POST",
        data: 'id='+id+'&ccode='+ccode+'&phone='+phone+'&otp1='+ist+'&otp2='+sec+'&otp3='+third+'&otp4='+fourth+'&otp5='+fifth+'&otp6='+sixth,
        beforeSend: function() {
            $('#otpres').html('loading ...');
        },
        success: function (res) {
          if(res == '1'){
              message = "Invalid OTP";
              jQuery('#otpres').text(message);
              return false;
          } else if(res == '2'){
            $("#ajaxFormOtpVer").submit();
          }
        },
      });
    });
  });
 </script>



<script>
  jQuery("#btn_dis_mob").click(function(){ 
    var id = jQuery("#id").val();
    var ccode = jQuery("#ccode").val();
    var phone = jQuery("#phone").val();
    var ist = jQuery("#mobist").val();
    var sec = jQuery("#mobsec").val();
    var third = jQuery("#mobthird").val();
    var fourth = jQuery("#mobfourth").val();
    var fifth = jQuery("#mobfifth").val();
    var sixth = jQuery("#mobsixth").val();
    jQuery(function ($) {
      jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: '{{ URL::to("/ck_otp_isvalid")}}',
        type: "POST",
        data: 'id='+id+'&ccode='+ccode+'&phone='+phone+'&otp1='+ist+'&otp2='+sec+'&otp3='+third+'&otp4='+fourth+'&otp5='+fifth+'&otp6='+sixth,
        beforeSend: function() {
            $('#mobotpres').html('loading ...');
        },
        success: function (res) {
          if(res == '1'){
              message = "Invalid OTP";
              jQuery('#mobotpres').text(message);
              return false;
          } else if(res == '2'){
            $("#mobajaxFormOtpVer").submit();
          }
        },
      });
    });
  });
 </script>


 @endsection
