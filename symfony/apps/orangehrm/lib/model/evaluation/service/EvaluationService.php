<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Jayanath Liyanage
 *  On (Date)  - 10 May 2013
 *  Comments   - EvaluationModule TransferService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class EvaluationService extends BaseService {

    private $EvaluationDao;

    public function __construct() {
        $this->EvaluationDao = new EvaluationDao();
    }

    public function searchRate($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->EvaluationDao->searchRate($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function saveRate(EvaluationRate $dg) {
        return $this->EvaluationDao->saveRate($dg);
    }
    
    public function saveRateDetail(EvaluationRateDetails $dg) {
        return $this->EvaluationDao->saveRateDetail($dg);
    }
     
    public function getRatesObj($request, $Rate) {
        return $this->EvaluationDao->getRatesObj($request, $Rate);
    }   
    
    public function getLastRateID() {
        return $this->EvaluationDao->getLastRateID();
    }
    
    public function readRate($id) {
        return $this->EvaluationDao->readRate($id);
    }
    
    public function readRateDetailList($id,$opt) {
        return $this->EvaluationDao->readRateDetailList($id,$opt);
    }
    
    public function GetUpdateRateObj($request,$RateID) {
        return $this->EvaluationDao->GetUpdateRateObj($request,$RateID);
    }
     
    public function deleteRateDetail($id) {
        return $this->EvaluationDao->deleteRateDetail($id);
    }
    
    public function deleteRate($id) {
        return $this->EvaluationDao->deleteRate($id);
    }
    
    public function searchEvaluationCompanyInfo($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->EvaluationDao->searchEvaluationCompanyInfo($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readYearList() {
        return $this->EvaluationDao->readYearList();
    }
    
    public function readRateList() {
        return $this->EvaluationDao->readRateList();
    }
    
    public function saveEvaluationCompanyInfo(EvaluationCompany $dg,$request) {
        return $this->EvaluationDao->saveEvaluationCompanyInfo($dg,$request);
    }
    
     public function readEvaluationCompanyInfo($id) {
        return $this->EvaluationDao->readEvaluationCompanyInfo($id);
    }
    
    public function getEvaluationEmpList($EVid) {

        return $this->EvaluationDao->getEvaluationEmpList($EVid);
    }
    
    public function getEvaluationList() {
        return $this->EvaluationDao->getEvaluationList();
    }
    
    public function getEvaluationYear($id) {
        return $this->EvaluationDao->getEvaluationYear($id);
    }
    
    public function getEmployee($insList = array()) {
        return $this->EvaluationDao->getEmployee($insList);
    }

    
    public function searchEmployee($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $type, $method, $reason, $att, $EVid, $ETid) {
        return $this->EvaluationDao->searchEmployee($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $type, $method, $reason, $att, $EVid, $ETid);
    }
    
    public function getDeleteEvaluationEmpList($EVid, $Enum) {
        return $this->EvaluationDao->getDeleteEvaluationEmpList($EVid, $Enum);
    }
    
    public function getMaxEvaluationSupervisorNominee(){
        return $this->EvaluationDao->getMaxEvaluationSupervisorNominee();
    }
      
    public function getEmployeeDetail($eno) {
        return $this->EvaluationDao->getEmployeeDetail($eno);
    }
    
    public function EvalFunctionTask($searchMode, $searchValue, $culture, $orderField, $orderBy, $page) {
        return $this->EvaluationDao->EvalFunctionTask($searchMode, $searchValue, $culture, $orderField, $orderBy, $page);
    }
    
    public function readEvalFunctionTask($id) {
        return $this->EvaluationDao->readEvalFunctionTask($id);
    }
    
    public function LoadEmpData($id) {
        return $this->EvaluationDao->LoadEmpData($id);
    }
    
    public function DeleteEvalFunctionTask($id) {
        return $this->EvaluationDao->DeleteEvalFunctionTask($id);
    }
    
    public function viewall($from, $to, $page, $eno, $type, $orderField , $orderBy, $EmployeeSub1,$chkAll,$chkPending,$chkApproved,$chkRejected,$chkCanceled,$chkTaken) {
        return $this->EvaluationDao->viewall($from, $to, $page, $eno, $type, $orderField , $orderBy, $EmployeeSub1,$chkAll,$chkPending,$chkApproved,$chkRejected,$chkCanceled,$chkTaken);
    }
    
    public function EmployeeEvaluationList($searchMode, $searchValue, $culture, $orderField, $orderBy, $page, $emp, $type) {
        return $this->EvaluationDao->EmployeeEvaluationList($searchMode, $searchValue, $culture, $orderField, $orderBy, $page, $emp, $type);
    }
    
    public function getGetFTData($comeval,$eno) {
        return $this->EvaluationDao->getGetFTData($comeval,$eno);
    }
        
    public function getGetSMData($comeval,$eno,$ev_id) {         
        return $this->EvaluationDao->getGetSMData($comeval,$eno,$ev_id);
    }
    
    public function getGet360Data($comeval,$eno,$ev_id) {
        return $this->EvaluationDao->getGet360Data($comeval,$eno,$ev_id);
    }
    
    public function readEvalEmployee($id) {
        return $this->EvaluationDao->readEvalEmployee($id);
    }
    
    public function readFuntionTask($id) {
        return $this->EvaluationDao->readFuntionTask($id);
    }
    
    public function readEvaluationSkillEmployee($id,$compid,$eno) {
        return $this->EvaluationDao->readEvaluationSkillEmployee($id,$compid,$eno);
    }
    
    public function getLastEvaluationSkillEmployeeID() {
        return $this->EvaluationDao->getLastEvaluationSkillEmployeeID();
    }
    
    public function readEvaluationTSEmployee($id,$compid,$eno) {
        return $this->EvaluationDao->readEvaluationTSEmployee($id,$compid,$eno);
    }
    
    public function getLastEvaluationTSEmployeeID() {
        return $this->EvaluationDao->getLastEvaluationTSEmployeeID();
    }    
    
    public function deleteTS($id,$compid,$eno) {
        return $this->EvaluationDao->deleteTS($id,$compid,$eno);
    }  
    
    public function deleteMS($id,$compid,$eno) {
        return $this->EvaluationDao->deleteMS($id,$compid,$eno);
    }  
    
    public function deleteFT($id,$compid,$eno) {
        return $this->EvaluationDao->deleteFT($id,$compid,$eno);
    }  
    
    public function deleteEvaluationEmployee($compid,$eno) {
        return $this->EvaluationDao->deleteEvaluationEmployee($compid,$eno);
    }
    public function getGetFTDataEval($comeval,$eno) {
        return $this->EvaluationDao->getGetFTDataEval($comeval,$eno);
    }
        
    public function getGetSMDataEval($comeval,$eno,$ev_id) {         
        return $this->EvaluationDao->getGetSMDataEval($comeval,$eno,$ev_id);
    }
    
    public function getGet360DataEval($comeval,$eno,$ev_id) {
        return $this->EvaluationDao->getGet360DataEval($comeval,$eno,$ev_id);
    }
    
    public function getLastEvaluationEmployee() {
        return $this->EvaluationDao->getLastEvaluationEmployee();
    }  
    
    public function readRateDetails($rateId){
        return $this->EvaluationDao->readRateDetails($rateId);
    }    
    
    public function gettslistbylevel($id){
        return $this->EvaluationDao->gettslistbylevel($id);
    }
    
    public function readEvaluationComment($Type,$id){
        return $this->EvaluationDao->readEvaluationComment($Type,$id); 
   }
}

?>
