<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Oct 2011
 *  Comments  - Recruitment Module Interview Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class RecDeleteDao {

     /**
     *
     * Executes deleteVacancyRequisition function
     *
     * @param type $id
     * @return type
     */
    public function deleteVacancyRequisition($id) {

        $q = Doctrine_Query::create()
                ->delete('VacancyRequisition')
                ->where('rec_req_id= ?', $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes deleteAdvertisement function
     *
     * @param type $id
     * @return Advertisement
     */
    public function deleteAdvertisement($id) { 
        $q = Doctrine_Query::create()
                ->delete('Advertisement a')
                ->where('a.rec_adv_id = ?', $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes deleteCandidate function
     *
     * @param type $id
     * @return type
     */
    public function deleteCandidate($id) {
        $q = Doctrine_Query::create()
                ->delete('Candidate')
                ->where('rec_can_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    
}



?>
