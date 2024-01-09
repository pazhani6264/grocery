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

             <h5>Phone Number Verfication</h5>
             <hr style="margin-bottom: 0;">
                <div class="tab-content" id="registerTabContent">
                  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                      <div class="registration-process">
                      <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/socialphonenoverfication')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="appname" value="{{ $result['commonContent']['setting'][18]->value }} ">
                          <div class="from-group mb-3">
                            <div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Phone')</label></div>
                            <div class="input-group col-12">
                              <div class="input-group-prepend">
                                  <select class="form-control field-validate" name="ccode" id="ccode">
                            @if(!empty($code))
                            @foreach($code as $jescode)
                              @if($result['user_data']->country_code=="")
                                @php
                                  $check_code='60';
                                @endphp
                              @else
                                @php
                                  $check_code=$result['user_data']->country_code;
                                @endphp
                              @endif
                            <option value="{{$jescode->country_code}}" @if($jescode->country_code==$check_code) selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
                            @endforeach
                            @endif
                          </select>
                              </div>
                              <input class="form-control" type="text" name="phone" id="phone"placeholder="@lang('website.Please enter your valid phone number')" value="{{ $result['user_data']->phone }}" onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )" maxlength="10" minlength="9" required>
                              <span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>                            </div>
                              <input type="hidden" name="id" value="{{$result['user_data']->id}}" id="id" >
                          </div>
                          <div class="col-12 col-sm-12 account_form">
                                <button type="submit" class="btn btn-secondary">@lang('website.Send')</button>
 
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


@endsection
