<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Roshan Wijesena
 *  On (Date) - 29 June 2011
 *  Comments  - WorkFlow Service Class
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class GroupApprovalService extends BaseService {
    
   private $appDao;

   public function __construct() {
      $this->appDao = new GroupApprovalDao();
   }
   public function getApprovalGroups(){
       return $this->appDao->getApprovalGroups();
   }
   public function getEmployeeListbyId($id){
       return $this->appDao->getEmployeeListbyId($id);
   }
   public function UpdateGroupAssigne($employeeId,$groupId){
        return $this->appDao->UpdateGroupAssigne($employeeId,$groupId);
   }
   public function deleteGroupById($id){
       return $this->appDao->deleteGroupById($id);
   }
   public function deleteAssignedEmployee($empId,$GrpID){
        return $this->appDao->deleteAssignedEmployee($empId,$GrpID);
   }
   
   
   
}
