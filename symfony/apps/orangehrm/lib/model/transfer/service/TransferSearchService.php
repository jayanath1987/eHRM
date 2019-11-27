<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Transfer Module TransferService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class TransferSearchService extends BaseService {

    private $transfersearchDao;

    /**
     * TransferService construct
     */
    public function __construct() {
        $this->transfersearchDao = new TransferSearchDao();
    }

    /**
     *
     * Executes searchTransferReason Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $userCulture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchTransferReason($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'r.trans_reason_id', $orderBy = 'ASC') {
        return $this->transfersearchDao->searchTransferReason($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy);
    }

      /**
     *
     * Executes searchTransferRequest Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $userCulture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @param type $user
     * @return type
     */
    public function searchTransferRequest($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'tr.trans_req_id', $orderBy = 'ASC', $user) {
        return $this->transfersearchDao->searchTransferRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $user);
    }
    public function searchTransferRequestAdmin($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'tr.trans_req_id', $orderBy = 'ASC', $user) {
        return $this->transfersearchDao->searchTransferRequestAdmin($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $user);
    }


     /**
     *
     * Executes searchTransferDetails Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $userCulture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchTransferDetails($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'r.trans_reason_id', $orderBy = 'ASC') {
        return $this->transfersearchDao->searchTransferDetails($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy);
    }

}

?>