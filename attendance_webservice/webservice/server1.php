<?php

//call library
require_once 'source/config.php';
include_once("source/nusoap/lib/nusoap.php");
require_once '../lib/confs/sysConf.php';
header('Content-Type: text/xml; charset=utf-8');

//error_reporting(E_ALL); ini_set("display_errors", true);
$conn = new Dbconn(HOST, DB, USER, PASS);

$sysConf = new sysConf();

//using soap_server to create server object
$server = new soap_server;


$server->configureWSDL('attendancewsdl', 'urn:attendancewsdl');


$server->wsdl->addComplexType(
        'clk_no',
        'clk_date',
        'clk_time',
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
    
$query = "INSERT INTO hs_hr_atn_clockdown (clk_no,clk_date,clk_time)
VALUES ('{$clk_no}','{$clk_date}','{$clk_time}')";


    $ssql_ = mysql_query($query) or die(mysql_error());
;
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

$server->service($HTTP_RAW_POST_DATA);

exit();
?>

