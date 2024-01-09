<?php


# please fill in the required info as below

$env_status = $result['merchant_id']->environment;
if($env_status=='1'){
    $merchant_id = $result['merchant_id']->value;;
    $secretkey = $result['secretkey']->value;
    $url='https://app.senangpay.my/payment/'.$merchant_id;
}else{
    $merchant_id = $result['merchant_id_sandbox']->value;;
    $secretkey = $result['secret_key_sandbox']->value;
    $url='https://sandbox.senangpay.my/payment/'.$merchant_id; 
}
//print_r($url);die();
//print_r($order_data);die();
$detail='Order Product';
$amount=$order_data['order_price'];
$order_id=$order_data['transaction_id'];
$name=$order_data['customers_name'];
$email=$order_data['email'];
$phone=$order_data['customers_telephone'];




    # assuming all of the data passed is correct and no validation required. Preferably you will need to validate the data passed
    $hashed_string = md5($secretkey.urldecode($detail).urldecode($amount).urldecode($order_id));
    
    # now we send the data to senangPay by using post method
    ?>
    <html>
    <head>
    <title>senangPay</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <form name="order" id="order" method="post" action="<?php echo $url; ?>">
            <input type="hidden" name="detail" value="<?php echo $detail; ?>">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="phone" value="<?php echo $phone; ?>">
            <input type="hidden" name="hash" value="<?php echo $hashed_string; ?>">
        </form>
    </body>
    </html>
    
 <script type="text/javascript">
window.onload = formAutoSubmit;
function formAutoSubmit () {
    var frm = document.getElementById("order");
    frm.submit();
}
</script>  
    
