<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 16 Auguest 2011
 *  Comments  - Loan Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class LoanSubDao extends BaseDao {

    public function getNoOfAvilableSlots() {
        $q = Doctrine_Query::create()
                ->select('COUNT(la.ln_sch_ins_no) AS noOfSlots')
                ->from('LoanSchedule la');
        return $q->fetchArray();
    }
    public function getToBeProcessedSheduleslot($empId,$hdSeq){
         //die($empId.$hdSeq);
        $q = Doctrine_Query::create()
                ->select('MIN(ls.ln_sch_ins_no) as tobeProcSlot')
                ->from('LoanSchedule ls')
                ->where('ls.ln_sch_is_processed=0')
                ->andWhere('ls.emp_number=?',array($empId))
                ->andWhere('ls.ln_hd_sequence=?',array($hdSeq));

        return $q->fetchArray();
    }
     public function getLoanShedulebyIds($empId,$slotId,$hdSeq){
        
           $q = Doctrine_Query::create()
                ->select('ls.*')
                ->from('LoanSchedule ls')
                ->where('ls.ln_sch_is_processed=0')
                ->andWhere('ls.emp_number=?',array($empId))
                ->andWhere('ls.ln_hd_sequence=?',array($hdSeq))
                ->andWhere('ls.ln_sch_ins_no=?',array($slotId));

        return $q->fetchOne();
      }

      public function updateHeaderforFullAmount($empId,$tyNumber){
           $q = Doctrine_Query::create()
                ->update('LoanHeader')
                ->set('ln_hd_bal_amount', 'ln_hd_amount')
                ->set('ln_hd_bal_installment', '0')
                ->set('ln_hd_settled_flg', '1')
                ->set('ln_hd_bal_installment', '0')
                ->set('ln_hd_is_active_flg', '1')
                ->where('emp_number =?',$empId)
                ->andWhere('ln_app_number =?',$tyNumber);
                

          return $q->execute();
      }
      public function updateLnShdFullSettle($tyNumber){

         $applicationId=$tyNumber;
         $loanDao=new LoanDao();
         $applicationDetails=$loanDao->readLoanApplication($applicationId);
         $lntypeId=$applicationDetails->ln_ty_number;
        
         $LoanType=$loanDao->getLoanTypebyID($lntypeId);
         $loanInterestType=$LoanType->ln_ty_interest_type;
         if($loanInterestType==0){
             //fixed interest
             $intersrtAmount=$LoanType->ln_ty_interest_fixed_amt;
             
         }
         else{
             //presentage interest
             $intersrtAmount=$LoanType->ln_ty_interest_rate/100*($applicationDetails->ln_app_amount);

             
         }
         $fullAmount=$fullAmount+$applicationDetails->ln_app_amount;

         $q = Doctrine_Query::create()
                ->update('LoanSchedule')
                ->set('ln_sch_inst_amount', $fullAmount)
                ->set('ln_sch_is_processed', '1')                              
                ->Where('ln_app_number =?',$tyNumber);


          return $q->execute();
         
       
      }

      /**
     *
     * Executes save read getEmployee byId  function
     * 
     * @param type $id
     * @return type 
     */
    public function getEmployeeId($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

}

?>
