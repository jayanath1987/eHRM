<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module GradeService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class GradeService extends BaseService {
   private $GradeDao;


   public function __construct() {
      $this->GradeDao = new GradeDao();
   }


   public function SerachGrades( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'grade_code', $orderBy = 'ASC')
   {
        return $this->GradeDao->SerachGrades($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy);
   }

   public function saveGrade(Grade $grade){
       return $this->GradeDao->saveGrade($grade);
   }
   public function getGradeById($id){
       return $this->GradeDao->getGradeById($id);
   }


}

?>
