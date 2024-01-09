
@extends('web.layout')
@section('content')
<style>
.login-3-page-content{
    padding-top: 35px !important;
    padding-bottom: 35px !important;
	max-width: 450px;
	padding: 0 40px;
	margin:auto;
}
.login-3-section-header {
    margin-bottom: 40px;
	
}
.login-3-section-header-title {
    margin-bottom: 0;
	font-size: 32px;
	font-weight: 700 !important;
}
.login-3-note-success {
    color: #56ad6a;
    background-color: #ecfef0;
    border-color: #56ad6a;
}
.login-3-form-vertical {
    margin-bottom: 15px;
}
.login-3-form-vertical label[for] {
    cursor: pointer;
}
.login-3-form-vertical label {
    text-align: left;
	display: block;
    margin-bottom: 10px;
}
.label, label:not(.variant__button-label):not(.text-label) {
    font-weight: 700;
    font-size: 15px;
}
.login-3-grid {
    list-style: none;
    padding: 0;
    margin: 0 0 0 -22px;
}
.login-3-one-half {
    width: 50%;
}
.login-3-grid-item {
    float: left;
    padding-left: 22px;
    min-height: 1px;
}
.login-3-grid:after {
    content: "";
    display: table;
    clear: both;
}
.login-3-label-info
{
   font-size: 0.85rem;
}
.login-3-sl-container {
    display: inline-block;
    width: 100%;
    background-color: transparent;
    border-width: 0px;
    padding: 0;
    max-width: 100%;
}
.login-3-sl-wrapper {
    text-align: center;
}
.login-3-sl-vertical.login-3-oxi-icon-left a {
    padding-left: 0px;
}
a.login-3-social-login.login-3-facebook {
    border-color: #2d5073;
    background-color: #3b5998;
}
.login-3-sl-vertical a.login-3-social-login {
    text-align: left;
    
    height: 40px;
    display: block;
    background-size: 40px 40px;
    border-radius: 4px;
    color: white;
    font-family: "Merriweather Sans", sans-serif;
    font-size: 14px;
    margin-bottom: 10px;
    -webkit-font-smoothing: antialiased;
    line-height: 40px;
}
a.login-3-facebook {
    color: #FFF;
    border-color: #2d5073;
    background-color: #3b5998;
}
a.login-3-facebook:hover {
    color: #fff !important;
    border-color: rgba(0,0,0,0.2);
}
a.login-3-google:hover {
    color: #fff !important;
    border-color: rgba(0,0,0,0.2);
}
a.login-3-social-login:hover {
    opacity: 0.8;
}
a.login-3-oxi-social-login, a.login-3-social-login {
    text-decoration: none;
    cursor: pointer;
}
.login-3-sl-vertical i {
    float: left;
    margin-right: 15px;
    border-radius: 4px 0 0 4px;
}
.login-3-sl-vertical .login-3-oxi-icon {
    height: 40px;
    line-height: 40px;
    width: 40px;
    text-align: center;
    font-size: 24px;
    border-radius: 0px 4px 4px 0px;
    background-color: rgba(255, 255, 255, 0.1);
}
a.login-3-social-login.login-3-google {
    border-color: #c23321;
    background-color: #dd4b39;
}
.login-3-register-btn {
    width: 100%;
    font-size: 17px;
    font-weight: 700 !important;
    padding: 11px 25px;
    border-radius: 3px;
    border: solid 1px transparent;
    margin-bottom: 30px;
    text-transform: capitalize;
}
.login-3-text-right {
    text-align: right!important;
}
.login-3-errors {
    color: #d02e2e;
    background-color: #fff6f6;
    border-color: #d02e2e !important;
}

.login-3-errors, .login-3-note {
    border-radius: 0;
    padding: 6px 12px;
    margin-bottom: 15px;
    border: 1px solid transparent;
    text-align: left;
}
.login-3-errors ul {
    list-style: disc outside;
    margin-left: 20px !important;
	margin:0;
}
.login-3-mb-30
{
    margin-bottom: 30px;
}
.login-3-form-vertical input, .login-3-form-vertical select, .login-3-form-vertical textarea {
    display: block;

	background-color: inherit;
    color: inherit;
	border: 1px solid;
    border-color: #e8e8e1;
    max-width: 100%;
	width: 100%;
    padding: 8px 10px;
    border-radius: 0;
}
.login-3-form-vertical input.input-full, .login-3-form-vertical .login-3-form-vertical select.input-full, textarea.input-full {
    width: 100%;
}


