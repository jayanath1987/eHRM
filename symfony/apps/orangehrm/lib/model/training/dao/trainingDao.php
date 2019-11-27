<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class TrainingDao extends BaseDao {


    public function LoadFilterCourse($eid, $iid) {

        $q = Doctrine_Query::create()
                        ->select('DISTINCT t.td_course_id')
                        ->from('TrainAssign t')
                        ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                        ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                        ->where('t.emp_number = ?', $eid)
                        ->andwhere('c.td_inst_id =?', $iid);


        return $q->fetchArray();
    }




    public function updateAprovelHRAdmin($empid, $cid, $val, $CurStatus, $ApprSub, $ApprHead, $isapproved) {

        switch ($searchMode) {

            case "ename":
                if ($culture == "en")
                    $feildName = "e.emp_display_name";
                else
                    $feildName="e.emp_display_name_" . $culture;
                break;
            case "institute":
                if ($culture == "en")
                    $feildName = "i.td_inst_name_en";
                else
                    $feildName="i.td_inst_name_" . $culture;
                break;
            case "course":
                if ($culture == "en")
                    $feildName = "c.td_course_name_en";
                else
                    $feildName="c.td_course_name_" . $culture;
                break;
            case "year":

                $feildName = "t.td_asl_year";

                break;
        }
        $q = Doctrine_Query::create()
                        ->update('TrainAssign a')
                        ->set('a.td_asl_ispending', '?', 1)
                        ->set('a.td_asl_status', '?', array($CurStatus))
                        ->set('a.td_asl_isapproved', '?', array($isapproved))
                        ->set('a.td_asl_appr_emp_number', '?', array($ApprHead))
                        ->set('a.td_asl_appr_sub_emp_number', '?', array($ApprSub))
                        ->where('a.emp_number = ?', $empid)
                        ->andWhere('a.td_course_id = ?', $cid);

        return $q->execute();
    }
   

}