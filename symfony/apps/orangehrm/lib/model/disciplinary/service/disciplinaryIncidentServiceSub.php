<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DisciplinaryIncidentServiceSub extends BaseService {
    private $DisciplinaryIncidentDaoSub;

    public function __construct() {
        $this->DisciplinaryIncidentDaoSub = new DisciplinaryIncidentDaoSub();
    }
     public function searchIncidentSummary($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->DisciplinaryIncidentDaoSub->searchIncidentSummary($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }
     public function empDisHistory($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $empId) {
        return $this->DisciplinaryIncidentDaoSub->empDisHistory($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $empId);
    }
    public function searchLevel0($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $closed, $level) {
        return $this->DisciplinaryIncidentDaoSub->searchLevel0($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $closed, $level);
    }
    public function searchLevel1($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $closed, $level) {
        return $this->DisciplinaryIncidentDaoSub->searchLevel1($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $closed, $level);
    }
    public function searchPendingInqSummary($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $closed, $level) {
        return $this->DisciplinaryIncidentDaoSub->searchPendingInqSummary($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $closed, $level);
    }


}

?>
