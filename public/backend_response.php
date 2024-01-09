<?php

$conn = new mysqli("localhost","likyan_okaquapet","likyan_okaquapet","likyan_okaquapet");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}



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
	     $status='paid'; 
           echo "RECEIVEOK";
           
            
	} 
        
	else {
		$status='unpaid'; 
		echo "DATA NOT RECEIVED";
	    }
	    
	    $sql = "UPDATE orders SET delivery_suburb='backend_url',payment_status='$status',order_information='json_encode($orderdetail)',transaction_id='$transid' WHERE orders_id='$refno'";

if ($conn->query($sql) === TRUE) {
 
} else {
  
}

$conn->close();
		
    
         
    
?>