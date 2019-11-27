<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class ParticipateAssignTrainService extends BaseService {

   private $partiAssignDao;

   public function __construct() {
       
      $this->partiAssignDao = new ParticipateAssignTrainDao();
   }
   public function getGeneralComment($id){
       return $this->partiAssignDao->getGeneralComment($id);
   }
   
   public function loadCourseList($id){
       return $this->partiAssignDao->loadCourseList($id);
   }
   public function getAllCourseList($id){
       return $this->partiAssignDao->getAllCourseList($id);
   }
   public function UpdateCommentAssign($id, $comment_en, $culture){
       return $this->partiAssignDao->UpdateCommentAssign($id, $comment_en, $culture);
   }
   public function checkAssignedcourse($courseID, $employeeID){
       return $this->partiAssignDao->checkAssignedcourse($courseID, $employeeID);
   }
   public function saveAssignList(TrainAssign $trainass) {
       return $this->partiAssignDao->saveAssignList($trainass);
   }
   public function updateAssignList($empid, $courid, $isparti, $comment, $year, $generalComment) {
       return $this->partiAssignDao->updateAssignList($empid, $courid, $isparti, $comment, $year, $generalComment);
   }
   public function updateAssignListParticipate($empid, $courid, $isparti, $comment, $year, $generalComment) {
       return $this->partiAssignDao->updateAssignListParticipate($empid, $courid, $isparti, $comment, $year, $generalComment);
   }
   public function getcheckCourse($id){
       return $this->partiAssignDao->getcheckCourse($id);
   }
   public function GetListedEmpids($id) {
       return $this->partiAssignDao->GetListedEmpids($id);
   }
   public function getDistinctTrainYear(){
       return $this->partiAssignDao->getDistinctTrainYear();
   }
   public function getDivHeadorApprover($empid) {
        return $this->partiAssignDao->getDivHeadorApprover($empid);
   }
   public function LoadEmployeeDetails($id) {
        return $this->partiAssignDao->LoadEmployeeDetails($id);
   }
   public function getEmployee($insList = array()) {
        return $this->partiAssignDao->getEmployee($insList);
   }
  
   public function getCompanyStructureDetailRole($empid,$Role){
       return $this->partiAssignDao->getCompanyStructureDetailRole($empid,$Role);
   }
   
   public function readworkflowdeleteAssign($cId, $empID){
       return $this->partiAssignDao->readworkflowdeleteAssign($cId, $empID);
   }
   
   public function readworkflowmain($wmid, $wmsq){
       return $this->partiAssignDao->readworkflowmain($wmid, $wmsq);
   }
   
   public function readworkflowmainappperson($wmid){
       return $this->partiAssignDao->readworkflowmainappperson($wmid);
   }
   

   
   
   
}
