<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class InstituteCourceService extends BaseService {
    
   private $instituteCourseDao;

   public function __construct() {
      $this->instituteCourseDao = new InstituteCourseDao();
   }
          
    public function saveTransIns(TrainingInstitute $traningIns){
        return $this->instituteCourseDao->saveTransIns($traningIns);
    }
    public function getLastInstituteID(){
        return $this->instituteCourseDao->getLastInstituteID();
    }
    
     public function readTrainIns($id) {
            return $this->instituteCourseDao->readTrainIns($id);
    }
    
    
     public function getInstitutelist(){
        return $this->instituteCourseDao->getInstitutelist();
    }
     public function getmedium(){
        return $this->instituteCourseDao->getmedium();
    }
     public function getLevelCombo(){
        return $this->instituteCourseDao->getLevelCombo();
    }
    public function saveCourse($request){
        return $this->instituteCourseDao->saveCourse($request);
    }
    public function updateCourse($obj){
        return $this->instituteCourseDao->updateCourse($obj);
    }
    public function getLastCourseID(){
        return $this->instituteCourseDao->getLastCourseID();
    }
    public function readCourse($id) {
            return $this->instituteCourseDao->readCourse($id);
    }
    
    public function LoadCourse($id) {
        return $this->instituteCourseDao->LoadCourse($id);
    }
     public function getCountofTrainCode($courseId) {
         return $this->instituteCourseDao->getCountofTrainCode($courseId);
     }
     public function getCountofTrainCodeUpdate($courseId, $currentCode) {
         return $this->instituteCourseDao->getCountofTrainCodeUpdate($courseId, $currentCode);
     }
     public function readTrainRecords($empId,$courseID){
         return $this->instituteCourseDao->readTrainRecords($empId,$courseID);
     }
     public function isrecored($courseId, $empId) {
         return $this->instituteCourseDao->isrecored($courseId, $empId);
     }
     public function getTrainRecordListUpdate($empid, $cid) {
         return $this->instituteCourseDao->getTrainRecordListUpdate($empid, $cid);
     }
     public function getTrainRecordList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $userType){
         return $this->instituteCourseDao->getTrainRecordList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $userType);
     }
     public function getTrainRecordListAdmin($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
         return $this->instituteCourseDao->getTrainRecordListAdmin($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
     }
     public function getInstituteName($id) {
         return $this->instituteCourseDao->getInstituteName($id);
     }
     public function getCoursename($id) {
         return $this->instituteCourseDao->getCoursename($id);
     }
     
     public function readWFRecord($id) {
            return $this->instituteCourseDao->readWFRecord($id);
    }
    public function courseDuration($courseId){
        return $this->instituteCourseDao->courseDuration($courseId);
    }
     public function getConductDate($courseId){
        return $this->instituteCourseDao->getConductDate($courseId);
    }
    public function getTrainingStatus($courseId, $empId){
        return $this->instituteCourseDao->getTrainingStatus($courseId, $empId);
    }
    public function updateCourceObject($request,$tcourse){
        return $this->instituteCourseDao->updateCourceObject($request,$tcourse);
    }

    public function readEmployeeSupervisor($wmid){
       return $this->instituteCourseDao->readEmployeeSupervisor($wmid);
   }
   
   public function readTrainingApprovalInDesignationWise($desc){
       return $this->instituteCourseDao->readTrainingApprovalInDesignationWise($desc);
   }
    
}




?>
