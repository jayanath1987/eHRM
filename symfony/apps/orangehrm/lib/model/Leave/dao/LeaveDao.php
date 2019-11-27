<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class LeaveDao extends BaseDao {

    public function searchDocumentType($searchMode, $searchValue, $culture="en", $orderField = 'b.leave_type_id', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "leave_type_name_") {
            if ($culture == "en")
                $feildName = "b.leave_type_name";
            else
                $feildName="b.leave_type_name_" . $culture;
        }
        if ($orderField == "b.leave_type_name") {
            if ($culture == "en")
                $orderField = "b.leave_type_name";
            else
                $orderField="b.leave_type_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveType b');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


        //return $q->execute();
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
                        "?page={%page_number}&amp;mode=search&amp;searchValue={$searchValue}&amp;searchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function readDocumentType($id) {

        return Doctrine::getTable('LeaveType')->find($id);
    }

    public function readLeaveEntitlement($eid, $lt, $yr) {

        $q = Doctrine_Query::create()
                        ->select('l.*')
                        ->from('LeaveEntitlement l')
                        ->where('l.emp_number = ?', $eid)
                        ->andwhere('l.leave_type_id = ?', $lt)
                        ->andwhere('l.leave_ent_year = ?', $yr);
        return $q->fetchArray();
    }

    public function readLeaveEntitlementDisplay($eid, $yr) {
        $q = Doctrine_Query::create()
                        ->select('l.*')
                        ->from('LeaveEntitlement l')
                        ->where('l.emp_number = ?', $eid)
                        ->andwhere('l.leave_ent_year = ?', $yr);
        return $q->fetchArray();
    }

    public function readLeaveTypeConfig($transPeid) {
        return Doctrine::getTable('LeaveTypeConfig')->find(array($transPeid));
    }

    public function readLeaveHolyDay() {
        $q = Doctrine_Query::create()
                        ->select('l.*')
                        ->from('LeaveHoliday l');
        return $q->fetchArray();
    }

    public function readLeaveLeaveRange($SDate, $EDate, $emp) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveApplication b')
                        ->where('b.emp_number = ?', $emp)
                        ->andWhere('b.leave_app_start_date >= ?', $SDate)
                        ->andWhere('b.leave_app_start_date <= ?', $EDate)
                        ->andWhere('b.leave_app_status NOT IN (0,3)');

        $r = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveApplication b')
                        ->where('b.emp_number = ?', $emp)
                        ->andWhere('b.leave_app_end_date >= ?', $SDate)
                        ->andWhere('b.leave_app_end_date <= ?', $EDate)
                        ->andWhere('b.leave_app_status NOT IN (0,3)');

        $s = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveApplication b')
                        ->where('b.emp_number = ?', $emp)
                        ->andWhere('b.leave_app_start_date >= ?', $SDate)
                        ->andWhere('b.leave_app_end_date <= ?', $EDate)
                        ->andWhere('b.leave_app_status NOT IN (0,3)');
        $t = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveApplication b')
                        ->where('b.emp_number = ?', $emp)
                        ->andWhere('b.leave_app_start_date <= ?', $SDate)
                        ->andWhere('b.leave_app_end_date >= ?', $EDate)
                        ->andWhere('b.leave_app_status NOT IN (0,3)');

        $sqlone = $q->fetchArray();
        $sqltwo = $r->fetchArray();
        $sqlthree = $s->fetchArray();
        $sqlfour = $t->fetchArray();
        if (($sqlone != null or $sqltwo != null) or ($sqlthree != null or $sqlfour != null )) {
            return "invalid";
        } else {
            return "valid";
        }
    }

    public function getEmployee($insList = array()) {

        try {
            if (is_array($insList)) {
                $q = Doctrine_Query::create()
                                ->select('e.*')
                                ->from('Employee e')
                                ->whereIn('e.emp_number', $insList);

                return $q->fetchArray();
            }
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function readLeaveLeaveHD($SDate, $emp) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveApplication b')
                        ->where('b.emp_number = ?', $emp)
                        ->andWhere('b.leave_app_start_date <= ?', $SDate)
                        ->andWhere('b.leave_app_end_date >= ?', $SDate);
        if ($q->fetchArray() != null) {
            return "invalid";
        } else {
            return "valid";
        }
    }

    public function getLeaveload($transPeid) {
        return Doctrine::getTable('LeaveApplication')->find(array($transPeid));
    }

    public function getemployeePendingLeave($emp) {

        $q = Doctrine_Query::create()
                        ->select('count(l.leave_type_id) ')
                        ->from('LeaveApplication l')
                        ->where('l.emp_number = ?', $emp)
                        ->andwhere('l.leave_app_status = ?', 1);
        return $q->fetchArray();
    }
    
        public function getemployeePendingLeaveEMPLOYEE($emp) {
            
            if($emp){
            $emp = str_replace("_",',',$emp);
        }
if($emp!=null){
        $q = Doctrine_Query::create()
                        ->select('l.emp_number ')
                        ->from('LeaveApplication l')
                        ->where("l.emp_number IN (".$emp.") " ) 
                        ->andwhere('l.leave_app_status = ?', 1);
        return $q->fetchArray();
}
    }

    public function IsLeaveTypedetail($tid, $eid) {
        $q = Doctrine_Query::create()
                        ->select('count(l.leave_type_id) as Status')
                        ->from('LeaveTypeConfigDetail l')
                        ->where('l.leave_type_id = ?', $tid)
                        ->andwhere('l.estat_code = ?', $eid);

        return $q->fetchArray();
    }

    public function readLeaveTypeConfigdetails($id) {
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('LeaveTypeConfigDetail')
                        ->where('leave_type_id = ?', $id)
                        ->orderBy('estat_code ASC');
        return $q->fetchArray();
    }

    public function validLeaveTypeConfigdetailsforemployee($id) {
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('LeaveTypeConfigDetail')
                        ->where('leave_type_id = ?', $id)
                        ->orderBy('estat_code ASC');
        return $q->fetchArray();
    }

    public function IsLeaveType($id) {
        $q = Doctrine_Query::create()
                        ->select('count(l.leave_type_id) as Status')
                        ->from('LeaveTypeConfig l')
                        ->where('l.leave_type_id = ?', $id);

        return $q->fetchArray();
    }

    public function LoadLeaveEntitledate($id) {
        $q = Doctrine_Query::create()
                        ->select('l.leave_type_entitle_days')
                        ->from('LeaveTypeConfig l')
                        ->where('l.leave_type_id = ?', $id);

        return $q->fetchArray();
    }

    public function LoadEmpData($id) {
        $q = Doctrine_Query::create()
                        ->select('e.*')
                        ->from('EmployeeMaster e')
                        ->where('e.emp_number = ?', $id);

        return $q->execute();
    }

    public function LoadsubordinateData($id) {
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('ReportTo r')
                        ->where('r.subordinateId = ?', $id)
                        ->Andwhere('r.erep_reporting_mode = 1');

        return $q->fetchArray();
    }

    public function saveDocumentType(LeaveType $rte) {
        $rte->save();
        return true;
    }

    public function saveEntitlement(LeaveEntitlement $rte) {
        $rte->save();
        return true;
    }

    public function saveLeave(LeaveApplication $rte) {
        $rte->save();
        return true;
    }

    public function saveLeavedeatil(LeaveDetail $rte) {
        $rte->save();
        return true;
    }

    public function findlastleave($txtEmpId, $cmbbtype, $start_date, $end_date, $workdays) {
        $q = Doctrine_Query::create()
                        ->select('Max(r.leave_app_id)')
                        ->from('LeaveApplication r')
                        ->where('emp_number = ?', $txtEmpId)
                        ->andwhere('leave_type_id = ?', $cmbbtype)
                        ->andWhere('leave_app_start_date = ?', $start_date)
                        ->andWhere('leave_app_end_date = ?', $end_date)
                        ->andWhere('leave_app_workdays = ?', $workdays);
        return $q->fetchArray();
    }

    public function UpdateEntitlement($txtEmpId, $cmbbtype, $txtYear, $txtEntitleDays, $txtSheduleDays, $txtEnTakenDays, $leave_ent_remain) {
        $q = Doctrine_Query::create()
                        ->update('LeaveEntitlement r')
                        ->set('r.leave_ent_day', '?', $txtEntitleDays)
                        ->set('r.leave_ent_taken', '?', $txtEnTakenDays)
                        ->set('r.leave_ent_sheduled', '?', $txtSheduleDays)
                        ->set('r.leave_ent_remain', '?', $leave_ent_remain)
                        ->where('emp_number = ?', $txtEmpId)
                        ->andwhere('leave_type_id = ?', $cmbbtype)
                        ->andWhere('leave_ent_year = ?', $txtYear);
        $q->execute();
        return true;
    }

    public function UpdateEntitlementLeave($txtEmpId, $cmbbtype, $txtYear, $txtSheduleDays, $leave_ent_remain, $Taken, $Approved) {
        $q = Doctrine_Query::create()
                        ->update('LeaveEntitlement r')
                        ->set('r.leave_ent_sheduled', '?', $txtSheduleDays)
                        ->set('r.leave_ent_remain', '?', $leave_ent_remain);
        if ($Approved == "2") {
            $q->set('r.leave_ent_taken', '?', $Taken);
        }
        $q->where('emp_number = ?', $txtEmpId)
                ->andwhere('leave_type_id = ?', $cmbbtype)
                ->andWhere('leave_ent_year = ?', $txtYear);
        $q->execute();
        return true;
    }

    public function UpdateEntitlementLeaveNoShedule($txtEmpId, $cmbbtype, $txtYear, $txtEnTakenDays, $leave_ent_remain) {
        $q = Doctrine_Query::create()
                        ->update('LeaveEntitlement r')
                        ->set('r.leave_ent_taken', '?', $txtEnTakenDays)
                        ->set('r.leave_ent_remain', '?', $leave_ent_remain)
                        ->where('emp_number = ?', $txtEmpId)
                        ->andwhere('leave_type_id = ?', $cmbbtype)
                        ->andWhere('leave_ent_year = ?', $txtYear);
        $q->execute();
        return true;
    }

    public function UpdateEntitlementLeaveNoRemain($txtEmpId, $cmbbtype, $txtYear, $txtEnTakenDays, $txtSheduleDays) {
        $q = Doctrine_Query::create()
                        ->update('LeaveEntitlement r')
                        ->set('r.leave_ent_taken', '?', $txtEnTakenDays)
                        ->set('r.leave_ent_sheduled', '?', $txtSheduleDays)
                        ->where('emp_number = ?', $txtEmpId)
                        ->andwhere('leave_type_id = ?', $cmbbtype)
                        ->andWhere('leave_ent_year = ?', $txtYear);
        $q->execute();
        return true;
    }

    public function UpdateEntitlementLeaveNoTaken($txtEmpId, $cmbbtype, $txtYear, $txtSheduleDays, $leave_ent_remain) {
        $q = Doctrine_Query::create()
                        ->update('LeaveEntitlement r')
                        ->set('r.leave_ent_sheduled', '?', $txtSheduleDays)
                        ->set('r.leave_ent_remain', '?', $leave_ent_remain)
                        ->where('emp_number = ?', $txtEmpId)
                        ->andwhere('leave_type_id = ?', $cmbbtype)
                        ->andWhere('leave_ent_year = ?', $txtYear);
        $q->execute();
        return true;
    }

    public function saveLeaveTypeConfig(LeaveTypeConfig $rte) {
        $rte->save();
        return true;
    }

    public function saveLeaveTypeConfigDetails(LeaveTypeConfigDetail $rte) {
        $rte->save();
        return true;
    }

    public function getLeaveTypeloadall() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveType b')
                        ->leftJoin('b.LeaveTypeConfig d ON b.leave_type_id = d.leave_type_id');
        return($q->execute());
    }

    public function getLeaveTypeload() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveType b')
                        ->leftJoin('b.LeaveTypeConfig d ON b.leave_type_id = d.leave_type_id')
                        ->where('d.leave_type_active_flg = 1');
        return($q->execute());
    }

    public function getEmployeeTypeload() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('EmployeeStatus b');

        return $q->fetchArray();
    }

    public function reademplyeename($eid, $Culture) {
        if ($Culture == 'en') {
            $abcd = "emp_display_name";
        } else {
            $abcd = "emp_display_name_" . $Culture;
        }
        $q = Doctrine_Query::create()
                        ->select('e.' . $abcd)
                        ->from('Employee e')
                        ->where('e.emp_number = ?', $eid);
        return $q->fetchArray();
    }

    public function deleteDocumentType($id) {

        $q = Doctrine_Query::create()
                        ->delete('LeaveType')
                        ->where('leave_type_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteLeave($id) {

        $q = Doctrine_Query::create()
                        ->delete('LeaveApplication')
                        ->where('leave_app_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteEntitlement($id) {
        $pieces = explode("|", $id);
        $pieces[0];
        $pieces[1];
        $pieces[2];
        $q = Doctrine_Query::create()
                        ->delete('LeaveEntitlement')
                        ->where('emp_number =' . $pieces[0])
                        ->andwhere('leave_type_id =' . $pieces[1])
                        ->andwhere('leave_ent_year =' . $pieces[2]);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deletereclevtypeconfigdetail($ltid) {
        $q = Doctrine_Query::create()
                        ->delete('LeaveTypeConfigDetail')
                        ->where('leave_type_id = ?', $ltid);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getCompnayStructure($id) {
        try {
            return Doctrine::getTable('CompanyStructure')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function searchEntitlement($searchMode, $searchValue, $culture="en", $orderField = 'b.emp_number', $orderBy = 'ASC', $page = 1) {
        switch ($searchMode) {
            case "employee_id":
                $feildName = "e.employee_id";
                break;

            case "emp_name":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name_" . $culture;
                break;
            case "leave_type_name_":
                if ($culture == "en")
                    $feildName = "c.leave_type_name";
                else
                    $feildName="c.leave_type_name_" . $culture;
                break;
            case "empid":
                $feildName = "b.emp_number";
                break;
        }

        $q = Doctrine_Query::create()
                        ->select('DISTINCT b.*')
                        ->from('LeaveEntitlement b')
                        ->leftJoin('b.Employee e ON b.emp_number = e.emp_number')
                        ->leftJoin('b.LeaveType c ON b.leave_type_id = c.leave_type_id')
                        ->leftJoin('c.LeaveTypeConfig d ON c.leave_type_id = d.leave_type_id');

        if ($searchValue != "") {
            if ($feildName == "e.emp_number") {
                $q->where('e.emp_number = ?', $searchValue);
            } else {

                $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
            }
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

    public function searchLeave($searchMode, $searchValue, $culture="en", $orderField = 'b.leave_app_start_date', $orderBy = 'DESC', $page = 1, $empid) {

        switch ($searchMode) {
            case "emp_name":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name_" . $culture;
                break;
            case "leave_type_name_":
                if ($culture == "en")
                    $feildName = "c.leave_type_name";
                else
                    $feildName="c.leave_type_name_" . $culture;
        }

        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveApplication b')
                        ->leftJoin('b.Employee e ON b.emp_number = e.emp_number')
                        ->leftJoin('b.LeaveType c ON b.leave_type_id = c.leave_type_id')
                        ->where('b.emp_number = ?', $empid);

        if ($searchValue != "") {
            $q->Andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

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
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&empid={$empid}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function viewall($from, $to, $page=1, $eno=null, $type, $orderField = 'a.leave_app_id', $orderBy = 'ASC', $EmployeeSub1,$chkAll,$chkPending=null,$chkApproved=null,$chkRejected=null,$chkCanceled=null,$chkTaken=null) {
//      die(print_r($from.$to.$page.$eno.$type.$orderField.$orderBy.$post.$EmployeeSub1));     
        //try {
            if ($type == 0) {
                $q = Doctrine_Query::create()
                                ->select('*')
                                ->from('LeaveApplication a')
                                ->leftJoin('a.Employee e ON a.emp_number = e.emp_number')
                                ->leftJoin('a.LeaveType c ON a.leave_type_id = c.leave_type_id')
                                ->Where('a.leave_app_start_date >= ?', $from)
                                ->andWhere('a.leave_app_end_date <= ?', $to);
                                if($eno!=null){
                                $q->andwhere("a.emp_number IN (".$eno.")");
                                }

                                
                      if($chkAll == "All"){
                          //$q->andWhere('or = 1');
                     }else{           
                     if($chkCanceled == "Canceled"){
                          //$q->andWhere('a.leave_app_status = 0');
                         $Ty[0]=0;
                     }
                     if($chkPending == "Pending"){
                          //$q->andWhere('a.leave_app_status = 1');
                         $Ty[1]=1;
                     }
                     if($chkApproved == "Approved"){
                          //$q->andWhere('a.leave_app_status = 2');
                         $Ty[2]=2;
                     } 
                     if($chkRejected == "Rejected"){
                          //$q->andWhere('a.leave_app_status = 3');
                         $Ty[3]=3;
                     } 
                     if($chkTaken == "Taken"){
                          //$q->andWhere('a.leave_app_status = 4');
                         $Ty[4]=4;
                     } 
                        $q->andWhereIn("a.leave_app_status",$Ty);
                     }                               
                                
                $q->orderBy($orderField . ' ' . $orderBy);
            }
             else if ($type == 1) {
                $q = Doctrine_Query::create()
                                ->select("a.*")
                                ->from("LeaveApplication a")
                                ->leftJoin("a.Employee e ON a.emp_number = e.emp_number")
                                ->leftJoin("a.LeaveType c ON a.leave_type_id = c.leave_type_id")              
                                //->whereIn("a.emp_number"    , array($eno) );
                                ->where("a.emp_number IN (".$eno.") " )
                                ->AndWhere("a.leave_app_status = 1");
                
                                if($from!= null && $to!= null){
                
                                $q->andWhere('a.leave_app_start_date >= ?', $from)
                                ->andWhere('a.leave_app_end_date <= ?', $to);
                                }


                     if($chkAll == "All"){
                          //$q->andWhere('or = 1');
                     }else{           
                     if($chkCanceled == "Canceled"){
                          //$q->andWhere('a.leave_app_status = 0');
                         $Ty[0]=0;
                     }
                     if($chkPending == "Pending"){
                          //$q->andWhere('a.leave_app_status = 1');
                         $Ty[1]=1;
                     }
                     if($chkApproved == "Approved"){
                          //$q->andWhere('a.leave_app_status = 2');
                         $Ty[2]=2;
                     } 
                     if($chkRejected == "Rejected"){
                          //$q->andWhere('a.leave_app_status = 3');
                         $Ty[3]=3;
                     } 
                     if($chkTaken == "Taken"){
                          //$q->andWhere('a.leave_app_status = 4');
                         $Ty[4]=4;
                     } 
                        $q->andWhereIn("a.leave_app_status",$Ty);
                     }
                   
                                
                $q->orderBy($orderField . ' ' . $orderBy);
            }
            if($EmployeeSub!=null ){

                $q = Doctrine_Query::create()
                ->select('*')
                ->from('LeaveApplication a')
                ->leftJoin('a.Employee e ON a.emp_number = e.emp_number')
                ->leftJoin('a.LeaveType c ON a.leave_type_id = c.leave_type_id')
                ->where("a.emp_number IN (".$EmployeeSub.")");
                $q->andWhere('a.leave_app_status = 1');
                $q->orderBy($orderField . ' ' . $orderBy);

            }
            //$resultsPerPage = sfConfig::get('app_items_per_page2') ? sfConfig::get('app_items_per_page2') : 20;
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
                            "?page={%page_number}&searchValue={$from}&searchMode={$to}&emp={$eno}&type={$type}&sort={$orderField}&order={$orderBy}&EmployeeSub={$EmployeeSub}&chkAll={$chkAll}&chkPending={$chkPending}&chkApproved={$chkApproved}&chkRejected={$chkRejected}&chkCanceled={$chkCanceled}&chkTaken={$chkTaken}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;
//        } catch (Exception $e) {
//            throw new DaoException($e->getMessage());
//        }
    }

    public function searchHolyDay($searchMode, $searchValue, $culture="en", $orderField = 'leave_holiday_date', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "leave_holiday_name_") {
            if ($culture == "en")
                $feildName = "b.leave_holiday_name";
            else
                $feildName="b.leave_holiday_name_" . $culture;
        }
        if ($searchMode == "leave_holiday") {
            $feildName = "b.leave_holiday_date";
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveHoliday b');

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

    public function saveHolyday(LeaveHoliday $rte) {
        $rte->save();
        return true;
    }

    public function readHolyday($id) {

        return Doctrine::getTable('LeaveHoliday')->find($id);
    }

    public function deleteHolyDay($id) {

        $q = Doctrine_Query::create()
                        ->delete('LeaveHoliday')
                        ->where('leave_holiday_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteLeaveconfig($id) {

        $q = Doctrine_Query::create()
                        ->delete('LeaveTypeConfig')
                        ->where('leave_type_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

        public function getLeaveTypeloadMeternity($id) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('LeaveTypeConfig b')
                ->where('leave_type_id =' . $id);

        return $q->fetchArray();

        }

            public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

        public function Loadsubordinate($id) {
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('ReportTo r')
                        ->where('r.supervisorId = ?', $id);

        return $q->fetchArray();
    }

        public function readShortLeave($Year, $Month, $emp,$LType) {
        $q = Doctrine_Query::create()
                        ->select('count(b.leave_app_id)')
                        ->from('LeaveApplication b')
                        ->where('b.emp_number = ?', $emp)
                        ->andWhere('b.leave_type_id = ?', $LType)
                        ->andWhere('YEAR(b.leave_app_start_date) = ?', $Year)
                        ->andWhere('MONTH(b.leave_app_start_date) = ?', $Month)
                        ->andWhere('b.leave_app_status NOT IN (0,3)');
                    return $q->fetchArray();
        }
        
        
        public function searchOFFOUT($searchMode, $searchValue, $culture='en', $orderField = 'b.oo_id', $orderBy = 'DESC', $page = 1) {

        switch ($searchMode) {
            case "emp_name":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name_" . $culture;
                break;
            case "oo_category":
                    $feildName = "b.oo_category";
                break;
//            case "oo_date ":
//                $feildName = "b.oo_date";
//                break;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*,d.*')
                        ->from('OfficeOutDetails d')
                        ->leftJoin('d.OfficeOut b ON b.oo_id = d.oo_id')
                        ->leftJoin('d.Employee e ON d.emp_number = e.emp_number');
                        if($_SESSION['empNumber']){
                            $q->where('d.emp_number = '.$_SESSION['empNumber']);
                        }

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
    
     public function readOONote($id) {
        return Doctrine::getTable('OfficeOut')->find($id);
    }
    
    
     public function readOONoteMax() {
                $query = Doctrine_Query::create()
                ->select('MAX(r.oo_id)')
                ->from('OfficeOut r');
                
                return $query->fetchArray();

    }
    public function deleteOONote($id) {
        $q = Doctrine_Query::create()
                        ->delete('OfficeOut')
                        ->where('oo_id 	=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    
    public function getSuperEmail($id){
/*        //$q = Doctrine_Query::create();
                $q = 'select c.con_off_email FROM hs_hr_emp_contact c WHERE c.emp_number = (SELECT r.erep_sup_emp_number FROM hs_hr_emp_reportto r WHERE r.erep_sub_emp_number = '.$id.')';
//                        ->select('c.con_off_email')
//                        ->from('EmpContact c')
//                       ->where('c.emp_number = ' .('select r.erep_sup_emp_number from hs_hr_emp_reportto r where r.erep_sub_emp_number = '.$id));
$conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($q);
        $stmt->execute();
        $resultArr[] = array();
        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $resultArr[] = $row;
        }
        return $resultArr;
*/        
       // return $resultArr[0][con_off_email];
        //return $q->execute();
        
// $q = Doctrine_Query::create();
//
//                        $q->select('con_off_email');
//                        $q->from('EmpContact');
//                       ->where('c.emp_number = ' .('select r.erep_sup_emp_number from hs_hr_emp_reportto r where r.erep_sub_emp_number = '.$id));       
        
        $subQuery = Doctrine_Query::create();
        $subQuery->select('r.*');
        $subQuery->from('ReportTo r');
        $subQuery->where('r.subordinateId = '.$id);   

        $subArr = $subQuery->fetchArray();

        if($subArr != array() ){
        $subArr2 = array();
        foreach ($subArr as $key => $val) {
            $subArr2[] = $val['supervisorId'];
        }
        $comma_separated = implode(",", $subArr2);
        if ($comma_separated) {
             $q = Doctrine_Query::create();

                        $q->select('con_off_email');
                        $q->from('EmpContact');
            $q->Where(" emp_number IN({$comma_separated})");
            return $q->fetchArray();
        }
        } 
        //die(print_r($q->getSqlQuery()));
        
    }
    
     public function getSupervisorData($id) {
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('ReportTo r')
                        ->where('r.subordinateId = ?', $id)
                        ->AndWhere('r.erep_reporting_mode = 1');

        //return $q->execute();
        return $q->fetchArray();
    }
    
    public function readEmployeeMaster($id) {
        return Doctrine::getTable('EmployeeMaster')->find($id);
    }
    
    public function getLastLeaveAppID() {
        $query = Doctrine_Query::create()
                        ->select('MAX(r.leave_app_id)')
                        ->from('LeaveApplication r');
        return $query->fetchArray();
    }
    
    public function readattach($id) {
       $query = Doctrine_Query::create()
                        ->select('count(t.leave_app_id)')
                        ->from('LeaveAttachment t')
                        ->where('t.leave_app_id = ?', $id);

        return $query->fetchArray();
    }
    
    public function getAttachdetails($id) {

        $query = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('LeaveAttachment t')
                        ->where('t.leave_app_id = ?', $id);

        return $query->fetchArray();
    }
    
    
        public function LeavetypeList() {

        $query = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('LeaveType t');

        return $query->execute();
    }
    
    public function deleteLeaveAttachment($id) {
        $q = Doctrine_Query::create()
                        ->delete('LeaveAttachment')
                        ->where('leave_app_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    
    
        public function UpdateEntitlementTakenPendingRemain($txtEmpId, $cmbbtype, $txtYear, $Taken, $Shedule, $Remain) {
        $q = Doctrine_Query::create()
                        ->update("LeaveEntitlement r");
                if($Taken >= "0"){
                        $q->set("r.leave_ent_taken","?",array($Taken));
                }       
                if($Shedule >= "0"){
                    $q->set("r.leave_ent_sheduled","?",array($Shedule));
                }
                if($Remain >= "0"){
                    $q->set("r.leave_ent_remain","?",array($Remain));
                }        
                        $q->where("r.emp_number = ".$txtEmpId);
                        $q->andwhere("r.leave_type_id = ". $cmbbtype);
                        $q->andWhere("r.leave_ent_year = ". $txtYear);
                        $q->getQuery();
                        $q->execute();
                 //die(print_r($q->getDql())) ;       
        $q->execute();
        return true;
    }

}

?>
