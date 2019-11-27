<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Recruitment Module CandidateService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class CandidateService extends BaseService {

    private $candidateDao;

    /**
     * CandidateService construct
     */
    public function __construct() {
        $this->candidateDao = new CandidateDao();
    }

    /**
     *
     * Executes readAdvertisement Service
     * 
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @param type $vacancyId
     * @return type 
     */
    public function searchCandidate($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $vacancyId) {
        return $this->candidateDao->searchCandidate($searchMode, $searchValue, $culture="en", $page=1, $orderField = 'c.rec_can_id', $orderBy= 'ASC', $vacancyId);
    }

    /**
     *
     * Executes readAdvertisement Service
     * 
     * @param Candidate $candidate
     * @return type 
     */
    public function saveCandidate(Candidate $candidate, $request) {
        return $this->candidateDao->saveCandidate($candidate, $request);
    }

    /**
     *
     * Executes updateDGCandidateRequest Service
     * 
     * @param type $id
     * @param type $status
     * @return type 
     */
    public function updateDGCandidateRequest($id, $status) {
        return $this->candidateDao->updateDGCandidateRequest($id, $status);
    }

    /**
     *
     * Executes getCandidateList Service
     * 
     * @return type 
     */
    public function getCandidateList() {
        return $this->candidateDao->getVacancyRequestList();
    }

    /**
     * 
     * Executes getAttachment Service
     * 
     * @param type $canId
     * @return type 
     */
    public function getAttachment($canId) {
        return $this->candidateDao->getAttachment($canId);
    }
    
    /**
     * 
     * Executes getAttachment Service
     * 
     * @param type $canId
     * @return type 
     */
    public function getCvAttachment($id, $adid) {
        return $this->candidateDao->getCvAttachment($id, $adid);
    }

      /**
     * 
     * Executes getAttachment Service
     * 
     * @param type $canId
     * @return type 
     */
    public function readChargeSheet($Id) {
        return $this->candidateDao->readChargeSheet($Id);
    }
    
    /**
     *
     * Executes readCandidate Service
     * 
     * @param type $id
     * @return type 
     */
    public function readCandidate($id) {
        return $this->candidateDao->getCandidateById($id);
    }

    /**
     *
     * Executes getVacancyTitleList Service
     * 
     * @return type 
     */
    public function getVacancyTitleList() {
        return $this->candidateDao->getVacancyTitleList();
    }

    /**
     *
     * Executes readmaxretid Service
     * 
     * @return type 
     */
    public function readmaxretid() {
        return $this->candidateDao->readmaxretid();
    }

    /**
     * 
     * Executes readCandidateCvAttachment Service
     *
     * @param type $id
     * @return type 
     */
    public function readCandidateCvAttachment($id) {
        return $this->candidateDao->readCandidateCvAttachment($id);
    }

    /**
     * 
     * Executes updatch Service
     * 
     * @param type $aid
     * @return type 
     */
    public function updatch($aid) {
        return $this->candidateDao->updatch($aid);
    }

    /**
     *
     * @param CvAttachment $cvAttachment
     * @return type 
     */
    public function saveCandidateCvAttachment(CvAttachment $cvAttachment) {

        return $this->candidateDao->saveCandidateCvAttachment($cvAttachment);
    }

    /**
     * 
     * Executes readYearList Service
     *
     * @return type 
     */
    public function readYearList() {
        return $this->candidateDao->readYearList();
    }

    /**
     *
     * Executes updateVacancyRequestStatus Service
     * 
     * @param type $id
     * @param type $status
     * @param type $field
     * @return type 
     */
    public function updateVacancyRequestStatus($id, $status, $field) {
        return $this->candidateDao->updateVacancyRequestStatus($id, $status, $field);
    }

    /**
     *
     * Executes isRefNumberNoExists Service
     * 
     * @param type $refNo
     * @return type 
     */
    public function isRefNumberNoExists($refNo) {
        return $this->candidateDao->isRefNumberNoExists($refNo);
    }

    /**
     *
     * Executes getGenderList Service
     * 
     * @param type $orderField
     * @param type $orderBy
     * @return type 
     */
    public function getGenderList($orderField = 'gender_code', $orderBy = 'ASC') {
        return $this->candidateDao->getGenderList($orderField, $orderBy);
    }

    /**
     *
     * Executes getLanguageList Service
     * 
     * @param type $orderField
     * @param type $orderBy
     * @return type 
     */
    public function getLanguageList($orderField = 'lang_code', $orderBy = 'ASC') {
        return $this->candidateDao->getLanguageList($orderField, $orderBy);
    }
    
        /**
     *
     * Executes updatch Service
     * 
     * @param type $aid
     * @return type 
     */
    public function deleteImage($aid, $adid) {
        return $this->candidateDao->deleteImage($aid);
    }
    
    public function deleteImage2($aid) {
        return $this->candidateDao->deleteImage2($aid);
    }
}

?>
