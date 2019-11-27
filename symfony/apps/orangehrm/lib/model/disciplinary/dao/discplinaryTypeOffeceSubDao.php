<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Disciplinary Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DisTypeOffenceSubDao extends BaseDao {


   public function searchActionType($searchMode="", $searchValue, $culture="", $page=1, $orderField='d.dis_acttype_name', $orderBy='ASC') {
        if ($culture == 'en') {
            $dis_acttype_name = 'dis_acttype_name';
        } else {
            $dis_acttype_name = 'dis_acttype_name_' . $culture;
        }

                $q = Doctrine_Query::create()
                                ->select('d.*')
                                ->from('DisciplinaryActionType d');
                 if ($searchValue != "") {               
                    $q->where("d." . $dis_acttype_name . " LIKE ?", '%' . trim($searchValue) . '%');
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

     public function searchOffence($searchMode="", $searchValue="", $culture="", $page=1, $orderField='o.dis_offence_name', $orderBy='ASC') {

        if ($culture == 'en') {
            $dis_offence_name = 'dis_offence_name';
            $dis_acttype_name = 'dis_acttype_name';
        } else {
            $dis_offence_name = 'dis_offence_name_' . $culture;
            $dis_acttype_name = 'dis_acttype_name_' . $culture;
        }
        if ($searchValue != "") {

            if ($searchMode == "offence") {
                //die($searchValue);
                $q = Doctrine_Query::create()
                                ->select('o.*')
                                ->from('Offence o')
                                ->leftJoin('o.DisciplinaryActionType d ON o.dis_acttype_id = d.dis_acttype_id')
                                ->where("o." . $dis_offence_name . " LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);


            }
            if ($searchMode == "type") {

                $q = Doctrine_Query::create()
                                ->select('o.*')
                                ->from('Offence o')
                                ->leftJoin('o.DisciplinaryActionType d ON o.dis_acttype_id = d.dis_acttype_id')
                                ->where("d." . $dis_acttype_name . " LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);
            }
        } else {

            $q = Doctrine_Query::create()
                            ->select('o.*')
                            ->from('Offence o')
                            ->leftJoin('o.DisciplinaryActionType d ON o.dis_acttype_id = d.dis_acttype_id')
                            ->orderBy($orderField . ' ' . $orderBy);
        }



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