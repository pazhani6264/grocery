<!-- //footer style Four -->
@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp
 <footer id="footerFour"  class="footer-area footer-four footer-desktop d-none d-lg-block d-xl-block footer-mb-100">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-12 col-lg-3">
        <div class="logo_new_style_outer"> 
          <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
            @if($result['commonContent']['settings']['sitename_logo']=='name')
            <?=stripslashes($result['commonContent']['settings']['website_name'])?>
            @endif
        
            @if($result['commonContent']['settings']['sitename_logo']=='logo')
              <?php 
              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['footer_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

              ?>
              @if($imagepath->path_type == 'aws')
                <img class="img-fluid logo_new_style_inner" src="{{$result['commonContent']['settings']['footer_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @else
                <img class="img-fluid logo_new_style_inner" src="{{asset('').$result['commonContent']['settings']['footer_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @endif
            @endif
        </a>
</div>
          <p class="peragraph">
            {{$result['commonContent']['setting'][111]->value}}
              
          </p>  
            <ul class="contact-list  pl-0 mb-0">
              <li> <i class="fas fa-map-marker"></i><span style="width: 100%;">{{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
              <li> <i class="fas fa-phone"></i><span dir="ltr" style="width: 100%;">({{$result['commonContent']['setting'][11]->value}})</span> </li>
              <li> <i class="fas fa-envelope"></i><span style="width: 100%;"> <a class="email-font" href="mailto:{{$result['commonContent']['setting'][3]->value}}">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>

            </ul>

        </div>
        <div class="col-12 col-lg-4">
          <h5>
             @lang('website.Contact Us')
          </h5>
          <div class="form">
            <form enctype="multipart/form-data" action="{{ URL::to('/processContactUs')}}" method="post">
              <input name="_token" value="{{ csrf_token() }}" type="hidden">
              <input type="text" class="form-control" id="name" name="name" placeholder="@lang('website.Please enter your name')" aria-describedby="inputGroupPrepend" required>
                        <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your name')</div>
                        <input type="email"  name="email" class="form-control" id="validationCustomUsername" placeholder="@lang('website.Enter Email here').." aria-describedby="inputGroupPrepend" required>
                          <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your valid email address')</div>
                          <textarea type="text" name="message"  placeholder="@lang('website.write your message here')..." rows="5" cols="56"></textarea>
                      <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your message')</div>
              <button type="submit" class="btn btn-secondary swipe-to-top" >@lang('website.Submit')</button>
            </form>
          </div>
        </div>
        <div class="col-12 col-lg-3">
          @if(!empty($result['commonContent']['setting'][119]) and $result['commonContent']['setting'][119]->value==1)
          
          <div class="newsletter">
            <h5>@lang('website.Newsletter')</h5>
            <div class="block">
              
              
            @if(!empty($result['commonContent']['setting'][118]) and $result['commonContent']['setting'][118]->value==1)

              <form class="form-inline mailchimp-form" action="{{url('subscribeMail')}}" >
                <div class="search-field-module">                           
              
                  <div class="search-field-wrap">
                    <input type="email" name="email" class="email" placeholder="@lang('website.Your email address here')" required>
                      <button type="submit" class="btn btn-secondary swipe-to-top" >
                      <i class="fas fa-location-arrow"></i></button>
                      <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>

                          <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                  </div>
                </div>
              </form>
                @endif
            </div>
        </div>
            @endif

            <div class="socials">
              <h5>@lang('website.Follow Us')</h5>
              <ul class="list">
                <li>
                  @if(!empty($result['commonContent']['setting'][50]->value))
                      <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f" target="_blank"></a>
                  @else
                  <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f"></a>
                  @endif
                </li> 
                <li>
                  @if(!empty($result['commonContent']['setting'][52]->value))
                      <a href="{{$result['commonContent']['setting'][52]->value}}"  class="fab tw fa-twitter" target="_blank"></a>
                  @else
                      <a href="#" class="fab tw fa-twitter" ></a>
                  @endif
                </li>

                <li>
                  @if(!empty($result['commonContent']['setting'][51]->value))
                      <a href="{{$result['commonContent']['setting'][51]->value}}" class="fab sk fa-google" target="_blank" ></a>
                  @else
                      <a href="#"><i class="fab sk fa-google" ></i></a>
                  @endif
                </li>

                <li>
                @if(!empty($result['commonContent']['setting'][53]->value))
                          <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab fa-linkedin-in" target="_blank"></a>
                      @else
                          <a href="#" class="fab fa-linkedin-in"></a>
                      @endif
                </li>   
              </ul>
          </div>         

        </div>
      </div>
    </div>
    <div class="container-fluid p-0">
        <div class="copyright-content">
            <div class="container">
              <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <div class="footer-image">
                        <img class="img-fluid" src="{{asset('web/images/miscellaneous/payments.png')}}">
                    </div>

                  </div>
                  <div class="col-12 col-md-6">
                    <div class="footer-info">
                        © @lang('website.Copy Rights') <a href="https://platinum24.net/" target="_blank"> Platinum24, Inc</a> .  <a href="{{url('/page?name=refund-policy')}}" class="common-hover">@lang('website.Privacy')</a>&nbsp;&bull;&nbsp;<a href="{{url('/page?name=term-services')}}" class="common-hover">@lang('website.Terms')</a>
                    </div>

                  </div>
              </div>
            </div>
          </div>
    </div>
    

    @if($result['commonContent']['settings']['Loyalty']=='1')
  <button type="button" id="subscribe" class="btn btn-secondary fixedbutton" data-toggle="modal" style="border-top-left-radius: 5px;border-top-right-radius: 5px;" data-target="
  @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
  #loginmyModal
  @else
  #myModalLoyalty
  @endif
  ">@lang('website.Loyalty_Points')
    @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
    - {{ auth()->guard('customer')->user()->loyalty_points }} </button>
    @endif
  @endif
</footer>
