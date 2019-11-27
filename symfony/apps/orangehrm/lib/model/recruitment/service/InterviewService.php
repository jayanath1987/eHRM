<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Recruitment Module InterviewService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class InterviewService extends BaseService {

    private $interviewDao;

    /**
     * InterviewService construct
     */
    public function __construct() {
        $this->interviewDao = new InterviewDao();
    }

    

    /**
     * 
     * Executes searchSelectedCanidateInterview Service
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return type 
     */
    public function searchSelectedCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->interviewDao->searchSelectedCanidateInterview($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }

    /**
     *
     * Executes saveInterviewInfo Service
     * 
     * @param Candidate $candidate
     * @return type 
     */
    public function saveInterviewInfo(Candidate $candidate) {
        return $this->interviewDao->saveInterviewInfo($candidate);
    }

    /**
     *
     * Executes getCandidateList Service
     * 
     * @return type 
     */
    public function getCandidateList() {
        return $this->interviewDao->getVacancyRequestList();
    }

    /**
     *
     * Executes readCandidate Service
     * 
     * @param type $id
     * @return type 
     */
    public function readCandidate($id) {
        return $this->interviewDao->getInterviewInfoById($id);
    }

    /**
     *
     * Executes deleteCandidate Service
     *  
     * @param type $id
     * @return type 
     */
    public function deleteCandidate($id) {
        return $this->interviewDao->deleteVacancyRequest($id);
    }

    /**
     *
     * Executes getVacancyTitleList Service
     * 
     * @return type 
     */
    public function getVacancyTitleList() {
        return $this->interviewDao->getVacancyTitleList();
    }

    /**
     *
     * Executes readmaxretid Service
     * 
     * @return type 
     */
    public function readmaxretid() {
        return $this->interviewDao->readmaxretid();
    }

    /**
     * 
     * Executes readCandidateCvAttachment Service
     *
     * @param type $id 
     */
    public function readCandidateCvAttachment($id) {
        
    }

    /**
     *
     * Executes saveCandidateCvAttachment Service
     * 
     * @param CvAttachment $prmattach
     * @return type 
     */
    public function saveCandidateCvAttachment(CvAttachment $prmattach) {
        return $this->interviewDao->saveCandidateCvAttachment($candidate);
    }

    /**
     * 
     * Executes readYearList Service
     *
     * @return type 
     */
    public function readYearList() {
        return $this->interviewDao->readYearList();
    }

    /**
     *
     * Executes isRefNumberNoExists Service
     * 
     * @param type $refNo
     * @return type 
     */
    public function isRefNumberNoExists($refNo) {
        return $this->interviewDao->isRefNumberNoExists($refNo);
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
        return $this->interviewDao->getGenderList($orderField, $orderBy);
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
        return $this->interviewDao->getLanguageList($orderField, $orderBy);
    }

    /**
     *
     * Executes updateDGInterviewRequest Service
     * 
     * @param type $id
     * @param type $status
     * @return type 
     */
    public function updateDGInterviewRequest($id, $status) {
        return $this->interviewDao->updateDGInterviewRequest($id, $status);
    }

    /**
     *
     * Executes updateHRInterviewRequest Service
     * 
     * @param type $id
     * @param type $status
     * @return type 
     */
    public function updateHRInterviewRequest($id, $status) {
        return $this->interviewDao->updateHRInterviewRequest($id, $status);
    }

}

?>
