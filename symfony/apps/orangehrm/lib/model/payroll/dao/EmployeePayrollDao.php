<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Employee Payroll Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class EmployeePayrollDao extends BaseDao {

    //VoteDetails
    public function searchEmployeePayrollDetails($searchMode, $searchValue, $culture="en", $orderField = 'e.employeeId', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "emp_display_name") {
            if ($culture == "en")
                $feildName = "e.emp_display_name";
            else
                $feildName="e.emp_display_name_" . $culture;
        }else if ($searchMode == "employeeId") {
            $feildName = "e.employeeId";
        }else if($searchMode == "AttendanceNo"){
            $feildName = "e.emp_attendance_no";
        }
        
        $q = Doctrine_Query::create()
                ->select('e.*')
                ->from('Employee e')
                ->leftJoin('e.PayrollEmployee p')
                ->where('e.emp_active_pr_flg = 1')
                ->Andwhere('e.emp_active_hrm_flg = 1');

        $subQuery = Doctrine_Query::create()
                ->select('z.*')
                ->from('payprocessCapability z')
                ->where('z.prl_process_type=0');
        $subArr = $subQuery->fetchArray();
        $subArr2 = array();
        foreach ($subArr as $key => $val) {
            $subArr2[] = $val['prl_disc_code'];
        }
        $comma_separated = implode(",", $subArr2);
//                                       die(print_r($comma_separated));
        if ($comma_separated) {
            //$q->AndWhere("e.work_station not IN ({$comma_separated})");
        }
        //$q->orWhere("e.emp_number=?", array($_SESSION['empNumber']));

        if ($searchValue != "") {
            $q->Andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);
        $sysConf = new sysConf();
        //$resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;
        $resultsPerPage = $sysConf->getRowLimit() ? 100 : 10;

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

    public function readEmployeePayrollDetails($id) {
        return Doctrine::getTable('PayrollEmployee')->find($id);
    }

    public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    public function getVoteType() {
        $q = Doctrine_Query::create()
                ->select('vt.*')
                ->from('PayrollVoteType vt');

        return $q->execute();
    }

    public function saveVoteDetails(PayrollVote $vd) {
        $vd->save();
    }

    public function saveEmployee(Employee $Employee) {
        $Employee->save();
    }

    public function deleteVoteDetails($id) {
        $q = Doctrine_Query::create()
                ->delete('PayrollVote')
                ->where('vt_typ_code =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getJobGradeList($orderField = 'grade_code', $orderBy = 'ASC') {

        $q = Doctrine_Query::create()
                ->from('Grade')
                ->orderBy($orderField . ' ' . $orderBy);

        return $q->execute();
    }

    public function getGradeSlotByID($id) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('GradeSlot g')
                ->where('g.grade_code = ?', $id);
        return $q->execute();
    }

    public function saveEmployeePayrollInformation(PayrollEmployee $PayrollEmp) {
        $PayrollEmp->save();
    }
    
        public function getckeckremitencedao($Month="2010-03-01") {
        $q = Doctrine_Query::create()
                ->select('p.*')
                ->from('hsPrProcessedtxn p')
                ->leftJoin('p.PRTransDetails d')
                ->leftJoin('d.PayRollBank b')
                //->leftJoin('d.PayRollBranch br')
                ->leftJoin('p.Employee e')
                ->where('p.trn_startdate = ?', $Month)
                ->Andwhere('d.trn_dtl_agent_bank_flg = 1');
        return $q->execute();
    }

}

?>
