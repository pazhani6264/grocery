<!DOCTYPE html>
<html style="background: #ebebeb;">
  <head>
    <title>REVIEW ORDER</title>
    <meta charset="utf-8">
    <meta name="description" content="QRCODE Scanning">
    <meta name="keywords" content="QRCODE Scanning">
    <meta name="author" content="Platinum Code">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
    @php
      $color_style = DB::table('settings')->where('id',236)->first();
      $color = DB::table('settings')->where('id',237)->first();
      $country_id = DB::table('settings')->where('id',235)->first();
      $tax_class = DB::table('settings')->where('id',234)->first();
      $inv = DB::table('settings')->where('id',145)->first();

      if(session('language_id') == '')
      {
        $language_id = 1;
      }
      else
      {
        $language_id = session('language_id');
      }
      $label1 = DB::table('table_label_value')->where('label_id',2)->where('language_id', '=', $language_id)->first();
      $label2 = DB::table('table_label_value')->where('label_id',20)->where('language_id', '=', $language_id)->first();
      $label3 = DB::table('table_label_value')->where('label_id',21)->where('language_id', '=', $language_id)->first();
      $label4 = DB::table('table_label_value')->where('label_id',22)->where('language_id', '=', $language_id)->first();
    @endphp
       
    <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
    <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/stripe.css') }}" data-rel-css="" />
  </head>
  <body>
    <style>
    
      body
      {
        background: #ebebeb;
      }
      .image-outer
      {
        text-align: center;
        margin-top: 15%;
      }
      .circle-image
      {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
      }
      .content-outer {
        margin-top: 5%;
        text-align: center;
      }
      .footer-content-outer {
        margin-top: 5%;
        text-align: center;
      }
      .p1
      {
        color: #777;
      }
      .h1
      {
        margin-bottom: 2%;
      }
      
      .input-container-inner {
       
          background: #fff;
          border-radius: 10px;
          width: 85%;
          margin: auto;
          padding: 20px;
      }
      .input-container-outer {
        margin-top: 5%;
      }
      .input-container {
    display: flex;
    align-items: center;
    border: solid 1px #777;
    height: 40px;
    border-radius: 5px;
  }
  .country-code {
    width: 80px; /* Adjust the width as needed */
    margin-right: 10px;
    width: 80px;
    margin-right: 10px;
    border: none !important;
    height: 90%;
    outline: none !important;
  }


  .phone-number {
    flex: 1;
    border: none !important;
    height: 90%;
    outline: none !important;
  }
  .logout-btn
{
padding: 10px 25px;

width: 100%;
    margin: auto;
    border-radius: 30px;
    color: #fff;
    margin-top: 20px;
    text-align: center
}
.box-container {
    width: 100%;
    
  
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
  }

  .box {
    width: 25%;
    height: 3.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0px;
    border-radius: 3px;
  }

  .input-box {
    width: 90%;
    height: 90%;
    outline: none !important;
    text-align: center;
    border: solid 1px #ccc;
    border-radius: 8px;
  }

  .input-box:focus {
  outline: none; 
  border-color: currentColor; 
}
    </style>
    <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
    <div class="pc-mobile-tab"> <a href="javascript:history.back()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="common-text" style="margin-left: 10px;margin-top: 20px;" viewBox="0 0 24 24"><g id="evaArrowBackFill0"><g id="evaArrowBackFill1"><path id="evaArrowBackFill2" fill="currentColor" d="M19 11H7.14l3.63-4.36a1 1 0 1 0-1.54-1.28l-5 6a1.19 1.19 0 0 0-.09.15c0 .05 0 .08-.07.13A1 1 0 0 0 4 12a1 1 0 0 0 .07.36c0 .05 0 .08.07.13a1.19 1.19 0 0 0 .09.15l5 6A1 1 0 0 0 10 19a1 1 0 0 0 .64-.23a1 1 0 0 0 .13-1.41L7.14 13H19a1 1 0 0 0 0-2Z"/></g></g></svg></a>
      <div class="image-outer">
          <img class="circle-image" src="{{ asset('images/user.png') }}" alt="">
      </div>
      <div class="content-outer">
        <h3 class="h1">Verfication</h3>
        <p class="p1">Enter Your OTP code number</p>
      </div>
      <div class="input-container-outer">
        <div class="input-container-inner">  
        <div style="color:red;font-size:1rem;text-align:center;margin-bottom:15px;" id="otpres"></div>
       
                  {{csrf_field()}}

              
                    <input type="hidden" name="id" value="{{$result->user_id}}" id="id">
                    <input type="hidden" name="ccode" value="{{$result->ccode}}" id="ccode">
                    <input type="hidden" name="phone" value="{{$result->phone}}" id="phone">


        <div class="box-container">

        <div class="box common-text">
      <input class="input-box common-text box-1"  type="text" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )" maxlength="1" minlength="1" oninput="move(this, 1)" autofocus>
    </div>
    <div class="box common-text ">
      <input class="input-box common-text box-2" type="text" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )" maxlength="1" minlength="1" oninput="move(this, 2)">
    </div>
    <div class="box common-text ">
      <input class="input-box common-text box-3" type="text" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )" maxlength="1" minlength="1" oninput="move(this, 3)">
    </div>
    <div class="box common-text ">
      <input class="input-box common-text box-4" type="text" onkeydown="return ( event.ctrlKey || event.altKey
                          || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                          || (95<event.keyCode && event.keyCode<106)
                          || (event.keyCode==8) || (event.keyCode==9)
                          || (event.keyCode>34 && event.keyCode<40)
                          || (event.keyCode==46) )" maxlength="1" minlength="1" oninput="move(this, 4)">
    </div>
        </div>

            <div class="logout-container">
           
           <div class="common-bg logout-btn" id="table_btn_dis">Verify</div>

          
          </div>


        </div>
      </div>


       <div class="footer-content-outer">
       
        <p class="p1">Didn't you receive any code?</p>
        <div class="profile-otp-timer common-text hide-btn-1" style="text-align: center;margin: 5px 0 0 0;font-size: 20px;"><span id="timer"></span></div>
        <a href="{{ URL::to('/table_resendotp/' . $result->user_id )}}" class="hide-btn-2" style="display:none;"><h3 class="h1 common-text">Resend New Code</h3></a>
      </div> 
     
      
    
    </div>

  </body>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>


