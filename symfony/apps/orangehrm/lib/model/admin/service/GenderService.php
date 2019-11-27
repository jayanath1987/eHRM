<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module GenderService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class GenderService extends BaseService {
   private $genderDao;


   public function __construct() {
      $this->genderDao = new GenderDao();
   }


   public function getGenderList($orderField = 'gender_code', $orderBy = 'ASC') {
        return $this->genderDao->getGenderList($orderField, $orderBy);
   }   
}
?>