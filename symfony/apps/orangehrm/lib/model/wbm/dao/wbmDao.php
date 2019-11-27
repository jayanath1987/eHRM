<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class wbmDao extends BaseDao {

    //Benifit Type
    public function getBenifitType($orderField = 'bt_id', $orderBy = 'ASC', $page = 1) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('BenifitType b')
                        ->orderBy($orderField . ' ' . $orderBy);

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

    public function searchBenifitType($searchMode, $searchValue, $culture="en", $orderField = 'b.bt_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "bt_name_") {
            if ($culture == "en")
                $feildName = "b.bt_name";
            else
                $feildName="b.bt_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('BenifitType b');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                        //  'wbm/?page={%page_number}'
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function saveBenifitType(BenifitType $rte) {
        $rte->save();
        return true;
    }

    public function readBenifitType($id) {
        return Doctrine::getTable('BenifitType')->find($id);
    }

    public function deleteBenifitType($id) {
        $q = Doctrine_Query::create()
                        ->delete('BenifitType')
                        ->where('bt_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    //Benifit
    public function getBenifit($orderField ='b.bst_id', $orderBy ='ASC', $page = 1) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('BenifitSubType b')
                        ->leftJoin('b.BenifitType s ON b.bt_id = s.bt_id')
                        ->orderBy($orderField . ' ' . $orderBy);

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

    public function searchBenifit($searchMode, $searchValue, $culture='en', $orderField = 'b.bst_id', $orderBy = 'ASC', $page = 1) {
        switch ($searchMode) {
            case "bst_name_":
                if ($culture == "en")
                    $feildName = "b.bst_name";
                else
                    $feildName="b.bst_name_" . $culture;
                break;
            case "bt_name_":
                if ($culture == "en")
                    $feildName = "t.bt_name";
                else
                    $feildName="t.bt_name_" . $culture;
                break;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('BenifitSubType b')
                        ->leftJoin('b.BenifitType t ON b.bt_id = t.bt_id');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function getBenifitTypeload() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('BenifitType b');
        return($q->execute());
    }

    public function getBenifitsubbTypeload($id) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('BenifitSubType b')
                        ->where('b.bt_id = ?', $id);
        return($q->execute());
    }

    public function saveBenifit(BenifitSubType $rte) {
        $rte->save();
        return true;
    }

    public function readBenifit($id) {
        return Doctrine::getTable('BenifitSubType')->find($id);
    }

    public function deleteBenifit($id) {
        $q = Doctrine_Query::create()
                        ->delete('BenifitSubType')
                        ->where('bst_id =?', $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

//disbesement----------------------

    public function searchDisb($searchMode, $searchValue, $culture='en', $orderField = 'b.ben_id', $orderBy = 'ASC', $page = 1) {

        switch ($searchMode) {
            case "emp_name":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name_" . $culture;
                break;
            case "bst_name_":
                if ($culture == "en")
                    $feildName = "s.bst_name";
                else
                    $feildName="s.bst_name_" . $culture;
                break;
            case "bt_name_":
                if ($culture == "en")
                    $feildName = "t.bt_name";
                else
                    $feildName="t.bt_name_" . $culture;
                break;
            case "disb_date":
                $feildName = "b.ben_date";
                break;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('Benifit b')
                        ->leftJoin('b.Employee e ON b.emp_number = e.emp_number')
                        ->leftJoin('b.BenifitType t ON b.bt_id = t.bt_id')
                        ->leftJoin('b.BenifitSubType s ON b.bst_id = s.bst_id');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function getbent($id) {
        $q = Doctrine_Query::create()
                        ->select('e.*')
                        ->from('BenifitSubType e')
                        ->where('e.bt_id = ?', $id);

        return $q->fetchArray();
    }

    public function savedisbust(Benifit $rte) {
        $rte->save();
        return true;
    }

    public function getbd($eid, $btid, $bstid, $bdate) {
        $q = Doctrine_Query::create()
                        ->select('count(e.ben_id)')
                        ->from('Benifit e')
                        ->where('e.emp_number = ?', $eid)
                        ->andWhere('e.bt_id = ?', $btid)
                        ->andWhere('e.bst_id = ?', $bstid)
                        ->andWhere('e.ben_date = ?', $bdate);

        return $q->fetchArray();
    }

    public function readDisbrs($id) {
        return Doctrine::getTable('Benifit')->find($id);
    }

    public function updateDisb($benid, $empid, $bttid, $bstid, $date, $com) {

        $q = Doctrine_Query::create()
                        ->update('Benifit a')
                        ->set('a.emp_number', '?', $empid)
                        ->set('a.bt_id', '?', $bttid)
                        ->set('a.bst_id', '?', $bstid)
                        ->set('a.ben_date', '?', $date)
                        ->set('a.ben_comment', '?', $com)
                        ->where('a.ben_id = ?', $benid);

        $q->execute();
        return true;
    }

    public function deletedisb($id) {
        $q = Doctrine_Query::create()
                        ->delete('Benifit')
                        ->where('ben_id	=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

}

?>