@media only screen and (min-width: 769px){
	.login-3-main-content {
		min-height: 700px;
	}
}
@media only screen and (max-width: 768px){
	.login-3-page-content {
    padding: 15px !important;
}
.login-3-section-header-title {
	font-size: 20px;
}
.label, label:not(.variant__button-label):not(.text-label) {
    font-size: 13px;
}
.login-3-section-header {
    margin-bottom: 25px;
}
.login-3-form-vertical label {
    margin-bottom: 5px;
}
.login-3-label-info {
    font-size: 0.85em;
}
.login-3-register-btn {
    font-size: 14px;
    font-weight: 400 !important;
    padding: 9px 25px;
}
}

</style>
<main class="login-3-main-content" id="login-3-MainContent">
    <div class="login-3-page-content">
  		<header class="login-3-section-header">
    		<h1 class="login-3-section-header-title">Create Account</h1>
  		</header>
		  @if(Session::has('error'))
		  <div class="errors"><ul><li>{!! session('error') !!}</li></ul></div>
			@endif
			@if( count($errors) > 0)
				@foreach($errors->all() as $error)
				<div class="login-3-errors"><ul><li>{{ $error }}</li></ul></div>
				@endforeach
			@endif

			@if(Session::has('resetsuccess'))
			<div class="login-3-note-success login-3-note" id="ResetSuccess">
				We've sent you an email with a link to update your password.
			</div> 
			@endif
			@if( count($errors) > 0)
			<div class="login-3-errors"><ul>
			<li class=" form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please re-enter your password')</li>
			<li class=" form-text text-muted re-password-content" style="color:red !important;" hidden>@lang('website.Password does not match the confirm password')</li>
			<li class=" form-text text-muted len-password-content" style="color:red !important;" hidden>@lang('website.Minimum length of password 8 characters')</li>
			<li class=" form-text text-muted cap-password-content" style="color:red !important;" hidden>@lang('website.Password should have at least one uppercase')</li>
			<li class=" form-text text-muted num-password-content" style="color:red !important;" hidden>@lang('website.Password should have at least one number')</li>
			</ul></div>
			@endif

				
  		<div id="CustomerLoginForm" class="login-3-form-vertical">

		  <div class="col-12" style="margin-bottom:20px">
							<span style="color:red;font-weight:600;font-size:1rem;" id="regres"></span>
						</div>
						
			<form name="signup" id="ajaxForm" enctype="multipart/form-data" class="form-validate" action="{{ URL::to('/signupProcess')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" name="appname" value="{{ $result['commonContent']['setting'][18]->value }} ">

				<div class="login-3-mb-30">
					<label for="firstName"><strong style="color: red;">*</strong> First Name</label>
					<input name="firstName" type="text" id="firstName" class="input-full field-validate" value="{{ old('firstName') }}" >
					<span class="form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please enter your first name')</span>
				</div>

				<div class="login-3-mb-30">
				<label for="lastName"><strong style="color: red;">*</strong> Last Name</label>
				<input  name="lastName" type="text" class="input-full field-validate" id="lastName"  value="{{ old('lastName') }}">
				<span class="form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please enter your last name')</span>
				</div>

				<div class="login-3-mb-30">
				<label for="customers_dob">Date of Birth</label>
				<input  name="customers_dob" type="text" class="input-full customers_dob" data-provide="datepicker" id="customers_dob" value="{{ old('customers_dob') }}">
				<span class="form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please enter your date of birth')</span>
				</div>
				
				<div class="login-3-mb-30">
				<label for="email"><strong style="color: red;">*</strong> Email</label>
				<input type="email" name="email" id="emailreg" class="input-full email-validate" value="{{ old('email') }}">
				<span class="form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please enter your valid email address')</span>
				</div>

				<div class="login-3-mb-30">
				<label for="password"><strong style="color: red;">*</strong> Password</label>
				<input type="password" value="" type="password" name="password" id="password"  class="input-full password">
				<span class="form-text text-muted error-content">Note: Password Must Have One Uppercase & Letter and Number and Must Have 8 Character Minimum</span>	<br>
										<span class="form-text text-muted error-content" style="color:red !important;" hidden >@lang('website.Please enter your password')</span>
				</div>

				<div class="login-3-mb-30">
				<label for="re_password"><strong style="color: red;">*</strong> Confirm Password</label>
				<input type="password" style="width:100%;"class="input-full password" id="re_password" name="re_password" placeholder="Enter Your Password">

				<span class="form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please re-enter your password')</span>
											<span class="form-text text-muted error-content re-password-content" style="color:red !important;" hidden>@lang('website.Password does not match the confirm password')</span>

											<span class="form-text text-muted len-password-content" hidden>@lang('website.Minimum length of password 8 characters')</span>

													<span class="form-text text-muted cap-password-content" hidden>@lang('website.Password should have at least one uppercase')</span>

													<span class="form-text text-muted num-password-content" hidden>@lang('website.Password should have at least one number')</span>
				</div>

				<div class="login-3-mb-30">
				<label for="gender"><strong style="color: red;">*</strong> Gender</label>
				<select class="input-full field-validate" name="gender" id="gender">
					<option selected value="">@lang('website.Choose...')</option>
					<option value="0" @if(!empty(old('gender')) and old('gender')==0) selected @endif)>@lang('website.Male')</option>
					<option value="1" @if(!empty(old('gender')) and old('gender')==1) selected @endif>@lang('website.Female')</option>
				</select>
				<span class="form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please select your gender')</span>
				</div>

				<div class="login-3-mb-30">
				<label for="phone"><strong style="color: red;">*</strong> Phone Number</label>
				
				<div class="input-group-prepend" style="width: 19%;display: inline-block;">           						
					<select class="input-full field-validate" name="ccode" id="ccode">
					@if(!empty($code))
					@foreach($code as $jescode)
					<option value="{{$jescode->country_code}}" @if($jescode->country_code=='60') selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
					@endforeach
					@endif
					</select>
				</div>
				<input  name="phone" type="text" class="input-full phone-validate" id="phone" placeholder="@lang('website.Please enter your phone number')" value="{{ old('phone') }}" style="width: 78%;display: inline-block;">
				<span class="form-text text-muted error-content" style="color:red !important;" style="width:100%;" hidden>@lang('website.Please enter your valid phone number')</span>
				</div>

				<input id="ckbox" required style="margin:4px;width: 3%;display: inline-block;" class="form-controlt checkbox-validate" type="checkbox">
				@lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a style="color: #0000ff;" href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}">@endif @lang('website.Terms and Services')@if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a style="color: #0000ff; href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}">@endif @lang('website.Privacy Policy')@if(!empty($result['commonContent']['pages'][1]->slug))</a> @endif &nbsp; and &nbsp; @if(!empty($result['commonContent']['pages'][2]->slug))<a style="color: #0000ff; href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}">@endif @lang('website.Refund Policy') @if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif.
				<span class="form-text text-muted error-content" style="color:red !important;" hidden>@lang('website.Please accept our terms and conditions')</span>

				
			
				<p>
					<button type="button" class="login-3-register-btn btn-secondary btn btn--full preg1">
					Create
					</button>
				</p>
				
				
			</form>
			<div class="login-3-sl-container">
        		<div class="login-3-sl-wrapper">
					<div class="login-3-sl-vertical login-3-social-wrap login-3-oxi-con-left" style="padding-left:0px;">
						@if($result['commonContent']['setting'][2]->value==1)
							<a class="login-3-social-login login-3-facebook" href="login/facebook">
								<i class="fa fa-facebook login-3-oxi-icon login-3-oxi-icon-facebook"></i>
								<span>Sign in with Facebook</span>
							</a>
						@endif
						@if($result['commonContent']['setting'][61]->value==1)
							<a class="login-3-social-login login-3-google" href="login/google">
								<i class="fa fa-google login-3-oxi-icon login-3-oxi-icon-google"></i>
								<span>Sign in with Google</span>
							</a>
						@endif
					</div>
        		</div>
    		</div>
		</div>

		
		<div style="clear:both"></div>
	</div>
