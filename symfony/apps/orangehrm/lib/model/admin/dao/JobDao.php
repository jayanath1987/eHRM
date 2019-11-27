<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Job Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
require_once '../../lib/common/LocaleUtil.php';

class JobDao extends BaseDao {

    public function saveJobCategory(JobCategory $jobCategory) {

        $q = Doctrine_Query::create()
                ->from('JobCategory j')
                ->where('j.eec_desc = ?', $jobCategory->getEecDesc());

        if (!empty($jobCategory->eec_code)) {
            $q->andWhere('j.eec_code <> ?', $jobCategory->eec_code);
        }

        if ($q->count() > 0) {
            throw new DataDuplicationException();
        }

        if ($jobCategory->getEecCode() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($jobCategory);
            $jobCategory->setEecCode($idGenService->getNextID());
        }

        $jobCategory->save();
        return true;
    }

    public function getCarderList($id) {

        $q = Doctrine_Query::create()
                ->from('CarderPlan c')
                ->where('c.id= ?', $id);
        return $q->execute();
    }

    public function readCarderPlanByKeys($divID, $jobId) {

        return Doctrine::getTable('CarderPlan')->find(array($divID, $jobId));
    }

    public function getJobCategoryList($orderField = 'eec_code', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('JobCategory')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function getJobGradeList($orderField = 'grade_code', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('Grade')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function getJobLevelList($orderField = 'level_code', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('Level')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function deleteJobCategory($jobCategoryList = array()) {

        if (is_array($jobCategoryList)) {
            $q = Doctrine_Query::create()
                    ->delete('JobCategory')
                    ->whereIn('eec_code', $jobCategoryList);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
        }
        return false;
    }

    public function searchJobCategory($searchMode, $searchValue) {

        $q = Doctrine_Query::create()
                ->from('JobCategory')
                ->where("$searchMode = ?", trim($searchValue));

        return $q->execute();
    }

    public function readJobCategory($id) {

        return Doctrine::getTable('JobCategory')->find($id);
    }

    public function saveSalaryGrade(SalaryGrade $salaryGrade) {

        if ($salaryGrade->getSalGrdCode() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($salaryGrade);
            $salaryGrade->setSalGrdCode($idGenService->getNextID());
        }

        $salaryGrade->save();
        return $salaryGrade;
    }

    public function getSalaryGradeList($orderField = 'sal_grd_code', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('SalaryGrade')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function deleteSalaryGrade($saleryGradeList = array()) {

        if (is_array($saleryGradeList)) {
            $q = Doctrine_Query::create()
                    ->delete('SalaryGrade')
                    ->whereIn('sal_grd_code', $saleryGradeList);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
        }
        return false;
    }

    public function searchSalaryGrade($searchMode, $searchValue) {

        $q = Doctrine_Query::create()
                ->from('SalaryGrade')
                ->where("$searchMode = ?", trim($searchValue));

        return $q->execute();
    }

    public function readSalaryGrade($id) {

        return Doctrine::getTable('SalaryGrade')->find($id);
    }

    public function saveSalleryGradeCurrency(SalaryCurrencyDetail $salaryCurrencyDetail) {

        if (!$this->isExistingSalleryGradeCurrency($salaryCurrencyDetail)) {
            $salaryCurrencyDetail->save();
            return true;
        }
        return false;
    }

    public function isExistingSalleryGradeCurrency(SalaryCurrencyDetail $salaryCurrencyDetail) {

        $q = Doctrine_Query::create()
                ->from('SalaryCurrencyDetail')
                ->where("sal_grd_code='" . $salaryCurrencyDetail->getSalGrdCode() . "' AND currency_id='" . $salaryCurrencyDetail->getCurrencyId() . "'");

        if ($q->count() > 0) {
            return true;
        }
        return false;
    }

    public function getSalaryGradeCurrency($salaryGradeCode) {

        $q = Doctrine_Query::create()
                ->from('SalaryCurrencyDetail')
                ->where("sal_grd_code='$salaryGradeCode'");

        return $q->execute();
    }

    public function deleteSalaryGradeCurrency($salaryGradeId, $salaryGradeCurrencyList = array()) {

        if (is_array($salaryGradeCurrencyList)) {
            $q = Doctrine_Query::create()
                    ->delete('SalaryCurrencyDetail')
                    ->where("sal_grd_code ='$salaryGradeId'")
                    ->whereIn('currency_id', $salaryGradeCurrencyList);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
        }
    }

    public function getSalaryCurrencyDetail($salaryGrade, $currency) {

        return Doctrine::getTable('SalaryCurrencyDetail')->find(
                array('sal_grd_code' => $salaryGrade,
                    'currency_id' => $currency));
    }

    public function getEmployeeStatusList($orderField = 'id', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('EmployeeStatus')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function getEmpServiceList($orderField = 'service_code', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('ServiceDetails')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function getEmployeeStatusForJob($jobTitleCode, $asArray = false) {

        $hydrateMode = ($asArray) ? Doctrine::HYDRATE_ARRAY : Doctrine::HYDRATE_RECORD;

        $q = Doctrine_Query::create()
                ->select('s.id, s.name')
                ->from('EmployeeStatus s')
                ->leftJoin('s.JobTitleEmployeeStatus j ON s.id = j.estat_code')
                ->where('j.jobtit_code = ?', $jobTitleCode)
                ->orderBy('s.name');

        return $q->execute(array(), $hydrateMode);
    }

    public function saveEmployeeStatus(EmployeeStatus $employeeStatus) {

        if ($employeeStatus->getId() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($employeeStatus);
            $employeeStatus->setId($idGenService->getNextID());
        }
        $employeeStatus->save();
        return true;
    }

    public function deleteEmployeeStatus($employeeStatusList = array()) {

        if (is_array($employeeStatusList)) {
            $q = Doctrine_Query::create()
                    ->delete('EmployeeStatus')
                    ->whereIn('id', $employeeStatusList);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
        }
    }

    public function searchEmployeeStatus($searchMode, $searchValue) {

        $q = Doctrine_Query::create()
                ->from('EmployeeStatus')
                ->where("$searchMode = ?", trim($searchValue));

        return $q->execute();
    }

    public function readEmployeeStatus($id) {

        return Doctrine::getTable('EmployeeStatus')->find($id);
    }

    public function getJobSpecificationsList($orderField = 'jobspec_id', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('JobSpecifications')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function saveJobSpecifications(JobSpecifications $jobSpecifications) {

        if ($jobSpecifications->getJobspecId() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($jobSpecifications);
            $jobSpecifications->setJobspecId($idGenService->getNextID());
        }
        $jobSpecifications->save();
        return true;
    }

    public function deleteJobSpecifications($jobSpecificationsList = array()) {

        if (is_array($jobSpecificationsList)) {
            $q = Doctrine_Query::create()
                    ->delete('JobSpecifications')
                    ->whereIn('jobspec_id', $jobSpecificationsList);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
        }
    }

    public function searchJobSpecifications($searchMode, $searchValue) {

        $q = Doctrine_Query::create()
                ->from('JobSpecifications')
                ->where("$searchMode = ?", trim($searchValue));

        return $q->execute();
    }

    public function readJobSpecifications($id) {
        try {
            return Doctrine::getTable('JobSpecifications')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function getJobSpecForJob($jobId, $asArray = false) {

        $hydrateMode = ($asArray) ? Doctrine::HYDRATE_ARRAY : Doctrine::HYDRATE_RECORD;

        $q = Doctrine_Query::create()
                ->select('js.*')
                ->from('JobSpecifications js')
                ->leftJoin('js.JobTitle j')
                ->where('j.id = ?', $jobId);

        $jobSpecList = $q->execute(array(), $hydrateMode);
        $jobSpec = null;
        if (count($jobSpecList) == 1) {
            $jobSpec = $jobSpecList[0];
        }
        return $jobSpec;
    }

    public function getJobtitleListCarder() {
        $q = Doctrine_Query::create()
                ->select('job.*')
                ->from('JobTitle job');

        return $q->execute();
    }

    public function getJobTitleList1($searchMode, $searchValue, $culture="en", $orderField = 'job.id', $orderBy = 'ASC', $page="1" ) {

        if ($searchMode == "jobtit_name_") {
            if ($culture == "en")
                $feildName = "job.name";
            else
                $feildName="job.name_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('job.*')
                ->from('JobTitle job');

        if ($searchValue != "") {          
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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
                        "?page={%page_number}&amp;mode=search&amp;searchValue={$searchValue}&searchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function getJobService($searchMode, $searchValue, $culture="en", $orderField = 'job.service_code', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "service_name_") {
            if ($culture == "en")
                $feildName = "job.service_name";
            else
                $feildName="job.service_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('job.*')
                ->from('ServiceDetails job');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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

    public function getJobTitleList($orderField = 'job.id', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->select('job.*')
                ->from('JobTitle job')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function saveJobTitle1(JobTitle $jobTitle) {

        if ($jobTitle->getId() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($jobTitle);
            $jobTitle->setId($idGenService->getNextID());
        }
        $jobTitle->save();
        return true;
    }

    public function saveJobservice(ServiceDetails $jobTitle) {


        $jobTitle->save();
        return true;
    }

    public function saveJobTitle(JobTitle $jobTitle, $emplymentStatus = array()) {

        if ($jobTitle->getId() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($jobTitle);
            $jobTitle->setId($idGenService->getNextID());
        }

        if ($jobTitle->getSalaryGradeId() == '-1')
            $jobTitle->setSalaryGradeId(new SalaryGrade());

        if ($jobTitle->getJobspecId() == '-1')
            $jobTitle->setJobspecId(new JobSpecifications());

        $jobTitle->save();

        $this->deleteJobTitleEmpStstus($jobTitle);
        foreach ($emplymentStatus as $empStatus) {
            $jobEmpStatus = new JobTitleEmployeeStatus();
            $jobEmpStatus->setJobtitCode($jobTitle->getId());
            $jobEmpStatus->setEstatCode($empStatus->getId());
            $jobEmpStatus->save();
        }
        return true;
    }

    public function deleteJobTitleEmpStstus($jobTitle) {

        $q = Doctrine_Query::create()
                ->delete('JobTitleEmployeeStatus')
                ->where("jobtit_code='" . $jobTitle->getId() . "'");

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteJobTitle1($id) {

        $q = Doctrine_Query::create()
                ->delete('JobTitle')
                ->where('id=?', $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteJobService($id) {

        $q = Doctrine_Query::create()
                ->delete('ServiceDetails')
                ->where('service_code=?', $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteJobTitle($jobTitleList = array()) {

        if (is_array($jobTitleList)) {
            $q = Doctrine_Query::create()
                    ->delete('JobTitle')
                    ->whereIn('id', $jobTitleList);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
        }
    }

    public function searchJobTitle($searchMode, $searchValue) {

        $q = Doctrine_Query::create()
                ->from('JobTitle')
                ->where("$searchMode = ?", trim($searchValue));

        return $q->execute();
    }

    public function readJobTitle($id) {

        return Doctrine::getTable('JobTitle')->find($id);
    }

    public function readJobService($id) {

        return Doctrine::getTable('ServiceDetails')->find($id);
    }

    public function getGradeSlotByID($id) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('GradeSlot g')
                ->where('g.grade_code = ?', $id);
        return $q->execute();
    }

    public function getJobtitleCombo() {
        $q = Doctrine_Query::create()
                ->select('job.*')
                ->from('JobTitle job');

        return $q->execute();
    }

    public function getServiceDetailsCombo() {
        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('ServiceDetails s');

        return $q->execute();
    }

    public function getLevelCombo() {
        $q = Doctrine_Query::create()
                ->select('l.*')
                ->from('Level l');

        return $q->execute();
    }

    public function readJobRole($id) {

        return Doctrine::getTable('JobRole')->find($id);
    }

    public function saveJobRole(JobRole $jobTitle) {

        $jobTitle->save();
        return true;
    }

    public function searchJobRole($searchMode, $searchValue, $culture="en", $orderField = 'JR.jrl_id', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "Designation") {
            if ($culture == "en")
                $feildName = "j.jobtit_name";
            else
                $feildName="j.jobtit_name_" . $culture;
        }
        else if ($searchMode == "Level") {
            if ($culture == "en")
                $feildName = "l.level_name";
            else
                $feildName="l.level_name_" . $culture;
        }
        else if ($searchMode == "JobRole") {
            if ($culture == "en")
                $feildName = "JR.jrl_name";
            else
                $feildName="JR.jrl_name_" . $culture;
        }
        else if ($searchMode == "Service") {
            if ($culture == "en")
                $feildName = "s.service_name";
            else
                $feildName="s.service_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('JR.*')
                ->from('JobRole JR')
                ->leftJoin('JR.Level l ON JR.level_code = l.level_code')
                ->leftJoin('JR.JobTitle j ON JR.jobtit_code = j.jobtit_code')
                ->leftJoin('JR.ServiceDetails s ON JR.service_code = s.service_code');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function deleteJobRole($id) {

        $q = Doctrine_Query::create()
                ->delete('JobRole')
                ->where('jrl_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function searchLevel($searchMode, $searchValue, $culture="en", $orderField = 'b.bt_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "Level") {
            if ($culture == "en")
                $feildName = "l.level_name";
            else
                $feildName="l.level_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('l.*')
                ->from('Level l');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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
                        //  'wbm/?page={%page_number}'
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function saveLevel(Level $rte) {
        $rte->save();
        return true;
    }

    public function readLevel($id) {
        return Doctrine::getTable('Level')->find($id);
    }

    public function deleteLevel($id) {
        $q = Doctrine_Query::create()
                ->delete('Level')
                ->where('level_code=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function validateDivision() {

        $query = "select * from hs_hr_employee e where
hie_code_1 in ( select hie_code_1 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number={$_SESSION['PIM_EMPID']} and  ( U.def_level=1 or U.def_level=4 )   )
or
 hie_code_3 in ( select hie_code_3 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number={$_SESSION['PIM_EMPID']} and  U.def_level=2   )
or
  hie_code_4 in ( select hie_code_4 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number={$_SESSION['PIM_EMPID']} and  U.def_level=3 )";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $results[] = $row['emp_number'];
        }
        return $results;
    }
}

?>
