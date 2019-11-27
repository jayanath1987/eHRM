<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 16 11 2011
 *  Comments  - Payroll Module Bank Diskette Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class BankDisketteDao extends BaseDao {
    
       public function searchBankDiskette($searchMode, $searchValue, $culture="en", $orderField = 'b.bank_code ', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "dsk_name") {
            if ($culture == "en")
                $feildName = "b.dsk_name";
            else
                $feildName="b.dsk_name_" . $culture;
        }else if ($searchMode == "bank_code") {
            $feildName = "b.bank_user_code";
        }
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDiskette b');

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
    
     public function readBankDiskette($id) {
        return Doctrine::getTable('hsPrBankDiskette')->find($id);
    }  
    
    public function getView(){

       $conn = Doctrine_Manager::getInstance()->connection(); 
        
        $sql="SELECT table_name, table_schema FROM information_schema.views where table_name like 'vw_pr_bd_%'";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        return $stmt->fetchAll();

    }
    
    
    public function getColumnsByViewID($id){
        
        $conn = Doctrine_Manager::getInstance()->connection(); 
        
        $sql="SHOW COLUMNS FROM ".$id ;
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function saveBankDiskette($hsPrBankDiskette){
        $hsPrBankDiskette->save();
    }

    public function readBankDisketteDetail($id){
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteDetail b')
                ->where('b.dsk_id = ?',$id);        
                
                return $q->execute();
    }
    
    public function readBankDisketteMax(){
               $q = Doctrine_Query::create()
                ->select('MAX(b.dsk_id)')
                ->from('hsPrBankDiskette b');    
                
                return $q->execute();
    }
    
    public function savehsPrBankDisketteDetail($hsPrBankDisketteDetail){
        $hsPrBankDisketteDetail->save();
    }
    
    public function getListBankDetail($id){
        
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteDetail b')
                ->where('b.dsk_id = ?',$id); 
                return $q->execute();
                //return $q->fetchArray();
    }
    
    public function readBankDisketteDetailByData($DiskId,$Position,$order){ 
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteDetail b')
                ->where('b.dsk_id = '.$DiskId)
                ->andwhere('b.dskd_column = '.$Position)
                ->andwhere('b.dskd_order = '.$order);
                        
                return $q->fetchOne();
                //die(print_r($q->getSql()));
                
    }

    public function searchBankDisketteProcessList($searchMode, $searchValue, $culture="en", $orderField = 'b.bdp_id ', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "bdp_payment_date") {
                $feildName = "b.bdp_payment_date";
        }else if ($searchMode == "title") {
            if ($culture == "en")
                $feildName = "c.title";
            else
                $feildName="c.title_" . $culture;
        }
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteProcess b')
                ->leftJoin('b.CompanyStructure c')
                ->leftJoin('b.hsPrBankDiskette d');

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
    
    
    public function DetailViewColumn($view, $column,$Emp, $startdate, $enddate, $workstation,$bankcode,$emparray){
       $conn = Doctrine_Manager::getInstance()->connection(); 
        //die(print_r($emparray));
       if($emparray==""){
        $sql="select ".$column." from ".$view ;
        $sql=$sql." where Amount IS NOT NULL";
        if($Emp!=""){
            $sql=$sql." and EmployeeNo = '{$Emp}'";
        }
        if($startdate!=""){
             $sql=$sql." and StartDate = '{$startdate}'";
        }
        if($enddate!=""){
             $sql=$sql." and EndDate = '{$enddate}'";
        }
//        if($workstation!=""){
//             $sql=$sql." and BankWorkStation = {$workstation}";
//        }
        if($bankcode!=""){
             $sql=$sql." and BankCode = '{$bankcode}'";
        }
       }else{
        $sql="select sum(Amount) from ".$view ;
        $sql=$sql." where Amount IS NOT NULL";
        
        if($startdate!=""){
             $sql=$sql." and StartDate =  '{$startdate}'";
        }
        if($enddate!=""){
             $sql=$sql." and EndDate = '{$enddate}'";
        }
//        if($workstation!=""){
//             $sql=$sql." and BankWorkStation = {$workstation}";
//        }
        if($bankcode!=""){
             $sql=$sql." and BankCode = '{$bankcode}'";
        }

             $sql=$sql." and EmployeeNo IN ({$emparray})";
        
       }
       //die(print_r($sql));
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function readBankDisketteProcess($id){
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteProcess b')
                ->where('b.bdp_id = ?',$id); 
                return $q->execute();
    }
    
    public function readBankDisketteProcessEmployee($id){
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteProcessEmployee b')
                ->where('b.bdp_id = ?',$id); 
               // return $q->execute();
                return $q->fetchArray();
    }
    
        public function getEmployee($insList = array()) {

        if (is_array($insList)) {
            $q = Doctrine_Query::create()
                    ->from('Employee e')
                    ->whereIn('e.emp_number', $insList);

            return $q->fetchArray();
        }
    }
    
        public function getCompnayStructure($id) {
        
            return Doctrine::getTable('CompanyStructure')->find($id);
        
    }
    
    public function getBankDiskList(){
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDiskette b');
                
                return $q->execute();
    }
    
    public function savehsPrBankDiskette($hsPrBankDisketteProcess){
        $hsPrBankDisketteProcess->save();
    }
    
    public function readhsPrBankDisketteProcess($id){
        return Doctrine::getTable('hsPrBankDisketteProcess')->find($id);
    }

        public function readBankDisketteProcessMax(){
               $q = Doctrine_Query::create()
                ->select('MAX(b.bdp_id)')
                ->from('hsPrBankDisketteProcess b');    
                
                return $q->execute();
    }
    
    public function savehsPrBankDisketteProcessEmployee($hsPrBankDisketteProcessEmployee){
        $hsPrBankDisketteProcessEmployee->save();
    }
    
    public function readhsPrBankDisketteProcessEmployee($id, $emp){
        $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteProcessEmployee b')
                ->where('b.bdp_id =?',$id)
                ->andwhere('b.emp_number=?',$emp);
                
                return $q->execute();
    }
    
    public function readhsPrBankDisketteProcessEmployeeID($id){
                $q = Doctrine_Query::create()
                ->select('b.*')
                ->from('hsPrBankDisketteProcessEmployee b')
                ->where('b.bdp_id =?',$id);
                
                
                return $q->fetchArray();
    
    }
    
    
    public function DisketteEmployeeDelete($diskid,$empno){
                $q = Doctrine_Query::create()
                        ->delete('hsPrBankDisketteProcessEmployee')                        
                        ->where('bdp_id = '. $diskid)
                        ->andwhere('emp_number = '. $empno);

        $q->execute();
    }
    
    
    public function DisketteColumnDelete($diskid,$pos,$order){
                        $q = Doctrine_Query::create()
                        ->delete('hsPrBankDisketteDetail')                        
                        ->where('dsk_id = '. $diskid)
                        ->andwhere('dskd_column = '. $pos)
                        ->andwhere('dskd_order = '. $order);        

        $q->execute();
    }
    
     public function deleteBankDiskette($id) {
        $q = Doctrine_Query::create()
                ->delete('hsPrBankDiskette')
                ->where('dsk_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
   public function deleteBankDisketteDetail($id) {
        $q = Doctrine_Query::create()
                ->delete('hsPrBankDisketteDetail')
                ->where('dsk_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
         public function BankDisketteProcessEmployee($id) {
        $q = Doctrine_Query::create()
                ->delete('hsPrBankDisketteProcessEmployee')
                ->where('bdp_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
   public function BankDisketteProcess($id) {
        $q = Doctrine_Query::create()
                ->delete('hsPrBankDisketteProcess')
                ->where('bdp_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    public function defaultBankEmployeeLoad($bankName = null, $process_type = null, $dis_code = null) {
        $q = Doctrine_Query::create()
                ->select('e.*,p.*,b.*,ba.*,br.*')
                ->from('Employee e')
                ->leftJoin('e.payprocessCapability p')
                ->leftJoin('e.PayRollEmployeeBank b')
                ->leftJoin('b.PayRollBranch br')
                ->leftJoin('br.PayRollBank ba')
                ->where('e.emp_active_hrm_flg = 1');
               
          if ($process_type != null){
              //$q->andwhere('p.prl_process_type = ?', $process_type);             
          }
       
          if($dis_code != null){
            $q->andwhere('p.prl_disc_code = ?', $dis_code);
          }
          
          if($bankName != null){
            $q->andwhere('ba.bank_code = ?', $bankName);
          }
          
         return $q->fetchArray();
    }
}
