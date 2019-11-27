<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</head>
<body>
<?php
error_reporting(E_ALL); ini_set("display_errors", true);
include_once("source/nusoap/lib/nusoap.php");
ini_set ('soap.wsdl_cache_enabled', 0);

$client = new nusoap_client('http://localhost/ictalive/webservice/server.php?wsdl');

//$response = $client->call('getDesignations');
//$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;

echo "---Division List Array-----------";
echo "<br/>";

$response = $client->call('getDivisions');
print_r($response);
echo "<br/>";
echo "<br/>";
echo "----Designation List-----------";
echo "<br/>";

$response = $client->call('getDesignations');
print_r($response);
echo "<br/>";

echo "---LDAP Employee List-----------";
echo "<br/>";

$response = $client->call('getLdapEmployeesFromDate',array("2010-06-05"));
print_r($response);
echo "<br/>";


echo "<br/>";
echo "---User Status----";
//$response = $client->call('isUserActive',array("822872345V"));
//print_r($response);;
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';


?>
</body>
</html>
