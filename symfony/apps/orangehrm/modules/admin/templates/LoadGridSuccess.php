<?php

$arr = Array();

$CompanyDao = new CompanyDao();

foreach ($emplist as $row) {

    if ($culture == "en") {
        $abc = "emp_display_name";
    } else {
        $abc = "emp_display_name_" . $culture;
    }
    if ($culture == "en") {
        $title = "title";
    } else {
        $title = "title_" . $culture;
    }
    $comStruture = $CompanyDao->getCompnayStructure($row['work_station']);
    if ($culture == "en") {
        $title = "getTitle";
    } else {
        $title = "getTitle_" . $culture;
    }
    if ($comStruture) {
        $comTitle = $comStruture->$title();
    }
    $roleIdArray=$CompanyDao->getRoleIdbyEmpId($row['empNumber'],$compId);
    $roleId=$roleIdArray[0]['role_group_id'];
    $arr[$row['empNumber']] = $row['employeeId'] . "|" . $row[$abc] . "|" . $comTitle . "|" . $row['emp_status'] . "|" . $row['empNumber']."|".$roleId."|".$compId;
}



echo json_encode($arr);
die;
?>