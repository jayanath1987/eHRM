<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class TrainingSearchService extends BaseService {

   private $trainSearchDao;

   public function __construct() {

      $this->trainSearchDao = new TrainingSearchDao();
   }

   public function searchinstitute($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->trainSearchDao->searchinstitute($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }
 public function getCourseList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->trainSearchDao->getCourseList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }

     public function searchEmployeeTrainHistory($searchMode, $searchValue, $culture, $page, $orderField, $orderBy,$empID) {
        return $this->trainSearchDao->searchEmployeeTrainHistory($searchMode, $searchValue, $culture, $page, $orderField, $orderBy,$empID);
   }

   public function searchEmployeeTrain($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->trainSearchDao->searchEmployeeTrain($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
   }
    public function searchEmployeeTrainParticipate($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->trainSearchDao->searchEmployeeTrainParticipate($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
   }

}
?>
