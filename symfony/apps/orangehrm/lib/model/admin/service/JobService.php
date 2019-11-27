<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module JobService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class JobService extends BaseService {
   private $jobDao;


   public function __construct() {
      $this->jobDao = new JobDao();
   }


   public function setJobDao(JobDao $jobDao) {
      $this->jobDao = $jobDao;
   }


   public function getJobDao() {
      return $this->jobDao;
   }


   public function saveJobCategory( JobCategory $jobCategory) {

         return $this->jobDao->saveJobCategory($jobCategory);

   }

   public function getJobCategoryList($orderField = 'eec_code', $orderBy = 'ASC') {

         return $this->jobDao->getJobCategoryList($orderField, $orderBy);

   }
   public function getJobGradeList($orderField = 'grade_code', $orderBy = 'ASC') {

         return $this->jobDao->getJobGradeList($orderField, $orderBy);

   }
   public function getJobLevelList($orderField = 'level_code', $orderBy = 'ASC') {

         return $this->jobDao->getJobLevelList($orderField, $orderBy);

   }
   public function deleteJobCategory($jobCategoryList = array()) {

         return $this->jobDao->getJobCategoryList($orderField, $orderBy);

   }

   public function searchJobCategory($searchMode, $searchValue) {

         return $this->jobDao->searchJobCategory($searchMode, $searchValue);

   }
   public function readJobCategory($id) {

         return $this->jobDao->readJobCategory($id);

   }
   public function saveSalaryGrade(SalaryGrade $salaryGrade) {

         return $this->jobDao->saveSalaryGrade($salaryGrade);

   }


   public function getSaleryGradeList($orderField = 'sal_grd_code', $orderBy = 'ASC') {

         return $this->jobDao->getSalaryGradeList($orderField, $orderBy);

   }


   public function deleteSalaryGrade($saleryGradeList = array()){

         return $this->jobDao->deleteSalaryGrade($saleryGradeList);

   }


   public function searchSalaryGrade($searchMode, $searchValue) {

         return $this->jobDao->searchSalaryGrade($searchMode, $searchValue);

   }


   public function readSalaryGrade($id) {

         return $this->jobDao->readSalaryGrade($id);

   }




   public function getEmployeeStatusList($orderField = 'id', $orderBy = 'ASC') {

         return $this->jobDao->getEmployeeStatusList($orderField, $orderBy);

   }
   
   public function getEmpServiceList($orderField = 'service_code', $orderBy = 'ASC') {

         return $this->jobDao->getEmpServiceList($orderField, $orderBy);

   }


   public function getEmployeeStatusForJob($jobTitleCode, $asArray = false) {

         return $this->jobDao->getEmployeeStatusForJob($jobTitleCode, $asArray);

   }


   public function saveEmployeeStatus(EmployeeStatus $employeeStatus) {

         return $this->jobDao->saveEmployeeStatus($employeeStatus);

   }


   public function deleteEmployeeStatus($employeeStatusList = array()) {

         return $this->jobDao->deleteEmployeeStatus($employeeStatusList);

   }


  	public function searchEmployeeStatus($searchMode, $searchValue) {

         return $this->jobDao->searchEmployeeStatus($searchMode, $searchValue);

   }


   public function readEmployeeStatus($id) {

         return $this->jobDao->readEmployeeStatus($id);

   }


 

  
   public function getJobSpecForJob($jobId, $asArray = false) {

         return $this->jobDao->getJobSpecForJob($jobId, $asArray);

   }


   public function getJobTitleList($orderField = 'job.jobtit_name', $orderBy = 'ASC'){

         return $this->jobDao->getJobTitleList($orderField, $orderBy);

   }


   public function saveJobTitle(JobTitle $jobTitle, $emplymentStatus = array()) {

         return $this->jobDao->saveJobTitle($jobTitle, $emplymentStatus);

   }


   public function deleteJobTitle($jobTitleList = array()) {

         return $this->jobDao->deleteJobTitle($jobTitleList);

   }



   public function readJobTitle($id) {

         return $this->jobDao->readJobTitle($id);

   }
   public function validateDivision(){
       return $this->jobDao->validateDivision();
   }
}
?>