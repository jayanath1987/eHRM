<?php
error_reporting(E_ALL); ini_set("display_errors", true);

define('ROOT_PATH', dirname(__FILE__));
require_once ROOT_PATH . '/lib/confs/sysConf.php';


$sysConfs=new sysConf();

include_once('CAS.php');


if ($sysConfs->isCasEnable == "YES") {
phpCAS::client(CAS_VERSION_2_0, $sysConfs->casHost, $sysConfs->port, $sysConfs->casContext, true);

phpCAS::logout();
}
session_start();
session_destroy();


header("Location: ./login.php");
exit();

?>
