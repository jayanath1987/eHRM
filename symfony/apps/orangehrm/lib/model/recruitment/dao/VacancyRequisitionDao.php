<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Recruitment Module Vacancy Requisition Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class VacancyRequisitionDao extends BaseDao {

    
    /**
     *
     * Executes saveVacancyRequisition function
     * 
     * @param VacancyRequisition $vacancyRequisition 
     */
    public function saveVacancyRequisition(VacancyRequisition $VacancyRequisition,$request) {

        if (strlen($request->getParameter('txtRefNumber'))) {
                    $VacancyRequisition->setRec_req_ref_number(trim($request->getParameter('txtRefNumber')));
                } else {
                    $VacancyRequisition->setRec_req_ref_number(null);
                }
                if (strlen($request->getParameter('txtVacancyTitle'))) {
                    $VacancyRequisition->setRec_req_vacancy_title(trim($request->getParameter('txtVacancyTitle')));
                } else {
                    $VacancyRequisition->setRec_req_vacancy_title(null);
                }
                if (strlen($request->getParameter('txtVacancyTitleSi'))) {
                    $VacancyRequisition->setRec_req_vacancy_title_si(trim($request->getParameter('txtVacancyTitleSi')));
                } else {
                    $VacancyRequisition->setRec_req_vacancy_title_si(null);
                }
                if (strlen($request->getParameter('txtVacancyTitleTa'))) {
                    $VacancyRequisition->setRec_req_vacancy_title_ta(trim($request->getParameter('txtVacancyTitleTa')));
                } else {
                    $VacancyRequisition->setRec_req_vacancy_title_ta(null);
                }
                if (strlen($request->getParameter('txtYear'))) {
                    $VacancyRequisition->setRec_req_year(trim($request->getParameter('txtYear')));
                } else {
                    $VacancyRequisition->setRec_req_year(null);
                }
                if (strlen($request->getParameter('txtDivisionid'))) {
                    $VacancyRequisition->setCmp_stur_id(trim($request->getParameter('txtDivisionid')));
                } else {
                    $VacancyRequisition->setCmp_stur_id(null);
                }
                if (strlen($request->getParameter('cmbGrade'))) {
                    $VacancyRequisition->setGrade_code(trim($request->getParameter('cmbGrade')));
                } else {
                    $VacancyRequisition->setGrade_code(null);
                }
                if (strlen($request->getParameter('cmbDesignation'))) {
                    $VacancyRequisition->setJobtit_code(trim($request->getParameter('cmbDesignation')));
                } else {
                    $VacancyRequisition->setJobtit_code(null);
                }
                if (strlen($request->getParameter('txtRecruitmentType'))) {
                    $VacancyRequisition->setRec_req_recruitment_type(trim($request->getParameter('txtRecruitmentType')));
                } else {
                    $VacancyRequisition->setRec_req_recruitment_type(null);
                }
                if (strlen($request->getParameter('txtReportTo'))) {
                    $VacancyRequisition->setReport_to(trim($request->getParameter('txtReportTo')));
                } else {
                    $VacancyRequisition->setReport_to(null);
                }
                if (strlen($request->getParameter('cmbEmploymentType'))) {
                    $VacancyRequisition->setEstat_code(trim($request->getParameter('cmbEmploymentType')));
                } else {
                    $VacancyRequisition->setEstat_code(null);
                }
                if (strlen($request->getParameter('txtQualification'))) {
                    $VacancyRequisition->setRec_req_qualification(trim($request->getParameter('txtQualification')));
                } else {
                    $VacancyRequisition->setRec_req_qualification(null);
                }
                if (strlen($request->getParameter('txtQualificationSi'))) {
                    $VacancyRequisition->setRec_req_qualification_si(trim($request->getParameter('txtQualificationSi')));
                } else {
                    $VacancyRequisition->setRec_req_qualification_si(null);
                }
                if (strlen($request->getParameter('txtQualificationTa'))) {
                    $VacancyRequisition->setRec_req_qualification_ta(trim($request->getParameter('txtQualificationTa')));
                } else {
                    $VacancyRequisition->setRec_req_qualification_ta(null);
                }
                if (strlen($request->getParameter('txtOpeningDate'))) {
                    $VacancyRequisition->setRec_req_opening_date(trim($request->getParameter('txtOpeningDate')));
                } else {
                    $VacancyRequisition->setRec_req_opening_date(null);
                }
                if (strlen($request->getParameter('txtClosingDate'))) {
                    $VacancyRequisition->setRec_req_closing_date(trim($request->getParameter('txtClosingDate')));
                } else {
                    $VacancyRequisition->setRec_req_closing_date(null);
                }
                if (strlen($request->getParameter('txtReqNoVacancies'))) {
                    $VacancyRequisition->setRec_req_requested_vacancies(trim($request->getParameter('txtReqNoVacancies')));
                } else {
                    $VacancyRequisition->setRec_req_requested_vacancies(null);
                }
                if (strlen($request->getParameter('txtApprovedNoVacancies'))) {
                    $VacancyRequisition->setRec_req_approved_vacancies(trim($request->getParameter('txtApprovedNoVacancies')));
                } else {
                    $VacancyRequisition->setRec_req_approved_vacancies(null);
                }

                $VacancyRequisition->save();
    }

    /**
     * 
     * Executes getVacancyRequisitionList function
     *
     * @return type 
     */
    public function getVacancyRequisitionList() {
        $q = Doctrine_Query::create()
                ->select('v.*')
                ->from('VacancyRequisition v');
        return $q->execute();
    }

    /**
     * 
     * Executes getVacancyRequisitionById function
     *
     * @param type $id
     * @return type 
     */
    public function getVacancyRequisitionById($id) {
        $vacancyRequest = Doctrine::getTable('VacancyRequisition')->find($id);
        return $vacancyRequest;
    }
   

    /**
     *
     * Executes getGradeList function
     * 
     * @return type 
     */
    public function getGradeList() {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('Grade g');
        return $q->execute();
    }

    /**
     *
     * Executes getDesignationList function
     * 
     * @return type 
     */
    public function getDesignationList() {
        $q = Doctrine_Query::create()
                ->select('j.*')
                ->from('JobTitle j');
        return $q->execute();
    }

    /**
     * 
     * Executes getRecruitmentTypeList function
     *
     * @return type 
     */
    public function getRecruitmentTypeList() {
        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('EmployeeStatus s')
                ->orderBy('s.estat_code');
        return $q->execute();
    }

    /**
     * 
     * Executes isRefNumberNoExists function
     *
     * @param type $refNo
     * @return type 
     */
    public function isRefNumberNoExists($refNo) {

        $q = Doctrine_Query::create()
                ->select('count(v.rec_req_ref_number)')
                ->from('VacancyRequisition v')
                ->where('v.rec_req_ref_number =?', array($refNo));
        return $q->fetchArray();
    }

}

?>
