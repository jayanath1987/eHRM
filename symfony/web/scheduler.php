<?php

define('ROOT_PATH', dirname(__FILE__) . '/../../');
#
define('SF_ROOT_DIR', realpath(dirname(__FILE__).'/..'));
#
define('SF_APP', 'orangehrm');
#
define('SF_ENVIRONMENT', 'prod');
#
define('SF_DEBUG', true);
#
 
#
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
#
 
#
// get the application instance
#
$configuration = ProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true);
sfContext::createInstance($configuration);
#
 
#
// put whatever code you need here…
#
echo "\r\n Start Leave Accrual\r\n";

$leaveAccrualService	=	new LeaveAccrualService();
$leaveAccrualService->processAccrual();

echo "\r\n End Leave Accrual\r\n";
