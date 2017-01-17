<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$checkSum = "";
// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .
$findme   = 'REFUND';
$parameterarray = array();

if (!array_key_exists('MID', $_POST)) {
    $_POST= "";
    exit();
}
if (!array_key_exists('ORDER_ID', $_POST)) {
    $_POST= "";
    exit();
}
if (!array_key_exists('WEBSITE', $_POST)) {
    $_POST= "";
    exit();
}
if (!array_key_exists('CHANNEL_ID', $_POST)) {
    $_POST= "";
    exit();
}
if (!array_key_exists('TXN_AMOUNT', $_POST)) {
    $_POST= "";
    exit();
}
if (!array_key_exists('INDUSTRY_TYPE_ID', $_POST)) {
    $_POST= "";
    exit();
}
if (!array_key_exists('CUST_ID', $_POST)) {
    $_POST= "";
    exit();
}
foreach($_POST as $key=>$value)
{
  if(!empty($value))
    {
      $parameterarray[$key] = $value;
    } 
  $pos = strpos($value, $findme);
  if ($pos !== false) 
    {
        //echo "SECURITY ERROR".$value;
        $_POST= "";
        exit();
    }
}

  

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($parameterarray,PAYTM_MERCHANT_KEY);
//print_r($_POST);

 echo json_encode(array("CHECKSUMHASH" => $checkSum,"ORDER_ID" => $parameterarray["ORDER_ID"], "payt_STATUS" => "1"));

  //Sample response return to SDK
 
//  {"CHECKSUMHASH":"GhAJV057opOCD3KJuVWesQ9pUxMtyUGLPAiIRtkEQXBeSws2hYvxaj7jRn33rTYGRLx2TosFkgReyCslu4OUj\/A85AvNC6E4wUP+CZnrBGM=","ORDER_ID":"asgasfgasfsdfhl7","payt_STATUS":"1"} 
 

?>
