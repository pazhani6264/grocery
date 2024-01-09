@extends('web.layout')
@section('content')
<style>
.logo_new_style_outer
{
    width: 125px !important;
    height:40px !important;
}
th{
  font-size:14px;
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


@media screen and (min-width: 700px) and (max-width: 800px){
  .order-detail-main {
  border: 0px solid;
  padding: 0px 0px 0px 0px;
  }

  .shipping-desktop-content-right {
border: 0px solid #dee2e6;
width: 100%;
display: inline-block;
vertical-align: top;
}
.order-detail-main-left {
border: 0px solid;
width: 62%;
display: inline-block;
vertical-align: top;
}
.order-detail-main-customer-info {
border: 1px solid #dee2e6;
width: 48%;
max-width: 48%;
display: inline-block;
padding: 10px 15px;
margin-right: 6px;
border-radius: 6px;
vertical-align: top;
margin-bottom:10px;
}

.order-detail-main-billing-info {
border: 1px solid #dee2e6;
width: 48%;
max-width: 48%;
display: inline-block;
padding: 10px 15px;
border-radius: 6px;
vertical-align: top;
}

.w-status {
width: 100%;
font-size: 0.85rem;
float: right;
padding: 7px 10px;
}

}

@media screen and (max-width:600px){

  .order-detail-main-left {
    border: 0px solid;
    width: 100%;
    display: inline-block;
    vertical-align: top;
  }
  .order-detail-main {
border: 0px solid;
padding: 0px 0px 20px 0px;
}
.shipping-desktop-content-right {
border: 0px solid #dee2e6;
width: 100%;
display: inline-block;
vertical-align: top;
}

.order-detail-main-customer-info {
border: 1px solid #dee2e6;
width: 100%;
max-width: 100%;
display: inline-block;
padding: 10px 15px;
margin-right: 6px;
border-radius: 6px;
vertical-align: top;
margin-bottom:20px;
}

.order-detail-main-billing-info {
border: 1px solid #dee2e6;
width: 100%;
max-width: 100%;
display: inline-block;
padding: 10px 15px;
border-radius: 6px;
vertical-align: top;
}

.order-detail-main-right {
border: 0px solid;
width: 100%;
display: inline-block;
vertical-align: top;
margin-left: 0px;
}
.order-detail-payment-mode {
border: 1px solid #dee2e6;
padding: 5px 15px;
border-radius: 6px;
margin: 20px 0px;
}

  
}

</style>


<style>

.wrapper {
  width: 330px;
  font-size: 14px;
  border: 0px solid #CCC;
  padding: 10px;
}

.StepProgress {
  position: relative;
  padding-left: 45px;
  list-style: none;
}

  
.StepProgress::before {
    display: inline-block;
    content: '';
    position: absolute;
    top: 0;
    left: 15px;
    width: 10px;
    height: 100%;
    border-left: 2px solid #CCC;
  }
  
  .StepProgress-item {
    position: relative;
    counter-increment: list;
  }
    
    .StepProgress-item:not(:last-child) {
      padding-bottom: 20px;
    }
    
    .StepProgress-item::before {
      display: inline-block;
      content: '';
      position: absolute;
      left: -30px;
      height: 100%;
      width: 10px;
    }
    
    .StepProgress-item::after {
      content: '';
      display: inline-block;
      position: absolute;
      top: 0;
      left: -41px;
      width: 24px;
      height: 24px;
      border: 2px solid #CCC;
      border-radius: 50%;
      background-color: #FFF;
    }
    
  
      .StepProgress-item.is-done::before {
        border-left: 2px solid green;
      }
      .StepProgress-item.is-done::after {
        content: "✔";
        font-size: 12px;
        color: #FFF;
        text-align: center;
        border: 2px solid green;
        background-color: green;
      }
      .StepProgress-item.cancel::before {
        border-left: 2px solid red;
      }

      .StepProgress-item.cancel::after {
        content: "X";
        font-size: 12px;
        color: #FFF;
        text-align: center;
        border: 2px solid red;
        background-color: red;
      }
    
    
     
      .StepProgress-item.current::before {
        border-left: 2px solid green;
      }
      
      .StepProgress-item.current::after {
        content: counter(list);
        padding-top: 1px;
        width: 24px;
        height: 24px;
        top: -4px;
        left: -40px;
        font-size: 14px;
        text-align: center;
        color: green;
        border: 2px solid green;
        background-color: white;
      }
    
  
  
      .StepProgress strong {
    display: block;
  }

@media only screen and (max-width: 576px)
{
  .wrapper {
  width: 100%;
}
}

</style>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active"><a href="{{ URL::to('/orders')}}">@lang('website.orders')</a></li>
            <li class="breadcrumb-item active" aria-current="page">Appointment Information</li>
          </ol>
      </div>
    </nav>
</div> 

<!--My Order Content -->
<section class="order-two-content pro-content"  style="padding-top:10px;">
  <div class="container">
    <div class="page-heading-title">
        <h2>  Appointment Information
        </h2>
     
        </div>
</div>

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
                      <div class="wallet-desktop-content-menu-item wallet-active"><i class="fas fa-check  wallet-icon"></i> View Appointment</div>
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
              <div class="order-detail-main">
                <div class="order-detail-main-header">
                  <div class="order-detail-main-header-content">Order Number</div>
                  <div class="order-detail-main-header-content1">#{{$result['commonContent']['setting'][150]->value}}{{ $result['appointment']->appID }}  </div>
                  <div class="order-detail-main-header-button">
                      <i class="fa fa-globe" style="margin-right:10px"></i> {{ trans('labels.Website') }}
                  </div>
                  <div class="order-detail-main-header-icon">
                    <a style="padding:0px !important" href="{{ URL::to('appointment_invoice_print/'.$result['appointment']->appID)}}" target="_blank"  class="btn btn-default pull-right">
                      <img style="width:25px;height:25px;" src="{{ asset('images/print.png') }}" alt="">
                    </a>
                  </div>
                </div>
                <div class="order-detail-main-left">
                  <div class="order-detail-main-summary view-order-tables">

          
                    <table class="table view-order-table">
                      <thead>
                        <th style="font-size:1.1rem;width:200px;">Items summary</th>
                        <th style="font-size:0.8rem;width:100px;text-align:center;font-weight:600">Pax</th>
                        <th style="font-size:0.8rem;width:200px;font-weight:600">Appointment Date & Time</th>
                        <th style="font-size:0.8rem;width:80px;font-weight:600">Total Price</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="font-size:0.8rem;">
                            @if($result['appointment']->path_type == 'aws')
                              <img src="{{ $result['appointment']->path }}" width="20px" style="margin-right:15px"> {{  $result['appointment']->products_name }}
                            @else
                              <img src="{{ asset('').$result['appointment']->path }}" width="20px" style="margin-right:15px"> {{  $result['appointment']->products_name }}
                            @endif
                          </td>
                          <td style="text-align:center;font-size:0.8rem;">{{  $result['appointment_setting']->no_of_pax }}</td>
                          <td style="font-size:0.8rem;"> 
                            {{ $result['appointment']->app_date }}
                            <br>
                            {{ $result['appointment']->app_time }}
                          </td>
                          <td style="font-size:0.8rem;"> RM {{ $result['appointment']->products_price }} </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-customer-detail view-order-tables">
                    <table class="table view-order-table">
                      <thead>
                        <th colspan="2" style="font-size:1.1rem;">Customer And Order Details</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Customer Name</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $result['appointment']->name }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Phone Number</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $result['appointment']->phone }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Appointment Date</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ date('d-m-Y', strtotime($result['appointment']->createdDate)) }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Appointment Time</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ date('H:i a', strtotime($result['appointment']->createdDate)) }}</td>
                        </tr>
                         <tr>
                          <td style="text-align:left;font-size:0.89rem;">Note</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $result['appointment']->message }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>


                  <div class="order-detail-main-customer-info">
                    <div class="order-detail-main-customer-info-title">Customer Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Customer Name : </b>{{ $result['appointment']->name }}</div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $result['appointment']->address }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $result['appointment']->phone }}</div>
                    </div>
                  </div>

                  <div class="order-detail-main-billing-info">
                    <div class="order-detail-main-customer-info-title">Outlet Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Outlet Name : </b>{{ $result['outlet']->name }}</div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $result['outlet']->address }},
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $result['outlet']->phone }} </div>
                    </div>
                  </div>
                </div>

                <div class="order-detail-main-right">
                  
                <?php 
                  $result['appstatus'] = DB::table('appointment_status')->where('id',$result['appointment']->booking_status)->first();
                ?>
                  <div class="order-detail-main-delivery-info view-order-summarys" style="margin:10px 0px 20px 0px">
                    <table class="table view-order-summary">
                      <thead>
                        <th  style="font-size:1rem;">Order Summary</th>
                        <th>
                          @if($result['appointment']->booking_status == '1')
                            <div class="order-detail-payment-method-status-pending w-status">{{ $result['appstatus']->status_name }}</div>
                          @elseif($result['appointment']->booking_status == '4')
                            <div class="order-detail-payment-method-status-completed  w-status">{{ $result['appstatus']->status_name }}</div>
                          @elseif($result['appointment']->booking_status == '3')
                            <div class="order-detail-payment-method-status-cancel w-status">{{ $result['appstatus']->status_name }}</div>
                          @else
                            <div class="order-detail-payment-method-status w-status-all">{{ $result['appstatus']->status_name }}</div>
                          @endif
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Created</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('D, M d, Y', strtotime($result['appointment']->createdDate)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Time</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('h:i A', strtotime($result['appointment']->createdDate)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Subtotal</td>
                          <td style="text-align:right;font-size:0.8rem;">RM {{ $result['appointment']->products_price }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-delivery-info view-order-summarys">
                    <table class="table view-order-summary">
                      <td style="text-align:left;font-size:0.89rem;padding:0px 0px !important">Total</td>
                      <td style="text-align:right;font-size:0.8rem;padding:0px 0px !important">RM {{ $result['appointment']->products_price }}</td>
                    </table>
                  </div>

                  <div  data-toggle="modal" data-target="#trackOrder" class="order-detail-main-track-button btn-secondary popupnotscroll">Track Order</div>

                </div>

                </div>
              </div>
            </div>
          </div>

<!--- Mobile View --->

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
                  <div class="wallet-mobile-content-menu-item wallet-active-mobile"> 
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

              <div class="shipping-desktop-content-right">
              <div class="order-detail-main">
                <div class="order-detail-main-header">
                  <div class="order-detail-main-header-content">Order Number</div>
                  <div class="order-detail-main-header-content1">#{{$result['commonContent']['setting'][150]->value}}{{ $result['appointment']->appID }}  </div>
                  <div class="order-detail-main-header-button">
                      <i class="fa fa-globe" style="margin-right:10px"></i> {{ trans('labels.Website') }}
                  </div>
                  <div class="order-detail-main-header-icon">
                    <a style="padding:0px !important" href="{{ URL::to('appointment_invoice_print/'.$result['appointment']->appID)}}" target="_blank"  class="btn btn-default pull-right">
                      <img style="width:25px;height:25px;" src="{{ asset('images/print.png') }}" alt="">
                    </a>
                  </div>
                </div>
                <div class="order-detail-main-left">
                  <div class="order-detail-main-summary view-order-tables">

          
                    <table class="table view-order-table">
                      <thead>
                        <th style="font-size:1.1rem;width:200px;">Items summary</th>
                        <th style="font-size:0.8rem;width:100px;text-align:center;font-weight:600">Pax</th>
                        <th style="font-size:0.8rem;width:200px;font-weight:600">Appointment Date & Time</th>
                        <th style="font-size:0.8rem;width:80px;font-weight:600">Total Price</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="font-size:0.8rem;">
                            @if($result['appointment']->path_type == 'aws')
                              <img src="{{ $result['appointment']->path }}" width="20px" style="margin-right:15px"> {{  $result['appointment']->products_name }}
                            @else
                              <img src="{{ asset('').$result['appointment']->path }}" width="20px" style="margin-right:15px"> {{  $result['appointment']->products_name }}
                            @endif
                          </td>
                          <td style="text-align:center;font-size:0.8rem;">{{  $result['appointment_setting']->no_of_pax }}</td>
                          <td style="font-size:0.8rem;"> 
                            {{ $result['appointment']->app_date }}
                            <br>
                            {{ $result['appointment']->app_time }}
                          </td>
                          <td style="font-size:0.8rem;"> RM {{ $result['appointment']->products_price }} </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-customer-detail view-order-tables">
                    <table class="table view-order-table">
                      <thead>
                        <th colspan="2" style="font-size:1.1rem;">Customer And Order Details</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Customer Name</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $result['appointment']->name }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Phone Number</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $result['appointment']->phone }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Appointment Date</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ date('d-m-Y', strtotime($result['appointment']->createdDate)) }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Appointment Time</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ date('H:i a', strtotime($result['appointment']->createdDate)) }}</td>
                        </tr>
                         <tr>
                          <td style="text-align:left;font-size:0.89rem;">Note</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $result['appointment']->message }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>


                  <div class="order-detail-main-customer-info">
                    <div class="order-detail-main-customer-info-title">Customer Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Customer Name : </b>{{ $result['appointment']->name }}</div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $result['appointment']->address }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $result['appointment']->phone }}</div>
                    </div>
                  </div>

                  <div class="order-detail-main-billing-info">
                    <div class="order-detail-main-customer-info-title">Outlet Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Outlet Name : </b>{{ $result['outlet']->name }}</div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $result['outlet']->address }},
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $result['outlet']->phone }} </div>
                    </div>
                  </div>
                </div>

                <div class="order-detail-main-right">
                  
                <?php 
                  $result['appstatus'] = DB::table('appointment_status')->where('id',$result['appointment']->booking_status)->first();
                ?>
                  <div class="order-detail-main-delivery-info view-order-summarys">
                    <table class="table view-order-summary">
                      <thead>
                        <th  style="font-size:1rem;">Order Summary</th>
                        <th>
                          @if($result['appointment']->booking_status == '1')
                            <div class="order-detail-payment-method-status-pending w-status">{{ $result['appstatus']->status_name }}</div>
                          @elseif($result['appointment']->booking_status == '4')
                            <div class="order-detail-payment-method-status-completed  w-status">{{ $result['appstatus']->status_name }}</div>
                          @elseif($result['appointment']->booking_status == '3')
                            <div class="order-detail-payment-method-status-cancel w-status">{{ $result['appstatus']->status_name }}</div>
                          @else
                            <div class="order-detail-payment-method-status w-status-all">{{ $result['appstatus']->status_name }}</div>
                          @endif
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Created</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('D, M d, Y', strtotime($result['appointment']->createdDate)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Time</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('h:i A', strtotime($result['appointment']->createdDate)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Subtotal</td>
                          <td style="text-align:right;font-size:0.8rem;">RM {{ $result['appointment']->products_price }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-delivery-info view-order-summarys">
                    <table class="table view-order-summary">
                      <td style="text-align:left;font-size:0.89rem;padding:0px 0px !important">Total</td>
                      <td style="text-align:right;font-size:0.8rem;padding:0px 0px !important">RM {{ $result['appointment']->products_price }}</td>
                    </table>
                  </div>

                  <div  data-toggle="modal" data-target="#trackOrder" class="order-detail-main-track-button btn-secondary popupnotscroll">Track Order</div>

                </div>

                </div>
              </div>

                
              </div>
          </div>
        </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="trackOrder" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
          <h4 class="modal-title">Track Order</h4>
        </div>
        <div class="modal-body">

        <div class="wrapper">
        <ul class="StepProgress">

          <?php  
            $track = DB::table('appointment_track')->select('appointment_track.*','appointment_track.created_at as trackDate','appointment_status.*')->leftjoin('appointment_status','appointment_status.id','=','appointment_track.booking_id')->where('appointment_track.status', '=', 1)->where('appointment_track.appointment_id', '=', $result['appointment']->appID)->get();
          ?>
          @foreach($track as $jestrack)
            @if($jestrack->booking_id == 3)
              <li class="StepProgress-item cancel"><strong>Cancelled</strong> <br> {{date('M d, Y , h:i a', strtotime($jestrack->trackDate))}} <br> <p>{{ $jestrack->comments }}</P></li>
            @else
              <li class="StepProgress-item is-done"><strong>{{ $jestrack->status_name }}</strong> <br> {{date('M d, Y , h:i a', strtotime($jestrack->trackDate))}} <br> <p>{{ $jestrack->comments }}</P></li>
            @endif
          @endforeach

        </ul>
      </div>
          
        </div>
      
      </div>
    </div>
</div>

@endsection

