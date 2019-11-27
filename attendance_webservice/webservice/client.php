<html>
<head>
<meta http-equiv="Content-Type" content="text/xml;charset=utf-8" >
</head>
<body>
<?php


error_reporting(E_ALL); ini_set("display_errors", true);
include_once("source/nusoap/lib/nusoap.php");
ini_set ('soap.wsdl_cache_enabled', 0);

$client = new nusoap_client('https://103.11.35.8/MahaweliHRM/webservice/server.php?wsdl');
$client->soap_defencoding = 'UTF-8';
$client->debug_flag = false;
$soapError = $client->getError();


$clk_no = "842480698V";
$clk_date = "2013-05-30";
$clk_time = "08:30:00";
$response = $client->call('setInsertAttendanceRow',array("clk_no" => $clk_no, "clk_date" => $clk_date, "clk_time" => $clk_time));
die(print_r($client->response ));
if($response){    
    die("Success");
    }else{
    die("Error");
}



?>
</body>
</html>
