<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Grade Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

require_once '../../lib/common/LocaleUtil.php';
 class GradeDao extends BaseDao {


   public function SerachGrades( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'grade_code', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='grade_code') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('Grade');

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

     public function saveGrade(Grade $grade){

         $grade->save();
         return true;
     }
     public function getGradeById($id){


         return Doctrine::getTable('Grade')->find($id);



         
     }
     public function deleteGrade($id){

      
            $q = Doctrine_Query::create()
                            ->delete('Grade')
                            ->where('grade_code=' . $id);

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
        

 }

      public function getLastGradeCode(){
$q = Doctrine_Query::create()
    ->select('MAX(g.grade_code)')
    ->from('Grade g');

         return $q->fetchArray();

 }

      public function saveGradeSlot(GradeSlot $grade){

         $grade->save();
         return true;
     }

            function deleteGradeSlot($id){

         $q = Doctrine_Query::create()
            ->delete('GradeSlot')
            ->where("grade_code = ?",$id);
         $q->execute();

         //return true;

   }

               function deleteGradeSlotRow($id,$yr){

         $q = Doctrine_Query::create()
            ->delete('GradeSlot')
            ->where("grade_code = ?",$id)
           ->andwhere("slt_scale_year = ?",$yr);
         $q->execute();

         

   }


    function readGradeSlot($id)
   {

         $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('GradeSlot g')
                ->where("g.grade_code = ?", $id);

         return $q->fetchArray();


   }

   function updateGradeSlotRow($gradecode,$yr,$amt,$bs)
   {

         $q = Doctrine_Query::create()
                ->update('GradeSlot')
                ->set('slt_amount', '?', $amt)
                ->set('emp_basic_salary', '?', $bs)
                ->where("grade_code = ?",$gradecode)
                ->andwhere("slt_scale_year = ?",$yr);
         return $q->execute();



   }


 }


?>
