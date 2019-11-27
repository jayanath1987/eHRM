<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Employee Payroll Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class EmployeePayrollService extends BaseService {

    private $EmployeePayrollDao;

    public function __construct() {
        $this->EmployeePayrollDao = new EmployeePayrollDao();
    }
    
    public function searchEmployeePayrollDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->EmployeePayrollDao->searchEmployeePayrollDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readEmployeePayrollDetails($id) {
        return $this->EmployeePayrollDao->readEmployeePayrollDetails($id);
    }
    
    public function readEmployee($id) {
        return $this->EmployeePayrollDao->readEmployee($id);
    }
    
    public function getJobGradeList($orderField = 'grade_code', $orderBy = 'ASC') {

         return $this->EmployeePayrollDao->getJobGradeList($orderField, $orderBy);

   }
   
   public function getGradeSlotByID($ID){
        return $this->EmployeePayrollDao->getGradeSlotByID($ID);
   }
    
//    public function getVoteType(){
//        return $this->AdministrationDao->getVoteType(); 
//    }
//    
    public function saveEmployeePayrollInformation(PayrollEmployee $PayrollEmp) {
        return $this->EmployeePayrollDao->saveEmployeePayrollInformation($PayrollEmp);
    }
    
    public function saveEmployee(Employee $Employee) {
        return $this->EmployeePayrollDao->saveEmployee($Employee);
    }
//    
//    public function deleteVoteDetails($id) {
//        return $this->AdministrationDao->deleteVoteDetails($id);
//    }
}
?>
