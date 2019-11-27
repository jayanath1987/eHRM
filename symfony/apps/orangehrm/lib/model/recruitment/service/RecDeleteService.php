<?php

/**
 * -------------------------------------------------------------------------------------------------------
*  Author    - Jayanath Liyanage
 *  On (Date) - 19 Oct 2011
 *  Comments   - Recruitment Module InterviewService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class RecDeleteService extends BaseService {

    private $RecDeleteDao;

    /**
     * InterviewService construct
     */
    public function __construct() {
        $this->RecDeleteDao = new RecDeleteDao();
    }

    /**
     *
     * Executes deleteVacancyRequisition Service
     *
     * @param type $id
     * @return type
     */
    public function deleteVacancyRequisition($id) {
        return $this->RecDeleteDao->deleteVacancyRequisition($id);
    }

     /**
     *
     * Executes deleteAdvertisement Service
     *
     * @param type $id
     * @return type
     */
    public function deleteAdvertisement($id) {
        return $this->RecDeleteDao->deleteAdvertisement($id);
    }

     /**
     *
     * Executes deleteCandidate Service
     *
     * @param type $id
     * @return type
     */
    public function deleteCandidate($id) {
        return $this->RecDeleteDao->deleteCandidate($id);
    }

    

}

?>
