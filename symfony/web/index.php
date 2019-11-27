<?php

/* Added for compatibility with current orangehrm code 
 * OrangeHRM Root directory 
 */
header("Cache-Control: no-store, no-cache, must-revalidate");
define('ROOT_PATH', dirname(__FILE__) . '/../../');
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);
define('WPATH', $scriptPath . "/../../");
ini_set('memory_limit', '-1');


require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

ob_start();

/*
 * @param3 always give as false when Live.it will says debug mode false.
 */




$configuration = ProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true);


sfContext::createInstance($configuration)->dispatch();

$requestUrl = explode("/", $_SERVER['REQUEST_URI']);
$RequestUrl = $_SERVER['REQUEST_URI'];

/* Default set $flag to 0 */
$flag = 0;

$findme = "symfony";
$pos = strpos($RequestUrl, $findme);
$rest = substr($RequestUrl, $pos);

/* $rest  will out put ex:- symfony/web/index.php/pim/list */
$new = $rest;

/* get the current module and action */
$explodeed = explode("/", $rest);
$currentModule = $explodeed[3];
$currentAction = $explodeed[4];

$isNavigation = explode("?", $currentAction);

/* Count the current parameters of the requesr URL */
$countParameters = count($isNavigation);

/* $isNavigation is Action with out parameters */
$isNavigation = $isNavigation[0];


$RequestUrl = "./" . $rest;
$moduleAction = $currentModule . "/" . $isNavigation;




$results = array();
if ($_SESSION['user'] == "USR001") {
    $query = "SELECT m.sm_mnuitem_webpage_url,m.sm_mnuitem_dependency,m.sm_mnuitem_id FROM hs_hr_sm_mnuitem m ORDER BY sm_mnuitem_parent, sm_mnuitem_position;";
} else {
    $query = "select m.sm_mnuitem_webpage_url,m.sm_mnuitem_dependency,m.sm_mnuitem_id from hs_hr_sm_mnuitem m left join hs_hr_sm_mnucapability c on m.sm_mnuitem_id=c.sm_mnuitem_id left join hs_hr_users u on u.sm_capability_id=c.sm_capability_id where u.id='" . $_SESSION['user'] . "' ORDER BY m.sm_mnuitem_parent, m.sm_mnuitem_position ASC;";
}

$conn = Doctrine_Manager::getInstance()->connection();
$stmt = $conn->prepare($query);
$stmt->execute();
while ($row = $stmt->fetch()) {
    $results[] = $row['sm_mnuitem_webpage_url'] . "|" . $row['sm_mnuitem_dependency'] . "|" . $row['sm_mnuitem_id'];
    $allDependency[] = $row['sm_mnuitem_dependency'];
}

foreach ($allDependency as $key => $value) {
    if (strlen($value)) {
        $temp[] = explode(",", $value);
    }
}
foreach ($temp as $key => $value) {


    foreach ($value as $key1 => $value1) {

        $temp3[] = $value1;
    }
}

foreach ($results as $key => $value) {

    $separetor = explode("|", $value);
    $dependency = explode(",", $separetor[1]);
    $findmeCurrent = "symfony";
    $posCurrent = strpos($separetor[0], $findmeCurrent);



    $restCurrent = substr($separetor[0], $posCurrent);

    if ($isNavigation == "listCompanyStructure" && $countParameters == 1) {
        if ($separetor[0] == $RequestUrl) {


            $_SESSION['currentDependency'] = $dependency;

            $_SESSION['currentMenu'] = $new;
            $_SESSION['validCurrnetMenuID'] = $separetor[2];


            $flag = 1;
            break;
        }
    } else {

        if ($separetor[0] == $RequestUrl) {


            $_SESSION['currentDependency'] = $dependency;
            $_SESSION['currentMenu'] = $new;
            $_SESSION['validCurrnetMenuID'] = $separetor[2];


            $flag = 1;
            break;
        } elseif (in_array($isNavigation, $temp3)) {

            if ($isNavigation == "searchEmployee") {
                $_SESSION['isEmpListEnable'] = 1;
            }

            $flag = 1;

            break;
        } elseif (in_array($isNavigation, $temp3)) {

            if ($isNavigation == "searchEmployeePayProcess") {
                $_SESSION['isEmpListEnable'] = 1;
            }

            $flag = 1;

            break;
        } else {
            
        }
    }
}



if ($flag != 1) {
    if (file_exists('excludeMenus.xml')) {
        $xmlstr = simplexml_load_file('excludeMenus.xml');

        foreach ($xmlstr->MenuName as $name) {


            if ($moduleAction == "$name") {

                $flag = 1;
                break;
            }
        }
    }
}

if (strlen(strpos($rest, $_SESSION['currentMenu'])) > 0) {
    $flag = 1;
}



if ($flag == 0) {


    sfContext::getInstance()->getController()->redirect("default/accessDenied");
} else {
    ob_end_flush();
}



