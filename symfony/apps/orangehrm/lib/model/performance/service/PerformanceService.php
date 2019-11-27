<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Performance Module TransferService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class PerformanceService extends BaseService {

    private $performanceDao;

    public function __construct() {
        $this->performanceDao = new PerformanceDao();
    }

   


    public function readDutyGroup($id) {
        return $this->performanceDao->readDutyGroup($id);
    }

  

  

    public function saveDuty(PerformanceDuty $dg,$request) {
        return $this->performanceDao->saveDuty($dg,$request);
    }

    public function readSDOEvaluation($id) {
        return $this->performanceDao->readSDOEvaluation($id);
    }

   

    public function readDutyGroupList() {
        return $this->performanceDao->readDutyGroupList();
    }

    public function readRateList() {
        return $this->performanceDao->readRateList();
    }

   

    public function saveRate(PerformanceRate $dg) {
        return $this->performanceDao->saveRate($dg);
    }

    public function readRate($id) {
        return $this->performanceDao->readRate($id);
    }

   

   

    public function saveEvaluationCompanyInfo(PerformanceEvaluation $dg,$request) {
        return $this->performanceDao->saveEvaluationCompanyInfo($dg,$request);
    }

    public function readEvaluationCompanyInfo($id) {
        return $this->performanceDao->readEvaluationCompanyInfo($id);
    }

   

    public function readYearList() {
        return $this->performanceDao->readYearList();
    }

    public function getLastRateID() {
        return $this->performanceDao->getLastRateID();
    }

    public function saveRateDetail(PerformanceRateDetails $dg) {
        return $this->performanceDao->saveRateDetail($dg);
    }

   

    function readRateDetailList($id,$opt) {
        return $this->performanceDao->readRateDetailList($id,$opt);
    }

    public function getEvaluationList() {
        return $this->performanceDao->getEvaluationList();
    }

    public function getEvaluationTypeList() {
        return $this->performanceDao->getEvaluationTypeList();
    }

    public function getEvaluationYear($id) {
        return $this->performanceDao->getEvaluationYear($id);
    }

    public function getEmployee($insList = array()) {
        return $this->performanceDao->getEmployee($insList);
    }

    public function getCompnayStructure($id) {
        return $this->performanceDao->getCompnayStructure($id);
    }

    public function getEvaluationEmpList($EVid, $ETId) {

        return $this->performanceDao->getEvaluationEmpList($EVid, $ETId);
    }

    public function getDeleteEvaluationEmpList($EVid, $ETId, $Enum, $Eval) {
        return $this->performanceDao->getDeleteEvaluationEmpList($EVid, $ETId, $Enum, $Eval);
    }

    public function saveEvaluationEmpList(PerformanceEvaluationEmployee $dg) {
        return $this->performanceDao->saveEvaluationEmpList($dg);
    }

  

    public function getDesignationList() {
        return $this->performanceDao->getDesignationList();
    }

 

   

    public function getLevelList() {
        return $this->performanceDao->getLevelList();
    }

    public function getJobRoleList($designation_code, $level_code, $service_code, $flg) {
        return $this->performanceDao->getJobRoleList($designation_code, $level_code, $service_code, $flg);
    }

    

    public function saveEvaluation(PerformanceEvaluationDetail $dg) {
        return $this->performanceDao->saveEvaluation($dg);
    }

    public function readEvaluation($id) {
        return $this->performanceDao->readEvaluation($id);
    }

   

    public function getServiceList() {
        return $this->performanceDao->getServiceList();
    }

    public function getDutyList() {
        return $this->performanceDao->getDutyList();
    }

    public function readEmployee($id) {
        return $this->performanceDao->readEmployee($id);
    }

    public function LoadsubordinateData($id) {
        return $this->performanceDao->LoadsubordinateData($id);
    }

    public function LoadSuperviserAllowEvaluation($id) {
        return $this->performanceDao->LoadSuperviserAllowEvaluation($id);
    }

   
    public function readProjectList($id) {
        return $this->performanceDao->readProjectList($id);
    }

    public function readSDOEMPList($Evalid, $Enum) {
        return $this->performanceDao->readSDOEMPList($Evalid, $Enum);
    }

    public function readEvalDetailID($JobTitle, $Level, $Service, $EvalID) {
        return $this->performanceDao->readEvalDetailID($JobTitle, $Level, $Service, $EvalID);
    }

    public function readEvalDutyList($id) {
        return $this->performanceDao->readEvalDutyList($id);
    }

    public function readRateDetails($id) {
        return $this->performanceDao->readRateDetails($id);
    }

    public function savePerformanceEvaluationDuty(PerformanceEvaluationDuty $dg) {
        return $this->performanceDao->savePerformanceEvaluationDuty($dg);
    }

    public function getLastEvaluationID() {
        return $this->performanceDao->getLastEvaluationID();
    }

    public function getEvaluationAssignDutyList($eval_id) {
        return $this->performanceDao->getEvaluationAssignDutyList($eval_id);
    }

    

    public function getEmployerAssignDuty($eval_id) {
        return $this->performanceDao->getEmployerAssignDuty($eval_id);
    }

    public function saveSDOEvaluation(PerformanceEvaluationEmployee $dg) {
        return $this->performanceDao->saveSDOEvaluation($dg);
    }

    public function savePerformanceEvaluationEmployeeProject(PerformanceEvaluationEmployeeProject $dg) {
        return $this->performanceDao->savePerformanceEvaluationEmployeeProject($dg);
    }

    public function deleteEvaluationEmployeeProject($PDID, $Empno, $PID) {
        return $this->performanceDao->deleteEvaluationEmployeeProject($PDID, $Empno, $PID);
    }

    public function savePerformanceEvaluationEmployeeDuty(PerformanceEvaluationEmployeeDuty $dg) {
        return $this->performanceDao->savePerformanceEvaluationEmployeeDuty($dg);
    }

    public function deletePerformanceEvaluationEmployeeDuty($PID, $Empno, $DID) {
        return $this->performanceDao->deletePerformanceEvaluationEmployeeDuty($PID, $Empno, $DID);
    }

    public function readProjectDetails($id, $Empno, $EvalId) {
        return $this->performanceDao->readProjectDetails($id, $Empno, $EvalId);
    }

    public function readDutyRateComment($id, $Empno, $EvalId) {
        return $this->performanceDao->readDutyRateComment($id, $Empno, $EvalId);
    }

    public function SDOProjectRateComment($id, $Empno, $EvalId) {
        return $this->performanceDao->SDOProjectRateComment($id, $Empno, $EvalId);
    }

    public function readAssignDuty($eval_id, $dut_id) {
        return $this->performanceDao->readAssignDuty($eval_id, $dut_id);
    }

    public function getEvaluationSDO($EVid, $ETId, $Enum, $Eval) {
        return $this->performanceDao->getEvaluationSDO($EVid, $ETId, $Enum, $Eval);
    }

   

   

    public function readDuty($id) {
        return $this->performanceDao->readDuty($id);
    }

    public function getEvaluationSavedEmpList($EVid, $Empnum) {
        return $this->performanceDao->getEvaluationSavedEmpList($EVid, $Empnum);
    }

    public function saveEvaluationSupervisor(PerformanceEvaluationSupervisor $dg) {
        return $this->performanceDao->saveEvaluationSupervisor($dg);
    }

    public function readEvaluationSupervisor($eval_id, $empno) {
        return $this->performanceDao->readEvaluationSupervisor($eval_id, $empno);
    }

    public function readAjaxSupervisor($EVid, $Enum, $ESup) {
        return $this->performanceDao->readAjaxSupervisor($EVid, $Enum, $ESup);
    }

    public function updateEvaluationSupervisor($eval_id, $empno, $Supflag) {
        return $this->performanceDao->updateEvaluationSupervisor($eval_id, $empno, $Supflag);
    }

    public function SDOEmployee($id, $Empno, $EvalId) {
        return $this->performanceDao->SDOEmployee($id, $Empno, $EvalId);
    }

    public function saveJobRole(PerformanceEvaluationJobRole $pj) {
        return $this->performanceDao->saveJobRole($pj);
    }

    

    public function getEvaluationJobRoleList($eval_id) {
        return $this->performanceDao->getEvaluationJobRoleList($eval_id);
    }
    public function CheckEvalIdExsist($id){
        return $this->performanceDao->CheckEvalIdExsist($id);
    }
    public function getEvalEmpListById($id){
        return $this->performanceDao->getEvalEmpListById($id);
    }
    public function getDirectSupervicerName($id){
        return $this->performanceDao->getDirectSupervicerName($id);
    }
    public function readSuperViceData($evalId,$empId){
        return $this->performanceDao->readSuperViceData($evalId,$empId);
    }
    public function deleteEmpSupEval($evalId,$ETID){
        return $this->performanceDao->deleteEmpSupEval($evalId,$ETID);
    }
    public function getEvalEmpListByIdNotInSup($ID,$empArr,$Type){
        return $this->performanceDao->getEvalEmpListByIdNotInSup($ID,$empArr,$Type);
    }
     public function isDirectSuperVicer($supId,$subId){
        return $this->performanceDao->isDirectSuperVicer($supId,$subId);
    }
    
    public function getEvalEmpListById2($id,$type){
        return $this->performanceDao->getEvalEmpListById2($id,$type);
    }



    

}

?>
