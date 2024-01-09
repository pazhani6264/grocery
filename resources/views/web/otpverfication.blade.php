@extends('web.layout')
@section('content')


<div class="container-fuild">
	<nav aria-label="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
			  <li class="breadcrumb-item active" aria-current="page">@lang('website.OTP Verfication')</li>

			</ol>
		</div>
	  </nav>
  </div> 

<!-- page Content -->
<section class="page-area">
  <div class="container">
      <div class="row justify-content-center">

        <div class="col-12 col-sm-12 col-md-6">
          @if(Session::has('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="">@lang('website.error'):</span>
                  {!! session('error') !!}

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif
          <div id="error_otp" style="margin-top:20px;"></div>
          <div class="col-12 my-5">

             <h5>OTP Verification</h5>
             <hr style="margin-bottom: 0;">
                <div class="tab-content" id="registerTabContent">
                  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                      <div class="registration-process">
                      <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/processotpsignup')}}" method="post">
                        {{csrf_field()}}
                          <div class="from-group mb-3">
                            <div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Phone')</label></div>
                            <div class="input-group col-12">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">+{{ $result['user_data']->country_code }}</div>
                              </div>
                              <input class="form-control" type="text" name="phone" id="phone"placeholder="@lang('website.Please enter your valid email address')" value="{{ $result['user_data']->phone }}" readonly="">
                              <span class="help-block error-content" hidden>@lang('website.Please enter your valid email address')</span>                            </div>
                              <input type="hidden" name="id" value="{{$result['user_data']->id}}" id="id" >
                          </div>
                          <div class="from-group mb-3">
                            <div class="col-12"> <label for="inlineFormInputGroup">@lang('website.OTP')</label></div>
                            <div class="input-group col-12">
                           
                              <input class="form-control" type="text" name="otp" id="otp"placeholder="@lang('website.Please enter your valid otp')" required onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )" maxlength="4">
                              <span class="help-block error-content" hidden>@lang('website.Please enter your valid otp')</span>                            </div>
                          </div>
                          <?php 
                           $ipaddress = '';
                           if (getenv('HTTP_CLIENT_IP'))
                               $ipaddress = getenv('HTTP_CLIENT_IP');
                           else if(getenv('HTTP_X_FORWARDED_FOR'))
                               $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                           else if(getenv('HTTP_X_FORWARDED'))
                               $ipaddress = getenv('HTTP_X_FORWARDED');
                           else if(getenv('HTTP_FORWARDED_FOR'))
                               $ipaddress = getenv('HTTP_FORWARDED_FOR');
                           else if(getenv('HTTP_FORWARDED'))
                              $ipaddress = getenv('HTTP_FORWARDED');
                           else if(getenv('REMOTE_ADDR'))
                               $ipaddress = getenv('REMOTE_ADDR');
                           else
                               $ipaddress = 'UNKNOWN';
                               $date = date('Y-m-d');
  
                          

                            $user_id = DB::table('user_ip')->where('user_ip', $ipaddress)->where('user_id', $result['user_data']->id)->whereDate('created_at','=',$date)->get();
                            $count = count($user_id);
                           
                          if($count < 5)
                          {
                          ?>
                       
                          <div class="col-12 col-sm-12 account_form">
                                <button style="margin-right:20px" type="submit" id="btn_dis" class="btn btn-secondary">@lang('website.Send')</button>

                                <span id="link_dis"><a href="{{ URL::to('/resendotp/' . $result['user_data']->id . '/' . $result['user_data']->phone )}}">@lang('website.Resend otp')</a></span> 
                            </div><br>
                            <div class="col-12 col-sm-12" style="text-align: center;">
                            <div><span id="timer" style="font-size: 24px;"></span></div>
                            </div>
                      </form>
                      </div>
                      <?php } else { ?>
                        <div class="col-12 col-sm-12 account_form">
                                <span id="" onclick="error_otp()" style="cursor:pointer;">@lang('website.Resend otp')</a></span> 
                            </div>
                           
                     
                        <?php } ?>

                  </div>

                 
                </div>
          </div>
        </div>

      </div>
  </div>
</section>
<script>

  function error_otp()
  {
    var content='';

    content +='<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    content +='<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
    content +='<span class="">@lang('website.error'):</span>';
    content +='“Tried many times “ please try again later.';
    content +='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    content +='<span aria-hidden="true">&times;</span>';
    content +=' </button>';
    content +='</div>';

    $("#error_otp").html(content);
   
  }
let timerOn = true;
$("#link_dis").hide();

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  $("#link_dis").show();
  //$("#btn_dis").hide();
}

timer(30);
</script>

@endsection
