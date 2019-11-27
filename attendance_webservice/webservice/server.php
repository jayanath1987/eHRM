<?php
//header('Content-Type: text/html; charset=utf-8');
//call library
require_once 'source/config.php';
include_once("source/nusoap/lib/nusoap.php");
//require_once '../../mophhrm/lib/confs/sysConf.php';


//error_reporting(E_ALL); ini_set("display_errors", true);
$conn = new Dbconn(HOST, DB, USER, PASS);

//$sysConf = new sysConf();

//using soap_server to create server object
$server = new soap_server;


$server->configureWSDL('setInsertAttendanceRow', 'urn:setInsertAttendanceRow?wsdl');



$server->wsdl->addComplexType('setInsertAttendanceRow',
        
        array(
            'clk_no' => array('type' => 'xsd:string'),
            'clk_date' => array('type' => 'xsd:string'),
            'clk_time' => array('type' => 'xsd:string')
        ),
        array('type' => 'xsd:boolean')
);

$server->register('setInsertAttendanceRow', array('clk_no' => 'xsd:string','clk_date' => 'xsd:string','clk_time' => 'xsd:string' ), array('return' => 'xsd:boolean'));

function setInsertAttendanceRow($clk_no,$clk_date,$clk_time) { 

if($clk_no!= null && $clk_date!= null && $clk_time!= null){    
    
$queryde =  "DELETE FROM hs_hr_atn_clockdown WHERE clk_no = '{$clk_no}' AND clk_date = '{$clk_date}' AND clk_time = '{$clk_time}'";
$query = "INSERT INTO hs_hr_atn_clockdown (clk_no,clk_date,clk_time,clk_status)
VALUES ('{$clk_no}','{$clk_date}','{$clk_time}',0)";

mysql_query($queryde) or die(mysql_error());

    $ssql_ = mysql_query($query) or die(mysql_error());

    if ( $ssql_ === true ){
        return true;
    }else{
        return false;
    }

}
else{
    return false;
}

}    

//$HTTP_RAW_POST_DATA = file_get_contents('php://input');
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

exit();
?>

