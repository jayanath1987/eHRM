<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Disciplinary Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DisciplinaryDao extends BaseDao {


    public function saveIncidentDetails(IncidentDetails $insdetails) {


        $insdetails->save();

        return true;
    }


    public function readIncident($id) {

        return Doctrine::getTable('Incidents')->find($id);
    }


    public function getIncidentSummery($id) {

        $query = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('Incidents r')
                        ->leftJoin('r.IncidentDetails i ON i.dis_inc_id = r.dis_inc_id')
                        ->leftJoin('r.OffenceList l ON r.dis_inc_id = l.dis_inc_id')
                        ->leftJoin('l.Offence o ON l.dis_offence_id = o.dis_offence_id')
                        ->innerJoin('r.Employee e ON e.emp_number = r.emp_number')
                        ->where('r.dis_inc_id=' . $id);

        return $query ->execute();
    }

    public function readAttachment($id) {

        $query = Doctrine_Query::create()
                        ->from('DisAttachment d')
                        ->where('d.dis_inc_id = ?', $id);
        return $query ->execute();
    }


    public function getActiontakenby($id, $level) {
        $query = Doctrine_Query::create()
                        ->from('IncidentDetails i')
                        ->where('i.dis_inc_id =' . $id)
                        ->andWhere('dis_indetail_level =' . $level);
        return $query ->fetchArray();
    }


    public function updateLevel($id) {
        $query  = Doctrine_Query::create()
                        ->update('Incidents i')
                        ->set('i.dis_inc_level', '?', 2)
                        ->where('i.dis_inc_id =' . $id);
        return $query ->execute();
    }


    public function deleteIncidentdetails($incId) {

        $query  = Doctrine_Query::create()
                        ->delete('IncidentDetails i')
                        ->where('i.dis_inc_id = ?', $incId);
        $numDeleted = $query ->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteAttachment($incId) {

        $query  = Doctrine_Query::create()
                        ->delete('DisAttachment i')
                        ->where('i.dis_inc_id = ?', $incId);

        $numDeleted = $query ->execute();

        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteIncidents($incId) {

        $query = Doctrine_Query::create()
                        ->delete('Incidents i')
                        ->where('i.dis_inc_id = ?', $incId);

        $numDeleted = $query ->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }


    public function getLastoffecnce() {

        $query = Doctrine_Query::create()
                        ->select('MAX(dis_offence_id)')
                        ->from('Offence o');
        return $query->fetchArray();
    }


    public function UpdateIncidentdetails($maxIncid="", $txthiidenlevel="", $txtactiontby="", $txtactdate="null", $txtcomment="") {


        $query = Doctrine_Query::create()
                        ->update('IncidentDetails i');

        $query->set('i.dis_indetail_takenby', '?', $txtactiontby);
        if (strlen($txtactdate)) {
            $query->set('i.dis_indetail_takendate', '?', $txtactdate);
        } else {
            $query->set('i.dis_indetail_takendate', 'NULL');
        }

        $query->set('i.dis_indetail_comment', '?', $txtcomment)
                ->where('i. dis_inc_id = ?', $maxIncid)
                ->andwhere('i.dis_indetail_level = ?', $txthiidenlevel);
        return $query->execute();
    }


    public function deleteInvolveEmployee($incId) {

       $query = Doctrine_Query::create()
                        ->delete('DisEmployeeInvolved i')
                        ->where('i.dis_inc_id = ?', $incId);
        $numDeleted = $query->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteInvoledEmp($incId) {

        $query = Doctrine_Query::create()
                        ->delete('DisEmployeeInvolved i')
                        ->where('i.dis_inc_id = ?', $incId);
        $numDeleted = $query->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function NumOffenceList($id, $offence) {
        $query = Doctrine_Query::create()
                        ->select('i.*')
                        ->from('OffenceList i')
                        ->where('i.dis_inc_id =' . $id)
                        ->andwhere('i.dis_offence_id =' . $offence);

        return $query->fetchArray();
    }

    public function checkAttachment($id) {

        $query= Doctrine_Query::create()
                        ->select('COUNT(a.dis_inc_id)')
                        ->from('DisAttachment a')
                        ->where('a.dis_inc_id =' . $id);


        return $query->fetchArray();
    }


    public function checkDetails($id, $level) {
        $query = Doctrine_Query::create()
                        ->select('COUNT(i.dis_inc_id)')
                        ->from('IncidentDetails i')
                        ->where('i.dis_inc_id =' . $id)
                        ->andwhere('i.dis_indetail_level =' . $level);
        return $query->fetchArray();
    }

    public function getAttachment($id) {

        $query = Doctrine_Query::create()
                        ->select('d.*')
                        ->from('DisAttachment d')
                        ->where('d.dis_attach_id = ?', $id);

        return $query->fetchArray();
    }

    public function deleteImage($id, $type) {

        $query = Doctrine_Query::create()
                        ->delete('DisAttachment d')
                        ->where('d.dis_inc_id = ?', array($id))
                        ->andwhere('d.dis_attach_category = ?', array($type));

        $numDeleted = $query->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getEmployee($insList = array()) {


            if (is_array($insList)) {
                $query = Doctrine_Query::create()
                                ->select('e.*')
                                ->from('Employee e')
                                ->whereIn('e.emp_number', $insList);


                return $query->execute();
            }

    }

    public function GetListedEmpids($id) {

        $query= Doctrine_Query::create()
                        ->select('d.*')
                        ->from('DisEmployeeInvolved d')
                        ->where('d.dis_inc_id = ?', array($id));


        return $query->fetchArray();
    }


    public function saveInvolEmps($obj) {

        $obj->save();
    }


    public function readempdis($id, $eno) {

        $query= Doctrine_Query::create()
                        ->select('d.*')
                        ->from('DisEmployeeInvolved d')
                        ->where('d.dis_inc_id= ?', $id)
                        ->andwhere('d.emp_number= ?', $eno);

        return $query->fetchArray();
    }


}

?>
