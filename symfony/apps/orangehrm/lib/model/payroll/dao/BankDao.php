<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 19 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class BankDao extends BaseDao {
    
       public function searchBankDetails($searchMode, $searchValue, $culture="en", $orderField = 'b.bank_code ', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "bank_name") {
            if ($culture == "en")
                $feildName = "b.bank_name";
            else
                $feildName="b.bank_name_" . $culture;
        }else if ($searchMode == "bank_code") {
            $feildName = "b.bank_user_code";
        }
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('PayRollBank b');

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
    
     public function readBankDetails($id) {
        return Doctrine::getTable('PayRollBank')->find($id);
    }  
    
    public function getParentBankList() {
        
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('PayRollBank b')
                ->where('b.bnk_main = 1');        
                
                return $q->execute();
    }
    
    public function saveBankDetails(PayRollBank $bank){
        $bank->save();
    }
    
    public function getMaxBank(){
        $q = Doctrine_Query::create()
                //->select('Max(b.bank_code)')
                ->SELECT('max(CAST(b.bank_code AS DECIMAL(5,0)))')
                ->from('PayRollBank b');      
                
                return $q->fetchArray();
    }
    
    public function deleteBankDetails($id) {
        $q = Doctrine_Query::create()
                ->delete('PayRollBank')
                ->where('bank_code =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
 public function searchBranchDetails($searchMode, $searchValue, $culture="en", $orderField = 'b.bbranch_code ', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "Branch_name") {
            if ($culture == "en")
                $feildName = "b.bbranch_name";
            else
                $feildName="b.bbranch_name_" . $culture;
        }else if ($searchMode == "Branch_code") {
            $feildName = "b.bbranch_code";
        }
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('PayRollBranch b');

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
    
     public function readBranchDetails($id) {
        return Doctrine::getTable('PayRollBranch')->find($id);
    }  
    
    public function saveBranchDetails(PayRollBranch $branch){
        $branch->save();
    }
    
    public function getMaxBranch(){
        $q = Doctrine_Query::create()
//                ->select('Max(b.bbranch_code)')
//                ->from('PayRollBranch b');      
                ->SELECT('max(CAST(bbranch_code AS DECIMAL(5,0)))')
                ->from('PayRollBranch b');
                return $q->fetchArray();
    }
    
    public function deleteBranchDetails($id) {
        $q = Doctrine_Query::create()
                ->delete('PayRollBranch')
                ->where('bbranch_code =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function getBankList() {
        
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('PayRollBank b');      
                
                return $q->execute();
    }
    
    public function EmployeeBankDetails($id) {
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('PayRollEmployeeBank b')
                ->where('b.emp_number = ?',$id)        
               ->orderBy('b.ebank_order ASC');
                
                return $q->execute(); 
    }
    
        public function readEmployeeBankDetails($empno,$branchcode,$accno,$acctype) {
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('PayRollEmployeeBank b')
                ->where('b.emp_number = ?',$empno) 
                ->andwhere('b.bbranch_code = ?',$branchcode) 
                ->andwhere('b.ebank_acc_no = ?',$accno)         
                ->andwhere('b.acctype_id = ?',$acctype); 
                
                return $q->execute(); 
    }
    
    public function readEmployeeBankDetailsByEmployee($id) {
        $q = Doctrine_Query::create()
                        ->select('eb.*')
                        ->from('PayRollEmployeeBank eb')
                        ->leftjoin('eb.PayRollBranch br on br.bbranch_code=eb.bbranch_code')
                        ->leftjoin('br.PayRollBank bk on br.bank_code = bk.bank_code')
                        ->where('eb.emp_number = ?', $id)
                        ->orderBy('eb.ebank_order ASC');


        return $q->execute();
    }
    
    public function getBranchfromBank($bankcode){
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('PayRollBranch b')
                ->where('b.bank_code = ?',$bankcode);
        
        return $q->execute();
    }
    
    public function getAccountTypeList(){
                $q = Doctrine_Query::create()
                ->select('a.*')
                ->from('PayRollBankAccountType a');
                
                return $q->execute();
    }
    
    public function getBranchByID($id){
               $q = Doctrine_Query::create()
                ->select('a.*')
                ->from('PayRollBranch a')
                ->where('a.bank_code = ?', $id);       
                
                return $q->execute();
    }
    
    public function readmaxBankAccOrder($id) {
        $q = Doctrine_Query::create()
                        ->select('MAX(ebank_order)')
                        ->from('PayRollEmployeeBank r')
                        ->where('r.emp_number = ?', $id);
        return $q->execute();
    }
    
    public function getBankDetailsbydata($empno,$branch,$accounttype,$accountno){
                $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('PayRollEmployeeBank r')
                        ->where('r.emp_number = ?', $empno)
                        ->andwhere('r.bbranch_code = ?', $branch)
                        ->andwhere('r.acctype_id = ?', $accounttype)
                        ->andwhere('r.ebank_acc_no = ?', $accountno);
                        
        return $q->execute();
    }   
    
    public function savePayRollEmployeeBank($PayRollEmployeeBank){
       return $PayRollEmployeeBank->save(); 
    }
    
    public function DeleteEmployeeBankDetails($empno,$branchcode,$accno,$acctype){
        
                $q = Doctrine_Query::create()

                        ->delete('PayRollEmployeeBank r')
                        ->where('r.emp_number = ?', $empno)
                        ->andwhere('r.bbranch_code = ?', $branchcode)
                        ->andwhere('r.acctype_id = ?', $acctype)
                        ->andwhere('r.ebank_acc_no = ?', $accno);

                return $q->execute();
  
    
    }
    
    public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }
}
