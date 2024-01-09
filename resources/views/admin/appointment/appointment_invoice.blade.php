@extends('admin.layout')
<style>
.wrapper.wrapper2{
	display: block;
}
.wrapper{
	display: none;
}
</style>
<body onload="window.print();">
<div class="wrapper wrapper2">
  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      <div class="col-xs-12">
      <div class="row">
       @if(session()->has('message'))
      	<div class="alert alert-success alert-dismissible">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> {{ trans('labels.Successlabel') }}</h4>
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('error'))
        	<div class="alert alert-warning alert-dismissible">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> {{ trans('labels.WarningLabel') }}</h4>
                {{ session()->get('error') }}
            </div>
        @endif
        
        
       </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px">
            <i class="fa fa-globe"></i> Appointment ID # <?php echo $result['commonContent']['setting']['invoice_prefix'] ?> {{ $result['appointment']->appID }}
            <small style="display: inline-block">{{ trans('labels.OrderedDate') }}: {{ $result['appointment']->createdDate }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          {{ trans('labels.CustomerInfo') }} :
          <address>
            Name : <strong>{{ $result['appointment']->name }}</strong><br>
            Address :{{ $result['appointment']->address }}<br>
            {{ trans('labels.Phone') }} : {{ $result['appointment']->phone }}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Outlet Info :
          <address>
            Outlet Name : <strong>{{ $result['outlet']->name }}</strong><br>
            Address: <strong>{{ $result['outlet']->address }}</strong><br>
            {{ trans('labels.Phone') }} :<strong>{{ $result['outlet']->phone }}</strong><br>
           Postal Code : <strong> {{ $result['outlet']->postal_code }}</strong><br>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Pax</th>
              <th>{{ trans('labels.Image') }}</th>
              <th>Product Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>{{ trans('labels.Price') }} ( RM )</th>
            </tr>
            </thead>
            <tbody>
            
            	
            <tr>
              <td>{{ $result['appointment_setting']->no_of_pax }}</td>
                <td>
                    @if($result['appointment']->path_type == 'aws')
                      <img src="{{$result['appointment']->path }}" width="60px"> <br>
                    @else
                      <img src="{{ asset('').$result['appointment']->path }}" width="60px"> <br>
                    @endif
                </td>
                <td  width="30%"> {{ $result['appointment']->products_name }}
                </td>
                <td> {{ $result['appointment']->app_date }}</td>
                <td> {{ $result['appointment']->app_time }}</td>
                <td>{{ $result['appointment']->products_price }}</td>
             </tr>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        
        
        <div class="col-xs-12">
          <p class="lead" style="margin-bottom:10px">Customer Message :</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
          {{ $result['appointment']->message }}
          </p>
        </div>  
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

     
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>