</main>

@include('web.multibannerstwo.banner38') 

<!-- login Content -->
<!-- <div class="container-fuild">
	<nav aria-label="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
			  <li class="breadcrumb-item active" aria-current="page">@lang('website.Login')</li>

			</ol>
		</div>
	  </nav>
  </div> 

<section class="page-area pro-content">
	<div class="container">


			<div class="row">
				<div class="col-12 col-sm-12 col-md-6">
					@if(Session::has('loginError'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="">@lang('website.Error'):</span>
									{!! session('loginError') !!}

									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
					@endif
					@if(Session::has('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="">@lang('website.success'):</span>
									{!! session('success') !!}

									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
					@endif
					<div class="col-12"><h4 class="heading login-heading">@lang('website.LOGIN')</h4></div>
					<div class="registration-process">

						<form  enctype="multipart/form-data"  class="form-validate-login" action="{{ URL::to('/process-login')}}" method="post">
							{{csrf_field()}}
								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Email')</label></div>
									<div class="input-group col-12">
										<input type="email" name="email" id="email" placeholder="@lang('website.Please enter your valid email address')"class="form-control email-validate-login">
										<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
								 </div>
								</div>
								<div class="from-group mb-3">
										<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Password')</label></div>
										<div class="input-group col-12">
											<input type="password" name="password" id="password-login" placeholder="Please Enter Password" class="form-control password-login">
											
											<span class="form-text text-muted error-content" hidden>@lang('website.This field is required')</span>										</div>
									</div>

									<div class="col-12 col-sm-12">
										<button type="submit" class="btn btn-secondary">@lang('website.Login')</button>

										<?php  $forgot_email = DB::table('alert_settings')->where('forgot_email', 1)->first();
if($forgot_email != '')
{
?>
								<a href="{{ URL::to('/forgotPassword')}}" class="btn btn-link">@lang('website.Forgot Password')</a>

								<?php  }?>
									
							
								</div>
						</form>
					</div>
				</div>

				<div class="col-12 col-sm-12 col-md-6">
						<div class="col-12"><h4 class="heading login-heading">@lang('website.NEW CUSTOMER')</h4></div>
						<div class="registration-process">
							@if( count($errors) > 0)
								@foreach($errors->all() as $error)
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
										<span class="sr-only">@lang('website.Error'):</span>
										{{ $error }}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								 @endforeach
							@endif

							@if(Session::has('error'))
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">@lang('website.Error'):</span>
									{!! session('error') !!}

									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif

							<form name="signup" enctype="multipart/form-data" class="form-validate" action="{{ URL::to('/signupProcess')}}" method="post">
								{{csrf_field()}}
								<input type="hidden" name="appname" value="{{ $result['commonContent']['setting'][18]->value }} ">
								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.First Name')</label></div>
									<div class="input-group col-12">
										<input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="@lang('website.Please enter your first name')" value="{{ old('firstName') }}">
										<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your first name')</span>
									</div>
								</div>
								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Last Name')</label></div>
									<div class="input-group col-12">										
										<input  name="lastName" type="text" class="form-control field-validate" id="lastName" placeholder="@lang('website.Please enter your last name')" value="{{ old('lastName') }}">
										<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your last name')</span>
									</div>
								</div>

								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Date of Birth')</label></div>
									<div class="input-group col-12 date">
										<input  name="customers_dob" type="text" class="form-control customers_dob" data-provide="datepicker" id="customers_dob" placeholder="@lang('website.Please enter your date of birth')" value="{{ old('customers_dob') }}">
										<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your date of birth')</span>
									</div>
								</div>

									<div class="from-group mb-3">
										<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Email Adrress')</label></div>
										<div class="input-group col-12">
											<input  name="email" type="text" class="form-control email-validate" id="inlineFormInputGroup" placeholder="@lang('website.Please enter your email address')" value="{{ old('email') }}">
											<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
										</div>
									</div>
									<div class="from-group mb-3">
											<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Password')</label></div>
											<div class="input-group col-12">
												<input name="password" id="password" type="password" class="form-control password"  placeholder="@lang('website.Please enter your password')">
												<span class="form-text text-muted error-content">Note: Password Must Have One Uppercase & Letter and Number and Must Have 8 Character Minimum</span>	<br>
												<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your password')</span>


											</div>
										</div>
										<div class="from-group mb-3">
												<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Confirm Password')</label></div>
												<div class="input-group col-12">
													<input type="password" style="width:100%;"class="form-control password" id="re_password" name="re_password" placeholder="Enter Your Password">
													<span class="form-text text-muted error-content" hidden>@lang('website.Please re-enter your password')</span>
													<span class="form-text text-muted re-password-content" hidden>@lang('website.Password does not match the confirm password')</span><br>

													<span class="form-text text-muted len-password-content" hidden>@lang('website.Minimum length of password 8 characters')</span>

													<span class="form-text text-muted cap-password-content" hidden>@lang('website.Password should have at least one uppercase')</span>

													<span class="form-text text-muted num-password-content" hidden>@lang('website.Password should have at least one number')</span>
												</div>
											</div>
											<div class="from-group mb-3">
												<div class="col-12" > <label for="inlineFormInputGroup"><strong  style="color: red;">*</strong>@lang('website.Gender')</label></div>
												<div class="input-group col-12">
													<select class="form-control field-validate" name="gender" id="inlineFormCustomSelect">
														<option selected value="">@lang('website.Choose...')</option>
														<option value="0" @if(!empty(old('gender')) and old('gender')==0) selected @endif)>@lang('website.Male')</option>
														<option value="1" @if(!empty(old('gender')) and old('gender')==1) selected @endif>@lang('website.Female')</option>
													</select>
													<span class="form-text text-muted error-content" hidden>@lang('website.Please select your gender')</span>
												</div>
											</div>
											<div class="from-group mb-3">
												<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Phone Number')</label></div>
												<div class="input-group col-12">
													 <div class="input-group-prepend">
                                  						{{-- <div class="input-group-text">+60</div> --}}
                                  						<select class="form-control field-validate" name="ccode" id="ccode">
														@if(!empty($code))
														@foreach($code as $jescode)
														<option value="{{$jescode->country_code}}" @if($jescode->country_code=='60') selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
														@endforeach
														@endif
													</select>
                              						</div>
													<input  name="phone" type="text" class="form-control phone-validate" id="phone" placeholder="@lang('website.Please enter your phone number')" value="{{ old('phone') }}">
													<span style="width:100%;" class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid phone number')</span>
												</div>
											</div>
											<div class="from-group mb-3">
													<div class="input-group col-12">
														<input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
														@lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}">@endif @lang('website.Terms and Services')@if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}">@endif @lang('website.Privacy Policy')@if(!empty($result['commonContent']['pages'][1]->slug))</a> @endif &nbsp; and &nbsp; @if(!empty($result['commonContent']['pages'][2]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}">@endif @lang('website.Refund Policy') @if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif.
														<span class="form-text text-muted error-content" hidden>@lang('website.Please accept our terms and conditions')</span>
													</div>
												</div>
										<div class="col-12 col-sm-12">
												<button type="submit" class="btn btn-light swipe-to-top">@lang('website.Create an Account')</button>

										</div>
							</form>
						</div>
				</div>
				<div class="col-12 col-sm-12 my-5">
						<div class="registration-socials">
					<div class="row align-items-center justify-content-between">
									<div class="col-12 col-sm-6">
										@lang('website.Access Your Account Through Your Social Networks')
									</div>
									<div class="col-12 col-sm-6 right">

											@if($result['commonContent']['setting'][61]->value==1)
												<a href="login/google" type="button" style="background: #ec4949;min-width: auto;-webkit-appearance: button-bevel;" class="btn btn-google"><i class="fab fa-google-plus-g"></i>&nbsp; @lang('website.Google') </a>
											@endif
											@if($result['commonContent']['setting'][2]->value==1)
												<a  href="login/facebook" type="button" style="background: #5c5cd8;min-width: auto;-webkit-appearance: button-bevel;" class="btn btn-facebook"><i class="fab fa-facebook-f"></i>&nbsp;@lang('website.Facebook')</a>
											@endif
									</div>
							</div>
					</div>
				</div>
			</div>

	</div>
</section> -->

<style>
	  .input-group a
	  {
		  color: #6610f2;
	  }
	  
</style>




<script>

	jQuery(document).on('click', '.preg1', function(e){




		var error = "";
		jQuery(".field-validate").each(function() {
				if(this.value == '') {
					jQuery(this).css('border-color', 'red');
					jQuery(this).parents(".input-group").addClass('has-error');
					jQuery(this).next(".error-content").removeAttr('hidden');
					error = "has error";
				}else{
					jQuery(this).css('border-color', '#dee2e6');
					jQuery(this).parents(".input-group").removeClass('has-error');
					jQuery(this).next(".error-content").attr('hidden', true);
				}
		});
		var check = 0;
		jQuery(".password").each(function() {
				var regex = "^\\s+$";
				if(this.value.match(regex)) {
					jQuery(this).css('border-color', 'red');
					jQuery(this).parents(".input-group").addClass('has-error');
					jQuery(this).next(".error-content").removeAttr('hidden');
					error = "has error";
				}else{
					if(check == 1){
						var res = passwordMatch();

							if(res=='matched'){
								jQuery(this).css('border-color', '#dee2e6');
								jQuery('.password').parents(".input-group").removeClass('has-error');
								jQuery('.re-password-content').attr('hidden', true);
								jQuery('.len-password-content').attr('hidden', true);
								jQuery('.cap-password-content').attr('hidden', true);
								jQuery('.num-password-content').attr('hidden', true);
							}else if(res=='error'){
								jQuery(this).css('border-color', 'red');
								jQuery('.password').parents(".input-group").addClass('has-error');
								jQuery('.len-password-content').attr('hidden', true);
								jQuery('.cap-password-content').attr('hidden', true);
								jQuery('.num-password-content').attr('hidden', true);
								jQuery('.re-password-content').removeAttr('hidden');
								error = "has error";
							}else if(res=='lerror'){
								jQuery(this).css('border-color', 'red');
								jQuery('.password').parents(".input-group").addClass('has-error');
								jQuery('.num-password-content').attr('hidden', true);
								jQuery('.cap-password-content').attr('hidden', true);
								jQuery('.len-password-content').removeAttr('hidden');
								error = "has error";
							}else if(res=='cerror'){
								jQuery(this).css('border-color', 'red');
								jQuery('.password').parents(".input-group").addClass('has-error');
								jQuery('.num-password-content').attr('hidden', true);
								jQuery('.cap-password-content').removeAttr('hidden');
								error = "has error";
							}else if(res=='nuerror'){
								jQuery(this).css('border-color', 'red');
								jQuery('.password').parents(".input-group").addClass('has-error');
								jQuery('.cap-password-content').attr('hidden', true);
								jQuery('.num-password-content').removeAttr('hidden');
								error = "has error";
							}
						}else{
							jQuery(this).css('border-color', '#dee2e6');
							jQuery(this).parents(".input-group").removeClass('has-error');
							jQuery(this).next(".error-content").attr('hidden', true);
						}
						check++;
					}

		});

		jQuery(".number-validate").each(function() {
				if(this.value == '' || isNaN(this.value)) {
				jQuery(this).css('border-color', 'red');
					jQuery(this).parents(".input-group").addClass('has-error');
					jQuery(this).next(".error-content").removeAttr('hidden');
					error = "has error";
				}else{
					jQuery(this).css('border-color', '#dee2e6');
					jQuery(this).parents(".input-group").removeClass('has-error');
					jQuery(this).next(".error-content").attr('hidden', true);
				}
		});

			jQuery(".email-validate").each(function() {
				var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
				if(this.value != '' && validEmail.test(this.value)) {
					jQuery(this).css('border-color', '#dee2e6');
					jQuery(this).parents(".input-group").removeClass('has-error');
					jQuery(this).next(".error-content").attr('hidden', true);
				}else{
					jQuery(this).css('border-color', 'red');
					jQuery(this).parents(".input-group").addClass('has-error');
					jQuery(this).next(".error-content").removeAttr('hidden');
					error = "has error";
				}
			});

			jQuery(".checkbox-validate").each(function() {

				if(jQuery(this).prop('checked') == true){
					jQuery(this).css('border-color', '#dee2e6');
					jQuery(this).parents(".input-group").removeClass('has-error');
					jQuery(this).closest('.checkbox-parent').children('.error-content').attr('hidden', true);
				}else{
					jQuery(this).css('border-color', 'red');
					jQuery(this).parents(".input-group").addClass('has-error');
					jQuery(this).closest('.checkbox-parent').children('.error-content').removeAttr('hidden');
					error = "has error";
				}

			});

			jQuery(".phone-validate").each(function() {
				if(this.value == '' || isNaN(this.value) || this.value.length < 7) {
					jQuery(this).css('border-color', 'red');
					jQuery(this).parents(".input-group").addClass('has-error');
					jQuery(this).next(".error-content").removeAttr('hidden');
					error = "has error";
				}else{
					jQuery(this).css('border-color', '#dee2e6');
					jQuery(this).parents(".input-group").removeClass('has-error');
					jQuery(this).next(".error-content").attr('hidden', true);
				}

			});

            if ($("#ckbox:checked").length == 0){
				$("#ckbox").prop("checked", true); 
				error = "has error";
			}

			if(error=="has error"){
				return false;
			} else {

				var email = $('#emailreg').val();
				var phone = $('#phone').val();

				jQuery(function ($) {
				jQuery.ajax({
					headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
					url: '{{ URL::to("/signupProcessMolla")}}',
					type: "POST",
					data: 'email='+email+'&phone='+phone,
					beforeSend: function() {
						$('#regres').html('loading ...')
					},
				success: function (res) {
					 if(res.email == 'true'){
						jQuery("#regres").html('Email is already exist');
					} else if(res.phone == 'true'){
						jQuery("#regres").html('Phone Number already exist');
					} else{
						$("#ajaxForm").submit();
						jQuery(".preg1").prop("disabled", true);
					}
				},
				});
			});

		}
 	});
 </script>

@endsection