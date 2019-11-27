<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Recruitment Module VacancyRequisitionService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class VacancyRequisitionService extends BaseService {

    private $vacancyRequisitionDao;

    /**
     * VacancyRequisitionService construct
     */
    public function __construct() {
        $this->vacancyRequisitionDao = new VacancyRequisitionDao();
    }

    

    /**
     *
     * Executes saveVacancyRequisition Service
     * 
     * @param VacancyRequisition $vacancyRequisition
     * @return type 
     */
    public function saveVacancyRequisition(VacancyRequisition $vacancyRequisition,$request) {
        return $this->vacancyRequisitionDao->saveVacancyRequisition($vacancyRequisition,$request);
    }

    /**
     *
     * Executes getVacancyRequisitionList Service
     * 
     * @return type 
     */
    public function getVacancyRequisitionList() {
        return $this->vacancyRequisitionDao->getVacancyRequisitionList();
    }

    /**
     *
     * Executes readVacancyRequisition Service
     * 
     * @param type $id
     * @return type 
     */
    public function readVacancyRequisition($id) {
        return $this->vacancyRequisitionDao->getVacancyRequisitionById($id);
    }

    

    /**
     *
     * Executes getGradeList Service
     * 
     * @return type 
     */
    public function getGradeList() {
        return $this->vacancyRequisitionDao->getGradeList();
    }

    /**
     *
     * Executes getDesignationList Service
     * 
     * @return type 
     */
    public function getDesignationList() {
        return $this->vacancyRequisitionDao->getDesignationList();
    }

    /**
     *
     * Executes getRecruitmentTypeList Service
     * 
     * @return type 
     */
    public function getRecruitmentTypeList() {
        return $this->vacancyRequisitionDao->getRecruitmentTypeList();
    }

}

?>
