<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                             @if($result['commonContent']['settings']['sitename_logo']=='logo')
                            <a href="{{ URL::to('/')}}"><img src="{{ asset($result['commonContent']['settings']['website_logo']) }}" width="80px" height="80px" style="object-fit:contain"></a>
                             @endif
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, ratione magni ex earum odit delectus quod nemo reprehenderit porro illum dolore quas? Sunt quasi dolor eos! Quaerat asperiores aut natus.</p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h5>{{__('Important links')}}</h5>
                        <div class="footer__widget">
                            <ul>
                                <li><a href="{{url('/page?name=privacy-policy')}}">{{__('Privacy Policy')}}</a></li>
                                <li><a href="{{url('/page?name=term-services')}}">{{__('Terms of use')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h5>{{__('Quick links')}}</h5>
                        <div class="footer__widget footer__widget--social">
                            <ul>
                                <li><a href="{{url('/tickets')}}">{{__('My tickets')}}</a></li>
                                <li><a href="{{url('/open-ticket')}}">{{__('Open ticket')}}</a></li>
                                <li><a href="{{url('/notifications')}}">{{__('Notifications')}}</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget footer__widget--address">
                        <h5>{{__('Account information')}}</h5>
                        <p>{{__('Here is your account information.')}}</p>
                        <ul>
                            <li><i class="fa fa-user"></i> {{__('Full name :')}} {{auth()->guard('customer')->user()->first_name.' '.auth()->guard('customer')->user()->last_name}}</li>
                            <li><i class="fa fa-envelope"></i> {{__('Email :')}} {{auth()->guard('customer')->user()->email}}</li>
                            <li><i class="fa fa-clock-o"></i> {{__('Joined at :')}} {{ \Carbon\Carbon::parse(auth()->guard('customer')->user()->created_at)->diffForHumans() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer__copyright text-center">
                <div class="footer__copyright__text">
                     <p>{{__('Copyright ©')}}<script>document.write(new Date().getFullYear());</script> {{__('All rights reserved |')}} </p>
                </div>
            </div>
        </div>
    </footer>
<script src="{{ asset('static/bootstrap/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('static/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('static/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('static/customize/js/app.js') }}"></script>