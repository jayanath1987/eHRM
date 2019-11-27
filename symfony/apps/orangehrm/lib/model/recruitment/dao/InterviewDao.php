<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Recruitment Module Interview Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class InterviewDao {

    /**
     * 
     * Executes getVacancyRequestList function
     *
     * @return VacancyRequest 
     */
    public function getVacancyRequestList() {
        $q = Doctrine_Query::create()
                ->select('V.*')
                ->from('VacancyRequest V');
        return $q->execute();
    }

    
    /**
     *
     * Executes saveInterviewInfo function
     * 
     * @param Candidate $candidate 
     */
    public function saveInterviewInfo(Candidate $candidate) {
        $candidate->save();
    }

    /**
     *
     * Executes deleteInterviewInfo function
     * 
     * @param type $id
     * @return type 
     */
    public function deleteInterviewInfo($id) {
        $q = Doctrine_Query::create()
                ->delete('VacancyRequest')
                ->where('rec_vac_req_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes getInterviewInfoById function
     * 
     * @param type $id
     * @return type 
     */
    public function getInterviewInfoById($id) {
        $vacancyRequest = Doctrine::getTable('Candidate')->find($id);
        return $vacancyRequest;
    }

    /**
     *
     * Executes readCandidate function
     * 
     * @param type $id
     * @param type $did
     * @return Candidate 
     */
    public function readCandidate($id, $did) {
        return Doctrine::getTable('Candidate')->find(array($id, $did));
    }

    /**
     *
     * Executes getGenderList function
     * 
     * @param type $orderField
     * @param type $orderBy
     * @return type 
     */
    public function getGenderList($orderField = 'gender_code', $orderBy = 'ASC') {
        $q = Doctrine_Query::create()
                ->from('Gender')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    /**
     *
     * Executes getLanguageList function
     * 
     * @param type $orderField
     * @param type $orderBy
     * @return type 
     */
    public function getLanguageList($orderField = 'lang_code', $orderBy = 'ASC') {
        $q = Doctrine_Query::create()
                ->from('Language')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    /**
     *
     * Executes getVacancyTitleList function
     * 
     * @return type 
     */
    public function getVacancyTitleList() {
        $q = Doctrine_Query::create()
                ->select('v.rec_req_id,v.rec_req_vacancy_title,v.rec_req_vacancy_title_si,v.rec_req_vacancy_title_ta')
                ->from('VacancyRequisition v')
                ->orderBy('v.rec_req_id');
        return $q->execute();
    }

    /**
     *
     * Executes readmaxretid function
     * 
     * @return type 
     */
    public function readmaxretid() {
        $q = Doctrine_Query::create()
                ->select('MAX(rec_can_id)')
                ->from('Candidate c');
        return $q->execute();
    }

    /**
     *
     * Executes readCandidateCvAttachment function
     * 
     * @param type $id
     * @return type 
     */
    public function readCandidateCvAttachment($id) {
        $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('CvAttachment c')
                ->where('c.rec_can_id = ?', $id);
        return $q->fetchArray();
    }

    /**
     *
     * Executes updatch function
     * 
     * @param type $id
     * @param type $cvId
     * @return type 
     */
    public function updatch($id, $cvId) {

        $q = Doctrine_Query::create()
                ->delete('CvAttachment c')
                ->where('c.rec_can_id = ?', $id)
                ->Andwhere('c.rec_cv_attach_id = ?', $cvId);
        return $q->execute();
    }

    /**
     *
     * Executes saveCandidateCvAttachment function
     * 
     * @param CvAttachment $prmattach
     * @return type 
     */
    public function saveCandidateCvAttachment(CvAttachment $prmattach) {
        $prmattach->save();
        return true;
    }

    /**
     * 
     * Executes updateDGInterviewRequest function
     * 
     * @param type $id
     * @param type $status
     * @return type 
     */
    public function updateDGInterviewRequest($id, $status) {
        $q = Doctrine_Query::create()
                ->update('Candidate')
                ->set('rec_can_interview_status_dg', $status)
                ->where('rec_can_id=' . $id);
        $numUpdated = $q->execute();
        if ($numUpdated > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes updateHRInterviewRequest function
     * 
     * @param type $id
     * @param type $status
     * @return type 
     */
    public function updateHRInterviewRequest($id, $status) {
        $q = Doctrine_Query::create()
                ->update('Candidate c')
                ->set('c.rec_can_interview_status_hr', $status)
                ->where('c.rec_can_id=' . $id);
        $numUpdated = $q->execute();
        if ($numUpdated > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * Executes searchSelectedCanidateInterview function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return CommonhrmPager 
     */
    public function searchSelectedCanidateInterview($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderBy = 'ASC') {

        switch ($searchMode) {
            case "vacancy_title":
                if ($Culture == "en")
                    $feildName = "v.rec_req_vacancy_title";
                else
                    $feildName="v.rec_req_vacancy_title" . $Culture;
                break;
            case "nic_number":
                $feildName = "c.rec_can_nic_number";
                break;
            case "ref_number":
                $feildName = "c.rec_can_reference_no";
                break;
            case "candidates_name":
                $feildName = "c.rec_can_candidate_name";
                break;
            case "gender":
                if ($Culture == "en")
                    $feildName = "g.gender_name";
                else
                    $feildName="g.gender_name" . $Culture;
                break;
            case "marks":
                $feildName = "c.rec_can_interview_marks";
                break;
            case "status":
                $feildName = "c.rec_can_interview_status";
                break;
            case "candidate_name":
                $feildName = "c.rec_can_candidate_name";
                break;
            case "language":
                if ($Culture == "en")
                    $feildName = "l.lang_name";
                else
                    $feildName="l.lang_name" . $Culture;
                break;
        }
        $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('Candidate c')
                ->leftJoin('c.Gender g ON c.gender_code = g.gender_code')
                ->leftJoin('c.Language l ON c.lang_code = l.lang_code')
                ->leftJoin('c.VacancyRequisition v ON c.rec_req_id = v.rec_req_id')
                ->where('c.rec_can_interview_status = 1')
                ->andWhere('c.rec_can_interview_status_hr = 1')
                ->andWhere('c.rec_can_interview_status_dg = 1');
        if ($searchValue != "") {
            $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

}

?>
