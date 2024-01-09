@extends('web.layout')
@section('content')
<style>
.logo_new_style_outer
{
    width: 125px !important;
    height:40px !important;
}
th {
    text-align: left;
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


.order-detail-payment-method-status-completed {
  padding: 8px 7px;
  width: 100%;
}
.order-detail-payment-method-status-pending {
  padding: 8px 7px;
  width: 100%;
}
.order-detail-payment-method-status-cancel {
  padding: 8px 7px;
  width: 100%;
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
padding: 0px 0px 0px 0px;
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
.wraper1{
  height:500px;
  overflow:auto;
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


  @media only screen and (max-width: 1000px){
    .wrapper {
  width: 100%;
}
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
            <li class="breadcrumb-item active" aria-current="page">@lang('website.Order information')</li>
          </ol>
      </div>
    </nav>
</div> 

<!--My Order Content -->
<section class="order-two-content pro-content">
  <div class="container">
    <div class="page-heading-title">
        <h2>   @lang('website.Order information')
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


            <?php
              $orderStatus = DB::table('orders_status_description')->where('orders_status_id', $data['orders_data'][0]->orders_status_id)->where('language_id', 1)->first();
            ?>

            <div class="shipping-desktop-content-right">
              <div class="order-detail-main">
                <div class="order-detail-main-header">
                  <div class="order-detail-main-header-content">Order Number</div>
                  <div class="order-detail-main-header-content1">#{{$result['commonContent']['setting'][150]->value}}{{ $data['orders_data'][0]->orders_id }}  </div>
                  <div class="order-detail-main-header-button">
                    @if($data['orders_data'][0]->ordered_source == 1)
                      <i class="fa fa-globe" style="margin-right:10px"></i> {{ trans('labels.Website') }}
                    @else
                    <i class="fa fa-globe" style="margin-right:10px"></i> {{ trans('labels.Application') }}
                    @endif
                  </div>
                  <div class="order-detail-main-header-icon">
                    <a style="padding:0px !important" href="{{ URL::to('invoiceprint/'.$data['orders_data'][0]->orders_id)}}" target="_blank"  class="btn btn-default pull-right">
                      <img style="width:25px;height:25px;" src="{{ asset('images/print.png') }}" alt="">
                    </a>
                  </div>
                </div>
                <div class="order-detail-main-left">
                  <div class="order-detail-main-summary view-order-tables">
                    <table class="table view-order-table">
                      <thead>
                        <th style="font-size:1.1rem;width:250px;">Items summary</th>
                        <th style="font-size:0.8rem;width:150px;text-align:center;font-weight:600">QTY</th>
                        <th style="font-size:0.8rem;width:80px;font-weight:600">Price</th>
                        <th style="font-size:0.8rem;width:80px;font-weight:600">Total Price</th>
                      </thead>
                      <tbody>
                        <?php             
                          $symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first(); 
                        ?>
                        @foreach($data['orders_data'][0]->data as $products)
                          <tr>
                            <td style="font-size:0.8rem;">
                              <?php 
                                $imagepath = DB::table('image_categories')->where('path', '=', $products->image)->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                              ?>
                              @if($imagepath->path_type == 'aws')
                                <img src="{{$products->image }}"  style="margin-right:15px;height: 75px;width: 75px;object-fit: contain;"> {{  $products->products_name }}<br>
                              @else
                                <img src="{{ asset('').$products->image }}" style="margin-right:15px;height: 75px;width: 75px;object-fit: contain;"> {{  $products->products_name }}<br>
                              @endif

                              @if(isset($products->attribute))
                              <?php
                                  $uniqueOptions = [];


                                foreach($products->attribute as $attributes){

                                    $options = $attributes->products_options;
                                    $values = $attributes->products_options_values;

                                    if (!isset($uniqueOptions[$options])) {
                                      $uniqueOptions[$options] = [];
                                    }

                                    $uniqueOptions[$options][] = $values;

                                }

                                  ?>

                                @foreach($uniqueOptions as $option => $values)
                                <small style="text-align:left"><b>{{ $option }} :</b> ({{ implode(', ', $values) }})</small><br>
                                @endforeach
                                @endif
                              <br><br>

                              @if($products->products_type == 3)
                                <?php
                                      $comboPro = DB::table('product_combo')
                                      ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                                      ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                                      ->where('products_description.language_id', 1)
                                      ->where('categories_description.language_id', 1)
                                      ->where('product_combo.pro_id', $products->products_id)
                                      ->get();
                                    ?>
                                      @foreach($comboPro as $comboProd)
                                        <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                                        <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                                        <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                                      @endforeach
                              @endif
                              @if($products->products_type == 4)
                                <?php
                                      $comboPro = DB::table('product_buy_x')
                                      ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                                      ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                                      ->where('products_description.language_id', 1)
                                      ->where('categories_description.language_id', 1)
                                      ->where('product_buy_x.pro_id', $products->products_id)
                                      ->get();


                                      $comboProgetx = DB::table('product_get_x')
                                      ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                                      ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                                      ->where('products_description.language_id', 1)
                                      ->where('categories_description.language_id', 1)
                                      ->where('product_get_x.pro_id', $products->products_id)
                                      ->get();

                                    ?>
                                    <h5>Buy X </h5>
                                      @foreach($comboPro as $comboProd)
                                        <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                                        <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                                        <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                                      @endforeach

                                      <h5>Get X </h5>
                                      @foreach($comboProgetx as $comboProdgetx)
                                        <small><b>Product Name :</b> {{$comboProdgetx->products_name}}</small><br>
                                        <small><b>Category Name :</b> {{$comboProdgetx->categories_name}}</small><br>
                                        <small><b>Qty :</b> {{$comboProdgetx->qty}}</small><br>
                                      @endforeach
                              @endif
                            </td>
                            <td style="text-align:center;font-size:0.8rem;">X {{  $products->products_quantity }}</td>
                            <td style="font-size:0.8rem;"> 
                              @if($symbol_left != '')
                                {{ $data['orders_data'][0]->currency }}  {{$products->final_price  * $data['orders_data'][0]->currency_value }} 
                              @else
                                {{$products->final_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} 
                              @endif
                            </td>
                            <td style="font-size:0.8rem;"> 
                              @if($symbol_left != '')
                                {{ $data['orders_data'][0]->currency }}  {{$products->final_price  * $data['orders_data'][0]->currency_value }} 
                              @else
                                {{$products->final_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} 
                              @endif
                            </td>
                          </tr>
                        @endforeach
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
                          <td style="text-align:right;font-size:0.8rem;">{{ $data['orders_data'][0]->customers_name }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Phone Number</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $data['orders_data'][0]->customers_telephone }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Bag Option</td>
                          <td style="text-align:right;font-size:0.8rem;">No Bag</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Type</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $orderStatus->orders_status_name }}</td>
                        </tr>
                         <tr>
                          <td style="text-align:left;font-size:0.89rem;">Note</td>
                          <td style="text-align:right;font-size:0.8rem;">N/A</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-customer-info">
                    <div class="order-detail-main-customer-info-title">Customer Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $data['orders_data'][0]->customers_street_address }},
                        {{ $data['orders_data'][0]->customers_city }}, 
                        {{ $data['orders_data'][0]->customers_state }},
                        {{ $data['orders_data'][0]->customers_country }} - {{ $data['orders_data'][0]->customers_postcode }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $data['orders_data'][0]->customers_telephone }}</div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Landmark : </b></div>
                    </div>
                  </div>

                  <div class="order-detail-main-billing-info">
                    <div class="order-detail-main-customer-info-title">Billing Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $data['orders_data'][0]->billing_street_address }},  
                        {{ $data['orders_data'][0]->billing_city }}, 
                        {{ $data['orders_data'][0]->billing_state }},
                        {{ $data['orders_data'][0]->billing_country }} - {{ $data['orders_data'][0]->billing_postcode }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $data['orders_data'][0]->billing_phone }} </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Landmark : </b></div>
                    </div>
                  </div>
                </div>

                <div class="order-detail-main-right">
                  <div class="order-detail-payment-mode">
                    <div class="order-detail-payment-mode-title">
                      <img style="width:22px;height:22px;" src="{{ asset('images/bank.png') }}" alt="">
                      <span style="vertical-align:top">Payment Mode</span></div>
                    <div class="order-detail-payment-method">{{ str_replace('_',' ', $data['orders_data'][0]->payment_method) }}</div>
                    <div class="order-detail-payment-status-left">
                      @if($data['orders_data'][0]->payment_status == '0')
                        <div class="order-detail-payment-method-status-cancel">Payment Failure</div>
                      @elseif($data['orders_data'][0]->payment_status == '1')
                        <div class="order-detail-payment-method-status-completed">Payment Success</div>
                      @elseif($data['orders_data'][0]->payment_status == '2')
                        <div class="order-detail-payment-method-status-pending">Payment Pending</div>
                      @endif
                    </div>
                    <div class="order-detail-payment-status-right">
                      @if($data['orders_data'][0]->payment_method=='banktransfer')
                        @if($data['orders_data'][0]->banktransfer_image=='')
                          <img data-toggle="modal" data-target="#uploadImage" style="width:38px;height:38px;margin-right:10px;cursor:pointer" src="{{ asset('images/upload.png') }}" alt="">
                        @else
                          <i style="cursor:pointer;font-size: 2rem;vertical-align: middle;margin-right: 10px;" data-toggle="modal" data-target="#viewImage" class="fa fa-picture-o popupnotscroll"></i>
                        @endif
                        <img class="popupnotscroll" data-toggle="modal" data-target="#bankInfo" style="width:28px;height:28px;cursor:pointer" src="{{ asset('images/info.png') }}" alt="">
                      @endif
                      @if($data['orders_data'][0]->prescription_image!='')
                        <img data-toggle="modal" data-target="#precsImage" style="width:27px;height:27px;margin-right:0px;cursor:pointer" src="{{ asset('images/recipt.png') }}" alt="">
                      @endif
                    </div>
                  </div>

                  <div class="order-detail-main-delivery-info view-order-summarys">
                    <table class="table view-order-summary">
                      <thead>
                        <th  style="font-size:1rem;">Order Summary</th>
                        <th>
                          @if($orderStatus->orders_status_name == 'Pending')
                            <div class="order-detail-payment-method-status-pending w-status">{{ $orderStatus->orders_status_name }}</div>
                          @elseif($orderStatus->orders_status_name == 'Completed')
                            <div class="order-detail-payment-method-status-completed  w-status">{{ $orderStatus->orders_status_name }}</div>
                          @elseif($orderStatus->orders_status_name == 'Cancelled')
                            <div class="order-detail-payment-method-status-cancel w-status">{{ $orderStatus->orders_status_name }}</div>
                          @else
                            <div class="order-detail-payment-method-status w-status-all">{{ $orderStatus->orders_status_name }}</div>
                          @endif
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Created</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('D, M d, Y', strtotime($data['orders_data'][0]->date_purchased)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Time</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('h:i A', strtotime($data['orders_data'][0]->date_purchased)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Subtotal</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }} @else  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">{{ trans('labels.Tax') }}</td>
                          <td style="text-align:right;font-size:0.8rem;">
                          @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                            </td>
                        </tr>

                        @if(!empty($data['orders_data'][0]->coupon_code))
                          <tr>
                            <td style="text-align:left;font-size:0.89rem;">@lang('website.Discount(Promo Code)')</td>
                            <td style="text-align:right;font-size:0.8rem;">
                            @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->coupon_amount  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->coupon_amount  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>                  
                          </tr>
                          @endif
                          @if($data['orders_data'][0]->points_amount!='0')
                          <tr>
                            <td style="text-align:left;font-size:0.89rem;">@lang('website.Discount(Voucher)')</td>
                            <td style="text-align:right;font-size:0.8rem;">
                            @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->points_amount  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->points_amount  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>                  
                          </tr>
                        @endif
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Delivery Fee</td>
                          <td style="text-align:right;font-size:0.8rem;">
                          @if(!empty($data['orders_data'][0]->shipping_cost)) 
                            @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>
                          @else --- @endif 
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-delivery-info view-order-summarys">
                    <table class="table view-order-summary">
                      <td style="text-align:left;font-size:0.89rem;padding:0px 0px !important">Total</td>
                      <td style="text-align:right;font-size:0.8rem;padding:0px 0px !important">
                        @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif
                      </td>
                    </table>
                  </div>

                  <div class="order-detail-main-delivery-info">
                    <div class="order-detail-main-delivery-info-title">Delivery Address</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line :</b> 
                        {{ $data['orders_data'][0]->delivery_street_address }},
                        {{ $data['orders_data'][0]->delivery_city }}, 
                        {{ $data['orders_data'][0]->delivery_state }},
                        {{ $data['orders_data'][0]->delivery_country }} - {{ $data['orders_data'][0]->delivery_postcode }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>
                        {{ $data['orders_data'][0]->delivery_phone }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Landmark : </b></div>
                    </div>
                  </div>

                  <div data-toggle="modal" data-target="#trackOrder" class="order-detail-main-track-button btn-secondary popupnotscroll">Track Order</div>

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

            <?php
              $orderStatus = DB::table('orders_status_description')->where('orders_status_id', $data['orders_data'][0]->orders_status_id)->where('language_id', 1)->first();
            ?>

            <div class="shipping-desktop-content-right">
              <div class="order-detail-main">
                <div class="order-detail-main-header">
                  <div class="order-detail-main-header-content">Order Number</div>
                  <div class="order-detail-main-header-content1">#{{$result['commonContent']['setting'][150]->value}}{{ $data['orders_data'][0]->orders_id }}  </div>
                  <div class="order-detail-main-header-button">
                    @if($data['orders_data'][0]->ordered_source == 1)
                      <i class="fa fa-globe" style="margin-right:10px"></i> {{ trans('labels.Website') }}
                    @else
                    <i class="fa fa-globe" style="margin-right:10px"></i> {{ trans('labels.Application') }}
                    @endif
                  </div>
                  <div class="order-detail-main-header-icon">
                    <a style="padding:0px !important" href="{{ URL::to('invoiceprint/'.$data['orders_data'][0]->orders_id)}}" target="_blank"  class="btn btn-default pull-right">
                      <img style="width:25px;height:25px;" src="{{ asset('images/print.png') }}" alt="">
                    </a>
                  </div>
                </div>
                <div class="order-detail-main-left">
                  <div class="order-detail-main-summary view-order-tables">
                    <table class="table view-order-table">
                      <thead>
                        <th style="font-size:1.1rem;width:250px;">Items summary</th>
                        <th style="font-size:0.8rem;width:150px;text-align:center;font-weight:600">QTY</th>
                        <th style="font-size:0.8rem;width:80px;font-weight:600">Price</th>
                        <th style="font-size:0.8rem;width:80px;font-weight:600">Total Price</th>
                      </thead>
                      <tbody>
                        <?php             
                          $symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first(); 
                        ?>
                        @foreach($data['orders_data'][0]->data as $products)
                          <tr>
                            <td style="font-size:0.8rem;">
                              <?php 
                                $imagepath = DB::table('image_categories')->where('path', '=', $products->image)->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                              ?>
                              @if($imagepath->path_type == 'aws')
                                <img src="{{$products->image }}" width="20px" style="margin-right:15px"> {{  $products->products_name }}
                              @else
                                <img src="{{ asset('').$products->image }}" width="20px" style="margin-right:15px"> {{  $products->products_name }}
                              @endif
                            </td>
                            <td style="text-align:center;font-size:0.8rem;">X {{  $products->products_quantity }}</td>
                            <td style="font-size:0.8rem;"> 
                              @if($symbol_left != '')
                                {{ $data['orders_data'][0]->currency }}  {{$products->final_price  * $data['orders_data'][0]->currency_value }} 
                              @else
                                {{$products->final_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} 
                              @endif
                            </td>
                            <td style="font-size:0.8rem;"> 
                              @if($symbol_left != '')
                                {{ $data['orders_data'][0]->currency }}  {{$products->final_price  * $data['orders_data'][0]->currency_value }} 
                              @else
                                {{$products->final_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} 
                              @endif
                            </td>
                          </tr>
                        @endforeach
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
                          <td style="text-align:right;font-size:0.8rem;">{{ $data['orders_data'][0]->customers_name }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Phone Number</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $data['orders_data'][0]->customers_telephone }}</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Bag Option</td>
                          <td style="text-align:right;font-size:0.8rem;">No Bag</td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Type</td>
                          <td style="text-align:right;font-size:0.8rem;">{{ $orderStatus->orders_status_name }}</td>
                        </tr>
                         <tr>
                          <td style="text-align:left;font-size:0.89rem;">Note</td>
                          <td style="text-align:right;font-size:0.8rem;">N/A</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-customer-info">
                    <div class="order-detail-main-customer-info-title">Customer Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $data['orders_data'][0]->customers_street_address }},
                        {{ $data['orders_data'][0]->customers_city }}, 
                        {{ $data['orders_data'][0]->customers_state }},
                        {{ $data['orders_data'][0]->customers_country }} - {{ $data['orders_data'][0]->customers_postcode }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $data['orders_data'][0]->customers_telephone }}</div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Landmark : </b></div>
                    </div>
                  </div>

                  <div class="order-detail-main-billing-info">
                    <div class="order-detail-main-customer-info-title">Billing Info</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line : </b>
                        {{ $data['orders_data'][0]->billing_street_address }},  
                        {{ $data['orders_data'][0]->billing_city }}, 
                        {{ $data['orders_data'][0]->billing_state }},
                        {{ $data['orders_data'][0]->billing_country }} - {{ $data['orders_data'][0]->billing_postcode }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>{{ $data['orders_data'][0]->billing_phone }} </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Landmark : </b></div>
                    </div>
                  </div>
                </div>

                <div class="order-detail-main-right">
                  <div class="order-detail-payment-mode">
                    <div class="order-detail-payment-mode-title">
                      <img style="width:22px;height:22px;" src="{{ asset('images/bank.png') }}" alt="">
                      <span style="vertical-align:top">Payment Mode</span></div>
                    <div class="order-detail-payment-method">{{ str_replace('_',' ', $data['orders_data'][0]->payment_method) }}</div>
                    <div class="order-detail-payment-status-left">
                      @if($orderStatus->orders_status_name == 'Pending')
                        <div class="order-detail-payment-method-status-pending">{{ $orderStatus->orders_status_name }}</div>
                      @elseif($orderStatus->orders_status_name == 'Completed')
                        <div class="order-detail-payment-method-status-completed">{{ $orderStatus->orders_status_name }}</div>
                      @elseif($orderStatus->orders_status_name == 'Cancelled')
                        <div class="order-detail-payment-method-status-cancel">{{ $orderStatus->orders_status_name }}</div>
                      @else
                        <div class="order-detail-payment-method-status">{{ $orderStatus->orders_status_name }}</div>
                      @endif
                    </div>
                    <div class="order-detail-payment-status-right">
                      @if($data['orders_data'][0]->payment_method=='banktransfer')
                        @if($data['orders_data'][0]->banktransfer_image=='')
                          <img data-toggle="modal" data-target="#uploadImage" style="width:38px;height:38px;margin-right:10px;cursor:pointer" src="{{ asset('images/upload.png') }}" alt="">
                        @else
                          <i style="cursor:pointer;font-size: 2rem;vertical-align: middle;margin-right: 10px;" data-toggle="modal" data-target="#viewImage" class="fa fa-picture-o popupnotscroll"></i>
                        @endif
                        <img class="popupnotscroll" data-toggle="modal" data-target="#bankInfo" style="width:28px;height:28px;cursor:pointer" src="{{ asset('images/info.png') }}" alt="">
                      @endif
                      @if($data['orders_data'][0]->prescription_image!='')
                        <img data-toggle="modal" data-target="#precsImage" style="width:27px;height:27px;margin-right:0px;cursor:pointer" src="{{ asset('images/recipt.png') }}" alt="">
                      @endif
                    </div>
                  </div>

                  <div class="order-detail-main-delivery-info view-order-summarys">
                    <table class="table view-order-summary">
                      <thead>
                        <th  style="font-size:1rem;">Order Summary</th>
                        <th>
                          @if($orderStatus->orders_status_name == 'Pending')
                            <div class="order-detail-payment-method-status-pending w-status">{{ $orderStatus->orders_status_name }}</div>
                          @elseif($orderStatus->orders_status_name == 'Completed')
                            <div class="order-detail-payment-method-status-completed  w-status">{{ $orderStatus->orders_status_name }}</div>
                          @elseif($orderStatus->orders_status_name == 'Cancelled')
                            <div class="order-detail-payment-method-status-cancel w-status">{{ $orderStatus->orders_status_name }}</div>
                          @else
                            <div class="order-detail-payment-method-status w-status-all">{{ $orderStatus->orders_status_name }}</div>
                          @endif
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Created</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('D, M d, Y', strtotime($data['orders_data'][0]->date_purchased)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Order Time</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            <?php echo date('h:i A', strtotime($data['orders_data'][0]->date_purchased)) ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Subtotal</td>
                          <td style="text-align:right;font-size:0.8rem;">
                            @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }} @else  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">{{ trans('labels.Tax') }}</td>
                          <td style="text-align:right;font-size:0.8rem;">
                          @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                            </td>
                        </tr>

                        @if(!empty($data['orders_data'][0]->coupon_code))
                          <tr>
                            <td style="text-align:left;font-size:0.89rem;">@lang('website.Discount(Promo Code)')</td>
                            <td style="text-align:right;font-size:0.8rem;">
                            @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->coupon_amount  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->coupon_amount  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>                  
                          </tr>
                          @endif
                          @if($data['orders_data'][0]->points_amount!='0')
                          <tr>
                            <td style="text-align:left;font-size:0.89rem;">@lang('website.Discount(Voucher)')</td>
                            <td style="text-align:right;font-size:0.8rem;">
                            @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->points_amount  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->points_amount  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>                  
                          </tr>
                        @endif
                        <tr>
                          <td style="text-align:left;font-size:0.89rem;">Delivery Fee</td>
                          <td style="text-align:right;font-size:0.8rem;">
                          @if(!empty($data['orders_data'][0]->shipping_cost)) 
                            @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>
                          @else --- @endif 
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="order-detail-main-delivery-info view-order-summarys">
                    <table class="table view-order-summary">
                      <td style="text-align:left;font-size:0.89rem;padding:0px 0px !important">Total</td>
                      <td style="text-align:right;font-size:0.8rem;padding:0px 0px !important">
                        @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif
                      </td>
                    </table>
                  </div>

                  <div class="order-detail-main-delivery-info">
                    <div class="order-detail-main-delivery-info-title">Delivery Address</div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Address Line :</b> 
                        {{ $data['orders_data'][0]->delivery_street_address }},
                        {{ $data['orders_data'][0]->delivery_city }}, 
                        {{ $data['orders_data'][0]->delivery_state }},
                        {{ $data['orders_data'][0]->delivery_country }} - {{ $data['orders_data'][0]->delivery_postcode }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Phone : </b>
                        {{ $data['orders_data'][0]->delivery_phone }}
                      </div>
                    </div>
                    <div class="order-detail-main-customer-info1">
                      <div class="order-detail-main-customer-info-content"><b>Landmark : </b></div>
                    </div>
                  </div>

                  <div data-toggle="modal" data-target="#trackOrder" class="order-detail-main-track-button btn-secondary popupnotscroll">Track Order</div>

                </div>
              
            </div>
      </div>

      </div>
      </div>
        </div>

        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-modal="true">
              
          <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="container">
                        <div class="row align-items-center">                   
                    
                        <div class="form-group">
        <input type="text" id="pac-input" name="address_address" class="form-control map-input">
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
          
          <button type="button" class="btn btn-primary" onclick="setUserLocation()"><i class="fas fa-location-arrow"></i></button>
          <button type="button" class="btn btn-secondary" onclick="saveAddress()">Save</button>
        </div>
            </div>
          </div>
          </div>
    </section>
  </div>




<!-- Modal -->
<div class="modal fade" id="trackOrder" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 20px;font-size: 40px;top: 10px;">&times;</button> 
          <h4 class="modal-title">Track Order</h4>
        </div>
        <div class="modal-body">

        <div class="wrapper wraper1">
        <ul class="StepProgress">

        <?php  
        $pending = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 1)->first();
        $inprocess = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 5)->first();
        $dispatched = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 7)->first();
        $ontheway = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 12)->first();
        $delivered = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 6)->first();
        $completed = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 2)->first();  
        $cancel = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 3)->first();
       
        ?>
        @if($cancel != '') 
        <li class="StepProgress-item cancel"><strong>Cancelled</strong> <br> {{date('M d, Y , h:i a', strtotime($cancel->date_added))}} <br> <p>{{ $cancel->comments }}</P></li>
        @else

        @if($pending != '') 
        <li class="StepProgress-item is-done"><strong>Pending</strong> <br> {{date('M d, Y , h:i a', strtotime($pending->date_added))}} <br> <p>{{ $pending->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Pending</strong><br><br></li>
        @endif

        @if($inprocess != '') 
        <li class="StepProgress-item is-done"><strong>Inprocess</strong> <br> {{date('M d, Y , h:i a', strtotime($inprocess->date_added))}} <br> <p>{{ $inprocess->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Inprocess</strong><br><br></li>
        @endif

        @if($dispatched != '') 
        <li class="StepProgress-item is-done"><strong>Dispatched</strong> <br> {{date('M d, Y , h:i a', strtotime($dispatched->date_added))}} <br> <p>{{ $dispatched->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Dispatched</strong><br><br></li>
        @endif

        @if($ontheway != '') 
        <li class="StepProgress-item is-done"><strong>On the way</strong> <br> {{date('M d, Y , h:i a', strtotime($ontheway->date_added))}} <br> <p>{{ $ontheway->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>On the way</strong><br><br></li>
        @endif

        @if($delivered != '') 
        <li class="StepProgress-item is-done"><strong>Delivered</strong> <br> {{date('M d, Y , h:i a', strtotime($delivered->date_added))}} <br> <p>{{ $delivered->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Delivered</strong><br><br></li>
        @endif

        @if($completed != '') 
        <li class="StepProgress-item is-done"><strong>Completed</strong> <br> {{date('M d, Y , h:i a', strtotime($completed->date_added))}} <br> <p>{{ $completed->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Completed</strong></li>
        @endif
        @endif

        </ul>
      </div>
          
        </div>
      
      </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="bankInfo" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 20px;font-size: 40px;top: 10px;">&times;</button> 
          <h4 class="modal-title">Bank Transfer Detail</h4>
        </div>
        <div class="modal-body">

          @if($data['orders_data'][0]->payment_method=='banktransfer')
          <?php  $payments_setting = DB::table('payment_methods_detail')
            ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
            ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
            ->select(
                'payment_methods_detail.*',
                'payment_description.name',
                'payment_methods.environment',
                'payment_methods.status',
                'payment_methods.payment_method',
                'payment_description.sub_name_1'
            )
            ->where('language_id', session('language_id'))
            ->where('payment_description.payment_methods_id', 9)
            ->orwhere('language_id', 1)
            ->where('payment_description.payment_methods_id', 9)
            ->get()->keyBy('key');
             ?>
          <div class="table-responsive ">
            <table class="table order-table">
            <tr style="flex-direction: unset;">
                <th style="text-align:left;width:50%;">Invoice Number:</th>
                <td style="text-align:left;width:50%;">
                {{$result['commonContent']['setting'][150]->value}}{{ $data['orders_data'][0]->orders_id }}<br>

                  </td>
              </tr>
              <tr style="flex-direction: unset;">
                <th style="text-align:left;width:50%;">@lang('website.Bank'):</th>
                <td style="text-align:left;width:50%;">
                {{@$payments_setting['bank_name']->value ?: '---' }}<br>

                  </td>
              </tr>
              <tr style="flex-direction: unset;">
                <th style="text-align:left;width:50%;">@lang('website.account_name'):</th>
                <td style="text-align:left;width:50%;">
                {{@$payments_setting['account_name']->value ?: '---' }}<br>

                  </td>
              </tr>
              <tr style="flex-direction: unset;">
                <th style="text-align:left;width:50%;">@lang('website.account_number'):</th>
                <td style="text-align:left;width:50%;">
                {{@$payments_setting['account_number']->value ?: '---' }}<br>
                  </td>
              </tr>
            
              <tr style="flex-direction: unset;">
              <th style="text-align:left;width:50%;">@lang('website.short_code'):</th>
                <td style="text-align:left;width:50%;">
                {{@$payments_setting['short_code']->value ?: '---' }}<br>                  
              </tr>
             
              <tr style="flex-direction: unset;">
              <th style="text-align:left;width:50%;">@lang('website.iban'):</th>
                <td style="text-align:left;width:50%;">
                {{@$payments_setting['iban']->value ?: '---' }}<br>                  
              </tr>
             
              <tr style="flex-direction: unset;">
                <th style="text-align:left;width:50%;">@lang('website.swift'):</th>
                <td style="text-align:left;width:50%;">
                {{@$payments_setting['swift']->value ?: '---' }}<br>

                  </td>
              </tr>
            </table>
            </div>
          @endif
        </div>
      
      </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="uploadImage" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 20px;font-size: 40px;top: 10px;">&times;</button> 
          <h4 class="modal-title">Upload Image</h4>
        </div>
        <div class="modal-body">

        
          <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/banktransfer_fileupload')}}" method="post">
            <input type="hidden" value="{{$data['orders_data'][0]->orders_id}}" name="image_order_id">
            <input type="hidden" required name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="file" accept="image/*" name="bankimage" id="bankimage" required><br>
            <input type="submit" style="margin-top:30px;" class="btn swipe-to-top btn-secondary" value="Upload Image" name="submit" >
          </form>
          
        </div>
      
      </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="viewImage" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 20px;font-size: 40px;top: 10px;">&times;</button> 
          <h4 class="modal-title">View Image</h4>
        </div>
        <div class="modal-body">

         <img src="{{asset($data['orders_data'][0]->banktransfer_image)}}" width="300px"> <br>
          
        </div>

      </div>
    </div>
</div>


 <!-- modal -->
 <div class="modal fade" id="precsImage" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 20px;font-size: 40px;top: 10px;">&times;</button> 
          <h4 class="modal-title">Prescription</h4>
        </div>
        <div class="modal-body" style="height:400px;overflow-y:auto;">
           <!-- carousel -->
          <div
               id='carouselExampleIndicators'
               class='carousel slide'
               data-ride='carousel'
               >
            <ol class='carousel-indicators'>
              @foreach (explode(',', $data['orders_data'][0]->prescription_image) as $key=>$pres_img)
                <li
                  data-target='#carouselExampleIndicators'
                  data-slide-to='{{ $key }}'
                  class='@if($key == "0")active @endif'
                  >
                </li>
              @endforeach
            </ol>
            <div class='carousel-inner'>
              @foreach (explode(',', $data['orders_data'][0]->prescription_image) as $keys=>$pres_img)
                <div class='carousel-item  @if($keys == "0")active @endif' style="height:350px;">
                  <img class='img-size' style="height:100%;width:100%;object-fit:contain;" src="{{ asset('').$pres_img }}" alt='First slide' />
                </div>
              @endforeach
            </div>
            <a
               class='carousel-control-prev'
               href='#carouselExampleIndicators'
               role='button'
               data-slide='prev'
               >
              <span class='carousel-control-prev-icon'
                    aria-hidden='true'
                    ></span>
              <span class='sr-only'>Previous</span>
            </a>
            <a
               class='carousel-control-next'
               href='#carouselExampleIndicators'
               role='button'
               data-slide='next'
               >
              <span
                    class='carousel-control-next-icon'
                    aria-hidden='true'
                    ></span>
              <span class='sr-only'>Next</span>
            </a>
          </div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
  </div>


@endsection
