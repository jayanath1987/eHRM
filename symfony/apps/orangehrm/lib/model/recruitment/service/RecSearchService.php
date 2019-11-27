<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Recruitment Module CandidateService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class RecSearchService extends BaseService {

    private $RecSearchDao;

    /**
     * CandidateService construct
     */
    public function __construct() {
        $this->RecSearchDao = new RecSearchDao();
    }

    /**
     *
     * Executes searchVacancyRequest Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderField2
     * @param type $orderBy
     *
     * @return type
     */
    public function searchVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderField2, $orderBy) {
        return $this->RecSearchDao->searchVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderField2, $orderBy);
    }

    /**
     *
     * Executes deleteVacanyRequest Service
     *
     * @param type $id
     * @return type
     */
    public function deleteVacanyRequest($id) {
        return $this->RecSearchDao->deleteVacancyRequest($id);
    }
    
    /**
     *
     * Executes searchHRVacancyRequest Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchHRVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchHRVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderField2, $orderBy);
    }

     /**
     *
     * Executes searchDGVacancyRequest Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchDGVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchDGVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderField2, $orderBy);
    }

    /**
     *
     * Executes searchOverallVacancyRequest Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchOverallVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchOverallVacancyRequest($searchMode, $searchValue, $culture, $page, $orderField, $orderField2, $orderBy);
    }
    
    /**
     *
     * Executes searchVacancyRequisition Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchVacancyRequisition($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchVacancyRequisition($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }

    /**
     *
     * Executes searchAdvertisement Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     *
     * @return type
     */
    public function searchAdvertisement($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchAdvertisement($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }

    /**
     *
     * Executes searchCanidateInterview Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }
  /**
     *
     * Executes searchHRCanidateInterview Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchHRCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchHRCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }

    /**
     *
     * Executes searchDGCanidateInterview Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type
     */
    public function searchDGCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->RecSearchDao->searchDGCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }

    
}

?>