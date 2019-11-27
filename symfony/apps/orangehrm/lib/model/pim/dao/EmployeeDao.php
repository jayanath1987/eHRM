<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Jayanath Liyanage
 *  On (Date)  - 27 July 2011
 *  Comments   - pim Module Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
require_once '../../lib/common/LocaleUtil.php';

class EmployeeDao extends BaseDao {

    public function getEmployeeContact($empNumber) {
        $empContact = Doctrine :: getTable('EmpContact')->find($empNumber);
        return $empContact;
    }

    public function savePersonalDetails(EmployeeMaster $employee) {
        $employee->save();
        return true;
    }

    public function saveEMBexam(EBExam $ebexam) {
        $ebexam->save();
        return true;
    }

    public function saveServiceRecord(ServiceHistory $serviceRec) {
        $serviceRec->save();
        return true;
    }

    public function deleteEmployeeContacts($empId) {
        $q = Doctrine_Query :: create()->delete('EmpContact')
                ->where('emp_number = ?', $empId);

        $result = $q->execute();
        return true;
    }

    public function addEmployee(Employee $employee) {

        if ($employee->getEmpNumber() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($employee);
            $employee->setEmpNumber($idGenService->getNextID());
        }
        $employee->save();
        return true;
    }

    public function checkValidSupervicer($empNumber, $SupempNumber) {
        $q = Doctrine_Query::create()
                ->select('count(r.erep_sub_emp_number)')
                ->from('ReportTo r')
                ->where('r.erep_sub_emp_number = ?', $SupempNumber)
                ->andWhere('r.erep_sup_emp_number = ?', $empNumber);

        return $q->fetchArray();
    }

    public function checkValidSubordinater($empNumber, $SubempNumber) {
        $q = Doctrine_Query::create()
                ->select('count(r.erep_sup_emp_number)')
                ->from('ReportTo r')
                ->where('r.erep_sup_emp_number = ?', $SubempNumber)
                ->andWhere('r.erep_sub_emp_number = ?', $empNumber);

        return $q->fetchArray();
    }

    public function getSupervisorEmployeeChain($supervisorId) {

        $employeeList = array();

        $q = Doctrine_Query::create()
                ->select("rt.supervisorId,emp.*")
                ->from('ReportTo rt')
                ->leftJoin('rt.subordinate emp')
                ->where("rt.supervisorId=$supervisorId");


        $reportToList = $q->execute();
        foreach ($reportToList as $reportTo) {
            array_push($employeeList, $reportTo->getSubordinate());
            $list = $this->getSupervisorEmployeeChain($reportTo->getSubordinateId());
            if (count($list) > 0)
                foreach ($list as $employee)
                    array_push($employeeList, $employee);
        }

        return $employeeList;
    }

    public function readEmployee($id) {

        return Doctrine::getTable('Employee')->find($id);
    }

    public function readEmployeeMaster($id) {

        return Doctrine::getTable('EmployeeMaster')->find($id);
    }

    public function readEmployeeContacts($id) {

        return Doctrine::getTable('EmpContact')->find($id);
    }

    public function readDisActions($id) {

        return Doctrine::getTable('EmpDisAction')->find($id);
    }

    public function saveContactDetails(EmpContact $empContact) {
        $empContact->save();
        return true;
    }

