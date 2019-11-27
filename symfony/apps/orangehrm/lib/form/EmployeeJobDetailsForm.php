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
require_once ROOT_PATH . '/lib/common/LocaleUtil.php';

/**
 * Form class for employee contact detail
 */
class EmployeeJobDetailsForm extends sfForm {

    public function configure() {

//        // Note: Widget names were kept from old non-symfony version
//        $this->setWidgets(array(
//            'txtEmpID' => new sfWidgetFormInput(),
//
//            // TODO: Use sfWidgetFormChoice() instead
//            'cmbJobTitle' => new sfWidgetFormSelect(array('choices'=>array())),
//
//            'cmbType' => new sfWidgetFormSelect(array('choices'=>array())), // employement status
//            'cmbEEOCat' => new sfWidgetFormSelect(array('choices'=>array())),
//            'cmbLocation' => new sfWidgetFormInput(), // sub division id
//			'txtLocation' => new sfWidgetFormInput(), // sub division name (not used)
//            'txtJoinedDate' => new sfWidgetFormInput(),
//            'txtTermDate' => new sfWidgetFormInput(), // only use if terminated
//            'txtTermReason' => new sfWidgetFormInput(), // only use if terminated
//            'cmbNewLocationId' => new sfWidgetFormInput(), // new location - disregard
//        ));

        $this->setWidgets(array(
            'txtEmpID' => new sfWidgetFormInputHidden(),
            'txtAPS' => new sfWidgetFormInput(),
            'txtAssumeDate' => new sfWidgetFormInput(),
            'txtAppDateCs' => new sfWidgetFormInput(),
            'txtAssumedutyDate' => new sfWidgetFormInput(),
            'cmbrecMethod' => new sfWidgetFormInput(),
            'txtreqResonEn' => new sfWidgetFormTextarea(),
            'txtreqSinhala' => new sfWidgetFormTextarea(),
            'cmbMedium' => new sfWidgetFormInput(),
            'cmbEmptype' => new sfWidgetFormInput(),
            'txtDivisionid' => new sfWidgetFormInputHidden(),
            'optworkstation' => new sfWidgetFormInput(),
//            'txtActDivisionid' => new sfWidgetFormInputHidden(),
            'chkHractive' => new sfWidgetFormInput(),
            'chkPractive' => new sfWidgetFormInput(),
            'chkAttactive' => new sfWidgetFormInput(),
            'chkactivews' => new sfWidgetFormInput(),
            'optWOP' => new sfWidgetFormInput(),
            'txtWopnum' => new sfWidgetFormInput(),
            'optConfirm' => new sfWidgetFormInput(),
            'txtConfirmdate' => new sfWidgetFormInput(),
            'txtSuspenddate' => new sfWidgetFormInput(),
            'optExtend' => new sfWidgetFormInput(),
            'txtReasonsuspend' => new sfWidgetFormInput(),
            'txtPrbextFromdate' => new sfWidgetFormInput(),
            'txtPrbextTodate' => new sfWidgetFormInput(),
            'cmbService' => new sfWidgetFormInput(),
            'cmbDesignstion' => new sfWidgetFormInput(),
//            'cmbActDesignstion' => new sfWidgetFormInput(),
            'cmbClass' => new sfWidgetFormInput(),
            'cmbGrade' => new sfWidgetFormInput(),
            'cmbGradeSlot' => new sfWidgetFormInput(),
            'cmbLevel' => new sfWidgetFormInput(),
            'txtsalScale' => new sfWidgetFormInput(),
            'txtBasicsal' => new sfWidgetFormInput(),
            'txtIncrment' => new sfWidgetFormInput(),
            'txtResDate' => new sfWidgetFormInput(),
            'txtRetDate' => new sfWidgetFormInput(),
            'txtDivision' => new sfWidgetFormInput(),
            'txtreqTamil' => new sfWidgetFormTextarea(),
            'txtAttendNo' => new sfWidgetFormTextarea(),
            'txtDOB' => new sfWidgetFormTextarea(),
            'Actworkstaions'=>new sfWidgetFormInputHidden(),
        ));

        $this->setValidators(array(
            'txtEmpID' => new sfValidatorString(array('required' => flase)),
            'txtAPS' => new sfValidatorString(array('required' => false)),
            'txtAssumeDate' => new sfValidatorString(array('required' => false)),
            'txtAppDateCs' => new sfValidatorString(array('required' => false)),
            'txtAssumedutyDate' => new sfValidatorString(array('required' => false)),
            'cmbrecMethod' => new sfValidatorString(array('required' => false)),
            'txtreqResonEn' => new sfValidatorString(array('required' => false)),
            'txtreqSinhala' => new sfValidatorString(array('required' => false)),
            'txtreqTamil' => new sfValidatorString(array('required' => false)),
            'cmbMedium' => new sfValidatorString(array('required' => false)),
            'cmbEmptype' => new sfValidatorString(array('required' => false)),
            'txtDivisionid' => new sfValidatorString(array('required' => false)),
            'optworkstation' => new sfValidatorString(array('required' => false)),
//            'txtActDivisionid' => new sfValidatorString(array('required' => false)),
            'chkHractive' => new sfValidatorString(array('required' => false)),
            'chkPractive' => new sfValidatorString(array('required' => false)),
            'chkAttactive' => new sfValidatorString(array('required' => false)),
            'chkactivews' => new sfValidatorString(array('required' => false)),
            'optWOP' => new sfValidatorString(array('required' => false)),
            'txtWopnum' => new sfValidatorString(array('required' => false)),
            'optConfirm' => new sfValidatorString(array('required' => false)),
            'txtConfirmdate' => new sfValidatorString(array('required' => false)),
            'txtSuspenddate' => new sfValidatorString(array('required' => false)),
            'optExtend' => new sfValidatorString(array('required' => false)),
            'txtReasonsuspend' => new sfValidatorString(array('required' => false)),
            'txtPrbextFromdate' => new sfValidatorString(array('required' => false)),
            'txtPrbextTodate' => new sfValidatorString(array('required' => false)),
            'cmbService' => new sfValidatorString(array('required' => false)),
            'cmbDesignstion' => new sfValidatorString(array('required' => false)),
//            'cmbActDesignstion' => new sfValidatorString(array('required' => false)),
            'cmbClass' => new sfValidatorString(array('required' => false)),
            'cmbGrade' => new sfValidatorString(array('required' => false)),
            'cmbGradeSlot' => new sfValidatorString(array('required' => false)),
            'cmbLevel' => new sfValidatorString(array('required' => false)),
            'txtsalScale' => new sfValidatorString(array('required' => false)),
            'txtBasicsal' => new sfValidatorString(array('required' => false)),
            'txtIncrment' => new sfValidatorString(array('required' => false)),
            'txtResDate' => new sfValidatorString(array('required' => false)),
            'txtRetDate' => new sfValidatorString(array('required' => false)),
            'txtDivision' => new sfValidatorString(array('required' => false)),
//            'txtActDivision' => new sfValidatorString(array('required' => false)),
            'txtAttendNo' => new sfValidatorString(array('required' => false)),
            'txtDOB' => new sfValidatorString(array('required' => false)),
            'Actworkstaions'=>new sfValidatorString(array('required' => false)),
                ////////////////////////////////////////////////////////////////
        ));
    }

