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
          <div class="col-12 my-5">

             <h5>OTP Verification</h5>
             <hr style="margin-bottom: 0;">
                <div class="tab-content" id="registerTabContent">
                  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                      <div class="registration-process">
                      <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/processotpupdate')}}" method="post">
                        {{csrf_field()}}
                          <div class="from-group mb-3">
                            <div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Phone')</label></div>
                            <div class="input-group col-12">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">+{{ $result['user_data']->ccode }}</div>
                              </div>
                              <input class="form-control" type="text" name="phone" id="phone"placeholder="@lang('website.Please enter your valid email address')" value="{{ $result['user_data']->phone }}" readonly="">
                              <span class="help-block error-content" hidden>@lang('website.Please enter your valid email address')</span>                            </div>
                              <input type="hidden" name="id" value="{{$result['user_data']->user_id}}" id="id" >
                               <input type="hidden" name="ccode" value="{{$result['user_data']->ccode}}" id="id" >
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
                          <div class="col-12 col-sm-12 account_form">
                                <button type="submit" id="btn_dis" class="btn btn-secondary">@lang('website.Send')</button>

                                <span id="link_dis"><a href="{{ URL::to('/resendotpupdate/' . $result['user_data']->user_id . '/' . $result['user_data']->phone )}}">@lang('website.Resend otp')</a></span> 
                            </div>
                            <div class="col-12 col-sm-12" style="text-align: center;">
                            <div><span id="timer" style="font-size: 24px;"></span></div>
                            </div>
                      </form>
                      </div>

                  </div>

                 
                </div>
          </div>
        </div>

      </div>
  </div>
</section>
<script>
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
  $("#btn_dis").hide();
}

timer(30);
</script>

@endsection
