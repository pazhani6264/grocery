<?php
function iPay88_signature($source)
{
	return hash('sha256', $source);
}
$RefNo = uniqid(); 
$env_status = $result['merchant_code']->environment;

$merchant_code=$result['merchant_code']->value;
$merchant_key=$result['merchant_key']->value;

$toalamount=session('wallet_price');
$newroundamt=round($toalamount,1);

	if (filter_var($newroundamt, FILTER_VALIDATE_INT)) {
		$amount=$toalamount;
	}else{
		$amount= $newroundamt."0";
	}

	if($env_status == 1){
		$sigamt = $newroundamt * 100;
   		$final_amount = $amount;
	}else{
		$sigamt = '100'; 
		$final_amount = '1.00';
	}
	$sig=$merchant_key.$merchant_code.$RefNo.$sigamt.'MYR';
	//print_r($sig);die();
?>
<HTML>
	<BODY>
		<FORM method="post" name="ePayment" id="ePayment" action="https://payment.ipay88.com.my/ePayment/entry.asp">
		<INPUT type="hidden" name="MerchantCode" value="{{ $merchant_code }}">
		<INPUT type="hidden" name="PaymentId" value="10">
		<INPUT type="hidden" name="RefNo" value="{{ $RefNo }}">
		<INPUT type="hidden" name="Amount" value="{{ $final_amount }}">
		<INPUT type="hidden" name="Currency" value="MYR">
		<INPUT type="hidden" name="ProdDesc" value="wallet">
		<INPUT type="hidden" name="UserName" value="platinumcode">
		<INPUT type="hidden" name="UserEmail" value="order@platinum24.net">
		<INPUT type="hidden" name="UserContact" value="0126500100">
		<INPUT type="hidden" name="Remark" value="">
		<INPUT type="hidden" name="Lang" value="UTF-8">
		<INPUT type="hidden" name="SignatureType" value="SHA256">
		<INPUT type="hidden" name="Signature" value="<?php echo iPay88_signature($sig);?>" >
		<INPUT type="hidden" name="ResponseURL" value="{{url("/wallet/ipaywalletresponse") }}">
		<INPUT type="hidden" name="BackendURL" value="{{url("backend_response.php")}}">
 </FORM>
	</BODY>
</HTML>

<script type="text/javascript">
window.onload = formAutoSubmit;
	function formAutoSubmit () {
	var frm = document.getElementById("ePayment");
	frm.submit();
	}
</script> 


