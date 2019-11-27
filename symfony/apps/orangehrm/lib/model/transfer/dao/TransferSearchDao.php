<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Transfer Module Transfer Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
require_once '../../lib/common/LocaleUtil.php';

class TransferSearchDao extends BaseDao {

    /**
     *
     * Executes TransferReason function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return CommonhrmPager
     */
    public function searchTransferReason($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 't.trans_reason_id', $orderBy = 'ASC') {

        $searchColumn = ($Culture == "en") ? $searchMode : $searchMode . '_' . $Culture;

        switch ($searchMode) {
            case "trans_reason_id":
                $feildName = "t.trans_reason_id";
                break;
            case "trans_reason_en":
                if ($Culture == "en")
                    $feildName = "t.trans_reason_en";
                else
                    $feildName="t.trans_reason_" . $Culture;
                break;
        }

        $searchValue = trim($searchValue);
        $q = Doctrine_Query::create()
                ->from('TransferReason t');

        if ($searchMode != 'all' && $searchValue != '') {
            $q->where($feildName . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        $q->orderBy($orderField . ' ' . $orderBy);

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
                        "?page={%page_number}&amp;mode=search&amp;txtSearchValue={$searchValue}&amp;cmbSearchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $result = array();
        $result['data'] = $pager->execute();
        $result['pglay'] = $pagerLayout;
        return $result;
    }

    /**
     *
     * Executes searchTransferRequest function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $Culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return CommonhrmPager
     */
    public function searchTransferRequest($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'tr.trans_req_id', $orderBy = 'ASC') {

        try {
            $empnum = $_SESSION['empNumber'];
            switch ($searchMode) {
                case "emp_display_name":
                    if ($Culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name" . $Culture;
                    break;
                case "preferred_division":
                    if ($Culture == "en")
                        $feildName = "c.title";
                    else
                        $feildName="c.title" . $Culture;
                    break;

                case "preferred_location":
                    $feildName = "tr.trans_req_location_pref1";
                    $feildName1 = "tr.trans_req_location_pref2";
                    $feildName2 = "tr.trans_req_location_pref3";
                    break;
                case "current_division":
                    if ($Culture == "en")
                        $feildName = "c.title";
                    else
                        $feildName = "c.title" . $Culture;
                    break;
            }

            $q = Doctrine_Query::create()
                    ->select('tr.*,e.*,c.*')
                    ->from('TransferRequest tr')
                    ->innerJoin('tr.Employee e ON tr.emp_number = e.emp_number')
                    ->innerJoin('e.CompanyStructure c ON e.work_station = c.id');

            if ($searchValue != "") {
                if ($searchMode == "Preferred Location") {
                    $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
                    $q->andwhere($feildName1 . ' LIKE ?', '%' . trim($searchValue) . '%');
                    $q->andwhere($feildName2 . ' LIKE ?', '%' . trim($searchValue) . '%');
                } else {
                    $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
                }
            }
            if ($empnum != null) {
                $q->andwhere('e.emp_number=' . $empnum);
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
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function searchTransferRequestAdmin($searchMode, $searchValue, $Culture="en", $page=1, $orderField = 'tr.trans_req_id', $orderBy = 'ASC') {

        try {
            $empnum = $_SESSION['empNumber'];
            switch ($searchMode) {
                case "emp_display_name":
                    if ($Culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name" . $Culture;
                    break;
                case "preferred_division":
                    if ($Culture == "en")
                        $feildName = "c.title";
                    else
                        $feildName="c.title" . $Culture;
                    break;

                case "preferred_location":
                    $feildName = "tr.trans_req_location_pref1";
                    $feildName1 = "tr.trans_req_location_pref2";
                    $feildName2 = "tr.trans_req_location_pref3";
                    break;
                case "current_division":
                    if ($Culture == "en")
                        $feildName = "c.title";
                    else
                        $feildName = "c.title" . $Culture;
                    break;
            }

            $q = Doctrine_Query::create()
                    ->select('tr.*,e.*,c.*')
                    ->from('TransferRequest tr')
                    ->innerJoin('tr.Employee e ON tr.emp_number = e.emp_number')
                    ->innerJoin('e.CompanyStructure c ON e.work_station = c.id');

            if ($searchValue != "") {
                if ($searchMode == "Preferred Location") {
                    $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
                    $q->andwhere($feildName1 . ' LIKE ?', '%' . trim($searchValue) . '%');
                    $q->andwhere($feildName2 . ' LIKE ?', '%' . trim($searchValue) . '%');
                } else {
                    $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
                }
            }
//            if ($empnum != null) {
//                $q->andwhere('e.emp_number=' . $empnum);
//            }
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
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

/**
     *
     * Executes searchTransferDetails function
     *
     * @param type $searchMode
     * @param type $searchValue
     * @param type $culture
     * @param type $page
     * @param type $orderField
     * @param type $orderBy
     * @return CommonhrmPager
     */
    public function searchTransferDetails($searchMode="", $searchValue="", $culture="", $page=1, $orderField='t.Full Texts 	trans_id', $orderBy='ASC') {

        try {
            $flag = "0";
            switch ($searchMode) {
                case "emp_display_name":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name" . $culture;
                    break;
                case "trans_reason":
                    if ($culture == "en")
                        $feildName = "r.trans_reason_en";
                    else
                        $feildName="r.trans_reason" . $culture;
                    break;
                case "date":
                    $feildName = "t.trans_effect_date";
                    break;
                case "trans_currentdiv_id":
                    if ($culture == "en")
                        $feildName = "c.title";
                    else
                        $feildName="c.title" . $culture;
                    break;
                case "from":
                    $flag = "1";
                    if ($culture == "en")
                        $feildName = "c.title";
                    else
                        $feildName="c.title" . $culture;
                    break;
            }

            $q = Doctrine_Query::create()
                    ->select('t.*')
                    ->from('Transfer t');
            if ($flag == 1) {


                $q->innerJoin('t.CompanyStructure c ON t.trans_currentdiv_id = c.id');
            } else {

                $q->innerJoin('t.CompanyStructure c ON t.trans_div_id = c.id');
            }
            $q->innerJoin('t.Employee e ON t.trans_emp_number = e.emp_number');
            $q->innerJoin('t.TransferReason r ON t.trans_reason_id=r.trans_reason_id');

//                    ->innerJoin('t.TransferReason r ON t.trans_reason_id = r.trans_reason_id');

            if ($searchValue != "") {
                $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
            }
            $q->orderBy($orderField . ' ' . $orderBy);

//            die($q->getSql());
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
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }



}

?>