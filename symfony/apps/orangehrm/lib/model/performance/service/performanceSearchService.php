<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Performance Module TransferService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class PerformanceSearchService extends BaseService {

    private $PerformanceSearchDao;

    public function __construct() {
        $this->PerformanceSearchDao = new PerformanceSearchDao();
    }

  public function searchDutyGroup($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->PerformanceSearchDao->searchDutyGroup($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }

      public function searchDuty($searchMode, $searchValue, $culture, $orderField, $orderBy, $pag) {
        return $this->PerformanceSearchDao->searchDuty($searchMode, $searchValue, $culture, $orderField, $orderBy, $pag);
    }

     public function searchRate($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->PerformanceSearchDao->searchRate($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }

     public function searchEvaluationCompanyInfo($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->PerformanceSearchDao->searchEvaluationCompanyInfo($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }

       public function searchAssingEmployee($searchMode, $searchValue, $culture, $orderField, $orderBy, $page, $searchEvaluation, $searchEvaluationType) {
        return $this->PerformanceSearchDao->searchAssingEmployee($searchMode, $searchValue, $culture, $orderField, $orderBy, $page, $searchEvaluation, $searchEvaluationType);
    }

    public function searchEvaluation($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->PerformanceSearchDao->searchEvaluation($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
     public function searchSDOEvaluation($searchMode, $searchValue, $culture, $orderField, $orderBy, $page, $searchEvaluation, $searchEvaluationType) {
        return $this->PerformanceSearchDao->searchSDOEvaluation($searchMode, $searchValue, $culture, $orderField, $orderBy, $page, $searchEvaluation, $searchEvaluationType);
    }

      public function searchEmployee($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $type, $method, $reason, $att, $EVid, $ETid) {
        return $this->PerformanceSearchDao->searchEmployee($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $type, $method, $reason, $att, $EVid, $ETid);
    }

       public function getUpdatedutyObj($request,$Duty) {
        return $this->PerformanceSearchDao->getUpdatedutyObj($request,$Duty);
    }


}


?>
