<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ICTASMS
 *
 * @author jayanath
 */

error_reporting(E_ALL); ini_set("display_errors", true);
require_once ROOT_PATH . '/webservice/source2/nusoap.php';
require_once ROOT_PATH .'/lib/confs/sysConf.php';
ini_set ('soap.wsdl_cache_enabled', 0);

class ICTASMS {
    
    //put your code here
        public function __construct($config = array()) {
        $this->sysConf = new sysConf(); 
           
        $this->endURL = $this->sysConf->SMSWebserviceUrl;

        $this->header = "<govsms:authData xmlns:govsms=\"http://govsms.icta.lk/\">\n
			<govsms:user>{$this->sysConf->user}/govsms:user>\n
			<govsms:key>{$this->sysConf->key}</govsms:key>\n
		</govsms:authData>";
        $this->gmessage = $config['message'];
        $this->grecepient = $config['recepient'];
        
    }
    
    public function sendsms($config = array()) {
        if($this->sysConf->SMSSend == "YES"){ 

        $this->header = "<govsms:authData xmlns:govsms=\"http://govsms.icta.lk/\">\n
			<govsms:user>".$this->sysConf->user."</govsms:user>\n
			<govsms:key>".$this->sysConf->key."</govsms:key>\n
		</govsms:authData>";
        $this->gmessage = $config['message'];
        $this->grecepient = $config['recepient'];
        $errorflag = 0;
        $errormsg = '';
        $client = new nusoap_client($this->endURL, false, '', '', '', '');
        $err = $client->getError();
        
        if ($err) {
            $errorflag = 1;
            $errormsg = 'Error/sms/1';
        } else {

            $client->setUseCurl(0);
            $client->useHTTPPersistentConnection();
            $param = array(
                'v1:outSms' => $this->gmessage,
                'v1:recepient' => $this->grecepient,
                'v1:depCode' => "IctaTest",
                'v1:smscId' => "",
                'v1:billable' => ""
            );
            $params = array('v1:requestData' => $param);
            $result = $client->call('v1:SMSRequest', $params, '', 'sendSms', $this->header);
            die(print_r($result)); 

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
    }
}

?>
