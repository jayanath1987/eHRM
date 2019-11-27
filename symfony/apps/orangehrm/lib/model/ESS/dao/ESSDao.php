<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Jayanath Liyanage
 *  On (Date)  - 27 July 2011
 *  Comments   - ESS Module Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class ESSDao extends BaseDao {

    public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
        //return $q->fetchArray();
    }

    public function LoadsubordinateData($id) {
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('ReportTo r')
                        ->where('r.erep_sup_emp_number = ?', $id);

        return $q->fetchArray();
        // return $q->execute();
    }

    public function getemployeePendingLeave($emp) {

        $q = Doctrine_Query::create()
                        ->select('count(l.leave_type_id) ')
                        ->from('LeaveApplication l')
                        ->where('l.emp_number = ?', $emp)
                        ->andwhere('l.leave_app_status = ?', 1);
        return $q->fetchArray();
    }

    public function getemployeePendingTransfer($emp) {

        $q = Doctrine_Query::create()
                        ->select('count(t.trans_req_id) ')
                        ->from('TransferRequest t')
                        ->where('t.emp_number = ?', $emp);
                        //->andwhere('t.trans_req_adminiscomment = ?', 0);
        return $q->fetchArray();
    }

    public function getemployeePendingDisciplinary($emp) {

        $q = Doctrine_Query::create()
                        ->select('count(d.emp_number) ')
                        ->from('Incidents i')
                        ->leftJoin('i.DisEmployeeInvolved d')
                        ->where('i.dis_inc_isclosed = ?', 0)
                        ->andwhere('d.emp_number = ?', $emp);

        return $q->fetchArray();
    }

    public function getemployeePendingTraining($emp) {

        $q = Doctrine_Query::create()
                        ->select('count(td.td_course_id) ')
                        ->from('TrainAssign td')
                        ->where('td.emp_number = ?', $emp)
                        ->andwhere('td.td_asl_ispending = ?', 0);
        return $q->fetchArray();
    }

    public function getemployeePendingPromotion($emp) {

        $q = Doctrine_Query::create()
                        ->select('count(p.prm_id) ')
                        ->from('Promotion p')
                        ->where('p.emp_number = ?', $emp);
        //->andwhere('p.leave_app_status = ?', 1 );
        return $q->fetchArray();
    }

}

?>
