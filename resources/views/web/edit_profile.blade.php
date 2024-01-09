@extends('web.layout')
@section('content')

<style>
  .fa.fa-pencil:before {
    content: "\F303";
    position:absolute;
    left: 0;
    right: 0;
    top: 3px;
    bottom: 0;
  }

  @media screen and (min-width: 768px) and (max-width: 1100px){
   .edit-profile-main {
    border: 0px solid;
    width: 80% !important;
    margin: auto;
    }
  }

  @media screen and (max-width: 992px) { 

    .edit-profile-main{
      border: 0px solid;
      width: 100%;
      margin: auto;
    }

    .edit-profile-content-left {
      border: 0px solid;
      width: 100%;
      display: inline-block;
      margin-right: 0px;
    }


    .edit-profile-header-left {
      border: 0px solid;
      width: 70px;
      height: 70px;
      display: inline-block;
      vertical-align: middle;
      border-radius: 50%;
      position: relative;
      -webkit-box-shadow: 3px 19px 51px -23px rgba(0, 0, 0, 0.74);
      -moz-box-shadow: 3px 19px 51px -23px rgba(0, 0, 0, 0.74);
      box-shadow: 3px 19px 51px -23px rgba(0, 0, 0, 0.74);
    }
    .edit-profile-header-left-img-main {
      border: 0px solid;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      position: relative;
      overflow: hidden;
    }
    .edit-profile-header-right {
      border: 0px solid;
      display: inline-block;
      vertical-align: middle;
      margin-left: 10px;
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
                <a  href="{{ URL::to('/profile')}}" class="profile-table-title-normal"><i class="fas fa-user" style="color:#9FE09A"></i> @lang('website.Profile')</a>
                <a   href="{{ URL::to('/edit_profile')}}" class="profile-table-title-normal profile-table-title"><i class="fas fa-user-plus" style="color:#DC6CED"></i> Edit Profile</a>
                <a  href="{{ URL::to('/phone_ver')}}" class="profile-table-title-normal"><i class="fas fa-phone" style="color:#A4D7EC"></i> Phone Verification</a>
                <a   href="{{ URL::to('/change-password')}}" class="profile-table-title-normal"><i class="fas fa-unlock-alt" style="color:#CAC0ED"></i> @lang('website.Change Password')</a>
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
   
                <div id="tab2">

                <form name="updateMyProfile" class="align-items-center form-validate" enctype="multipart/form-data" action="{{ URL::to('updateMyProfile')}}" method="post">
                  @csrf
                    <div class="edit-profile-main">
                      <div class="edit-profile-header">
                        <div class="edit-profile-header-left">
                          <div class="edit-profile-header-left-img-main">
                            <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
                            @if($avatar == '' )
                              <img class="profile-pic" width="100%" height="100%" style="object-fit:contain;border-radius:50%;" src="{{ asset('images/user.png') }}" alt="">
                            @else
                              <img class="profile-pic" width="100%" height="100%" style="object-fit:contain;border-radius:50%;" src="{{ asset('').$avatar }}" alt="">
                            @endif
                            <div class="upload-button">
                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                            </div>
                            <input class="file-upload" type="file" name="picture" accept="image/*"/>
                            </div>
                            <i class="fa fa-pencil edit-profile-icon"></i>
                        </div>
                        <div class="edit-profile-header-right">
                          <div class="edit-profile-header-right-name">{{ auth()->guard('customer')->user()->first_name }} {{ auth()->guard('customer')->user()->last_name }}</div>
                          <div class="edit-profile-header-right-title">Member Since : {{ auth()->guard('customer')->user()->created_at }}</div>
                        </div>
                        </div>

                  

                      <div class="edit-profile-content">
                        <div class="edit-profile-content-left">
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">@lang('website.First Name')</div>
                            <input type="text" class="form-control-edit-profile" required name="customers_firstname" value="{{ auth()->guard('customer')->user()->first_name }}"/>
                          </div>
                          @if(!empty(auth()->guard('customer')->user()->dob))
                            <?php 
                              $originalDate = auth()->guard('customer')->user()->dob;
                              $newDate = date("d/m/Y", strtotime($originalDate));
                            ?>
                            <div class="edit-profile-input-main">
                              <div class="edit-profile-content-label">@lang('website.DOB')</div>
                              <input type="text" class="form-control-edit-profile" readonly name="customers_dob" value="{{ $newDate }}"/>
                            </div>
                          @else
                            <div class="edit-profile-input-main">
                              <div class="edit-profile-content-label">@lang('website.DOB')</div>
                              <input readonly name="customers_dob" type="text" id="customers_dob" data-provide="datepicker" class="form-control-edit-profile" placeholder="@lang('website.Date of Birth')" aria-label="date-picker" aria-describedby="date-picker-addon1">
                            </div>
                          @endif
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">Email</div>
                            <input type="email" class="form-control-edit-profile" value="{{ auth()->guard('customer')->user()->email }}" readonly/>
                          </div>
                        </div>
                        <div class="edit-profile-content-right">
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">@lang('website.Last Name')</div>
                              <input type="text" class="form-control-edit-profile" required name="customers_lastname" value="{{ auth()->guard('customer')->user()->last_name }}"/>
                          </div>
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">@lang('website.Gender')</div>
                              <select class="form-control-edit-profile" name="gender" required>
                                <option value="0" @if(auth()->guard('customer')->user()->gender == 0) selected @endif>@lang('website.Male')</option>
                                <option value="1"  @if(auth()->guard('customer')->user()->gender == 1) selected @endif>@lang('website.Female')</option>
                              </select>
                          </div>
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">Phone Number</div>
                            <input type="text" class="form-control-edit-profile" value="{{ auth()->guard('customer')->user()->phone }}" readonly/>
                          </div>
                      </div>
                      <div class="edit-profile-button-main">
                        <button type="submit" class="edit-profile-button btn-secondary">Save Changes</button>
                      </div>
                    </div>
                  </form>

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
                <a style="padding:15px 0px !important" href="{{ URL::to('/profile')}}" class="profile-table-title-normal"><i class="fas fa-user" style="color:#9FE09A"></i> </a>
                <a style="padding:15px 0px !important" href="{{ URL::to('/edit_profile')}}" class="profile-table-title-normal profile-table-title"><i class="fas fa-user-plus" style="color:#DC6CED"></i></a>
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
                <form name="updateMyProfile" class="align-items-center form-validate" enctype="multipart/form-data" action="{{ URL::to('updateMyProfile')}}" method="post">
                  @csrf
                    <div class="edit-profile-main">
                      <div class="edit-profile-header">
                        <div class="edit-profile-header-left">
                          <div class="edit-profile-header-left-img-main">
                            <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
                            @if($avatar == '' )
                              <img class="profile-pic" width="100%" height="100%" style="object-fit:contain;border-radius:50%;" src="{{ asset('images/user.png') }}" alt="">
                            @else
                              <img class="profile-pic" width="100%" height="100%" style="object-fit:contain;border-radius:50%;" src="{{ asset('').$avatar }}" alt="">
                            @endif
                            <div class="upload-button">
                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                            </div>
                            <input class="file-upload" type="file" name="picture" accept="image/*"/>
                          </div>
                          <i class="fa fa-pencil edit-profile-icon"></i>
                        </div>
                        <div class="edit-profile-header-right">
                          <div class="edit-profile-header-right-name">{{ auth()->guard('customer')->user()->first_name }} {{ auth()->guard('customer')->user()->last_name }}</div>
                          <div class="edit-profile-header-right-title">Member Since : {{ auth()->guard('customer')->user()->created_at }}</div>
                        </div>
                      </div>

                  

                      <div class="edit-profile-content">
                        <div class="edit-profile-content-left">
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">@lang('website.First Name')</div>
                            <input type="text" class="form-control-edit-profile" required name="customers_firstname" value="{{ auth()->guard('customer')->user()->first_name }}"/>
                          </div>

                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">@lang('website.Last Name')</div>
                            <input type="text" class="form-control-edit-profile" required name="customers_lastname" value="{{ auth()->guard('customer')->user()->last_name }}"/>
                          </div>

                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">Email</div>
                            <input type="email" class="form-control-edit-profile" value="{{ auth()->guard('customer')->user()->email }}" readonly/>
                          </div>

                          @if(!empty(auth()->guard('customer')->user()->dob))
                            <?php 
                              $originalDate = auth()->guard('customer')->user()->dob;
                              $newDate = date("d/m/Y", strtotime($originalDate));
                            ?>
                            <div class="edit-profile-input-main">
                              <div class="edit-profile-content-label">@lang('website.DOB')</div>
                              <input type="text" class="form-control-edit-profile" readonly name="customers_dob" value="{{ $newDate }}"/>
                            </div>
                          @else
                            <div class="edit-profile-input-main">
                              <div class="edit-profile-content-label">@lang('website.DOB')</div>
                                <input readonly name="customers_dob" type="text" id="customers_dob" data-provide="datepicker" class="form-control-edit-profile" placeholder="@lang('website.Date of Birth')" aria-label="date-picker" aria-describedby="date-picker-addon1">
                              </div> 
                            </div>
                          @endif
                         
                          
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">@lang('website.Gender')</div>
                              <select class="form-control-edit-profile" name="gender" required>
                                <option value="0" @if(auth()->guard('customer')->user()->gender == 0) selected @endif>@lang('website.Male')</option>
                                <option value="1"  @if(auth()->guard('customer')->user()->gender == 1) selected @endif>@lang('website.Female')</option>
                              </select>
                            </div>
                          </div>
                          <div class="edit-profile-input-main">
                            <div class="edit-profile-content-label">Phone Number</div>
                              <input type="text" class="form-control-edit-profile" value="{{ auth()->guard('customer')->user()->phone }}" readonly/>
                            </div>
                          </div>
                      </div>
                      <div class="edit-profile-button-main">
                        <button type="submit" class="edit-profile-button btn-secondary">Save Changes</button>
                      </div>
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
  /***AVATAR SCRIPT***/

function readURL(input)
{
    if(input.files && input.files[0]){
        var reader= new FileReader();
        reader.onload=function(e)
        {
            var fileurl=e.target.result;
            $('.profile-pic').attr('src',fileurl);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(".file-upload").on('change',function(){
  readURL(this);
});
$(".upload-button").on('click',function(){
  $(".file-upload").click();
});
/***AVATAR SCRIPT***/
</script>

 @endsection
