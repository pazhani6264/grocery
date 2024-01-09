@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.manage customers_view') }} <small> {{ trans('labels.manage customers_view') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/customers/display')}}"><i class="fa fa-dashboard"></i>  {{ trans('labels.Customers') }}</a></li>
      <li class="active"> {{ trans('labels.manage customers_view') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
     
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px; margin-top:0;">
            <i class="fa fa-globe"></i> {{ $customers->first_name }} {{ $customers->last_name }} # COS{{ $customers->id}} 
            <small style="display: inline-block">{{ trans('labels.join_date') }}: {{$customers->created_at}}</small>  
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          {{ trans('labels.CustomerInfo') }}:
          <address>
            <strong>{{ $customers->first_name }} {{ $customers->last_name }} </strong><br>
             <strong>{{ trans('labels.Phone') }}: </strong>+{{ $customers->country_code }} {{ $customers->phone }}<br>
              <strong>{{ trans('labels.Email') }}: </strong>{{ $customers->email }} <br>
              <strong>{{ trans('labels.DOB') }}: </strong>{{ $customers->dob }} <br>
              <strong>{{ trans('labels.loyalty_point') }}: </strong>{{ $customers->loyalty_points}} <br>
          </address>
        </div>
        <!-- /.col -->
       {{--  <div class="col-sm-4 invoice-col">
          {{ trans('labels.ShippingInfo') }}
          <address>
            <strong></strong><br>
             <br>
            <br>

            <strong><br>
           <strong>  <br>
           <strong> {{ trans('labels.ShippingCost') }}:</strong> 
              <br>
          </address>
        </div> --}}
        <!-- /.col -->
       {{--  <div class="col-sm-4 invoice-col">
         {{ trans('labels.BillingInfo') }}
          <address>
            <strong></strong><br>
             <br>
            <strong><br>
            <br>
          </address>
        </div> --}}
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Table row -->
       <hr>
      <p class="lead">{{ trans('labels.ListingCustomerAddresses') }}</p>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>{{ trans('labels.FirstName') }}</th>
              <th>{{ trans('labels.Phone') }}</th>
              <th>{{ trans('labels.Street') }}</th>
              <th>{{ trans('labels.Suburb') }}</th>
              <th>{{ trans('labels.Postcode') }}</th>
              <th>{{ trans('labels.City') }}</th>
              <th>{{ trans('labels.State') }}</th>
              <th>{{ trans('labels.Country') }}</th>
            </tr>
            </thead>
            <tbody>
              @if(!empty($addresses))
              @foreach($addresses as $jesaddresses)
                <tr>
                    <td>{{ $jesaddresses->entry_firstname }} {{ $jesaddresses->entry_lastname }}</td>
                    <td>{{ $jesaddresses->entry_phone }}</td>
                    <td>{{ $jesaddresses->entry_street_address }}</td>
                    <td>{{ $jesaddresses->entry_suburb }}</td>
                    <td>{{ $jesaddresses->entry_postcode }}</td>
                    <td>{{ $jesaddresses->entry_city }}</td>
                    <td>{{ $jesaddresses->zone_name }} </td>
                    <td>{{ $jesaddresses->countries_name }}</td>
                 </tr>
             @endforeach
            @endif

            </tbody>
          </table>
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
      <hr>
      <p class="lead">{{ trans('labels.ListingOrders') }}</p>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>{{ trans('labels.ID') }}</th>
              <th>{{ trans('labels.CustomerName') }}</th>
              <th>{{ trans('labels.Order Source') }}</th>
              <th>{{ trans('labels.OrderTotal') }}</th>
              <th>{{ trans('labels.DatePurchased') }}</th>
              <th>{{ trans('labels.Status') }}</th>
              <th>{{ trans('labels.Action') }}</th>
            </tr>
            </thead>
            <tbody>
              @if(!empty($order))
              @foreach($order as $orderData)
                <tr>
                    <td>{{ $orderData->orders_id }}</td>
                    <td>{{ $orderData->customers_name }}</td>
                    <td> @if($orderData->ordered_source == 1)
                          {{ trans('labels.Website') }}
                        @else
                          {{ trans('labels.Application') }}
                        @endif</td>
                    <td>
                      @if(!empty($result['commonContent']['currency']->symbol_left) && $result['commonContent']['currency']->symbol_left == $orderData->currency)  {{ $orderData->currency }}  {{ $orderData->order_price *  $orderData->currency_value }} @else  {{ $orderData->order_price *  $orderData->currency_value }}  {{ $orderData->currency }} @endif
                    </td>
                    <td>{{ date('d/m/Y', strtotime($orderData->date_purchased)) }}</td>
                    <td> @if($orderData->orders_status_id==1)
                                                            <span class="label label-warning">
                                                        @elseif($orderData->orders_status_id==2)
                                                            <span class="label label-success">
                                                        @elseif($orderData->orders_status_id==3)
                                                            <span class="label label-danger">
                                                        @else
                                                            <span class="label label-primary">
                                                        @endif
                                                        {{ $orderData->orders_status }}
                                                            </span></td>
                    <td>
                      <a data-toggle="tooltip" data-placement="bottom" title="View Order" href="{{url('admin/orders/vieworder') }}/{{$orderData->orders_id}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                       {{--  <a data-toggle="tooltip" data-placement="bottom" title="Delete Order" id="deleteOrdersId" orders_id ="{{ $orderData->orders_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                    </td>                 
                  </tr>
             @endforeach
            @endif

            </tbody>
          </table>
        </div>
        <!-- /.col -->

      </div>
    
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>


@endsection
