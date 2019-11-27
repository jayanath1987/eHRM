<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Attachtype Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class attachTypeDao extends BaseDao {

     public function SerachAttachtype( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'eattach_type_id', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='eattach_type_id') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('EmpAttahmentType');

        if ( $searchMode !='all' && $searchValue !='') {
            $q->where($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        $q->orderBy($orderField.' '.$orderBy);

        $resultsPerPage = sfConfig::get('app_items_per_page')?sfConfig::get('app_items_per_page'):10;

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
          "?page={%page_number}&mode=search&txtSearchValue={$searchValue}&cmbSearchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager  = $pagerLayout->getPager();
        $result = array();
        $result['data']     = $pager->execute();
        $result['pglay']    = $pagerLayout;

        return $result;
    }
    public function saveAttachType(EmpAttahmentType $attachType){

        $attachType->save();
        return true;

    }
    public function getAttachmentById($id){

         return Doctrine::getTable('EmpAttahmentType')->find($id);

    }
    
     public function deleteAttachType($id){


            $q = Doctrine_Query::create()
                            ->delete('EmpAttahmentType')
                            ->where('eattach_type_id=' . $id);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;


 }

}

?>
