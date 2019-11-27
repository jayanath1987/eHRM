<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Loan Module LoanService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class LoanService extends BaseService {

    private $loanDao;

    public function __construct() {
        $this->loanDao = new LoanDao();
    }

    public function searchLoanType($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->loanDao->searchLoanType($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }

    public function saveLoanType(LoanType $dg) {
        return $this->loanDao->saveLoanType($dg);
    }

    public function readLoanType($id) {
        return $this->loanDao->readLoanType($id);
    }

    public function deleteLoanType($id) {
        return $this->loanDao->deleteLoanType($id);
    }

      public function deleteApplication($appid,$lntype) {
        return $this->loanDao->deleteApplication($appid,$lntype);
    }

    public function getGuarantorDetails($guaNic) {
        return $this->loanDao->getGuarantorDetails($guaNic);
    }

    public function searchAppliedLoans($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->loanDao->searchAppliedLoans($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }

    public function readLoanApplication($id) {
        return $this->loanDao->readLoanApplication($id);
    }

    public function saveLoanApplication($dg) {
        return $this->loanDao->saveLoanApplication($dg);
    }

    public function getLoanTypeList() {
        return $this->loanDao->getLoanTypeList();
    }

    public function getLoanTypebyID($id) {
        return $this->loanDao->getLoanTypebyID($id);
    }

    public function searchLoanSettlement($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->loanDao->searchLoanSettlement($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }

    public function searchLoanHistoryandStatus($searchMode, $searchValue, $activeInactive, $activeInactiveValue, $empLoan, $empLoanValue, $culture, $orderField, $orderBy, $page) {
        return $this->loanDao->searchLoanHistoryandStatus($searchMode, $searchValue, $activeInactive, $activeInactiveValue, $empLoan, $empLoanValue, $culture, $orderField, $orderBy, $page);
    }

    public function readLoanSettlement($id) {
        return $this->loanDao->readLoanSettlement($id);
    }

    public function saveLoanSettlement(LoanSettlement $dg) {
        return $this->loanDao->saveLoanSettlement($dg);
    }

    public function saveGuarantee(LoanGuarantee $dg) {
        return $this->loanDao->saveGuarantee($dg);
    }

    public function readGuarantee($id) {
        return $this->loanDao->readGuarantee($id);
    }

    public function getLastLoanApplicationID() {
        return $this->loanDao->getLastLoanApplicationID();
    }

    public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    public function getGuaranteeList($app_number) {
        return $this->loanDao->getGuaranteeList($app_number);
    }

    public function deleteGuarantee($id) {
        return $this->loanDao->deleteGuarantee($id);
    }

    public function saveLoanHeader(LoanHeader $dg) {
        return $this->loanDao->saveLoanHeader($dg);
    }

    public function readLoanHeader($id) {
        return $this->loanDao->readLoanHeader($id);
    }

    public function deleteLoanHeader($id) {
        return $this->loanDao->deleteLoanHeader($id);
    }

    public function getSimpleInstalment($loanAmount, $monthlyCapital, $interestRate, $noOfInstallment) {
        return $this->loanDao->getSimpleInstalment($loanAmount, $monthlyCapital, $interestRate, $noOfInstallment);
    }

    public function saveLoanShedule(LoanSchedule $ls) {
        return $this->loanDao->saveLoanShedule($ls);
    }

    public function getMonthlyCapital($locanAmount, $noOfInstallment) {
        return $this->loanDao->getMonthlyCapital($locanAmount, $noOfInstallment);
    }

    public function getMonthlyInstalment($loanAmonunt, $monthlyCapital, $interestRate, $noOfInstallment) {
        $totalInterest = $this->loanDao->getTotalInterest($loanAmonunt, $noOfInstallment, $monthlyCapital, $interestRate);
        $monthlyInterest = $this->loanDao->getMonthlyInterest($totalInterest, $noOfInstallment);
        return $this->loanDao->getMonthlyInstalment($monthlyCapital, $monthlyInterest);
    }

    public function getFixedInstalment($monthlyCapital, $fixedInterest) {
        return $this->loanDao->getFixedInstalment($monthlyCapital, $fixedInterest);
    }

    public function searchEmployee($searchMode, $searchValue, $userCulture="en", $page=1, $orderField = 'emp_number', $orderBy = 'ASC', $type='single', $method='', $reason='', $att='', $todate, $payroll='') {
        return $this->loanDao->searchEmployee($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $type, $method, $reason, $att, $todate, $payroll);
    }

    public function selectEmployeeLoanType($empId) {
        return $this->loanDao->selectEmployeeLoanType($empId);
    }

    public function getEmployeeLoanType($empId) {
        return $this->loanDao->getEmployeeLoanType($empId);
    }

    public function getLoanTypebyIdArray($id = array()) {
        return $this->loanDao->getLoanTypebyIdArray($id);
    }

    public function readLoanHeaderByEmpIdAndType($empId, $tyNumber) {
        return $this->loanDao->readLoanHeaderByEmpIdAndType($empId, $tyNumber);
    }

    public function readLoanShedule($empId, $tyNumber) {
        return $this->loanDao->readLoanShedule($empId,  $tyNumber);
    }
     public function readLoanShedule1($empId, $hdSeq) {
        return $this->loanDao->readLoanShedule1($empId,  $hdSeq);
    }

    public function getLoanShedule($empId, $hdSeq, $tyNumber, $sheduleNum) {
        return $this->loanDao->getLoanShedule($empId, $hdSeq, $tyNumber, $sheduleNum);
    }
    public function getLastSheduleslot($empId, $hdSeq) {
        return $this->loanDao->getLastSheduleslot($empId,  $hdSeq);
    }


    public function getLastLoanSettlementID() {
        return $this->loanDao->getLastLoanSettlementID();
    }

    public function readPendingSheduleList($tyNumber) {
        return $this->loanDao->readPendingSheduleList($tyNumber);
    }

     public function deleteShedule($tyNumber){
         return $this->loanDao->deleteShedule($tyNumber);
     }
     public function deleteLoanHeader2($appId) {
          return $this->loanDao->deleteLoanHeader2($appId);
     }
      public function deleteLoanSchDule2($appId) {
          return $this->loanDao->deleteLoanSchDule2($appId);
     }
      public function  readLastSequenceNumber($empId){
           return $this->loanDao->readLastSequenceNumber($empId);
      }

      public function  getLoanList(){
           return $this->loanDao->getLoanList($empId);
      }
      public function LoadLoanAssignedToEmployee($empId){
          return $this->loanDao->LoadLoanAssignedToEmployee($empId);
      }
      public function getSumofLoanTotalWithInterst($appId){
         return $this->loanDao->getSumofLoanTotalWithInterst($appId);
      }

      public function getMaxLoanInstallment($id){
          return $this->loanDao->getMaxLoanInstallment($id);
      }
//    public function deleteShedule(LoanSchedule $Shedule) {
//        return $this->loanDao->deleteShedule($Shedule);
//    }
      
      public function getMaxLoanAppID(){
          return $this->loanDao->getMaxLoanAppID($id);
      }
      
      public function getLoanDetails($emp,$lnNo,$Type){
          return $this->loanDao->getLoanDetails($emp,$lnNo,$Type);
      }

}

?>