    public function getEmployeeList($searchMode, $searchValue, $userCulture = "en", $page = 1, $orderField = 'e.emp_number', $orderBy = 'ASC',$Active) {
        
        $user=$this->getUserByID($_SESSION['user']);
        
        switch ($searchMode) {
            case 'id':
                $searchColumn = 'e.employee_id';
                break;
            case 'firstname':
                $searchColumn = "e.emp_firstname";
                break;
            case 'lastname':
                $searchColumn = "e.emp_lastname";
                break;
            case 'designation':
                $searchColumn = "j.jobtit_name";
                break;
            case 'service':
                $searchColumn = "s.service_name";
                break;
            case 'division':
                $searchColumn = "d.title";
                break;
        }

        if ($searchMode != 'id' && $searchMode != 'all') {
            $searchColumn = ($userCulture == "en") ? $searchColumn : $searchColumn . '_' . $userCulture;
        }

        if ($orderField != 'e.emp_number') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue = trim($searchValue);
        $q = Doctrine_Query::create()
//                ->select('e.*,j.*,s.*,d.*')
//                ->from('Employee e')
//                ->leftJoin('e.jobTitle j')
//                ->leftJoin('e.ServiceDetails s')
//                ->leftJoin('e.subDivision d');
                ->select('e.employeeId')
                ->from('Employee e');
                if($user->def_level!= 1){
                    $q->where('e.empNumber = ?',$user->emp_number);
                } 
                if($Active == '0'){
                    $q->Andwhere('e.emp_active_hrm_flg = 0');
                }
        
                //->leftJoin('e.subDivision d');
        if ($searchMode != 'all' && $searchValue != '') {
            //$q->where($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        $q->orderBy($orderField . ' ' . $orderBy);

        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? 100 : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&amp;mode=search&amp;txtSearchValue={$searchValue}&amp;cmbSearchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $result = array();
        $result['data'] = $pager->execute();
        $result['pglay'] = $pagerLayout;

        return $result;
    }

    public function searchEmployee($searchMode, $searchValue, $userCulture = "en", $page = 1, $orderField = 'e.emp_number', $orderBy = 'ASC', $type = 'single', $method = '', $reason = '', $att = '', $payroll = '', $payrolltype , $locationWise = '', $startDate = '', $endDate = '',$empdef='') {

        $encryption = new EncryptionHandler();
        if($payrolltype!=null){
        $decryptprType = $encryption->decrypt($payrolltype);
        }
        switch ($searchMode) {
            case 'id':
                $searchColumn = 'e.employee_id';
                break;
            case 'firstname':
                $searchColumn = "e.emp_firstname";
                break;
            case 'lastname':
                $searchColumn = "e.emp_lastname";
                break;
            case 'designation':
                $searchColumn = "j.jobtit_name";
                break;
            case 'service':
                $searchColumn = "s.service_name";
                break;
            case 'division':
                $searchColumn = "d.title";
                break;
        }

        if ($searchMode != 'id' && $searchMode != 'all') {
            $searchColumn = ($userCulture == "en") ? $searchColumn : $searchColumn . '_' . $userCulture;
        }

        if ($orderField != 'e.emp_number') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue = trim($searchValue);
        $q = Doctrine_Query::create()
                ->select('e.*,j.*,s.*,d.*,u.*,p.*')
                ->from('EmployeeMaster e')
                ->leftJoin('e.jobTitle j')
                ->leftJoin('e.ServiceDetails s')
                ->leftJoin('e.subDivision d')
                ->where('e.emp_active_hrm_flg = 1');
        
///        if ($reason != 'companyHead') {
            if ($reason == 'security') {
                $q->leftJoin('e.Users u');

                $q->where('u.emp_number!=');
            } elseif ($reason == 'atte') {
                //$q->where('e.emp_active_hrm_flg = 1')
                 //       ->AndWhere('e.emp_active_att_flg = 1');
            } else if ($payroll == 'payroll') {

                $q->leftJoin('e.PayrollEmployee p')
                        ->AndWhere('e.emp_ispaydownload = 1');
//                                   if($locationWise=="1"){
                $subQuery = Doctrine_Query::create()
                        ->select('z.*')
                        ->from('payprocessCapability z')
                        ->where('z.prl_process_type=0');
                        if ($decryptprType) {
                    $subQuery->AndWhere('z.prl_type_code = ?', $decryptprType);
                    }

                $subArr = $subQuery->fetchArray();
                $subArr2 = array();
                foreach ($subArr as $key => $val) {
                    $subArr2[] = $val['prl_disc_code'];
                }
                $comma_separated = implode(",", $subArr2);
//                                       die(print_r($comma_separated));
                if ($comma_separated) {
                    $q->AndWhere("e.work_station not in({$comma_separated})");
                }
//                                       $q->orWhere("e.emp_number=?",array($_SESSION['empNumber']));
//                                   }
                
                //--JBL        

        if (strlen($startDate)) { 
            $q->AndWhere("e.emp_app_date <= '$startDate'")
            ->AndWhere("e.emp_resign_date > '$startDate'")
            ->OrWhere("e.emp_resign_date IS NULL")   
      
            ->AndWhere("e.emp_retirement_date > '$startDate'");
        }
        if (strlen($decryptprType)) {

            $q->AndWhere('p.prl_type_code = ?', $decryptprType);
        }

//--JBL
                
                
            }
///        }
//        if ($payroll == 'payroll') {
//            $q->AndWhere('e.emp_ispaydownload = 1');
//        }
//        if (strlen($payrolltype)) {
//            $q->AndWhere('p.prl_type_code =?', array($decryptprType));
//            if (strlen($startDate)) {
//                $q->AndWhere("e.emp_app_date <= '$startDate'");
//            }
//            if (strlen($endDate)) {
//                $q->AndWhere("e.emp_resign_date >= '$endDate'");
//                $q->OrWhere("e.emp_retirement_date >= '$endDate'");
//            }
//        }

       if ($empdef != '') { 
            if($empdef=="3"){
                $q->AndWhere("d.def_level = 3");
            }elseif($empdef=="4") {
                $q->AndWhere("d.def_level = 4");
            }
        }



        if ($searchMode != 'all' && $searchValue != '') {
            $q->Andwhere($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        $q->orderBy($orderField . ' ' . $orderBy);

        $resultsPerPage = sfConfig::get('app_items_per_page') ? sfConfig::get('app_items_per_page') : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&mode=search&txtSearchValue={$searchValue}&cmbSearchMode={$searchMode}&sort={$orderField}&order={$orderBy}&type={$type}&method={$method}&reason={$reason}&payroll={$payroll}&empdef={$empdef}"
        );

        $pager = $pagerLayout->getPager();
        $result = array();
        $result['data'] = $pager->execute();
        $result['pglay'] = $pagerLayout;

        return $result;
    }

    public function getPersonalDetailsById($empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Employee')
                ->where("empNumber=$empNumber");

        return $q->fetchArray();
    }

    public function read($empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Employee')
                ->where("empNumber= " . $empNumber);

        return $q->execute();
    }

    public function getJobSalDetailsById($empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Employee')
                ->where("empNumber=$empNumber");

        return $q->fetchArray();
    }

    public function getworkStationName($empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Employee')
                ->where("empNumber=$empNumber");

        return $q->execute();
    }

    public function getReportDetailsbyEmpId($Sup_empNumber, $Sub_empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('ReportTo')
                ->where("supervisorId=$Sup_empNumber")
                ->andWhere("subordinateId=$Sub_empNumber");

        return $q->fetchArray();
    }

    public function getPhotoDetails($empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('EmpPicture')
                ->where("emp_number=$empNumber");
        return $q->fetchArray();
    }

    public function getContactDetailsById($empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('EmpContact')
                ->where("emp_number=$empNumber");

        return $q->fetchArray();
    }

    public function getEmergencyContactById($empNumber, $seqNo) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('EmpEmergencyContact')
                ->where("emp_number=$empNumber and seqno=$seqNo");

        return $q->fetchArray();
    }

    public function saveEmergencyContact($emgContact) {
        $emgContact->save();
        return true;
    }

    public function deleteEmergencyContacts($empNumber, $entriesToDelete) {


        $q = Doctrine_Query :: create()->delete('EmpEmergencyContact ec')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('seqno = ?', $entriesToDelete);

        $result = $q->execute();
        return $result;
    }

    public function getDependentContactById($empNumber, $seqNo) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('EmpDependent')
                ->where("emp_number=$empNumber and seqno=$seqNo");

        return $q->fetchArray();
    }

