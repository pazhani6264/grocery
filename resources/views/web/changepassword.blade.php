@extends('web.layout')
@section('content')


<style>

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
  .profile-no-con-new {
    padding: 20px 10px !important;
}
@media (min-width: 992px)
{
.d-lg-flex {
    display: inline-block !important;
}
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
.profile-desktop-content-right .profile-menu-new{
  background:#fff;
  padding-top: 0px;
  margin-left:0px;
}
.profile-desktop-content-right .profile-menu-new a{ 
padding:15px 0px !important
}
.profile-desktop-content-right {
    border: 0px solid #dee2e6;
    width: 84% !important;
    display: inline-block;
    vertical-align: top;
}
.profile-no-con-new {
    padding: 20px 0px !important;
}

}




  @media screen and (max-width: 600px){

    .change-password-main {
      border: 0px solid;
      width: 100%;
      margin: auto;
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
            <div class="wallet-desktop-header-right-name">Email  : <span>{{auth()->guard('customer')->user()->email}}</span></div>
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

          <div class="wallet-mobile-content-left add_desktop_none">
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


          <div class="profile-desktop-content-right">
            <div  class="profile-menu-new">

              <div id="material-tabs" class="profile-main-tab">
                <a href="{{ URL::to('/profile')}}" class="profile-table-title-normal"><i class="fas fa-user" style="color:#9FE09A"></i> <span class="d-none d-lg-flex">@lang('website.Profile')</span></a>
                <a href="{{ URL::to('/edit_profile')}}" class="profile-table-title-normal"><i class="fas fa-user-plus" style="color:#DC6CED"></i> <span class="d-none d-lg-flex">Edit Profile</span></a>
                <a href="{{ URL::to('/phone_ver')}}" class="profile-table-title-normal"><i class="fas fa-phone" style="color:#A4D7EC"></i> <span class="d-none d-lg-flex">Phone Verification</span></a>
                <a  href="{{ URL::to('/change-password')}}" class="profile-table-title-normal profile-table-title"><i class="fas fa-unlock-alt" style="color:#CAC0ED"></i> <span class="d-none d-lg-flex">@lang('website.Change Password')</span></a>
              </div>
              <div class="tab-content" style="padding: 20px 10px !important;">
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
                <div id="tab4">

                  <div class="change-password-main">
                    <div class="change-password-img-main">
                      <img style="width:100%;height:100%" src="{{ asset('images/password.png') }}" alt="">
                    </div>
                    <div class="change-password-title">Change Password</div>
                    <div class="change-password-title1">Enter your old and new password below, <br> we're just being extra safe</div>

                    <form name="updateMyPassword" class="form-validate" enctype="multipart/form-data"  method="post">
                        @csrf

                    <div style="color:red;text-align:center"  id="passowrd-error"></div>

                    <div class="from-group mb-3">
                      <div class="col-12"> <label for="current_password">@lang('website.Current Password')</label></div>
                      <div class="input-group col-12">                          
                        <input name="current_password" type="password" class="form-control-password field-validate" id="current_password" placeholder="@lang('website.Current Password')">
                        <i class="fa fa-lock pass-icon"></i>
                      </div>
                    </div>
                    
                    <div class="from-group mb-3">
                      <div class="col-12"> <label for="password">@lang('website.New Password')</label></div>
                      <div class="input-group col-12">                             
                        <input name="new_password" type="password" class="form-control-password password" id="new_password" placeholder="@lang('website.New Password')">
                        <i class="fa fa-lock pass-icon"></i>
                      </div>
                    </div>

                    <div class="from-group mb-3">
                      <div class="col-12"> <label for="confirm_password">Re-enter Your New Password</label></div>
                      <div class="input-group col-12">                             
                        <input name="confirm_password" type="password" class="form-control-password password" id="confirm_password" placeholder="@lang('website.New Password')">
                        <i class="fa fa-lock pass-icon"></i>
                      </div>
                    </div>

                    <div class="alert alert-danger fade show" hidden id="passowrd-error" role="alert"></div>
                    <div class="col-12 col-sm-12">
                        <button style="width:100%;border-radius:5px;margin-top:10px;" id="updateMyPassword"  type="button" class="btn btn-secondary">UPDATE PASSWORD</button>                            
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

    </div>
  </section>
</div>
 </section>

 @endsection
