<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class DisTypeOffceSubService extends BaseService {

    private $disTypeOffenceSubDao;

    public function __construct() {
        $this->disTypeOffenceSubDao = new DisTypeOffenceSubDao();
    }

    public function searchActionType($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->disTypeOffenceSubDao->searchActionType($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }
     public function searchOffence($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->disTypeOffenceSubDao->searchOffence($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }
}

?>
