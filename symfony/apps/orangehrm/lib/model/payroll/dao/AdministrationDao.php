<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class AdministartionDao extends BaseDao {

    //VoteDetails
    public function searchVoteDetails($searchMode, $searchValue, $culture="en", $orderField = 'v.vt_typ_code', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "vt_typ_name_") {
            if ($culture == "en")
                $feildName = "v.vt_typ_name";
            else
                $feildName="v.vt_typ_name_" . $culture;
        }else if ($searchMode == "vt_typ_user_code") {
            $feildName = "v.vt_typ_user_code";
        }
        $q = Doctrine_Query::create()
                ->select('v.*')
                ->from('PayrollVote v');

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
    
    public function readVoteDetails($id) {
        return Doctrine::getTable('PayrollVote')->find($id);
    }
    
    public function getVoteType() {
        $q = Doctrine_Query::create()
                ->select('vt.*')
                ->from('PayrollVoteType vt');
        
        return $q->execute();
    }
    
    public function saveVoteDetails(PayrollVote $vd) {
        $vd->save();
    }
    
    public function deleteVoteDetails($id) {
        $q = Doctrine_Query::create()
                ->delete('PayrollVote')
                ->where('vt_typ_code =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    public function getPayrollType($empId) {
        $q = Doctrine_Query::create()
                ->select('pt.*')
                ->from('PayrollType pt')
                ->leftJoin('pt.payprocessCapability c on pt.prl_type_code=c.prl_type_code')
                ->where('c.emp_number=?',$empId);
        
        return $q->execute();
    }
    public function getPayrollType1() {
        $q = Doctrine_Query::create()
                ->select('pt.*')
                ->from('PayrollType pt');
                

        return $q->execute();
    }
    public function getPayrollDisc($id){
        $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('payprocessCapability c')
                ->where('c.emp_number=?',$id);

        return $q->execute();
    }
    
    public function readConfigurationShedulePerYear($Year,$ComCode) {
        $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollSchedule s')
                ->where('s.pay_sch_year =?',$Year)
                ->Andwhere('s.pay_hie_code =?',$ComCode)
                ->orderBy('s.pay_sch_month ASC');
        return $q->fetchArray();
    }
    
    public function saveShedule(PayrollSchedule $ps) {
        $ps->save();
    }
    
        public function readConfigurationShedule($id) {
                  $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollSchedule s')
                ->where('s.pay_sch_id =' . $id);
                return $q->fetchOne();

    }
    
    public function getMaxLockID($ID){
                $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollSchedule s')
                ->where('s.pay_sch_disabled_flg =' . 0)
                ->Andwhere('s.pay_hie_code =' . $ID)        
                ->orderBy('s.pay_sch_st_date ASC');        
                  
                return $q->fetchOne();
    }
    
    public function getMaxUnlockID($ID){
                $q = Doctrine_Query::create()
                ->select('s.*')
                ->from('PayrollSchedule s')
                ->where('s.pay_sch_disabled_flg =' . 1)
                ->Andwhere('s.pay_hie_code =' . $ID)        
                ->orderBy('s.pay_sch_st_date DESC');        
                  
                return $q->fetchOne();
    }
    
    public function getDistrict(){
                 $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('CompanyStructure c')
                ->where('c.def_level =' . 3);     
                  
                return $q->execute();
    }
    
    public function getDivisionByDistrict($ID){
                 $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('CompanyStructure c')
                ->where('c.def_level =' . 4) 
                ->Andwhere('c.parnt =' . $ID);
                  
                return $q->execute();
    }
    
   public function readEmployee($id) {
        //return Doctrine::getTable('Employee')->find($id);
                 $q = Doctrine_Query::create()
                ->select('e.*,u.*')
                ->from('Employee e')
                ->leftJoin('e.Users u')         
                ->where('e.emp_number ='. $id); 
                  
                //return $q->execute();
                return $q->fetchOne();

    }
    
       public function getMax() {
                 $q = Doctrine_Query::create()
                ->select('Max(p.pay_sch_id)')
                ->from('PayrollScheduleMaster p');     
                 

                return $q->fetchone();

    }
      public function getLastUnlockPayShedule() {
         $q = Doctrine_Query::create()
                ->select('MIN(p.pay_sch_st_date) as fromDate,MIN(p.pay_sch_end_date) as endDate')
                ->from('PayrollSchedule p')
                ->where('p.pay_sch_disabled_flg = 0');                 
                return $q->fetchArray();
    }

    public function getEmployee($insList){

        if (is_array($insList)) {
                $q = Doctrine_Query::create()
                                ->select('e.*')
                                ->from('Employee e')
                                ->whereIn('e.emp_number', $insList);

                return $q->fetchArray();
            }
    }

     public function searchEmployee( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'e.emp_number', $orderBy = 'ASC', $type='single',$method='',$reason='',$att='',$payroll='',$payrolltype='')
   {

        $encryption=new EncryptionHandler();
        $decryptprType=$encryption->decrypt($payrolltype);
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
                                ->select('e.*,j.*,s.*,d.*,u.*,p.*')
                                ->from('Employee e')
                                ->leftJoin('e.jobTitle j')
                                ->leftJoin('e.ServiceDetails s')
                                ->leftJoin('e.subDivision d');

                                if($reason!='companyHead'){
                                   if($reason=='security'){
                                       $q->leftJoin('e.Users u');

                                 $q->where('u.emp_number!=');

                                }elseif($reason=='atte'){
                                    $q->where('e.emp_active_hrm_flg = 1')
                                      ->AndWhere('e.emp_active_att_flg = 1');
                                }
                                else if($payroll=='payroll'){

                                    $q->leftJoin('e.PayrollEmployee p')
                                      ->AndWhere('e.emp_active_pr_flg = 1');
                                   if(strlen($payrolltype)){
                                    $q->AndWhere('p.prl_type_code =?',array($decryptprType));
                                   }

                                }
                                else{
                                    $q->where('e.emp_active_hrm_flg = 1');
                                }

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
    
    public function getPayrollTypeID($id) {
        $q = Doctrine_Query::create()
                ->select('vt.*')
                ->from('PayrollVote vt')
                ->where('vt.vt_inf_type_code=?',$id);
        
        return $q->execute();
    }

}
?>
