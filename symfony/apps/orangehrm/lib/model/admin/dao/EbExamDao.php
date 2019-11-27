<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module EbExam Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

require_once '../../lib/common/LocaleUtil.php';
class EbExamDao extends BaseDao {

     public function searchEbexamDefinitions($searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'ebexam_id', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='ebexam_id') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('EBExam');

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

    public function saveEbexam($ebexam){
        $ebexam->save();
    }
    public function readEbExam($id){

            return Doctrine::getTable('EBExam')->find($id);

    }
    public function getAllEbExam($service,$grade){
        $q=Doctrine_Query::create()
                ->from('EBExam e')
                ->where('e.service_code=?',array($service))
                ->andwhere('e.grade_code=?',array($grade));
        return $q->execute();
    }
    public function readEmpEbexam($ebExamId,$empID){


            return Doctrine::getTable('EMPEBExam')->find(array($ebExamId,$empID));


    }
    public function getEMPEbexamsByEmployee($ebExamId){
        $q=Doctrine_Query::create()
                ->from('EMPEBExam e')
                ->where('e.ebexam_id=?',array($ebExamId))
                ->andwhere('e.employee_id=?',$_SESSION['PIM_EMPID']);
        return $q->execute();
    }
    
    public function deleteEbexamDefinitions($id){
        $q = Doctrine_Query::create()
                                ->delete('EBExam')
                                ->where('ebexam_id=?',$id);

                $numDeleted = $q->execute();
                if ($numDeleted > 0) {
                    return true;
                }
                return false;
    }

    public function getEBEMPExamByIds($serviceId,$gradeId){


         $q = Doctrine_Query::create()
                                ->from('EBExam e')
                                ->leftjoin('e.EMPEBExam b ON e.ebexam_id=b.ebexam_id and b.employee_id='.$_SESSION['PIM_EMPID']);                 
                                
         return $q->execute();


    }
    public function getEBExamByIds($serviceId,$gradeId){


         $q = Doctrine_Query::create()
                                ->from('EBExam e')                                
                                ->where('e.service_code=?',array($serviceId))
                                ->andwhere('e.grade_code=?',array($gradeId));
                                

         return $q->execute();


    }

    public function saveEmpEbexams($empEbexams){
        $empEbexams->save();
    }

    public function deleteEbExams($id){
        
        $q = Doctrine_Query :: create()->delete('EMPEBExam')
                ->where('employee_id = ?', $_SESSION['PIM_EMPID'])
                ->andwhere('ebexam_id = ?',$id );
        

            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
    }

}

?>
