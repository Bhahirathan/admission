<?php

require_once("./PaytmChecksum.php");
use paytm\checksum\PaytmChecksumLibrary;
/* initialize an array */
$paytmParams = array();

/* add parameters in Array */
$paytmParams["MID"] = "NNAeBd06077650735361";
$paytmParams["ORDERID"] = $_POST["ORDER_ID"];
$paytmParams["INDUSTRY_TYPE_ID"]= "Retail";
        $paytmParams["CUST_ID"]= $_POST["CUST_ID"];
        $paytmParams["CHANNEL_ID"]= "WAP";
        $paytmParams["TXN_AMOUNT"]= $_POST["TXN_AMOUNT"];
        $paytmParams["WEBSITE"]= "WEBSTAGING";
        $paytmParams["CALLBACK_URL"] ="https://pguat.paytm.com/paytmchecksum/paytmCallback.jsp";

/**
* Generate checksum by parameters we have
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$paytmChecksum = PaytmChecksum::generateSignature($paytmParams, 'jah3xS0gmYIUaoPQ');
$verifySignature = PaytmChecksum::verifySignature($paytmParams, 'jah3xS0gmYIUaoPQ', $paytmChecksum);
//echo sprintf("generateSignature Returns: %s\n", $paytmChecksum);
//echo sprintf("verifySignature Returns: %b\n\n", $verifySignature);


/* initialize JSON String */  
//$body = "{\"mid\":\"NNAeBd06077650735361\",\"orderId\":\"ord12\"}";

/**
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
//$json=array();
//$checkSum=$paytmChecksum;
//array('CHECKSUMHASH'=>$paytmChecksum);
//$paytmChecksum = PaytmChecksum::generateSignature($body, 'jah3xS0gmYIUaoPQ');

//$verifySignature = PaytmChecksum::verifySignature($body, 'jah3xS0gmYIUaoPQ', $paytmChecksum);
//array_push($json,$checkSum);
//echo sprintf("<br><br>generateSignature Returns: %s\n", $paytmChecksum);
//echo sprintf("<br><br>verifySignature Returns: %b\n\n", $verifySignature);
//$jsonS=json_encode($json);
if($verifySignature) {
	$paramList["CHECKSUMHASH"] = $paytmChecksum;
	echo json_encode($paramList);
} else {
	echo "Checksum Mismatched";
}
