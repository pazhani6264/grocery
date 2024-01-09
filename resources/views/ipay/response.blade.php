<?php
 $merchantcode = $_REQUEST["MerchantCode"];
 $paymentid = $_REQUEST["PaymentId"];
 $refno = $_REQUEST["RefNo"];
 $amount = $_REQUEST["Amount"];
 $ecurrency = $_REQUEST["Currency"];
 $remark = $_REQUEST["Remark"];
 $transid = $_REQUEST["TransId"];
 $authcode = $_REQUEST["AuthCode"];
 $estatus = $_REQUEST["Status"];
 $errdesc = $_REQUEST["ErrDesc"];
 $signature = $_REQUEST["Signature"];
//$ccname = $_REQUEST["CCName"];
//$ccno = $_REQUEST["CCNo"];
//$s_bankname = $_REQUEST["S_bankname"];
//$s_country = $_REQUEST["S_country"];
?>
<Add your programming code here>
<section class="pro-content empty-content">
    <div class="container">
<?php
IF ($estatus==1) { ?>
        <div class="row">
            <div class="col-12">
                <div class="pro-empty-page">
                    <h2 style="font-size: 100px;"><i class="far fa-check-circle"></i></h2>
                    <p> Thank you for payment. </p>
                    <p>This page will automatically redirect in &nbsp<span id="timer" style="font-size: 24px;"></span>&nbsp to manually redirect page <a href="{{ URL::to('/thankyou')}}">Click Here</a> </p>
                    
                </div>
            </div>
        </div>

<?php  } ELSE { ?>
        <div class="row">
            <div class="col-12">
                <div class="pro-empty-page">
                    <h2 style="font-size: 100px;"><i class="far fa-check-circle"></i></h2>
                    <p> Payment fail. </p>
                    <p>This page will automatically redirect in &nbsp<span id="timer" style="font-size: 24px;"></span>&nbsp to manually redirect page <a href="{{ URL::to('/thankyou')}}">Click Here</a> </p>
                    
                </div>
            </div>
        </div>

<?php } ?>
<br>


        
    </div>  
</section>


<script>
let timerOn = true;


function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = s;
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
  window.location.href = "{{ URL::to('/thankyou')}}";
 
}

timer(5);
</script>