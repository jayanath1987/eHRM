<?php

$arr = Array();

$secDao = new securityDao();

foreach ($emplist as $row) {


    $employeeId = $row->employeeId;
    $employeeNumber = $row->empNumber;
    $employeeNIC = $row->emp_nic_no;

    if ($culture == "en") {
        $empName = $row->emp_display_name;
        $jobName = $row->jobTitle->name;
        $section = $row->subDivision->title;
    } else {
        $empNameLan = "emp_display_name_" . $culture;

        $sectionLan = "title_" . $culture;
        $jobName = "name_" . $culture;

        if (!strlen($row->$empNameLan)) {
            $empName = $row->emp_display_name;
        } else {
            $empName = $row->$empNameLan;
        }
        if (!strlen($row->subDivision->$sectionLan)) {
            $section = $row->subDivision->$sectionLan;
        } else {
            $section = $row->subDivision->title;
        }
        if (!strlen($row->jobTitle->$jobName)) {
            $jobName = $row->jobTitle->name;
        } else {
            $jobName = $row->jobTitle->$jobName;
        }
    }

    $arr[$row['empNumber']] = $employeeId . "|" . $empName . "|" . $jobName . "|" . $section . "|" . $employeeNumber . "|" . $employeeNIC;
}



echo json_encode($arr);
?>