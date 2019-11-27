<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 22 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class TrainApprovalService extends BaseService {

   private $trainApprveDao;

   public function __construct() {       
      $this->trainApprveDao = new TrainApprovalDao();
   }
    public function getApproverDef($empid) {
        return $this->trainApprveDao->getApproverDef($empid);
    }
   public function getPendingListDivSec($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $DefLevel) {
        return $this->trainApprveDao->getPendingListDivSec($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $DefLevel);
   }
   public function updateAprovelDivSec($empid, $cid, $val, $CurStatus, $ApprSub, $ApprHead, $isapproved) {
       return $this->trainApprveDao->updateAprovelDivSec($empid, $cid, $val, $CurStatus, $ApprSub, $ApprHead, $isapproved);
   }
   public function getPendingListHRTeam($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $DefLevel) {
       return $this->trainApprveDao->getPendingListHRTeam($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $DefLevel);
   }
   public function updateAprovelHRTeam($empid, $cid, $val, $CurStatus, $ApprSub, $ApprHead, $isapproved) {
       return $this->trainApprveDao->updateAprovelHRTeam($empid, $cid, $val, $CurStatus, $ApprSub, $ApprHead, $isapproved);
   }
   public function getPendingListHRAdmin($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $DefLevel) {
       return $this->trainApprveDao->getPendingListHRAdmin($searchMode, $searchValue, $culture, $page, $orderField, $orderBy, $DefLevel);
   }
    public function updateEditAprovel($empid, $cid, $val) {
        return $this->trainApprveDao->updateEditAprovel($empid, $cid, $val);
    }
    public function updateAprovel($empid, $cid, $val) {
        return $this->trainApprveDao->updateAprovel($empid, $cid, $val);
    }
   public function getApprovedListList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy){
       return $this->trainApprveDao->getApprovedListList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
   }
   public function getPendingList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
       return $this->trainApprveDao->getPendingList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
   }
   
}
