<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminSearchService
 *
 * @author Roshan
 */
class AdminSearchService {
   public function getUsersList( $searchMode, $searchValue, $userCulture="en", $page=1 ,$orderField = 'u.id', $orderBy = 'ASC' )
    {


            switch ($searchMode) {
                case "user_name":
                        $feildName = "u.user_name";
                    break;
                 case "id":
                        $feildName = "u.id";
                    break;
            }

            $q = Doctrine_Query::create()
             ->select('u.*')
             ->from('Users u');


            if ($searchValue != "") {

                   $q->where($feildName.' LIKE ?', '%' . trim($searchValue) . '%');

            }

            $q->orderBy($orderField. ' ' . $orderBy);


            // Number of records for a one page
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
