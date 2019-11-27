<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Roshan Wijesena
 *  On (Date) - 29 June 2011
 *  Comments  - WorkFlow Service Class
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class WorkFlowService extends BaseService {
    
   private $wfDao;

   public function __construct() {
      $this->wfDao = new workflowDao();
   }
   public function getRiderctUrl($wfTypeID){
       
       return $this->wfDao->getRiderctUrl($wfTypeID);
   }
   public function getWorkflowDetailViewDetails($WfmainID, $approvingEmpName){
           return $this->wfDao->getWorkflowDetailViewDetails($WfmainID, $approvingEmpName);
   }      
   public function getWorkFlowRecordById($WfmainID){
       return $this->wfDao->getWorkFlowRecordById($WfmainID);
   }
   public function getEmployee($id){
       return $this->wfDao->getEmployee($id);
   }
   public function GetListedEmpids($cid){
       return $this->wfDao->GetListedEmpids($cid);
   }
}
