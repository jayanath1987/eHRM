<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DisciplinaryIncidentDaoSub extends BaseService {
public function searchIncidentSummary($searchMode="", $searchValue="", $culture="", $page=1, $orderField='d.dis_inc_id', $orderBy='DESC') {
        switch ($searchMode) {

            case "rby":

                $feildName = "i.dis_inc_reportedby";

                break;
            case "date":
                $feildName = "i.dis_inc_date";
                break;
            case "code":
                $feildName = "i.dis_inc_id";
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('i.*')
                        ->from('Incidents i')
                        ->leftJoin('i.Employee e');

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

    public function empDisHistory($searchMode="", $searchValue="", $culture="", $page=1, $orderField='d.dis_inc_id', $orderBy='DESC', $empId="") {

        switch ($searchMode) {

            case "rby":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name_" . $culture;
                break;
            case "date":
                $feildName = "i.dis_inc_date";
                break;
            case "code":
                $feildName = "i.dis_inc_id";
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('i.*')
                        ->from('Incidents i')
                        ->leftJoin('i.DisEmployeeInvolved d')
                        ->innerJoin('d.Employee e')
                        ->where('e.empNumber= ?', array($empId));

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
    
    public function searchLevel0($searchMode="", $searchValue="", $culture="", $page=1, $orderField='r.dis_inc_id', $orderBy='ASC', $closed="", $level="") {

        switch ($searchMode) {
            case "employee":

                $feildName = "r.dis_inc_id";

                break;
            case "incident":
                if ($culture == "en")
                    $feildName = "r.dis_inc_incident";
                else
                    $feildName="r.dis_inc_incident_" . $culture;
                break;
            case "takenby":
                $feildName = "r.dis_inc_finact_tknby";
                break;
            case "takendate":
                $feildName = "r.dis_inc_finact_tkndate";
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('Incidents r')
                        ->where('r.dis_inc_isclosed=1');


        if ($searchValue != "") {
            $q->andwhere($feildName . '  LIKE ?', '%' . trim($searchValue) . '%');
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

    public function searchLevel1($searchMode="", $searchValue="", $culture="", $page=1, $orderField='r.dis_inc_id', $orderBy='ASC', $closed="", $level="") {

        switch ($searchMode) {
            case "employee":
                if ($culture == "en")
                    $feildName = "e.emp_lastname";
                else
                    $feildName="e.emp_lastname_" . $culture;
                break;
            case "Offencelist":
                if ($culture == "en")
                    $feildName = "o.dis_offence_name";
                else
                    $feildName="o.dis_offence_name_" . $culture;
                break;
            case "takenby":
                $feildName = "i.dis_indetail_takenby";
                break;
            case "takendate":
                $feildName = "i.dis_indetail_takendate";
                break;
            case "isclosed":
                $feildName = "r.dis_inc_isclosed";
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('Incidents r')
                        ->leftJoin('r.IncidentDetails i ON i.dis_inc_id = r.dis_inc_id')
                        ->leftJoin('r.OffenceList l ON r.dis_inc_id = l.dis_inc_id')
                        ->leftJoin('l.Offence o ON l.dis_offence_id = o.dis_offence_id')
                        ->innerJoin('r.Employee e ON e.emp_number = r.emp_number');
        $q->where('r.dis_inc_isclosed=0');

        $q->andwhere('r.dis_inc_level>=1');




        if ($searchValue != "") {
            $q->andwhere($feildName . '  LIKE ?', '%' . trim($searchValue) . '%');
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
     public function searchPendingInqSummary($searchMode="", $searchValue="", $culture="", $page=1, $orderField='d.dis_inc_id', $orderBy='DESC') {

        switch ($searchMode) {

            case "rby":
                $feildName = "i.dis_inc_reportedby";
                break;
            case "date":
                $feildName = "i.dis_inc_date";
                break;
            case "code":
                $feildName = "i.dis_inc_id";
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('i.*')
                        ->from('Incidents i')
                        ->leftJoin('i.DisEmployeeInvolved d')
                        ->where('i.dis_inc_level= 1')
                        ->andWhere('i.dis_inc_furtheraction_flg=?',"1")
                        ->andWhere('i.dis_inc_isclosed = 0');

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
