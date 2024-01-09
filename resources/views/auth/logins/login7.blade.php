<style>


.lds-dual-ringlog7.hidden { 
display: none;
}
.lds-dual-ringlog7 {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ringlog7:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 35% auto;
  border-radius: 50%;
  border: 6px solid #333;
  border-color: #333 transparent #333 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


.overlaylog7 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: rgba(0,0,0,.77); */
    z-index: 999;
    opacity: 1;
    transition: all 0.5s;
}

.form-box {
    padding: 3.7rem 6rem 6.4rem;
}
.form-box {
    max-width: 590px;
    background-color: #fff;
    padding: 2.2rem 2rem 4.4rem;
    -webkit-box-shadow: 0 3px 16px rgb(51 51 51 / 10%);
    box-shadow: 0 3px 16px rgb(51 51 51 / 10%);
}
.form-box, .touch-container .lead {
    margin-left: auto;
    margin-right: auto;
}
.form-tab .nav.nav-pills {
    color: #333;
    border-bottom: 0.1rem solid #ebebeb;
}

.nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.form-tab .form-group {
    margin-bottom: 1.3rem;
}
label {
    color: #666;
    font-weight: 300;
    font-size: 1rem;
    margin: 0 0 1.1rem;
}
.form-group .form-control, .form-group .select-custom {
    margin-bottom: 0;
}
.form-control {
    height: 41px;
  
    font-size: 1rem;
    line-height: 1.5;
    font-weight: 300;
    color: #777;
    background-color: #fafafa;
    border: 1px solid #ebebeb;
    border-radius: 0;
    margin-bottom: 2rem;
    -webkit-transition: all .3s;
    transition: all .3s;
    outline-width: 0;
}
.form-tab .form-footer {
    padding-top: 0rem;
    padding-bottom: 1.5rem;
    border-bottom: 0.1rem solid #ebebeb;
    margin-bottom: 2.3rem;
}
.form-footer {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    padding-top: 0.6rem;
}
.form-tab .form-footer .btn {
    margin-left: 0;
    margin-right: 1.6rem;
    order: -1;
}
.custom-control {
    position: relative;
    padding-left: 2.6rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: block;
}
.custom-control-input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}
.custom-control-label {
    position: static;
    margin-bottom: 0;
    margin-top: 0.1rem;
    font-size: 1rem;
    padding-left: 2.6rem;
    margin-left: -2.6rem;
}
.form-choice {
    color: #333;
    font-weight: 400;
    font-size: 1rem;
    line-height: 0.5;
    letter-spacing: -.025em;
}

.btn.btn-login {
    color: #333;
    font-weight: 300;
    font-size: 1rem;
    line-height: 1.5;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0.7rem 1rem;
    border: 0.1rem solid #ebebeb;
    min-width: 0;
    text-transform: initial;
}
.mr-10{
    margin-right:10px;
}

#myModalLoyalty .page-content p, .modal-content p {
    margin: 2px 0 30px 0;
}


.custom-control-label::before {
    position: absolute;
    top: 0.15625rem;
    left: 0.5rem;
    display: block;
    width: 1rem;
    height: 1rem;
    pointer-events: none;
    content: "";
    background-color: #fff;
    border: #adb5bd solid 1px;
}

.btn.btn-login:focus, .btn.btn-login:hover {
    background-color: #f5f6f9;
}
.modal .modal-dialog .modal-body .close {
    outline: none;
    font-size: 30px;
    font-weight: normal;
    position: absolute;
    top: -20px;
    right: -12px;
}
.btn.btn-login.btn-g i {
    color: #c33;
}
.btn.btn-login.btn-f i {
    color: #36c;
}

.custom-control-label:after {
    left: 0;
    top: 0.6rem;
    width: 1.6rem;
    height: 1.6rem;
}

.custom-control-label::after {
    position: absolute;
    top: 0.25rem;
    left: 0.5rem;
    display: block;
    width: 1rem;
    height: 1rem;
    content: "";
    background: no-repeat 50%/50% 50%;
}

.custom-checkbox .custom-control-input:checked ~ .custom-control-label::after {
    background: #adb5bd;
}



/* Style tab links */
.tablink {
  color: #ccc;;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 10px 16px;
  font-size:1.5rem;
  width: 50%;
  background-color: #fff;
}

.nav-pills button:hover {
 color: #ccc;
 background-color: transparent;
}

.nav-pills button.active {
    color: #333;
  border-bottom: 2px solid #000;
}
.btn-outline-primary-2:hover span{
    color:#fff;
}
/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 20px 0px;
  height: 100%;
  width:100%;
}


.text-muted{
    color:red !important;
}


