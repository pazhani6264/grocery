{{-- @extends('admin.layout') --}}
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Online Grocery Shop | Platinum 24</title>
{{--{{ $pageTitle }}--}}
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="Themescoder" content="">
  <!-- Bootstrap 3.3.6 -->
  <link href="{!! asset('admin/bootstrap/css/bootstrap.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/bootstrap/css/styles.css') !!} " media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/css/dropzone.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/css/custom.ilyas.css') !!}" media="all" rel="stylesheet" type="text/css" />
  {{--fancybox--}}

  <link href="{!! asset('admin/css/jquery.fancybox.min.css') !!}" media="all" rel="stylesheet" type="text/css" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

  <!-- Select2 -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/select2/select2.min.css') !!} ">

    <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.css') !!} ">
    <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/timepicker/bootstrap-timepicker.min.css') !!} ">
  <!-- Ionicons -->
  <link href="{!! asset('admin/css/ionicons.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/css/image-picker.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <!-- daterange picker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/daterangepicker/daterangepicker-bs3.css') !!} ">
   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/datepicker/datepicker3.css') !!} ">
  <!-- jvectormap -->
  <link href="{!! asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!} " media="all" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="{!! asset('admin/dist/css/AdminLTE.min.css')  !!} " media="all" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link href="{!! asset('admin/dist/css/skins/_all-skins.min.css') !!} " media="all" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{!! asset('admin/plugins/iCheck/all.css')  !!} " media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
      window.csrf_token = "{{ csrf_token() }}"
    </script>

  <!-- Ionicons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" media="all" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/jquery-2.2.4.min"><\/script>')</script>

  <![endif]-->
</head>
<style>
.dragable-box-cursor img{
  cursor: move;
}

.dragable-box-cursor{
  cursor: move;
}

</style>
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
            <i class="fa fa-globe"></i> Appointment ID # {{$result['commonContent']['setting'][150]->value}} {{ $result['appointment']->appID }}
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

