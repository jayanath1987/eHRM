<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class ParticipateAssignTrainDao extends BaseDao {

    public function getGeneralComment($cid) {

        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('TrainAssign t')
                ->where('t.td_course_id = ?', array($cid));

        return $q->execute();
    }

    public function loadCourseList($id) {
        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('TrainingCourse t')
                ->where('td_inst_id = ?', array($id));

        return $q->execute();
    }

    public function getAllCourseList($id) {
        $q = Doctrine_Query::create()
                ->from('TrainAssign a')
                ->innerJoin('a.Employee p')
                ->where('a.td_course_id = ?', $id);

        return $q->execute();
    }

    public function UpdateCommentAssign($id, $comment_en, $culture) {
        $q = Doctrine_Query::create()
                ->update('TrainingCourse a')
                ->set("a.td_course_gencom_en", "?", array($comment_en))
                ->where('a.td_course_id = ?', $id);

        return $q->execute();
    }

    public function checkAssignedcourse($cid, $empid) {
        $q = Doctrine_Query::create()
                ->from('TrainAssign a')
                ->where('a.td_course_id = ?', $cid)
                ->andWhere('a.emp_number = ?', $empid);

        return $q->fetchArray();
    }

    public function saveAssignList(TrainAssign $trainass) {

        $trainass->save();
        return true;
    }

    public function updateAssignList($empid, $courid, $isparti, $comment, $year, $generalComment) {
        $q = Doctrine_Query::create()
                ->update('TrainAssign a')
                ->set('a.td_asl_comment', '?', $comment)
                ->set('a.td_asl_year', '?', $year)
                ->set('a.td_asl_admincomment', '?', array($generalComment))
                ->where('a. emp_number = ?', $empid)
                ->andwhere('a.td_course_id = ?', $courid);
        return $q->execute();
    }

    public function updateAssignListParticipate($empid, $courid, $isparti, $comment, $year, $generalComment) {
        $q = Doctrine_Query::create()
                ->update('TrainAssign a')
                ->set('a.td_asl_isattend', '?', $isparti)
                ->set('a.td_asl_comment', '?', $comment)
                ->set('a.td_asl_year', '?', $year)
                ->set('a.td_asl_admincomment', '?', array($generalComment))
                ->where('a. emp_number = ?', $empid)
                ->andwhere('a.td_course_id = ?', $courid);
        return $q->execute();
    }

    public function getcheckCourse($id) {
        $q = Doctrine_Query::create()
                ->from('TrainAssign a')
                ->where('a.td_course_id = ?', $id);

        return $q->fetchArray();
    }

    public function GetListedEmpids($cid) {

        $q = Doctrine_Query::create()
                ->select('a.*')
                ->from('TrainAssign a')
                ->where('a.td_course_id = ?', $cid);


        return $q->fetchArray();
    }

    public function getDistinctTrainYear() {
        $q = Doctrine_Query::create()
                ->select('DISTINCT td_course_year as year')
                ->from('TrainingCourse');

        return $q->fetchArray();
    }

    public function getDivHeadorApprover($empid) {
        $q = Doctrine_Query::create()
                ->select('e.emp_number,c.parnt,c.def_level,d.*')
                ->from('Employee e')
                ->leftJoin('e.CompanyStructure c ON e.work_station=c.id')
                ->leftJoin('c.CompanyStructureDetails d ON c.parnt=d.id')
                ->where('e.emp_number = ?', $empid);

        return $q->fetchArray();
    }

    public function LoadEmployeeDetails($id) {

        return Doctrine::getTable('Employee')->find($id);

        
    }

    public function getEmployee($insList = array()) {

        if (is_array($insList)) {
            $q = Doctrine_Query::create()
                    ->from('Employee e')
                    ->whereIn('e.emp_number', $insList);

            return $q->fetchArray();
        }
    }


    public function getCompanyStructureDetailRole($empid, $Role) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('CompanyStructureDetails e')
                ->where('e.emp_number = ?', $empid)
                ->Andwhere('e.role_group_id = ?', $Role);

        return $q->fetchone();
    }

    public function readworkflowdeleteAssign($cId, $empID) {


        $q = Doctrine_Query::create()
                ->select('*')
                ->from('TrainAssign a')
                ->where('a.emp_number = ?', array($empID))
                ->andwhere('a.td_course_id = ?', array($cId));


        return $q->fetchArray();
    }

    public function readworkflowmain($wmid, $wmsq) {


        $q = Doctrine_Query::create()
                ->select('wm.*')
                ->from('WfMain wm')
                ->where('wm.wfmain_id = ?', array($wmid))
                ->andwhere('wm.wfmain_sequence = ?', array($wmsq));



        return $q->fetchArray();
    }

    public function readworkflowmainappperson($wmid) {


        $q = Doctrine_Query::create()
                ->select('wma.*')
                ->from('WfMainAppPerson wma')
                ->where('wma.wfmain_id = ?', array($wmid));

        return $q->fetchArray();
    }

}