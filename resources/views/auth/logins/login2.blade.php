<!-- login Content -->
<div class="container-fuild">
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

		<div class="row justify-content-center">
			<div class="col-12 col-sm-12 col-md-6 justify-content-center">
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

				<!-- @if(Session::has('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">@lang('website.Success'):</span>
						{!! session('success') !!}

						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif -->
 
			</div>
		</div>
	  
	  
		<div class="row justify-content-center">	   
		  
		
		  <div class="col-12 col-sm-12 col-md-6">
			  
			<div class="col-12 my-5 px-0">
				
				<ul class="nav nav-tabs" id="registerTab" role="tablist">
					<li class="nav-item">
					  <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">@lang('website.Login')</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">@lang('website.Signup')</a>
					</li>
					
				  </ul>
				  <div class="tab-content" id="registerTabContent">
					<div class="tab-pane fade show active form-validate-login" id="login" role="tabpanel" aria-labelledby="login-tab">
						<div class="registration-process">

						<div class="col-12" style="margin-bottom:20px">
							<span style="color:red;font-weight:600;font-size:1rem;" id="loginres"></span>
						</div>

						<form  enctype="multipart/form-data"  method="post">
							{{csrf_field()}}
						
							<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Email')</label></div>
								<div class="input-group col-12">
								<input type="email" name="email" id="email" placeholder="@lang('website.Please enter your valid email address')" class="form-control email-validate-login field-validate1">
								<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
							</div>
						</div>
						<div class="from-group mb-3">
								<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Password')</label></div>
								<div class="input-group col-12">
									<input type="password" name="password" id="password-login" placeholder="Please Enter Password" class="form-control password-login field-validate1">
									
									<span class="form-text text-muted error-content" hidden>Please enter your valid Password</span>										</div>
							</div>
							  <div class="col-12 col-sm-12">
								  <button type="button" class="btn btn-secondary swipe-to-top plogin1">@lang('website.Login')</button>
								  <?php  $forgot_email = DB::table('alert_settings')->where('forgot_email', 1)->first();
if($forgot_email != '')
{
?>
								<a href="{{ URL::to('/forgotPassword')}}" class="btn btn-link">@lang('website.Forgot Password')</a>

								<?php  }?>

								<!-- @if($result['checkout_button'] == 1)
									<p style="text-align:center; margin-top:30px;">
										<strong>OR</strong>
									</p>
									<a href="{{url('/guest_checkout')}}" type="submit" class="btn btn-light swipe-to-top btn-block">
										@lang('website.Guest Checkout')
									</a>
									@endif -->

							  </div>
						</form>
						</div>
						
					</div>
					<div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
						<div class="registration-process">

						<div class="col-12" style="margin-bottom:20px">
							<span style="color:red;font-weight:600;font-size:1rem;" id="regres"></span>
						</div>

						<form name="signup" id="ajaxForm" enctype="multipart/form-data" class="form-validate" action="{{ URL::to('/signupProcess')}}" method="post">
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
									<input  name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" placeholder="@lang('website.Please enter your last name')" value="{{ old('lastName') }}">
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
										<input  name="email" type="text" class="form-control email-validate" id="emailreg" placeholder="@lang('website.Please enter your email address')" value="{{ old('email') }}">
										<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
									</div>
								</div>
								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Password')</label></div>
									<div class="input-group col-12">
										<input name="password" id="password" type="password" class="form-control password"  placeholder="@lang('website.Please enter your password')">
										<span class="form-text text-muted error-content">Note: Password Must Have One Uppercase & Letter and Number and Must Have 8 Character Minimum</span>	<br>
										<span class="form-text text-muted error-content" hidden >@lang('website.Please enter your password')</span>

									</div>
								</div>
								<div class="from-group mb-3">
									<div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>@lang('website.Confirm Password')</label></div>
										<div class="input-group col-12">
											<input type="password" class="form-control password" id="re_password" name="re_password" style="width:100%;" placeholder="@lang('website.Please enter your password')"><br>
											<span class="form-text text-muted error-content" hidden>@lang('website.Please re-enter your password')</span>
											<span class="form-text text-muted error-content re-password-content" hidden>@lang('website.Password does not match the confirm password')</span>

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
											<span class="form-text text-muted error-content" style="width:100%;" hidden>@lang('website.Please enter your valid phone number')</span>
										</div>
									</div>
									<div class="from-group mb-3">
										<div class="input-group col-12">
											<input id="ckbox" required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
											@lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}">@endif @lang('website.Terms and Services')@if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}">@endif @lang('website.Privacy Policy')@if(!empty($result['commonContent']['pages'][1]->slug))</a> @endif &nbsp; and &nbsp; @if(!empty($result['commonContent']['pages'][2]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}">@endif @lang('website.Refund Policy') @if(!empty($result['commonContent']['pages'][3]->slug))</a>@endif.
											<span class="form-text text-muted error-content" hidden>@lang('website.Please accept our terms and conditions')</span>
										</div>
									</div>

									

							  <div class="col-12 col-sm-12">
								<button type="button" class="btn btn-light swipe-to-top preg1">@lang('website.Create an Account') </button>
							</div>
						</form>
						</div>
					</div>
					<div class="registration-socials">
						<div class="row align-items-center justify-content-center">
							
								<div class="col-12">
									@lang('website.Access Your Account Through Your Social Networks')
								</div>
								<div class="col-12 right">
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

		</div>
	</div>
  </section>

  <style>
	  .input-group a
	  {
		  color: #6610f2;
	  }
	  
</style>


<script>
jQuery(document).on('click', '.plogin1', function(e){
		jQuery("#loginres").html('');

		var error = "";
		jQuery(".field-validate1").each(function() {
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

			if(error=="has error"){
				return false;
			} else {


  var email = $('#email').val();
  var password = $('#password-login').val();

    jQuery(function ($) {
     jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: '{{ URL::to("/process-login_molla")}}',
        type: "POST",
        data: 'email='+email+'&password='+password,
		beforeSend: function() {
            $('#loginres').html('loading ...')
        },
       success: function (res) {
        if(res.status == '1'){
            jQuery("#loginres").html('Email or password is incorrect');
        } else if(res.status == '2'){
            jQuery("#loginres").html('You Are Not Allowed With These Credentialss!');
        } else if(res.status == '3'){
            location.href = '/otpVerfication/'+res.userID;
        } else {
            location.reload();
        }
       },
     });
   });

}
 });
 </script>


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
            if(this.value == '') {
					jQuery(this).css('border-color', 'red');
					jQuery(this).parents(".input-group").addClass('has-error');
					jQuery(this).next(".error-content").removeAttr('hidden');
					error = "has error";
				}else{
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
					}
				},
				});
			});

		}
 	});
 </script>