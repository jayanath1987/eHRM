<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class SalarayIncrementDao extends BaseDao {

    public function searchSalarayIncrementDetails($searchMode, $searchValue, $culture="en", $orderField = 's.inc_effective_date', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "emp_name") {
            if ($culture == "en")
                $feildName = "e.emp_display_name";
            else
                $feildName="e.emp_display_name_" . $culture;
        }else if ($searchMode == "emp_number") {
            $feildName = "e.employeeId";
        } else if ($searchMode == "inc_previous_salary") {
            $feildName = "s.inc_previous_salary";
        } else if ($searchMode == "inc_new_salary") {
            $feildName = "s.inc_new_salary";
        } else if ($searchMode == "inc_amount") {
            $feildName = "s.inc_amount";
        }
        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollIncrement s')
                ->innerJoin('s.Employee e');

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

    public function readSalarayIncrement($id) {
        $IDS = explode("_", $id);

        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollIncrement s')
                ->where('s.emp_number =?', $IDS[0])
                ->andWhere('s.inc_new_grade_code =?', $IDS[1])
                ->andWhere('s.inc_new_slt_scale_year =?', $IDS[2]);

        return $q->fetchOne();
    }

    public function getEmployee($insList = array()) {


        if (is_array($insList)) {
            $q = Doctrine_Query::create()
                    ->select('e.*')
                    ->from('Employee e')
                    ->whereIn('e.emp_number', $insList);

            return $q->execute();
        }
    }

    public function getGradeSlotByID($Grade, $year) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('GradeSlot g')
                ->where('g.grade_code = ?', $Grade)
                ->andwhere('g.slt_scale_year = ?', $year);
        return $q->fetchOne();
//die(print_r($q->getSql()));
    }

    public function getGradeSlotByIDIncrement($Grade, $year) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('GradeSlot g')
                ->where('g.grade_code = ?', $Grade)
                ->andwhere('g.slt_id = ?', $year);
        return $q->fetchOne();
//die(print_r($q->getSql()));
    }

    public function saveSalarayIncrement(PayrollIncrement $vd) {
        $vd->save();
    }

    public function updateEmployeeSalary($Emp, $Grade, $Slot) {
        $q = Doctrine_Query::create()
                ->update('Employee e')
                ->set('e.grade_code', '?', $Grade)
                ->set('e.slt_scale_year', '?', $Slot)
                ->where('e.emp_number = ?', $Emp);

        $q->execute();

        return $q->execute();
    }

    public function getSalaryIncrementEffectiveDateToday() {
        $e = getdate();
        $today = date("Y-m-d", $e[0]);

        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollIncrement s')
                ->where('s.inc_confirm_flag = 1')
                ->Andwhere('s.inc_cancel_flag != 1')
                ->Andwhere('s.inc_effective_date = ?', $today);


        //$q->execute();

        return $q->execute();
    }

    public function findEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    public function saveEmployee(Employee $Emp) {
        $Emp->save();
    }

    public function deleteIncrement($empno, $sltyr, $grade, $date) {
        $q = Doctrine_Query::create()
                ->delete('PayrollIncrement i')
                ->where('i.emp_number = ?', $empno)
                ->Andwhere('i.inc_new_slt_scale_year = ?', $sltyr)
                ->Andwhere('i.inc_new_grade_code = ?', $grade)
                ->Andwhere('i.inc_effective_date >  ?', $date);

        $numDeleted = $q->execute();

//        if ($numDeleted > 0) {
//            return true;
//        }
        return $numDeleted;
    }

    public function updateEmployeeEligibility($Emp, $newSal) {

//        $sql = "update hs_pr_txn_eligibility set tre_amount={$newSal}
//where trn_dtl_code=(select trn_dtl_code from hs_pr_transaction_details  d left join hs_pr_transaction_type t ON  d.trn_typ_code=t.trn_typ_code where t.erndedcon=1
//) and emp_number={$Emp}";
             $sql = "update hs_pr_txn_eligibility set tre_amount={$newSal}
where trn_dtl_code = '4'
 and emp_number={$Emp}";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function getNewSalary($sltId, $grdId) {
        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('GradeSlot g')
                ->where('g.slt_id = ?', $sltId)
                ->andWhere('g.grade_code= ?', $grdId);

        return $q->execute();
    }

    public function getEmpProcessedDate() {
        $q = Doctrine_Query::create()
                ->select('MAX(g.pay_startdate),g.*')
                ->from('hsPrPayprocess g')
                ->groupBy('g.emp_number');
//return $q->fetchArray();
        return $q->execute();
    }
    


    public function saveSalarayIncrementCancel(PayrollIncrementCancel $vd) {
        $vd->save();
    }

    public function searchSalarayIncrementDetailsCancel($searchMode, $searchValue, $culture="en", $orderField = 's.inc_effective_date', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "emp_name") {
            if ($culture == "en")
                $feildName = "e.emp_display_name";
            else
                $feildName="e.emp_display_name_" . $culture;
        }else if ($searchMode == "emp_number") {
            $feildName = "e.employeeId";
        } else if ($searchMode == "inc_previous_salary") {
            $feildName = "s.inc_previous_salary";
        } else if ($searchMode == "inc_new_salary") {
            $feildName = "s.inc_new_salary";
        } else if ($searchMode == "inc_amount") {
            $feildName = "s.inc_amount";
        }
        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollIncrementCancel s')
                ->innerJoin('s.Employee e');

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
    
}

?>
