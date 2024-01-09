<?PHP
function iPay88_signature($source)
{
	return hash('sha256', $source);
}
$RefNo = $pay_id;
//$newroundamt=round($order->order_price,1);
 //if (filter_var($newroundamt, FILTER_VALIDATE_INT)) { 
                            //$amount=$order->order_price; 
                        //} else {
                          //$amount= $newroundamt."0";
                         //}
$sig='cN9KU5qrSlM36668'.$RefNo.'100MYR';
$sandsig='eqe4BRCbEHM27513'.$RefNo.'100MYR';

?>

<HTML>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<BODY>
<FORM method="post" name="ePayment" action="https://payment.ipay88.com.my/ePayment/entry.asp">
<INPUT type="hidden" name="MerchantCode" value="M27231">
<INPUT type="hidden" name="PaymentId" value="10">
<INPUT type="hidden" name="RefNo" value="{{ $RefNo }}">
<INPUT type="hidden" name="Amount" value="1.00">
<INPUT type="hidden" name="Currency" value="MYR">
<INPUT type="hidden" name="ProdDesc" value="Tasty Food">
<INPUT type="hidden" name="UserName" value="John Tan">
<INPUT type="hidden" name="UserEmail" value="john@hotmail.com">
<INPUT type="hidden" name="UserContact" value="0126500100">
<INPUT type="hidden" name="Remark" value="">
<INPUT type="hidden" name="Lang" value="UTF-8">
<INPUT type="hidden" name="SignatureType" value="SHA256">
<INPUT type="hidden" name="Signature" value="<?php echo iPay88_signature($sig);?>" >
<INPUT type="hidden" name="ResponseURL" value="http://foodheart.qrweb.co/onlinepay/response">
<INPUT type="hidden" name="BackendURL" value="http://foodheart.qrweb.co/backend_response.php">
{{-- <INPUT type="submit" value="Live Payment" name="Submit"> </FORM> --}}
<br>
<!--<FORM method="post" name="ePayment" action="http://foodheart.qrweb.co/onlinepay/responsesandbox/{{ $RefNo }}">-->
<!--<INPUT type="hidden" name="MerchantCode" value="M27513">-->
<!--<INPUT type="hidden" name="PaymentId" value="2">-->
<!--<INPUT type="hidden" name="RefNo" value="{{ $RefNo }}">-->
<!--<INPUT type="hidden" name="Amount" value="1.00">-->
<!--<INPUT type="hidden" name="Currency" value="MYR">-->
<!--<INPUT type="hidden" name="ProdDesc" value="Photo Print">-->
<!--<INPUT type="hidden" name="UserName" value="John Tan">-->
<!--<INPUT type="hidden" name="UserEmail" value="john@hotmail.com">-->
<!--<INPUT type="hidden" name="UserContact" value="0126500100">-->
<!--<INPUT type="hidden" name="Remark" value="">-->
<!--<INPUT type="hidden" name="Lang" value="UTF-8">-->
<!--<INPUT type="hidden" name="SignatureType" value="SHA256">-->
<!--<INPUT type="hidden" name="Signature" value="<?php echo iPay88_signature($sandsig);?>" >-->
<!--<input type="hidden" name="ResponseURL" value="http://foodheart.qrweb.co/onlinepay/responsesandbox/{{ $RefNo }}" />-->
<!--<INPUT type="hidden" name="ResponseURL" value="http://foodheart.qrweb.co/public/ipay88/response.php">-->
<!--<INPUT type="hidden" name="BackendURL" value="http://foodheart.qrweb.co/public/ipay88/backend_response.php">-->
<!--<a href="{{URL::to('onlinepay/responsesandbox/'. $RefNo) }}">Sucess </a>-->
<!--</FORM>-->
{{-- <a href="{{URL::to('onlinepay/responsesandbox/'. $RefNo) }}">Sucess </a> --}}
 <div style="text-align: center;">
 <a href="{{URL::to('checkout/ipayresponse/'. $RefNo.'/success') }}" id="hyperpay_button" class="btn btn-success">Success</a>
 <a href="{{URL::to('checkout/ipayresponse/'. $RefNo.'/failure') }}" id="hyperpay_button" class="btn btn-danger">Failure</a>
</div>

</BODY>
</HTML>

<!-- <?PHP
function iPay88_signatures($source)
{
	return hash('sha256', $source);
}
$RefNo = $id;

$order= DB::table('orders')->where('orders_id', '=', $RefNo)->first(); 

$merchant_code= DB::table('payment_methods_detail')->where('id', '=', 52)->first(); 
$merchant_key= DB::table('payment_methods_detail')->where('id', '=', 53)->first(); 

$product_name=$order->products_name;
$merchant_code=$merchant_code->value;
$merchant_key=$merchant_key->value;
$newroundamt=round($order->order_price,1);
 if (filter_var($newroundamt, FILTER_VALIDATE_INT)) { 
                            $amount=$order->order_price; 
                        } else {
                          $amount= $newroundamt."0";
                         }
                       
$sig=$merchant_key.$merchant_code.$RefNo.$newroundamt.'00MYR';





?>

<HTML>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<BODY>
<FORM method="post" name="ePayment" id="ePayment" action="https://payment.ipay88.com.my/ePayment/entry.asp">
<INPUT type="hidden" name="MerchantCode" value="{{ $merchant_code }}">
<INPUT type="hidden" name="PaymentId" value="10">
<INPUT type="hidden" name="RefNo" value="{{ $RefNo }}">
<INPUT type="hidden" name="Amount" value="{{ $amount }}">
<INPUT type="hidden" name="Currency" value="MYR">
<INPUT type="hidden" name="ProdDesc" value="{{ $product_name}}">
<INPUT type="hidden" name="UserName" value="okaquapet">
<INPUT type="hidden" name="UserEmail" value="order@okaquapet.com">
<INPUT type="hidden" name="UserContact" value="0126500100">
<INPUT type="hidden" name="Remark" value="">
<INPUT type="hidden" name="Lang" value="UTF-8">
<INPUT type="hidden" name="SignatureType" value="SHA256">
<INPUT type="hidden" name="Signature" value="<?php echo iPay88_signature($sig);?>" >
<INPUT type="hidden" name="ResponseURL" value="https://okaquapet.com/onlinepay/response">
<INPUT type="hidden" name="BackendURL" value="https://okaquapet.com/backend_response.php">
 </FORM>
<br>


</div>

</BODY>
</HTML>


<script type="text/javascript">
window.onload = formAutoSubmit;

function formAutoSubmit () {

var frm = document.getElementById("ePayment");

frm.submit();

}



</script> -->

