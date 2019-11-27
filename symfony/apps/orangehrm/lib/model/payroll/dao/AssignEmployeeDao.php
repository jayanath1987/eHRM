<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - roshan
 *  On (Date) - 22 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class AssignEmployeeDao extends BaseDao {

    public function getAssignedEmployees($fromDate="",$toDate="", $culture="", $page=1, $orderField='', $orderBy='ASC',$detailCode='') {
        

        $q = Doctrine_Query::create()
                        ->select('g.emp_number,e.*')
                        ->from('PayRollEligibility g')
                        ->innerJoin('g.Employee e')
                        ->innerJoin('e.PayrollEmployee p');

                            
                $q->AndWhere('e.emp_active_pr_flg = 1');

     

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
//                                       die(print_r($comma_separated));
        if ($comma_separated) {
            $q->AndWhere("e.work_station not in({$comma_separated})");
        }


                        $q->where('g.trn_dtl_code=?',array($detailCode));

        if($fromDate!="" && $toDate!=""){
                $q->andWhere("g.trn_dtl_startdate >= ?",array($fromDate))
                      ->andWhere("g.trn_dtl_enddate <= ?",array($toDate));
        }
       
//        if ($searchValue != "") {
//
//            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
//        }
//        $q->orderBy($orderField . ' ' . $orderBy);
        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;
        //$resultsPerPage = 2;
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
                        "?page={%page_number}&mode=search&fromDate={$fromDate}&toDate={$toDate}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function getTransDetailByID($id) {
        $q = Doctrine_Query::create()
                        ->select('p.*')
                        ->from('PRTransDetails p')
                        ->where('p.trn_typ_code = ?', $id)
                        ->andWhere('p.trn_disable_flg = 0');

        return $q->execute();
    }

    public function getTransTypeTypeByID($id){

        $q = Doctrine_Query::create()
                        ->select('p.trn_typ_type')
                        ->from('PRTransActiontype p')
                        ->where('p.trn_typ_code = ?', $id);

        return $q->execute();
        
    }
    

    public function getEmpDetailsToGrid($insList = array()){
           
            
        if (is_array($insList)) {
            $q = Doctrine_Query::create()
                    ->select('p.emp_number,e.*')
                    ->from('PayrollEmployee p')
                    ->leftJoin('p.Employee e on e.emp_number=p.emp_number')
                    ->whereIn('p.emp_number', $insList);
                   
            return $q->fetchArray();
        }
    }

       public function getCompnayStructure($id) {
        
            return Doctrine::getTable('CompanyStructure')->find($id);
       
        }

    public function readEligibility($empId,$detailId){
         return Doctrine::getTable('PayRollEligibility')->find(array($empId,$detailId));
    }
    public function getAssignedAllEmployees($detailId){
        $query = Doctrine_Query::create()
                        ->select('g.emp_number,e.*')
                        ->from('PayRollEligibility g')
                        ->innerJoin('g.Employee e')
                        ->innerJoin('e.PayrollEmployee p')
                        ->where('g.trn_dtl_code=?',array($detailId));
        return $query->execute();


    }

    public function getEmpbasicSalary($eId){
        
        $query = Doctrine_Query::create()
                        ->select('s.emp_basic_salary')
                        ->from('GradeSlot s')
                        ->innerJoin('s.Employee e on s.slt_id=e.slt_scale_year')
                        ->where('e.emp_number=?',array($eId));
        return $query->execute();

    }
    public function getContriPersn($transDetailType){
        
         $query = Doctrine_Query::create()
                        ->select('p.trn_dtl_empcont,p.trn_dtl_eyrcont')
                        ->from('PRTransDetails p')
                        ->where('p.trn_dtl_code=?',array($transDetailType));
        return $query->execute();
    }
    public function saveElgToAll($transID,$transDetailID,$txtAppAllAmount,$txtFromDateApplyAll,$txtToDateApplyAll){
       $q = Doctrine_Query::create()
                        ->select('e.*,j.*,s.*,d.*,u.*,p.*')
                        ->from('Employee e')
                        ->leftJoin('e.jobTitle j')
                        ->leftJoin('e.ServiceDetails s')
                        ->leftJoin('e.subDivision d');

                $q->leftJoin('e.PayrollEmployee p')
                ->AndWhere('e.emp_active_pr_flg = 1')
                ->AndWhere('e.emp_ispaydownload = 1');

//        $subQuery1 = Doctrine_Query::create()
//                        ->select('y.*')
//                        ->from('payprocessCapability y')
//                        ->where('y.emp_number=?', array($_SESSION['empNumber']));
//        $subArrEmp = $subQuery1->fetchArray();
//        $subArr3 = array();
//        foreach ($subArrEmp as $key => $val) {
//            $subArr3[] = $val['prl_type_code'];
//        }
//
//        $comma_separated1 = implode(",", $subArr3);
//
//        if ($comma_separated1) {
//            $q->AndWhere("p.prl_type_code  in({$comma_separated1})");
//        }

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
//                                       die(print_r($comma_separated));
        if ($comma_separated) {
            $q->AndWhere("e.work_station not in({$comma_separated})");
        }
        $q->orWhere("e.emp_number=?", array($_SESSION['empNumber']));

        $EmplistArray = $q->fetchArray();
        $empArray = array();
        foreach ($EmplistArray as $key => $val) {
           $empArray[]=$val['empNumber'];
        }

        //Delete Assigned Elg
//         $queryDelete = Doctrine_Query :: create()->delete('EmpDependent ec')
//                ->where('emp_number = ?', $empNumber)
//                ->andwhere('seqno = ?', $entriesToDelete);
//
//        $result = $queryDelete->execute();
//        return $result;

        // Save bulk
        $AssignEmpService=new AssignEmployeeService();
         foreach ($empArray as $key => $val) {
         
                 $empEligibility = $AssignEmpService->readEligibility($val,$transDetailID);

                      if($empEligibility){
                      
                            $empEligibility = $AssignEmpService->readEligibility($val,$transDetailID);
               
                        }else{
                            $empEligibility = new PayRollEligibility();
                        }

                        $empEligibility->setEmp_number($val);

                        $empEligibility->setTrn_dtl_code($transDetailID);

                        if(!strlen($txtAppAllAmount)){
                        $empEligibility->setTre_amount(null);
                        }else{

                        
                        $empEligibility->setTre_amount($txtAppAllAmount);
                        }
                        if(!strlen($txtFromDateApplyAll)){
                        $empEligibility->setTrn_dtl_startdate(date("Y-m-d"));
                        }else
                        {
                        $empEligibility->setTrn_dtl_startdate($txtFromDateApplyAll);
                        }
                        if(!strlen($txtToDateApplyAll)){
                        $empEligibility->setTrn_dtl_enddate(date("Y-m-d"));
                        }
                        else{
                        $empEligibility->setTrn_dtl_enddate($txtToDateApplyAll);
                        }
                                                                      
                        $empEligibility->setTre_stop_flag(0);
                        $empEligibility->save();
                       
         }
    }

    public function getTypeTypeByDetailId($id){

          $query = Doctrine_Query::create()
                        ->select('p.trn_dtl_code,t.trn_typ_type,t.erndedcon')
                        ->from('PRTransDetails p')
                        ->leftJoin('p.PRTransActiontype t on t.trn_typ_code=p.trn_typ_code')
                        ->where('p.trn_dtl_code=?',array($id));
        return $query->execute();

    }
    
     public function getTransDetailForBase($id) {
        $q = Doctrine_Query::create()
                        ->select('p.*')
                        ->from('PRTransDetails p')
                        ->where('p.trn_dtl_code = ?', $id);

        return $q->execute();
    }
    
    public function readEPF($id) {
        $q = Doctrine_Query::create()
                        ->select('count(p.emp_number)')
                        ->from('PayrollEmployee p')
                        ->where('p.emp_epf_number = ?', $id);

        return $q->fetchArray();
    }
    
    public function readETF($id) {
        $q = Doctrine_Query::create()
                        ->select('count(p.emp_number)')
                        ->from('PayrollEmployee p')
                        ->where('p.emp_etf_number = ?', $id);

        return $q->fetchArray();
    }

}

?>