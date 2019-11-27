<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class SecurityService extends BaseService {

   private $secDao;

   public function __construct() {
      $this->secDao = new securityDao();
   }

  
   public function readCapability($id){
       return $this->secDao->readCapability($id);
   }
   public function saveCapability(capability $capb){
       return $this->secDao->saveCapability($capb);
   }
  
   public function LoadMenus($capId,$moduleId){
       return $this->secDao->LoadMenus($capId,$moduleId);
   }
   public function getCapablities(){
        return $this->secDao->getCapablities();
   }

   public function getModuleList(){
        return $this->secDao->getModuleList();
   }
   public function deleteMnuCapabilities($mnuId,$capId){
        return $this->secDao->deleteMnuCapabilities($mnuId,$capId);
   }
   public function saveMnuCapabilities($mnuCapbility){
        return $this->secDao->saveMnuCapabilities($mnuCapbility);
   }
   public function getmoduleMenuList($moduleId){
        return $this->secDao->getmoduleMenuList($moduleId);
   }
   public function getmoduleMenuCapabilityList($capID){
       return $this->secDao->getmoduleMenuCapabilityList($capID);
   }
   public function getSaveCapObj($request,$capability){
       return $this->secDao->getSaveCapObj($request,$capability);
   }
   public function getPayrollType(){
       return $this->secDao->getPayrollType();
   }




  }

?>
