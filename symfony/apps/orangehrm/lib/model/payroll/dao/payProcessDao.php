<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class payProcessDao extends BaseDao {

    public function readProcessedEmp($batchId, $empId, $payrolltype) {

        return Doctrine::getTable('PayRollTempProcessEmp')->find(array($batchId, $empId, $payrolltype));
    }

    public function listProcessedEmpList($payrolltype, $startDate, $endDate, $batchId) {

        $encryption = new EncryptionHandler();
        $payrolltype = $encryption->decrypt($payrolltype);
        $resultArr = array();
        $sql = "SELECT d.*,p.*,s.employee_id,s.emp_number,s.emp_display_name,s.emp_display_name_si,s.emp_display_name_ta FROM hs_pr_processedemp p
        left join  hs_pr_exceptions e on p.pro_startdate=e.pro_startdate and p.pro_enddate=e.pro_enddate and p.emp_number=e.emp_number 
        left join  hs_hr_employee s on p.emp_number=s.emp_number
        left join hs_pr_employee pr on p.emp_number=pr.emp_number
        left join hs_pr_exceptions_def d on d.exception_id=e.exception_id where p.pro_startdate='{$startDate}' and p.pro_enddate='{$endDate}' and p.pro_batch_id='{$batchId}' and pr.prl_type_code='{$payrolltype}' ";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $resultArr[] = $row;
        }
        return $resultArr;
    }

    public function getPaySlipDetails($startDate, $endDate, $empNumber) {

//        $resultArr = array();
//        $query = "SELECT * from hs_pr_payprocess p where p.pay_startdate='{$startDate}' and pay_enddate='{$endDate}' and p.emp_number='{$empNumber}' ";
//
//        $conn = Doctrine_Manager::getInstance()->connection();
//        $stmt = $conn->prepare($query);
//        $stmt->execute();
//        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {
//
//            $resultArr[] = $row;
//        }
//        return $resultArr;
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('hsPrPayprocess p')
                ->Where('p.pay_startdate =?', array($startDate))
                ->andWhere('p.pay_enddate =?', array($endDate))
                ->andWhere('p.emp_number =?', array($empNumber));


        return $q->execute();
    }

    public function getPaySlipDetailsTXN($startDate, $endDate, $empNumber) {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('hsPrProcessedtxn p')
                ->Where('p.trn_startdate =?', array($startDate))
                ->andWhere('p.trn_enddate =?', array($endDate))
                ->andWhere('p.emp_number =?', array($empNumber));



        return $q->execute();
    }

    public function getPaySlipDetailsLoan($startDate, $endDate, $empNumber) {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('LoanSchedule l')
                ->Where('l.ln_sch_proc_from_date =?', array($startDate))
                ->andWhere('l.ln_sch_proc_to_date =?', array($endDate))
                ->andWhere('l.emp_number =?', array($empNumber))
                ->andWhere('l.ln_sch_is_processed=1');



        return $q->execute();
    }
    
        public function getPaySlipDetailsLoanRemain($startDate, $endDate, $empNumber) {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('LoanProcessed l')
                ->Where('l.ln_processed_from_date =?', array($startDate))
                ->andWhere('l.ln_processed_to_date =?', array($endDate))
                ->andWhere('l.emp_number =?', array($empNumber));
                //->andWhere('l.ln_ty_number =?', array($lntype));



        return $q->execute();
    }

    public function defaultTransactionAssign($EmpID, $basciSalary) {

        $conn = Doctrine_Manager::getInstance()->connection();

        $stmtSp = $conn->prepare("call spDefaultTransAssign('{$EmpID}','{$basciSalary}')");
        $stmtSp->execute();
    }

    public function IsBatchIdExsit($id, $startDate, $endDate) {


        $q = Doctrine_Query::create()
                ->select('count(a.pro_batch_id)')
                ->from('PayRollProcessedEmp a')
                ->where('a.pro_batch_id =?', array($id))
                ->andWhere('a.pro_startdate =?', array($startDate))
                ->andWhere('a.pro_enddate =?', array($endDate))
                ->andWhere('a.pro_enddate =?', array($_SESSION['empNumber']));


        return $q->fetchArray();
    }

    public function getProcEmpByDate($startDate, $endDate, $batchId, $payRollType) {

        $encryption = new EncryptionHandler();
        $decryptPay = $encryption->decrypt($payRollType);
        $resultArr = array();
        $sql = "SELECT p.emp_number FROM hs_pr_processedemp p  left join  hs_pr_employee e on e.emp_number=p.emp_number
        where p.pro_startdate='{$startDate}' and p.pro_enddate='{$endDate}' and p.pro_batch_id='{$batchId}' and e.prl_type_code='{$decryptPay}'";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $resultArr[] = $row;
        }
        return $resultArr;
    }

    public function getEmployee($id) {

        $query = Doctrine_Query::create()
                ->from('Employee e')
                ->where('e.emp_number = ?', $id);


        return $query->fetchone();
    }

    public function PayrollEmployeeList($userCulture = "en", $orderField, $orderBy, $type, $reason = '', $payroll, $payrolltype, $locationWise, $startDate, $endDate) {


        $encryption = new EncryptionHandler();
        $decryptprType = $encryption->decrypt($payrolltype);
//        die(print_r($decryptprType));
        $q = Doctrine_Query::create()
                ->select('e.*,j.*,s.*,d.*,u.*,p.*')
                ->from('Employee e')
                ->leftJoin('e.jobTitle j')
                ->leftJoin('e.ServiceDetails s')
                ->leftJoin('e.subDivision d')
                ->where('e.emp_active_hrm_flg = 1');
        if ($reason != 'companyHead') {
            if ($reason == 'security') {
                $q->leftJoin('e.Users u');

                $q->where('u.emp_number!=');
            }
        }

        if ($payroll == 'payroll') {

            $q->leftJoin('e.PayrollEmployee p');

//                                   if($locationWise=="1"){
            $subQuery = Doctrine_Query::create()
                    ->select('z.*')
                    ->from('payprocessCapability z')
                    ->where('prl_process_type=0');
            $subArr = $subQuery->fetchArray();
            $subArr2 = array();
            foreach ($subArr as $key => $val) {
                $subArr2[] = $val['prl_disc_code'];
            }

            $comma_separated = implode(",", $subArr2);
            if ($comma_separated) {
                $q->AndWhere("e.work_station not in({$comma_separated})");
            }
//        }

        if (strlen($startDate)) {
            $q->AndWhere("e.emp_app_date <= '$startDate'")
        //    ->AndWhere("e.emp_resign_date > '$startDate'")
        //  ->AndWhere("e.emp_resign_date > '$startDate'")  
           ->AndWhere("(SELECT IFNULL(e1.emp_resign_date,'$startDate') as emp_resign_date from Employee e1 where e1.emp_number = e.emp_number) >= '$startDate'")
            //->OrWhere("e.emp_resign_date IS NULL")   
      
           ->AndWhere("e.emp_retirement_date > '$startDate'");
            //die(print_r($q->getSql()));
        }

//        if ($payroll == 'payroll') {
//            $q->AndWhere('e.emp_active_pr_flg = 1')
//              ->AndWhere('e.emp_ispaydownload = 1');
//        }
        }
        if (strlen($decryptprType)) {

            $q->AndWhere('p.prl_type_code = ?', $decryptprType);
        }
        $q->orderBy($orderField . ' ' . $orderBy);
//        die(print_r($q->getSql()));
        if ($decryptprType != 0) {
            return $q->fetchArray();
        }
    }
    
      public function readProcessbarIsRecord($startDate, $endDate, $User, $payRollType) {
                  $q = Doctrine_Query::create()
                ->select("count(a.pb_user)")
                ->from("PayrollProcessBar a")                
                ->Where("a.pb_startdate LIKE '{$startDate}'")
                ->Andwhere("a.pb_user =?", array($User))
                //->andWhere("a.pb_startdate ='{$endDate}'")
                ->andWhere('a.prl_type_code =?', array($payRollType))
                ->andWhere('a.pb_status = 0');
        return $q->fetchArray();
      }
      
            public function readProcessbar($payRollType,$startDate, $endDate, $User) {
                  $q = Doctrine_Query::create()
                ->select("a.*")
                ->from("PayrollProcessBar a")                
                ->Where("a.pb_startdate LIKE '{$startDate}'")
                ->Andwhere("a.pb_user =?", array($User))
                //->andWhere("a.pb_startdate ='{$endDate}'")
                ->andWhere('a.prl_type_code =?', array($payRollType));
                //->andWhere('a.pb_status = 0');
        return $q->fetchone();
      }
      
      
      public function resetProgressbar($startDate,$endDate,$payrollType,$User){
                            $q = Doctrine_Query::create()
                //->delete("a.*")
                ->delete("PayrollProcessBar a")                
                ->Where("a.pb_startdate LIKE '{$startDate}'")
                ->Andwhere("a.pb_user =?", array($User))
                //->andWhere("a.pb_startdate ='{$endDate}'")
                ->andWhere('a.prl_type_code =?', array($payrollType));
                //->andWhere('a.pb_status = 0');
         return $q->execute();
      }
    

}

?>
