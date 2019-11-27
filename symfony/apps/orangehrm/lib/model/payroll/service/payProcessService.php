<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class payProcessService extends BaseService {

    private $payProcessDao;

    public function __construct() {
        $this->payProcessDao = new payProcessDao();
    }

     public function readProcessedEmp($batchId,$empId,$payrolltype){
         return $this->payProcessDao->readProcessedEmp($batchId,$empId,$payrolltype);
         
    }
     public function listProcessedEmpList($payrolltype,$startDate,$endDate,$batchId){
         return $this->payProcessDao->listProcessedEmpList($payrolltype,$startDate,$endDate,$batchId);

    }
    public function getPaySlipDetails($startDate,$endDate,$empNumber){
         return $this->payProcessDao->getPaySlipDetails($startDate,$endDate,$empNumber);
    }
    public function getPaySlipDetailsTXN($startDate,$endDate,$empNumber){
         return $this->payProcessDao->getPaySlipDetailsTXN($startDate,$endDate,$empNumber);
    }
    
    public function getPaySlipDetailsLoan($startDate,$endDate,$empNumber){
         return $this->payProcessDao->getPaySlipDetailsLoan($startDate,$endDate,$empNumber);
    }   
    
    public function getPaySlipDetailsLoanRemain($startDate,$endDate,$empNumber){
         return $this->payProcessDao->getPaySlipDetailsLoanRemain($startDate,$endDate,$empNumber);
    }  
}

?>
