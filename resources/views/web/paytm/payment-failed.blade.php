<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="row">
            <div class="col-12">
                <div class="pro-empty-page">
                    <h2 style="font-size: 100px;"><i class="far fa-check-circle"></i></h2>
                    <p> Sorry payment failed. </p>
                    <p>This page will automatically redirect in &nbsp<span id="timer" style="font-size: 24px;"></span>&nbsp to manually redirect page <a href="{{ URL::to('/paytm_thankyou')}}">Click Here</a> </p>
                    
                </div>
            </div>
        </div>

</body>
</html>

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
  window.location.href = "{{ URL::to('/paytm_thankyou')}}";
 
}

timer(5);
</script>