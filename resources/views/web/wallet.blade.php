
@extends('web.layout')
@section('content')

<style>

.wallet-amount-main-height {
border: 0px solid;
overflow: hidden;
min-height: 275px;
max-height: 275px;
}
.wallet-amount-main {
border: 1px solid #fff;
text-align: center;
border-radius: 100%;
margin: 15px auto;
width: 89%;
height: 300px;
}
.wallet-table-title-normal {
border-radius: 50px;
margin: 5px;
padding: 10px;
color: #333;
font-weight: 900;
display: inline-block;
width: 45%;
}
  a:hover {
    text-decoration: none;
    color: #333 !important;
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
@media only screen and (max-width: 991px)
  {
    .profile-content .media-main .media-body .detail span {
    display: initial;
    font-size: 0.875rem;
}
.profile-content .media-main {
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
@media only screen and (max-width: 440px)
  {
    .wallet-table-content-main {
    border: 0px solid;
    -webkit-box-shadow: 0 0 7px -4px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 0 0 7px -4px rgba(0, 0, 0, 0.75);
    box-shadow: 0 0 7px -4px rgba(0, 0, 0, 0.75);
    margin-top: 20px;
    border-radius: 15px;
    padding: 10px;
    margin: 15px;
    height: 75px;
}
.wallet-header-img-right {
    width: 70%;
    display: inline-block;
    vertical-align: middle;
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
                    <div class="wallet-desktop-content-menu-item wallet-active"><i class="fa fa-google-wallet  wallet-icon"></i> Wallet</div>
                  </a>
                <?php } ?>
              </div>
            </div>

          </div>
          <div class="wallet-desktop-content-right">
            <div  style="background:#fff;padding-top: 10px;margin-left:18px;">
              <div class="wallet-head-main common-bg-lite">
                <div class="row">
                  <div class="col-md-4">
                    <h2 class="common-text">{{Session::get('symbol_left')}} {{ auth()->guard('customer')->user()->wallet_amount }} {{Session::get('symbol_right')}}</h2>
                    <h6 class="common-text">Available funds</h6>
                  </div>
                  <div class="col-md-8" style="margin: auto;text-align:right">
                    <button  style="border-radius:8px;padding:0.6rem 0.6rem !important" type="button" data-toggle="modal" data-target="#addWallet" class="btn btn-secondary swipe-to-top awallet"><i class="fa fa-plus"></i> Add Money to Wallet</button>
                    <button style="border-radius:8px" type="submit" data-toggle="modal" data-target="#myQrcode" class="btn btn-secondary swipe-to-top awallet">Pay</button>
                    <a href="{{ URL::to('/wallet_send')}}">
                      <button style="border-radius:8px"  class="btn btn-secondary swipe-to-top awallet">Send</button>
                    </a>
                  </div>
                  
                </div>
              </div><br>
                <h3 style="margin:10px 0px 30px 0px">All Transaction Details</h3>
                 <table class="order-table">
                     <thead style=" background:#585570d9;color:#fff;">
                        <tr class="">
                            <th style="border-top-left-radius:5px;text-align:left">Shop Name</th>
                            <th style="text-align:left">Withdrawal</th>
                            <th style="text-align:left">Deposit</th>
                            <th  style="text-align: center;border-top-right-radius:5px;">Status</th>
                        </tr>
                     </thead>
                      <tbody>
                        @if(count($wallet) > 0)
                        @foreach( $wallet as $jeswallet)
                         <tr class="">
                            <td><span style="font-weight: bold;font-size:1rem">{{ $jeswallet->description }}</span>
                                <div style="font-size: 11px;color:#878590;margin-top:3px;">Transaction ID:{{ $jeswallet->payment_id}}</div>
                                <div style="font-size: 11px;color:#878590;margin-top:5px;">{{date('d M, Y . h:i A', strtotime($jeswallet->created_at))}}</div>
                            </td>
                            <td style="color:#878590;">
                                @if($jeswallet->wallet_type=='withdrawal')
                                    {{Session::get('symbol_left')}} {{ $jeswallet->amount }} {{Session::get('symbol_right')}}
                                @else
                                    None
                                @endif
                            </td>
                            <td style="color:#878590;">
                                @if($jeswallet->wallet_type=='deposit')
                                    {{Session::get('symbol_left')}} {{ $jeswallet->amount }} {{Session::get('symbol_right')}}
                                @else
                                    None
                                @endif
                            </td>
                            <td style="text-align: center;">
                               @if($jeswallet->status=='2')
                                <div style="text-align: center;color: green;"><i class="fa fa-check-circle"></i></div> 
                                <div style="text-align: center;color: green;">Success</div>
                                @elseif($jeswallet->status=='3' && $jeswallet->payment_method=='banktransfer')
                                 <button id="uploadReceipt" bank_id ="{{ $jeswallet->id }}"  class="btn btn-dark awallet">Upload receipt</button>
                               @elseif($jeswallet->status=='4' && $jeswallet->payment_method=='banktransfer')
                                  <span>Reviewing...</span> 
                               @else
                                 <div style="text-align: center;color: red;"><i class="fa fa-times-circle"></i></div>
                                 <div style="text-align: center;color: red;">Decline</div>
                               @endif
                            </td>
                         </tr>
                         @endforeach
                         @else
                          <tr>
                              <td  colspan="4">No transaction is placed yet</td>
                          </tr>
                        @endif
                      </tbody>
                 </table>
                 <div class="col-xs-12" style="float:right">
                    {{$wallet->links()}}
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
                    <div class="wallet-mobile-content-menu-item wallet-active-mobile">
                      <div><i class="fa fa-google-wallet  wallet-icon-mobile"></i></div>
                    </div>
                  </a>
                <?php } ?>
              </div>
            </div>

          </div>
          <div class="profile-mobile-content-right">
            <div  style="background:#fff;margin-left:0px;">

          <div class="col-12 col-lg-9">
            <div class="wallet-mobile-main">
              <div class="wallet-header-main">
                <div class="wallet-header">
                  <div class="wallet-header-left">
                    <div class="wallet-header-left-img-main">
                      <div class="wallet-header-img-left">
                        <img class="wallet-header-left-img" src="{{ asset('images/user.png') }}" alt="">
                      </div>
                      <div class="wallet-header-img-right">
                        <div class="wallet-header-title">Good Morning</div>
                        <div class="wallet-header-name">{{ auth()->guard('customer')->user()->first_name }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="wallet-header-right">
                    <i class="fa fa-bell-o" style="font-size:1.5rem;position:relative"><div class="wallet-noti-bubble"></div></i>
                  </div>
                </div>
                <div class="wallet-amount-main-height">
                  <div class="wallet-amount-main">
                    <div class="wallet-amount-text">
                      <div class="wallet-amount-name">Available Funds</div>
                      <h2>{{Session::get('symbol_left')}} {{ auth()->guard('customer')->user()->wallet_amount }} {{Session::get('symbol_right')}} </h2>
                      <button  class="btn btn-secondary wallet-amount-button">Your wallet</button>
                    </div>
                  </div>
                </div>


                <div class="wallet-mobile-footer-button-main">
                  <div class="wallet-mobile-footer-button">
                    <div data-toggle="modal" data-target="#addWallet" class="btn  wallet-amount-footer-button awallet">
                      <img class="mobile-wallet-img" src="{{ asset('add-icon.png') }}" alt="add">
                    </div>
                    <div class="wallet-mobile-footer-button-text">Add</div>
                  </div>
                  <div class="wallet-mobile-footer-button">
                    <div data-toggle="modal" data-target="#myQrcode" class="btn  wallet-amount-footer-button awallet">
                      <img class="mobile-wallet-img1" src="{{ asset('pay-icon.png') }}" alt="pay">
                    </div>
                    <div class="wallet-mobile-footer-button-text">Pay</div>
                  </div>
                  <a href="{{ URL::to('/wallet_send')}}">
                    <div class="wallet-mobile-footer-button">
                      <div  class="btn  wallet-amount-footer-button awallet">
                        <img class="mobile-wallet-img2" src="{{ asset('send-icon.png') }}" alt="send">
                      </div>
                      <div class="wallet-mobile-footer-button-text">Send</div>
                    </div>
                  </a>
                </div>
              </div>

                <div id="material-tabs">
                  <div class="wallet-table-header">
                    <a id="tab1-tab" href="#tab1" class="wallet-table-title-normal wallet-table-title">Wallet Details</a>
                    <a id="tab2-tab" href="#tab2" class="wallet-table-title-normal">Discover</a>
                  </div>
                </div>
              <div class="tab-content">
                  <div id="tab1">
                    @if(count($wallet) > 0)
                      @foreach( $wallet as $jeswallet)
                          <div class="wallet-table-content-main">
                            <div class="wallet-table-content-left">
                              <div class="wallet-header-left-img-main">
                                <div class="wallet-header-img-left">
                                  <img class="wallet-header-left-img1" src="{{ asset('images/user.png') }}" alt="">
                                </div>
                                <div class="wallet-header-img-right">
                                  <div class="wallet-header-name1">{{ $jeswallet->description }}</div>
                                  <div class="wallet-header-title1">{{date('d M Y  h:i A', strtotime($jeswallet->created_at))}}</div>
                                </div>
                              </div>
                            </div>
                            <div class="wallet-table-content-right">
                              <div class="wallet-table-right-amount">
                                @if($jeswallet->wallet_type=='deposit')
                                  <span style="color:green">+ {{Session::get('symbol_left')}} {{ $jeswallet->amount }} {{Session::get('symbol_right')}}</span>
                                @else
                                  <span style="color:red">- {{Session::get('symbol_left')}} {{ $jeswallet->amount }} {{Session::get('symbol_right')}}</span>
                                @endif

                                @if($jeswallet->status=='2')
                                      <div style="text-align: center;color: green;"><i class="fa fa-check-circle"></i></div> 
                                      <div style="text-align: center;color: green;">Success</div>
                                      @elseif($jeswallet->status=='3' && $jeswallet->payment_method=='banktransfer')
                                      <div id="uploadReceipt" bank_id ="{{ $jeswallet->id }}" class="awallet" style="text-align: center;width: 30px;height: 30px;padding: 7px;border-radius: 50%;color: #fff;margin: auto;background:#a9a9a9;"><i class="fa fa-upload"></i></div> 

                                    @elseif($jeswallet->status=='4' && $jeswallet->payment_method=='banktransfer')
                                        <br><span>Reviewing...</span> 
                                    @else
                                      <div style="text-align: center;color: red;"><i class="fa fa-times-circle"></i></div>
                                      <div style="text-align: center;color: red;">Decline</div>
                                    @endif
                              </div>
                            </div>
                          </div>
                        @endforeach
                      @else
                      <div class="wallet-table-content-main">No transaction is placed yet</div>
                      @endif
                  </div>
                  <div id="tab2" style="text-align:center">
                      <p>Comming soon....</p>
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

<!-- deleteBannerModal -->
            <div class="modal fade" id="uploadReceiptImage" tabindex="-1" role="dialog" aria-labelledby="deleteBannerModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="border-radius: 10px;">
                        <div class="modal-header">
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
                            <h4 class="modal-title" id="deleteBannerModalLabel">Upload Bank Receipt</h4>
                        </div>

                        {!! Form::open(array('url' =>'walletBanktransfer', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('update_id',  '', array('class'=>'form-control', 'id'=>'update_id')) !!}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>@lang('website.Bank'):</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>{{@$bankdetail['bank_name'] ?: '---' }}</h5>
                                </div>

                                <div class="col-md-6">
                                    <h5>@lang('website.account_number'):</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>{{@$bankdetail['account_number'] ?: '---' }}</h5>
                                </div>

                                <div class="col-md-6">
                                    <h5>@lang('website.account_name'):</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>{{@$bankdetail['account_name'] ?: '---'  }}</h5>
                                </div>

                                <div class="col-md-6">
                                    <h5>@lang('website.short_code'):</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>{{@$bankdetail['short_code'] ?: '---'}}</h5>
                                </div>

                                <div class="col-md-6">
                                    <h5>@lang('website.iban'):</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>{{@$bankdetail['iban'] ?: '---' }}</h5>
                                </div>

                                <div class="col-md-6">
                                    <h5>@lang('website.swift'):</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>{{@$bankdetail['swift'] ?: '---'}}</h5>
                                </div>

                            </div>
                            <br>
                            <input type="file" name="bankimage" accept="image/*" required>
                        </div>
                        <div class="modal-footer" style="float: right;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="deleteBanner">Upload</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

 <!-- Modal -->
  <div class="modal fade" id="addWallet" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
          <h4 class="modal-title">Add Wallet</h4>
        </div>
        <div class="modal-body">
          {{-- <form name="updateMyProfile" class="align-items-center form-validate" enctype="multipart/form-data" action="{{ URL::to('Pay')}}" method="post">
           @csrf  --}}

            <div class="form-group row">
                   {{-- <label for="firstName" class="col-sm-2 col-form-label">Amount</label> --}}
                   <div class="col-sm-12">
                     <input type="number" required name="wamount" class="form-control field-validate" id="wamount" value="" placeholder="Amount">
                      <input type="hidden" required name="onlinetype" id="onlinetype" value="wallet">
                   </div>
                 </div>
            <div class="form-group row">
                {{-- <label for="firstName" class="col-sm-2 col-form-label"></label> --}}
               <div class="col-sm-12">
                  @foreach($result['payment_methods'] as $payment_methods)
             @if($payment_methods['active'] ==1 && $payment_methods['payment_method'] != 'cash_on_delivery')
           <div class="form-check form-check-inline">
            <input id="{{$payment_methods['payment_method']}}_label" type="radio" onClick="paymentMethodsWallet();" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}">

            <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label"><img src="{{asset('web/images/miscellaneous').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}" style="width: 55px;"></label>
           </div>
          @endif  
        @endforeach
               </div>
           </div>
           <div class="alert alert-danger alert-dismissible" id="payment_error" role="alert" style="display: none">
            <span class="sr-only">@lang('website.Error'):</span>
            <span id="payment_error-error-text"></span>
         </div>
        </div>
        <div class="modal-footer">
          <a href="{{ URL::to('/store_paytm')}}" id="pay_tm_button" class="btn btn-secondary payment_btns btn_disable"  style="display: none;border-radius:5px"  type="button">Pay</a>
          <a href="{{ URL::to('/wallet/ipaycheckout')}}" id="ipay88_button" class="btn btn-secondary payment_btns btn_disable" style="display: none;border-radius:5px">Pay</a>
          <button  id="banktransfer_button" class="btn btn-secondary payment_btns" style="display: none;border-radius:5px">Pay</button>
          <button style="border-radius:5px" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
       {{--  </form> --}}
      </div>
      
    </div>
  </div>


  <div class="modal fade" id="myQrcode" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
          <h4 class="modal-title">Qrcode</h4>
        </div>
        <div class="modal-body">
            <div style="text-align:center;">
              {!! QrCode::size(250)->generate(auth()->guard('customer')->user()->api_token); !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

 </section>
 <script type="text/javascript">
    jQuery(document).on('click', '#banktransfer_button', function(e){
      var amount= jQuery("#wamount").val();
      jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      url: '{{ URL::to("/walletBank")}}',
      type: "POST",
      data: '&amount='+amount,
      success: function (res) {
         window.location = 'wallet_thankyou';
      },

    });
    });

    //deleteTaxClassModal
    $(document).on('click', '#uploadReceipt', function(){
        var bank_id = $(this).attr('bank_id');
        $('#update_id').val(bank_id);
        $("#uploadReceiptImage").modal('show');
    });

 </script>

 <script>
  $(document).ready(function() {
		$('#material-tabs').each(function() {

				var $active, $content, $links = $(this).find('a');

				$active = $($links[0]);
				$active.addClass('wallet-table-title');

				$content = $($active[0].hash);

				$links.not($active).each(function() {
						$(this.hash).hide();
				});

				$(this).on('click', 'a', function(e) {

						$active.removeClass('wallet-table-title');
						$content.hide();

						$active = $(this);
						$content = $(this.hash);

						$active.addClass('wallet-table-title');
						$content.show();

						e.preventDefault();
				});
		});
});
</script>

 
 @endsection
