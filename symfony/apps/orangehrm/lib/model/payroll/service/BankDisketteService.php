<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 16 11 2011
 *  Comments  - Payroll Module Bank Diskette Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class BankDisketteService extends BaseService {

    private $BankDisketteDao;

    public function __construct() {
        $this->BankDisketteDao = new BankDisketteDao();
    }
    
    public function searchBankDiskette($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->BankDisketteDao->searchBankDiskette($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readBankDiskette($id) {
        return $this->BankDisketteDao->readBankDiskette($id);
    }
    
    public function getView(){
        return $this->BankDisketteDao->getView();
    }   
    
    public function getColumnsByViewID($id) {
        return $this->BankDisketteDao->getColumnsByViewID($id);
    }
    
    public function saveBankDiskette(hsPrBankDiskette $hsPrBankDiskette){
        return $this->BankDisketteDao->saveBankDiskette($hsPrBankDiskette);
    }
    
    public function readBankDisketteDetail($id){
        return $this->BankDisketteDao->readBankDisketteDetail($id);
    }
    
    public function readBankDisketteMax(){
        return $this->BankDisketteDao->readBankDisketteMax();
    }
    
    public function savehsPrBankDisketteDetail(hsPrBankDisketteDetail $hsPrBankDisketteDetail){
        return $this->BankDisketteDao->savehsPrBankDisketteDetail($hsPrBankDisketteDetail);
    }

    public function getListBankDetail($id){
        return $this->BankDisketteDao->getListBankDetail($id);
    }
    
    public function readBankDisketteDetailByData($DiskId,$Position,$order){
        return $this->BankDisketteDao->readBankDisketteDetailByData($DiskId,$Position,$order);
    }
    
    public function searchBankDisketteProcessList($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->BankDisketteDao->searchBankDisketteProcessList($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function DetailViewColumn($view, $column,$Emp, $startdate, $enddate, $workstation,$bankcode,$emparray){
        return $this->BankDisketteDao->DetailViewColumn($view, $column,$Emp, $startdate, $enddate, $workstation,$bankcode,$emparray);
    }
    
    public function readBankDisketteProcess($Processid){
        return $this->BankDisketteDao->readBankDisketteProcess($Processid);
    }
    
    public function readBankDisketteProcessEmployee($Processid){
        return $this->BankDisketteDao->readBankDisketteProcessEmployee($Processid);
    }
    
    public function getBankDiskList(){
        return $this->BankDisketteDao->getBankDiskList();
    }
    
    public function savehsPrBankDiskette(hsPrBankDisketteProcess $hsPrBankDisketteProcess){
        return $this->BankDisketteDao->savehsPrBankDiskette($hsPrBankDisketteProcess);
    }
    
    public function readhsPrBankDisketteProcess($id){
        return $this->BankDisketteDao->readhsPrBankDisketteProcess($id);
    }
    
    public function readBankDisketteProcessMax(){
        return $this->BankDisketteDao->readBankDisketteProcessMax();
    }
    
    public function savehsPrBankDisketteProcessEmployee(hsPrBankDisketteProcessEmployee $hsPrBankDisketteProcessEmployee){
        return $this->BankDisketteDao->savehsPrBankDisketteProcessEmployee($hsPrBankDisketteProcessEmployee);
    }
    
    public function readhsPrBankDisketteProcessEmployee($id, $emp){
        return $this->BankDisketteDao->readhsPrBankDisketteProcessEmployee($id, $emp);
    }
    
    public function readhsPrBankDisketteProcessEmployeeID($id){
        return $this->BankDisketteDao->readhsPrBankDisketteProcessEmployeeID($id); 
    }
    
    public function DisketteEmployeeDelete($diskid,$empno){
        return $this->BankDisketteDao->DisketteEmployeeDelete($diskid,$empno);
    }
    
    public function deleteBankDiskette($id){
       return $this->BankDisketteDao->deleteBankDiskette($id); 
    }
    
    public function deleteBankDisketteDetail($id) {
        return $this->BankDisketteDao->deleteBankDisketteDetail($id);
    }
    
    public function BankDisketteProcessEmployee($id){
       return $this->BankDisketteDao->BankDisketteProcessEmployee($id); 
    }
    
    public function BankDisketteProcess($id) {
        return $this->BankDisketteDao->BankDisketteProcess($id);
    }
      public function defaultBankEmployeeLoad($bankName, $process_type,$dis_code) {
        return $this->BankDisketteDao->defaultBankEmployeeLoad($bankName, $process_type, $dis_code);
    }

}

?>
