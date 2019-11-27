<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module SkillService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class SkillService extends BaseService {
   private $skillDao;


   public function __construct() {
      $this->skillDao = new SkillDao();
   }


   public function getSkillList($orderField = 'skill_code', $orderBy = 'ASC') {
        return $this->skillDao->getSkillList($orderField, $orderBy);
   }


   public function searchSkill( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'skill_code', $orderBy = 'ASC')
   {
        return $this->skillDao->searchSkill($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy);
   }


    public function saveSkill(Skill $skill)
    {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->skillDao->saveSkill($skill);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_skill',array($skill->skill_code),1);

        $conn->commit();
    }


    public function deleteSkill($entriesToDelete)
    {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        foreach ($entriesToDelete as $id) {
            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->isTableLocked('hs_hr_skill',array($id),1);

            if ($recordLocked==false) {
                $this->skillDao->deleteSkill($id);
            }
        }

        $conn->commit();
        return true;
    }


    public function readSkill( $id )
    {
        return $this->skillDao->readSkill($id);
    }


    public function getSkillById( $id )
    {
        return $this->skillDao->getSkillById($id);
    }
}
?>