function move(currentInput, inputIndex) {
  const currentLength = currentInput.value.length;
  const maxLength = parseInt(currentInput.getAttribute('maxlength'));

  if (currentLength >= maxLength) {
    if (inputIndex < 4) {
      const nextBox = currentInput.parentElement.nextElementSibling;
      const nextInput = nextBox.querySelector('.input-box');
      if (nextInput) {
        nextInput.focus();
      }
    }
  } else if (currentLength === 0 && inputIndex > 1) {
    const previousBox = currentInput.parentElement.previousElementSibling;
    const previousInput = previousBox.querySelector('.input-box');
    if (previousInput) {
      previousInput.focus();
    }
  }
}


jQuery("#table_btn_dis").click(function(){ 
    var id = jQuery("#id").val();
    var ccode = jQuery("#ccode").val();
    var phone = jQuery("#phone").val();
    var one = jQuery(".box-1").val();
    var two = jQuery(".box-2").val();
    var three = jQuery(".box-3").val();
    var four = jQuery(".box-4").val();
    
    jQuery(function ($) {
      jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: '{{ URL::to("/table_ck_otp_isvalid")}}',
        type: "POST",
        data: 'id='+id+'&ccode='+ccode+'&phone='+phone+'&otp1='+one+'&otp2='+two+'&otp3='+three+'&otp4='+four,
        beforeSend: function() {
            $('#otpres').html('loading ...');
        },
        success: function (res) {
          if(res == '1'){
              message = "Invalid OTP";
              jQuery('#otpres').text(message);
             
          } else if(res == '2'){
            window.location.href = '../qrcodelogintable';
          }
        },
      });
    });
  });

  
let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = ''+m + ':' + s;


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
  $(".hide-btn-2").show();
  $(".hide-btn-1").hide();


}

timer(60);

  </script>
</html>



