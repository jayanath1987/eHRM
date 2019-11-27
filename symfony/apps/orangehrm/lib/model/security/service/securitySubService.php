<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 oct 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class SecuritySubService extends BaseService {

   private $secSubDao;

   public function __construct() {
      $this->secSubDao = new securitySubDao();
   }
    public function searchCapabilities($searchMode, $searchValue, $culture, $page, $orderField, $orderBy){
       return $this->secSubDao->searchCapabilities($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
   }
    public function deleteCapability($id){
       return $this->secSubDao->deleteCapability($id);
   }

   public function searchPayprocessCapabilityList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy){
       return $this->secSubDao->PayprocessCapabilityList($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
   }
   
}
?>
