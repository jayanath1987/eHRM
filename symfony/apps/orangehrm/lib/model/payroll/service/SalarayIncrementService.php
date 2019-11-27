<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class SalarayIncrementService extends BaseService {

    private $SalarayIncrementDao;

    public function __construct() {
        $this->SalarayIncrementDao = new SalarayIncrementDao();
    }
    
    public function searchSalarayIncrementDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->SalarayIncrementDao->searchSalarayIncrementDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readSalarayIncrement($id) {
        return $this->SalarayIncrementDao->readSalarayIncrement($id);
    }
    
    public function getEmployee($insList = array()) {
        return $this->SalarayIncrementDao->getEmployee($insList);
    }
    
    public function getGradeSlotByID($Grade,$year) {
        return $this->SalarayIncrementDao->getGradeSlotByID($Grade,$year);
    }
    public function getGradeSlotByIDIncrement($Grade,$year) {
        return $this->SalarayIncrementDao->getGradeSlotByIDIncrement($Grade,$year);
    }
 
    public function saveSalarayIncrement(PayrollIncrement $PI) {
        return $this->SalarayIncrementDao->saveSalarayIncrement($PI);
    }
        
    public function updateEmployeeSalary($Emp,$Grade,$Slot){
        return $this->SalarayIncrementDao->updateEmployeeSalary($Emp,$Grade,$Slot); 
    }
    public function updateEmployeeEligibility($Emp,$newSal){
        return $this->SalarayIncrementDao->updateEmployeeEligibility($Emp,$newSal);
    }
    public function getNewSalary($sltId,$grdId){
         return $this->SalarayIncrementDao->getNewSalary($sltId,$grdId);
    }
    
    public function getSalaryIncrementEffectiveDateToday(){
        return $this->SalarayIncrementDao->getSalaryIncrementEffectiveDateToday();
    }
    
    public function findEmployee($id) {
        return $this->SalarayIncrementDao->findEmployee($id);
    }
    
    public function saveEmployee(Employee $Emp) {
        return $this->SalarayIncrementDao->saveEmployee($Emp);
    }    
    
    public function deleteIncrement($empno,$sltyr,$grade,$date) {
        return $this->SalarayIncrementDao->deleteIncrement($empno,$sltyr,$grade,$date);
    }
    
    public function getEmpProcessedDate(){
        return $this->SalarayIncrementDao->getEmpProcessedDate();
    }
    
    public function saveSalarayIncrementCancel(PayrollIncrementCancel $PI) {
        return $this->SalarayIncrementDao->saveSalarayIncrementCancel($PI);
    }

    public function searchSalarayIncrementDetailsCancel($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->SalarayIncrementDao->searchSalarayIncrementDetailsCancel($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
}
?>
