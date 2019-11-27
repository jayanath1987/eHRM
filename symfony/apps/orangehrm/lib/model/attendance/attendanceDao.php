<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/common/LocaleUtil.php';

class attendanceDao extends BaseDao {

    public function readallleavedetails($date, $emp) {
        $q = Doctrine_Query::create()
                        ->select('l.*,d.*,t.*')
                        ->from('LeaveApplication l')
                        ->leftJoin('l.LeaveDetail d on l.leave_app_id = d.leave_app_id ')
                        ->leftJoin('l.LeaveType t ')
                        ->Where('d.leave_app_applied_date = ?', $date)
                        ->andWhere('l.emp_number = ?', $emp)
                        ->andWhere('l.leave_app_status = 2');
        return $q->fetchArray();
    }

    public function teest() {
        var_dum($this->getConnection()->getName());
    }

    public function getDayTypeload() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('AttendanceDateType b');
        return($q->execute());
    }

    public function saveAttDay(AttendanceDay $rte) {
        try {
            $rte->save();
            return true;
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function saveAttnconfiguration(AttendanceConfiguration $rte) {

        $rte->save();
        return true;
    }

    public function saveAttDaytype(AttendanceDateType $rte) {
        try {
            $rte->save();
            return true;
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function ReadAttDay($day) {
        $q = Doctrine_Query::create()
                        ->select('count(e.adt_day)')
                        ->from('AttendanceDay e')
                        ->where('e.adt_day = ?', $day);

        return $q->fetchArray();
    }

    public function updateAttDay($day, $dtid, $intime, $outtime) {
        if ($dtid == 'all') {
            $dtid = null;
        }
        $q = Doctrine_Query::create()
                        ->update('AttendanceDay a');
        if (strlen($dtid)) {
            $q->set('a.dt_id', '?', $dtid);
        }
        $q->set('a.adt_intime', '?', $intime)
                ->set('a.adt_outtime', '?', $outtime)
                ->where('a.adt_day = ?', $day);

        $q->execute();
        return true;
    }

    public function readattendanceDay() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('AttendanceDay b');
        return $q->execute();
    }

    public function readattendanceconfigure() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('AttendanceConfiguration b');
        return $q->execute();
    }

    public function readatnedit($empId, $empaid, $Cid) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('Attendance b')
                        ->where('b.emp_number = ?', $empId)
                        ->Andwhere('b.clk_no = ?', $empaid)
                        ->Andwhere('b.atn_date = ?', $Cid);

        return $q->fetchArray();
    }

    public function readADay() {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('AttendanceDay b');

        return $q->fetchArray();
    }

    public function filterdata() {
        $q = Doctrine_Query::create()
                        ->select('DISTINCT b.clk_date,b.clk_no')
                        ->from('AttendanceClockDetails b')
                        ->where('b.clk_status = ?', 0)
                        ->groupBy('b.clk_date,b.clk_no')
                        ->orderBy('b.clk_date,b.clk_time,b.clk_no');
        return $q->fetchArray();
    }

    public function getAttendanceminmaxdata($date, $cno) {
        $q = Doctrine_Query::create()
                        ->select('MIN(b.clk_time),MAX(b.clk_time)')
                        ->from('AttendanceClockDetails b')
                        //->where('b.clk_status = ?', 0)
                        ->where('b.clk_date = ?', $date)
                        ->Andwhere('b.clk_no = ?', $cno);


        return $q->fetchArray();
    }
    public function getAttendanceminafterval($date, $cno) {
        $q = Doctrine_Query::create()
                        ->select('b.clk_time')
                        ->from('AttendanceClockDetails b')
                        ->where('b.clk_date = ?', $date)
                        ->Andwhere('b.clk_no = ?', $cno)
                        ->orderBy('b.clk_date,b.clk_time,b.clk_no');
                        //->andWhereNotIn('b.clk_time','00:00:00');
                        


        return $q->fetchArray();
    }
    
    public function getminimumtimezeorcount($date, $cno){
                $q = Doctrine_Query::create()
                        ->select('count(b.clk_time)')
                        ->from('AttendanceClockDetails b')
                        //->where('b.clk_status = ?', 0)
                        ->where('b.clk_date = ?', $date)
                        ->Andwhere('b.clk_no = ?', $cno);
                        //->andWhere('b.clk_time = ?','00:00:00');


        return $q->fetchArray();
    }
    

    public function minmaxdata1($date, $cno) {
        $q = Doctrine_Query::create()
                        ->select('MAX(b.clk_time)')
                        ->from('AttendanceClockDetails b')
                        ->where('b.clk_status = ?', 0)
                        ->Andwhere('b.clk_date = ?', $date)
                        ->Andwhere('b.clk_no = ?', $cno);

        return $q->fetchArray();
    }

    public function getdaydata($date) {
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('AttendanceDay b')
                        ->where('b.adt_day = ?', $date);
        return $q->fetchArray();
    }

    public function saveAttandance(Attendance $rte) {
        try {
            $rte->save();
            return true;
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function reademp($id) {
        $q = Doctrine_Query::create()
                        ->select('e.emp_number')
                        ->from('Employee e')
                        ->where('e.emp_attendance_no = ?', $id)
                        ->AndWhere('e.emp_active_hrm_flg = 1')
                        ->AndWhere('e.emp_active_att_flg = 1');
        return $q->fetchArray();
    }

    public function readeveryemp() {
        $q = Doctrine_Query::create()
                        ->select('e.emp_attendance_no,e.emp_number')
                        ->from('Employee e')
                        ->where('e.emp_active_hrm_flg = ?', 1)
                        ->AndWhere('e.emp_active_att_flg = ?', 1);
        return $q->fetchArray();
    }

    public function readatnd($id) {
        $q = Doctrine_Query::create()
                        ->select('e.emp_attendance_no')
                        ->from('Employee e')
                        ->where('e.emp_number = ?', $id);
        return $q->fetchArray();
    }

    public function updateclk($id, $date, $val) {
        try {
            $q = Doctrine_Query::create()
                            ->update('AttendanceClockDetails b')
                            ->set('b.clk_status', '?', $val)
                            ->where('b.clk_no = ?', $id)
                            ->andwhere('b.clk_date = ?', $date);

            $q->execute();
            return true;
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function viewall($from, $to, $page=1, $eno, $type, $orderField = 'a.atn_date', $orderBy = 'ASC') {

        if ($type == 0) {
            $q = Doctrine_Query::create()
                            ->select('DISTINCT a.*')
                            ->from('Attendance a')
                            ->leftJoin('a.lEmployee l')
                            ->leftJoin('l.LeaveDetail d on l.leave_app_id=d.leave_app_id')
                            ->leftJoin('l.LeaveType t')
                            ->Where('a.atn_date >= ?', $from)
                            ->andWhere('a.atn_date <= ?', $to)
                            ->orderBy($orderField . ' ' . $orderBy);
        } else {
            $q = Doctrine_Query::create()
                            ->select('DISTINCT a.*')
                            ->from('Attendance a')
                            ->leftJoin('a.lEmployee l')
                            ->leftJoin('l.LeaveDetail d on l.leave_app_id=d.leave_app_id')
                            ->leftJoin('l.LeaveType t')
                            ->where('a.emp_number = ?', $eno)
                            ->andWhere('a.atn_date >= ?', $from)
                            ->andWhere('a.atn_date <= ?', $to)
                            ->orderBy($orderField . ' ' . $orderBy);
        }
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;
        //$resultsPerPage = 10;
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
                        "?page={%page_number}&searchValue={$from}&searchMode={$to}&emp={$eno}&type={$type}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function updatedata($empno, $empaid, $atndate, $intime, $outtime, $late, $early, $dtype) {
        try {
            $q = Doctrine_Query::create()
                            ->update('Attendance a')
                            ->set('a.atn_intime', '?', $intime)
                            ->set('a.atn_outtime', '?', $outtime)
                            ->set('a.atn_latetime', '?', $late)
                            ->set('a.atn_earlydeptime', '?', $early)
                            ->set('a.dt_id', '?', $dtype)
                            ->where('a.emp_number = ?', $empno)
                            ->andWhere('a.clk_no = ?', $empaid)
                            ->andWhere('a.atn_date = ?', $atndate);
            return $q->execute();
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function SaveInOutTime(AttendanceClockDetails $EmployeeInOutTime) {
        try {
            $EmployeeInOutTime->save();
            return true;
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function IsInOutTimeAvailable($cid, $date, $time) {
        $q = Doctrine_Query::create()
                        ->select('count(e.clk_no) as Status')
                        ->from('AttendanceClockDetails e')
                        ->where('e.clk_no = ?', $cid)
                        ->andwhere('e.clk_date = ?', $date)
                        ->andwhere('e.clk_time = ?', $time);

        return $q->fetchArray();
    }

    public function UpdateInOutTime($AttendanceNo, $AttendanceDate, $AttendanceTime) {
        try {
            $q = Doctrine_Query::create()
                            ->update('AttendanceClockDetails b')
                            ->set('b.clk_status', '?', 0)
                            ->where('b.clk_no = ?', $AttendanceNo)
                            ->andwhere('b.clk_date = ?', $AttendanceDate)
                            ->andwhere('b.clk_time = ?', $AttendanceTime);

            $q->execute();
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function insert($id, $date, $val) {
        try {
            $q = Doctrine_Query::create()
                            ->update('AttendanceClockDetails b')
                            ->set('b.clk_status', '?', $val)
                            ->where('b.clk_no = ?', $id)
                            ->Andwhere('b.clk_date = ?', $date);

            $q->execute();
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function read($empid, $atnno, $date) {
        try {
            $q = Doctrine_Query::create()
                            ->select('count(*)')
                            ->from('Attendance b')
                            ->where('b.clk_no = ?', $atnno)
                            ->AndWhere('b.emp_number = ?', $empid)
                            ->AndWhere('b.atn_date = ?', $date);

            return $q->fetchArray();
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function read2($atnno, $date) {
        try {
            $q = Doctrine_Query::create()
                            ->select('count(*)')
                            ->from('AttendanceClockDetails b')
                            ->where('b.clk_no = ?', $atnno)
                            ->AndWhere('b.clk_date = ?', $date)
                            ->AndWhere('b.clk_time = ?', '00:00:00');
            return $q->fetchArray();
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function readatdcdown() {
        return Doctrine::getTable('AttendanceClockDetails');
    }

    public function readatddat() {
        return Doctrine::getTable('AttendanceDateType');
    }

    public function readatclockddatup($id, $date, $time) {
        return Doctrine::getTable('AttendanceClockDetails')->find(array($id, $date, $time));
    }

    public function readatddatup($id) {
        return Doctrine::getTable('AttendanceDateType')->find($id);
    }

    public function deletedt($id) {
        $q = Doctrine_Query::create()
                        ->delete('AttendanceDateType')
                        ->where('dt_id =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deletecd($id) {
        $q = Doctrine_Query::create()
                        ->delete('AttendanceClockDetails')
                        ->where('clk_no =' . $id);


        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function ReadAttDayd($day, $did) {
        $q = Doctrine_Query::create()
                        ->select('e.*')
                        ->from('AttendanceDay e')
                        ->where('e.adt_day = ' . $day)
                        ->Andwhere('e.dt_id = ' . $did);
        return $q->execute();
    }

    public function readdd() {
        return Doctrine::getTable('AttendanceDay');
    }

    public function deletedtt($date) {
        $q = Doctrine_Query::create()
                        ->delete('AttendanceDay a')
                        ->where('a.adt_day = ?', $date);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function readattend() {
        return Doctrine::getTable('Attendance');
    }

    public function readaattnup($id, $date, $time) {
        return Doctrine::getTable('Attendance')->find(array($id, $date, $time));
    }

    public function readaattnup2($id, $date, $emp) {
        return Doctrine::getTable('Attendance')->find(array($id, $emp, $date));
    }

    public function Rreadaattnup($id, $date, $emp) {
        $q = Doctrine_Query::create()
                        ->select('COUNT(e.clk_no)')
                        ->from('Attendance e')
                        ->where('e.clk_no = ?', $id)
                        ->Andwhere('e.atn_date = ?', $date)
                        ->Andwhere('e.emp_number = ?', $emp);
        return $q->fetchArray();
    }

    public function IsEmployeeAttendanceActive($id) {
        $q = Doctrine_Query::create()
                        ->select('COUNT(e.emp_number) as Active')
                        ->from('Employee e')
                        ->where('e.emp_attendance_no = ?', $id)
                        ->AndWhere('e.emp_active_hrm_flg = 1')
                        ->AndWhere('e.emp_active_att_flg = 1');
        return $q->fetchArray();
    }

    public function deleteatttnd($id) {
        $q = Doctrine_Query::create()
                        ->delete('Attendance')
                        ->where('clk_no =' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

      public function LoadEmpData($id) {
        $q = Doctrine_Query::create()
                        ->select('e.*')
                        ->from('EmployeeMaster e')
                        ->where('e.emp_number = ?', $id);

        return $q->execute();
    }


}

?>
