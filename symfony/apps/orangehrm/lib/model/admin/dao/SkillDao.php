<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Skills Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

require_once '../../lib/common/LocaleUtil.php';
class SkillDao extends BaseDao {


   public function getSkillList($orderField = 'skill_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('Skill')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }


   public function searchSkill( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'skill_code', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='skill_code') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('Skill');

        if ( $searchMode !='all' && $searchValue !='') {
            $q->where($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        $q->orderBy($orderField.' '.$orderBy);

        $sysConf=new sysConf();
        $resultsPerPage = $sysConf->getRowLimit()?$sysConf->getRowLimit():10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
            new Doctrine_Pager(
                $q,
                $page,
                $resultsPerPage
          ),
          new Doctrine_Pager_Range_Sliding(array(
                'chunk' => 5
          )),
          "?page={%page_number}&amp;mode=search&amp;txtSearchValue={$searchValue}&amp;cmbSearchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager  = $pagerLayout->getPager();
        $result = array();
        $result['data']     = $pager->execute();
        $result['pglay']    = $pagerLayout;

        return $result;
    }


    public function saveSkill(Skill $skill)
    {
        if( $skill->skill_code == '')
        {
            $idGenService	=	new IDGeneratorService();
            $idGenService->setEntity($skill);
            $skill->setSkillCode( $idGenService->getNextID() );
        }
        $skill->save();
        return true;
    }


    public function deleteSkill( $id )
    {
        $q = Doctrine_Query :: create()->delete('Skill')
                ->where('skill_code = ?', $id);

        $result = $q->execute();
        return $result;
    }


    public function readSkill( $id )
    {
        $skill = Doctrine::getTable('Skill')->find($id);
        return $skill;
    }


    public function getSkillById( $id )
    {
        $q 	= 	Doctrine_Query::create()
                        ->select('l.*')
                        ->from('Skill l')
                        ->where('skill_code = ?', $id);

        return $q->fetchArray();
    }
}
?>