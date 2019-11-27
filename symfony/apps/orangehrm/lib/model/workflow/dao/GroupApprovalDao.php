<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Jayanath Liyanage
 *  On (Date)  - 27 July 2011
 *  Comments   - Workflow Module Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class GroupApprovalDao extends BaseDao {
    
    public function getApprovalGroups() {       
        $q = Doctrine_Query::create()
                ->from('WfApprovalGroup a');
        return $q->execute();
    }
    public function getEmployeeListbyId($id) {
        $q = Doctrine_Query::create()
                        ->from('WFGroupAppPerson p')
                         ->innerJoin('p.Employee e')
                        ->where('p.wfappgrp_code = ?', $id);
 
        return $q->execute();
    }
     public function UpdateGroupAssigne($employeeId,$groupId){
       
         $q = Doctrine_Query::create()
                ->update('WFGroupAppPerson app')
                ->set('app.wfappgrp_code', '?', $groupId)
                ->where('app.wf_main_app_employee = ?', $employeeId);

        return $q->execute();
    }
    public function deleteGroupById($id){
        $q = Doctrine_Query::create()
                ->delete('WFGroupAppPerson')
                ->where('wfappgrp_code=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
    public function deleteAssignedEmployee($empid,$groupCode){
        $q = Doctrine_Query::create()
                ->delete('WFGroupAppPerson')
                ->where('wfappgrp_code=' . $groupCode)
                ->andwhere('wf_main_app_employee=' . $empid);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

     public function getWfAppgrpObj($request,$wfappgrp){
         if (strlen($request->getParameter('txtAppGrp'))) {
                $wfappgrp->setWfappgrp_description(trim($request->getParameter('txtAppGrp')));
            } else {
                $wfappgrp->setWfappgrp_description(null);
            }
            if (strlen($request->getParameter('txtAppGrpSi'))) {
                $wfappgrp->setWfappgrp_description_si(trim($request->getParameter('txtAppGrpSi')));
            } else {
                $wfappgrp->setWfappgrp_description_si(null);
            }
            if (strlen($request->getParameter('txtAppGrpTa'))) {
                $wfappgrp->setWfappgrp_description_ta(trim($request->getParameter('txtAppGrpTa')));
            } else {
                $wfappgrp->setWfappgrp_description_ta(null);
            }

            return $wfappgrp;
    }
    
}