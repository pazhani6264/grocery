<!DOCTYPE html>
<html>
<title>Login</title>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="Platinum Code">
<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
@php
           $color_style= DB::table('settings')->where('id',236)->first();
            $inv = DB::table('settings')->where('id',145)->first();
            $color = DB::table('settings')->where('id',237)->first();

            if(session('language_id') == '')
		{
			$language_id = 1;
		}
		else
		{
			$language_id = session('language_id');
		}
        $label1 = DB::table('table_label_value')->where('label_id',2)->where('language_id', '=', $language_id)->first();
        $label2 = DB::table('table_label_value')->where('label_id',4)->where('language_id', '=', $language_id)->first();
        $label3 = DB::table('table_label_value')->where('label_id',5)->where('language_id', '=', $language_id)->first();
        $label4 = DB::table('table_label_value')->where('label_id',6)->where('language_id', '=', $language_id)->first();
        $label5 = DB::table('table_label_value')->where('label_id',7)->where('language_id', '=', $language_id)->first();
        $label6 = DB::table('table_label_value')->where('label_id',8)->where('language_id', '=', $language_id)->first();
        @endphp

<!-- Core CSS Files -->

<!-- login Content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<body style="background:#fff;">
<?php  $color = $color->value; ?>


<style>



.center {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width:100%;
}


.form-tab {
    vertical-align: middle;
    display: inline-block;
    width: 100%;
}
.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
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
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

*, *::before, *::after {
    box-sizing: border-box;
}
user agent stylesheet
div {
    display: block;
}
html, body {
    font: normal 400 0.875rem/1.86 Jost !important;
    -webkit-font-smoothing: antialiased;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
    color: #111;
    text-align: left;
    overflow-x: hidden !important;
}
label {
    display: inline-block;
  
}
button, [type=button], [type=reset], [type=submit] {
    -webkit-appearance: initial;
}
.btn, a {
    font-weight: 300 !important;
}

.btn {
    padding: 0.6rem 1.8rem;
}
.btn {
    text-transform: uppercase;
}
body {
    margin: 0;
    background-color: #f5f5f5;
}
h2, h3, h4, h5 {
    font-weight: 700;
}
h3, .h3 {
    font-size: 1.53125rem;
}
.form-control {
    height: 41px;
    padding: 0.85rem 1rem;
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
    display: block;
    width: 100%;
    background-clip: padding-box;
}
.form-tab .form-footer {
    padding-top: 0rem;
    padding-bottom: 1.5rem;
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
    border: 0.1rem solid <?php echo $color; ?>;
    min-width: 0;
    text-transform: initial;
}
.btn-outline-primary-2 {
    color: <?php echo $color; ?>;
    background-color: transparent;
    background-image: none;
    border-color: <?php echo $color; ?>;
    -webkit-box-shadow: none;
    box-shadow: none;
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
    background-color: <?php echo $color; ?>;
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
  color: #000;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 10px 16px;
  font-size:1.5rem;
  width: 50%;
  background-color: #fff;
}

.tablink:hover {
  background-color: #777;
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




 


    </style>


<div class="container center"> 
<div class="form-tab">

<div style="margin-bottom:10px">
    <span style="color:red;font-weight:600;font-size:1rem;" id="loginres"></span>
</div>
<form  class="form-validate-table-login">
{{csrf_field()}}
    <h3 style="border-bottom: 0.1rem solid #ebebeb;padding:10px 0px;margin: 10px 0px 30px 0px;">{{$label1->label_value}}</h3>
            <div class="form-group">
                <label for="singin-email-2">{{$label2->label_value}} *</label>
                <input type="email" name="email" id="email" placeholder="{{$label5->label_value}}"class="form-control email-validate-login">
				<span class="form-text text-muted error-content" hidden>@lang('website.Please enter your valid email address')</span>
            </div>
            <div class="form-group">
                <label for="singin-password-2">{{$label3->label_value}} *</label>
                <input type="password" name="password" id="password-login" placeholder="{{$label6->label_value}}" class="form-control password-login">
				<span class="form-text text-muted error-content" hidden>@lang('website.This field is required')</span>
            </div>
            <div class="form-footer">
                <button  type="button" class="btn btn-outline-primary-2 plogin1" style="display: flex;align-items: center;">
                    <span class="mr-10">{{$label4->label_value}}</span><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m13.5 6.497l4 4.002l-4 4.001m-9-4h13"/></svg>
                </button>
            </div>
        </form>
    </div>
    </div>

<script>
jQuery(document).on('click', '.plogin1', function(e){
  var email = $('#email').val();
  var password = $('#password-login').val();

    jQuery(function ($) {
     jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: '{{ URL::to("/process-login_table")}}',
        type: "POST",
        data: 'email='+email+'&password='+password,
        beforeSend: function() {
            $('#loginres').html('loading ...')
        },
       success: function (res) {
        if(res == '1'){
            jQuery("#loginres").html('Email or password is incorrect');
        } else if(res == '2'){
            jQuery("#loginres").html('You Are Not Allowed With These Credentialss!');
        } else{
            location.href = '/qrcodelogintable';
        }
       },
    //    complete: function(){
    //     $('#loadermodallog4').addClass('hidden')
    //    },
     });
   });
 
 });
 </script>

</body>
</html>