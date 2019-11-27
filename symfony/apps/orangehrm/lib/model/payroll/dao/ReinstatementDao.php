<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 14 September 2011
 *  Comments  - Reinstatement Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class ReinstatementDao extends BaseDao {

    public function searchReinstatement($searchMode, $searchValue, $culture='en', $orderField = 'r.rei_id', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "emp_name") {
            if ($culture == "en")
                $feildName = "e.emp_display_name";
            else
                $feildName="e.emp_display_name_" . $culture;
        }else if ($searchMode == "emp_number") {
            $feildName = "e.employeeId";
        }else if ($searchMode == "institute") {
            $feildName = "r.oth_institute_name";
        }
        $q = Doctrine_Query::create()
                ->select('r.*')
                ->from('Reinstatement r')
                ->innerJoin('r.Employee e');

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

     public function readEmployee($id) {

         return Doctrine::getTable('Employee')->find($id);

    }
    
    public function readPayrollEmployee($id) {

         return Doctrine::getTable('PayrollEmployee')->find($id);

    }
    
    public function readReinstatement($id) {

        return Doctrine::getTable('Reinstatement')->find($id);
    }
    
    public function getDesignation() {

        $q = Doctrine_Query::create()
              ->from('JobTitle');
        return $q->execute();

        
    }
    
     public function getGradeLoad() {

        $q = Doctrine_Query::create()
                        ->from('Grade');
        return $q->execute();

        
    }
    
    public function saveReinstatement(Reinstatement $Reinstatement) {

        $Reinstatement->save();
        return true;
    }
    
     public function savePayrollEmployee(PayrollEmployee $PayrollEmployee) {

        $PayrollEmployee->save();
        return true;
    }
    
    public function getPendingUpadateReinstatement(){
        $e = getdate();
        $today = date("Y-m-d", $e[0]);
        
               $q = Doctrine_Query::create()
                ->select('r.*')          
                ->from('Reinstatement r')
                ->where("r.rei_date = ?", $today);
               return $q->execute();
    }
    
    public function deleteReinstatement($id) {
        $q = Doctrine_Query::create()
                        ->delete('Reinstatement r')
                        ->where('r.rei_id = ?', $id);


        return $q->execute();
    }
    
    public function searchEmployee( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'e.emp_number', $orderBy = 'ASC', $type='single',$method='',$reason='',$att='',$payroll='')
   {
        
         switch ($searchMode) {
            case 'id':
                $searchColumn = 'e.employee_id';
                break;
            case 'firstname':
                $searchColumn = "e.emp_firstname";
                break;
            case 'lastname':
                $searchColumn = "e.emp_lastname";
                break;
            case 'designation':
                $searchColumn = "j.jobtit_name";
                break;
            case 'service':
                $searchColumn = "s.service_name";
                break;
            case 'division':
                $searchColumn = "d.title";
                break;
        }

        if ($searchMode!='id' && $searchMode!='all') {
            $searchColumn = ($userCulture == "en") ? $searchColumn : $searchColumn . '_' . $userCulture;
        }

        if ($orderField!='e.emp_number') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create()
                                ->select('e.*,j.*,s.*,d.*,u.*,p.*,dis.*')
                                ->from('Employee e')
                                ->leftJoin('e.jobTitle j')
                                ->leftJoin('e.ServiceDetails s')
                                ->leftJoin('e.subDivision d')
                                ->innerJoin('e.DisEmployeeInvolved dis');
                
                                if($reason!='companyHead'){
                                   if($reason=='security'){
                                       $q->leftJoin('e.Users u');
                                   
                                 $q->where('u.emp_number!=');
                                
                                }elseif($reason=='atte'){
                                    $q->where('e.emp_active_hrm_flg = 1')
                                      ->AndWhere('e.emp_active_att_flg = 1');
                                }
                                else{
                                    //$q->where('e.emp_active_hrm_flg = 1');
                                }

                                }
                                
                                if($payroll=='payroll'){
                                    $q->innerJoin('e.PayrollEmployee p')
                                    ->AndWhere('e.emp_active_att_flg = 1');        
                                }
                               

        if ( $searchMode !='all' && $searchValue !='') {
            $q->Andwhere($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }

        $q->orderBy($orderField.' '.$orderBy);

        $resultsPerPage = sfConfig::get('app_items_per_page')?sfConfig::get('app_items_per_page'):10;

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
          "?page={%page_number}&mode=search&txtSearchValue={$searchValue}&cmbSearchMode={$searchMode}&sort={$orderField}&order={$orderBy}&type={$type}&method={$method}&reason={$reason}&payroll={$payroll}"
        );

        $pager  = $pagerLayout->getPager();
        $result = array();
        $result['data']     = $pager->execute();
        $result['pglay']    = $pagerLayout;

        return $result;
    }

    
    
}
?>
