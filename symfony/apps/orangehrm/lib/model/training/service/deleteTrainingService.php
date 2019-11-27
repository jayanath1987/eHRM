<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DeleteTrainingService extends BaseService {

   private $deleteTrainingDao;

   public function __construct() {
      $this->deleteTrainingDao = new deleteTrainingDao();
   }
   public function deleteInstitute($id){
        return $this->deleteTrainingDao->deleteInstitute($id);
    }

     public function deleteCourse($id){
        return $this->deleteTrainingDao->deleteCourse($id);
    }

     public function deleteSavedAssign($cId, $empID) {
        return $this->deleteTrainingDao->deleteSavedAssign($cId, $empID);
   }

    public function deleteWfMainAppPerson($wmid){
       return $this->deleteTrainingDao->deleteWfMainAppPerson($wmid);
   }

   public function deleteWfMain($wmid){
       return $this->deleteTrainingDao->deleteWfMain($wmid);
   }

     public function deleteTrainingPlan($id) {
       return $this->deleteTrainingDao->deleteTrainingPlan($id);
   }


}
?>
