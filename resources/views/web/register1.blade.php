
@extends('web.layout')
@section('content')

<style>

.text-muted {
    color: red !important;
	font-size:1rem !important;
}
	.reg1{
		margin-top: 40px;
	}
	.form-wrapper:not(:first-child) {
    margin-top: 30px;
	margin-bottom: 50px;
}
.form-wrapper > * .form-group {
    margin: 25px 0 0;
}
.reg1 .form-control {
    display: block;
    width: 100%;
    height: calc(3.5em + 0.75rem + 2px);
    padding-right: calc(1.5em + 0.75rem);
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #f7f7f8;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.input-group-prepend {
    margin-right: -1px;
}

@media screen and (min-width: 700px) and (max-width: 800px){

 .col-sm-9 {
    flex: 0 0 100% !important;
    max-width: 100%  !important;
}
}

@media (min-width: 992px){
	.col-md-18 {
		-ms-flex: 0 0 66.666667%;
		flex: 0 0 66.666667%;
		max-width: 66.666667%;
	}
	.col-sm-9 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}
}
</style>


<div class="container reg1">
    <div class="row justify-content-center">
    <div class="col-md-18 col-lg-12">
				<h2 style="margin: 0 0 20px;" class="text-center">Create an Account</h2>

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

				<div class="form-wrapper">
					<p style="font-size:1rem">To access your whishlist, address book and contact preferences and to take advantage of our speedy checkout, create an account with us now. Already our member?  <a href="#" class="js-dropdn-link common-text" data-panel="#dropdnAccount">Click here</a> to login</p>

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


						<div class="col-12" style="margin-bottom:20px">
							<span style="color:red;font-weight:600;font-size:1rem;" id="regres"></span>
						</div>

						<form name="signup" id="ajaxForm" enctype="multipart/form-data" class="form-validate" action="{{ URL::to('/signupProcess')}}" method="post">
						{{csrf_field()}}

						<input type="hidden" name="appname" value="{{ $result['commonContent']['setting'][18]->value }} ">


						<div class="row">
							<div class="col-sm-9">
								<div class="form-group">
									<input  name="firstName" type="text" class="form-control field-validate" id="firstName" placeholder="@lang('website.First Name')" value="{{ old('firstName') }}">
									<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your first name')</span>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="form-group">
								<input  name="lastName" type="text" class="form-control field-validate" id="lastName" placeholder="@lang('website.Last Name')" value="{{ old('lastName') }}">
									<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your last name')</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-9">
								<div class="form-group">
								<input  name="customers_dob" type="text" class="form-control customers_dob" data-provide="datepicker" id="customers_dob" placeholder="@lang('website.Date of Birth')" value="{{ old('customers_dob') }}">
									<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your date of birth')</span>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="form-group">
								<select class="form-control field-validate" name="gender" id="inlineFormCustomSelect">
										<option selected value="">@lang('website.Gender')</option>
										<option value="0" @if(!empty(old('gender')) and old('gender')==0) selected @endif)>@lang('website.Male')</option>
										<option value="1" @if(!empty(old('gender')) and old('gender')==1) selected @endif>@lang('website.Female')</option>
									</select>
									<span class="form-text text-muted error-content" hidden>@lang('website.Please select your gender')</span>
								</div>
							</div>
						</div>
						<div class="form-group">
						<input  name="email" type="text" class="form-control email-validate" id="emailreg" placeholder="@lang('website.Email Adrress')" value="{{ old('email') }}">
									<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
						</div>
						<div class="form-group">
						<input name="password" id="password" type="password" class="form-control password"  placeholder="@lang('website.Password')">
									<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your password')</span>
						</div>
						<div class="form-group">
						<input type="password" class="form-control password" id="re_password" name="re_password" placeholder="@lang('website.Confirm Password')">
									<span class="form-text text-muted error-content" hidden>@lang('website.Please re-enter your password')</span>
									<span class="form-text text-muted re-password-content" hidden>@lang('website.Password does not match the confirm password')</span>
						</div>
						

						<div class="form-group input-group">
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


										<input style="display:inline-block;width:45%;" name="phone" type="text" class="form-control field-validate" id="phone" placeholder="Mobile Number (e.g. 1234567890)" value="{{ old('phone') }}">
									<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid phone number')</span>
									
								
									</div>

								<div class="clearfix input-group" style="font-size:0.95rem">
						<input id="ckbox" required style="margin:4px;display:block;"class="form-controlt checkbox-validate" type="checkbox">
									@lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}">@endif @lang('website.Terms and Services')@if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}">@endif @lang('website.Privacy Policy')@if(!empty($result['commonContent']['pages'][1]->slug))</a> @endif &nbsp; and &nbsp; @if(!empty($result['commonContent']['pages'][2]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}">@endif @lang('website.Refund Policy') @if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif.
									<span class="form-text text-muted error-content" hidden>@lang('website.Please accept our terms and conditions')</span>
						</div>
						<div class="text-center" style="margin-top:30px">
						<button style="padding:10px;color:#fff;min-width:195px" type="button" class="btn common-bg preg1">@lang('website.Create an Account')</button>
						</div>
					</form>
				</div>
			</div>
    </div>
</div>


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
