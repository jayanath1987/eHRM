<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Roshan
 *  On (Date) - 22 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class AssignEmployeeService extends BaseService {

    private $AssignEmpDao;

    public function __construct() {
        $this->AssignEmpDao = new AssignEmployeeDao();
    }
    public function getAssignedEmployees($fromDate, $toDate, $culture, $page, $orderField, $orderBy,$detailCode){        
        return $this->AssignEmpDao->getAssignedEmployees($fromDate, $toDate, $culture, $page, $orderField, $orderBy,$detailCode);
    }
    public function getEmpDetailsToGrid($empIdArr){
        return $this->AssignEmpDao->getEmpDetailsToGrid($empIdArr);
    }

    public function getCompnayStructure($id){
        return $this->AssignEmpDao->getCompnayStructure($id);
    }
    public function readEligibility($empId,$detailId){
        return $this->AssignEmpDao->readEligibility($empId,$detailId);
    }
    public function saveElg($eleg){
        $eleg->save();
    }
    public function getAssignedAllEmployees($transDetailId){
        return $this->AssignEmpDao->getAssignedAllEmployees($transDetailId);
    }
    public function getEmpbasicSalary($empId){
        return $this->AssignEmpDao->getEmpbasicSalary($empId);
    }
    public function getContriPersn($transDetailType){
       return $this->AssignEmpDao->getContriPersn($transDetailType);
    }
    public function saveElgToAll($transID,$transDetailID,$txtAppAllAmount,$txtFromDateApplyAll,$txtToDateApplyAll){
         return $this->AssignEmpDao->saveElgToAll($transID,$transDetailID,$txtAppAllAmount,$txtFromDateApplyAll,$txtToDateApplyAll);
    }

    public function getTypeTypeByDetailId($id){
         return $this->AssignEmpDao->getTypeTypeByDetailId($id);
    }
//    public function test($detailId,$empId){
//        return $this->AssignEmpDao->readEligibility($detailId,$empId);
//    }

}
?>
