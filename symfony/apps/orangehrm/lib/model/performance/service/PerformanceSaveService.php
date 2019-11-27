<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Roshan
 *  On (Date)  - 10 Oct 2011
 *  Comments   - Performance Module TransferService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class PerformanceSaveService extends BaseService {

    private $PerformanceSaveDao;

    public function __construct() {
        $this->PerformanceSaveDao = new PerformanceSaveDao();
    }

    public function saveDutyGroup(PerformanceDutyGroup $dg) {
        return $this->PerformanceSaveDao->saveDutyGroup($dg);
    }

      public function deleteDutyGroup($id) {
        return $this->PerformanceSaveDao->deleteDutyGroup($id);
    }

     public function deleteDuty($id) {
        return $this->PerformanceSaveDao->deleteDuty($id);
    }

     public function deleteRateDetail($id) {
        return $this->PerformanceSaveDao->deleteRateDetail($id);
    }

     public function deleteRate($id) {
        return $this->PerformanceSaveDao->deleteRate($id);
    }

     public function deleteEvaluationCompanyInfo($id) {
        return $this->PerformanceSaveDao->deleteEvaluationCompanyInfo($id);
    }
public function deleteAssignDuty($eval_id, $dut_id) {
        return $this->PerformanceSaveDao->deleteAssignDuty($eval_id, $dut_id);
    }
 public function deleteEmployeeProject($PDID, $Empno) {
        return $this->PerformanceSaveDao->deleteEmployeeProject($PDID, $Empno);
    }
     public function deleteEmployeeDuty($PID, $Empno) {
        return $this->PerformanceSaveDao->deleteEmployeeDuty($PID, $Empno);
    }

     public function deleteAssingEmployee($eno, $eval) {
        return $this->PerformanceSaveDao->deleteAssingEmployee($eno, $eval);
    }

     public function deleteEvaluation($id) {
        return $this->PerformanceSaveDao->deleteEvaluation($id);
    }

    public function deleteJobRole($eval_id, $job_id) {
        return $this->PerformanceSaveDao->deleteJobRole($eval_id, $job_id);
    }

    public function getRatesObj($request, $Rate) {
        return $this->PerformanceSaveDao->getRatesObj($request, $Rate);
    }
    public function GetUpdateRateObj($request,$RateID) {
        return $this->PerformanceSaveDao->GetUpdateRateObj($request,$RateID);
    }



}

?>