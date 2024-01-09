@extends('web.layout')
@section('content')
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> -->
<style>

.order-search2-mobile {
border: 0px solid;
position: relative;
width: 49%;
display: inline-block;
/* margin: 0px 10px 10px 0px; */
padding: 0px 10px 30px 10px;
}

.desktop-display-none-web{
    display:none;
  }
  .mobile-display-none-web{
    display:block;
  }

  .order-main-right-print{
    border:none;
  }

  @media only screen and (max-width: 992px) {
    .desktop-display-none-web{
    display:block;
    }
    .mobile-display-none-web{
      display:none;
    }
  }
  thead{
    background:#F8F8F8;
    color:#333;
  }

  .input-icon-mobile {
position: absolute;
left: 13px;
top: 7px;
font-size: 15px;
padding: 7px;
background: #fff;
}

  .input-icon-mobile1 {
position: absolute;
left: 10%;
top: 15px;
font-size: 15px;
}
  

.select-control-search-mob{
  position: relative;
}
.select-control-search-mob::before {
font-family: "Font Awesome 5 Free";
font-weight: 900;
content: "\F107";
position: absolute;
color: #6c757d;
bottom: 21px;
right: 21px;
z-index: 1;
font-size: 12px;
}

.order-main-right-print{
  color:#000;
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
.order-mobile-main-content {
border: 1px solid #f5f5f5;
padding: 5px 10px;
background: #fff;
margin: 10px;
width: 46.5%;
display: inline-block;
border-radius: 7px;
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
            <li class="breadcrumb-item active" aria-current="page">@lang('website.My Orders')</li>
          </ol>
      </div>
    </nav>
</div> 

     <!--My Order Content -->
     <section class="order-one-content pro-content"  style="padding-top:10px;">
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
                      <div class="wallet-desktop-content-menu-item wallet-active"> <i class="fas fa-shopping-cart  wallet-icon"></i> @lang('website.Orders')</div>
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
              <div class="order-desktop-content-right">
              <div  style="padding-top: 10px;padding: 10px 0px 0px 17px;background:#F8F8F8">
              <div style="border-bottom:1px solid #eaeceb;margin-top:5px;">
                <div class="order-main-left">
                  <h3 style="padding:10px 0px 20px 0px;text-align:left;">Orders</h3>
                </div>
                <div class="order-main-right">
                  <form action="{{ URL::to('/order_pdf')}}" style="display:initial">
                  <input type="hidden" name="status_name" value="Pending">
                    <input type="hidden" name="orders_id" value="{{app('request')->input('orders_id')}}">
                    <input type="hidden" name="orders_status" value="{{ app('request')->input('orders_status') }}">
                    <input type="hidden" name="dateRange" value="{{app('request')->input('dateRange')}}">
                    <button type="submit" class="order-main-right-print common-hover"><i class="fa fa-print"></i> PRINT</button>
                  </form>

                  <form action="{{ URL::to('/order_export')}}" style="display:initial">
                    <input type="hidden" name="status_name" value="Pending">
                    <input type="hidden" name="orders_id" value="{{app('request')->input('orders_id')}}">
                    <input type="hidden" name="orders_status" value="{{ app('request')->input('orders_status') }}">
                    <input type="hidden" name="dateRange" value="{{app('request')->input('dateRange')}}">
                    <button style="text-align:left" type="submit" class="order-main-right-print order-export select-control-export common-hover">EXPORT</button>
                  </form>

                  <!-- <a href="{{ URL::to('/order_export')}}">
                    <div style="text-align:left" class="order-main-right-print order-export select-control-export">EXPORT</div>
                  </a> -->
                </div>
              </div>

              <form name="changePhone" action="{{ URL::to('/order_filter_pending')}}" class="align-items-center form-validate" enctype="multipart/form-data"  method="get" style="padding:0px !important">
              @csrf
                <div class="order-search-main">
                  <div class="order-search2">
                    <input type="text" name="orders_id" class="form-control-search" value="{{app('request')->input('orders_id')}}" placeholder="Search by order Id" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )"></input>
                    <i class="fa fa-search input-icon common-text"></i>
                  </div>
                  <div class="order-search1 select-control-search">
                    <input class="form-control-search reservation dateRange" placeholder="Data Range" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                    <i class="fa fa-calendar-o input-icon"></i>
                  </div>
                  <div class="order-search2 select-control-search">
                    <input type="hidden" name="orders_status" class="form-control-search" placeholder="Pending" readonly value="1">
                    <input class="form-control-search" placeholder="Pending" readonly value="Pending">
                    <i class="fa fa-tag input-icon"></i>
                  </div>
                  <div class="order-search2 select-control-search">
                    <select name="department" class="form-control-search">
                          <option value="">Department</option>
                    </select>
                    <i class="fa fa-map-marker input-icon"></i>
                  </div>
                    <button type="submit" style="border-radius: 5px;" class="btn btn-secondary">Search</button>
                </div>
              </form>
            </div>

            <?php
            
              if(isset($_GET['pagecnt'])){
                if($_GET['pagecnt'] != ''){
                    $fvalspc=$_GET['pagecnt'];
                }else{
                  $fvalspc=10; 
                }
              }else{
                  $fvalspc=10;
              }
            ?>


                  <div id="material-tabs" class="order-main-tab" style="padding-left:17px;background:#f8f8f8">
                    <a style="font-size:12px;margin-right:25px"  href="{{ URL::to('/orders')}}" class="order-table-title-normal"><i class="fas fa-home" style="margin-right: 5px;"></i>All <div class="table-count">{{ count($result['orders']) }}</div></a>
                    <a style="font-size:12px;margin-right:25px"  href="{{ URL::to('/pending_orders')}}" class="order-table-title-normal profile-table-title"><i class="fas fa-bug" style="margin-right: 5px;"></i> Pending <div class="table-count table-count-active">{{ count($result['pendingCount']) }}</div></a>
                    <a style="font-size:12px;margin-right:25px"  href="{{ URL::to('/complete_orders')}}" class="order-table-title-normal"><i class="fas fa-list" style="margin-right: 5px;"></i> Completed <div class="table-count">{{ count($result['completed']) }}</div></a>
                  </div>
                  <div class="tab-content" style="padding: 0px 0px !important;">
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
                      <div class="table-top-header">
                      <div class="table-top-header-left">showing {{ $result['pending']->firstItem() }} - {{ $result['pending']->lastItem() }} 0f {{ count($result['pendingCount']) }} results</div>
                        <div class="table-top-header-right select-control-table">Results per page 
                          <select name="pagecnt"  onchange="datapagecount(this.value)" class="form-control-table" style="display:inline-block">
                            <option value="10" <?php if($fvalspc == 10){?> selected <?php } ?>>10</option>
                            <option value="25" <?php if($fvalspc == 25){?> selected <?php } ?>>25</option>
                            <option value="50" <?php if($fvalspc == 50){?> selected <?php } ?>>50</option>
                            <option value="100" <?php if($fvalspc == 100){?> selected <?php } ?>>100</option>
                          </select>
                        </div>
                      </div>
                      <!-- <table id="example" class="table" style="width:100%"> -->
                      <table id="example" class="table order-table">

                        <thead>
                          <tr class="" style="border:none !important">
                            <th style="background:#f8f8f8;width:10px !important"></th>
                            <th style="padding:0.75rem 0px" class="">@lang('website.Order ID')</th>
                            <th class="">@lang('website.Order Date')</th>
                            <th class="">Items Count</th>
                            <th class="">@lang('website.Price')</th>
                            <th class="" >@lang('website.Status')</th>
                            <th class="" > Detail</th>

                          </tr>
                        </thead>
                        <tbody>
                          @if(count($result['pending']) > 0)
                          @foreach( $result['pending'] as $orders)
                          @if($orders->orders_status_id != '2' || $orders->orders_status_id != '3')
                            @php
                              $check = DB::table('orders_status')->where('orders_status_id', '=', $orders->orders_status_id)->first();
                            @endphp

                          <tr style="border-bottom: 1px solid #eaebed !important;">
                          <td></td>
                            <td style="display:table-cell;font-weight:900;padding:0.75rem 0px !important" class="">{{ $result['commonContent']['settings']['invoice_prefix'] }}{{$orders->orders_id}}</td>
                            <td style="display:table-cell;">
                              {{ date('d M Y', strtotime($orders->date_purchased))}}<br>
                              {{ date('H:i', strtotime($orders->date_purchased))}}
                            </td>
                            <td style="display:table-cell;" class="">
                              {{ $orders->productQty }}
                            </td>
                            <td style="display:table-cell;" class="">
                              @if($orders->currency == '$')
                              {{ $orders->currency }} {{ $orders->order_price  }} 
                              @else
                              @if(Session::get('symbol_left') != '')
                              {{ $orders->currency }} {{ $orders->order_price * $orders->currency_value }}
                              @else  
                              {{ $orders->order_price * $orders->currency_value }} {{ $orders->currency }}
                              @endif
                              @endif
                            </td>
                            <td style="display:table-cell;" class="">
                                 @if($orders->orders_status_id == '4')
                                  <div>
                                    <span class="badge badge-primary" style="padding:0px !important"><div class="dot-badge-pending"></div> {{$orders->orders_status}} </span>    <br>
                                    <form action="{{ URL::to('/updatestatus')}}" method="post" onSubmit="return cancelOrder();">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <input type="hidden" name="orders_id" value="{{$orders->orders_id}}">
                                    <input type="hidden" name="orders_status" value="3">
                                    <input type="hidden" name="old_orders_status" value="{{ $orders->orders_status_id }}">
                                    @if(!empty($check))
                                    @if($check->cancel_flag=='1')
                                    <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer">@lang('website.cancel order') </button>
                                    @endif
                                    @endif
                                    </form>   
                                  </div>                                         
                                  @else
                                  <div>
                                    <span class="badge badge-primary" style="padding:0px !important"><div class="dot-badge-pending"></div> {{$orders->orders_status}}</span><br>
                                    

                                    <form action="{{ URL::to('/updatestatus')}}" method="post" onSubmit="return cancelOrder();">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <input type="hidden" name="orders_id" value="{{$orders->orders_id}}">
                                    <input type="hidden" name="orders_status" value="3">
                                    <input type="hidden" name="old_orders_status" value="{{ $orders->orders_status_id }}">
                                    @if(!empty($check))
                                    @if($check->cancel_flag=='1')
                                    <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer">@lang('website.cancel order') </button>
                                    @endif
                                    @endif
                                    </form>
                                  </div>
                                    @endif
                            </td>
                            <td style="display:table-cell;text-decoration:underline" class=""><a href="{{ URL::to('/view-order/'.$orders->orders_id)}}">@lang('website.View Order')</a></td>
                          </tr>
                          @endif
                          @endforeach
                          @else
                              <tr>
                                <td style="display:table-cell;" colspan="7">@lang('website.No order is placed yet')</td>
                              </tr>
                          @endif
                        </tbody>
                      </table>

                      <div class="col-xs-12" style="float:right;">
                        {!! $result['pending']->appends(Request::except('page'))->links() !!}
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

              <div class="order-mobile-main desktop-display-none-web">

              <form action="{{ URL::to('/order_pdf')}}" style="display:initial;padding:0px 10px">
                  <input type="hidden" name="status_name" value="Pending">
                    <input type="hidden" name="orders_id" value="{{app('request')->input('orders_id')}}">
                    <input type="hidden" name="orders_status" value="{{ app('request')->input('orders_status') }}">
                    <input type="hidden" name="dateRange" value="{{app('request')->input('dateRange')}}">
                    <button style="border:1px solid #ddd7d7" type="submit" class="order-main-right-print common-hover"><i class="fa fa-print"></i> PRINT</button>
                  </form>

                  <form action="{{ URL::to('/order_export')}}" style="display:initial">
                    <input type="hidden" name="status_name" value="Pending">
                    <input type="hidden" name="orders_id" value="{{app('request')->input('orders_id')}}">
                    <input type="hidden" name="orders_status" value="{{ app('request')->input('orders_status') }}">
                    <input type="hidden" name="dateRange" value="{{app('request')->input('dateRange')}}">
                    <button style="text-align:left;border:1px solid #ddd7d7" type="submit" class="order-main-right-print order-export select-control-export common-hover">EXPORT</button>
                  </form>


              <form name="changePhone" action="{{ URL::to('/order_filter_pending')}}" class="align-items-center form-validate" enctype="multipart/form-data"  method="get" style="padding:0px !important">
              @csrf
                <div class="order-search2-mobile" style="padding: 0px 10px 10px 10px;">
                  <input style="border:1px solid #ddd7d7;height: calc(2.5em + 0.75rem + 2px);"  type="text" name="orders_id" class="form-control-search" value="{{app('request')->input('orders_id')}}" placeholder="Search by order Id" onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )"></input>
                  <i class="fa fa-search input-icon-mobile common-text"></i>
                </div>

                <div class="order-search2-mobile" style="padding: 0px 10px 10px 10px;">
                  <input type="hidden" name="orders_status" class="form-control-search" placeholder="Pending" readonly value="1">
                  <input style="border:1px solid #ddd7d7;text-indent: 30px !important;height: calc(2.5em + 0.75rem + 2px);"  class="form-control-search" placeholder="Pending" readonly value="Pending">

                    <i class="fa fa-tag input-icon-mobile1"></i>
                </div>

                <div class="order-search2-mobile" style="padding: 0px 10px 10px 10px;">
                  <input style="border:1px solid #ddd7d7;height: calc(2.5em + 0.75rem + 2px);"  class="form-control-search reservation dateRange" placeholder="Data Range" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                  <i class="fa fa-calendar-o  input-icon-mobile"></i>
                </div>

               
                <div class="order-search2-mobile select-control-search-mob" style="padding: 0px 10px 10px 10px;">
                  <select style="border:1px solid #ddd7d7;text-indent: 30px !important;height: calc(2.5em + 0.75rem + 2px);" class="form-control-search">
                        <option value="">Department</option>
                  </select>
                  <i class="fa fa-filter input-icon-mobile1"></i>
                </div>

                <button type="submit" style="border-radius: 5px;margin:0px 0px 20px 10px" class="btn btn-secondary">Search</button>

              </form>

                <?php
            
                  if(isset($_GET['pagecnt'])){
                    if($_GET['pagecnt'] != ''){
                        $fvalspc=$_GET['pagecnt'];
                    }else{
                      $fvalspc=10; 
                    }
                  }else{
                      $fvalspc=10;
                  }
                ?>

                <div id="material-tabs-mobile" class="order-main-tab" style="padding-left:10px;background:#f8f8f8;border: 1px solid #dad2d2;">
                  <a style="font-size:13px;margin-right:15px;letter-spacing: 0px;"  href="{{ URL::to('/orders')}}" class="order-table-title-normal"><i class="fas fa-home" style="margin-right: 5px;"></i>ALL <div class="table-count table-count-active">{{ count($result['orders']) }}</div></a>
                  <a style="font-size:13px;margin-right:15px;letter-spacing: 0px;"  href="{{ URL::to('/pending_orders')}}" class="order-table-title-normal profile-table-title"><i class="fas fa-bug" style="margin-right: 5px;"></i> PENDING <div class="table-count">{{ count($result['pendingCount']) }}</div></a>
                  <a style="font-size:13px;letter-spacing: 0px;"  href="{{ URL::to('/complete_orders')}}" class="order-table-title-normal"><i class="fas fa-list" style="margin-right: 5px;"></i> COMPLETED <div class="table-count">{{ count($result['completed']) }}</div></a>
                </div>
                <div class="tab-content" style="padding: 0px 0px !important;">
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
             
                  <div id="tab5">
                    <div class="table-top-header">
                      <div class="table-top-header-left-mobile">{{ $result['pending']->firstItem() }} - {{ $result['pending']->lastItem() }} 0f {{ count($result['pendingCount']) }} results</div>
                      <div class="table-top-header-right-mobile select-control-table">Results per page :
                        <select name="pagecnt"  onchange="datapagecount(this.value)" class="form-control-table-mobile" style="display:inline-block">
                          <option value="10" <?php if($fvalspc == 10){?> selected <?php } ?>>10</option>
                          <option value="25" <?php if($fvalspc == 25){?> selected <?php } ?>>25</option>
                          <option value="50" <?php if($fvalspc == 50){?> selected <?php } ?>>50</option>
                          <option value="100" <?php if($fvalspc == 100){?> selected <?php } ?>>100</option>
                        </select>
                      </div>
                    </div>

                    @if(count($result['pending']) > 0)
                      @foreach( $result['pending'] as $orders)
                        @php
                          $check = DB::table('orders_status')->where('orders_status_id', '=', $orders->orders_status_id)->first();
                        @endphp
                        <a  href="{{ URL::to('/view-order/'.$orders->orders_id)}}">
                          <div class="order-mobile-main-content">
                            <div class="order-mobile-main-header">
                              <div class="order-mobile-main-header-left">{{ date('d M Y, H:i', strtotime($orders->date_purchased))}}</div>
                              <div class="order-mobile-main-header-right">Product name</div>
                            </div>
                            <div class="order-mobile-main-header1">
                              <div class="order-mobile-main-header-left1"><b><i class="fa fa-file-text-o"></i> {{ $result['commonContent']['settings']['invoice_prefix'] }}{{$orders->orders_id}}</b><br>
                              <span style="font-size:0.7rem">{{ date('d M y, H:i', strtotime($orders->date_purchased))}} -> {{ date('d M y, H:i', strtotime($orders->date_purchased))}}</span>
                            </div>
                              <div class="order-mobile-main-header-right1">
                                @if($orders->orders_status_id == 1)
                                  <span class="btn-warning-order-pending" style="border-radius:5px;padding: 5px 10px;font-size: 0.5rem;margin-right:10px;vertical-align: middle;">{{$orders->orders_status}} </span>
                                  <a  href="{{ URL::to('/view-order/'.$orders->orders_id)}}">
                                    <i class="fa fa-angle-right" style="vertical-align: middle;font-size:1.5rem"></i>
                                  </a>
                                @elseif($orders->orders_status_id == 2)
                                  <span class="btn-success-order-success" style="border-radius:5px;padding: 5px 10px;font-size: 0.5rem;margin-right:10px;vertical-align: middle;">{{$orders->orders_status}}</span>
                                  <a  href="{{ URL::to('/view-order/'.$orders->orders_id)}}">
                                    <i class="fa fa-angle-right" style="vertical-align: middle;font-size:1.5rem"></i>
                                  </a>
                                @elseif($orders->orders_status_id == 3)
                                  <span class="btn-danger-order-danger" style="border-radius:5px;padding: 5px 10px;font-size: 0.5rem;margin-right:10px;vertical-align: middle;">{{$orders->orders_status}}</span>
                                  <a  href="{{ URL::to('/view-order/'.$orders->orders_id)}}">
                                    <i class="fa fa-angle-right" style="vertical-align: middle;font-size:1.5rem"></i>
                                  </a>
                                @else
                                  <span class="btn-info-order-info" style="border-radius:5px;padding: 5px 10px;font-size: 0.5rem;margin-right:10px;vertical-align: middle;">{{$orders->orders_status}}</span>
                                  <a  href="{{ URL::to('/view-order/'.$orders->orders_id)}}">
                                    <i class="fa fa-angle-right" style="vertical-align: middle;font-size:1.5rem"></i>
                                  </a>
                                @endif
                              </div>
                            </div>
                          </a>
                          <a  href="{{ URL::to('/view-order/'.$orders->orders_id)}}">
                            <div class="order-mobile-main-title">
                              <div class="order-mobile-main-title-left">Items Count</div>
                              <div class="order-mobile-main-title-right">{{ $orders->productQty }}</div>
                            </div>
                            <div class="order-mobile-main-title1">
                              <div class="order-mobile-main-title-left1">Price</div>
                              <div class="order-mobile-main-title-right1">
                                @if($orders->currency == '$')
                                  {{ $orders->currency }} {{ $orders->order_price  }} 
                                @else
                                  @if(Session::get('symbol_left') != '')
                                    {{ $orders->currency }} {{ $orders->order_price * $orders->currency_value }}
                                  @else  
                                    {{ $orders->order_price * $orders->currency_value }} {{ $orders->currency }}
                                  @endif
                                @endif
                              </div>
                            </div>
                            <div class="order-mobile-main-title">
                              <div class="order-mobile-main-title-left">Ratings</div>
                              <div class="order-mobile-main-title-right">
                                @if($result['commonContent']['settings']['deliveryboy_rating']=='1')
                                    @if($orders->orders_status_id == '2') 
                                      <a href="{{ URL::to('/rating_delivery/'.$orders->orders_id)}}"><i class="fa fa-star common-color"  aria-hidden="true"></i> Rate and Review</a>
                                    @endif
                                @endif
                              </div>
                            </div>
                            <div class="order-mobile-main-title1">
                              <div class="order-mobile-main-title-left1">Order Status</div>
                              <div class="order-mobile-main-title-right1">
                              @if($orders->orders_status_id == '2')
                                <div>
                                    <span class="badge badge-primary" style="padding:0px"><div class="dot-badge-completed"></div>  {{$orders->orders_status}}</span>
                                    <form action="{{ URL::to('/updatestatus')}}" method="post" onSubmit="return cancelOrder();" style="display: inline-block">
                                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                  <input type="hidden" name="orders_id" value="{{$orders->orders_id}}">
                                  <input type="hidden" name="orders_status" value="3">
                                  <input type="hidden" name="old_orders_status" value="{{ $orders->orders_status_id }}">
                                  @if(!empty($check))
                                  @if($check->cancel_flag=='1')
                                  <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer">@lang('website.cancel order') </button>
                                  @endif
                                  @endif
                                  </form>
                                </div>
                                @else
                                @if($orders->orders_status_id == '3')
                                <div>
                                  <span class="badge badge-primary" style="padding:0px"><div class="dot-badge-cancel"></div>  {{$orders->orders_status}} </span>
                                  <form action="{{ URL::to('/updatestatus')}}" method="post" onSubmit="return cancelOrder();" style="display: inline-block">
                                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                  <input type="hidden" name="orders_id" value="{{$orders->orders_id}}">
                                  <input type="hidden" name="orders_status" value="3">
                                  <input type="hidden" name="old_orders_status" value="{{ $orders->orders_status_id }}">
                                  @if(!empty($check))
                                  @if($check->cancel_flag=='1')
                                  <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer">@lang('website.cancel order') </button>
                                  @endif
                                  @endif
                                  </form>
                                </div>
                                @elseif($orders->orders_status_id == '4')
                                <div>
                                  <span class="badge badge-primary" style="padding:0px"><div class="dot-badge-pending"></div>  {{$orders->orders_status}} </span>    
                                  <form action="{{ URL::to('/updatestatus')}}" method="post" onSubmit="return cancelOrder();" style="display: inline-block">
                                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                  <input type="hidden" name="orders_id" value="{{$orders->orders_id}}">
                                  <input type="hidden" name="orders_status" value="3">
                                  <input type="hidden" name="old_orders_status" value="{{ $orders->orders_status_id }}">
                                  @if(!empty($check))
                                  @if($check->cancel_flag=='1')
                                  <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer">@lang('website.cancel order') </button>
                                  @endif
                                  @endif
                                  </form>   
                                </div>                                         
                                @else
                                <div>
                                  <span class="badge badge-primary" style="padding:0px"><div class="dot-badge-pending"></div> {{$orders->orders_status}}</span>
                                  

                                  <form action="{{ URL::to('/updatestatus')}}" method="post" onSubmit="return cancelOrder();" style="display: inline-block">
                                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                  <input type="hidden" name="orders_id" value="{{$orders->orders_id}}">
                                  <input type="hidden" name="orders_status" value="3">
                                  <input type="hidden" name="old_orders_status" value="{{ $orders->orders_status_id }}">
                                  @if(!empty($check))
                                  @if($check->cancel_flag=='1')
                                  <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer">@lang('website.cancel order') </button>
                                  @endif
                                  @endif
                                  </form>
                                </div>
                                  @endif
                              @endif
                              </div>
                            </div>
                          </div>
                        </a>
                        @endforeach
                        @else
                          <div style="text-align:center">@lang('website.No order is placed yet')</div>
                        @endif
                  </div>

                  <div class="col-xs-12" style="float:right;width:100%">
                    {!! $result['pending']->appends(Request::except('page'))->links() !!}
                  </div>

              </div>
            </div>
                </div>
                </div>

          </div>
        </div>
      </div>
    </section>



 
  <script type="text/javascript">
    function datapagecount(vals){
    window.location.href="pending_orders?{!! $result['varr'] !!}&pagecnt="+vals;
    }
  </script>

@endsection
