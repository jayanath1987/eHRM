<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class knwDao extends BaseDao {

    public function searchDocumentType($searchMode, $searchValue, $culture="en", $orderField = 'b.knw_doc_id', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "knw_doc_name_") {
            if ($culture == "en")
                $feildName = "b.knw_doc_name";
            else
                $feildName="b.knw_doc_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('KNWDocumentType b');

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

    public function readDocumentType($id) {

        return Doctrine::getTable('KNWDocumentType')->find($id);
    }

    public function saveDocumentType(KNWDocumentType $rte) {

        $rte->save();
        return true;
    }

    public function saveAttachment(KNWAttachmentDetails $rte) {

        $rte->save();
        return true;
    }

    public function deleteDocumentType($id) {

        $q = Doctrine_Query::create()
                        ->delete('KNWDocumentType')
                        ->where('knw_doc_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteAttachmentrec($id, $did) {

        $q = Doctrine_Query::create()
                        ->delete('KNWAttachmentDetails')
                        ->where('knw_atd_id=' . $id)
                        ->Andwhere('knw_doc_id=' . $did);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function searchAttachment($searchMode, $searchValue, $culture="en", $orderField = 'b.knw_atd_id', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "knw_atd_keyword_") {
            if ($culture == "en")
                $feildName = "b.knw_atd_keyword";
            else
                $feildName="b.knw_atd_keyword_" . $culture;
        }
        else if ($searchMode == "knw_atd_title_") {
            if ($culture == "en")
                $feildName = "b.knw_atd_title";
            else
                $feildName="b.knw_atd_title_" . $culture;
        }
        else if ($searchMode == "knw_doc_name_") {
            if ($culture == "en")
                $feildName = "t.knw_doc_name";
            else
                $feildName="t.knw_doc_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('KNWAttachmentDetails b')
                        ->leftJoin('b.KNWDocumentType t ON b.knw_doc_id = t.knw_doc_id');

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

    public function readAttachment($id, $did) {

        return Doctrine::getTable('KNWAttachmentDetails')->find(array($id, $did));
    }

    public function readAttachment2($id, $did) {

        $q = Doctrine_Query::create()
                        ->select('count(t.knw_atd_id,t.knw_doc_id)')
                        ->from('KNWAttachment t')
                        ->where('t.knw_atd_id = ?', $id)
                        ->Andwhere('t.knw_doc_id = ?', $did)
                        ->Andwhere('t.knw_att_attachment != ?', "")
                        ->Andwhere('t.knw_att_size != ?', 0);
        return $q->fetchArray();
    }

    public function readAttachment3($id, $did) {

        $q = Doctrine_Query::create()
                        ->select('count(t.knw_atd_id,t.knw_doc_id)')
                        ->from('KNWAttachment t')
                        ->where('t.knw_atd_id = ?', $id)
                        ->Andwhere('t.knw_doc_id = ?', $did)
                        ->Andwhere('t.knw_att_article != ?', "");


        return $q->fetchArray();
    }

    public function readattach($id, $did) {

        $q = Doctrine_Query::create()
                        ->select('count(t.knw_atd_id,t.knw_doc_id)')
                        ->from('KNWAttachment t')
                        ->where('t.knw_atd_id = ?', $id)
                        ->Andwhere('t.knw_doc_id = ?', $did);

        return $q->fetchArray();
    }

    public function updatch($id, $did) {

        $q = Doctrine_Query::create()
                        ->delete('KNWAttachment t')
                        ->where('t.knw_atd_id = ?', $id)
                        ->Andwhere('t.knw_doc_id = ?', $did);

        return $q->execute();
    }

    public function saveNewAttachment(KNWAttachment $prmattach) {



        $prmattach->save();

        return true;
    }

    public function getAttachdetails($id, $did) {

        $q = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('KNWAttachment t')
                        ->where('t.knw_atd_id = ?', $id)
                        ->Andwhere('t.knw_doc_id = ?', $did);

        return $q->fetchArray();
    }

    public function getAttdddd($id, $did) {


        return Doctrine::getTable('KNWAttachment')->find(array($id, $did));
    }

    public function deleteAttach($id, $did) {


        $q = Doctrine_Query::create()
                        ->delete('KNWAttachment t')
                        ->where('t.knw_atd_id = ?', $id)
                        ->Andwhere('t.knw_doc_id = ?', $did);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getDoctype() {


        $q = Doctrine_Query::create()
                        ->from('KNWDocumentType');
        return $q->execute();
    }

    public function readmaxretid() {
        $q = Doctrine_Query::create()
                        ->select('MAX(knw_atd_id)')
                        ->from('KNWAttachmentDetails r');


        return $q->execute();
    }

    public function searchknw($searchMode, $searchValue, $searchValue1, $Culture="en", $orderField = 'b.knw_atd_post_date', $orderBy = 'DESC', $page = 1) {

        switch ($searchMode) {
            case "alltime":
                $time = date('Y-m-d', mktime(0, 0, 0, 1, 1, 1970));
                break;
            case "10days":
                $time = time() - (10 * 24 * 60 * 60);
                $time = date('Y-m-d', $time);
                break;
            case "30days":
                $time = time() - (30 * 24 * 60 * 60);
                $time = date('Y-m-d', $time);
                break;
            case "90days":
                $time = time() - (90 * 24 * 60 * 60);
                $time = date('Y-m-d', $time);
                break;
            case "lastyear":
                $time = time() - (365 * 24 * 60 * 60);
                $time = date('Y-m-d', $time);
                break;
        }

        if ($Culture == "en") {
            $feildName = "b.knw_atd_keyword";
        } else {
            $feildName = "b.knw_atd_keyword_" . $Culture;
        }


        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('KNWAttachmentDetails b')
                        ->leftJoin('b.KNWDocumentType t ON b.knw_doc_id = t.knw_doc_id');
        $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        if ($searchValue1 != "all") {
            $q->Andwhere('b.knw_doc_id = ?', $searchValue1);

            $q->Andwhere('knw_atd_post_date > ? OR knw_atd_update_date > ?', array($time, $time));
        } else {
            $q->Andwhere('knw_atd_post_date > ? OR knw_atd_update_date > ?', array($time, $time));
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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchValue1={$searchValue1}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function readAtt() {

        return Doctrine::getTable('KNWAttachment');
    }

}

?>
