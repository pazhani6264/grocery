
@extends('web.layout')
@section('content')

<style>
  .wallet-send-header a:hover {
    text-decoration: none;
    color: #fff !important;
  }
</style>

<style>
  .wallet-send-title-mob {
border-bottom: 3px solid #333;
color: #fff !important;
}
    .wallet-send-sync-button-desk {
border-radius: 20px;
padding: 8px;
width: 55%;
margin: 10% 20px 0px 20px !important;
-webkit-appearance: button-bevel;
}
  @media only screen and (max-width: 991px)
  {
    .profile-content .media-main .media-body .detail span {
    display: initial;
    font-size: 0.875rem;
}
.profile-content .media-main {
    margin-bottom: 5px;
}
    .pro-content {
      padding-top: 0px !important;
    }
  }
  @media only screen and (max-width: 767px)
  {
    .pro-content {
        padding-top: 0px !important;
    }
  }
  @media screen and (max-width: 600px)
  {
.wallet-send-mobile-main {
    border: 0px solid;
    background: #fff;
    margin-top: 0px;
}
  }
</style>


<div class="container-fuild">
  <nav aria-label="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
        <li class="breadcrumb-item active" aria-current="page">@lang('website.myProfile')</li>

      </ol>
    </div>
  </nav>
</div> 
<section class="pro-content"  style="padding-top:10px;">
<!-- Profile Content -->
<section class="profile-content">
  <div class="container">
    <div class="row">

      <div class="wallet-desktop-main mobile-display-none-web">
        <div class="wallet-dektop-header">
          <div class="wallet-desktop-header-left">
            <div class="wallet-header-desktop-img-left">
              <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
              @if($avatar == '' )
                <img class="wallet-header-left-img2" src="{{ asset('images/user.png') }}" alt="">
              @else
                <img class="wallet-header-left-img2"  src="{{ asset('').$avatar }}" alt="">
              @endif
            </div>
            <div class="wallet-header-img-right">
              <div class="wallet-header-desktop-title common-text">{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}}</div>
              @if($result['commonContent']['settings']['Loyalty']=='1')
                <div class="wallet-header-desktop-name">@lang('website.Loyalty_Points'): {{ auth()->guard('customer')->user()->loyalty_points }} </div>
              @endif
            </div>
          </div>
          <div class="wallet-desktop-header-right">
            <div class="wallet-desktop-header-right-name">@lang('website.E-mail') : <span>{{auth()->guard('customer')->user()->email}}</span></div>
            @if($result['commonContent']['settings']['Membertype']=='1')
              <div class="wallet-desktop-header-right-name">Member Type : <?php  $level = DB::table('member_type')->where('id', auth()->guard('customer')->user()->users_level)->first(); if($level != ''){ echo $level->member_type_name;}else {echo 'Normal';} ?> </div>
            @endif
          </div>
        </div>

        <div class="wallet-desktop-content-main">
          <div class="wallet-desktop-content-left">
            <div class="wallet-desktop-content-left-main">
              <div class="wallet-desktop-content-left-title">Account Settings</div>
              <div class="wallet-desktop-content-menu-main">
                <a href="{{ URL::to('/profile')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-user wallet-icon"></i> @lang('website.Profile')</div>
                </a>
                <a href="{{ URL::to('/shipping-address')}}">
                  <div class="wallet-desktop-content-menu-item"> <i class="fas fa-map-marker-alt wallet-icon"></i> <span style="vertical-align:text-bottom">@lang('website.Shipping Address')</span></div>
                </a>
                <!-- <a  href="{{ URL::to('/change-password')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-unlock-alt wallet-icon"></i> @lang('website.Change Password')</div>
                </a> -->
                <a  href="{{ URL::to('/logout')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-power-off wallet-icon"></i> <span style="vertical-align:text-bottom">@lang('website.Logout')</span></div>
                </a>
              </div>
            </div>

            <div class="wallet-desktop-content-left-main">
              <div class="wallet-desktop-content-left-title">Others</div>
              <div class="wallet-desktop-content-menu-main">
                <a  href="{{ URL::to('/wishlist')}}">
                  <div class="wallet-desktop-content-menu-item"> <i class="fas fa-heart  wallet-icon"></i> @lang('website.Wishlist')</div>
                </a>
                <a  href="{{ URL::to('/orders')}}">
                  <div class="wallet-desktop-content-menu-item"> <i class="fas fa-shopping-cart  wallet-icon"></i> @lang('website.Orders')</div>
                </a>
                <a  href="{{ URL::to('/view_appointment')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-check  wallet-icon"></i> View Appointment</div>
                </a>
                <a  href="{{ URL::to('/point-transaction')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-gift  wallet-icon"></i> @lang('website.point_transaction')</div>
                </a>
                <a  href="{{ URL::to('/tickets')}}">
                  <div class="wallet-desktop-content-menu-item"> <i class="fas fa-ticket-alt  wallet-icon"></i> @lang('website.tickets')</div>
                </a>
                <a  href="{{ URL::to('/wallet')}}">
                  <div class="wallet-desktop-content-menu-item wallet-active"><i class="fa fa-google-wallet  wallet-icon"></i> Wallet</div>
                </a>
              </div>
            </div>

          </div>
          <div class="wallet-desktop-content-right">
          <div class="">
            <div class="wallet-send-mobile-main">
              <div class="wallet-send-header-main common-bg">
                <div class="wallet-send-header-top">
                  <a href="{{ URL::to('/wallet')}}"><i class="fa fa-arrow-left" style="float:left;margin-top:5px;color:#fff"></i></a> Transfer
                </div>
                <div id="material-tabs">
                  <div class="wallet-send-header" style="text-align:-webkit-center">
                    <a id="tab1-tab" href="#tab1" class="wallet-send-title-normal wallet-send-title">TRANSFER</a>
                    <a id="tab2-tab" href="#tab2" class="wallet-send-title-normal">RECEIVE</a>
                  </div>
                </div>

              </div>

              <div class="tab-content" style="padding:0px">
                <div id="tab1" style="padding:20px 0px;">
                  <div class="wallet-send-button-main">
                    <button class="wallet-esend-button common-text">eWallet transfer</button>
                  </div>

                  <form class="form-validate" enctype="multipart/form-data" action="#" method="post">
                    <div class="form-row">
                      <div class="wallet-send-ccode select-control-wallet-send">
                        <?php 
                          $code = DB::table('countries')->get();
                        ?>
                        <select name="entry_cc_code" id="entry_cc_code" class="form-control-wallet-send field-validate">
                            @if(!empty($code))
                              @foreach($code as $jescode)
                                <option value="{{$jescode->country_code}}" @if($jescode->country_code=='60') selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
                              @endforeach
                              @endif
                        </select>
                      </div>
                      <div class="wallet-send-phone">
                        <input style="border-bottom: 1px solid #B4B4B4;" type="text" name="phone_number"  class="form-control-wallet-send field-validate" id="phone_number1" placeholder="Who to transfer" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )" maxlength="10" minlength="9">
                        <span class="help-block error-content7" hidden>@lang('website.Please enter your valid phone number')</span>
                        <i class="fa fa-repeat common-text wallet-send-icon"></i>
                      </div>
                    </div>
                  </form>

                  <div style="max-width: 500px;margin: auto;" id="icon-container"></div>

                  <div class="wallet-send-button-title">Sync your contacts</div>
                  <div class="wallet-send-button-title1">To transfer money easily, have your contact list <br> synced and stored in your account</div>
                  <div style="text-align:center">
                    <button class="btn wallet-send-sync-button-desk btn-secondary" style="text-transform:initial">Sync Now</button>
                  </div>
                </div>
                <div id="tab2" class="common-bg" style="text-align:center;padding:20px 0px;">
                    <div class="wallet-send-recieve-main">
                      <div class="wallet-send-recieve-title">Karthiofficial 15</div>
                      <div class="wallet-send-qrcode">{!! QrCode::size(150)->generate(auth()->guard('customer')->user()->api_token); !!}
                        <div class="wallet-send-main-logo">
                          @if($result['commonContent']['settings']['sitename_logo']=='logo')
                            <?php 
                            $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                            ?>
                            @if($imagepath->path_type == 'aws')
                              <img style="width:50px !important" class="img-fluid-molla" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                            @else
                              <img style="width:50px !important" class="img-fluid-molla" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                            @endif
                          @endif
                        </div>
                      </div>
                      <div class="wallet-send-des">Scan with your {{ $result['commonContent']['settings']['app_name'] }} eWallet app to <br> send money over or pay</div>
                      <div style="text-align:-webkit-center">
                        <div class="wallet-send-sync-button1 btn-secondary">Download QR Code</div>
                      </div>
                    </div>
                </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </div>

      <!--- mobile view --->

      <div class="desktop-display-none-web">

        <div class="col-12 media-main">
          <div class="media">
              <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
              @if($avatar == '' )
                <img class="wallet-header-left-img2" src="{{ asset('images/user.png') }}" alt="">
              @else
                <img class="wallet-header-left-img2"  src="{{ asset('').$avatar }}" alt="">
              @endif
              <div class="media-body">
                <div class="row">
                  <div class="col-12 col-sm-4 col-md-6">
                    <h4>{{auth()->guard('customer')->user()->first_name}} {{auth()->guard('customer')->user()->last_name}}<br>
                    <small>@lang('website.Phone'): {{ auth()->guard('customer')->user()->phone }} </small><br>
                    @if($result['commonContent']['settings']['Loyalty']=='1')
                    <small>@lang('website.Loyalty_Points'): {{ auth()->guard('customer')->user()->loyalty_points }} </small><br>
                    @endif
                    @if($result['commonContent']['settings']['Membertype']=='1')
                    <small>Member Type: <?php  $level = DB::table('member_type')->where('id', auth()->guard('customer')->user()->users_level)->first(); if($level != ''){ echo $level->member_type_name;}else {echo 'Normal';} ?> </small><br>
                    @endif
                  </h4>
                  </div>
                  <div class="col-12 col-sm-8 col-md-6 detail">                  
                    <p class="mb-0">@lang('website.E-mail'):<span>{{auth()->guard('customer')->user()->email}}</span></p>
                  </div>
                  </div>
              </div>
              
          </div>
        </div>

        <div class="wallet-mobile-content-main">
       
          <div class="wallet-mobile-content-left">
            <div class="wallet-mobile-content-left-main">
              <div class="wallet-mobile-content-menu-main">
                <a href="{{ URL::to('/profile')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-user wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a href="{{ URL::to('/shipping-address')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-map-marker-alt wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <!-- <a  href="{{ URL::to('/change-password')}}">
                  <div class="wallet-desktop-content-menu-item"><i class="fas fa-unlock-alt wallet-icon-mobile"></i> @lang('website.Change Password')</div>
                </a> -->
                <a  href="{{ URL::to('/logout')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-power-off wallet-icon-mobile"></i></div>
                  </div>
                </a>
              </div>
            </div>

            <div class="wallet-mobile-content-left-main">
              <div class="wallet-mobile-content-menu-main">
                <a  href="{{ URL::to('/wishlist')}}">
                  <div class="wallet-mobile-content-menu-item"> 
                    <div><i class="fas fa-heart  wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a  href="{{ URL::to('/orders')}}">
                  <div class="wallet-mobile-content-menu-item"> 
                    <div><i class="fas fa-shopping-cart  wallet-icon-mobile"></i> </div>
                  </div>
                </a>
                <a  href="{{ URL::to('/view_appointment')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-check  wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a  href="{{ URL::to('/point-transaction')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-gift  wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a  href="{{ URL::to('/tickets')}}">
                  <div class="wallet-mobile-content-menu-item">
                    <div><i class="fas fa-ticket-alt  wallet-icon-mobile"></i></div>
                  </div>
                </a>
                <a  href="{{ URL::to('/wallet')}}">
                  <div class="wallet-mobile-content-menu-item wallet-active-mobile">
                    <div><i class="fa fa-google-wallet  wallet-icon-mobile"></i></div>
                  </div>
                </a>
              </div>
            </div>
            </div>

         

        <div class="profile-mobile-content-right">
            <div  style="background:#fff;margin-left:0px;">


          <div class="col-12 col-lg-9">
            <div class="wallet-send-mobile-main">
              <div class="wallet-send-header-main common-bg">
                <div class="wallet-send-header-top">
                  <a href="{{ URL::to('/wallet')}}"><i class="fa fa-arrow-left" style="float:left;margin-top:5px;color:#fff"></i></a> Transfer
                </div>
                <div id="material-tabs-mob">
                  <div class="wallet-send-header" style="text-align:-webkit-center">
                    <a id="tab1-tab-mob" href="#tab-mob1" class="wallet-send-title-normal wallet-send-title-mob">TRANSFER</a>
                    <a id="tab2-tab-mob" href="#tab-mob2" class="wallet-send-title-normal">RECEIVE</a>
                  </div>
                </div>

              </div>

              <div class="tab-content" style="padding:0px">
                <div id="tab-mob1" style="padding:20px 0px;">
                  <div class="wallet-send-button-main">
                    <button class="wallet-esend-button common-text">eWallet transfer</button>
                  </div>

                  <form class="form-validate" enctype="multipart/form-data" action="#" method="post">
                    <div class="form-row">
                      <div class="wallet-send-ccode select-control-wallet-send">
                        <?php 
                          $code = DB::table('countries')->get();
                        ?>
                        <select name="entry_cc_code" id="entry_cc_code" class="form-control-wallet-send field-validate">
                            @if(!empty($code))
                              @foreach($code as $jescode)
                                <option value="{{$jescode->country_code}}" @if($jescode->country_code=='60') selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
                              @endforeach
                              @endif
                        </select>
                      </div>
                      <div class="wallet-send-phone">
                        <input style="border-bottom: 1px solid #B4B4B4;" type="text" name="phone_number"  class="form-control-wallet-send field-validate" id="phone_number1" placeholder="Who to transfer" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )" maxlength="10" minlength="9">
                        <span class="help-block error-content7" hidden>@lang('website.Please enter your valid phone number')</span>
                        <i class="fa fa-repeat common-text wallet-send-icon"></i>
                      </div>
                    </div>
                  </form>

                  <div id="icon-container"></div>

                  <div class="wallet-send-button-title">Sync your contacts</div>
                  <div class="wallet-send-button-title1">To transfer money easily, have your contact list <br> synced and stored in your account</div>
                  <div style="text-align:center">
                    <button class="btn wallet-send-sync-button btn-secondary" style="text-transform:initial">Sync Now</button>
                  </div>
                </div>
                <div id="tab-mob2" class="common-bg" style="text-align:center;padding:20px 0px;">
                    <div class="wallet-send-recieve-main">
                      <div class="wallet-send-recieve-title">Karthiofficial 15</div>
                      <div class="wallet-send-qrcode">{!! QrCode::size(150)->generate(auth()->guard('customer')->user()->api_token); !!}
                        <div class="wallet-send-main-logo">
                          @if($result['commonContent']['settings']['sitename_logo']=='logo')
                            <?php 
                            $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                            ?>
                            @if($imagepath->path_type == 'aws')
                              <img style="width:50px !important" class="img-fluid-molla" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                            @else
                              <img style="width:50px !important" class="img-fluid-molla" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                            @endif
                          @endif
                        </div>
                      </div>
                      <div class="wallet-send-des">Scan with your {{ $result['commonContent']['settings']['app_name'] }} eWallet app to <br> send money over or pay</div>
                      <div style="text-align:-webkit-center">
                        <div class="wallet-send-sync-button1 btn-secondary">Download QR Code</div>
                      </div>
                    </div>
                </div>
              </div>
          
          </div>
          </div>
          </div>


        </div>
       </div>

    </div>
  </div>
</section>
</div>


 <script>
  $(document).ready(function() {
		$('#material-tabs').each(function() {

				var $active, $content, $links = $(this).find('a');

				$active = $($links[0]);
				$active.addClass('wallet-send-title');

				$content = $($active[0].hash);

				$links.not($active).each(function() {
						$(this.hash).hide();
				});

				$(this).on('click', 'a', function(e) {

						$active.removeClass('wallet-send-title');
						$content.hide();

						$active = $(this);
						$content = $(this.hash);

						$active.addClass('wallet-send-title');
						$content.show();

						e.preventDefault();
				});
		});
});
</script>

<script>
  $(document).ready(function() {
		$('#material-tabs-mob').each(function() {

				var $active, $content, $links = $(this).find('a');

				$active = $($links[0]);
				$active.addClass('wallet-send-title-mob');

				$content = $($active[0].hash);

				$links.not($active).each(function() {
						$(this.hash).hide();
				});

				$(this).on('click', 'a', function(e) {

						$active.removeClass('wallet-send-title-mob');
						$content.hide();

						$active = $(this);
						$content = $(this.hash);

						$active.addClass('wallet-send-title-mob');
						$content.show();

						e.preventDefault();
				});
		});
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>


<script>
  var animation = bodymovin.loadAnimation({
  // animationData: { /* ... */ },
  container: document.getElementById('icon-container'), // required
  path: '{{ URL::to('web/send.json')}}', // required
  renderer: 'svg', // required
  loop: true, // optional
  autoplay: true, // optional
  name: "Demo Animation", // optional
});
</script>


 @endsection
