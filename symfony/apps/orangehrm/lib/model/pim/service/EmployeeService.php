<?php

/*
 *
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 *
 */
require_once ROOT_PATH . '/lib/common/LocaleUtil.php';

class EmployeeService extends BaseService {

    private $employeeDao;

    public function __construct() {
        $this->employeeDao = new EmployeeDao();
    }

    public function getEmployeeDao() {
        return $this->employeeDao;
    }

    public function setEmployeeDao(EmployeeDao $employeeDao) {
        $this->employeeDao = $employeeDao;
    }

    public function getReportDetailsbyEmpId($Sup_empNumber, $Sub_empNumber) {


        $reportTodetails = $this->employeeDao->getReportDetailsbyEmpId($Sup_empNumber, $Sub_empNumber);

        return $reportTodetails;
    }

    public function getPhotoDetails($empNumber) {


        $reportTodetails = $this->employeeDao->getPhotoDetails($empNumber);

        return $reportTodetails;
    }

    public function IsAttExist($attendNo, $empNum, $mode) {

        $q = Doctrine_Query::create()
                ->select('count(a.emp_number)')
                ->from('EmployeeMaster a')
                ->where('a.emp_attendance_no = ?', $attendNo);
        if ($mode != "add") {
            $q->andWhere('a.emp_number !=?', array($empNum));
        }


        return $q->fetchArray();
    }

    public function IsSalExist($salNo, $empNum, $mode) {

        $q = Doctrine_Query::create()
                ->select('count(a.emp_number)')
                ->from('EmployeeMaster a')
                ->where('a.emp_salary_no =?', array($salNo));
        if ($mode != "add") {
            $q->andWhere('a.emp_number !=?', array($empNum));
        }

        return $q->fetchArray();
    }

    public function IsPensionExist($penNo, $empNum, $mode) {

        $q = Doctrine_Query::create()
                ->select('count(a.emp_number)')
                ->from('EmployeeMaster a')
                ->where('a.emp_pension_no =?', array($penNo));
        if ($mode != "add") {
            $q->andWhere('a.emp_number !=?', array($empNum));
        }

        return $q->fetchArray();
    }

    public function IsAppLetterExists($appNo, $empNum, $mode) {

        $q = Doctrine_Query::create()
                ->select('count(a.emp_number)')
                ->from('EmployeeMaster a')
                ->where('a.emp_app_letter_no =?', array($appNo));
        if ($mode != "add") {
            $q->andWhere('a.emp_number !=?', array($empNum));
        }

        return $q->fetchArray();
    }

    public function IsEmpIdExists($empId, $empNum, $mode) {
        //echo($empId.$empNum);
        $q = Doctrine_Query::create()
                ->select('count(a.emp_number)')
                ->from('EmployeeMaster a')
                ->where('a.employee_id =?', array($empId));
        if ($mode != "add") {
            $q->andWhere('a.emp_number !=?', array($empNum));
        }

        return $q->fetchArray();
    }

    public function deleteEmployee($entriesToDelete) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $deleteCount = 0;

        foreach ($entriesToDelete as $empNumber) {
            $conHandler = new ConcurrencyHandler();
            //Need to check for each lock type
            $recordLocked = $conHandler->isTableLocked('hs_hr_employee', array($empNumber), 1);

            if ($recordLocked == false) {
                $this->employeeDao->deleteEmployee($empNumber);
                $deleteCount = $deleteCount + 1;
            }
        }

