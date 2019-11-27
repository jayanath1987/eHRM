<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Recruitment Module Candidate Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class CandidateDao {

    /**
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
     * Executes searchCandidate function
     * 
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @param type $vacancyId
     * @return CommonhrmPager 
     */
    public function searchCandidate($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'c.rec_can_id', $orderBy = 'ASC', $vacancyId) {

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
                ->leftjoin('c.CvAttachment x ON c.rec_can_id=x.rec_can_id')
                ->where('c.rec_req_id=' . $vacancyId);
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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&vacancyId={$vacancyId}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    /**
     *
     * Executes saveCandidate function
     * 
     * @param Candidate $candidate 
     */
    public function saveCandidate(Candidate $candidate, $request) {

        if (strlen($request->getParameter('cmbVacanyTitle'))) {
            $candidate->setRec_req_id(trim($request->getParameter('cmbVacanyTitle')));
        } else {
            $candidate->setRec_req_id(null);
        }
        if (strlen($request->getParameter('txtRefNumber'))) {
            $candidate->setRec_can_reference_no(intval(trim($request->getParameter('txtRefNumber'))));
        } else {
            $candidate->setRec_can_reference_no(null);
        }
        if (strlen($request->getParameter('txtNicNumber'))) {
            $candidate->setRec_can_nic_number(trim($request->getParameter('txtNicNumber')));
        } else {
            $candidate->setRec_can_nic_number(null);
        }
        if (strlen($request->getParameter('txtCandidateName'))) {
            $candidate->setRec_can_candidate_name(trim($request->getParameter('txtCandidateName')));
        } else {
            $candidate->setRec_can_candidate_name(null);
        }
        if (strlen($request->getParameter('txtCandidateNameSi'))) {
            $candidate->setRec_can_candidate_name_si(trim($request->getParameter('txtCandidateNameSi')));
        } else {
            $candidate->setRec_can_candidate_name_si(null);
        }
        if (strlen($request->getParameter('txtCandidateNameTa'))) {
            $candidate->setRec_can_candidate_name_ta(trim($request->getParameter('txtCandidateNameTa')));
        } else {
            $candidate->setRec_can_candidate_name_ta(null);
        }
        if (strlen($request->getParameter('txtAddress'))) {
            $candidate->setRec_can_address(trim($request->getParameter('txtAddress')));
        } else {
            $candidate->setRec_can_address(null);
        }
        if (strlen($request->getParameter('txtAddressSi'))) {
            $candidate->setRec_can_address_si(trim($request->getParameter('txtAddressSi')));
        } else {
            $candidate->setRec_can_address_si(null);
        }
        if (strlen($request->getParameter('txtAddressTa'))) {
            $candidate->setRec_can_address_ta(trim($request->getParameter('txtAddressTa')));
        } else {
            $candidate->setRec_can_address_ta(null);
        }
        if (strlen($request->getParameter('txtTelNumber'))) {
            $candidate->setRec_can_tel_number(trim($request->getParameter('txtTelNumber')));
        } else {
            $candidate->setRec_can_tel_number(null);
        }
        if (strlen($request->getParameter('cmbGender'))) {
            $candidate->setGender_code(trim($request->getParameter('cmbGender')));
        } else {
            $candidate->setGender_code(null);
        }
        if (strlen($request->getParameter('txtDOB'))) {
            $candidate->setRec_can_birthday(trim($request->getParameter('txtDOB')));
        } else {
            $candidate->setRec_can_birthday(null);
        }
        if (strlen($request->getParameter('txtEducationQualification'))) {
            $candidate->setRec_can_edu_qualification(trim($request->getParameter('txtEducationQualification')));
        } else {
            $candidate->setRec_can_edu_qualification(null);
        }
        if (strlen($request->getParameter('txtWorkExperience'))) {
            $candidate->setRec_can_work_experiences(trim($request->getParameter('txtWorkExperience')));
        } else {
            $candidate->setRec_can_work_experiences(null);
        }
        if (strlen($request->getParameter('cmbLanguage'))) {
            $candidate->setLang_code(trim($request->getParameter('cmbLanguage')));
        } else {
            $candidate->setLang_code(null);
        }
        $candidate->setRec_can_interview_marks(0);
        $candidate->save();
    }

    /**
     *
     * Executes getCandidateById function
     * 
     * @param type $id
     * @return type 
     */
    public function getCandidateById($id) {
        $vacancyRequest = Doctrine::getTable('Candidate')->find($id);
        return $vacancyRequest;
    }

    /**
     *
     * Executes readCandidate function
     * 
     * @param type $id
     * @param type $did
     * @return type 
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
     * @return VacancyRequisition 
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
     * @return Candidate 
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
     * @return CvAttachment 
     */
    public function readCandidateCvAttachment($id) {
        $q = Doctrine_Query::create()
                ->select('count(c.rec_cv_attach_id)')
                ->from('CvAttachment c')
                ->where('c.rec_can_id = ?', $id);
        return $q->execute();
    }

    /**
     *
     * Executes getAttachment function
     * 
     * @param type $canId
     * @return CvAttachment 
     */
    public function getAttachment($canId) {
        $q = Doctrine_Query::create()
                ->select('count(t.rec_cv_attach_id)')
                ->from('CvAttachment t')
                ->where('t.rec_can_id=' . $canId);
        return $q->fetchArray();
    }

    /**
     *
     * Executes updatch function
     * 
     * @param type $aid
     * @return CvAttachment 
     */
    public function updatch($aid) {
        $q = Doctrine_Query::create()
                ->delete('CvAttachment t')
                ->where('t.rec_can_id=' . $aid);
        return $q->execute();
    }

    /**
     *
     * Executes readattach function
     * 
     * @param type $atid
     * @return AdvertisementAttachment 
     */
    public function readChargeSheet($id) {

        $q = Doctrine_Query::create()
                ->from('CvAttachment t')
                ->where('t.rec_can_id = ?', array($id));
        return $q->execute();
    }

    /**
     *
     * Executes saveCandidateCvAttachment function
     * 
     * @param CvAttachment $cvAttachment
     * @return $cvAttachment
     */
    public function saveCandidateCvAttachment(CvAttachment $cvAttachment) {
        $cvAttachment->save();
        return true;
    }

    /**
     *
     * Executes updateDGCandidateRequest function
     * 
     * @param type $id
     * @param type $status
     * @return Candidate 
     */
    public function updateDGCandidateRequest($id, $status) {
        $q = Doctrine_Query::create()
                ->update('Candidate')
                ->set('rec_can_interview_status', $status)
                ->where('rec_can_id=' . $id);
        $numUpdated = $q->execute();
        if ($numUpdated > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes readattach function
     * 
     * @param type $atid
     * @return AdvertisementAttachment 
     */
    public function getCvAttachment($id, $adid) {

        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('CvAttachment t')
                ->where('t.rec_cv_attach_id = ?', $id)
                ->andWhere('t.rec_can_id  = ?', $adid);
//die("ss".$id);
        return $q->fetchArray();
    }

    public function deleteImage($id,$adid) {

        $q = Doctrine_Query::create()
                ->delete('hs_hr_rec_cv_attachment p')
                ->where('p.rec_cv_attach_id = ?', $id);

        $q->execute();
        return true;
    }
}

?>
