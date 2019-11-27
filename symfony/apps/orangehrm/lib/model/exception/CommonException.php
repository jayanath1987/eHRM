<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CommonException extends Exception
{

	private $logFile = "../log/commonEx.log";

        private $log = Array();

        public $code="";

	public function __construct($message = null, $code = 0)
    {                             
        $exLog['msg'] = $message;
        $exLog['code'] = $code;
        $this->code=$code;
        
        
        $exLog['file'] = $this->getFile();
        $exLog['line'] = $this->getLine();

        $this->log = $exLog;

        $this->_writeToLog($exLog);
        sfLoader::loadHelpers('I18N');
    }
    
   
    public function display() {
        //return array("sadsad");
    switch ($this->code) {
    case 1:
        return  array(__("Upload fail maximum file size shoud be less than 2MB"));
        break;
    case 2:
        return  array(__("Damaged Excel file or data Format Error"));
        break;
    case 3:
        return  array(__("Damaged Text file or data Format Error"));
        break;
    case 4:
        return  array(__("Invalid In Time Hours"));
        break;
    case 5:
        return  array(__("Upload fail maximum file size shoud be less than 5MB"));
        break;
    case 6:
        return  array(__("Upload Failed. Invalid File Type or Max upload size exceeded"));
        break;
    case 7:
        return  array(__("Upload fail maximum file size shoud be less than 10MB"));
        break;
    case 8:
        return  array(__("Upload Fail. Invalid File Type"));
        break;
    case 9:
        return  array(__("Upload fail maximum file size shoud be less than 1MB"));
        break;
    case 10:
        return  array(__("You can not add yourself as a supervisor/subordinates to you"));
        break;
    case 11:
        return  array(__("Supervisor / Subordinate already added to the employee with the same method"));
        break;
    case -5:
        return  array(__("Duplicate Entry"));
        break;
    case -16:
        return  array(__("Can't Delete"));
        break;
    case -3:
        return  array(__("This record may uses another place"));
        break;
    case -29:
        return  array(__("Foreign key null"));
        break;
    case -19:
        return  array(__("column not found"));
        break;
    case 100:
        return  array(__("Ldap Connection faild could not connect!!"));
        break;
    case 101:
        return  array(__("authentication fail to ldap"));
        break;
    case 102:
        return  array(__("Insert fail to the ldap"));
        break;
    case 103:
        return  array(__("Update fail to the ldap"));
        break;
    case 104:
        return  array(__("Can not find records according to work flow typeId and sequence id"));
        break;
    case 105:
        return  array(__("Approve person not set"));
        break;
    case 106:
        return  array(__("Main Approve person save Failed"));
        break;
    case 200:
        return  array(__("Admin can not see this page"));
        break;
    case 500:        
        return  array(__("You dont have permission to see this page"));
        break;
    case 501:       
        return  array(__("Security Level is not allowed to select this division/department"));
        break;
    case 502:
        return  array(__("User is not allow to assign to this security level"));
        break;
    case 503:
        return  array(__("There is a only one Direct Supervisor for this Employee."));
        break;    
    default:
      return  array(__("Problem has Occured"));
        break;
       //return  array(__($this->log[msg]));
//return $this->log;
    }
        
 }

    private function _writeToLog($exLog) {

    	error_log(implode("|", $exLog) . "\r\n", 3, $this->logFile);
    }
}
?>