        $conn->commit();
        return $deleteCount;
    }

    public function addEmployee(EmployeeMaster $employee) {


        if ($employee->getEmpNumber() == '') {

            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($employee);
            $employee->setEmpNumber($idGenService->getNextID());
        }


        $employee->save();
    }

    public function getEmployee($empNumber) {

        $employee = Doctrine :: getTable('Employee')->find($empNumber);

        return $employee;
    }

    public function getReportToEmp($empid) {
        $employee = Doctrine :: getTable('EmployeeMaster')->find($empid);

        return $employee;
    }

    public function getEBexamById($empNum, $ebExamNo) {


        $q = Doctrine_Query::create()
                ->select('w.*')
                ->from('EBExam w')
                ->where("emp_number=$empNum and ebexam_id=$ebExamNo");

        return $q->fetchArray();
    }

    public function getEmployeeContact($empNumber) {
        return $this->employeeDao->getEmployeeContact($empNumber);
    }

    public function getDefaultEmployeeId() {
        $idGenService = new IDGeneratorService();
        $idGenService->setEntity(new EmployeeMaster());
        return $idGenService->getNextID(false);
    }

    public function getPastJobTitles($empNumber) {

        $q = Doctrine_Query :: create()->from('EmpJobtitleHistory h')->where('h.emp_number = ?', $empNumber)->andWhere('h.end_date IS NOT NULL')->orderBy('h.start_date');
        $history = $q->execute();
        return $history;
    }

    public function getPastSubdivisions($empNumber) {

        $q = Doctrine_Query :: create()->from('EmpSubdivisionHistory h')->where('h.emp_number = ?', $empNumber)->andWhere('h.end_date IS NOT NULL')->orderBy('h.start_date');
        $history = $q->execute();
        return $history;
    }

    public function getEBExam($empNumber) {

        $q = Doctrine_Query :: create()->from('EBExam h')->where('h.emp_number =' . $empNumber);
        $EBexam = $q->execute();
        return $EBexam;
    }

    public function getAttachmentList($empNumber) {

        $q = Doctrine_Query :: create()->select('a.emp_number, a.attach_id, a.attach_type_id, a.size, a.description, a.filename, a.file_type')->from('EmpAttachment a')->where('a.emp_number = ?', $empNumber);
        $attachments = $q->execute();
        return $attachments;
    }

    public function getServiceRecListbyEmployee($id) {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('ServiceHistory s')
                ->leftJoin('s.District d on d.district_id=s.esh_district')
                ->where('s.emp_number =' . $id);
        return $q->execute();
    }

    public function getAttachmentDetails($attachId, $empNumber) {

        $q = Doctrine_Query :: create()->select('a.emp_number, a.attach_id, a.attach_type_id, a.size, a.description, a.filename, a.file_type')->from('EmpAttachment a')->where('a.attach_id = ?', $attachId)->andWhere('a.emp_number = ?', $empNumber);
        $attachments = $q->fetchArray();
        return $attachments;
    }

    public function getAttachmentTypeList() {

        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('EmpAttahmentType t');
        return $q->execute();
    }

    public function getPicture($empNumber) {

        $picture = Doctrine :: getTable('EmpPicture')->find($empNumber);
        return $picture;
    }

    public function getAttachment($empNumber, $attachId) {

        $attachment = Doctrine :: getTable('EmpAttachment')->find(array(
                    'emp_number' => $empNumber,
                    'attach_id' => $attachId
                ));
        return $attachment;
    }

    public function savePersonalDetails(EmployeeMaster $employee) { 
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();
        $this->employeeDao->savePersonalDetails($employee);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_employee', array($employee->empNumber), 1);

        $conn->commit();
    }

    public function saveContactDetails(EmpContact $empContact) {
        $this->employeeDao->saveContactDetails($empContact);
        return true;
    }

    public function saveJobDetails(EmployeeMaster $employee) {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();


        $employee->save();

        // if a job title is defined, update job title history
        if (!empty($employee->job_title_code)) {

            // find if current history item is the same job
            $q = Doctrine_Query :: create($conn)->select('h.*')->from('EmpJobtitleHistory h')->where('h.emp_number = ?', $employee->empNumber)->andWhere('h.end_date IS NULL')->andWhere('h.code = ?', $employee->job_title_code);

            $result = $q->execute();

            // if not same job title, update history
            if ($result->count() == 0) {

                // find job title name
                $q = Doctrine_Query :: create($conn)->select('j.jobtit_name')->from('JobTitle j')->where('j.id = ?', $employee->job_title_code);
                $result = $q->execute();

                if ($result->count() != 1) {
                    throw new PIMServiceException('jobtitle ' . $employee->job_title_code . ' not found');
                }

                $jobTitleName = $result[0]->name;

                // update end_date for current item
                $q = Doctrine_Query :: create($conn)->update('EmpJobtitleHistory h')->set('h.end_date', 'NOW()')->where('h.emp_number = ?', $employee->empNumber)->andWhere('h.end_date IS NULL');
                $q->execute();

                // add new history item
                $history = new EmpJobtitleHistory();
                $history->emp_number = $employee->empNumber;
                $history->code = $employee->job_title_code;
                $history->name = $jobTitleName;
                $history->start_date = new Doctrine_Expression('NOW()');
                $history->save();
            }
        }
//
        // update employee subdivision history
        if (!empty($employee->work_station)) {

            // find if current history item is the location
            $q = Doctrine_Query :: create($conn)->select('h.*')->from('EmpSubdivisionHistory h')->where('h.emp_number = ?', $employee->empNumber)->andWhere('h.end_date IS NULL')->andWhere('h.code = ?', $employee->work_station);

            $result = $q->execute();

            // if not same sub division, update history
            if ($result->count() == 0) {

                // find location name
                $q = Doctrine_Query :: create($conn)->select('c.title')->from('CompanyStructure c')->where('c.id = ?', $employee->work_station);
                $result = $q->execute();

                if ($result->count() != 1) {
                    throw new PIMServiceException('company structure position ' . $employee->work_station . ' not found');
                }

                $title = $result[0]->title;

                // update end_date for current item
                $q = Doctrine_Query :: create($conn)->update('EmpSubdivisionHistory h')->set('h.end_date', 'NOW()')->where('h.emp_number = ?', $employee->empNumber)->andWhere('h.end_date IS NULL');
                $q->execute();

                // add new history item
                $history = new EmpSubdivisionHistory();
                $history->emp_number = $employee->empNumber;
                $history->code = $employee->work_station;
                $history->name = $title;
                $history->start_date = new Doctrine_Expression('NOW()');
                $history->save();
            }
        }

        $conn->commit();
        return true;
    }

    public function deleteJobTitleHistory($empNumber, $jobTitlesToDelete) {

        // Delete only complete history items (UI displays only complete items)
        $q = Doctrine_Query :: create()->delete('EmpJobtitleHistory h')->whereIn('id', $jobTitlesToDelete)->andwhere('emp_number = ?', $empNumber)->andWhere('h.end_date IS NOT NULL');

        $result = $q->execute();

        return $result;
    }

    public function deleteSubDivisionHistory($empNumber, $subDivisionsToDelete) {

        // Delete only complete history items (UI displays only complete items)
        $q = Doctrine_Query :: create()->delete('EmpSubdivisionHistory h')->whereIn('id', $subDivisionsToDelete)->andwhere('emp_number = ?', $empNumber)->andWhere('h.end_date IS NOT NULL');
        $result = $q->execute();

        return $result;
    }

    public function deleteLocationHistory($empNumber, $locationsToDelete) {

        // Delete only complete history items (UI displays only complete items)
        $q = Doctrine_Query :: create()->delete('EmpLocationHistory h')->whereIn('id', $locationsToDelete)->andwhere('emp_number = ?', $empNumber)->andWhere('h.end_date IS NOT NULL');
        $result = $q->execute();

        return $result;
    }

    public function updateJobHistory($empNumber, $params) {
        $historyItems = array();

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();


        // Get job title history
        if (isset($params['jobTitleHisId'])) {
            $jobTitleIds = $params['jobTitleHisId'];
            $jobTitleCodes = $params['jobTitleHisCode'];
            $jobTitleFromDates = $params['jobTitleHisFromDate'];
            $jobTitleToDates = $params['jobTitleHisToDate'];

            for ($i = 0; $i < count($jobTitleIds); $i++) {

                $id = $jobTitleIds[$i];
                $code = $jobTitleCodes[$i];

                $startDate = LocaleUtil :: getInstance()->convertToStandardDateFormat($jobTitleFromDates[$i]);

                $endDate = LocaleUtil :: getInstance()->convertToStandardDateFormat($jobTitleToDates[$i]);

                $q = Doctrine_Query :: create($conn)->update('EmpJobtitleHistory h')->set('h.end_date', '?', $endDate)->set('h.start_date', '?', $startDate)->where('h.id = ?', $id)->andWhere('h.code = ?', $code)->andWhere('h.emp_number = ?', $empNumber);

                $result = $q->execute();
            }
        }

        // Get sub division history
        if (isset($params['subDivHisId'])) {
            $subDivIds = $params['subDivHisId'];
            $subDivCodes = $params['subDivHisCode'];
            $subDivFromDates = $params['subDivHisFromDate'];
            $subDivToDates = $params['subDivHisToDate'];

            for ($i = 0; $i < count($subDivIds); $i++) {
                $id = $subDivIds[$i];
                $code = $subDivCodes[$i];
                $startDate = LocaleUtil :: getInstance()->convertToStandardDateFormat($subDivFromDates[$i]);
                $endDate = LocaleUtil :: getInstance()->convertToStandardDateFormat($subDivToDates[$i]);
                $q = Doctrine_Query :: create($conn)->update('EmpSubdivisionHistory h')->set('h.end_date', '?', $endDate)->set('h.start_date', '?', $startDate)->where('h.id = ?', $id)->andWhere('h.code = ?', $code)->andWhere('h.emp_number = ?', $empNumber);
                $result = $q->execute();
            }
        }

        // Get location history
        if (isset($params['locHisId'])) {

            $locIds = $params['locHisId'];
            $locCodes = $params['locHisCode'];
            $locFromDates = $params['locHisFromDate'];
            $locToDates = $params['locHisToDate'];

            for ($i = 0; $i < count($locIds); $i++) {

                $id = $locIds[$i];
                $startDate = LocaleUtil :: getInstance()->convertToStandardDateFormat($locFromDates[$i]);
                $endDate = LocaleUtil :: getInstance()->convertToStandardDateFormat($locToDates[$i]);
                $code = $locCodes[$i];

                $q = Doctrine_Query :: create($conn)->update('EmpLocationHistory h')->set('h.end_date', '?', $endDate)->set('h.start_date', '?', $startDate)->where('h.id = ?', $id)->andWhere('h.code = ?', $code)->andWhere('h.emp_number = ?', $empNumber);
                $result = $q->execute();
            }
        }
        $conn->commit();
    }

    public function deleteSalary($empNumber, $salaryToDelete) {

        // Skip if no salarys because running the following query
        // with no salarys will delete all this employee's assigned
        // salarys
        if (count($salaryToDelete) > 0) {

            $q = Doctrine_Query :: create()->delete('EmpBasicsalary s');

            foreach ($salaryToDelete as $sal) {
                $q->orWhere('sal_grd_code = ? AND currency_id = ?', array_values($sal));
            }
            $q->andWhere('emp_number = ?', $empNumber);

            $result = $q->execute();
        }

        return $result;
    }

    public function getAvailableEducationList($empNumber) {


        $q = Doctrine_Query :: create()->select('e.*')->from('Education e')->leftJoin('e.EmployeeEducation ee WITH ee.emp_number = ' . $empNumber)->where('ee.emp_number IS NULL');

        $education = $q->execute();

        return $education;
    }

    public function getAvailableSkills($empNumber) {

        $q = Doctrine_Query :: create()->select('s.skill_code, s.skill_name')->from('Skill s')->leftJoin('s.EmployeeSkill es WITH es.emp_number = ' . $empNumber)->where('es.emp_number IS NULL');

        $skills = $q->execute();

        return $skills;
    }

    public function deleteSupervisors($empNumber, $supervisorsToDelete) {

        // Skip if no supervisors because running the following query
        // with no supervisors will delete all this employee's assigned
        // supervisor/subordinates
        if (count($supervisorsToDelete) > 0) {

            $q = Doctrine_Query :: create()->delete('ReportTo r');

            $q->orWhere('supervisorId = ? AND reportingMode = ?', array_values($supervisorsToDelete));

            $q->andWhere('subordinateId = ?', $empNumber);

            $result = $q->execute();
        }

        return $result;
    }

    public function deleteSubordinates($empNumber, $subordinatesToDelete) {

        // Skip if no subordinates because running the following query
        // with no subordinates will delete all this employee's assigned
        // subordinate/subordinates
        if (count($subordinatesToDelete) > 0) {

            $q = Doctrine_Query :: create()->delete('ReportTo r');

            $q->Where('subordinateId = ? AND reportingMode = ?', array_values($subordinatesToDelete));

            $q->andWhere('supervisorId = ?', $empNumber);

            $result = $q->execute();
        }

        return $result;
    }

    public function deletePhoto($empNumber) {

        $q = Doctrine_Query :: create()->delete('EmpPicture p')->where('emp_number = ?', array($empNumber));
        $result = $q->execute();

        return $result;
    }

    public function deleteAttachments($empNumber, $attachmentsToDelete) {

        if (count($attachmentsToDelete) > 0) {

            // Delete attachments
            $q = Doctrine_Query :: create()->delete('EmpAttachment a')->where('attach_id = ?', $attachmentsToDelete)->andwhere('emp_number = ?', $empNumber);
            $result = $q->execute();
        }
        return true;
    }

    function saveEmployeePicture(EmpPicture $empPicture) {

        $empPicture->save();
    }

    function readEmployeePicture($empNumber) {

        $q = Doctrine_Query :: create()->from('EmpPicture ep')->where('emp_number = ?', $empNumber);
        return $q->fetchOne();
    }

    public function getSupervisorEmployeeList($supervisorId) {

        $employeeList = array();

        $q = Doctrine_Query :: create()->select("rt.supervisorId,emp.*")->from('ReportTo rt')->leftJoin('rt.subordinate emp')->where("rt.supervisorId=$supervisorId");

        $reportToList = $q->execute();
        foreach ($reportToList as $reportTo) {
            array_push($employeeList, $reportTo->getSubordinate());
        }

        return $employeeList;
    }

    public function getEmployeeListAsJson($workShift = false) {

        $jsonString = array();
        $q = Doctrine_Query :: create()->from('Employee');

        $employeeList = $q->execute();

        foreach ($employeeList as $employee) {
            $workShiftLength = 0;
            if ($workShift) {
                $employeeWorkShift = $this->getWorkShift($employee->getEmpNumber());
                if ($employeeWorkShift != null) {
                    $workShiftLength = $employeeWorkShift->getWorkShift()->getHoursPerDay();
                } else
                    $workShiftLength = WorkShift :: DEFAULT_WORK_SHIFT_LENGTH;
            }

            array_push($jsonString, "{name:'" . $employee->getFirstName() . ' ' . $employee->getLastName() . "',id:'" . $employee->getEmpNumber() . "',workShift:'" . $workShiftLength . "'}");
        }

        $jsonStr = " [" . implode(",", $jsonString) . "]";
        return $jsonStr;
    }

    public function getSupervisorEmployeeChain($supervisorId) {

        return $this->getEmployeeDao()->getSupervisorEmployeeChain($supervisorId);
    }

    public function filterEmployeeListBySubUnit($employeeList, $subUnitId) {

        if (empty($subUnitId) || $subUnitId == CompanyStructure::ROOT_ID) {
            return $employeeList;
        }

        if (empty($employeeList)) {
            $employeeList = $this->getEmployeeList();
        }

        $filteredList = array();

        foreach ($employeeList as $employee) {

            if ($employee->getWorkStation() == $subUnitId) {
                $filteredList[] = $employee;
            }
        }

        return $filteredList;
    }

    public function getEmployeeList($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'emp_number', $orderBy = 'ASC',$Active) {
        return $this->employeeDao->getEmployeeList($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy,$Active);
    }

    public function searchEmployee($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'emp_number', $orderBy = 'ASC', $type='single', $method='', $reason='', $att='', $payroll='', $payrolltype='', $locationWise='', $startDate='', $endDate='',$empdef='') {

        return $this->employeeDao->searchEmployee($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $type, $method, $reason, $att, $payroll, $payrolltype, $locationWise, $startDate, $endDate, $empdef);
    }

    public function getPersonalDetailsById($empNumber) {
        return $this->employeeDao->getPersonalDetailsById($empNumber);
    }

    public function getJobSalDetailsById($empNumber) {
        return $this->employeeDao->getJobSalDetailsById($empNumber);
    }

    public function getContactDetailsById($empNumber) {
        return $this->employeeDao->getContactDetailsById($empNumber);
    }

    public function getEmergencyContactById($empNumber, $seqNo) {
        return $this->employeeDao->getEmergencyContactById($empNumber, $seqNo);
    }

    public function saveEmergencyContact($emgContact) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->employeeDao->saveEmergencyContact($emgContact);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_emp_emergency_contacts', array($emgContact->emp_number, $emgContact->seqno), 1);

        $conn->commit();
        return true;
    }

    public function deleteEmergencyContacts($empNumber, $entriesToDelete) {
        $this->employeeDao->deleteEmergencyContacts($empNumber, $entriesToDelete);
        return true;
    }

    public function getDependentContactById($empNumber, $seqNo) {
        return $this->employeeDao->getDependentContactById($empNumber, $seqNo);
    }

    public function saveDependentContact($dependentContact) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->employeeDao->saveDependentContact($dependentContact);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_emp_dependents', array($dependentContact->emp_number, $dependentContact->seqno), 1);

        $conn->commit();
    }

    public function deleteDependentContacts($empNumber, $entriesToDelete) {
        $this->employeeDao->deleteDependentContacts($empNumber, $entriesToDelete);
        return true;
    }

    public function getEmpLanguageById($empNumber, $langCode, $langType) {
        return $this->employeeDao->getEmpLanguageById($empNumber, $langCode, $langType);
    }

    public function saveEmpLanguage($empLanguage) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->employeeDao->saveEmpLanguage($empLanguage);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_emp_language', array($empLanguage->emp_number, $empLanguage->lang_code, $empLanguage->emplang_type), 1);

        $conn->commit();
    }

    public function saveEMBexam($ebExam) {

        $this->employeeDao->saveEMBexam($ebExam);
        return true;
    }

    public function saveServiceRecord(ServiceHistory $serviceRec) {

        $this->employeeDao->saveServiceRecord($serviceRec);
        return true;
    }

    public function deleteEmpLanguages($empNumber, $entriesToDelete) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        foreach ($entriesToDelete as $lang) {
            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->isTableLocked('hs_hr_emp_language', array($empNumber, $lang['code'], $lang['type']), 1);

            if ($recordLocked == false) {
                $this->employeeDao->deleteEmpLanguages($empNumber, $lang['code'], $lang['type']);
            }
        }

        $conn->commit();
        return true;
    }

    public function getWorkExperienceById($empNumber, $seqNo) {
        return $this->employeeDao->getWorkExperienceById($empNumber, $seqNo);
    }

    public function saveWorkExperience($workExp) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->employeeDao->saveWorkExperience($workExp);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_emp_work_experience', array($workExp->emp_number, $workExp->eexp_seqno), 1);

        $conn->commit();
        return true;
    }

    public function deleteWorkExperience($empNumber, $entriesToDelete) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        foreach ($entriesToDelete as $work) {
            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->isTableLocked('hs_hr_emp_work_experience', array($empNumber, $work), 1);

            if ($recordLocked == false) {
                $this->employeeDao->deleteWorkExperience($empNumber, $work);
            }
        }

        $conn->commit();
        return true;
    }

    public function deleteEBExam($empNumber, $ExamId) {
        $q = Doctrine_Query :: create()->delete('EBExam')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('ebexam_id = ?', $ExamId);

        $result = $q->execute();
        return $result;
    }

    public function deleteServiceRecord($empNumber, $recId) {

        $q = Doctrine_Query :: create()->delete('ServiceHistory')
                ->where('emp_number = ?', $empNumber)
                ->andwhere('esh_code = ?', $recId);

        $result = $q->execute();
        return $result;
    }

    public function getSkillById($empNumber, $skillCode) {
        return $this->employeeDao->getSkillById($empNumber, $skillCode);
    }

    public function saveSkill($empSkill) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();
        $this->employeeDao->saveSkill($empSkill);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_emp_skill', array($empSkill->emp_number, $empSkill->skill_code), 1);

        $conn->commit();
    }

    public function deleteSkill($empNumber, $entriesToDelete) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        foreach ($entriesToDelete as $skill) {
            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->isTableLocked('hs_hr_emp_skill', array($empNumber, $skill), 1);

            if ($recordLocked == false) {
                $this->employeeDao->deleteSkill($empNumber, $skill);
            }
        }

        $conn->commit();
        return true;
    }

    public function getEducationById($empNumber, $eduCode) {
        return $this->employeeDao->getEducationById($empNumber, $eduCode);
    }

    public function getServiceRecordByID($empNumber, $SerRecNo) {
        return $this->employeeDao->getServiceRecordByID($empNumber, $SerRecNo);
    }

    public function saveEducation($empEducation) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();
        $this->employeeDao->saveEducation($empEducation);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_emp_education', array($empEducation->emp_number, $empEducation->edu_code), 1);

        $conn->commit();
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
        return $this->employeeDao->getLicenseById($empNumber, $seqNo);
    }

    public function saveLicense($empLicense) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->employeeDao->saveLicense($empLicense);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_emp_licenses', array($empLicense->emp_number, $empLicense->lic_seqno), 1);

        $conn->commit();
    }

    public function deleteLicense($empNumber, $entriesToDelete) {

        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        foreach ($entriesToDelete as $lic) {
            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->isTableLocked('hs_hr_emp_licenses', array($empNumber, $lic), 1);

            if ($recordLocked == false) {
                $this->employeeDao->deleteLicense($empNumber, $lic);
            }
        }

        $conn->commit();
        return true;
    }

    public function getDivisionDisplayNo($id) {

        return Doctrine::getTable('CompanyStructure')->find($id);
    }

    public function getDistrictList() {

        $q = Doctrine_Query::create()
                ->from('District d');
        return $q->execute();
    }
    
            public function countEmployeesList() {
        $q = Doctrine_Query::create()
                ->select('count(e.empNumber)')
                ->from('EmployeeMaster e');


        return $q->fetchArray();
    }

    public function getSelectAll(){
                $q = Doctrine_Query::create()
                ->select('a.emp_number')
                ->from('EmployeeMaster a');
                return $q->fetchArray();
    }
}