<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class TrainingRegisterDao extends BaseDao {
    
     public function EmployeeTrainingHistory($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC') {


            $empnum = $_SESSION['empNumber'];

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
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number');
            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
            }
            $q->orderBy($orderField . ' ' . $orderBy);

            // Number of records for a one page
            $resultsPerPage = sfConfig::get('app_items_per_page') ? sfConfig::get('app_items_per_page') : 10;

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
     public function countAssignedcourse($cid, $empid) {
        $q = Doctrine_Query::create()
                        ->select('count(a.emp_number)')
                        ->from('TrainAssign a')
                        ->where('a.td_course_id = ?', $cid)
                        ->andWhere('a.emp_number = ?', $empid);

        return $q->fetchArray();
    }
      public function deleteTrainRecord($cousId="", $empId="") {

        $q = Doctrine_Query::create()
                        ->update('TrainAssign a')
                        ->set('a.td_asl_duration', '?', "")
                        ->set('a.td_asl_conductperson', '?', "")
                        ->set('a.td_asl_conductdate', '?', "")
                        ->set('a.td_asl_remarks', '?', "")
                        ->set('a.td_asl_effectiveness', '?', "")
                        ->set('a.td_asl_adminremarks', '?', "")
                        ->set('a.td_asl_content', '?', "")
                        ->set('a.td_asl_isadcommented', '?', "")
                        ->set('a.td_asl_isempfb', '?', "")
                        ->where('a. emp_number = ?', $empId)
                        ->andwhere('a.td_course_id = ?', $cousId);
        return $q->execute();
    }
    public function getTrainList($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC') {
        switch ($searchMode) {

            case "name":
                if ($culture == "en")
                    $feildName = "t.td_course_name_en";
                else
                    $feildName="t.td_course_name_" . $culture;
                break;
            case "institute":
                if ($culture == "en")
                    $feildName = "i.td_inst_name_en";
                else
                    $feildName="i.td_inst_name_" . $culture;
                break;
            case "year":

                $feildName = "t.td_course_year";

                break;
            case "Venue":
                if ($culture == "en")
                    $feildName = "t.td_course_venue_en";
                else
                    $feildName="t.td_course_venue_" . $culture;

                break;
        }

        $q = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('TrainingCourse t')
                        ->leftJoin('t.TrainingInstitute i ON t.td_inst_id = i.td_inst_id');
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
    
     public function getTPlanIdByID($id) {

            return Doctrine::getTable('TrainingPlan')->find($id);

    }
    public function saveTrainingPlan($trainingPlan) {
        $trainingPlan->save();
    }
     public function getLastTrainigPlanID() {
        $q = Doctrine_Query::create()
                        ->select('MAX(td_plan_id)')
                        ->from('TrainingPlan');
        return $q->fetchArray();
    }
    public function getTrainingPlanList($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_plan_id', $orderBy='ASC') {


        switch ($searchMode) {

            case "month":
                $feildName = "t.td_plan_month";
                break;
            case "institute":
                if ($culture == "en")
                    $feildName = "i.td_inst_name_en";
                else
                    $feildName="i.td_inst_name_" . $culture;
                break;
            case "name":
                if ($culture == "en")
                    $feildName = "t.td_plan_training_name";
                else
                    $feildName="t.td_plan_training_name_" . $culture;
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('t.*,i.*')
                        ->from('TrainingPlan t')
                        ->leftJoin('t.TrainingInstitute i ON t.td_inst_id = i.td_inst_id')
                        ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id');
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
     
    
    public function readCourse() {
                $q = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('TrainingCourse t');
                
                return $q->execute();
    }

    
}
