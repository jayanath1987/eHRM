<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module EducationService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class EducationService extends BaseService {
   private $educationDao;


   public function __construct() {
      $this->educationDao = new EducationDao();
   }


   public function getEducationList($orderField = 'edu_code', $orderBy = 'ASC') {
        return $this->educationDao->getEducationList($orderField, $orderBy);
   }


   public function searchEducation( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'edu_code', $orderBy = 'ASC')
   {
        return $this->educationDao->searchEducation($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy);
   }


    public function saveEducation(Education $education)
    {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->educationDao->saveEducation($education);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_education',array($education->edu_code),1);

        $conn->commit();
        return true;
    }


    public function deleteEducation($entriesToDelete)
    {

        $q = Doctrine_Query::create()
                            ->delete('Education')
                            ->where('edu_code= ?' , array($entriesToDelete));

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
        
    }


    public function readEducation( $id )
    {
        return $this->educationDao->readEducation($id);
    }


    public function getEducationById( $id )
    {
        return $this->educationDao->getEducationById($id);
    }
}
?>