<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</head>
<body>
<?php
error_reporting(E_ALL); ini_set("display_errors", true);
include_once("source2/nusoap.php");
include_once("../lib/confs/sysConf.php");
ini_set ('soap.wsdl_cache_enabled', 0);


      function sendsms(){
        $sysConf= new sysConf();        
        $endURL = $sysConf->SMSWebserviceUrl;

        $header = "<govsms:authData xmlns:govsms=\"http://govsms.icta.lk/\">\n
			<govsms:user>icta</govsms:user>\n
			<govsms:key>g0v5ms123</govsms:key>\n
		</govsms:authData>";
        $gmessage = "test Common HRM";
        $grecepient = "0716439452";
        
        $errorflag = 0;
        $errormsg = '';
        $client = new nusoap_client($endURL, false, '', '', '', '');
        $err = $client->getError();
        
        if ($err) {
            $errorflag = 1;
            $errormsg = 'Error/sms/1';
        } else {

            $client->setUseCurl(0);
            $client->useHTTPPersistentConnection();
            $param = array(
                'v1:outSms' => $gmessage,
                'v1:recepient' => $grecepient,
                'v1:depCode' => "IctaTest",
                'v1:smscId' => "",
                'v1:billable' => ""
            );
            $params = array('v1:requestData' => $param);
            $result = $client->call('v1:SMSRequest ', $params, '', 'sendSms', $header);
            //echo $client->debug(); die;

            if ($client->fault) {
                $errorflag = 1;
                $errormsg = 'Error/sms/2';
            } else {
                $err = $client->getError();
                if ($err) {
                    $errorflag = 1;
                    $errormsg = 'Error/sms/3';
                }
            }
        }

        if ($errorflag == 1) {
            return array(0, $errormsg);
        } else {
            return array(1, $result);
        }

    }
    
    $test =sendsms();
    
    die(print_r($test));

?>
</body>
</html>
