<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Jayanath Liyanage
 *  On (Date)  - 06 December 2012
 *  Comments   - Admin Module Education Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

require_once '../../lib/common/LocaleUtil.php';
class EducationDao extends BaseDao {


    
   public function getEducationList($orderField = 'edu_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('Education')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }


   public function searchEducation( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'edu_code', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='edu_code') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('Education');

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


    public function saveEducation(Education $education)
    {
        if( $education->edu_code == '')
        {
            $idGenService	=	new IDGeneratorService();
            $idGenService->setEntity($education);
            $education->setEduCode( $idGenService->getNextID() );
        }
        $education->save();
        return true;
    }


    public function deleteEducation( $id )
    {
        $q = Doctrine_Query :: create()->delete('Education')
                ->where('edu_code = ?', $id);

    return $q->execute();

     
    }


    public function readEducation( $id )
    {
        $education = Doctrine::getTable('Education')->find($id);
        return $education;
    }


    public function getEducationById( $id )
    {
        $q 	= 	Doctrine_Query::create()
                        ->select('l.*')
                        ->from('Education l')
                        ->where('edu_code = ?', $id);

        return $q->fetchArray();
    }
    
    
    public function searchEducationType($searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'edu_type_id', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='edu_type_id') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('EducationType');

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
    
    public function readEducationTypeID( $id )
    {
        $education = Doctrine::getTable('EducationType')->find($id);
        return $education;
    }
    
     public function deleteEducationType($id){
        $q = Doctrine_Query::create()
                                ->delete('EducationType')
                                ->where('edu_type_id=?',$id);

                $numDeleted = $q->execute();
                if ($numDeleted > 0) {
                    return true;
                }
                return false;
    }
    
   public function searchEducationSubject($searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 's.subj_id', $orderBy = 'ASC' )
   {

        //$searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;
       switch ($searchMode) {

                case "edu_type_name":
                    if ($userCulture == "en")
                        $searchColumn = "t.edu_type_name";
                    else
                        $searchColumn="t.edu_type_name_" . $userCulture;
                    break;
                case "subj_name":
                    if ($userCulture == "en")
                        $searchColumn = "s.subj_name";
                    else
                        $searchColumn="s.subj_name_" . $userCulture;
                    break;
          
            }
        
        if ($orderField!='subj_id') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('EducationSubject s')
                                ->leftJoin('s.EducationType t ON t.edu_type_id = s.edu_type_id');

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

    public function readEducationSubjectID( $id )
    {
        $education = Doctrine::getTable('EducationSubject')->find($id);
        return $education;
    }   
    
     public function getEducationTypes()
    {
        $q 	= 	Doctrine_Query::create()
                        ->select('l.*')
                        ->from('EducationType l');

        return $q->execute();
    }
    
    public function deleteEducationSubject($id){
        $q = Doctrine_Query::create()
                                ->delete('EducationSubject')
                                ->where('subj_id=?',$id);

                $numDeleted = $q->execute();
                if ($numDeleted > 0) {
                    return true;
                }
                return false;
    }
    
        public function searchEducationYearGrade($searchMode = "", $searchValue = "", $userCulture = "", $page = 1, $orderField = 'g.grd_id', $orderBy = 'DESC') {
        
               switch ($searchMode) {

                case "edu_type_name":
                    if ($userCulture == "en")
                        $searchColumn = "t.edu_type_name";
                    else
                        $searchColumn="t.edu_type_name_" . $userCulture;
                    break;
                case "grd_year":
                        $searchColumn = "g.grd_year";
                    break;
          
            }    

        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EducationYearGrade g')
                ->leftJoin('g.EducationType t ON t.edu_type_id = g.edu_type_id');



        if ($searchValue != "") {
            $q->where($searchColumn . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);
        $q->groupBy('edu_type_id,grd_year');


        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

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
                        "?page={%page_number}&amp;mode=search&amp;searchValue={$searchValue}&amp;searchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }
    
    public function readEducationSubjectYear($id) {

        return Doctrine::getTable('EducationYearGrade')->find($id);
    } 
    
    public function readEducationTypeList() {

                $q = Doctrine_Query::create()
                ->select('i.*')
                ->from('EducationType i');
                
                return $q->execute();
    }
    
    public function readEducationGradeYear($year,$edut) {
        //die(print_r($year));
        
    $q = Doctrine_Query::create();
    
                if($year != 'null'){
                
                $q->select('g.*')
                ->from('EducationYearGrade g')
                ->where('g.grd_year = ?', $year)
                ->andwhere('g.edu_type_id = ?', $edut);  
                return $q->fetchArray();
                } else{                                     
                        
                $q->select('g.*')
                ->from('EducationYearGrade g')
                ->where('g.grd_year IS NOT NULL')
                ->andwhere('g.edu_type_id = ?', $edut);
                return $q->fetchArray();
                }
        
    }
    
    
    public function readEducationGradeYearID($year,$edut) {

        
                $q = Doctrine_Query::create()
                    ->delete('EducationYearGrade g')
                    ->where('g.grd_year = ?', $year)
                    ->andwhere('g.edu_type_id = ?', $edut);

                return $q->execute();
    }
    
    public function deleteEducationGradeYear($val){
        $row= explode("_", $val);
        
        
        
        $q = Doctrine_Query::create()
                                ->delete('EducationYearGrade g');
                                if($row[0]==""){
                                    $q->where('g.grd_year IS NULL');
                                }else{
                                    $q->where('g.grd_year = ?', $row[0]);
                                }
                                
                                $q->andwhere('g.edu_type_id = ?', $row[1]);

                $numDeleted = $q->execute();
                if ($numDeleted > 0) {
                    return true;
                }
                return false;
    }
    
    public function searchEB_Exam($searchMode = "", $searchValue = "", $userCulture = "", $page = 1, $orderField = 'g.ebh_id', $orderBy = 'DESC') {
        
               switch ($searchMode) {

                case "ebh_exam_name":
                    if ($userCulture == "en")
                        $searchColumn = "g.ebh_exam_name";
                    else
                        $searchColumn="g.ebh_exam_name_" . $userCulture;
                    break;
//                case "grd_year":
//                        $searchColumn = "g.grd_year";
//                    break;
          
            }    

        $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('EBMasterHead g');
                //->leftJoin('g.EducationType t ON t.edu_type_id = g.edu_type_id');



        if ($searchValue != "") {
            $q->where($searchColumn . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);



        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

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
                        "?page={%page_number}&amp;mode=search&amp;searchValue={$searchValue}&amp;searchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }
    
    public function readEB_Exam_ID($id) {

        return Doctrine::getTable('EBMasterHead')->find($id);
    }
    
    public function readGradeList() {

                $q = Doctrine_Query::create()
                ->select('g.*')
                ->from('Grade g');
                
                return $q->execute();
    }
    
    public function readEBExamDetails($edut) {
        //die(print_r($year));
        
    $q = Doctrine_Query::create();

                
                $q->select('g.*')
                ->from('EBMasterDetail g')
                ->where('g.ebh_id = ?', $edut);

                return $q->execute();

    } 
    
    public function getEBSubject() {

                $q = Doctrine_Query::create()
                ->select('i.*')
                ->from('EBSubject i');
                
                return $q->fetchArray();
    }
    
    public function deleteEBExamDetail($id){
        $q = Doctrine_Query::create()
                                ->delete('EBMasterDetail')
                                ->where('ebh_id=?',$id);

                $numDeleted = $q->execute();
                if ($numDeleted > 0) {
                    return true;
                }
                return false;
    }
    
    public function getEBExamHeadMaxId() {
        $q = Doctrine_Query::create()
                ->select('Max(ebh_id)')
                ->from('EBMasterHead');


        return $q->fetchArray();
    }
    
     public function deleteEBExamHead($id){
        $q = Doctrine_Query::create()
                                ->delete('EBMasterHead')
                                ->where('ebh_id=?',$id);

                $numDeleted = $q->execute();
                if ($numDeleted > 0) {
                    return true;
                }
                return false;
    }
    
   public function searchEBSubject($searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'ebs_id', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='ebs_name') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('EBSubject');

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
    
    public function readEBSubjectID( $id )
    {
        $education = Doctrine::getTable('EBSubject')->find($id);
        return $education;
    }
    
    public function deleteEBSubject($id){
        $q = Doctrine_Query::create()
                                ->delete('EBSubject')
                                ->where('ebs_id=?',$id);

                $numDeleted = $q->execute();
                if ($numDeleted > 0) {
                    return true;
                }
                return false;
    }

}
?>