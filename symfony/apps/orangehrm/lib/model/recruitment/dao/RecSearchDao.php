<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Recruitment Module Candidate Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class RecSearchDao {

    /**
     *
     * Executes searchVacancyRequest function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderField2
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchVacancyRequest($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderField2 = 'r.rec_vac_year', $orderBy = 'ASC') {

        switch ($searchMode) {
            case "rec_vac_vacancy_title":
                if ($Culture == "en")
                    $feildName = "r.rec_vac_vacancy_title";
                else
                    $feildName="r.rec_vac_vacancy_title" . $Culture;
                break;
            case "emp_display_name":
                if ($Culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name" . $Culture;
                break;
            case "rec_vac_year":
                $feildName = "r.rec_vac_year";
                break;
            case "no_of_vacancies":
                $feildName = "r.rec_vac_no_of_vacancies";
                break;
        }
        $q = Doctrine_Query::create()
                ->select('r.*')
                ->from('VacancyRequest r')
                ->innerJoin('r.Employee e ON e.emp_number = r.emp_number');
        if ($searchValue != "") {
            $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ', ' . $orderField2 . ' ' . $orderBy);


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

    /**
     *
     * Executes deleteVacancyRequest function
     *
     * @param type $id
     * @return type
     */
    public function deleteVacancyRequest($id) {
        $q = Doctrine_Query::create()
                ->delete('VacancyRequest')
                ->where('rec_vac_req_id= ?', $id)
                ->Andwhere('rec_vac_is_submit = 0');
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes searchHRVacancyRequest function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderField2
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchHRVacancyRequest($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderField2 = 'r.rec_vac_year', $orderBy = 'ASC') {

        switch ($searchMode) {
            case "vac_title":
                if ($Culture == "en")
                    $feildName = "r.rec_vac_vacancy_title";
                else
                    $feildName="r.rec_vac_vacancy_title" . $Culture;
                break;
            case "emp_display_name":
                if ($Culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name" . $Culture;
                break;
            case "year":
                $feildName = "r.rec_vac_year";
                break;
            case "no_of_vacancies":
                $feildName = "r.rec_vac_no_of_vacancies";
                break;
        }
        $q = Doctrine_Query::create()
                ->select('r.*')
                ->from('VacancyRequest r')
                ->leftJoin('r.Employee e ON r.emp_number = e.emp_number')
                ->where('r.rec_vac_is_submit = 1');

        if ($searchValue != "") {
            $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ', ' . $orderField2 . ' ' . $orderBy);

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

    /**
     *
     * Executes searchDGVacancyRequest function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderField2
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchDGVacancyRequest($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderField2 = 'r.rec_vac_year', $orderBy = 'ASC') {

        switch ($searchMode) {
            case "vac_title":
                if ($Culture == "en")
                    $feildName = "r.rec_vac_vacancy_title";
                else
                    $feildName="r.rec_vac_vacancy_title" . $Culture;
                break;
            case "emp_display_name":
                if ($Culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name" . $Culture;
                break;
            case "year":
                $feildName = "r.rec_vac_year";
                break;
            case "no_of_vacancies":
                $feildName = "r.rec_vac_no_of_vacancies";
                break;
        }
        $q = Doctrine_Query::create()
                ->select('r.*')
                ->from('VacancyRequest r')
                ->leftJoin('r.Employee e ON r.emp_number = e.emp_number')
                ->where('r.rec_vac_is_submit = 2');
        if ($searchValue != "") {
            $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ', ' . $orderField2 . ' ' . $orderBy);

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

    /**
     *
     * Executes searchOverallVacancyRequest function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderField2
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchOverallVacancyRequest($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderField2 = 'r.rec_vac_year', $orderBy = 'ASC') {

        switch ($searchMode) {
            case "ref_number":
                $feildName = "r.rec_vac_ref_number";
                break;
            case "vac_title":
                if ($Culture == "en")
                    $feildName = "r.rec_vac_vacancy_title";
                else
                    $feildName="r.rec_vac_vacancy_title" . $Culture;
                break;
            case "emp_display_name":
                if ($Culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name" . $Culture;
                break;
            case "year":
                $feildName = "r.rec_vac_year";
                break;
            case "no_of_vacancies":
                $feildName = "r.rec_vac_no_of_vacancies";
                break;
        }
        $q = Doctrine_Query::create()
                ->select('r.*')
                ->from('VacancyRequest r')
                ->leftJoin('r.Employee e ON r.emp_number = e.emp_number')
                ->where('r.rec_vac_is_submit != 0');
        if ($searchValue != "") {
            $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ', ' . $orderField2 . ' ' . $orderBy);

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

    /**
     *
     * Executes searchVacancyRequisition function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchVacancyRequisition($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'v.rec_req_id', $orderBy = 'ASC') {

        $empnum = $_SESSION['empNumber'];

        switch ($searchMode) {

            case "rec_req_ref_number":
                $feildName = "v.rec_req_ref_number";
                break;
            case "rec_req_vacancy_title":
                if ($Culture == "en")
                    $feildName = "v.rec_req_vacancy_title";
                else
                    $feildName="v.rec_req_vacancy_title" . $Culture;
                break;
            case "rec_req_year":
                $feildName = "v.rec_req_year";
                break;
            case "cmp_stur_id":
                if ($Culture == "en")
                    $feildName = "c.title";
                else
                    $feildName="c.title" . $Culture;
                break;
            case "grade_code":
                if ($Culture == "en")
                    $feildName = "g.grade_name";
                else
                    $feildName="g.grade_name" . $Culture;
                break;
            case "jobtit_code":
                if ($Culture == "en")
                    $feildName = "j.name";
                else
                    $feildName="j.name" . $Culture;
                break;
            case "estat_code":
                if ($Culture == "en")
                    $feildName = "e.estat_name";
                else
                    $feildName="e.estat_name" . $Culture;
                break;
        }
        $q = Doctrine_Query::create()
                ->select('v.*,g.*,j.*,c.*')
                ->from('VacancyRequisition v')
                ->leftJoin('v.CompanyStructure c ON v.cmp_stur_id = c.id')
                ->leftJoin('v.Grade g ON v.grade_code = g.grade_code')
                ->leftJoin('v.EmployeeStatus e ON v.estat_code = e.estat_code')
                ->leftJoin('v.JobTitle j ON v.jobtit_code = j.jobtit_code');

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

    /**
     *
     * Executes searchAdvertisement function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $userCulture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchAdvertisement($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'a.rec_adv_id', $orderBy = 'ASC') {

        switch ($searchMode) {
            case "vacancy_title":
                if ($userCulture == "en")
                    $feildName = "v.rec_req_vacancy_title";
                else
                    $feildName="v.rec_req_vacancy_title_" . $userCulture;
                break;
            case "opening_date":
                $feildName = "a.rec_adv_opening_date";
                break;
            case "closing_date":
                $feildName = "a.rec_adv_closing_date";
                break;
        }
        $q = Doctrine_Query::create()
                ->select('a.*')
                ->from('Advertisement a')
                ->leftJoin('a.VacancyRequisition v ON a.rec_req_id = v.rec_req_id');
        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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

    /**
     *
     * Executes searchCanidateInterview function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchCanidateInterview($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderBy = 'ASC') {

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
                ->leftJoin('c.VacancyRequisition v ON c.rec_req_id = v.rec_req_id');
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

    /**
     *
     * Executes searchCanidateInterview function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchHRCanidateInterview($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderBy = 'ASC') {

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
                ->where('c.rec_can_interview_status  = 1');
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

    /**
     *
     * Executes searchCanidateInterview function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     *
     * @return CommonhrmPager
     */
    public function searchDGCanidateInterview($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'r.rec_vac_req_id', $orderBy = 'ASC') {

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
                ->where('c.rec_can_interview_status_hr = 1');

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