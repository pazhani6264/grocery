<style>
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding: 10px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.55) !important; /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #fff !important;
  opacity:1 !important;
  font-size: 40px !important;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> View Appointment <small> View Appointment...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/appointment/appointment')}}"><i class="fa fa-dashboard"></i>  All Appointment</a></li>
      <li class="active"> View Appointment</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      @if(session()->has('message'))
       <div class="col-xs-12">
       <div class="row">
      	<div class="alert alert-success alert-dismissible">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> {{ trans('labels.Successlabel') }}</h4>
            {{ session()->get('message') }}
        </div>
        </div>
        </div>
        @endif
        @if(session()->has('error'))
        <div class="col-xs-12">
      	<div class="row">
        	<div class="alert alert-warning alert-dismissible">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> {{ trans('labels.WarningLabel') }}</h4>
                {{ session()->get('error') }}
            </div>
          </div>
         </div>
        @endif
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px; margin-top:0;">
            <i class="fa fa-globe"></i> Appointment ID # <?php echo $result['commonContent']['setting']['invoice_prefix'] ?> {{ $result['appointment']->appID }}
            
            <!-- <small style="display: inline-block" class="label label-primary">
            @if(3 == 1)
            {{ trans('labels.Website') }}
            @else
            {{ trans('labels.Application') }}
            @endif
            </small> -->
            <small style="display: inline-block">{{ trans('labels.OrderedDate') }}: {{ $result['appointment']->createdDate }}</small>
            <a href="<?php echo URL::to('admin/appointment/appinvoiceprint/'.$result['appointment']->appID)?>" target="_blank"  class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</a>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <?php 
            $symbol_left = DB::table('currencies')->where('symbol_left', '=', 'RM')->first(); 
          

            ?>

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
            <?php 
            //foreach($data['orders_data'][0]->data as $products){
              ?>
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
             <?php //}?>

            </tbody>
          </table>
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-7">
          <p class="lead" style="margin-bottom:10px">Customer Message :</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
          {{ $result['appointment']->message }}
          </p>
        </div>

    {!! Form::open(array('url' =>'admin/appointment/change_bookingid', 'method'=>'post', 'onSubmit'=>'return cancelOrder();', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
        <div class="col-xs-6">
        <hr>
         <input type="hidden" name="appointment_id" value="{{ $result['appointment']->appID }}"/>
          <?php //if($data['orders_data'][0]->orders_status_id == '2'){ ?>
          <div class="col-md-12">
              <div class="form-group">
                <label>Order Status:</label>
                <select class="form-control select2" id="status_id" name="orders_status" style="width: 100%;">
                  <?php foreach ($result['appstatus'] as $order_status) { ?>
                    <option value="{{ $order_status->id }}"
                      @if( $result['appointment']->booking_status == $order_status->id) selected="selected" @endif>
                      {{ $order_status->status_name }}
                    </option>
                  <?php } ?>
                  </select>
              </div>
          </div>

          <div class="col-md-12">
               <div class="form-group">
                <label>{{ trans('labels.Comments') }}:</label>
                {!! Form::textarea('comments',  '', array('class'=>'form-control', 'id'=>'comments', 'rows'=>'4'))!!}
                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CommentsOrderText') }}</span>
              </div>
            </div>
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> {{ trans('labels.Submit') }} </button>
              
        </div>            
          {!! Form::close() !!}



          

        <div class="col-xs-12">
          <p class="lead">{{ trans('labels.OrderHistory') }}</p>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ trans('labels.Date') }}</th>
                  <th>{{ trans('labels.Status') }}</th>
                  <th>{{ trans('labels.Comments') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($result['orderTrack'] as $trackOrder)
                    <tr>
                        <td>{{ $trackOrder->trackDate }}</td>
                        <td>{{ $trackOrder->status_name }}</td>
                        <td>{{ $trackOrder->comments }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>
@if($result['commonContent']['setting']['is_enable_location']==1 and $result['commonContent']['setting']['google_map_api'] != '')
<script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-database.js"></script>
    <script>
/**
 * Firebase config block.
 */
var config = {
    apiKey: "{{$result['commonContent']['setting']['google_map_api']}}",
    authDomain: "{{$result['commonContent']['setting']['auth_domain']}}",
    databaseURL: "{{$result['commonContent']['setting']['database_URL']}}",
    projectId: "{{$result['commonContent']['setting']['projectId']}}",
    storageBucket: "{{$result['commonContent']['setting']['storage_bucket']}}",
    messagingSenderId: "{{$result['commonContent']['setting']['messaging_senderid']}}",
    appId: "{{$result['commonContent']['setting']['firebase_appid']}}"
};
  
  firebase.initializeApp(config);

/**
 * Data object to be written to Firebase.
 */
var data = {sender: 456456, timestamp: null, lat: null, lng: null};

function makeInfoBox(controlDiv, map) {
  // Set CSS for the control border.
  var controlUI = document.createElement('div');
  controlUI.style.boxShadow = 'rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px';
  controlUI.style.backgroundColor = '#fff';
  controlUI.style.border = '2px solid #fff';
  controlUI.style.borderRadius = '2px';
  controlUI.style.marginBottom = '22px';
  controlUI.style.marginTop = '10px';
  controlUI.style.textAlign = 'center';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  var controlText = document.createElement('div');
  controlText.style.color = 'rgb(25,25,25)';
  controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
  controlText.style.fontSize = '100%';
  controlText.style.padding = '6px';
  controlText.textContent =
      'The map shows all clicks made in the last 10 minutes.';
  controlUI.appendChild(controlText);
}

      /**
      * Starting point for running the program. Authenticates the user.
      * @param {function()} onAuthSuccess - Called when authentication succeeds.
      */
      function initAuthentication(onAuthSuccess) {
        firebase.auth().signInAnonymously().catch(function(error) {
          console.log(error.code + ', ' + error.message);
        }, {remember: 'sessionOnly'});

        firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
            data.sender = user.uid;
            onAuthSuccess();
          } else {
            // User is signed out.
          }
        });
      }

      /**
       * Creates a map object with a click listener and a heatmap.
       */
      function initMap() {
        var map = new google.maps.Map(document.getElementById('googleMap'), {
          center: {lat: 0, lng: 0},
          zoom: 3,
          styles: [{
            featureType: 'poi',
            stylers: [{ visibility: 'off' }]  // Turn off POI.
          },
          {
            featureType: 'transit.station',
            stylers: [{ visibility: 'off' }]  // Turn off bus, train stations etc.
          }],
          disableDoubleClickZoom: true,
          streetViewControl: false,
        });

        // Create the DIV to hold the control and call the makeInfoBox() constructor
        // passing in this DIV.
        var infoBoxDiv = document.createElement('div');
        makeInfoBox(infoBoxDiv, map);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(infoBoxDiv);

        // Listen for clicks and add the location of the click to firebase.
        map.addListener('click', function(e) {
          data.lat = e.latLng.lat();
          data.lng = e.latLng.lng();
          addToFirebase(data);
        });

        // Create a heatmap.
        var heatmap = new google.maps.visualization.HeatmapLayer({
          data: [],
          map: map,
          radius: 16
        });

        initAuthentication(initFirebase.bind(undefined, heatmap));
      }

      /**
       * Set up a Firebase with deletion on clicks older than expiryMs
       * @param {!google.maps.visualization.HeatmapLayer} heatmap The heatmap to
       */
      function initFirebase(heatmap) {

        // 10 minutes before current time.
        var startTime = new Date().getTime() - (60 * 10 * 1000);

        // Reference to the clicks in Firebase.
        var clicks = firebase.database().ref('clicks');

        // Listen for clicks and add them to the heatmap.
        clicks.orderByChild('timestamp').startAt(startTime).on('child_added',
          function(snapshot) {
            // Get that click from firebase.
            var newPosition = snapshot.val();
            var point = new google.maps.LatLng(newPosition.lat, newPosition.lng);
            var elapsedMs = Date.now() - newPosition.timestamp;

            // Add the point to the heatmap.
            heatmap.getData().push(point);

            // Request entries older than expiry time (10 minutes).
            var expiryMs = Math.max(60 * 10 * 1000 - elapsedMs, 0);

            // Set client timeout to remove the point after a certain time.
            window.setTimeout(function() {
              // Delete the old point from the database.
              snapshot.ref.remove();
            }, expiryMs);
          }
        );

        // Remove old data from the heatmap when a point is removed from firebase.
        clicks.on('child_removed', function(snapshot, prevChildKey) {
          var heatmapData = heatmap.getData();
          var i = 0;
          while (snapshot.val().lat != heatmapData.getAt(i).lat()
            || snapshot.val().lng != heatmapData.getAt(i).lng()) {
            i++;
          }
          heatmapData.removeAt(i);
        });
      }

      /**
       * Updates the last_message/ path with the current timestamp.
       * @param {function(Date)} addClick After the last message timestamp has been updated,
       *     this function is called with the current timestamp to add the
       *     click to the firebase.
       */
      function getTimestamp(addClick) {
        // Reference to location for saving the last click time.
        var ref = firebase.database().ref('last_message/' + data.sender);

        ref.onDisconnect().remove();  // Delete reference from firebase on disconnect.

        // Set value to timestamp.
        ref.set(firebase.database.ServerValue.TIMESTAMP, function(err) {
          if (err) {  // Write to last message was unsuccessful.
            console.log(err);
          } else {  // Write to last message was successful.
            ref.once('value', function(snap) {
              addClick(snap.val());  // Add click with same timestamp.
            }, function(err) {
              console.warn(err);
            });
          }
        });
      }

      /**
       * Adds a click to firebase.
       * @param {Object} data The data to be added to firebase.
       *     It contains the lat, lng, sender and timestamp.
       */
      function addToFirebase(data) {
        getTimestamp(function(timestamp) {
          // Add the new timestamp to the record data.
          data.timestamp = timestamp;
          var ref = firebase.database().ref('clicks').push(data, function(err) {
            if (err) {  // Data was not written to firebase.
              console.warn(err);
            }
          });
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?=$result['commonContent']['setting']['google_map_api']?>&libraries=visualization&callback=initMap">
    </script>
    @endif

@endsection
