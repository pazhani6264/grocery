@extends('web.layout')
@section('content')

<style>

@media only screen and (max-width: 768px) and (max-width: 1100px){
  .order-table tbody tr {
    display: flex;
    flex-direction: initial;
    }
    .point-desktop-content-right {
        border: 0px solid #dee2e6;
        width: 75%;
        display: inline-block;
        vertical-align: top;
    }
    .tb2{
      width:220px;
    }
  }

    @media screen and (max-width: 600px){

      .point-desktop-content-right {
        border: 0px solid #dee2e6;
        width: 75%;
        display: inline-block;
        vertical-align: top;
    }

    .order-table tbody tr {
        display: flex;
        flex-direction: column !important;
      }
      .tb2{
        width:100%;
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
            <li class="breadcrumb-item active" aria-current="page">@lang('website.My_point_transaction')</li>
          </ol>
      </div>
    </nav>
</div> 

     <!--My Order Content -->
     <section class="order-one-content pro-content profile-content"  style="padding-top:10px;">
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
          <div class="point-desktop-content-right">
            <div  style="background:#fff;padding-top: 10px;margin-left:18px;">
              <h3 style="margin:10px 0px 30px 0px;text-align:center">Point Transactions</h3>
              <div class="point-table-main">
                @if(count($result['orders']) > 0)
                  @foreach( $result['orders'] as $orders)
                    <table class="point-table">
                      <tbody>
                        <tr>
                          <td style="width:20px">
                            <div class="point-up-down-main">
                              @if($orders->points_status=='in')
                                <i class="fa fa-upload"></i>
                              @else
                                <i class="fa fa-download"></i>
                              @endif
                            </div>
                          </td>
                          <td style="width: 250px;padding: 20px 0px !important;">
                            <div class="point-table-name">{{$orders->description}}</div>
                            <div class="point-table-date">{{ date('d/m/Y h:i a', strtotime($orders->created_at))}}</div>
                          </td>
                          <td style="font-size: 1.3rem;color:#A7A7A7;width: 180px;">ID 000{{$orders->id}}</td>
                          <td style="width:120px">
                            @if($orders->points_status=='in')
                              <span style="color: #1cde05;font-size:1rem">+ {{$orders->points}} Pts</span>
                            @else
                              <span style="color: red;font-size:1rem">- {{$orders->points}} Pts</span>
                            @endif
                          </td>
                          <td><span class="point-badge">Approved</span></td>
                        </tr>
                      </tbody>
                    </table>
                  @endforeach
                @else
                  <table>
                    <tbody>
                      <tr>
                        <td colspan="5">@lang('website.No order is placed yet')
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
            <div  style="background:#fff;padding-top: 0px;">
              <h3 style="margin:0px 0px 30px 0px;text-align:center">Point Transactions</h3>
              <div class="point-table-main">
                
                  <table class="table order-table">
                    <tbody>
                      @if(count($result['orders']) > 0)
                      @foreach( $result['orders'] as $orders)
                      <tr class="point-table">
                          <td>
                            <div class="point-up-down-main">
                              @if($orders->points_status=='in')
                                <i class="fa fa-upload"></i>
                              @else
                                <i class="fa fa-download"></i>
                              @endif
                            </div>
                          </td>
                          <td class="tb2">
                            <div style="width:100%;display:block" class="point-table-name">{{$orders->description}}</div>
                            <div style="width:100%;display:block" class="point-table-date">{{ date('d/m/Y h:i a', strtotime($orders->created_at))}}</div>
                          </td>
                          <td style="font-size: 1.3rem;color:#A7A7A7;">ID 000{{$orders->id}}</td>
                          <td>
                            @if($orders->points_status=='in')
                              <span style="color: #1cde05;font-size:1rem">+ {{$orders->points}} Pts</span>
                            @else
                              <span style="color: red;font-size:1rem">- {{$orders->points}} Pts</span>
                            @endif
                          </td>
                          <td><span class="point-badge">Approved</span></td>
                        </tr>
                      @endforeach
                      @else
                          <tr>
                              <td colspan="4">@lang('website.No order is placed yet')
                              </td>
                          </tr>
                      @endif
                    </tbody>
                  </table>
                
                
              </div>
            </div>
          </div>

        </div>

      </div>

        </div>
      </div>
    </section>

@endsection
