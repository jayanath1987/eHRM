<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage, Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Performance Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class PerformanceSearchDao extends BaseDao {

    //DutyGroup
    public function searchDutyGroup($searchMode, $searchValue, $culture="en", $orderField = 'dg.dtg_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "dtg_name_") {
            if ($culture == "en")
                $feildName = "dg.dtg_name";
            else
                $feildName="dg.dtg_name_" . $culture;
        }else if ($searchMode == "dtg_code") {
            $feildName = "dg.dtg_code";
        }
        $q = Doctrine_Query::create()
                ->select('dg.*')
                ->from('PerformanceDutyGroup dg');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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

     //DutygetEvaluationAssignDutyList
    public function searchDuty($searchMode, $searchValue, $culture="en", $orderField = 'd.dut_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "dut_name_") {
            if ($culture == "en")
                $feildName = "d.dut_name";
            else
                $feildName="d.dut_name_" . $culture;
        }else if ($searchMode == "dut_code") {
            $feildName = "d.dut_code";
        }
        $q = Doctrine_Query::create()
                ->select('d.*')
                ->from('PerformanceDuty d');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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


    //Rate
    public function searchRate($searchMode, $searchValue, $culture="en", $orderField = 'r.rate_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "rate_name_") {
            if ($culture == "en")
                $feildName = "r.rate_name";
            else
                $feildName="r.rate_name_" . $culture;
        }else if ($searchMode == "rate_code") {
            $feildName = "r.rate_code";
        }
        $q = Doctrine_Query::create()
                ->select('r.*')
                ->from('PerformanceRate r');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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


    //Evaluation Company Information
    public function searchEvaluationCompanyInfo($searchMode, $searchValue, $culture="en", $orderField = 'e.eval_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "eval_name_") {
            if ($culture == "en")
                $feildName = "e.eval_name";
            else
                $feildName="e.eval_name_" . $culture;
        }else if ($searchMode == "eval_code") {
            $feildName = "e.eval_code";
        }

        $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluation e');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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


    public function searchAssingEmployee($searchMode, $searchValue, $culture="en", $orderField = 'd.dut_id', $orderBy = 'ASC', $page = 1, $searchEvaluation='', $searchEvaluationType='') {
        if ($searchMode == "emp_display_name_") {
            if ($culture == "en")
                $feildName = "e.emp_display_name";
            else
                $feildName="e.emp_display_name_" . $culture;
        }else if ($searchMode == "supervisor") {
            if ($culture == "en")
                $feildName = "es.emp_display_name";
            else
                $feildName="es.emp_display_name_" . $culture;
        }else if ($searchMode == "emp_number") {
            $feildName = "e.employee_id";
        } else if ($searchMode == "eval_id") {
            if ($culture == "en")
                $feildName = "EV.eval_name";
            else
                $feildName="EV.eval_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('d.*')
                ->from('PerformanceEvaluationEmployee d')
                ->innerJoin('d.EmployeeSubordinate e')
                ->innerJoin('d.EmployeeSupervisor es')
                ->innerJoin('d.PerformanceEvaluation EV');

        $q->where('d.eval_id LIKE ?', '%' . trim($searchEvaluation) . '%');
        $q->Andwhere('d.eval_type_id LIKE ?', '%' . trim($searchEvaluationType) . '%');
        if ($searchValue != "") {
            $q->Andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&searchEvaluation={$searchEvaluation}&searchEvaluationType={$searchEvaluationType}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    //Evaluation Company Information
    public function searchEvaluation($searchMode, $searchValue, $culture="en", $orderField = 'e.eval_dtl_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "eval_dtl_id") {
            $feildName = "e.eval_dtl_id";
        } else if ($searchMode == "eval_name_") {
            if ($culture == "en")
                $feildName = "p.eval_name";
            else
                $feildName="p.eval_name_" . $culture;
        } else if ($searchMode == "jobtit_name_") {
            if ($culture == "en")
                $feildName = "j.jobtit_name";
            else
                $feildName="j.jobtit_name" . $culture;
        } else if ($searchMode == "level_name_") {
            if ($culture == "en")
                $feildName = "l.level_name ";
            else
                $feildName="l.service_name_" . $culture;
        } else if ($searchMode == "service_name_") {
            if ($culture == "en")
                $feildName = "s.service_name ";
            else
                $feildName="s.service_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluationDetail e')
                ->leftJoin('e.PerformanceEvaluation p')
                ->leftJoin('e.JobTitle j')
                ->leftJoin('e.Level l')
                ->leftJoin('e.ServiceDetails s');
        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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

     public function searchSDOEvaluation($searchMode, $searchValue, $culture="en", $orderField = 'd.dut_id', $orderBy = 'ASC', $page = 1, $searchEvaluation='', $searchEvaluationType='') {

        if ($searchMode == "emp_display_name_") {
            if ($culture == "en")
                $feildName = "e.emp_display_name";
            else
                $feildName="e.emp_display_name_" . $culture;
        }else if ($searchMode == "emp_number") {
            $feildName = "d.emp_number";
        } else if ($searchMode == "eval_id") {
            if ($culture == "en")
                $feildName = "EV.eval_name";
            else
                $feildName="EV.eval_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('d.*')
                ->from('PerformanceEvaluationEmployee d')
                ->innerJoin('d.EmployeeSubordinate e ON e.emp_number = d.emp_number')
                ->leftJoin('d.EmployeeSupervisor es ON es.emp_number = d.sup_emp_number')
                ->leftJoin('d.PerformanceEvaluation EV ON EV.eval_id = d.eval_id');

        $q->where('d.eval_id LIKE ?', '%' . trim($searchEvaluation) . '%');
        $q->Andwhere('d.eval_type_id LIKE ?', '%' . trim($searchEvaluationType) . '%');


        if ($searchValue != "") {
            $q->Andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

        $sysConf = new sysConf();
        //$resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;
        $resultsPerPage = sfConfig::get('app_items_per_page') ? 10 : 10;

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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&searchEvaluation={$searchEvaluation}&searchEvaluationType={$searchEvaluationType}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function searchEmployee($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'e.emp_number', $orderBy = 'ASC', $type='single', $method='', $reason='', $att='', $EVid='', $ETid='') {
        switch ($searchMode) {
            case 'id':
                $searchColumn = 'e.employee_id';
                break;
            case 'firstname':
                $searchColumn = "e.emp_firstname";
                break;
            case 'lastname':
                $searchColumn = "e.emp_lastname";
                break;
            case 'designation':
                $searchColumn = "j.jobtit_name";
                break;
            case 'service':
                $searchColumn = "s.service_name";
                break;
            case 'division':
                $searchColumn = "d.title";
                break;
        }

        if ($searchMode != 'id' && $searchMode != 'all') {
            $searchColumn = ($userCulture == "en") ? $searchColumn : $searchColumn . '_' . $userCulture;
        }

        if ($orderField != 'e.emp_number') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue = trim($searchValue);
        $q = Doctrine_Query::create()
                ->select('e.*,j.*,s.*,d.*,u.*')
                ->from('Employee e')
                ->innerJoin('e.jobTitle j')
                ->innerJoin('e.ServiceDetails s')
                ->innerJoin('e.subDivision d');

        if ($reason != 'companyHead') {
            if ($reason == 'security') {
                $q->leftJoin('e.Users u');

                $q->where('u.emp_number!=');
            } elseif ($reason == 'atte') {
                $q->where('e.emp_active_hrm_flg = 1')
                        ->AndWhere('e.emp_active_att_flg = 1');
            } else {
                $q->where('e.emp_active_hrm_flg = 1');
            }
        }
        $q->where('e.emp_number NOT IN (SELECT p.emp_number FROM PerformanceEvaluationEmployee p WHERE p.eval_id = ?)', $EVid);
        //$q->Andwhere('e.jobtit_code e.level_code e.service_code (SELECT pd.jobtit_code,pd.level_code,pd.service_code FROM PerformanceEvaluationDetail pd where pd.eval_id=?)',$EVid);



        if ($searchMode != 'all' && $searchValue != '') {
            $q->Andwhere($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        $q->orderBy($orderField . ' ' . $orderBy);

        $resultsPerPage = sfConfig::get('app_items_per_page') ? sfConfig::get('app_items_per_page') : 10;

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
                        "?page={%page_number}&mode=search&txtSearchValue={$searchValue}&cmbSearchMode={$searchMode}&sort={$orderField}&order={$orderBy}&type={$type}&method={$method}&reason={$reason}&ETid={$ETid}&EVid={$EVid}"
        );

        $pager = $pagerLayout->getPager();
        $result = array();
        $result['data'] = $pager->execute();
        $result['pglay'] = $pagerLayout;

        return $result;
    }
    public function getUpdatedutyObj($request,$Duty){
        if (strlen($request->getParameter('txtDutyCode'))) {
                $Duty->setDut_code(trim($request->getParameter('txtDutyCode')));
            } else {
                $Duty->setDut_code(null);
            }
            if (strlen($request->getParameter('txtDutyName'))) {
                $Duty->setDut_name(trim($request->getParameter('txtDutyName')));
            } else {
                $Duty->setDut_name(null);
            }
            if (strlen($request->getParameter('txtDutyNameSi'))) {
                $Duty->setDut_name_si(trim($request->getParameter('txtDutyNameSi')));
            } else {
                $Duty->setDut_name_si(null);
            }
            if (strlen($request->getParameter('txtDutyNameTa'))) {
                $Duty->setDut_name_ta(trim($request->getParameter('txtDutyNameTa')));
            } else {
                $Duty->setDut_name_ta(null);
            }
            if (strlen($request->getParameter('txtDutyDesc'))) {
                $Duty->setDut_desc(trim($request->getParameter('txtDutyDesc')));
            } else {
                $Duty->setDut_desc(null);
            }
            if (strlen($request->getParameter('txtDutyGroupDescSi'))) {
                $Duty->setDut_desc_si(trim($request->getParameter('txtDutyGroupDescSi')));
            } else {
                $Duty->setDut_desc_si(null);
            }
            if (strlen($request->getParameter('txtDutyGroupDescTa'))) {
                $Duty->setDut_desc_ta(trim($request->getParameter('txtDutyGroupDescTa')));
            } else {
                $Duty->setDut_desc_ta(null);
            }
            if (strlen($request->getParameter('cmbDutyGroup'))) {
                $Duty->setDtg_id(trim($request->getParameter('cmbDutyGroup')));
            } else {
                $Duty->setDtg_id(null);
            }
            if (strlen($request->getParameter('cmbRate'))) {
                $Duty->setRate_id(trim($request->getParameter('cmbRate')));
            } else {
                $Duty->setRate_id(null);
            }
            return $Duty;

    }
}

?>
