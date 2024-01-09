<!-- //footer style Six -->
 @include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp
 <footer id="footerSix"  class="footer-area footer-six footer-desktop d-none d-lg-block d-xl-block footer-mb-100">
    
    <div class="container-fluid p-0">
      <div class="search-content">
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="newsletter">
                        <h5>@lang('website.Subscribe for Newsletter')</h5>
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
                </div>
            </div>
          </div>
        </div>
  </div>

    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
          <div class="single-footer">
            <h5>@lang('website.About Store')</h5>
            <div class="row">
              <div class="col-12 col-lg-8">
                <hr>
              </div>
            </div>
            <ul class="contact-list  pl-0 mb-0">
              <li> <i class="fas fa-map-marker"></i><span style="width: 100%;">{{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
              <li> <i class="fas fa-phone"></i><span dir="ltr" style="width: 100%;">({{$result['commonContent']['setting'][11]->value}})</span> </li>
              <li> <i class="fas fa-envelope"></i><span style="width: 100%;"> <a class="email-font" href="mailto:{{$result['commonContent']['setting'][3]->value}}">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>

            </ul>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
          <div class="footer-block">
              <div class="single-footer single-footer-left">
                <h5>@lang('website.Our Services')</h5>
                <div class="row">
                    <div class="col-12 col-lg-8">
                      <hr>
                    </div>
                  </div>
                <ul class="links-list pl-0 mb-0">
                <li> <a href="{{ URL::to('/')}}"><i class="fa fa-angle-right"></i>@lang('website.Home')</a> </li>
                <li> <a href="{{ URL::to('/shop')}}"><i class="fa fa-angle-right"></i>@lang('website.Shop')</a> </li>
                <li> <a href="{{ URL::to('/orders')}}"><i class="fa fa-angle-right"></i>@lang('website.Orders')</a> </li>
                <li> <a href="{{ URL::to('/viewcart')}}"><i class="fa fa-angle-right"></i>@lang('website.Shopping Cart')</a> </li>
                <li> <a href="{{ URL::to('/wishlist')}}"><i class="fa fa-angle-right"></i>@lang('website.Wishlist')</a> </li>
                </ul>
              </div>

          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
          <div class="single-footer single-footer-right">
            <h5>@lang('website.Information')</h5>
            <div class="row">
                <div class="col-12 col-lg-8">
                  <hr>
                </div>
              </div>
            <ul class="links-list pl-0 mb-0">
              @if(count($result['commonContent']['pages']))
                  @foreach($result['commonContent']['pages'] as $page)
                      <li> <a href="{{ URL::to('/page?name='.$page->slug)}}"><i class="fa fa-angle-right"></i>{{$page->name}}</a> </li>
                  @endforeach
              @endif
              <?php $zippage = DB::table('zippages')->where('status',1)->get();  ?>
            @if(count($zippage)>0)
              @foreach ($zippage as  $key=>$zip)
              <li> <a href="{{ URL::to($zip->link)}}" target="_blank" data-toggle="" data-placement="left" title="{{$zip->name}}"><i class="fa fa-angle-right"></i>{{$zip->name}}</a> </li>
              @endforeach
            @endif
                  <li> <a href="{{ URL::to('/contact')}}"><i class="fa fa-angle-right"></i>@lang('website.Contact Us')</a> </li>
            </ul>
          </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
          <div class="single-footer">
            @if(!empty($result['commonContent']['setting'][89]) and $result['commonContent']['setting'][89]->value==1)
              <div class="newsletter">
                  <h5>@lang('website.Subscribe for Newsletter')</h5>
                  <div class="row">
                      <div class="col-12 col-lg-8">
                        <hr>
                      </div>
                    </div>
                  <div class="block">
                      <form class="form-inline">
                          <div class="search">
                            <input type="email" name="email" id="email" placeholder="@lang('website.Your email address here')" required>
                            <button type="button" id="subscribe" class="btn btn-secondary">@lang('website.Subscribe')</button>
                              @lang('website.Subscribe')
                              </button>
                              <button class="btn-secondary fas fa-location-arrow" type="submit">
                              </button>
                              <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>

                              <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                          </div>
                        </form>
                  </div>
              </div>
              @endif
              <div class="socials">
                  <h5>@lang('website.Follow Us')</h5>
                  <div class="row">
                      <div class="col-12 col-lg-8">
                        <hr>
                      </div>
                    </div>
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
                  <div class="footer-image">
                    <img class="img-fluid" src="{{asset('web/images/miscellaneous/payments.png')}}">
                  </div>
              </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid p-0">
      <div class="copyright-content">
          <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                  <div class="footer-info">
                    © @lang('website.Copy Rights') <a href="https://platinum24.net/" target="_blank">Platinum24, Inc</a> .  <a href="{{url('/page?name=refund-policy')}}">@lang('website.Privacy')</a>&nbsp;&bull;&nbsp;<a href="{{url('/page?name=term-services')}}">@lang('website.Terms')</a>
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


