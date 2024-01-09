<?php
$spayid=$_GET['spayid'];
$samount=$_GET['samount'];
$product_name=$_GET['product_name'];
$response_url=$_GET['response_url'];
$merchant_key='88F0acziYz';
$merchant_code='M29468';
$RefNo = $spayid;

$newroundamt=round($samount,1);
	if (filter_var($newroundamt, FILTER_VALIDATE_INT)) {
		$amount=$samount; 
	}else{
		$amount= $newroundamt."0";
	}

//$sigamt = $newroundamt * 100;
//$final_amount = $amount;

$sigamt = '100'; 
$final_amount = '1.00';

function iPay88_signature($source)
{
	return hash('sha256', $source);
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
<INPUT type="hidden" name="MerchantCode" value="<?php echo $merchant_code;?>">
<INPUT type="hidden" name="PaymentId" value="10">
<INPUT type="hidden" name="RefNo" value="<?php echo $RefNo;?>">
<INPUT type="hidden" name="Amount" value="<?php echo $final_amount;?>">
<INPUT type="hidden" name="Currency" value="MYR">
<INPUT type="hidden" name="ProdDesc" value="<?php echo $product_name;?>">
<INPUT type="hidden" name="UserName" value="platinumcode">
<INPUT type="hidden" name="UserEmail" value="order@platinum24.net">
<INPUT type="hidden" name="UserContact" value="0126500100">
<INPUT type="hidden" name="Remark" value="">
<INPUT type="hidden" name="Lang" value="UTF-8">
<INPUT type="hidden" name="SignatureType" value="SHA256">
<INPUT type="hidden" name="Signature" value="<?php echo iPay88_signature($sig);?>" >
<INPUT type="hidden" name="ResponseURL" value="<?php echo $response_url;?>">
<INPUT type="hidden" name="BackendURL" value="https://platinum24.online">
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

