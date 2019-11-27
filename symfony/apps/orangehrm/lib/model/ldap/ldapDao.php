<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 15 Augst 2011
 *  Comments  - ldap Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class ldapDao extends BaseDao {
    public $headOfficeIds=array();

    /*
     * This function is handle the CURD operation of LDAP server with HRM
     *
     */

    public function callToLdap($empJob) {
        
        $service = new EmployeeService();
        $ldap_user = $empJob->empNumber;
        $empDao = new EmployeeDao();
        $empContactObj = $empDao->readEmployeeContacts($ldap_user);

        $sysConf = new sysConf();
            
        if ($sysConf->isuseLdap == "YES") {

            $ldap = new LdapConnect();
            $LdapAudit= new LDAPAudit();
            $ldap->ldap_connect();
            $ldap_saveUser = $empJob->employeeId;
            $readValue = $ldap->ladp_readEntry($ldap_user);

            $DivisionDisplayNumber = $service->getDivisionDisplayNo($empJob->work_station);

            $DivisionDisplayNumber = $DivisionDisplayNumber->comp_code;

            

            $getParentObj = $service->getDivisionDisplayNo($empJob->work_station);
            $getParent = $getParentObj->parnt;

            $getParentObj = $service->getDivisionDisplayNo($getParent);


            

            $HeadOffPK=$this->getHeadOffPK($sysConf->headOfficeCode);
            //die($HeadOffPK);
            if ($empJob->work_station==$HeadOffPK) {
                return false;
            }
            $this->display_children($HeadOffPK);

            
            
            if (!strlen($readValue[0][strtolower($sysConf->cn)][0])) {
                $add_entry = $ldap->ldap_addEntry($ldap_saveUser, $ldap_user);
                $readValue = $ldap->ladp_readEntry($ldap_user);
            }
            if (!strlen($empJob->firstName_si)) {
                $firstNameSI = " ";
            } else {
                $firstNameSI = $empJob->firstName_si;
            }
            if (!strlen($empJob->firstName_ta)) {
                $firstNameTA = " ";
            } else {
                $firstNameTA = $empJob->firstName_ta;
            }
            if (!strlen($empJob->lastName_si)) {
                $lastNameSI = " ";
            } else {
                $lastNameSI = $empJob->lastName_si;
            }
            if (!strlen($empJob->lastName_ta)) {
                $lastNameTA = " ";
            } else {
                $lastNameTA = $empJob->lastName_ta;
            }
            if (!strlen($empContactObj->con_off_email)) {
                $offEmail = $sysConf->dummyEmail;
            } else {
                $offEmail = $empContactObj->con_off_email;
            }
            

            $toUpdate = array($empJob->firstName . "|" . $sysConf->FirstName, $firstNameSI . "|" . $sysConf->FirstNameSI, $firstNameTA . "|" . $sysConf->FirstNameTA, $empJob->lastName . "|" . $sysConf->sn, $lastNameSI . "|" . $sysConf->LastNameSI, $lastNameTA . "|" . $sysConf->LastNameTA, $offEmail . "|" . $sysConf->Email);
            $ldap_saveUser = $readValue[0][strtolower($sysConf->cn)][0];


            if ($readValue[0][strtolower($sysConf->cn)][0] != $empJob->employeeId) {
                $newCn = $empJob->employeeId;
            } else {
                $newCn = "";
            }
            $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn);

            $readValue = $ldap->ladp_readEntry($ldap_user);

            $ldap_saveUser = $readValue[0][strtolower($sysConf->cn)][0];


            if (!strlen($readValue[0][strtolower($sysConf->DesignationCode)][0])) {
                $toUpdate = array($empJob->getJob_title_code() . "|" . $sysConf->DesignationCode);
                $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
            } else if ($readValue[0][strtolower($sysConf->DesignationCode)][0] != $empJob->getJob_title_code()) {
                $toUpdate = array($empJob->getJob_title_code() . "|" . $sysConf->DesignationCode);
                $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
            }

            $LdapAudit->setLdap_adt_designationcode($empJob->getJob_title_code());

            if (in_array($empJob->work_station, $this->headOfficeIds)) {

                if (!strlen($readValue[0][strtolower($sysConf->DepartmentCode)][0])) {
                    $toUpdate = array($empJob->work_station . "|" . $sysConf->DepartmentCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                } else if ($readValue[0][strtolower($sysConf->DepartmentCode)][0] != $DivisionDisplayNumber) {
                    $toUpdate = array($empJob->work_station . "|" . $sysConf->DepartmentCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                }
                $LdapAudit->setLdap_adt_departmentcode($empJob->work_station);
                 if ($empJob->hie_code_2 == "") {
                    $hie_2 = " ";
                } else {
                    $hie_2 = $service->getDivisionDisplayNo($empJob->hie_code_2)->comp_code;
                }

                if (!strlen($readValue[0][strtolower($sysConf->Province)][0])) {
                    $toUpdate = array($hie_2 . "|" . $sysConf->Province);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                } else if ($readValue[0][strtolower($sysConf->Province)][0] != $hie_2) {
                    $toUpdate = array($hie_2 . "|" . $sysConf->Province);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                }
                

                $toUpdate = array(" " . "|" . $sysConf->DivisionCode, " " . "|" . $sysConf->DistrictCode, " " . "|" . $sysConf->WasamCode, " " . "|" . $sysConf->ZoneCode);
                $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                if ($empJob->emp_active_hrm_flg == 1) {
                    $active = "active";
                } else {
                    $active = "inactive";
                }
                $toUpdate = array($active . "|" . $sysConf->EmployeeActiveFlag);
                $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                $LdapAudit->setLdap_adt_employeeactiveflag($empJob->emp_active_hrm_flg);
            } else {
                
                if ($empJob->hie_code_2 == "") {
                    $hie_2 = " ";
                } else {
                    $hie_2 = $service->getDivisionDisplayNo($empJob->hie_code_2)->comp_code;
                }
                if ($empJob->hie_code_4 == "") {
                    $test = " ";
                } else {
                    $test = $service->getDivisionDisplayNo($empJob->hie_code_4)->comp_code;
                }
                if ($empJob->hie_code_3 == "") {
                    $hie_3 = " ";
                } else {
                    $hie_3 = $service->getDivisionDisplayNo($empJob->hie_code_3)->comp_code;
                }
                if ($empJob->hie_code_6 == "") {
                    $hie_6 = " ";
                } else {
                    $hie_6 = $service->getDivisionDisplayNo($empJob->hie_code_6)->comp_code;
                }
                if ($empJob->hie_code_5 == "") {
                    $hie_5 = " ";
                } else {
                    $hie_5 = $service->getDivisionDisplayNo($empJob->hie_code_5)->comp_code;
                }

                if (!strlen($readValue[0][strtolower($sysConf->DivisionCode)][0])) {

                    $toUpdate = array($test . "|" . $sysConf->DivisionCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                } else if ($readValue[0][strtolower($sysConf->DivisionCode)][0] != $test) {
                    $toUpdate = array($test . "|" . $sysConf->DivisionCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                }
                $LdapAudit->setLdap_adt_divisioncode($test);
                if (!strlen($readValue[0][strtolower($sysConf->DistrictCode)][0])) {
                    $toUpdate = array($hie_3 . "|" . $sysConf->DistrictCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                } else if ($readValue[0][strtolower($sysConf->DistrictCode)][0] != $hie_3) {
                    $toUpdate = array($hie_3 . "|" . $sysConf->DistrictCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                }
                $LdapAudit->setLdap_adt_districtcode($hie_3);

                if (!strlen($readValue[0][strtolower($sysConf->WasamCode)][0])) {
                    $toUpdate = array($hie_6 . "|" . $sysConf->WasamCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                } else if ($readValue[0][strtolower($sysConf->WasamCode)][0] != $hie_6) {
                    $toUpdate = array($hie_6 . "|" . $sysConf->WasamCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                }
                $LdapAudit->setLdap_adt_wasamcode($hie_6);
                
                if (!strlen($readValue[0][strtolower($sysConf->ZoneCode)][0])) {
                    $toUpdate = array($hie_5 . "|" . $sysConf->ZoneCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                } else if ($readValue[0][strtolower($sysConf->ZoneCode)][0] != $hie_5) {
                    $toUpdate = array($hie_5 . "|" . $sysConf->ZoneCode);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                }
                $LdapAudit->setLdap_adt_zonecode($hie_5);
                if (!strlen($readValue[0][strtolower($sysConf->Province)][0])) {

                    $toUpdate = array($hie_2 . "|" . $sysConf->Province);

                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                } else if ($readValue[0][strtolower($sysConf->Province)][0] != $hie_2) {
                    $toUpdate = array($hie_2 . "|" . $sysConf->Province);
                    $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                }
                if ($empJob->emp_active_hrm_flg == 1) {
                    $active = "active";
                } else {
                    $active = "inactive";
                }
                $toUpdate = array($active . "|" . $sysConf->EmployeeActiveFlag);
                $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                
                $LdapAudit->setLdap_adt_employeeactiveflag($active);
    
                $toUpdate = array(" " . "|" . $sysConf->DepartmentCode);
                $ldap->ldap_updateEntry($ldap_saveUser, $toUpdate, $newCn = "");
                $LdapAudit->setLdap_adt_departmentcode("");
            }
        //LDAP Audit Start    
        //die(print_r($readValue));
//        $LdapAudit= new LDAPAudit();
        $LdapAudit->setLdap_adt_employeeid($readValue[0]['employeeid'][0]);
        $LdapAudit->setLdap_adt_firstname($readValue[0]['firstname'][0]);
        $LdapAudit->setLdap_adt_firstnamesi($readValue[0]['firstnamesi'][0]);
        $LdapAudit->setLdap_adt_firstnameta($readValue[0]['firstnameta'][0]);
        $LdapAudit->setLdap_adt_lastname($readValue[0]['firstname'][0]);
        $LdapAudit->setLdap_adt_lastnamesi($readValue[0]['lastnamesi'][0]);
        $LdapAudit->setLdap_adt_lastnameta($readValue[0]['lastnameta'][0]);
//        $LdapAudit->setLdap_adt_designationcode($readValue[0]['designationcode'][0]);
//        $LdapAudit->setLdap_adt_districtcode($readValue[0]['districtcode'][0]);
//        $LdapAudit->setLdap_adt_divisioncode($readValue[0]['divisioncode'][0]);
//        $LdapAudit->setLdap_adt_zonecode($readValue[0]['zonecode'][0]);
//        $LdapAudit->setLdap_adt_wasamcode($readValue[0]['wasamcode'][0]);
//        $LdapAudit->setLdap_adt_employeeactiveflag($readValue[0]['employeeactiveflag'][0]);
//        $LdapAudit->setLdap_adt_departmentcode($readValue[0]['departmentcode'][0]);
        $LdapAudit->setLdap_adt_email($readValue[0]['email'][0]);
        $LdapAudit->setLdap_adt_cn($readValue[0]['cn'][0]);
        $LdapAudit->setLdap_adt_sn($readValue[0]['sn'][0]);
        $LdapAudit->setLdap_adt_emp_number($empJob->empNumber);
        $LdapAudit->setLdap_adt_userid($_SESSION['user']);
        $LdapAudit->setLdap_adt_datetime(date("Y-m-d H:i:s"));
        $LdapAudit->save();
        //LDAP Audit End

        }
    }
    /*
     * This return child node of the given parent id
     */

    function display_children($parent='') {
              
        // retrieve all children of $parent
        $query = 'SELECT * FROM hs_hr_compstructtree c LEFT JOIN hs_hr_employee e ON c.emp_number = e.emp_number  WHERE parnt="' . $parent . '";';

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        

        while ($row = $stmt->fetch()) {
        $this->headOfficeIds[]=$row['id'];

            $this->display_children($row['id']);
        }
        //return $headOfficeIds;
    }

    /*
     * Return primary key of the node filtered by display Code
     *
     */
    function getHeadOffPK($comp_code){
      
         $query = 'SELECT * FROM hs_hr_compstructtree c where comp_code="' . $comp_code . '";';

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch()) {

            $id=$row['id'];
            
        }
        return $id;
    }

}
?>
