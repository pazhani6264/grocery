@extends('web.layout')
@section('content')
<style>
  .logo_new_style_outer {
    width: 125px !important;
    height: 62px;
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
<section class="pro-content" style="padding-top:10px;">
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
                <a  href="{{ URL::to('/profile')}}" class="profile-table-title-normal profile-table-title"><i class="fas fa-user" style="color:#9FE09A"></i> @lang('website.Profile')</a>
                <a href="{{ URL::to('/edit_profile')}}" class="profile-table-title-normal"><i class="fas fa-user-plus" style="color:#DC6CED"></i> Edit Profile</a>
                <a  href="{{ URL::to('/phone_ver')}}" class="profile-table-title-normal"><i class="fas fa-phone" style="color:#A4D7EC"></i> Phone Verification</a>
                <a  href="{{ URL::to('/change-password')}}" class="profile-table-title-normal"><i class="fas fa-unlock-alt" style="color:#CAC0ED"></i> @lang('website.Change Password')</a>
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
                <div id="tab1">
                  <div class="profile-view-main">
                    <div class="profile-view-main-left">
                      <div class="profile-view-main-left-image-main">
                        <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
                        @if($avatar == '' )
                          <img class="profile-view-main-left-image" src="{{ asset('images/user.png') }}" alt="">
                        @else
                          <img class="profile-view-main-left-image"  src="{{ asset('').$avatar }}" alt="">
                        @endif
                      </div>
                      <div class="profile-view-main-left-title">{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}}</div>
                      <div class="profile-view-main-left-title1">{{auth()->guard('customer')->user()->email}}</div>
                    </div>
                    <div class="profile-view-main-right">
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-main-table-first-left">First Name</div>
                        <div class="profile-wiew-colon">:</div>
                        <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->first_name}}</div>
                      </div>
                      <div class="profile-view-main-table-second">
                        <div class="profile-view-main-table-first-left">Last Name</div>
                        <div class="profile-wiew-colon">:</div>
                        <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->last_name}}</div>
                      </div>
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-main-table-first-left">Email</div>
                        <div class="profile-wiew-colon">:</div>
                        <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->email}}</div>
                      </div>
                      <div class="profile-view-main-table-second">
                        <div class="profile-view-main-table-first-left">Gender</div>
                        <div class="profile-wiew-colon">:</div>
                        @if(auth()->guard('customer')->user()->gender == 0)
                          <div class="profile-view-main-table-first-right">Male</div>
                        @else
                          <div class="profile-view-main-table-first-right">Female</div>
                        @endif
                      </div>
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-main-table-first-left">Contact</div>
                        <div class="profile-wiew-colon">:</div>
                        <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->country_code}}{{auth()->guard('customer')->user()->phone}}</div>
                      </div>
                      <div class="profile-view-main-table-second">
                        <div class="profile-view-main-table-first-left">DOB</div>
                        <div class="profile-wiew-colon">:</div>
                        <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->dob}}</div>
                      </div>
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-main-table-first-left">Status</div>
                        <div class="profile-wiew-colon">:</div>
                        @if(auth()->guard('customer')->user()->status == 1)
                          <div class="profile-view-main-table-first-right">Active</div>
                        @else
                          <div class="profile-view-main-table-first-right">Inactive</div>
                        @endif
                      </div>
                    </div>
                  </div>
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
                <a style="padding:15px 0px !important" href="{{ URL::to('/profile')}}" class="profile-table-title-normal profile-table-title"><i class="fas fa-user" style="color:#9FE09A"></i> </a>
                <a style="padding:15px 0px !important" href="{{ URL::to('/edit_profile')}}" class="profile-table-title-normal"><i class="fas fa-user-plus" style="color:#DC6CED"></i></a>
                <a style="padding:15px 0px !important" href="{{ URL::to('/phone_ver')}}" class="profile-table-title-normal"><i class="fas fa-phone" style="color:#A4D7EC"></i> </a>
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
                  <h2 style="text-align:center">My Profile</h2>
                  <div class="profile-view-main">
                    <div class="profile-view-main-left">
                      <div class="profile-view-main-left-image-main">
                        <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
                        @if($avatar == '' )
                          <img class="profile-view-main-left-image" src="{{ asset('images/user.png') }}" alt="">
                        @else
                          <img class="profile-view-main-left-image"  src="{{ asset('').$avatar }}" alt="">
                        @endif
                      </div>
                      <div class="profile-view-main-left-title">{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}}</div>
                      <div class="profile-view-main-left-title1">{{auth()->guard('customer')->user()->email}}</div>
                    </div>
                    <div class="profile-view-main-right">
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-min-first-left">
                          <div class="profile-view-main-table-first-left">First Name</div>
                          <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->first_name}}</div>
                        </div>
                        <div class="profile-view-min-first-right">
                            <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                      <div class="profile-view-main-table-second">
                        <div class="profile-view-min-first-left">
                          <div class="profile-view-main-table-first-left">Last Name</div>
                          <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->last_name}}</div>
                        </div>
                        <div class="profile-view-min-first-right">
                            <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-min-first-left">
                          <div class="profile-view-main-table-first-left">Email</div>
                          <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->email}}</div>
                        </div>
                        <div class="profile-view-min-first-right">
                            <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                      <div class="profile-view-main-table-second">
                        <div class="profile-view-min-first-left">
                          <div class="profile-view-main-table-first-left">Gender</div>
                          @if(auth()->guard('customer')->user()->gender == 0)
                            <div class="profile-view-main-table-first-right">Male</div>
                          @else
                            <div class="profile-view-main-table-first-right">Female</div>
                          @endif
                        </div>
                        <div class="profile-view-min-first-right">
                            <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-min-first-left">
                          <div class="profile-view-main-table-first-left">Contact</div>
                          <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->country_code}}{{auth()->guard('customer')->user()->phone}}</div>
                        </div>
                        <div class="profile-view-min-first-right">
                            <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                      <div class="profile-view-main-table-second">
                        <div class="profile-view-min-first-left">
                          <div class="profile-view-main-table-first-left">DOB</div>
                          <div class="profile-view-main-table-first-right">{{auth()->guard('customer')->user()->dob}}</div>
                        </div>
                        <div class="profile-view-min-first-right">
                            <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                      <div class="profile-view-main-table-first">
                        <div class="profile-view-min-first-left">
                          <div class="profile-view-main-table-first-left">Status</div>
                          @if(auth()->guard('customer')->user()->status == 1)
                            <div class="profile-view-main-table-first-right">Active</div>
                          @else
                            <div class="profile-view-main-table-first-right">Inactive</div>
                          @endif
                        </div>
                        <div class="profile-view-min-first-right">
                            <i class="fa fa-angle-right"></i>
                        </div>
                      </div>
                    </div>
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
