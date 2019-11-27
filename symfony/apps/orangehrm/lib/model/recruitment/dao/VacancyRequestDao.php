<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Recruitment Module VacancyRequest Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class VacancyRequestDao extends BaseDao {

    /**
     *
     * Executes getVacancyRequestList function
     * 
     * @return type 
     */
    public function getVacancyRequestList() {
        $q = Doctrine_Query::create()
                ->select('V.*')
                ->from('VacancyRequest V');
        return $q->execute();
    }
    
    

    /**
     *
     * Executes saveVacancyRequest function
     * 
     * @param VacancyRequest $vacancyRequest
     * @return type 
     */
    public function saveVacancyRequest(VacancyRequest $vacancyRequest) {
        $vacancyRequest->save();
        return true;
    }

    

    /**
     *
     * Executes getVacancyRequestById function
     * 
     * @param type $id
     * @return type 
     */
    public function getVacancyRequestById($id) {
        $vacancyRequest = Doctrine::getTable('VacancyRequest')->find($id);
        return $vacancyRequest;
    }

    /**
     *
     * Executes readEmployee function
     * 
     * @param type $id
     * @return type 
     */
    public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    /**
     * 
     * Executes readYearList function
     *
     * @return type 
     */
    public function readYearList() {
        return $q = range(date('Y'), date('Y') + 20);
    }

    /**
     * 
     * Executes updateVacancyRequestStatus function
     *
     * @param type $id
     * @param type $status
     * @param type $field
     * @return type 
     */
    public function updateVacancyRequestStatus($id, $status, $field) {

        switch ($field) {
            case "user_flag":
                $feildName = "rec_vac_is_submit";
                break;
            case "hr_flag":
                $feildName = "rec_vac_is_submit";
                break;
            case "dg_flag":
                $feildName = "rec_vac_is_submit";
                break;
        }
        $q = Doctrine_Query::create()
                ->update('VacancyRequest');
        if ($field != "") {
            $q->set($feildName . '=', $status);
        }
        $q->where('rec_vac_req_id=' . $id);
        $numUpdated = $q->execute();
        if ($numUpdated > 0) {
            return true;
        }
        return false;
    }

    
    /**
     * 
     * Executes updateHRVacancyRequest function
     *
     * @param type $id
     * @param type $noOfVacancies
     * @return type 
     */
    public function updateHRVacancyRequest($id, $noOfVacancies) {
        $q = Doctrine_Query::create()
                ->update('VacancyRequest')
                ->set('rec_vac_no_of_vacancies_by_hr', $noOfVacancies)
                ->where('rec_vac_req_id=' . $id);
        $numUpdated = $q->execute();
        if ($numUpdated > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes updateDGVacancyRequest function
     * 
     * @param type $id
     * @param type $noOfVacancies
     * @return type 
     */
    public function updateDGVacancyRequest($id, $noOfVacancies) {
        $q = Doctrine_Query::create()
                ->update('VacancyRequest')
                ->set('rec_vac_no_of_vacancies_by_dg', $noOfVacancies)
                ->where('rec_vac_req_id=' . $id);
        $numUpdated = $q->execute();
        if ($numUpdated > 0) {
            return true;
        }
        return false;
    }

   



}

?>