    public function saveDependentContact(EmpDependent $dependentContact) {
        $dependentContact->save();
        return true;
    }

    public function deleteDependentContacts($empNumber, $entriesToDelete) {


        $q = Doctrine_Query :: create()->delete('EmpDependent ec')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('seqno = ?', $entriesToDelete);

        $result = $q->execute();
        return $result;
    }

    public function getEmpLanguageById($empNumber, $langCode, $langType) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('EmployeeLanguage')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('lang_code = ?', $langCode)
                ->andwhere('emplang_type = ?', $langType);

        return $q->fetchArray();
    }

    public function getEmpLanguageType($empNumber, $Language, $Type) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('EmployeeLanguage')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('lang_code = ?', $Language)
                ->andwhere('emplang_type = ?', $Type);

        return $q->fetchOne();
    }

    public function getEmpLanguage($empNumber) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('EmployeeLanguage')
                ->where('emp_number = ?', $empNumber);

        return $q->fetchArray();
    }

    public function getLanguages() {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Language');

        return $q->execute();
    }

    public function saveEmpLanguage($empLanguage) {
        $empLanguage->save();
        return true;
    }

    public function deleteEmpLanguages($empNumber, $langCode, $langType) {
        $q = Doctrine_Query :: create()->delete('EmployeeLanguage')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('lang_code = ?', $langCode)
                ->andwhere('emplang_type = ?', $langType);
        $result = $q->execute();
        return $result;
    }

    public function getWorkExperienceById($empNumber, $seqNo) {
        $q = Doctrine_Query::create()
                ->select('w.*')
                ->from('EmpWorkExperience w')
                ->where("emp_number=$empNumber and eexp_seqno=$seqNo");

        return $q->fetchArray();
    }

    public function saveWorkExperience($workExp) {
        $workExp->save();
        return true;
    }

    public function deleteWorkExperience($empNumber, $seqNo) {
        $q = Doctrine_Query :: create()->delete('EmpWorkExperience')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('eexp_seqno = ?', $seqNo);

        $result = $q->execute();
        return $result;
    }

    public function getSkillById($empNumber, $skillCode) {

        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('EmployeeSkill s')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('skill_code = ?', $skillCode);

        return $q->fetchArray();
    }

    public function saveSkill($empSkill) {
        $empSkill->save();
        return true;
    }

    public function deleteSkill($empNumber, $skillCode) {

        $q = Doctrine_Query :: create()->delete('EmployeeSkill')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('skill_code = ?', $skillCode);

        $result = $q->execute();
        return $result;
    }

    public function getEducationById($empNumber, $eduCode) {

        $q = Doctrine_Query::create()
                ->select('d.*')
                ->from('EmployeeEducation d')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('edu_code = ?', $eduCode);

        return $q->fetchArray();
    }

    public function getServiceRecordByID($empNumber, $SerRecNo) {

        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('ServiceHistory s')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('esh_code = ?', $SerRecNo);

        return $q->fetchArray();
    }

    public function saveEducation($empEducation) {
        $empEducation->save();
        return true;
    }

    public function deleteEducation($empNumber, $eduCode) {
        $q = Doctrine_Query :: create()->delete('EmployeeEducation')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('edu_code = ?', $eduCode);

        $result = $q->execute();
        return $result;
    }

    public function getLicenseById($empNumber, $seqNo) {
        $q = Doctrine_Query::create()
                ->select('l.*')
                ->from('EmployeeLicense l')
                ->where("emp_number=$empNumber and lic_seqno=$seqNo");

        return $q->fetchArray();
    }

    public function saveLicense($empLicense) {
        $empLicense->save();
        return true;
    }

    public function deleteLicense($empNumber, $seqNo) {
        $q = Doctrine_Query :: create()->delete('EmployeeLicense')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('lic_seqno = ?', $seqNo);

        $result = $q->execute();
        return $result;
    }

    public function getCurrentByID($Userid) {

        $q = Doctrine_Query::create()
                ->select('u.*')
                ->from('Users u')
                ->where("u.id=?", $Userid);

        return $q->fetchArray();
    }

    public function getCurrentUserEmp($Userid) {

        $q = Doctrine_Query::create()
                ->select('u.*')
                ->from('Users u')
                ->where("u.emp_number=?", $Userid);

        return $q->fetchOne();
    }
    
    public function getUserByID($userId) {

        return Doctrine::getTable('Users')->find($userId);
    }

    public function searchEmpDisActions($searchMode = "", $searchValue = "", $culture = "", $page = 1, $orderField = 'd.dis_inc_id', $orderBy = 'DESC') {
        switch ($searchMode) {




            case "emp":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName = "e.emp_display_name_" . $culture;
                break;
            case "eftfrom":
                $feildName = "i.emp_dis_effectfrom";
                break;
            case "eftto":
                $feildName = "i.emp_dis_effectto";
                break;
            case "action":
                $feildName = "i.emp_dis_action";
                break;
        }

        $q = Doctrine_Query::create()
                ->select('i.*')
                ->from('EmpDisAction i')
                ->leftjoin('i.Employee e');


        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&amp;mode=search&amp;searchValue={$searchValue}&amp;searchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function deleteEmpDisAction($disId) {
        $q = Doctrine_Query :: create()->delete('EmpDisAction')
                ->where('emp_dis_id = ?', $disId);


        $result = $q->execute();
        return $result;
    }

    public function deleteEmployee($id) {

        $q = Doctrine_Query::create()
                ->delete('Employee')
                ->where('empNumber=' . $id);

        $numDeleted = $q->execute();

        if ($numDeleted > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmpMaxId() {
        $q = Doctrine_Query::create()
                ->select('Max(empNumber)')
                ->from('EmployeeMaster e');


        return $q->fetchArray();
    }
    
   public function readEmployeeLevelExist($id) {

        return Doctrine::getTable('EmployeeDefLevel')->find($id);
    }    
    
    public function searchEmpEducation($searchMode = "", $searchValue = "", $culture = "", $page = 1, $orderField = 'i.eduh_id', $orderBy = 'DESC', $EMPID) {
        

        $q = Doctrine_Query::create()
                ->select('i.*')
                ->from('EducationEMPHead i')
                ->where('i.emp_number = ?',$EMPID);



        if ($searchValue != "") {
            $q->Andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&amp;mode=search&amp;searchValue={$searchValue}&amp;searchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }
    
    public function readEmpEducation($id) {

        return Doctrine::getTable('EducationEMPHead')->find($id);
    }
    
    public function readEducationTypeList() {

                $q = Doctrine_Query::create()
                ->select('i.*')
                ->from('EducationType i');
                
                return $q->execute();
    }
    
    public function getSubjectsID($id) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EducationSubject g')
                ->where('g.edu_type_id = ?', $id);
        return $q->execute();
    }
    
    public function getGradeYear($EduT,$Year) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EducationYearGrade g')
                ->where('g.edu_type_id = ?', $EduT)
                ->Andwhere('g.grd_year = ?', $Year);
        return $q->execute();
    }
    
        public function getGradeYearNull($EduT,$Year) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EducationYearGrade g')
                ->where('g.edu_type_id = ?', $EduT)
                ->Andwhere('g.grd_year IS NULL');
        return $q->execute();
    }
    
    public function readEmpEducationDetail($id) {

                $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EducationEMPDetail g')
                ->where('g.eduh_id = ?', $id);
        return $q->fetchArray();
    }
    
    public function deleteEmpEducationDetail($id) {
        $q = Doctrine_Query::create()
                ->delete('EducationEMPDetail')
                ->where('eduh_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function getLastEmpEducationHeadID() {
        $query = Doctrine_Query::create()
                ->select('MAX(r.eduh_id)')
                ->from('EducationEMPHead r');

        return $query->fetchArray();
    }
    
    public function deleteEmpEducationHead($disId) {
        $q = Doctrine_Query :: create()->delete('EducationEMPHead')
                ->where('eduh_id = ?', $disId);


        $result = $q->execute();
        return $result;
    }
    
    
        public function searchEmp_EB_Exam($searchMode = "", $searchValue = "", $culture = "", $page = 1, $orderField = 'i.ebe_id', $orderBy = 'DESC', $EMPID) {
        

        $q = Doctrine_Query::create()
                ->select('i.*')
                ->from('EBEmployee i')
                ->where('i.emp_number = ?',$EMPID);



        if ($searchValue != "") {
            $q->Andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&amp;mode=search&amp;searchValue={$searchValue}&amp;searchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }
    
     public function GradeList() {

                $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('Grade g');
                
                return $q->execute();
    }
    
    public function EBExamList() {

                $q = Doctrine_Query::create()
                ->select('eh.*')
                ->from('EBMasterHead eh');
                
                return $q->execute();
    }
    
//    public function readEB_Employee_ByID($id) {
//
//        return Doctrine::getTable('EBEmployee')->find($id);
//    }
    
    public function readEBExamsSubjectsbyID($EBID) {

                $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EBMasterDetail g')
                //->where('g.grade_code = ?', $EduT)        
                ->where('g.ebh_id = ?', $EBID);
                
        return $q->execute();
    }
    
    public function readEmp_EB_Exam_Detail($id, $empid, $Atmpt) {

                $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EBEmployee g')
                ->where('g.ebh_id = ?', $id)
                ->Andwhere('g.ebe_attepmt = ?', $Atmpt)        
                ->Andwhere('g.emp_number = ?', $empid);
        //return $q->fetchArray();
        return $q->execute();
    }
    
    public function deleteEmp_EB_Exam($empId,$EBhead,$Atmpt) {
        $q = Doctrine_Query :: create()->delete('EBEmployee e')
                ->where('e.emp_number = ?', $empId)
                ->andwhere('e.ebe_attepmt = ?', $Atmpt)
                ->andwhere('e.ebh_id = ?', $EBhead);


        $result = $q->execute();
        return $result;
    }
    
    public function ReadSubjectID($EBhead,$subId){ 
        $q = Doctrine_Query :: create()
        ->select('e.*')
         ->from('EBMasterDetail e')
        ->where('e.ebs_id = ?', $subId)
        ->andwhere('e.ebh_id = ?', $EBhead);


        return  $q->execute();
    }
    
    public function readEB_Employee_ByID($id,$Atmpt) {

        $q = Doctrine_Query :: create()
        ->select('e.*')
         ->from('EBEmployee e')
        ->where('e.ebh_id = ?', $id)
        ->Andwhere('e.ebe_attepmt = ?', $Atmpt);
        
        return $q->fetchOne();
    }
    
    public function readEmpEBExamsSubjectsbyID($SUBID,$EBID,$empNumber,$Atmpt) {

                $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EBEmployee g')
                ->where('g.ebd_id = ?', $SUBID)
                ->Andwhere('g.ebh_id = ?', $EBID)
                ->Andwhere('g.ebe_attepmt = ?', $Atmpt)         
                ->Andwhere('g.emp_number = ?', $empNumber);
                
        return $q->fetchOne();
    }
    
    public function deleteEmpEBEducationBYID($id) {
        $q = Doctrine_Query::create()
                ->delete('EBEmployee')
                ->where('ebe_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
   public function getEmployee($insList = array()) {

        try {
            if (is_array($insList)) {
                $query= Doctrine_Query::create()
                        ->select('e.*,r.*')
                        ->from('Employee e')
                        ->LeftJoin('e.ReportTo r e.emp_number=r.subordinateId') 
                        ->whereIn('e.emp_number', $insList);

                return $query->fetchArray();
            }
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function deleteSignature($empId) {
        $q = Doctrine_Query :: create()->delete('EmployeeSignature')
                ->where('emp_number = ?', $empId);

        $result = $q->execute();
        return true;
    }
}