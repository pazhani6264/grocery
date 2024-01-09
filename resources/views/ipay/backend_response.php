<?php



    file_put_contents('testcronipay88.txt', json_encode(date("Y-m-d H:i:s")));
    file_put_contents('testcronipay88data.txt', json_encode(date("Y-m-d H:i:s")));

    $myFile = "testcronipay88data.txt";
    $fh = fopen($myFile, 'w') or die("can't open file");
    $stringData = $_REQUEST["MerchantCode"];
    fwrite($fh, $stringData);
    fclose($fh);




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
$ccname = $_REQUEST["CCName"];
$ccno = $_REQUEST["CCNo"];
$s_bankname = $_REQUEST["S_bankname"];
$s_country = $_REQUEST["S_country"];


if($estatus == 1){

           echo "RECEIVEOK";
           
} 
        
else {

    echo "DATA NOT RECEIVED";
  
}
            
                
    
?>