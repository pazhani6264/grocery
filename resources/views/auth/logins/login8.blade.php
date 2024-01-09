<style>

.btn-outline-primary-2:hover span{
    color:#fff;
}
    .account-drop {
    text-align: right;
}

.dropdn-content.is-opened .dropdn-content-block {
    transform: translate3d(0, 0, 0);
}
.dropdn-content-block {
    position: fixed;
    z-index: 164;
    top: 0;
    right: 0;
    display: block;
    overflow-y: auto;
    width: 500px;
    height: 100%;
    padding: 0 50px 35px;
    pointer-events: all;
    opacity: 1;
    color: #2e343f;
    background-color: #fff;
    box-shadow: 0 10px 35px rgb(0 0 0 / 7%);
}
.dropdn-content .dropdn-close {
    font-size: 16px;
    font-weight: 600;
    position: -webkit-sticky;
    position: sticky;
    z-index: 2;
    top: 0;
    overflow: hidden;
    min-height: 69px;
    margin: 0 -5px 10px;
    padding: 35px 5px;
    transition: .2s;
    transform: translateZ(0);
    text-align: right;
    color: #2e343f;
    background: #fff;
    background: -webkit-gradient(left top, left bottom, color-stop(80%, #fff), color-stop(100%, rgba(255, 255, 255, 0)));
    background: linear-gradient(to bottom, #fff 80%, rgba(255, 255, 255, 0) 100%);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.dropdn-content .dropdn-close > span {
    cursor: pointer;
}
.account-drop ul {
    margin-top: -10px;
}
.dropdn-content ul {
    margin: -5px 0 0;
    padding: 0;
    list-style: none;
}
.account-drop .dropdn-form-wrapper {
    margin-top: 40px;
}
.alert:not(:first-child) {
    margin-top: 10px;
}
.alert {
    margin: 0;
    padding: 13px 15px;
    color: #fff;
    border: 0;
    border-radius: 0;
}
.alert-danger {
    background-color: red;
}
.form-group:not(:only-child), .form-flex:not(:only-child) {
    margin-bottom: 16px;
}
.account-drop .form-control {
    text-align: right;
}
.form-control.is-invalid, .was-validated .form-control:invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e);
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    height: calc(2.5em + 0.75rem + 2px);
    font-size: 1rem !important;
}

.form-controls {
    display: block;
    width: 100%;
    height: calc(2.5em + 0.75rem + 2px);
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
    text-align:right;
}

.account-drop .dropdn-form-wrapper .btn {
    min-width: 195px;
    width: 150px;
    display: inline-block;
}
.btn:not([data-animation]) {
    transition: all .2s ease;
}

.dropdn-content .dropdn-close > span:hover {
    text-decoration: underline;
    color: #2e343f;
}
.dropdn-content-blocks{
    padding:20px 30px
}

@media screen and (min-width: 700px) and (max-width: 800px){
    .sidenav{
        width: 500px !important;
    }
    .dropdn-content-block {
        width: 500px !important;
        padding:0 40px 35px;
    }
    .account-drop .dropdn-form-wrapper .btn {
    min-width: 195px;
    width: 195px;
    display: inline-block;
}


   
}


@media (max-width: 600px){
    .sidenav{
        width: 300px !important;
    }
    .dropdn-content-block {
        width: 300px !important;
        padding:0 20px 35px;
    }
    .account-drop .dropdn-form-wrapper .btn {
    min-width: 195px;
    width: 120px;
    display: inline-block;
}
   
}
</style>


<div class="dropdn-content account-drop" id="dropdnAccount">
	<div class="dropdn-content-blocks">
		<div id="closeNavlogin" class="dropdn-close"><span class="js-dropdn-close">Close</span></div>
		
		<ul>
			<li>
			
				  <span><?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}} &nbsp;! <?php }?> </span>
			</li>
			<?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>

			<li> <a href="{{url('profile')}}" >@lang('website.Profile')<i class="icon-user2 w25"></i></a> </li>
            <li> <a href="{{url('wishlist')}}" >@lang('website.Wishlist') <!-- <span class="total_wishlist"> ({{$result['commonContent']['total_wishlist']}})</span> --><i class="icon-heart-hover w25"></i></a> </li>
            <li> <a href="{{url('orders')}}" >@lang('website.Orders')<i class="icon-card w25"></i></a> </li>
            <li> <a href="{{url('shipping-address')}}" >@lang('website.Shipping Address')<i class="fa fa-truck w25" aria-hidden="true"></i></a> </li>
            <li> <a href="{{url('logout')}}">@lang('website.Logout')<i class="icon-login w25"></i></a> </li>
            <?php }else{ ?>
              <li> <a class="common-hover" href="{{ URL::to('/register1')}}"><span style="font-size:1.5rem;">Register</span> <i style="font-size:1rem;" class="fa fa-user-o"></i></a> </li>

	


			<?php } ?>
		</ul>
		<?php if(auth()->guard('customer')->check()){ ?>
			<?php }else{ ?>
		<div class="dropdn-form-wrapper">

        <div  style="margin-bottom:20px">
                <span style="color:red;font-weight:600;font-size:1rem;" id="loginres"></span>
            </div>
            
			<h5 style="margin: 0 0 20px;">Quick Login</h5>
			
			
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

               
			<form  enctype="multipart/form-data"  class="form-validate-login" method="post">
						{{csrf_field()}}
						<div class="form-group">
							
								<input type="email" name="email" id="email" placeholder="@lang('website.Please enter your valid email address')" class="form-control form-control--sm is-invalid email-validate-login field-validate1">
								<span style="font-weight:600;color:red !important;" class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
							
						</div>
						<div class="form-group">
						
								<input type="password" name="password" id="password-login" placeholder="Please Enter Password" class="form-controls form-control--sm password-login field-validate1">
								<span style="font-weight:600;color:red !important;" class="form-text text-muted error-content" hidden>Please enter your valid Password</span>
							
						</div>

						<button style="color:#fff;text-transform:initial;font-size:14px;" type="button" class="btn common-bg plogin1">@lang('website.Login')</button>
						
						</form>

						<div class="" style="padding:20px 0;font-size:15px;">
							@lang('website.Access Your Account Through Your Social Networks')
						</div>
						<div class="">

								@if($result['commonContent']['setting'][61]->value==1)
									<a href="login/google" type="button" style="background: #ec4949;min-width: auto;-webkit-appearance: button-bevel;font-size:1rem;color:#fff;padding:12px;text-transform:initial;font-size:14px;" class="btn btn-google"><i class="fa fa-google-plus"></i>&nbsp; @lang('website.Google') </a>
								@endif
								@if($result['commonContent']['setting'][2]->value==1)
									<a  href="login/facebook" type="button" style="background: #5c5cd8;min-width: auto;-webkit-appearance: button-bevel;font-size:1rem;color:#fff;padding:12px;text-transform:initial;font-size:14px;" class="btn btn-facebook"><i class="fa fa-facebook-f"></i>&nbsp;@lang('website.Facebook')</a>
								@endif
						</div>

			
		</div> 
		<?php } ?>
	</div>
	<div class="drop-overlay js-dropdn-close"></div>
</div>


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