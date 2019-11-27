<?php /*

$server = '192.162.0.100:1433';

// Connect to MSSQL
$link = sqlsrv_connect($server, array( "Database"=>"KEICO_NEW", "UID"=>"sa", "PWD"=>"passward"));

if (!$link) {
    die('Something went wrong while connecting to MSSQL');
}else{
  die('OK');
}

*/

?>
<?php  /*
$serverName = "192.162.0.100\FP-SERVER\SQLSERVERR2, 1433"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"KEICO_NEW", "UID"=>"sa", "PWD"=>"passward");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
*/

?>

<?php 
$connect = odbc_connect("test", "", "");
if (!$connect ) {
    die('Something went wrong while connecting to MSSQL');
}else{
  die('OK');
}


?>
