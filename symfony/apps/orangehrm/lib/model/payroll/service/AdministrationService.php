<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class AdministrationService extends BaseService {

    private $AdministrationDao;

    public function __construct() {
        $this->AdministrationDao = new AdministartionDao();
    }
    
    public function searchVoteDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->AdministrationDao->searchVoteDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readVoteDetails($id) {
        return $this->AdministrationDao->readVoteDetails($id);
    }
    
    public function getVoteType(){
        return $this->AdministrationDao->getVoteType(); 
    }
    
    public function saveVoteDetails(PayrollVote $vd) {
        return $this->AdministrationDao->saveVoteDetails($vd);
    }
    
    public function deleteVoteDetails($id) {
        return $this->AdministrationDao->deleteVoteDetails($id);
    }
    
    public function getPayrollType($id){
        return $this->AdministrationDao->getPayrollType($id);
    }
    public function getPayrollType1(){
        return $this->AdministrationDao->getPayrollType1();
    }
    public function getPayrollDisc($id){
        return $this->AdministrationDao->getPayrollDisc($id);
    }

    
    public function readConfigurationShedulePerYear($Year,$ComCode){
        return $this->AdministrationDao->readConfigurationShedulePerYear($Year,$ComCode); 
    }
    
    public function saveShedule(PayrollSchedule $ps) {
        return $this->AdministrationDao->saveShedule($ps);
    }
    
    public function readConfigurationShedule($id){
        return $this->AdministrationDao->readConfigurationShedule($id);
    }
    
    public function getMaxLockID($ID){
        return $this->AdministrationDao->getMaxLockID($ID);
    }
    
    public function getMaxUnlockID($ID){
        return $this->AdministrationDao->getMaxUnlockID($ID);
    }
    
    public function getDistrict(){
        return $this->AdministrationDao->getDistrict();
    }
    
    public function getDivisionByDistrict($ID){
        return $this->AdministrationDao->getDivisionByDistrict($ID);
    }
    
    public function readEmployee($ID){
        return $this->AdministrationDao->readEmployee($ID);
    }
    
    public function getMax(){
        return $this->AdministrationDao->getMax();
    }
      public function getLastUnlockPayShedule() {
        return $this->AdministrationDao->getLastUnlockPayShedule();
    }
        public function getPayrollTypeID($id){
        return $this->AdministrationDao->getPayrollTypeID($id);
    }
    
}
?>
