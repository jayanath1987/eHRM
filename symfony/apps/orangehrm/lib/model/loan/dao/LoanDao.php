<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 16 Auguest 2011
 *  Comments  - Loan Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class LoanDao extends BaseDao {

    //LoanType
    public function searchLoanType($searchMode, $searchValue, $culture = "en", $orderField = 'ln.ln_ty_code', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "class_name") {
            if ($culture == "en")
                $feildName = "ln.ln_ty_name";
            else
                $feildName = "ln.ln_ty_name_" . $culture;
        }else if ($searchMode == "class_code") {
            $feildName = "ln.ln_ty_code";
        }
        $q = Doctrine_Query::create()
                ->select('ln.*')
                ->from('LoanType ln');

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

    public function saveLoanType(LoanType $dg) {
        $dg->save();
        return true;
    }

    public function readLoanType($id) {
        return Doctrine::getTable('LoanType')->find($id);
    }

    public function deleteApplication($appid, $lntype) {
        $q = Doctrine_Query::create()
                ->delete('LoanApplication la')
                ->where('la.ln_app_number=' . $appid)
                ->andwhere('la.ln_ty_number=' . $lntype);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteLoanType($id) {
        $q = Doctrine_Query::create()
                ->delete('LoanType')
                ->where('ln_ty_number=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getGuarantorDetails($id) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('Employee')
                ->where("empNumber=$id");

        return $q->fetchArray();
    }

    //
    public function searchAppliedLoans($searchMode, $searchValue, $culture = "en", $orderField = 'la.ln_app_number', $orderBy = 'ASC', $page = 1) {
        switch ($searchMode) {
            case "emp_nic_no":
                $feildName = "e.emp_nic_no";
            case "emp_display_name":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName = "e.emp_display_name_" . $culture;
                break;
            case "ln_ty_name":
                if ($culture == "en")
                    $feildName = "lt.ln_ty_name";
                else
                    $feildName = "lt.ln_ty_name_" . $culture;
                break;
            case "ln_app_date":
                $feildName = "la.ln_app_date";
                break;
            case "ln_app_id":
                $feildName = "la.ln_app_number";
                break;
        }
        $q = Doctrine_Query::create()
                ->select('la.*')
                ->from('LoanApplication la')
                ->innerJoin('la.Employee e ON e.emp_number = la.emp_number')
                ->leftJoin('la.LoanType lt ON lt.ln_ty_number = la.ln_ty_number');

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

    public function readLoanApplication($id) {
        $q = Doctrine_Query::create()
                ->select('la.*')
                ->from('LoanApplication la')
                ->where('la.ln_app_number = ?', $id);
        return $q->fetchOne();
    }

    public function saveLoanApplication($la) {
        return $la->save();
    }

    public function getLoanTypeList() {
        $q = Doctrine_Query::create()
                ->select('l.*')
                ->from('LoanType l');
        return $q->execute();
    }

    public function getLoanTypebyID($id) {
        $q = Doctrine_Query::create()
                ->select('l.*')
                ->from('LoanType l')
                ->where('l.ln_ty_number=' . $id);
        return $q->execute();
    }

    //
    public function searchLoanSettlement($searchMode, $searchValue, $culture = "en", $orderField = 'ls.ln_st_number', $orderBy = 'ASC', $page = 1) {
        switch ($searchMode) {
            case "emp_nic_no":
                $feildName = "e.emp_nic_no";
                break;
            case "emp_display_name":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName = "e.emp_display_name_" . $culture;
                break;
            case "ln_ty_name":
                if ($culture == "en")
                    $feildName = "lt.ln_ty_name";
                else
                    $feildName = "lt.ln_ty_name_" . $culture;
                break;
            case "ln_app_date":
                $feildName = "ls.ln_app_date";
                break;
            case "ln_app_id":
                $feildName = "ls.ln_app_number";
                break;
        }
        $q = Doctrine_Query::create()
                ->select('ls.*')
                ->from('LoanSettlement ls')
                ->innerJoin('ls.Employee e ON e.emp_number = ls.emp_number')
                ->leftJoin('ls.LoanType lt ON lt.ln_ty_number = ls.ln_ty_number');

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

    public function searchLoanHistoryandStatus($searchMode, $searchValue, $activeInactive, $activeInactiveValue, $empLoan, $empLoanValue, $culture = "en", $orderField = 'ls.ln_st_number', $orderBy = 'ASC', $page = 1) {
        $q = Doctrine_Query::create()
                ->select('la.*')
                ->from('LoanApplication la')
                ->innerJoin('la.LoanHeader lh ON la.ln_app_number = lh.ln_app_number and la.ln_ty_number = lh.ln_ty_number')
                ->innerJoin('la.Employee e ON la.emp_number = e.emp_number')
                ->innerJoin('la.LoanType lt ON la.ln_ty_number = lt.ln_ty_number');

        if ($searchValue != "") {
            if ($empLoanValue == 0) {
                if ($searchMode == "EmployeeId") {
                    $q->where('e.emp_number=' . $searchValue);
                }
                if ($activeInactive != "") {
                    $q->andwhere('lh.ln_hd_is_active_flg=' . $activeInactiveValue);
                }
            } else if ($empLoanValue == 1)
                if ($searchMode == "Loantype") {
                    $q->where('lt.ln_ty_number=' . $searchValue);
                }
            if ($activeInactive != "") {
                $q->andwhere('lt.ln_ty_inactive_type_flg=' . $activeInactiveValue);
            }
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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&activeInactive={$activeInactive}&activeInactiveValue={$activeInactiveValue}&empLoan={$empLoan}&empLoanValue={$empLoanValue}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;
        return $res;
    }

    public function readLoanSettlement($id) {
        $q = Doctrine_Query::create()
                ->select('l.*')
                ->from('LoanSettlement l')
                ->where('l.ln_st_number =' . $id);
        return $q->execute();
    }

    public function saveLoanSettlement(LoanSettlement $la) {
        $la->save();
        return true;
    }

    public function saveGuarantee(LoanGuarantee $dg) {
        $dg->save();
        return true;
    }

    public function readGuarantee($id) {
        return Doctrine::getTable('LoanGuarantee')->find($id);
    }

    public function getLastLoanApplicationID() {
        $q = Doctrine_Query::create()
                ->select('MAX(la.ln_app_number)')
                ->from('LoanApplication la');
        return $q->fetchArray();
    }

    public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    public function getGuaranteeList($app_number) {
        $q = Doctrine_Query::create()
                ->select('lg.*')
                ->from('LoanGuarantee lg')
                ->where('lg.ln_app_number = ?', $app_number);
        return $q->fetchArray();
    }

    public function deleteGuarantee($id) {
        $q = Doctrine_Query::create()
                ->delete('LoanGuarantee')
                ->where('ln_gura_number=' . $id);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function saveLoanHeader($dg) {
        $dg->save();
        return true;
    }

    public function readLoanHeader($id) {
        $q = Doctrine_Query::create()
                ->select('la.*')
                ->from('LoanHeader la')
                ->where('la.ln_app_number = ?', $id);
        return $q->fetchOne();
    }

    public function deleteLoanHeader(LoanApplication $la) {
        $q = Doctrine_Query::create()
                ->delete('LoanHeader')
                ->where('ln_ty_number=' . $id);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteLoanHeader2($appId) {
        $q = Doctrine_Query::create()
                ->delete('LoanHeader')
                ->where('ln_app_number=?', $appId);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteLoanSchDule2($appId) {
        $q = Doctrine_Query::create()
                ->delete('LoanSchedule')
                ->where('ln_app_number=?', $appId);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function saveLoanShedule(LoanSchedule $ls) {
        $ls->save();
        return true;
    }

    public function getSimpleInstalment($loanAmount, $monthlyCapital, $interestRate, $noOfInstallment) {
        // Monthly Instalment = Loan Amount/No of Instalments + Loan Amount * Interest Rate/12
        $monthlyInstalment = $monthlyCapital + $loanAmount * $interestRate / 100 / 12;
        return $monthlyInstalment;
    }

    //Fixed Interst 
    public function getFixedInstalment($monthlyCapital, $fixedInterest) {
        //Monthly Instalment = (Loan Amount / No of Instalments) + Interest Amount
        $monthlyInstalment = $monthlyCapital + $fixedInterest;
        return $monthlyInstalment;
    }

    public function getMonthlyCapital($locanAmount, $noOfInstallment) {
        $monthlyCapital = $locanAmount / $noOfInstallment;
        return $monthlyCapital;
    }

    public function getTotalInterest($locanAmount, $noOfInstallment, $monthlyCapital, $interestRate) {
        // Total Interest     = Sum of Monthly Interests (Calculated according to reducing balance)
        $totalInterest = 0;
        $currentBalance = 0;
        for ($t = 0; $t < $noOfInstallment; $t++) {

            if ($t == 0) {
                $monthlyInterest = $this->getMonthlyReducingEqualBalanceInterest($locanAmount, $interestRate);
                $currentBalance = $locanAmount - $monthlyCapital;
//                die(print_r($monthlyCapital + $monthlyInterest));
            } else {
                $monthlyInterest = $this->getMonthlyReducingEqualBalanceInterest($currentBalance, $interestRate);
                $currentBalance = $currentBalance - $monthlyCapital;
            }
            $totalInterest = $totalInterest + $monthlyInterest;
        }
        return $totalInterest;
    }

    public function getMonthlyReducingEqualBalanceInterest($balanceAmount, $interestRate) {
        $monthlyInterest = $balanceAmount * $interestRate / 100 * (1 / 12);
        return $monthlyInterest;
    }

    public function getMonthlyInterest($totalInterest, $noOfInstallment) {
        //Monthly Interest = Total Interest / No of Instalments
        $monthlyInterest = $totalInterest / $noOfInstallment;
        return $monthlyInterest;
    }

    public function getMonthlyInstalment($monthlyCapital, $monthlyInterest) {
        //Monthly Instalment = Monthly Capital + Monthly Interest 
        $monthlyInstalment = $monthlyCapital + $monthlyInterest;
        return $monthlyInstalment;
    }

    public function searchEmployee($searchMode, $searchValue, $userCulture = "en", $page = 1, $orderField = 'e.emp_number', $orderBy = 'ASC', $type = 'single', $method = '', $reason = '', $att = '', $todate, $payroll = '') {

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
                ->select('e.*,j.*,s.*,d.*,la.*,p.*')
                ->from('LoanApplication la')
                ->innerJoin('la.Employee e')
                ->leftJoin('e.jobTitle j')
                ->leftJoin('e.ServiceDetails s')
                ->leftJoin('e.subDivision d');


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

        if ($searchMode != 'all' && $searchValue != '') {
            $q->Andwhere($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        //Active Loans 
        $q->where("la.ln_app_effective_date <= '{$todate}'");

        if ($payroll == 'payroll') {
            $q->innerJoin('e.PayrollEmployee p')
                    ->AndWhere('e.emp_active_att_flg = 1');
        }

        $q->orderBy($orderField . ' ' . $orderBy);
//        $q->groupBy('e.emp_number');
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
                        " ? page={%page_number}&mode=search&txtSearchValue={$searchValue}&cmbSearchMode={$searchMode}&sort={$orderField}&order={$orderBy}&type={$type}&method={$method}&reason={$reason}"
        );

        $pager = $pagerLayout->getPager();
        $result = array();
        $result['data'] = $pager->execute();
        $result['pglay'] = $pagerLayout;

        return $result;
    }

    public function getLoanTypebyIdArray($id = array()) {
        if (is_array($id)) {
            $q = Doctrine_Query::create()
                    ->select('l.*')
                    ->from('LoanType l')
                    ->whereIn('l.ln_ty_number', $id);
            return $q->fetchArray();
        }
    }

    public function getEmployeeLoanType($empId) {

        $q = Doctrine_Query::create()
                ->select('la.ln_ty_number')
                ->from('LoanApplication la')
                ->where('la.emp_number = ?', $empId);
        return $q->fetchArray();
    }

    public function readLoanHeaderByEmpIdAndType($empId, $tyNumber) {
        $q = Doctrine_Query::create()
                ->select('la.*,a.ln_app_install_amount')
                ->from('LoanHeader la')
                ->leftJoin('la.LoanApplication a on a.ln_app_number=la.ln_app_number')
                ->where('la.emp_number = ?', $empId)
                ->andwhere('a.ln_app_number = ?', $tyNumber);
        return $q->fetchArray();
    }

    public function readLoanShedule($empId, $tyNumber) {

        $q = Doctrine_Query::create()
                ->select('ls.*')
                ->from('LoanSchedule ls')
                ->where('ls.emp_number = ?', $empId)
                ->andwhere('ls.ln_app_number = ?', $tyNumber)
                ->orderBy('ls.ln_sch_ins_no');
        return $q->fetchArray();
    }

    public function readLoanShedule1($empId, $hdSeq) {

        $q = Doctrine_Query::create()
                ->select('ls.*')
                ->from('LoanSchedule ls')
                ->where('ls.emp_number = ?', $empId)
                ->andwhere('ls.ln_hd_sequence = ?', $hdSeq)
                ->orderBy('ls.ln_sch_ins_no');
        return $q->fetchOne();
    }

    public function getLoanShedule($empId, $hdSeq, $tyNumber, $sheduleNum) {
        $q = Doctrine_Query::create()
                ->select('ls.*')
                ->from('LoanSchedule ls')
                ->where('ls.emp_number = ?', $empId)
                ->andWhere('ls.ln_hd_sequence = ?', $hdSeq)
                ->andwhere('ls.ln_app_number = ?', $tyNumber)
                ->andwhere('ls.ln_sch_ins_no = ?', $sheduleNum);
        return $q->fetchOne();
    }

    public function getLastSheduleslot($empId, $hdSeq) {

        //die($empId.$hdSeq);
        $q = Doctrine_Query::create()
                ->select('MAX(ls.ln_sch_ins_no)')
                ->from('LoanSchedule ls')
                ->where('ls.ln_sch_is_processed=0')
                ->andWhere('ls.emp_number=?', array($empId))
                ->andWhere('ls.ln_hd_sequence=?', array($hdSeq));

        return $q->fetchArray();
    }

    public function getLastLoanSettlementID() {
        $q = Doctrine_Query::create()
                ->select('MAX(ln_st_number)')
                ->from('LoanSettlement');
        return $q->fetchArray();
    }

    public function readPendingSheduleList($tyNumber) {
        $q = Doctrine_Query::create()
                ->select('ls.*')
                ->from('LoanSchedule ls')
                ->where('ls.ln_app_number = ?', $tyNumber)
                ->andwhere('ls.ln_sch_is_processed = 0')
                ->orderBy('ls.ln_sch_ins_no');
        return $q->execute();
    }

    public function deleteShedule($tyNumber) {

        $q = Doctrine_Query::create()
                ->delete('LoanSchedule ls')
                ->where('ls.ln_app_number = ?', $tyNumber)
                ->andwhere('ls.ln_sch_is_processed = ?', 0);
        $numDeleted = $q->execute();

        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function readLastSequenceNumber($empID) {
        $q = Doctrine_Query::create()
                ->select('MAX(h.ln_hd_sequence) as maxSequence')
                ->from('LoanHeader h')
                ->where('h.emp_number=?', array($empID));

        return $q->fetchArray();
    }

    public function getLoanList() {
        $q = Doctrine_Query::create()
                ->select('h.*')
                ->from('LoanApplication h');
        return $q->execute();
    }

    public function LoadLoanAssignedToEmployee($empId) {
        $q = Doctrine_Query::create()
                ->select('h.*')
                ->from('LoanApplication h')
                ->where('h.emp_number=?', $empId);
        return $q->execute();
    }

    public function getSumofLoanTotalWithInterst($appId) {

        $q = Doctrine_Query::create()
                ->select('SUM(h.ln_sch_inst_amount) as sumInst')
                ->from('LoanSchedule h')
                ->where('h.ln_app_number=?', $appId);
        return $q->execute();
    }
    
    public function getMaxLoanAppID(){
                $q = Doctrine_Query::create()
                ->select('MAX(ln_app_number)')
                ->from('LoanApplication');
        return $q->fetchArray();
    }
    
    public function getLoanDetails($emp,$lnNo,$Type){
                $q = Doctrine_Query::create()
                ->select('*')
                ->from('LoanHeader h')
                ->where('h.emp_number=?', $emp)
                ->Andwhere('h.ln_app_number=?', $lnNo)        
                ->Andwhere('h.ln_ty_number=?', $Type);
        return $q->fetchOne();
    }
    
    public function deleteGaruntee($loantype,$loanno,$nic){
                $q = Doctrine_Query::create()
                ->delete('LoanGuarantee ls')
                ->where('ls.ln_ty_number = ?', $loantype)
                ->andwhere('ls.ln_app_number = ?', $loanno)        
                ->andwhere('ls.gura_nic_no = ?', $nic);
        return $q->execute();
    }
    
        public function readLoanShedulewithemoapp($empId, $appno) {

        $q = Doctrine_Query::create()
                ->select('ls.*')
                ->from('LoanSchedule ls')
                ->where('ls.emp_number = ?', $empId)
                ->andwhere('ls.ln_app_number = ?', $appno)
                ->orderBy('ls.ln_sch_ins_no');
        return $q->fetcharray();
    }

}

?>
