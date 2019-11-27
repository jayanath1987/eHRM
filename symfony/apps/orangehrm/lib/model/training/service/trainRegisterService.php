<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class TrainingRegisterService extends BaseService {

   private $trainRegiDao;

   public function __construct() {
       
      $this->trainRegiDao = new TrainingRegisterDao();
   }
   public function EmployeeTrainingHistory($empid, $courid, $isparti, $comment, $year, $generalComment) {
       return $this->trainRegiDao->EmployeeTrainingHistory($empid, $courid, $isparti, $comment, $year, $generalComment);
   }
   
   public function countAssignedcourse($cid, $empid) {
        return $this->trainRegiDao->countAssignedcourse($cid, $empid);
   }
   
    public function deleteTrainRecord($cousId, $empId) {
        return $this->trainRegiDao->deleteTrainRecord($cousId, $empId);
    }
    public function getTrainList($empid, $courid, $isparti, $comment, $year, $generalComment) {
       return $this->trainRegiDao->getTrainList($empid, $courid, $isparti, $comment, $year, $generalComment);
   }
   public function getTPlanIdByID($id) {
       return $this->trainRegiDao->getTPlanIdByID($id);
   }
   public function saveTrainingPlan($trainingPlan) {
       return $this->trainRegiDao->saveTrainingPlan($trainingPlan);
   }
   public function getLastTrainigPlanID() {
        return $this->trainRegiDao->getLastTrainigPlanID();
   }
   public function getTrainingPlanList($empid, $courid, $isparti, $comment, $year, $generalComment) {
       return $this->trainRegiDao->getTrainingPlanList($empid, $courid, $isparti, $comment, $year, $generalComment);
   }
 
   
   public function readCourse() {
       return $this->trainRegiDao->readCourse();
   }
   
}


?>