<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Jayanath Liyanage
 *  On (Date)  - 10 May 2013
 *  Comments   - EvaluationModule TransferService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class EvaluationDao extends BaseDao {

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
                ->from('EvaluationRate r');

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
    
    public function saveRate(EvaluationRate $dg) {
        $dg->save();
        return true;
    }
    
    public function saveRateDetail(EvaluationRateDetails $dg) {
        $dg->save();
        return true;
    }
    
        public function getRatesObj($request, $Rate) {

          if (strlen($request->getParameter('txtRateCode'))) {
                    $Rate->setRate_code(trim($request->getParameter('txtRateCode')));
                } else {
                    $Rate->setRate_code(null);
                }
                if (strlen($request->getParameter('txtRateName'))) {
                    $Rate->setRate_name(trim($request->getParameter('txtRateName')));
                } else {
                    $Rate->setRate_name(null);
                }
                if (strlen($request->getParameter('txtRateNameSi'))) {
                    $Rate->setRate_name_si(trim($request->getParameter('txtRateNameSi')));
                } else {
                    $Rate->setRate_name_si(null);
                }
                if (strlen($request->getParameter('txtRateNameTa'))) {
                    $Rate->setRate_name_ta(trim($request->getParameter('txtRateNameTa')));
                } else {
                    $Rate->setRate_name_ta(null);
                }
                if (strlen($request->getParameter('txtRateDesc'))) {
                    $Rate->setRate_desc(trim($request->getParameter('txtRateDesc')));
                } else {
                    $Rate->setRate_desc(null);
                }
                if (strlen($request->getParameter('txtRateDescSi'))) {
                    $Rate->setRate_desc_si(trim($request->getParameter('txtRateDescSi')));
                } else {
                    $Rate->setRate_desc_si(null);
                }
                if (strlen($request->getParameter('txtRateDescTa'))) {
                    $Rate->setRate_desc_ta(trim($request->getParameter('txtRateDescTa')));
                } else {
                    $Rate->setRate_desc_ta(null);
                }
                if (strlen($request->getParameter('optrate'))) {
                    $Rate->setRate_option(trim($request->getParameter('optrate')));
                } else {
                    $Rate->setRate_option(null);
                }

                return $Rate;


    }
    
    public function getLastRateID() {
        $query = Doctrine_Query::create()
                ->select('MAX(r.rate_id)')
                ->from('EvaluationRate r');

        return $query->fetchArray();
    }

    public function readRate($id) {
        return Doctrine::getTable('EvaluationRate')->find($id);
    }
    
     public function readRateDetailList($id,$opt) {

        $query = Doctrine_Query::create()
                ->select('r.rate_id,r.rdt_grade,r.rdt_mark,r.rdt_description')
                ->from('EvaluationRateDetails r')
                ->where("r.rate_id = ?", $id);
                if($opt=='1'){
                  $query->orderBy("r.rdt_mark DESC");  
                }else{
                   $query->orderBy("r.rdt_mark ASC"); 
                }
                


        return $query->fetchArray();
    }
    
    public function GetUpdateRateObj($request, $Rate) {

                if (strlen($request->getParameter('txtRateCode'))) {
                    $Rate->setRate_code(trim($request->getParameter('txtRateCode')));
                } else {
                    $Rate->setRate_code(null);
                }
                if (strlen($request->getParameter('txtRateName'))) {
                    $Rate->setRate_name(trim($request->getParameter('txtRateName')));
                } else {
                    $Rate->setRate_name(null);
                }
                if (strlen($request->getParameter('txtRateNameSi'))) {
                    $Rate->setRate_name_si(trim($request->getParameter('txtRateNameSi')));
                } else {
                    $Rate->setRate_name_si(null);
                }
                if (strlen($request->getParameter('txtRateNameTa'))) {
                    $Rate->setRate_name_ta(trim($request->getParameter('txtRateNameTa')));
                } else {
                    $Rate->setRate_name_ta(null);
                }
                if (strlen($request->getParameter('txtRateDesc'))) {
                    $Rate->setRate_desc(trim($request->getParameter('txtRateDesc')));
                } else {
                    $Rate->setRate_desc(null);
                }
                if (strlen($request->getParameter('txtRateDescSi'))) {
                    $Rate->setRate_desc_si(trim($request->getParameter('txtRateDescSi')));
                } else {
                    $Rate->setRate_desc_si(null);
                }
                if (strlen($request->getParameter('txtRateDescTa'))) {
                    $Rate->setRate_desc_ta(trim($request->getParameter('txtRateDescTa')));
                } else {
                    $Rate->setRate_desc_ta(null);
                }
                if (strlen($request->getParameter('optrate'))) {
                    $Rate->setRate_option(trim($request->getParameter('optrate')));
                } else {
                    $Rate->setRate_option(null);
                }

                return $Rate;

    }    
    
        
    public function deleteRateDetail($id) {
        $q = Doctrine_Query::create()
                ->delete('EvaluationRateDetails')
                ->where('rate_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function deleteRate($id) {

        $q = Doctrine_Query::create()
                ->delete('EvaluationRate')
                ->where('rate_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
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
                ->from('EvaluationCompany e');

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

    
        public function readYearList() {
        return $query = range('2000', date('Y') + 20);
    }
    
    public function readRateList() {
        $query = Doctrine_Query::create()
                ->select('r.*')
                ->from('EvaluationRate r');
        return $query->execute();
    }
    
    public function saveEvaluationCompanyInfo(EvaluationCompany $EvaluationComInfo,$request) {

            if (strlen($request->getParameter('txtEvaluationCode'))) {
                $EvaluationComInfo->setEval_code(trim($request->getParameter('txtEvaluationCode')));
            } else {
                $EvaluationComInfo->setEval_code(null);
            }
            if (strlen($request->getParameter('txtEvaluationName'))) {
                $EvaluationComInfo->setEval_name(trim($request->getParameter('txtEvaluationName')));
            } else {
                $EvaluationComInfo->setEval_name(null);
            }
            if (strlen($request->getParameter('txtEvaluationNameSi'))) {
                $EvaluationComInfo->setEval_name_si(trim($request->getParameter('txtEvaluationNameSi')));
            } else {
                $EvaluationComInfo->setEval_name_si(null);
            }
            if (strlen($request->getParameter('txtEvaluationNameTa'))) {
                $EvaluationComInfo->setEval_name_ta(trim($request->getParameter('txtEvaluationNameTa')));
            } else {
                $EvaluationComInfo->setEval_name_ta(null);
            }
            if (strlen($request->getParameter('txtEvaluationDesc'))) {
                $EvaluationComInfo->setEval_desc(trim($request->getParameter('txtEvaluationDesc')));
            } else {
                $EvaluationComInfo->setEval_desc(null);
            }
            if (strlen($request->getParameter('txtEvaluationDescSi'))) {
                $EvaluationComInfo->setEval_desc_si(trim($request->getParameter('txtEvaluationDescSi')));
            } else {
                $EvaluationComInfo->setEval_desc_si(null);
            }
            if (strlen($request->getParameter('txtEvaluationDescTa'))) {
                $EvaluationComInfo->setEval_desc_ta(trim($request->getParameter('txtEvaluationDescTa')));
            } else {
                $EvaluationComInfo->setEval_desc_ta(null);
            }
            if (strlen($request->getParameter('cmbYear'))) {
                $EvaluationComInfo->setEval_year(trim($request->getParameter('cmbYear')));
            } else {
                $EvaluationComInfo->setEval_year(null);
            }
            if (strlen($request->getParameter('cmbRate'))) {
                $EvaluationComInfo->setRate_id(trim($request->getParameter('cmbRate')));
            } else {
                $EvaluationComInfo->setRate_id(null);
            }
            if (strlen($request->getParameter('optrate'))) {
                $EvaluationComInfo->setEval_active(trim($request->getParameter('optrate')));
            } else {
                $EvaluationComInfo->setEval_active(null);
            }

        $EvaluationComInfo->save();
        return true;
    }
    
     public function readEvaluationCompanyInfo($id) {
        return Doctrine::getTable('EvaluationCompany')->find($id);
    }

    public function getEvaluationEmpList($EVid) {
        $query= Doctrine_Query::create()
                ->select('e.*')
                ->from('EvaluationSupervisorNominee e')
                ->where("e.eval_id = ?", $EVid);
        return $query->fetchArray();
    }
    
        public function getEvaluationList() {
        $query = Doctrine_Query::create()
                ->select('e.*')
                ->from('EvaluationCompany e')
                ->where("e.eval_active = 1");
        return $query->execute();
    }
    
    public function getEvaluationYear($id) {
        $query = Doctrine_Query::create()
                ->select('e.*')
                ->from('EvaluationCompany e')
                ->where("e.eval_id = ?", $id);
        return $query->fetchArray();
    }
    
     public function getEmployee($insList = array()) {

        try {
            if (is_array($insList)) {
                $query= Doctrine_Query::create()
                        ->select('e.*,r.*')
                        ->from('Employee e')
                        ->LeftJoin('e.ReportTo r e.emp_number=r.subordinateId') 
                        ->whereIn('e.emp_number', $insList);

                return $query->fetchArray();
            }
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }
    
     public function getCompnayStructure($id) {
        try {
            return Doctrine::getTable('CompanyStructure')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
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
        $q->where('e.emp_number NOT IN (SELECT p.emp_number FROM EvaluationSupervisorNominee p WHERE p.eval_id = ?)', $EVid);
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
    
    public function getDefaultSupervisor($Eid) {
        $query= Doctrine_Query::create()
                ->select('e.*')
                ->from('ReportTo e')
                ->where("e.erep_sub_emp_number = ?", $Eid)
                ->andWhere("e.erep_reporting_mode = 1");
        return $query->fetchone();
    }
    
     public function getDeleteEvaluationEmpList($EVid, $Enum) {
        $query = Doctrine_Query::create()
                ->delete('EvaluationSupervisorNominee e')
                ->where("e.eval_id = ?", $EVid)
                //->Andwhere("e.eval_type_id = ?", $ETId)
                ->Andwhere("e.emp_number = ?", $Enum);
                //->Andwhere("e.eval_dtl_id = ?", $Eval);
        return $query->execute();
    }
    
    public function getMaxEvaluationSupervisorNominee(){
        
                $query = Doctrine_Query::create()
                ->select('MAX(r.evl_id)')
                ->from('EvaluationSupervisorNominee r');

        return $query->fetchArray();
     
    }
    
    public function getEmployeeDetail($eno){
                        $query= Doctrine_Query::create()
                        //->select('e.*')        
                        ->select('e.empNumber, e.employeeId, e.emp_display_name, e.emp_display_name_si, e.emp_display_name_ta')
                        ->from('Employee e')
                        ->where('e.emp_number = ?',$eno);
                        return $query->fetchOne();
    }
    
    
  public function EvalFunctionTask($searchMode, $searchValue, $culture="en", $orderField = 'b.ft_id ', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "ft_title") {
            if ($culture == "en")
                $feildName = "b.ft_title";
            else
                $feildName="b.ft_title";
        }
//        else if ($searchMode == "eval_id") {
//            $feildName = "b.eval_id";
//        }
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('EvaluationFunctionsTask b');
                
                        if($_SESSION['empNumber']){
                            $q->where('b.emp_number = '.$_SESSION['empNumber']);
                        }

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
    
    public function readEvalFunctionTask($id) {
        return Doctrine::getTable('EvaluationFunctionsTask')->find($id);
    } 
    
    public function LoadEmpData($id) {
        $q = Doctrine_Query::create()
                        ->select('e.*')
                        ->from('EmployeeMaster e')
                        ->where('e.emp_number = ?', $id);

        return $q->execute();
    }
    
    
        public function DeleteEvalFunctionTask($id) {

        $q = Doctrine_Query::create()
                ->delete('EvaluationFunctionsTask')
                ->where('ft_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    
    
    public function viewall($from, $to, $page=1, $eno=null, $type, $orderField = 'a.ft_id', $orderBy = 'ASC', $EmployeeSub1,$chkAll,$chkPending=null,$chkApproved=null,$chkRejected=null,$chkCanceled=null,$chkTaken=null) {
//      die(print_r($from.$to.$page.$eno.$type.$orderField.$orderBy.$post.$EmployeeSub1));   
// die(print_r($eno));        
        //try {
            if ($type == 0) {
                $q = Doctrine_Query::create()
                                ->select('*')
                                ->from('EvaluationFunctionsTask a')
                                ->leftJoin('a.Employee e ON a.emp_number = e.emp_number');
//                                ->leftJoin('a.LeaveType c ON a.leave_type_id = c.leave_type_id')
//                                ->Where('a.leave_app_start_date >= ?', $from)
//                                ->andWhere('a.leave_app_end_date <= ?', $to);
                                if($eno!= null){
                                $q->andwhere("a.emp_number IN (".$eno.")");
                                }

                                
                           
                                
                $q->orderBy($orderField . ' ' . $orderBy);
            }
             else if ($type == 1) {
                $q = Doctrine_Query::create()
                                ->select("a.*")
                                ->from("EvaluationFunctionsTask a")
                                //->leftJoin("a.Employee e ON a.emp_number = e.emp_number")
//                                ->leftJoin("a.LeaveType c ON a.leave_type_id = c.leave_type_id")              
                                //->whereIn("a.emp_number"    , array($eno) );
                                ->where("a.emp_number IN (".$eno.") " )
                                ->AndWhere("a.ft_active_flg = 1")
                                ->AndWhere("a.ft_approve_flg = 1");
                
                  
                                
                $q->orderBy($orderField . ' ' . $orderBy);
            }
            if($EmployeeSub!=null ){

                $q = Doctrine_Query::create()
                ->select('*')
                ->from('EvaluationFunctionsTask a')
                ->leftJoin('a.Employee e ON a.emp_number = e.emp_number')
//                ->leftJoin('a.LeaveType c ON a.leave_type_id = c.leave_type_id')
                ->where("a.emp_number IN (".$EmployeeSub.")");
                $q->andWhere('a.ft_active_flg = 1');
                $q->orderBy($orderField . ' ' . $orderBy);

            }
            //$resultsPerPage = sfConfig::get('app_items_per_page2') ? sfConfig::get('app_items_per_page2') : 20;
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
                            "?page={%page_number}&searchValue={$from}&searchMode={$to}&emp={$eno}&type={$type}&sort={$orderField}&order={$orderBy}&EmployeeSub={$EmployeeSub}&chkAll={$chkAll}&chkPending={$chkPending}&chkApproved={$chkApproved}&chkRejected={$chkRejected}&chkCanceled={$chkCanceled}&chkTaken={$chkTaken}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;
//        } catch (Exception $e) {
//            throw new DaoException($e->getMessage());
//        }                                    
    }
    
    
    public function getemployeePendingFTESS($emp) {

        $q = Doctrine_Query::create()
                        ->select('count(l.ft_id) ')
                        ->from('EvaluationFunctionsTask l')
                        ->where('l.emp_number = ?', $emp)
                        ->andwhere('l.ft_approve_flg = ?', 1);
        return $q->fetchArray();
    }
    
      public function EmployeeEvaluationList($searchMode, $searchValue, $culture="en", $orderField = 'b.ev_id ', $orderBy = 'ASC', $page = 1,  $emp, $type) {
        if($emp){
            $emp = str_replace("_",',',$emp);
        }
          
          if ($searchMode == "ft_title") {
                $feildName = "c.eval_name";
        }
//        else if ($searchMode == "eval_id") {
//            $feildName = "b.eval_id";
//        }
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('EvaluationEmployee b')
                ->LeftJoin('b.Employee e')
                ->LeftJoin('b.EvaluationCompany c');
        
        if($type!=null){
         $q->where("b.ev_complete_flg = " .$type) ;
        }
        if($emp!=null){
         $q->Andwhere("b.emp_number IN (".$emp.") " ) ;
        }
//        else{
//         $q->Andwhere("b.emp_number =".$_SESSION['empNumber'] ) ;   
//        }


        if ($searchValue != "") {
            $q->Andwhere($feildName . " LIKE ? ", "%" . trim($searchValue) . "%");
        }
        $q->orderBy($orderField . ' ' . $orderBy); //die(print_r($q->getDql()));

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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&emp={$emp}&type={$type}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }
    
    public function getGetFTData($comeval,$eno) {

        $q = Doctrine_Query::create()
                        ->select('l.* ')
                        ->from('EvaluationFunctionsTask l')
                        ->where('l.emp_number = ?', $eno)
                        ->andwhere('l.eval_id = ?', $comeval)
                        ->andwhere('l.ft_active_flg = ?', 1);
                        //->andwhere('l.ft_approve_flg = ?', 2);
        return $q->fetchArray();
    }    
    
    public function getGetSMData($comeval,$eno,$ev_id) { //die(print_r($comeval.$eno.$ev_id));
//die(var_dump($ev_id));
              $q = Doctrine_Query::create();
              if($ev_id){                
                  
              
                        $q->select('l.* ,s.*')
                        ->from('EvaluationSkillEmployee l')
                        ->leftJoin("l.EvaluationSkill s ON s.skill_id = l.skill_id")
                        ->where('l.emp_number = ?', $eno)
                        ->andwhere('l.eval_id = ?', $comeval);
                        //->andwhere('l.emp_skill_active_flg = ?', 1);
                        //->andwhere('l.emp_skill_approve_flg = ?', 2);
        
              }else{
                       $q->select('s.*')
                        ->from('EvaluationSkill s')
                        ->where('s.skill_active_flg = ?', 1);

        
              }
              return $q->fetchArray();
    } 
    
    public function getGet360Data($comeval,$eno,$ev_id) {

        $q = Doctrine_Query::create();
//                        ->select('s.*')
//                        ->from('EvaluationTSMaster s')
//                        ->where('s.ts_active_flg = ?', 1);
             if($ev_id){                
                  
              
                        $q->select('l.* ,s.*')
                        ->from('EvaluationTSEmployee l')
                        ->leftJoin("l.EvaluationTSMaster s ON s.ts_id = l.ts_id")
                        ->where('l.emp_number = ?', $eno)
                        ->andwhere('l.eval_id = ?', $comeval);
                        //->andwhere('l.emp_ts_active_flg = ?', 1);
                        //->andwhere('l.emp_skill_approve_flg = ?', 2);
        
              }else{
                        $q->select('s.*')
                        ->from('EvaluationTSMaster s')
                        ->where('s.ts_active_flg = ?', 1);

        
              }
        return $q->fetchArray();
    } 
    
    
    
    public function readEvalEmployee($id) {
        return Doctrine::getTable('EvaluationEmployee')->find($id);
    } 
    
    public function readFuntionTask($id) {
        return Doctrine::getTable('EvaluationFunctionsTask')->find($id);
    }
    
    public function readEvaluationSkillEmployee($id,$compid,$eno) {
        
                  $query = Doctrine_Query::create()
                        ->from('EvaluationSkillEmployee e')
                        ->where('e.skill_id = ?',$id)
                        ->Andwhere('e.eval_id = ?',$compid)
                        ->Andwhere('e.emp_number = ?',$eno) ;
                  
                        return $query->fetchOne();
    }
    
    public function getLastEvaluationSkillEmployeeID() {
        $query = Doctrine_Query::create()
                ->select('MAX(r.emp_skill_id)')
                ->from('EvaluationSkillEmployee r');

        return $query->fetchArray();
    }
    
    public function readEvaluationTSEmployee($id,$compid,$eno) {

                   $query = Doctrine_Query::create()
                        ->from('EvaluationTSEmployee e')
                        ->where('e.ts_id = ?',$id)
                        ->Andwhere('e.eval_id = ?',$compid)
                        ->Andwhere('e.emp_number = ?',$eno) ;
                  
                        return $query->fetchOne();
        
    }
    
    public function getLastEvaluationTSEmployeeID() {
        $query = Doctrine_Query::create()
                ->select('MAX(r.emp_ts_id)')
                ->from('EvaluationTSEmployee r');

        return $query->fetchArray();
    }
    
    
   public function deleteTS($id,$compid,$eno) {
        $q = Doctrine_Query::create()
                ->delete('EvaluationTSEmployee e')
                        ->where('e.eval_id = ?',$compid)
                        ->Andwhere('e.emp_number = ?',$eno) ;

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function deleteMS($id,$compid,$eno) {
        $q = Doctrine_Query::create()
                ->delete('EvaluationSkillEmployee e')
                        ->where('e.eval_id = ?',$compid)
                        ->Andwhere('e.emp_number = ?',$eno) ;

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function deleteFT($id,$compid,$eno) {
        $q = Doctrine_Query::create()
                ->delete('EvaluationFunctionsTask e')
                        ->where('e.eval_id = ?',$compid)
                        ->Andwhere('e.emp_number = ?',$eno) ;

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function deleteEvaluationEmployee($compid,$eno) {
        $q = Doctrine_Query::create()
                ->delete('EvaluationEmployee e')
                        ->where('e.eval_id = ?',$compid)
                        ->Andwhere('e.emp_number = ?',$eno) ;

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function getGetFTDataEval($comeval,$eno) {

        $q = Doctrine_Query::create()
                        ->select('l.* ')
                        ->from('EvaluationFunctionsTask l')
                        ->where('l.emp_number = ?', $eno)
                        ->andwhere('l.eval_id = ?', $comeval)
                        ->andwhere('l.ft_active_flg = ?', 1)
                        ->andwhere('l.ft_approve_flg = ?', 2);
        return $q->fetchArray();
    }    
    
    public function getGetSMDataEval($comeval,$eno,$ev_id) { //die(print_r($comeval.$eno.$ev_id));

              $q = Doctrine_Query::create();

                        $q->select('l.* ,s.*')
                        ->from('EvaluationSkillEmployee l')
                        ->leftJoin("l.EvaluationSkill s ON s.skill_id = l.skill_id")
                        ->where('l.emp_number = ?', $eno)
                        ->andwhere('l.eval_id = ?', $comeval)
                        ->andwhere('l.emp_skill_active_flg = ?', 1);

              return $q->fetchArray();
    } 
    
    public function getGet360DataEval($comeval,$eno,$ev_id) {

        $q = Doctrine_Query::create();

                        $q->select('l.* ,s.*')
                        ->from('EvaluationTSEmployee l')
                        ->leftJoin("l.EvaluationTSMaster s ON s.ts_id = l.ts_id")
                        ->where('l.emp_number = ?', $eno)
                        ->andwhere('l.eval_id = ?', $comeval)
                        ->andwhere('l.emp_ts_active_flg = ?', 1);

        return $q->fetchArray();
    } 
    
    public function getemployeePendingEvaluationforSupervisor($emp) {
    if($emp){
       $emp = str_replace("_",',',$emp);
            }
        if($emp){    
        $q = Doctrine_Query::create()
                        ->select("count(l.ev_id)")
                        ->from("EvaluationEmployee l")
                        ->where("l.emp_number IN (".$emp.")")
                        ->andwhere("l.ev_complete_flg = 0");  //die(print_r($q->getDql()));
        return $q->fetchArray();
        }
    }
    
    public function getemployeePendingEvaluationforModerator($emp) {
    if($emp){
       $emp = str_replace("_",',',$emp);
            }
        if($emp){     
        $q = Doctrine_Query::create()
                        ->select("count(l.ev_id) ")
                        ->from("EvaluationEmployee l")
                        ->where("l.emp_number IN (". $emp .") ")
                        ->andwhere("l.ev_complete_flg = 1"); //die(print_r($q->getDql()));
        return $q->fetchArray();
        }
    }
    
    public function LoadsubordinateDataModerator($id) {
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('EvaluationSupervisorNominee r')
                        ->where('r.evl_nomine_emp_number = ?', $id);

        return $q->fetchArray();
        // return $q->execute();
    }
    
    public function LoadsubordinateDataSupervisor($id) {
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('EvaluationSupervisorNominee r')
                        ->where('r.sup_num = ?', $id);

        return $q->fetchArray();
        // return $q->execute();
    }
    
    public function getLastEvaluationEmployee() {
        $query = Doctrine_Query::create()
                ->select('MAX(r.ev_id)')
                ->from('EvaluationEmployee r');

        return $query->fetchArray();
    }
    
    public function readRateDetails($rateId) { 
        $query = Doctrine_Query::create()
                ->select("r.*")
                ->from("EvaluationRateDetails r")
                ->where("r.rate_id = ".$rateId)
                ->orderBy("rdt_mark ASC");

        return $query->fetchArray();
    }
    
    public function gettslistbylevel($id){
        $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('EvaluationTSMaster e')
                ->where('e.ts_level = ?', $id);

        return $q->execute();
    }
    
    public function readEvaluationComment($Type,$id){
        if($Type == "1"){
            
            $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('EvaluationFunctionsTaskComments e')
                ->where('e.ft_id = ?', $id);
            return $q->execute();
            
        }else if ($Type == "2"){
            $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('EvaluationSkillEmployeeComments e')
                ->where('e.emp_skill_id = ?', $id);
            return $q->execute();
            
        }else if($Type == "3"){
            $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('EvaluationTSEmployeeComments e')
                ->where('e.emp_ts_id = ?', $id);
            return $q->execute();
        }
    }
    

    
}

?>
