<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class DisCommonDao extends BaseDao {

public function deleteActiontype($id) {




        $query = Doctrine_Query::create()
                        ->delete('DisciplinaryActionType')
                        ->where('dis_acttype_id=' . $id);

        $numDeleted = $query->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function searchFinalAction($searchMode, $searchValue, $culture="en", $orderField = 'b.dis_fna_code', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "dis_fna_name_") {
            if ($culture == "en")
                $feildName = "b.dis_fna_name";
            else
                $feildName="b.dis_fna_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('DisiplinaryFinalAction b');

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

     public function deleteSavedInvolvedEmp($id, $insiId) {

        $q = Doctrine_Query::create()
                ->delete('DisEmployeeInvolved')
                ->where('emp_number= ?', array($id))
                ->andwhere('dis_inc_id= ?', array($insiId));


        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
}

?>