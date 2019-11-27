<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module ClassService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class ClassService extends BaseService {
   private $classDao;

   public function __construct() {
      $this->classDao = new classDao();
   }


   public function setJobDao(classDao $classDao) {
      $this->classDao = $classDao;
   }


   public function getJobDao() {
      return $this->classDao;
   }

    public function getClassDetails($orderField = 'class_code', $orderBy = 'ASC') {

         return $this->classDao->getClassDetails($orderField, $orderBy);

   }
   
}
?>
