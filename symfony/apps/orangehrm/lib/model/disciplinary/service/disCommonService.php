<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DisCommonService extends BaseService {

    private $DisCommonDao;

    public function __construct() {
        $this->DisCommonDao = new DisCommonDao();
    }

    public function deleteActiontype($id) {
      return $this->DisCommonDao->deleteActiontype($id);
  }
  public function searchFinalAction($searchMode, $searchValue, $culture,$orderField, $orderBy, $page) {
        return $this->DisCommonDao->searchFinalAction($searchMode, $searchValue, $culture,$orderField, $orderBy, $page);
    }

}
?>