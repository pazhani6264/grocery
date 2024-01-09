<!-- contact Content -->
<style>
.contact-content .contact-info li {
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.g-recaptcha div
{
  margin: unset !important;
}

@media only screen and (max-width: 1050px)
{
  .contact-content .contact-logo li {
    height: 50px;
    
}
.contact-content .contact-info li {
    white-space: break-spaces;
    padding:0 !important;
    height: 75px;
}
}
@media only screen and (max-width: 769px)
{
  .contact-content .contact-logo li {
    height: 65px;
}
.contact-content .contact-info li {
   height: 85px;
}
}

@media only screen and (max-width: 600px)
{
  .contact-content .contact-logo li {
    margin-bottom: 0px; 
    height: 100px;
}
.contact-content .contact-info li {
    white-space: break-spaces;
    height: 100px;
}
}

@media only screen and (max-width: 320px)
{
  .contact-content .contact-logo li {
    height: 115px;
}
.contact-content .contact-info li {
   height: 115px;
}
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
      <div class="col-12 col-sm-12" style="margin-bottom:30px;">
        <div class="row">
            <div class="col-12 col-lg-6 contactus-2-outer-form">
              
                <div class="form-start">
                  @if(session()->has('success') )
                     <div class="alert alert-success">
                         {{ session()->get('success') }}
                     </div>
                  @endif
                  <form enctype="multipart/form-data" id="my_captcha_form" action="{{ URL::to('/processContactUs')}}" method="post">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                      <label class="first-label" for="email">@lang('website.Full Name')</label>
                      <div class="input-group"> 
                        
                        <input type="text" class="form-control contactus-2-border-input" id="name" name="name" placeholder="@lang('website.Please enter your name')" aria-describedby="inputGroupPrepend" required>
                        <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your name')</div>
                      
                      </div>
                      <label for="email">@lang('website.Email')</label>
                      <div class="input-group">                     
                          <input type="email"  name="email" class="form-control contactus-2-border-input" id="validationCustomUsername" placeholder="@lang('website.Enter Email here').." aria-describedby="inputGroupPrepend" required>
                          <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your valid email address')</div>
                      </div>  
                      <label for="email">@lang('website.Message')</label>
                      <textarea class="contactus-2-border-input" type="text" name="message"  placeholder="@lang('website.write your message here')..." rows="5" cols="56"></textarea>
                      <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your message')</div>

                      <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div>

                      <div class="text-center-mobile contact-2-text-center">
                      <button type="submit" class="btn btn-secondary swipe-to-top">@lang('website.Submit') <i class="fas fa-location-arrow"></i>        </div>         
                     
                    </form>
                </div>
          </div>    
          <div class="col-12 col-lg-6 contact-main">
            <div class="row">
              <div class="col-6">
                  
                  <ul class="contact-logo pl-0 mb-0">
                    <li> <i class="fas fa-mobile-alt"></i><br>@lang('website.CONTACT US') </li>
                    <li> <i class="fas fa-phone"></i><br>LANDLINE NO </li>
                    <li> <i class="fas fa-map-marker"></i><br>@lang('website.ADDRESS')
                    </li>
                    <li> <i class="fas fa-envelope"></i><br>@lang('website.EMAIL ADDRESS') </li>
                    <li> <i class="fas fa-tty"></i><br><phone dir="ltr">@lang('website.FAX')</phone></li>
                  </ul>
              </div>  
              <div class="col-6 right">
                <ul class="contact-info  pl-0 mb-0">
                  <li><font>
                    <a href="#" dir="ltr"><br>{{$result['commonContent']['setting'][11]->value}}</a>
                  </font> </li>
                  <li><font>
                    <a href="#" dir="ltr"><br>{{$result['commonContent']['setting'][210]->value}}</a>
                  </font> </li>
                  <li> <font><a href="#">{{$result['commonContent']['setting'][4]->value}}<br>{{$result['commonContent']['setting'][5]->value}}</a></font></li>
                  <li> <font><a href="mailto:{{$result['commonContent']['setting'][3]->value}}"><br>{{$result['commonContent']['setting'][3]->value}}</a> </font></li>
                  <li><font><a href="#" dir="ltr"><br>{{$result['commonContent']['setting'][214]->value}}</a> </font></li>
                </ul>
              </div>  
            </div>
              
             
             <p style="margin-top:30px;"">
               {{ $result['commonContent']['settings']['contact_content'] }}
             </p>
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
  $('.menu-active-30-contact > a').addClass('active-menu-30');
  $('.menu-active-40-contact > a').addClass('active-menu-40');
</script>