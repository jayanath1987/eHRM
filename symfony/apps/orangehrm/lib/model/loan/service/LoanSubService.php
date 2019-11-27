<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Loan Module LoanService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class LoanSubService extends BaseService {

    private $loanSubDao;

    public function __construct() {
        $this->loanSubDao = new LoanSubDao();
    }

     public function getNoOfAvilableSlots(){
          return $this->loanSubDao->getNoOfAvilableSlots();
      }
      public function getToBeProcessedSheduleslot($empId,$hdSeq){
          return $this->loanSubDao->getToBeProcessedSheduleslot($empId,$hdSeq);
      }
      public function getLoanShedulebyIds($empId,$slotId,$hdSeq){
          return $this->loanSubDao->getLoanShedulebyIds($empId,$slotId,$hdSeq);
      }
      public function updateHeaderforFullAmount($empId,$tyNumber){
          return $this->loanSubDao->updateHeaderforFullAmount($empId,$tyNumber);
      }
      public function updateLnShdFullSettle($tyNumber){
         return $this->loanSubDao->updateLnShdFullSettle($tyNumber);
      }

    public function readGetEmployeeId($eid) {
        return $this->loanSubDao->getEmployeeId($eid);
    }



    

}
?>
