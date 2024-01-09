<?PHP
function iPay88_signature($source)
{
	return hash('sha256', $source);
}
$RefNo = $order->orders_id;

$order= DB::table('orders')->where('orders_id', '=', $RefNo)->first(); 
$name= DB::table('orders_products')->where('orders_id', '=', $RefNo)->first(); 

$merchant_code= DB::table('payment_methods_detail')->where('id', '=', 52)->first(); 
$merchant_key= DB::table('payment_methods_detail')->where('id', '=', 53)->first(); 
$enviroment= DB::table('payment_methods')->where('payment_methods_id', '=', 12)->first();
$env_status = $enviroment->environment;

$product_name=$name->products_name;
$merchant_code=$merchant_code->value;
$merchant_key=$merchant_key->value;
$newroundamt=round($order->order_price,1);
 if (filter_var($newroundamt, FILTER_VALIDATE_INT)) { 
                            $amount=$order->order_price; 
                        } else {
                          $amount= $newroundamt."0";
                         }
    if($env_status == 1)
    {
   $sigamt = $newroundamt * 100;
   $final_amount = $amount;
    }
    else
    {
$sigamt = '100'; 
$final_amount = '1.00';
}
                       
$sig=$merchant_key.$merchant_code.$RefNo.$sigamt.'MYR';





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
<INPUT type="hidden" name="Amount" value="{{ $final_amount }}">
<INPUT type="hidden" name="Currency" value="MYR">
<INPUT type="hidden" name="ProdDesc" value="{{ $product_name}}">
<INPUT type="hidden" name="UserName" value="platinumcode">
<INPUT type="hidden" name="UserEmail" value="order@platinum24.net">
<INPUT type="hidden" name="UserContact" value="0126500100">
<INPUT type="hidden" name="Remark" value="">
<INPUT type="hidden" name="Lang" value="UTF-8">
<INPUT type="hidden" name="SignatureType" value="SHA256">
<INPUT type="hidden" name="Signature" value="<?php echo iPay88_signature($sig);?>" >
<INPUT type="hidden" name="ResponseURL" value="{{url("/onlinepay/response") }}">
<INPUT type="hidden" name="BackendURL" value="{{url("backend_response.php")}}">
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



</script> 

