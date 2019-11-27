<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 Oct 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class deleteTrainingDao extends BaseDao {

     public function deleteInstitute($id) {

        $q = Doctrine_Query::create()
                        ->delete('TrainingInstitute')
                        ->where('td_inst_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

     public function deleteCourse($id) {

        $q = Doctrine_Query::create()
                        ->delete('TrainingCourse')
                        ->where('td_course_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    public function deleteSavedAssign($cId, $empID) {


        $q = Doctrine_Query::create()
                ->delete('TrainAssign a')
                ->where('a. emp_number = ?', $empID)
                ->andwhere('a.td_course_id = ?', $cId);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

      public function deleteWfMainAppPerson($wmid) {


        $q = Doctrine_Query::create()
                ->delete('WfMainAppPerson wma')
                ->where('wma.wfmain_id = ?', array($wmid));

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    public function deleteWfMain($wmid) {


        $q = Doctrine_Query::create()
                ->delete('WfMain wm')
                ->where('wm.wfmain_id = ?', array($wmid))
                ->andWhere('wm.	wfmain_iscomplete_flg = 0');

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    public function deleteTrainingPlan($id) {
        $q = Doctrine_Query::create()
                        ->delete('TrainingPlan')
                        ->where('td_plan_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }



}

?>