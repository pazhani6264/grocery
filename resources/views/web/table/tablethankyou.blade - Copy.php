<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Platinum24</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Include js plugin -->
       @include('web.common.scripts')
</head>
<body>
<section class="pro-content empty-content" style="padding-top:50px;">

  <div class="container">
      
      <div class="row">
        <div class="col-12">
            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="fa fa-check-circle"></i></h2>
              <h1 >@lang('website.Thank You')</h1>
              <p>
              @lang('website.You have successfully place your order')
                <a href="{{url('/orderhistory')}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>
        </div>
      </div>
    
  </div>    
</section> 
</body>
</html>
