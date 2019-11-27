<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Roshan
 *  On (Date) - 22 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class TransactionService extends BaseService {

    private $TransactionDao;

    public function __construct() {
        $this->TransactionDao = new TransactionDao();
    }

    public function readTtype($id){
        return $this->TransactionDao->readTtype($id);
    }
    public function saveObj($request){
        return $this->TransactionDao->saveObj($request);
    }
     public function getDefaultTransactionTypeId() {
         return $this->TransactionDao->getDefaultTransactionTypeId();
     }
     public function searchTransactiontypes($searchMode, $searchValue, $culture, $page, $orderField, $orderBy){
     //die($searchMode);
         return $this->TransactionDao->searchTransactiontypes($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
     }
     public function deleteTranaActionType($id){
            return $this->TransactionDao->deleteTranaActionType($id);
     }
     public function readTDetailtype($id){
         return $this->TransactionDao->readTDetailtype($id);
     }
     public function getDefaultTransactionDetailId(){
         return $this->TransactionDao->getDefaultTransactionDetailId();
     }
     public function getAllTransType(){
         return $this->TransactionDao->getAllTransType();
     }
     public function saveDetailObj($request){
         return $this->TransactionDao->saveDetailObj($request);
     }
     public function searchTransactionDetails($searchMode, $searchValue, $culture, $page, $orderField, $orderBy){
            return $this->TransactionDao->searchTransactionDetails($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
     }
     public function getContListByID($id){
            return $this->TransactionDao->getContListByID($id);
     }
     public function getContListByFilter($id){
            return $this->TransactionDao->getContListByFilter($id);
     }
     public function getBaseTransListByID($id){
         return $this->TransactionDao->getBaseTransListByID($id);
     }
     public function deleteTranaActionDetails($id){
         return $this->TransactionDao->deleteTranaActionDetails($id);
     }
     public function deleteTranaActionBase($id){
         return $this->TransactionDao->deleteTranaActionBase($id);
     }
     public function deleteTranaActionContibution($id){
         return $this->TransactionDao->deleteTranaActionContibution($id);
     }
      public function getAllTransactionDetails(){
         return $this->TransactionDao->getAllTransactionDetails();
     }
     public function getAllContList(){
         
         return $this->TransactionDao->getAllContList();
     }
     public function getAllTransTypeByFilter(){

         return $this->TransactionDao->getAllTransTypeByFilter();
     }
     public function getcontCodeBuTypeID($TransActionDetailId,$id){

         return $this->TransactionDao->getcontCodeBuTypeID($TransActionDetailId,$id);
     }
     public function getcontTypeForFilter($tDetailId){
         return $this->TransactionDao->getcontTypeForFilter($tDetailId);
     }
     public function getAllTransactionDetailsForBase($detailId){
        return $this->TransactionDao->getAllTransactionDetailsForBase($detailId);
     }






}
