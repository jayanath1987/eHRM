<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Classes Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

require_once '../../lib/common/LocaleUtil.php';
 class classDao extends BaseDao {

     public function SerachClass( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'class_code', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='class_code') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('EmpClass');

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

    public function saveClass(EmpClass $empclass){
        $empclass->save();
        return true;
    }
    public function getClassById($id){


         return Doctrine::getTable('EmpClass')->find($id);

 }
   public function deleteClass($id){


            $q = Doctrine_Query::create()
                            ->delete('EmpClass')
                            ->where('class_code=' . $id);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
       

 }
   public function getClassDetails($orderField = 'class_code', $orderBy = 'ASC') {

         $q = Doctrine_Query::create()
             ->from('EmpClass')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();

   }

 }
?>
