<?php

//call library
require_once 'source/config.php';
include_once("source/nusoap/lib/nusoap.php");
require_once '../lib/confs/sysConf.php';

//error_reporting(E_ALL); ini_set("display_errors", true);
$conn = new Dbconn(HOST, DB, USER, PASS);

$sysConf = new sysConf();

//using soap_server to create server object
$server = new soap_server;


$server->configureWSDL('designationdivisionwsdl', 'urn:designationdivisionwsdl');

$headOfficeIds = array();
$status = "No user defined";

$server->wsdl->addComplexType(
        'designations',
        'complexType',
        'struct',
        'all',
        '',
        array(
            'jobtit_code' => array('type' => 'xsd:string'),
            'jobtit_name' => array('type' => 'xsd:string'),
            'jobtit_name_si' => array('type' => 'xsd:string'),
            'jobtit_name_ta' => array('type' => 'xsd:string')
        )
);


$server->wsdl->addComplexType('estructura', 'complexType', 'array', '',
        'SOAP-ENC:Array', array(),
        array(array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:designations[]')),
        'tns:designations');

$server->register('getDesignations', array(), array('return' => 'tns:estructura'));

// create the function

function getDesignations() {

    $ssql_ = mysql_query("select jobtit_code,jobtit_name, jobtit_name_si, jobtit_name_ta from hs_hr_job_title") or die(mysql_error());
    $numrows = mysql_num_rows($ssql_);
    $designationList = array();
    for ($x = 0; $x < $numrows; $x++) {
        $designationList[] = mysql_fetch_array($ssql_);
    }
    return $designationList;
}

//start getDivisionlist webMethod

$server->wsdl->addComplexType(
        'divisions',
        'complexType',
        'struct',
        'all',
        '',
        array(
            'comp_code' => array('type' => 'xsd:string'),
            'title' => array('type' => 'xsd:string'),
            'title_si' => array('type' => 'xsd:string'),
            'title_ta' => array('type' => 'xsd:string'),
            'comp_isfunctional' =>array('type' => 'xsd:string'),
        )
);


$server->wsdl->addComplexType('divisiontype', 'complexType', 'array', '',
        'SOAP-ENC:Array', array(),
        array(array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:divisions[]')),
        'tns:divisions');

$server->register('getDivisions', array(), array('return' => 'tns:divisiontype'));

function getDivisions() {
    global $headOfficeIds;
    $sysConf = new sysConf();
    $pkey = getHeadOffPK("000002");
//	die(print_r($pkey));
    display_children($pkey);
    $sysConf = new sysConf();


  //$ssql_ = mysql_query("select id as comp_code,title, title_si, title_ta from  hs_hr_compstructtree where def_level=4 and parnt=".$parent_id". or comp_code) or die(mysql_error());


   

    for ($x = 0; $x < count($headOfficeIds); $x++) {

        $ssql_ = mysql_query("select id as comp_code,title, title_si, title_ta,comp_isfunctional from  hs_hr_compstructtree where id={$headOfficeIds[$x]}") or die(mysql_error());
        $divisionList[] = mysql_fetch_array($ssql_);
$numrows = mysql_num_rows($ssql_);   
 }
    return $divisionList;
}

/*$result = mysql_query($query)or die(mysql_error()); 
if ($row['status'] == "Enabled") {
        $status = "true";
    } else if ($row['status'] == "Disabled") {
        $status = "false";
    } else {
        $status = "No user defined";
    }
    return $status; 
} */

function isUserActive($empDisplayNumber) {
   $query = "SELECT * FROM hs_hr_users u            
            where u.user_name=" . "'" . $empDisplayNumber . "'";
//   $query = "SELECT * FROM hs_hr_users u where u.user_name=822872345V";

    $result = mysql_query($query); 

    $row = mysql_fetch_object($result);

    if ($row->status == "Enabled") {
        $status = "true";
    } else if ($row->status == "Disabled") {
        $status = "false";
    } else {
        $status = "No user defined";
    }
    return $status;



}

function display_children($parent='') {


    global $headOfficeIds;

    //die($pkey);
    // retrieve all children of $parent
    $query = 'SELECT * FROM hs_hr_compstructtree c   WHERE parnt="' . $parent . '";';

    $ssql_ = mysql_query($query) or die(mysql_error());


    while ($row = mysql_fetch_array($ssql_)) {
        $headOfficeIds[] = $row['id'];
//        die(print_r($row['id']));
        display_children($row['id']);
    }
    //return $headOfficeIds;
}

function getHeadOffPK($comp_code) {
    $query = 'SELECT * FROM hs_hr_compstructtree c where comp_code="' . $comp_code . '";';


    $ssql_ = mysql_query($query) or die(mysql_error());


    while ($row = mysql_fetch_array($ssql_)) {

        $id = $row['id'];
    }
    return $id;
}

//---JBL Ldap employees agains to date
$server->wsdl->addComplexType(
        'Employee',
        'complexType',
        'struct',
        'all',
        '',
        array(
            //'ldap_adt_employeeid' => array('type' => 'xsd:integer'),
            'employee_id' => array('type' => 'xsd:string')
            /*,
            'jobtit_name_si' => array('type' => 'xsd:string'),
            'jobtit_name_ta' => array('type' => 'xsd:string') */
        )
);

//$server->wsdl->addComplexType('LDAPEmp', 'complexType', 'array', '',
//$server->wsdl->addComplexType('LDAPEmp', 'string', 'array', '',
//        'SOAP-ENC:Array', array(),
//        array(array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Employee[]')),
//        'tns:Employee');
//
//$server->register('getLdapEmployeesFromDate', array('date' => 'xsd:date'), array('return' => 'tns:LDAPEmp'));
//
//function getLdapEmployeesFromDate($date) {
//
//$query = 'SELECT distinct(l.ldap_adt_employeeid),e.employee_id FROM  hs_hr_ldap_audit l 
//Left JOIN hs_hr_employee e ON e.emp_number = l.ldap_adt_employeeid    
//where DATE(l.ldap_adt_datetime) >= "'. $date.'" and l.ldap_adt_employeeactiveflag = "active"';
//
//    $ssql_ = mysql_query($query) or die(mysql_error());
//    $numrows = mysql_num_rows($ssql_);
//    $designationList = array();
//    for ($x = 0; $x < $numrows; $x++) {
//        $designationList[] = mysql_fetch_array($ssql_);
//    }
//    
//    return $designationList;
//}

$server->wsdl->addComplexType('LDAPEmp', 'string', 'array', '',
        'SOAP-ENC:Array', array(),
        array(array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Employee[]')),
        'tns:Employee');

$server->register('getLdapEmployeesFromDate', array('date' => 'xsd:date'), array('return' => 'xsd:string'));

function getLdapEmployeesFromDate($date) {

$query = 'SELECT distinct(l.ldap_adt_employeeid),e.employee_id FROM  hs_hr_ldap_audit l 
Left JOIN hs_hr_employee e ON e.emp_number = l.ldap_adt_employeeid    
where DATE(l.ldap_adt_datetime) >= "'. $date.'" and l.ldap_adt_employeeactiveflag = "active"';

    $ssql_ = mysql_query($query) or die(mysql_error());
    $numrows = mysql_num_rows($ssql_);
    //$designationList = array();
    $temp = array();
    for ($x = 0; $x < $numrows; $x++) {
        $temp = mysql_fetch_array($ssql_);
        if($x == 0){
            $temp=$temp[1];
        }else{
            $temp="|".$temp[1];
        }       

        $designationList= $designationList.$temp;
    }
    
    return $designationList;
    //return $temp ;
    
}


//--------

//display_children($sysConf->headOfficeCode);
//
//print_r($headOfficeIds);
//die;


$server->register('isUserActive', array('empDisplayNumber' => 'xsd:string'), array('return' => 'xsd:string'));
//$server->register('isUserActive', array('empDisplayNumber' => 'xsd:string'), array('return' => 'xsd:string'));
// create HTTP listener

function getDesignations2() {

    $ssql_ = mysql_query("select jobtit_code,jobtit_name, jobtit_name_si, jobtit_name_ta from hs_hr_job_title") or die(mysql_error());
    $numrows = mysql_num_rows($ssql_);
    $designationList = array();
    for ($x = 0; $x < $numrows; $x++) {
        $designationList[] = mysql_fetch_array($ssql_);
    }
    return $designationList;
}

$server->wsdl->addComplexType(
        'designations',
        'complexType',
        'struct',
        'all',
        '',
        array(
            'jobtit_code' => array('type' => 'xsd:string'),
            'jobtit_name' => array('type' => 'xsd:string'),
            'jobtit_name_si' => array('type' => 'xsd:string'),
            'jobtit_name_ta' => array('type' => 'xsd:string')
        )
);


$server->wsdl->addComplexType('estructura', 'complexType', 'array', '',
        'SOAP-ENC:Array', array(),
        array(array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:designations[]')),
        'tns:designations');

$server->register('getDesignations2', array(), array('return' => 'tns:estructura'));


$server->service($HTTP_RAW_POST_DATA);

exit();
?>

