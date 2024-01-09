@extends('web.layout')
@section('content')

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
    <div class="col-12 col-lg-3 ">
      <div class="heading">
          <h2>
              @lang('website.My Account')
          </h2>
          <hr >
        </div>

        @if(Auth::guard('customer')->check())
        <ul class="list-group">
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/profile')}}">
                    <i class="fas fa-user"></i>
                  @lang('website.Profile')
                </a>
            </li>
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/wishlist')}}">
                    <i class="fas fa-heart"></i>
                 @lang('website.Wishlist')
                </a>
            </li>
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/orders')}}">
                    <i class="fas fa-shopping-cart"></i>
                  @lang('website.Orders')
                </a>
            </li>
             @if($result['commonContent']['settings']['Loyalty']=='1')
             <li class="list-group-item">
                    <a class="nav-link" href="{{ URL::to('/point-transaction')}}">
                        <i class="fas fa-gift"></i>
                     @lang('website.point_transaction')
                    </a>
           </li>
           @endif
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/shipping-address')}}">
                    <i class="fas fa-map-marker-alt"></i>
                 @lang('website.Shipping Address')
                </a>
            </li>
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/logout')}}">
                    <i class="fas fa-power-off"></i>
                  @lang('website.Logout')
                </a>
            </li>
          </ul>
          @elseif(!empty(session('guest_checkout')) and session('guest_checkout') == 1)
          <ul class="list-group">
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/orders')}}">
                    <i class="fas fa-shopping-cart"></i>
                  @lang('website.Orders')
                </a>
            </li>
          </ul>
          @endif
    </div>
    <div class="col-12 col-lg-9 ">
        <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      @if(session()->has('message'))
       <div class="col-md-12">
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
        <div class="col-md-12">
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
        <div class="col-md-12">
          <h3 class="page-header" style="padding-bottom: 25px; margin-top:0;">
          Write a Rating and Reviews </h3>
        

         <?php 
          $orders_id =  $data['orders_data'][0]->orders_id;
            $delivery_id = DB::table('orders_to_delivery_boy')->where('orders_id', '=', $orders_id)->first(); 
            if($delivery_id !='')
            {
            $deliveryboy_id =  $delivery_id->deliveryboy_id;
            }
           
            ?>

          <div class="reviews">
                        @if(Auth::guard('customer')->check())
                     
                        @if($reviews != '')
                       
                        


                        <div class="write-review">
                         
                          <div class="write-review-box">
                              <div class="from-group row mb-3">
                                  <div class="col-12"> <label for="inlineFormInputGroup2">@lang('website.Rating')</label></div>
                                  <div class="pro-rating col-12">

                                  
                                        <fieldset class="disabled-ratings">                         
                                           <label class = "full fa @if($reviews->reviews_rating >= 1) common-color active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
                                           <label class = "full fa @if($reviews->reviews_rating >= 2) common-color active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>
                                           <label class = "full fa @if($reviews->reviews_rating >= 3) common-color active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>  
                                           <label class = "full fa @if($reviews->reviews_rating >= 4) common-color active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>    
                                           <label class = "full fa @if($reviews->reviews_rating >= 5) common-color active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label> 
                                        </fieldset>                                          
                                                  
                                      
                                  </div>
                              </div>                              
                             
                                <div class="from-group row mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup3">@lang('website.Review')</label></div>
                                    <div class="input-group col-12">                                      
                                      <textarea style="height:200px;" name="reviews_text" id="reviews_text" class="form-control" id="inlineFormInputGroup3" placeholder="@lang('website.Write Your Review')">{{$reviews->reviews_text}}</textarea>
                                    </div>
                                </div>

                          </div>
                     
                        </div>

                       
                        @else
                        <div class="write-review">
                          <form id="deliveryrating_form">
                            {{csrf_field()}}
                            <input value="{{$orders_id}}" type="hidden" name="products_id">
                            <?php   if($delivery_id !='')
            { ?>
                            <input value="{{$deliveryboy_id}}" type="hidden" name="deliveryboy_id">
                            <?php }?>
                          
                          <div class="write-review-box">
                              <div class="from-group row mb-3">
                                  <div class="col-12"> <label for="inlineFormInputGroup2">@lang('website.Rating')</label></div>
                                  <div class="pro-rating col-12">

                                    <fieldset class="ratings">
                                      
                                      <input type="radio" id="star5" name="rating" value="5" class="rating"/>
                                      <label class = "full fa" for="star5" title="@lang('website.awesome_5_stars')"></label>

                                      <input type="radio" id="star4" name="rating" value="4" class="rating"/>
                                      <label class="full fa" for="star4" title="@lang('website.pretty_good_4_stars')"></label>

                                      <input type="radio" id="star3" name="rating" value="3" class="rating"/>
                                      <label class = "full fa" for="star3" title="@lang('website.good_3_stars')"></label>

                                      <input type="radio" id="star2" name="rating" value="2" class="rating"/>
                                      <label class="full fa" for="star2" title="@lang('website.average_2_stars')"></label>

                                      <input type="radio" id="star1" name="rating" value="1" class="rating"/>
                                      <label class = "full fa" for="star1" title="@lang('website.bad_1_stars')"></label> 
                                    
                                  </fieldset>                                     
                                      
                                  </div>
                              </div>                              
                             
                                <div class="from-group row mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup3">@lang('website.Review')</label></div>
                                    <div class="input-group col-12">                                      
                                      <textarea style="height:200px;" name="reviews_text" id="reviews_text" class="form-control" id="inlineFormInputGroup3" placeholder="@lang('website.Write Your Review')"></textarea>
                                    </div>
                                </div>

                                <div class="alert alert-danger" hidden id="review-error" role="alert">
                                 @lang('website.Please enter your review')
                                </div>

                                <div class="from-group">
                                    <button type="submit" id="review_button" disabled class="btn btn-secondary swipe-to-top">@lang('website.Submit')</button>                                    
                                </div>
                          </div>
                          
                        </form>
                        </div>
                        @endif
                        @endif
                    </div>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

     


  
   
      
    </section>
  <!-- /.content -->
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

