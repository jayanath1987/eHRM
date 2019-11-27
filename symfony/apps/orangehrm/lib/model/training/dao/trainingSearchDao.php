<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class TrainingSearchDao extends BaseDao {

    public function searchinstitute($searchMode="", $searchValue="", $culture="", $page=1, $orderField='t.td_inst_id', $orderBy='DESC') {
        switch ($searchMode) {

            case "Name":
                if ($culture == "en")
                    $feildName = "t.td_inst_name_en";
                else
                    $feildName="t.td_inst_name_" . $culture;
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('TrainingInstitute t');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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

    public function getCourseList($searchMode="", $searchValue="", $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC') {

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
                $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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

    public function searchEmployeeTrainHistory($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC', $empId="") {



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
//                ->leftJoin('t.WfMain w ON t.wfmain_id = w.wfmain_id')
                ->innerJoin('t.Employee e ON t.emp_number = e.emp_number');
        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->andwhere('e.empNumber=' . $_SESSION['empTrainsummery']);
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

    public function searchEmployeeTrain($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC') {



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
            case "startDate":
                $feildName = "c.td_course_fromdate";
                break;
            case "endDate":
                $feildName = "c.td_course_todate";
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

    public function searchEmployeeTrainParticipate($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC') {



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



}

?>