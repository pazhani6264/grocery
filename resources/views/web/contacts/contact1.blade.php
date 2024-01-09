<!-- contact Content -->
<style>
.contact-content .contact-info li span {
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.g-recaptcha div
{
  margin: unset !important;
}

.contact-content .contact-info li .fas {
    width: 50px !important;
}
</style>


<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.Contact Us')</li>
          </ol>
      </div>
    </nav>
</div> 

<section class="pro-content">
        
  <div class="container">
    <div class="page-heading-title">
        <h2> @lang('website.Contact Us') 
        </h2>
     
        </div>
</div>

<section class="contact-content">
  <div class="container"> 
    <div class="row">
      <div class="col-12 col-sm-12">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="form-start">
                  
                  @if(session()->has('success') )
                     <div class="alert alert-success">
                         {{ session()->get('success') }}
                     </div>
                  @endif

                  <form enctype="multipart/form-data" id="my_captcha_form" action="{{ URL::to('/processContactUs')}}" method="post">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input name="check_code" value="{{ $checkcode }}" type="hidden">
                      <label class="first-label" for="email">@lang('website.Full Name')</label>
                      <div class="input-group"> 
                        
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('website.Please enter your name')" aria-describedby="inputGroupPrepend" required>
                        <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your name')</div>
                      
                      </div>
                      <label for="email">@lang('website.Email')</label>
                      <div class="input-group">                     
                          <input type="email"  name="email" class="form-control" id="validationCustomUsername" placeholder="@lang('website.Enter Email here').." aria-describedby="inputGroupPrepend" required>
                          <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your valid email address')</div>
                      </div>  
                      <label for="email">@lang('website.Message')</label>
                      <textarea type="text" name="message"  placeholder="@lang('website.write your message here')..." rows="5" cols="56"></textarea>
                      <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your message')</div>

                      <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div>


                      <div class="text-center-mobile contact-2-text-center">

                  

                      <button type="submit" class="btn btn-secondary swipe-to-top">@lang('website.Submit') <i class="fas fa-location-arrow"></i>    </div>        
                     
                    </form>
                </div>
          </div>     
        
          <div class="col-12 col-lg-5">
                <div id="map" style="height:400px; margin-top: 5px;">
                  
                </div>
                @if(!empty($result['commonContent']['settings']['latitude']) and  !empty($result['commonContent']['settings']['longitude']))
                <script>
                  var map;
                  function initMap() {

                    // The location of Uluru
                    var uluru = {lat: {{$result['commonContent']['settings']['latitude']}}, lng: {{$result['commonContent']['settings']['longitude']}} };
                    // The map, centered at Uluru
                    var map = new google.maps.Map(
                        document.getElementById('map'), {zoom: 4, center: uluru});
                    // The marker, positioned at Uluru
                    var marker = new google.maps.Marker({position: uluru, map: map});

                  }
                </script>

                @if($result['commonContent']['settings']['google_map_api'])                
                <script src="https://maps.googleapis.com/maps/api/js?key={{$result['commonContent']['settings']['google_map_api']}}&callback=initMap"
                async defer></script>
                 @endif
                 @endif
                <p class="info">
                {{ $result['commonContent']['settings']['contact_content'] }}
                </p>
          </div> 
          <div class="col-12 col-lg-3">
             
              <div class="">
                  <ul class="contact-info pl-0 mb-0"  >
                      <li> <i class="fas fa-mobile-alt"></i><span style="width: 100%;"><a href="tel:{{$result['commonContent']['setting'][11]->value}}">{{$result['commonContent']['setting'][11]->value}}</a></span> </li>
                      <li> <i class="fas fa-phone"></i><span style="width: 100%;"><a href="tel:{{$result['commonContent']['setting'][11]->value}}">{{$result['commonContent']['setting'][210]->value}}</a></span> </li>
                      <li> <i class="fas fa-map-marker"></i><a style="cursor: default;width:100%;" href="javascript:void(0)">{{$result['commonContent']['setting'][4]->value}}<br>{{$result['commonContent']['setting'][5]->value}}</a></span> </li>
                      <li> <i class="fas fa-envelope"></i><span style="width: 100%;"> <a href="mailto:{{$result['commonContent']['setting'][3]->value}}" style="width: 100%;">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>
                      <li> 
                 
                    </ul>         
                </div>
        
          </div>
        
        </div>
      </div>
    </div>
    
  </div>      
</section>


<script>
document.getElementById("my_captcha_form").addEventListener("submit",function(evt)
  {
  
  var response = grecaptcha.getResponse();
  if(response.length == 0) 
  { 
    //reCaptcha not verified
    $(".captca").addClass("captca-error");
    evt.preventDefault();
    return false;
  }
  //captcha verified
  //do the rest of your validations here
  
});




  $('.menu-active-contact > a').addClass('menu-active');
  $('.menu-actives-contact > a').addClass('menu-actives');
  $('.menu-activess-contact > a').addClass('menu-activess');
  $('.menu-active-11-contact > a').addClass('active-menu-11');
  $('.menu-active-13-contact > a').addClass('active-menu-13');
  $('.menu-active-15-contact > a').addClass('active-menu-15');
  $('.menu-active-16-contact > a').addClass('active-menu-16');
  $('.menu-active-40-contact > a').addClass('active-menu-40');
</script>