<script src="https://maps.googleapis.com/maps/api/js?key=<?=$result['commonContent']['settings']['google_map_api']?>&libraries=places&callback=initialize" async defer></script>
    <script>
     
      var markers;
      var myLatlng;
      var map;
      var geocoder;
     function setUserLocation(){
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            myLatlng = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            markers.setPosition(myLatlng);
            map.setCenter(myLatlng);

          }, function() {
          });
        } 
     } 
     function saveAddress(){
      var latlng = markers.getPosition();
      geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
             var street = "";
             var state = "";
             var country = "";
             var city = "";
             var postal_code = "";

                for (var i = 0; i < results[0].address_components.length; i++) {
                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                        switch (results[0].address_components[i].types[b]) {
                            case 'locality':
                                city = results[0].address_components[i].long_name;
                                break;
                            case 'administrative_area_level_1':
                                state = results[0].address_components[i].long_name;
                                break;
                            case 'country':
                                country = results[0].address_components[i].long_name;
                                break;
                            case 'postal_code':
                              postal_code =  results[0].address_components[i].long_name; 
                              break;
                            case 'route':
                              if (street == "") {
                                street = results[0].address_components[i].long_name;
                              }
                            break;

                            case 'street_address':
                              if (street == "") {
                                street += ", " + results[0].address_components[i].long_name;
                              }
                            break;
                        }
                    }
                }
                $("#postcode").val(postal_code);
                $("#street").val(street);
                $("#city").val(city);

                $("#latitude").val(markers.getPosition().lat());
                $("#longitude").val(markers.getPosition().lng());

                // $("#entry_country_id").val(country);
               
                $("#location").val(latlng);

                $("#entry_country_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == country;
                }).prop('selected', true);
                if(getZones("no_loader")){
                  $("#entry_zone_id option").filter(function() {
                    //may want to use $.trim in here
                    return $(this).text() == state;
                  }).prop('selected', true);
                }
                $('#mapModal').modal('hide');

            } else {
              console.log('No results found');
            }
          } else {
            console.log('Geocoder failed due to: ' + status);
          }
        });
     }

     function initialize() {
      defaultPOS = {
              lat: <?=$result['commonContent']['setting'][127]->value?>,
              lng: <?=$result['commonContent']['setting'][128]->value?>
            };
      map = new google.maps.Map(document.getElementById('map'), {
          center: defaultPOS,
          zoom: 13,
          mapTypeId: 'roadmap'
        });
      geocoder = new google.maps.Geocoder;
      markers = new google.maps.Marker({
          map: map,
          draggable:true,
          position: defaultPOS
        });

        
        
        var infowindow = new google.maps.InfoWindow;
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

          searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          var bounds = new google.maps.LatLngBounds();

          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };
            console.log(place.geometry.location);
            // Create a marker for each place.
            markers.setPosition(place.geometry.location);
            markers.setTitle(place.name);
            

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    </script>

@endsection

<style>

.disabled-ratings > label {
   float: unset !important; 
}

.wrapper {
  width: 330px;
  font-size: 14px;
  border: 1px solid #CCC;
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
        border-left: 2px solid green;
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
}

</style>
