<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
require_once '../../lib/common/LocaleUtil.php';
class ReportDao extends BaseDao {


   public function getReportList($orderField = 'rn_rpt_name', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('ReportDetails')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }


   public function searchReport( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'm.name', $orderBy = 'ASC',$userId='USR001' )
   {

       if($searchMode == "rn_rpt_name"){
           $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;
       }else if($searchMode == "module_name"){
           $searchColumn = ($userCulture == "en") ? 'm.name' : 'm.module_name' . '_' . $userCulture;
       }
        
        $isAdminUser = ($userId=='USR001') ? true:false;

        $orderFieldByLanguage = $orderField;

        if ($orderField!='rn_rpt_id') {
            $orderFieldByLanguage = ($userCulture == "en") ? 'm.name' : 'm.module_name' . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('ReportDetails r')
                                ->leftJoin('r.Module m');
        
        if (!$isAdminUser) {
            $q->innerJoin('r.ReportCapability rc')
                ->innerJoin('rc.capability c')
                ->innerJoin('c.Users u');

            if ( $searchMode !='all' && $searchValue !='') {
                $q->where($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
                $q->Andwhere("u.id='" .trim($userId) . "'");
            } else {
                $q->where("u.id='" .trim($userId) . "'");
            }
        } else {
            if ( $searchMode !='all' && $searchValue !='') {
                $q->where($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
            }
        }

        $q->orderBy($orderFieldByLanguage.' '.$orderBy);

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
          "?page={%page_number}&mode=search&txtSearchValue={$searchValue}&cmbSearchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager  = $pagerLayout->getPager();
        $result = array();
        $result['data']     = $pager->execute();
        $result['pglay']    = $pagerLayout;     
         
        return $result;
    }

        public function ReportAccess( $userId )
    {

           $q = Doctrine_Query::create()
             ->from('ReportDetails r')
             ->innerJoin('r.ReportCapability rc')
             ->innerJoin('rc.capability c')
             ->innerJoin('c.Users u')
            ->where("u.emp_number='" .trim($userId) . "'");

         return $q->fetchArray();

    }


    public function readReport( $id )
    {
        $report = Doctrine::getTable('ReportDetails')->find($id);
        return $report;
    }


    public function getReportById( $id )
    {
        $q 	= 	Doctrine_Query::create()
                        ->select('r.*')
                        ->from('ReportDetails r')
                        ->where('rn_rpt_id = ?', $id);

        return $q->fetchArray();
    }











}

?>