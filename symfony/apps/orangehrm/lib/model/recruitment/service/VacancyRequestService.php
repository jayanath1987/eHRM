<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Recruitment Module VacancyRequest Services Data Access CRUD operation.
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class VacancyRequestService extends BaseService {

    private $vacancyRequestDao;

    /**
     * VacancyRequestService construct
     */
    public function __construct() {
        $this->vacancyRequestDao = new VacancyRequestDao();
    }


    /**
     *
     * Executes saveVacanyRequest Service
     * 
     * @param VacancyRequest $vacancyRequest
     * @return type 
     */
    public function saveVacanyRequest(VacancyRequest $vacancyRequest) {
        return $this->vacancyRequestDao->saveVacancyRequest($vacancyRequest);
    }

    /**
     *
     * Executes getVacanyRequestList Service
     * 
     * @return type 
     */
    public function getVacanyRequestList() {
        return $this->vacancyRequestDao->getVacancyRequestList();
    }

    /**
     *
     * Executes readVacanyRequest Service
     * 
     * @param type $id
     * @return type 
     */
    public function readVacanyRequest($id) {
        return $this->vacancyRequestDao->getVacancyRequestById($id);
    }

    

    /**
     *
     * Executes readEmployee Service
     * 
     * @param type $id
     * @return type 
     */
    public function readEmployee($id) {
        return $this->vacancyRequestDao->readEmployee($id);
    }

    /**
     *
     * Executes readYearList Service
     * 
     * @return type 
     */
    public function readYearList() {
        return $this->vacancyRequestDao->readYearList();
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
        return $this->vacancyRequestDao->updateVacancyRequestStatus($id, $status, $field);
    }

    

    /**
     *
     * Executes updateHRVacancyRequest Service
     * 
     * @param type $id
     * @param type $noOfVacancies
     * @return type 
     */
    public function updateHRVacancyRequest($id, $noOfVacancies) {
        return $this->vacancyRequestDao->updateHRVacancyRequest($id, $noOfVacancies);
    }

    /**
     *
     * Executes updateDGVacancyRequest Service
     * 
     * @param type $id
     * @param type $noOfVacancies
     * @return type 
     */
    public function updateDGVacancyRequest($id, $noOfVacancies) {
        return $this->vacancyRequestDao->updateDGVacancyRequest($id, $noOfVacancies);
    }

   

    

    /**
     *
     * Executes isRefNumberNoExists Service
     * 
     * @param type $refNo
     * @return type 
     */
    public function isRefNumberNoExists($refNo) {
        return $this->vacancyRequestDao->isRefNumberNoExists($refNo);
    }

}

?>
