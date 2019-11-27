<?php

/*
  // OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
  // all the essential functionalities required for any enterprise.
  // Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com

  // OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
  // the GNU General Public License as published by the Free Software Foundation; either
  // version 2 of the License, or (at your option) any later version.

  // OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
  // without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
  // See the GNU General Public License for more details.

  // You should have received a copy of the GNU General Public License along with this program;
  // if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
  // Boston, MA  02110-1301, USA
 */

class sysConf {

    var $itemsPerPage;
    var $itemsPerPage2;
    /** $accessDenied is depreciated and no longer in use
     *  Please use the language files to change the access denied message.
     */
    var $accessDenied;
    var $viewDescLen;
    var $userEmail;
    var $maxEmployees;
    var $dateFormat;
    var $timeFormat;
    var $maxFileSize;
    var $maxFileSize2;
    var $dateInputHint;
    var $timeInputHint;
    var $styleSheet;
    var $allowedExtensions;
    var $rowLimit;
    var $reportServerPath;
    var $ldap_host;
    var $ldap_port;
    var $ldap_username;
    var $ldap_password;
    var $ldap_basedn;


    function sysConf() {

        $this->itemsPerPage = 10;
        $this->itemsPerPage2 = 20;

        /* $accessDenied is depreciated and no longer in use
         *  Please use the language files to change the access denied message.
         */
        $this->accessDenied = "Access Denied";

        $this->viewDescLen = 60;
        $this->userEmail = 'youremail@mailhost.com';
        $this->maxEmployees = '4999';
        $this->dateFormat = "Y-m-d";
        $this->dateInputHint = "yy-mm-dd";
        $this->timeFormat = "H:i";
        $this->timeInputHint = "HH:MM";
        $this->styleSheet = "orange";
        $this->maxFileSize = "2097152"; //2Mb
        $this->maxFileSize2 = "5242880"; //5Mb
        $this->maxFileSizeDis = "10485760"; //10Mb
        $this->rowLimit = 15;

        //LDAP configurations 
        $this->ldap_host = "192.168.0.159";
        $this->ldap_port = 1389;
        $this->ldap_username = "cn=Directory Manager";
        $this->ldap_password = 1;

        $this->ldap_basedn = "cn=Employee,ou=users,dc=esamurdhiint,dc=lk";
        $this->ldap_objectClass = "inetOrgPerson";
        //YES to activate ldap save
        $this->isuseLdap = "NO";
        $this->rootDn = "dc=esamurdhiint,dc=lk";

        //LDAP columns
        $this->EmployeeID = "EmployeeID";
        $this->cn = "cn";
        $this->sn = "sn"; //first name + last name
        $this->FirstName = "FirstName";
        $this->FirstNameSI = "FirstNameSI";
        $this->FirstNameTA = "FirstNameTA";
        $this->LastName = "LastName";
        $this->LastNameSI = "LastNameSI";
        $this->LastNameTA = "LastNameTA";
        $this->DivisionCode = "DivisionCode";
        $this->DepartmentCode = "DepartmentCode";
        $this->Email = "Email";
        $this->EmployeeActiveFlag = "EmployeeActiveFlag";
        $this->DistrictCode = "DistrictCode";
        $this->ZoneCode = "ZoneCode";
        $this->WasamCode = "WasamCode";
        $this->DesignationCode = "DesignationCode";
        $this->headOfficeCode = "100000";
        $this->dummyEmail = " ";
        $this->Province="ProvinceCode";

        //Cas Integration

        $this->isCasEnable = "NO";
        $this->casHost = "122.248.242.3";
        $this->port = 443;
        $this->casContext = "cas";

        //T & D Configureation ,This Code is using in company structures please dont change this values
        $this->hie_code = "hie_code_3";
        $this->Headoffice = "27";
        $this->HeadofficeCompCode = "000003";
        $this->WasamLevel = "6";
        $this->ZonalLevel = "5";
        $this->DivisionLevel = "4";
        $this->DistrictLevel = "3";
        $this->ProvinceLevel = "2";
        $this->DivisionSecretory = "10";
        $this->DistrictSecretory = "11";
        $this->HRTeam = "4";
        $this->HRAdmin = "3";

        //Transfer Configeration
        $this->TransferHeadoffice = "3";
        $this->TransferWasamLevel = "6";
        $this->TransferZonalLevel = "5";
        $this->TransferDivisionLevel = "4";
        $this->TransferDistrictLevel = "3";
        $this->TransferProvinceLevel = "2";
        $this->TransferNationalLevel = "1";  
        
        $this->TransferDivisionSecretory = "11";
        $this->TransferDistrictSecretory = "10";
        $this->TransferZonalManager = "13";
        $this->TransferAssistantCommissioner = "15";
        $this->TransferDirectorEstablishment = "17";
        $this->TransferDirectorGeneral = "18";
        $this->TransferDirectorAdministration = "20";
        $this->TransferSamurdhiDevelopmentOfficer = "14";
        $this->TransferManager = "19";

        //Transfer Zone Group
//        $this->TransferZonalManager="8";
//        $this->TransferDivisionSecretary="9";
//        $this->TransferDistrictSecretary="10";
//        $this->DeputySamurdhiDirector="11";
//        $this->TransferDistrictSecretariat="12";
//        $this->TransferDirectorGeneralGroup="13";
//        $this->TransferDirectorEstablishment ="14";
//        $this->TransferHeadOfficeHRDepartment ="15";
//        $this->TransferManagerGroup="16";
//        $this->TransferSamurdhiDevelopment ="17";
//        $this->TransferDirectorAdministration  ="18";



        

        $this->allowedExtensions = array("odf", "odg", "odp", "ods", "odt", "docx", "docm", "dotx", "dotm", "xlsm", "xlsx", "pptx", "txt", "csv", "xml", "doc", "xls", "rtf", "ppt", "pdf", "jpg", "jpeg", "gif", "png", "bmp", "tiff");
        $this->allowedImageExtensions = array("jpg", "jpeg", "gif", "png", "bmp", "tiff");
        $this->allowedExtensionsForEmpAttahment = array("zip", "rar", "odf", "odg", "odp", "ods", "odt", "docx", "docm", "dotx", "dotm", "xlsm", "xlsx", "pptx", "txt", "csv", "xml", "doc", "xls", "rtf", "ppt", "pdf", "jpg", "jpeg", "gif", "png", "bmp", "tiff");
        $this->allowedExtensionsForAdvertiesment = array("jpg", "jpeg", "gif", "png", "bmp", "tiff", "pdf", "docx", "docm", "dotx", "dotm", "pptx", "txt", "ppt", "pdf");

        // Report server path
        $this->reportServerPath = 'http://192.168.1.40:8080/birt-viewer/';
        //$this->reportServerPath = '/birt-viewer';
        //$this->reportServerPath = 'http://192.168.1.40:8080/birt-viewer/frameset?__report=';
        $this->langTransUrl = "http://repository.icta.lk/TransliterationWebService/TransliterationService?wsdl";

        //ON for lang translator active. OFF for deactive

        $this->langTransStatus = "ON";
        
        //Performance Module WebService Employee against Project
        
        $this->EmployeeProjectWebServiceUrl = "http://122.248.242.3/eSamurdhiWebService/services/eSamurdhiPPM/eSamurdhiPPM.wsdl";
        $this->EmployeeProjectWebServiceUrlSetLocation = "http://122.248.242.3/eSamurdhiWebService/services/eSamurdhiPPM/";
        //ON for EmployeeProjectWebService active. OFF for deactive

        $this->EmployeeProjectWebServiceStatus = "ON";

        //PayRoll Configs

        $this->BSalTypecode=1;
        $this->ContributCode=0;
        $this->DeductCode=-1;
        $this->Earncode=2;
        
        
        //Security Users Configs
        $this->National=1;
        $this->District=2;
        $this->Divition=3;
        $this->ESS=4;
        
        
        //Email
        $this->EmailSend = "YES";
        $this->EmailHost = "smtp.icta.lk";  // specify main and backup server
	$this->EmailSMTPAuth = true;     // turn on SMTP authentication
        $this->EmailUsername = "commonhrm@icta.lk";        // Make sure to replace this with your shell enabled user
        $this->EmailPassword = "commonhrm1234"; 
        $this->EmailFrom = "commonhrm@icta.lk";
	$this->EmailFromName = "Commonhrm";
        $this->EmailReplyToEmail = "commonhrm@icta.lk";
        $this->EmailReplyToName = "Commonhrm";
        $this->Emailnotreportto = array("con_off_email"=>"rita@icta.lk");
        
        
    }

