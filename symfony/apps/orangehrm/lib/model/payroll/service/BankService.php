<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 12 Octomber 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class BankService extends BaseService {

    private $BankDao;

    public function __construct() {
        $this->BankDao = new BankDao();
    }
    
    public function searchBankDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->BankDao->searchBankDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readBankDetails($id) {
        return $this->BankDao->readBankDetails($id);
    }
    
    public function getParentBankList($id) {
        return $this->BankDao->getParentBankList();
    }
    
    public function saveBankDetails(PayRollBank $bank){
        return $this->BankDao->saveBankDetails($bank);
    }
    
    public function getMaxBank(){
        return $this->BankDao->getMaxBank();
    }
    
    public function deleteBankDetails($id) {
        return $this->BankDao->deleteBankDetails($id);
    }
    
        public function searchBranchDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->BankDao->searchBranchDetails($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readBranchDetails($id) {
        return $this->BankDao->readBranchDetails($id);
    }

    public function getBankList() {
        return $this->BankDao->getBankList();
    }
    
    public function saveBranchDetails(PayRollBranch $branch){
        return $this->BankDao->saveBranchDetails($branch);
    }
    
    public function getMaxBranch(){
        return $this->BankDao->getMaxBranch();
    }
    
    public function deleteBranchDetails($id) {
        return $this->BankDao->deleteBranchDetails($id);
    }
    
    public function EmployeeBankDetails($id) {
        return $this->BankDao->EmployeeBankDetails($id);
    }
    
    public function readEmployeeBankDetails($empno,$branchcode,$accno,$acctype) {
        return $this->BankDao->readEmployeeBankDetails($empno,$branchcode,$accno,$acctype);
    }
    
    public function readEmployeeBankDetailsByEmployee($EmpNo){
        return $this->BankDao->readEmployeeBankDetailsByEmployee($EmpNo);
    }
    
    public function getBranchfromBank($bankcode){
        return $this->BankDao->getBranchfromBank($bankcode);
    }
    
    public function getAccountTypeList(){
        return $this->BankDao->getAccountTypeList();
    }
    
    public function getBankDetailsbydata($empno,$branch,$accounttype,$accountno){
        return $this->BankDao->getBankDetailsbydata($empno,$branch,$accounttype,$accountno);
    }
    
    public function savePayRollEmployeeBank(PayRollEmployeeBank $PayRollEmployeeBank){
        return $this->BankDao->savePayRollEmployeeBank($PayRollEmployeeBank);
    }
    
    public function DeleteEmployeeBankDetails($empno,$branchcode,$accno,$acctype){
        return $this->BankDao->DeleteEmployeeBankDetails($empno,$branchcode,$accno,$acctype);
    }
    
        public function readEmployee($id) {
        return $this->BankDao->readEmployee($id);
    }
}

?>