.custom-control-labels {
    position: unset;
    margin-bottom: 0;
    margin-top: 0.1rem;
    font-size: 1rem;
    padding-left: 0.6rem;
}


@media screen and (min-width: 768px){
.form-tab .form-footer .forgot-link {
    order: 2;
    width: auto;
    margin-bottom: 0;
    margin-left: auto;
}
}


@media screen and (min-width: 576px){
    .form-tab .form-footer .btn {
        width: auto;
        margin-top: 0;
    }
}



    @media (min-width: 992px){
        .modal-lg, .modal-xl {
            max-width: 600px;
        }
    }

    @media (max-width: 600px){
        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 0rem;
        }
        .form-box {
    max-width: 590px;
    background-color: #fff;
    padding: 2rem 1rem 2.2rem;
    -webkit-box-shadow: 0 3px 16px rgb(51 51 51 / 10%);
    box-shadow: 0 3px 16px rgb(51 51 51 / 10%);
}

.btn.btn-login {
    color: #333;
    font-weight: 300;
    font-size: 1rem;
    line-height: 1.5;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0.7rem 1rem;
    border: 0.1rem solid #ebebeb;
    min-width: 0;
    text-transform: initial;
    margin-bottom: 1rem;
}
.modal .modal-dialog .modal-body .close {
    outline: none;
    font-size: 30px;
    font-weight: normal;
    position: absolute;
    top: -20px;
    right: 0px;
}
    }
</style>

