<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 22 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class TrainApprovalDao extends BaseDao {
    
     public function getApproverDef($empid) {
        $q = Doctrine_Query::create()
                        ->select('e.emp_number,c.def_level')
                        ->from('Employee e')
                        ->leftJoin('e.CompanyStructure c ON e.work_station=c.id')
                        ->where('e.emp_number = ?', $empid);

        return $q->fetchArray();
    }
    
    public function getPendingListDivSec($searchMode="", $searchValue="", $culture="", $page=1, $orderField='e.emp_display_name', $orderBy='ASC', $DefLevel) {

            switch ($searchMode) {

                case "ename":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name_" . $culture;
                    break;
                case "institute":
                    if ($culture == "en")
                        $feildName = "i.td_inst_name_en";
                    else
                        $feildName="i.td_inst_name_" . $culture;
                    break;
                case "course":
                    if ($culture == "en")
                        $feildName = "c.td_course_name_en";
                    else
                        $feildName="c.td_course_name_" . $culture;
                    break;


                case "year":

                    $feildName = "t.td_asl_year";

                    break;
            }

            $q = Doctrine_Query::create()
                            ->select('t.*')
                            ->from('TrainAssign t')
                            ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                            ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number')
                            ->where('t.td_asl_ispending = 0');
            
            if ($DefLevel > 3) {
                $q->andwhere('t.td_asl_status = 0');
            } else if ($DefLevel > 2) {
                $q->andwhere('t.td_asl_status = 1');
            } else if ($DefLevel > 1) {
                $q->andwhere('t.td_asl_status = 2');
            }


            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&def={$DefLevel}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;

    }
    
    public function updateAprovelDivSec($empid, $cid, $val, $CurStatus, $ApprSub, $ApprHead, $isapproved) {

      
        $q = Doctrine_Query::create()
                        ->update('TrainAssign a')
                        ->set('a.td_asl_isapproved', '?', 0)
                        ->set('a.td_asl_ispending', '?', 0)
                        ->set('a.td_asl_status', '?', array($CurStatus))
                        ->set('a.td_asl_isapproved', '?', array($isapproved))
                        ->set('a.td_asl_appr_emp_number', '?', array($ApprHead))
                        ->set('a.td_asl_appr_sub_emp_number', '?', array($ApprSub))
                        ->where('a.emp_number = ?', $empid)
                        ->andWhere('a.td_course_id = ?', $cid);

        return $q->execute();
    }

    public function getPendingListHRTeam($searchMode="", $searchValue="", $culture="", $page=1, $orderField='e.emp_display_name', $orderBy='ASC', $DefLevel) {




            switch ($searchMode) {

                case "ename":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name_" . $culture;
                    break;
                case "institute":
                    if ($culture == "en")
                        $feildName = "i.td_inst_name_en";
                    else
                        $feildName="i.td_inst_name_" . $culture;
                    break;
                case "course":
                    if ($culture == "en")
                        $feildName = "c.td_course_name_en";
                    else
                        $feildName="c.td_course_name_" . $culture;
                    break;


                case "year":

                    $feildName = "t.td_asl_year";

                    break;
            }

            $q = Doctrine_Query::create()
                            ->select('t.*')
                            ->from('TrainAssign t')
                            ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                            ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number')
                            ->where('t.td_asl_ispending = ?', 0)
                            ->andwhere('t.td_asl_status = ?', 2);



            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&def={$DefLevel}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;

    }
     public function updateAprovelHRTeam($empid, $cid, $val, $CurStatus, $ApprSub, $ApprHead, $isapproved) {

     
        $q = Doctrine_Query::create()
                        ->update('TrainAssign a')
                        ->set('a.td_asl_isapproved', '?', 0)
                        ->set('a.td_asl_ispending', '?', 0)
                        ->set('a.td_asl_status', '?', array($CurStatus))
                        ->set('a.td_asl_isapproved', '?', array($isapproved))
                        ->set('a.td_asl_appr_emp_number', '?', array($ApprHead))
                        ->set('a.td_asl_appr_sub_emp_number', '?', array($ApprSub))
                        ->where('a.emp_number = ?', $empid)
                        ->andWhere('a.td_course_id = ?', $cid);

        return $q->execute();
    }
    public function getPendingListHRAdmin($searchMode="", $searchValue="", $culture="", $page=1, $orderField='e.emp_display_name', $orderBy='ASC', $DefLevel) {

            switch ($searchMode) {

                case "ename":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name_" . $culture;
                    break;
                case "institute":
                    if ($culture == "en")
                        $feildName = "i.td_inst_name_en";
                    else
                        $feildName="i.td_inst_name_" . $culture;
                    break;
                case "course":
                    if ($culture == "en")
                        $feildName = "c.td_course_name_en";
                    else
                        $feildName="c.td_course_name_" . $culture;
                    break;


                case "year":

                    $feildName = "t.td_asl_year";

                    break;
            }

            $q = Doctrine_Query::create()
                            ->select('t.*')
                            ->from('TrainAssign t')
                            ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                            ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number')
                            ->where('t.td_asl_ispending = ?', 0)
                            ->andwhere('t.td_asl_status = ?', 3);



            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&def={$DefLevel}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;

    }
    public function updateEditAprovel($empid, $cid, $val) {

        $q = Doctrine_Query::create()
                        ->update('TrainAssign a')
                        ->set('a.td_asl_isapproved', '?', $val)
                        ->where('a.emp_number = ?', $empid)
                        ->andWhere('a.td_course_id = ?', $cid);

        return $q->execute();
    }
     public function updateAprovel($empid, $cid, $val) {


    
        $q = Doctrine_Query::create()
                        ->update('TrainAssign a')
                        ->set('a.td_asl_isapproved', '?', $val);
 
        $q->where('a.emp_number = ?', $empid)
                ->andWhere('a.td_course_id = ?', $cid);

        return $q->execute();
    }
    public function getApprovedListList($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC') {


            switch ($searchMode) {

                case "ename":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name_" . $culture;
                    break;
                case "institute":
                    if ($culture == "en")
                        $feildName = "i.td_inst_name_en";
                    else
                        $feildName="i.td_inst_name_" . $culture;
                    break;
                case "course":
                    if ($culture == "en")
                        $feildName = "c.td_course_name_en";
                    else
                        $feildName="c.td_course_name_" . $culture;
                    break;
                case "year":

                    $feildName = "t.td_asl_year";

                    break;
            }

            $q = Doctrine_Query::create()
                            ->select('t.*')
                            ->from('TrainAssign t')
                            ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                            ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number')
                            ->where('t.td_asl_isapproved !=0');

            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;

    }
    public function getPendingList($searchMode="", $searchValue="", $culture="", $page=1, $orderField='e.emp_display_name', $orderBy='ASC') {

            switch ($searchMode) {

                case "ename":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name_" . $culture;
                    break;
                case "institute":
                    if ($culture == "en")
                        $feildName = "i.td_inst_name_en";
                    else
                        $feildName="i.td_inst_name_" . $culture;
                    break;
                case "course":
                    if ($culture == "en")
                        $feildName = "c.td_course_name_en";
                    else
                        $feildName="c.td_course_name_" . $culture;
                    break;


                case "year":

                    $feildName = "t.td_asl_year";

                    break;
            }

            $q = Doctrine_Query::create()
                            ->select('t.*')
                            ->from('TrainAssign t')
                            ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                            ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number')
                            ->where('t.td_asl_ispending = 0');

            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;

    }

    
    public function getTainingapllication($empid, $cid) {


    
        $q = Doctrine_Query::create()
                        ->select('a.*')
                        ->from('TrainAssign a');
 
        $q->where('a.emp_number = ?', $empid)
                ->andWhere('a.td_course_id = ?', $cid);

        return $q->fetchOne();
    }
    
            public function getemployeePendingTrainingEMPLOYEE($emp) {
            
            if($emp){
            $emp = str_replace("_",',',$emp);
            }
            if($emp!=null){
                    $q = Doctrine_Query::create()
                                    ->select('count(t.emp_number)')
                                    ->from('TrainAssign t')
                                    ->where("t.app_emp_number IN (".$emp.") " ) 
                                    ->andwhere('t.td_asl_isapproved != ?', 1);
                    return $q->fetchArray();
            }

    }
}
