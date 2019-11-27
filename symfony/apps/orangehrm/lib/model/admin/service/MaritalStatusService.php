<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module MaritalStatusService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class MaritalStatusService extends BaseService {
   private $maritalStatusDao;


   public function __construct() {
      $this->maritalStatusDao = new MaritalStatusDao();
   }

   public function getMaritalStatusList($orderField = 'marst_code', $orderBy = 'ASC') {
        return $this->maritalStatusDao->getMaritalStatusList($orderField, $orderBy);
   }   
}
?>