<div class="form-tab">

    <ul class="nav nav-pills nav-fill" role="tablist">

        <button class="tablink active" onclick="openCity(event, 'Login')" id="defaultOpen">Sign In</button>
        <button class="tablink" onclick="openCity(event, 'Singup')">Register</button>

    </ul>

    <div id="Login" class="tabcontent" style="display:block !important">
        <span style="color:red;font-weight:600;font-size:1rem;" id="loginres"></span>
        <!-- <div id="loadermodallog7" class="lds-dual-ringlog7 hidden overlaylog7"></div> -->
        <form   class="form-validate-login">
            <div class="form-group">
                <label for="singin-email-2">@lang('website.Email') *</label>
                <input type="email" name="email" id="email" placeholder="@lang('website.Please enter your valid email address')" class="form-control email-validate-login field-validate1">
				<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
            </div>
            <div class="form-group">
                <label for="singin-password-2">@lang('website.Password') *</label>
                <input type="password" name="password" id="password-login" placeholder="Please Enter Password" class="form-control password-login field-validate1">
				<span class="form-text text-muted error-content" hidden>Please enter your valid Password</span>
            </div>
            <div class="form-footer">
                <button type="button" class="btn btn-outline-primary-2 plogin1">
                    <span class="mr-10">LOG IN</span><i class="fa fa-arrow-right"></i>
                </button>
                <div class="custom-control custom-checkbox" style="padding-left:0.6rem;">
                    <input type="checkbox" class="form-controlt" id="signin-remember-2">
                    <label class="custom-control-labels" for="signin-remember-2">Remember Me</label>
                </div>
                <?php  $forgot_email = DB::table('alert_settings')->where('forgot_email', 1)->first();
                    if($forgot_email != ''){
                ?>
                    <a class="forgot-link" href="{{ URL::to('/forgotPassword')}}">@lang('website.Forgot Password')?</a>
                <?php } ?>
            </div>
        </form>
        <div class="form-choice">
            <p class="text-center">or sign in with</p>
            <div class="row">
                @if($result['commonContent']['setting'][61]->value==1)
                    <div class="col-sm-6">
                        <a class="btn btn-login btn-g" href="login/google"><i class="fa fa-google mr-10"></i>Login With Google</a>
                    </div>
                @endif
				@if($result['commonContent']['setting'][2]->value==1)
                    <div class="col-sm-6">
                        <a class="btn btn-login btn-f" href="login/facebook"><i class="fa fa-facebook-f mr-10"></i>Login With Facebook</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="Singup" class="tabcontent">

    <div class="col-12" style="margin-bottom:20px">
							<span style="color:red;font-weight:600;font-size:1rem;" id="regres"></span>
						</div>

        <form name="signup" id="ajaxForm" enctype="multipart/form-data" class="form-validate" action="{{ URL::to('/signupProcess')}}" method="post">
        {{csrf_field()}}
            <div class="form-group">
                <label for="firstName">@lang('website.First Name') *</label>
                <input type="text" class="form-control field-validate" id="firstName" name="firstName" placeholder="@lang('website.Please enter your first name')" value="{{ old('firstName') }}">
                <span class="form-text text-muted error-content" hidden>@lang('website.Please enter your first name')</span>
            </div>
            <div class="form-group">
                <label for="singin-lname-2">@lang('website.Last Name') *</label>
                <input type="text" class="form-control field-validate" id="lastName" name="lastName" placeholder="@lang('website.Please enter your last name')" value="{{ old('lastName') }}">
                <span class="form-text text-muted error-content" hidden>@lang('website.Please enter your last name')</span>
            </div>
            <div class="form-group">
                <label for="customers_dob">@lang('website.Date of Birth')</label>
                <input  name="customers_dob" type="text" class="form-control customers_dob" data-provide="datepicker" id="customers_dob" placeholder="@lang('website.Please enter your date of birth')" value="{{ old('customers_dob') }}">
                <span class="form-text text-muted error-content" hidden>@lang('website.Please enter your date of birth')</span>
            </div>
            <div class="form-group">
                <label for="email">@lang('website.Email Adrress') *</label>
                <input  name="email" type="text" class="form-control email-validate" id="emailreg" placeholder="@lang('website.Please enter your email address')" value="{{ old('email') }}">
				<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
            </div>
            <div class="form-group">
                <label for="password">@lang('website.Password') *</label>
                <input name="password" id="password" type="password" class="form-control password"  placeholder="@lang('website.Please enter your password')">
				<span class="form-text text-muted error-content">Note: Password Must Have One Uppercase & Letter and Number and Must Have 8 Character Minimum</span><br>
				<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your password')</span>
            </div>
            <div class="form-group">
                <label for="re_password">@lang('website.Confirm Password') *</label>
                <input type="password" style="width:100%;"class="form-control password" id="re_password" name="re_password" placeholder="Enter Your Password">
                <span class="form-text text-muted error-content" hidden>@lang('website.Please re-enter your password')</span>
                <span class="form-text text-muted re-password-content" hidden>@lang('website.Password does not match the confirm password')</span><br>

                <span class="form-text text-muted len-password-content" hidden>@lang('website.Minimum length of password 8 characters')</span>

                <span class="form-text text-muted cap-password-content" hidden>@lang('website.Password should have at least one uppercase')</span>

                <span class="form-text text-muted num-password-content" hidden>@lang('website.Password should have at least one number')</span>
            </div>
            <div class="form-group">
                <label for="gender">@lang('website.Gender') *</label>
                <select class="form-control field-validate" name="gender" id="inlineFormCustomSelect">
                    <option selected value="">@lang('website.Choose...')</option>
                    <option value="0" @if(!empty(old('gender')) and old('gender')==0) selected @endif)>@lang('website.Male')</option>
                    <option value="1" @if(!empty(old('gender')) and old('gender')==1) selected @endif>@lang('website.Female')</option>
                </select>
                <span class="form-text text-muted error-content" hidden>@lang('website.Please select your gender')</span>           
             </div>
            <div class="form-group">
                <label for="singin-password-2">@lang('website.Phone Number') *</label>
                <div class="input-group-prepend">
                    {{-- <div class="input-group-text">+60</div> --}}
                    <select class="form-control field-validate" name="ccode" id="ccode">
                        @if(!empty($code))
                            @foreach($code as $jescode)
                                <option value="{{$jescode->country_code}}" @if($jescode->country_code=='60') selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
                            @endforeach
                        @endif
                    </select>
                    <input  name="phone" type="text" class="form-control phone-validate" id="phone" placeholder="@lang('website.Please enter your phone number')" value="{{ old('phone') }}">
                </div>
                <span style="width:100%;" class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid phone number')</span>
            </div>
            <div class="form-footer">
                <button type="button" class="btn btn-outline-primary-2 preg1">
                    <span class="mr-10">SIGN UP</span><i class="fa fa-arrow-right"></i>
                </button>
                <div class="custom-control custom-checkbox" style="padding-left: 0.6rem;">
                    <input id="ckbox" required type="checkbox" class="form-controlt checkbox-validate">
                    <label class="custom-control-labels">I agree to the privacy policy *</label>
                    <span class="form-text text-muted error-content" hidden>@lang('website.Please accept our terms and conditions')</span>
                </div>
             </div>
             <div class="form-choice">
                <p class="text-center">or sign in with</p>
                <div class="row">
                    @if($result['commonContent']['setting'][61]->value==1)
                        <div class="col-sm-6">
                            <a class="btn btn-login btn-g" href="login/google"><i class="fa fa-google mr-10"></i>Login With Google</a>
                        </div>
                    @endif
                    @if($result['commonContent']['setting'][2]->value==1)
                        <div class="col-sm-6">
                            <a class="btn btn-login btn-f" href="login/facebook"><i class="fa fa-facebook-f mr-10"></i>Login With Facebook</a>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>




       
</div>



<script>

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").style.display = "block";


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
    //    complete: function(){
    //     $('#loadermodallog7').addClass('hidden')
    //    },
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