    function getEmployeeProjectWebServiceStatus() {
        return $this->EmployeeProjectWebServiceStatus;
    }

    function getEmployeeProjectWebServiceUrl() {
        return $this->EmployeeProjectWebServiceUrl;
    }
    
    function getEmployeeProjectWebServiceUrlSetLocation() {
        return $this->EmployeeProjectWebServiceUrlSetLocation;
    }
    
    function getLangTransStatus() {
        return $this->langTransStatus;
    }

    function getLangTransUrl() {
        return $this->langTransUrl;
    }

    function getAllowExtensions() {
        return $this->allowedExtensions;
    }

    function getRowLimit() {
        return $this->rowLimit;
    }

    function getAllowExtensionsForEmpAttch() {
        return $this->allowedExtensionsForEmpAttahment; 
    }

    function getEmployeeIdLength() {
        return strlen($this->maxEmployees);
    }

    function getDateFormat() {
        return $this->dateFormat;
    }

    function getTimeFormat() {
        return $this->timeFormat;
    }

    function getDateInputHint() {
        return $this->dateInputHint;
    }

    function getTimeInputHint() {
        return $this->timeInputHint;
    }

    function getStyleSheet() {
        return $this->styleSheet;
    }

    function getMaxFilesize() {
        return $this->maxFileSize;
    }

    function getMaxFilesize2() {
        return $this->maxFileSize2;
    }

    function getMaxFilesizeDis() {
        return $this->maxFileSizeDis;
    }

    function getMaxFilesizeEmpAttach() {
        return $this->maxFileSizeDis;
    }

    function getReportServerPath() {
        return $this->reportServerPath;
    }

}

?>
