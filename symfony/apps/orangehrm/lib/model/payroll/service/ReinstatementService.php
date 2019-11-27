<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 14 September 2011
 *  Comments  - Reinstatement Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class ReinstatementService extends BaseService {

    private $ReinstatementDao;

    public function __construct() {
        $this->ReinstatementDao = new ReinstatementDao();
    }
    
    public function searchReinstatement($searchMode, $searchValue, $culture='en', $orderField = 'r.rei_id', $orderBy = 'ASC', $page = 1){
        
       return $this->ReinstatementDao->searchReinstatement($searchMode, $searchValue, $culture='en', $orderField, $orderBy , $page = 1);
         
   }
   
   public function readEmployee($id){
       
       return $this->ReinstatementDao->readEmployee($id);
   }
   
   public function readPayrollEmployee($id){
       
       return $this->ReinstatementDao->readPayrollEmployee($id);
   }
   
   public function readReinstatement($id){
       
       return $this->ReinstatementDao->readReinstatement($id);
   
   }
   
   public function getDesignation() {

         return $this->ReinstatementDao->getDesignation();

   }
   
   public function getGradeLoad() {

         return $this->ReinstatementDao->getGradeLoad();

   }
   
   public function saveReinstatement(Reinstatement $Reinstatement) {

         return $this->ReinstatementDao->saveReinstatement($Reinstatement);

   }
   
    public function savePayrollEmployee(PayrollEmployee $PayrollEmployee) {

         return $this->ReinstatementDao->savePayrollEmployee($PayrollEmployee);

   }
   
   public function getPendingUpadateReinstatement(){
       
       return $this->ReinstatementDao->getPendingUpadateReinstatement();
   }
   
   public function deleteReinstatement($id) {

         return $this->ReinstatementDao->deleteReinstatement($id);

   }
   
  public function searchEmployee($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'emp_number', $orderBy = 'ASC', $type='single', $method='',$reason='',$att='',$payroll='') {
        return $this->ReinstatementDao->searchEmployee($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $type, $method,$reason,$att,$payroll);
  }
}
?>
