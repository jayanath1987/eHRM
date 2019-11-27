<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module ReligionService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class ReligionService extends BaseService {
   private $religionDao;


   public function __construct() {
      $this->religionDao = new ReligionDao();
   }


   public function getReligionList($orderField = 'rlg_code', $orderBy = 'ASC') {
        return $this->religionDao->getReligionList($orderField, $orderBy);
   }   
}
?>