    /**
     * Get Employee object with values filled using form values
     */
    public function getEmployee() {


        $sysConf=new sysConf();
        $employeDao1 = new EmployeeDao();
        $employeDao = $employeDao1->readEmployeeMaster($this->getValue('txtEmpID')); 
        if($this->getValue('txtAPS')!= null){
        $employeDao->setEmp_public_app_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtAPS')));
        }else{
        $employeDao->setEmp_public_app_date(null);
        }
        if($this->getValue('txtAssumeDate')!= null){
        $employeDao->setEmp_public_com_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtAssumeDate')));
        }else{
           $employeDao->setEmp_public_com_date(null);
        }
        if($this->getValue('txtAppDateCs')!= null){
        $employeDao->setEmp_app_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtAppDateCs')));
        }else{
            $employeDao->setEmp_app_date(null);
        }
        if($this->getValue('txtAssumedutyDate')!= null){
        $employeDao->setEmp_com_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtAssumedutyDate')));
        }else{
            $employeDao->setEmp_com_date(null);
        }
        if (strlen($this->getValue('cmbrecMethod'))) {
            $employeDao->setEmp_rec_method($this->getValue('cmbrecMethod'));
        } else {
            $employeDao->setEmp_rec_method(null);
        }
        if (strlen($this->getValue('txtreqResonEn'))) {
            $employeDao->setEmp_rec_method_desc($this->getValue('txtreqResonEn'));
        } else {
            $employeDao->setEmp_rec_method_desc(null);
        }if (strlen($this->getValue('txtreqSinhala'))) {
            $employeDao->setEmp_rec_method_desc_si($this->getValue('txtreqSinhala'));
        } else {
            $employeDao->setEmp_rec_method_desc_si(null);
        }
        if (strlen($this->getValue('txtreqTamil'))) {
            $employeDao->setEmp_rec_method_desc_ta($this->getValue('txtreqTamil'));
        } else {
            $employeDao->setEmp_rec_method_desc_ta(null);
        }
        if (strlen($this->getValue('cmbMedium'))) {
            $employeDao->setEmp_rec_medium($this->getValue('cmbMedium'));
        } else {
            $employeDao->setEmp_rec_medium(null);
        }
        if (strlen($this->getValue('cmbEmptype'))) {
            $employeDao->setEmp_status($this->getValue('cmbEmptype'));
        } else {
            $employeDao->setEmp_status(null);
        }
        if (strlen($this->getValue('txtDivisionid'))) {
            $employeDao->setWork_station($this->getValue('txtDivisionid'));
        } else {
            $employeDao->setWork_station(null);
        }
        
//        if (strlen($this->getValue('txtActDivisionid'))) {
//            $employeDao->setAct_work_station($this->getValue('txtActDivisionid'));
//        } else {
//            $employeDao->setAct_work_station(null);
//        }

        $hrActive = $this->getValue('chkHractive');


        if ($hrActive == 1) {
            $employeDao->setEmp_active_hrm_flg('1');
        } else {
            $employeDao->setEmp_active_hrm_flg('0');
        }
       $prActive = $this->getValue('chkPractive');

        if ($prActive == '1') {
            $employeDao->setEmp_active_pr_flg('1');
        } else {
            $employeDao->setEmp_active_pr_flg('0');
        }
        $attendeFlag = $this->getValue('chkAttactive');
        if ($attendeFlag == 1) {
            $employeDao->setEmp_active_att_flg('1');
        } else {
            $employeDao->setEmp_active_att_flg('0');
        }

       // $employeDao->setEmp_wop_flg($this->getValue('optWOP'));
        if (strlen($this->getValue('txtWopnum'))) {
            $employeDao->setEmp_wop_no($this->getValue('txtWopnum'));
        } else {
            $employeDao->setEmp_wop_no($this->getValue('txtWopnum'));
        }
        $employeDao->setEmp_confirm_flg($this->getValue('optConfirm'));
        if (strlen($this->getValue('txtConfirmdate'))) {
            $employeDao->setEmp_confirm_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtConfirmdate')));
        } else {
            $employeDao->setEmp_confirm_date(null);
        }
        if (strlen($this->getValue('txtSuspenddate'))) {
            $employeDao->setTerminated_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtSuspenddate')));
        } else {
            $employeDao->setTerminated_date(null);
        }
        if (strlen($this->getValue('txtReasonsuspend'))) {
            $employeDao->setTermination_reason($this->getValue('txtReasonsuspend'));
        } else {
            $employeDao->setTermination_reason(null);
        }

        $employeDao->setEmp_prob_ext_flg($this->getValue('optExtend'));
        if (strlen($this->getValue('txtPrbextFromdate'))) {
            $employeDao->setEmp_prob_from_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtPrbextFromdate')));
        } else {
            $employeDao->setEmp_prob_from_date(null);
        }
        if (strlen($this->getValue('txtPrbextTodate'))) {
            $employeDao->setEmp_prob_to_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtPrbextTodate')));
        } else {
            $employeDao->setEmp_prob_to_date(null);
        }
        if (strlen($this->getValue('cmbService'))) {
            $employeDao->setService_code($this->getValue('cmbService'));
        } else {
            $employeDao->setService_code(null);
        }
        $employeDao->setJob_title_code($this->getValue('cmbDesignstion'));
//        if (strlen($this->getValue('cmbActDesignstion'))) {
//        $employeDao->setAct_job_title_code($this->getValue('cmbActDesignstion'));
//        }else{
//        $employeDao->setAct_job_title_code(null);
//        }

        if (strlen($this->getValue('cmbClass'))) {
            $employeDao->setClass_code($this->getValue('cmbClass'));
        } else {
            $employeDao->setClass_code(null);
        }
        
if (strlen($this->getValue('cmbGrade'))) {
            $employeDao->setGrade_code($this->getValue('cmbGrade'));
        } else {
            $employeDao->setGrade_code(null);
        }

        if (strlen($this->getValue('cmbGradeSlot'))) {
            $employeDao->setSlt_scale_year($this->getValue('cmbGradeSlot'));
        } else {
            $employeDao->setSlt_scale_year(null);
        }

        if (strlen($this->getValue('cmbLevel'))) {
            $employeDao->setLevel_code($this->getValue('cmbLevel'));
        } else {
            $employeDao->setLevel_code(null);
        }
        

       

        if (strlen($this->getValue('txtsalScale'))) {
            $employeDao->setEmp_salary_scale($this->getValue('txtsalScale'));
        } else {
            $employeDao->setEmp_salary_scale(null);
        }
        if (strlen($this->getValue('txtBasicsal'))) {
            $employeDao->setEmp_basic_salary($this->getValue('txtBasicsal'));
        } else {
            $employeDao->setEmp_basic_salary(null);
        }
        if (strlen($this->getValue('txtIncrment'))) {
            $employeDao->setEmp_salary_inc_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtIncrment')));
        } else {
            $employeDao->setEmp_salary_inc_date(null);
        }
        if (strlen($this->getValue('txtResDate'))) {
            $employeDao->setEmp_resign_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtResDate')));
        } else {
            $employeDao->setEmp_resign_date(null);
        }
        if (strlen($this->getValue('txtRetDate'))) {
            $employeDao->setEmp_retirement_date(LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtRetDate')));
        } else {
            $employeDao->setEmp_retirement_date(null);
        }
        if (strlen($this->getValue('txtAttendNo'))) {
            $employeDao->setEmp_attendance_no($this->getValue('txtAttendNo'));
        } else {
            $employeDao->setEmp_attendance_no(null);
        }
        if($sysConf->isuseLdap=="Yes"){
            $employeDao->setEmp_ldap_flag(1);
        }else{
            $employeDao->setEmp_ldap_flag(0);
        }

        $companyService = new CompanyService();

        $hieCode = $this->getValue('txtDivisionid');

        $division = $companyService->readCompanyStructure($hieCode);
        $defLevel = $division->getDefLevel();
        $userDefLevel=$companyService->getUserDefLevel($this->getValue('txtEmpID'));
        

         if ($defLevel <= 3 && $userDefLevel->def_level==3) {
            return false;
         }

       

        for($i=1;$i<=10;$i++){
            $col="hie_code_".$i;
            $Actcol="act_hie_code_".$i;
            $employeDao->$col=null;
            $employeDao->$Actcol=null;
        }

        while ($defLevel > 0 && $hieCode > 0) {
            $hieCodeCol = "hie_code_" . $defLevel;
            $employeDao->$hieCodeCol = $hieCode;

            $hieCode = $division->getParnt();
            $division = $companyService->readCompanyStructure($hieCode);

            $defLevel = $defLevel -1;
        }

//        if($this->getValue('txtActDivisionid') != null){
//        $ActhieCode = $this->getValue('txtActDivisionid');
//
//        $Actdivision = $companyService->readCompanyStructure($ActhieCode);
//        $ActdefLevel = $Actdivision->getDefLevel();
//        while ($ActdefLevel > 0 && $ActhieCode > 0) {
//        $ActhieCodeCol = "act_hie_code_" . $ActdefLevel;
//        $employeDao->$ActhieCodeCol = $ActhieCode;
//
//        $ActhieCode = $Actdivision->getParnt();
//        $Actdivision = $companyService->readCompanyStructure($ActhieCode);
//
//        $ActdefLevel = $ActdefLevel -1;
//        }
//        }
        
        
        
        
        return $employeDao;
    }

}

