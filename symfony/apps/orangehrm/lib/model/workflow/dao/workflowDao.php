<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Jayanath Liyanage
 *  On (Date)  - 27 July 2011
 *  Comments   - Workflow Module Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class workflowDao extends BaseDao {

    public function searchApprovalGroups($searchMode="", $searchValue="", $culture="", $page=1, $orderField='ag.wfappgrp_code', $orderBy='ASC', $closed="", $level="") {

        switch ($searchMode) {
            case "Name":
                if ($culture == "en") {
                    $feildName = "ag.wfappgrp_description";
                } else {
                    $feildName = "ag.wfappgrp_description_" . $culture;
                }
                break;
        }

        $q = Doctrine_Query::create()
                ->select('ag.*')
                ->from('WfApprovalGroup ag');
        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


        $resultsPerPage = sfConfig::get('app_items_per_page') ? sfConfig::get('app_items_per_page') : 10;


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

    public function readTestView() {

        $query = 'select * from vw_hs_hr_wf_testbase';

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            $results[] = $row;
        }
        die(print_r($results));
    }

    public function readAppGroup($id) {
        try {
            return Doctrine::getTable('WfApprovalGroup')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function deleteGrpApp($id) {

        $q = Doctrine_Query::create()
                ->delete('WfApprovalGroup')
                ->where('wfappgrp_code=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function startWorkFlow($WfType_Id, $applyEmp) {

        $sysConf = new sysConf();
        $wftype_id = $WfType_Id;
        $applicationEmp = $applyEmp;
        $statusId = 0;
        $workFlowSequence = 0;
        $approveEmpNumber;
        $approveDate = date($sysConf->dateFormat);
        $maxWorkflowMainID = 0;

        //Check Is group approval

        $maxWorkflowMainID = $this->getMaxwfId();
        $maxWorkflowMainID = $maxWorkflowMainID[0][MAX];

        $maxWorkflowMainID=$maxWorkflowMainID+1;
         

        $isComplete = false;

        while (!$isComplete) {

            $isGroupApproval = $this->isGroupApp($WfType_Id, $statusId + 1);

            if ($isGroupApproval == 1) {

                $appPersons = $this->getApprovingPersonStatus($wftype_id, $statusId + 1, $applicationEmp, $wfid = "");
                //$dtGroups = $this->getGroupAppPersonStatus($wftype_id, $statusId + 1, $applicationEmp, $wfid = "");

                if ($appPersons == " ") {
                    $toRtnArr[] = "-1";
                    return $toRtnArr;
                } elseif ($appPersons == "-1") {
                    $toRtnArr[] = "-1";
                    return $toRtnArr;
                } elseif ($appPersons == "") {
                    $statusId = $statusId + 1;
                } elseif ($this->getAppPersonStatus($applicationEmp, $appPersons, $isGroupApproval) == -1) {
                    $statusId = $statusId + 1;
                    //die("4");
                } else {
                    //die("7");
                    $statusId = $statusId + 1;
                    $workFlowSequence = $workFlowSequence + 1;
                    $dInsertGroup = 1;
                    $approveEmpNumber = $appPersons;
                    $isComplete = true;
                }
            } else {

                $appPersons = $this->getApprovingPersonStatus($wftype_id, $statusId + 1, $applicationEmp, $wfid = "");
                //$dtGroups = $this->getGroupAppPersonStatus($wftype_id, $statusId + 1, $applicationEmp, $wfid = "");

                if ($appPersons == " ") {

                    $toRtnArr[] = "-1";

                    return $toRtnArr;
                } elseif ($appPersons == "-1") {

                    $toRtnArr[] = "-1";
                    return $toRtnArr;
                } elseif ($appPersons == "") {

                    $statusId = $statusId + 1;
                } elseif ($appPersons[0][EMP_NUMBER] == $applicationEmp) {
                    $statusId = $statusId + 1;
                } else {

                    $workFlowSequence = $workFlowSequence + 1;
                    $statusId = $statusId + 1;
                    $approveEmpNumber = $appPersons[0][EMP_NUMBER];
                    $isComplete = true;
                }
            }
        }

        if ($dInsertGroup == 1) {

            foreach ($approveEmpNumber as $appEmpNum) {
                $grpEmpNumbers[] = $appEmpNum['EMP_NUMBER'];
            }
           
            $insertWf = $this->insertWorkflowMain($maxWorkflowMainID, null, $workFlowSequence, $wftype_id, $approveDate, $statusId,$comment);
            $isSavedMainAppPerson = $this->insertMainAppPerson($maxWorkflowMainID, $workFlowSequence, $grpEmpNumbers);

            $toRtnArr[] = $maxWorkflowMainID;
            $toRtnArr[] = $wfFlowid;
            return $toRtnArr;
        } else {
            
            $insertWf = $this->insertWorkflowMain($maxWorkflowMainID , $approveEmpNumber, $workFlowSequence, $wftype_id, $approveDate, $statusId,$comment);

            $toRtnArr[] = $maxWorkflowMainID;
            $toRtnArr[] = $wfFlowid;
            return $toRtnArr;
        }
    }

    public function getStatus($grpEmpNumbers) {

        print_r($grpEmpNumbers);
        die;
    }

    public function getApprovingPersonStatus($wftype_id, $workFlowSequence, $applicationEmp, $wfid) {

        $isPersonSet = $this->isPersonSet($wftype_id, $workFlowSequence);
        
        
        if (count($isPersonSet) > 0) {
         
            $personDs = $this->getAppEmpObj($isPersonSet[0][wfapper_sqlquery], $applicationEmp, $wfid);

            if (count($personDs) > 0) {
                return $personDs;
            } else {
                if ($isPersonSet[0][wfapper_iscompulsory_flg] == 1) {
                    return "-1";
                } else {
                    return "";
                }
            }
        } else {
            return " ";
        }
    }

    public function getGroupAppPersonStatus($wftype_id, $workFlowSequence, $applicationEmp, $wfid) {

        $isPersonSet = $this->isPersonSet($wftype_id, $workFlowSequence);
        //print_r($isPersonSet[0]->WfApproval->wftype_code);die;
        if (count($isPersonSet) > 0) {
            return $isPersonSet[0][wfapper_lastlevel];
        }
    }

    public function approveApplication($wfID, $comment) {

        $wfDetails = $this->getWorkFlowDetails($wfID);
        //print_r($wfDetails);die;
        $wfUpdatedFeild = $wfDetails[0][wftype_update_field];
        $wfTypeCode = $wfDetails[0][wftype_code];
        $WfType_Id = $wfDetails[0][wftype_code];
        $wfCustomeTabel = $wfDetails[0][wftype_table_name];
        $wfMainId = $wfDetails[0][wfmain_id];

        $sysConf = new sysConf();

        $wftype_id = $wfTypeCode;

        $applicationEmp = $wfDetails[1];

        $statusId = $wfDetails[0][wfmain_flow_id];

        $workFlowSequence = $wfDetails[0][wfmain_sequence];

        $currentSequence = $wfDetails[0][wfmain_sequence];

        $approveDate = date($sysConf->dateFormat);

        $maxWorkflowMainID = $this->getMaxwfId();

        $maxWorkflowMainID = $maxWorkflowMainID[0][MAX];

        $isComplete = false;
        $isGroupApproval;
        while (!$isComplete) {
            $isGroupApproval = $this->isGroupApp($WfType_Id, $statusId);

            $appPersons = $this->getApprovingPersonStatus($wftype_id, $statusId + 1, $applicationEmp, $wfid = "");

            if ($appPersons == " ") {

                $workFlowSequence = $workFlowSequence + 1;
                $isComplete = true;
                $statusId = $statusId + 1;
                $dInsertGroup = 1;
            } elseif ($appPersons == "-1") {

                return "-1";
            } elseif ($appPersons == "") {

                $statusId = $statusId + 1;
            } elseif ($this->getAppPersonStatus($applicationEmp, $appPersons, $isGroupApproval) == -1) {
                $statusId = $statusId + 1;
                
            } else {
                
                $dInsertGroup = 1;
                $workFlowSequence = $workFlowSequence + 1;
                $statusId = $statusId + 1;
                $approveEmpNumber = $appPersons;
                $isComplete = true;
            }
        }

        $isLastLevel = $this->getGroupAppPersonStatus($WfType_Id, $currentSequence, $applicationEmp, $wfid = "");
        $dtGroupSup = $this->getNextGroupSup($WfType_Id, $workFlowSequence, $applicationEmp, $wfid = "");
        
        if ($isLastLevel != 1) {
            if ($dtGroupSup == 1) {

                foreach ($approveEmpNumber as $appEmpNum) {
                    $grpEmpNumbers[] = $appEmpNum['EMP_NUMBER'];
                }
                
                $isSavedMainAppPerson = $this->insertMainAppPerson($wfID, $statusId, $grpEmpNumbers);
               
                $insertWf = $this->insertWorkflowMain($wfID, null, $workFlowSequence, $wftype_id, $approveDate, $statusId, $comment);
                 
            } else {
                
                $insertWf = $this->insertWorkflowMain($wfID, $approveEmpNumber[0][EMP_NUMBER], $workFlowSequence, $wftype_id, $approveDate, $statusId, $comment);
            }
        }

        if ($isGroupApproval == 1) {

            if ($isLastLevel == 1) {
                $this->upDateModule($wfMainId, $wfCustomeTabel, $wfUpdatedFeild, 1);
            }

            $this->upDateWorkFlowGroup($wfMainId, $currentSequence, $approveDate,$comment);

            $this->DeleteGroupAppPerson($wfMainId, $currentSequence);

            return "1";
        } else {
            if ($isLastLevel == 1) {
                $this->upDateModule($wfMainId, $wfCustomeTabel, $wfUpdatedFeild, 1);
            }
            $this->upDateWorkFlow($wfMainId, $currentSequence, $approveDate,$comment);

            return "1";
        }
    }

    public function getAppPersonStatus($applicationEmp, $appPersons, $isGroupApproval) {
        if ($isGroupApproval) {

            foreach ($appPersons as $apps) {
                if ($apps[EMP_NUMBER] == $applicationEmp) {
                    return -1;
                }
            }
        } else {
            if ($appPersons[0][EMP_NUMBER] == $applicationEmp) {
                return -1;
            }
        }
    }

    public function directApprovalReject($wfID,$Comment) {

        $wfDetails = $this->getWorkFlowDetails($wfID);
        $wfUpdatedFeild = $wfDetails[0][wftype_update_field];
       
        $WfType_Id = $wfDetails[0][wftype_code];
        $wfCustomeTabel = $wfDetails[0][wftype_table_name];
        $wfMainId = $wfDetails[0][wfmain_id];

        $sysConf = new sysConf();

        

        

        $statusId = $wfDetails[0][wfmain_flow_id];

        $workFlowSequence = $wfDetails[0][wfmain_sequence];

        $currentSequence = $wfDetails[0][wfmain_sequence];

        $approveDate = date($sysConf->dateFormat);

        


        $isGroupApproval = $this->isGroupApp($WfType_Id, $statusId);
        if ($isGroupApproval == 1) {
           
            $this->upDateModule($wfMainId, $wfCustomeTabel, $wfUpdatedFeild, -1);
            $this->upDateWorkFlowReject($wfMainId, $currentSequence, $approveDate,$Comment);

            $this->DeleteGroupAppPerson($wfMainId, $currentSequence);

            return "1";
        } else {

            $this->upDateModule($wfMainId, $wfCustomeTabel, $wfUpdatedFeild, -1);
            $this->upDateWorkFlowReject($wfMainId, $workFlowSequence, $approveDate,$Comment);

            return "1";
        }
        
        
    }

    public function getNextGroupSup($wftype_id, $workFlowSequence, $applicationEmp, $wfid) {

        $isPersonSet = $this->isPersonSet($wftype_id, $workFlowSequence);
        
        if ($isPersonSet[0][wfapper_is_group_flg]==1) {

                return 1;                
        } else {
            return "-1";
        }
    }

    public function pevSup($flowID, $wfMainID) {

        $ds = $this->approvedPerson($flowID, $wfMainID);
        if ($ds > 0) {
            return "1";
        } else {
            return "0";
        }
    }

    public function upDateWorkFlowReject($wfMainId, $workFlowSequence, $approveDate,$Comment) {

        $sql = "Update hs_hr_wf_main set wfmain_app_date={$approveDate},wfmain_comments='$Comment',wfmain_iscomplete_flg=-1 where wfmain_id= {$wfMainId}  and wfmain_sequence={$workFlowSequence}";
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
        
    }

    public function approvedPerson($flowID, $wfMainID) {
        $sql = "select wfmain_approving_emp_number,wfmain_flow_id,wftype_code from vw_hs_hr_wf_main_data where  wfmain_id={$wfMainID} and wfmain_flow_id={$flowID}";
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results[0][wfmain_approving_emp_number];
    }

    public function DeleteGroupAppPerson($wfMainId, $workFlowSequence) {
        $sql = "delete from hs_hr_wf_main_app_person   where wfmain_id= {$wfMainId}  and wfmain_sequence={$workFlowSequence}";
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function upDateWorkFlow($wfMainId, $workFlowSequence, $approveDate,$comment) {

        $sql = "Update hs_hr_wf_main set wfmain_app_date='$approveDate' , wfmain_comments='$comment', wfmain_iscomplete_flg=1 where wfmain_id= {$wfMainId}  and wfmain_sequence={$workFlowSequence} ";
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }
    public function upDateWorkFlowGroup($wfMainId, $workFlowSequence, $approveDate,$comment) {
        $approveEmp=$_SESSION['empNumber'];
        $sql = "Update hs_hr_wf_main set wfmain_approving_emp_number={$approveEmp}, wfmain_app_date='$approveDate' , wfmain_comments='$comment', wfmain_iscomplete_flg=1 where wfmain_id= {$wfMainId}  and wfmain_sequence={$workFlowSequence} ";
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function upDateModule($wfMainId, $wfCustomeTabel, $wfUpdatedFeild, $appValue) {
        
        $sql = "Update {$wfCustomeTabel} set {$wfUpdatedFeild}={$appValue} where wfmain_id= {$wfMainId}";
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function getWorkFlowDetails($wfID) {

        $sql = "select * from vw_hs_hr_wf_main_data where wfmain_id=$wfID and wfmain_approving_emp_number={$_SESSION['empNumber']}";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {
            $results[] = $row;
        }

        $sql2 = "select * from {$results[0][wfmod_view_name]} where ID={$wfID}";
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql2);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {
            $results1[] = $row;
        }
        //die(print_r($results1));
        $results[] = $results1[0]["Employee Number"];
        
        return $results;
    }

    public function insertMainAppPerson($maxWorkflowMainID, $workFlowSequence, $grpEmpNumbers) {


        foreach ($grpEmpNumbers as $grpEmpnums) {
            $wfMainApp = new WfMainAppPerson();
            if (strlen($maxWorkflowMainID)) {
                $wfMainApp->setWfmain_id($maxWorkflowMainID);
            } else {
                $wfMainApp->setWfmain_id(null);
            }
            if (strlen($workFlowSequence)) {
                $wfMainApp->setWfmain_sequence($workFlowSequence);
            } else {
                $wfMainApp->setWfmain_sequence(null);
            }
            if (strlen($grpEmpnums)) {
                $wfMainApp->setWf_main_app_employee($grpEmpnums);
            } else {
                $wfMainApp->setWf_main_app_employee(null);
            }
            $wfMainApp->save();
        }
    }

    private function insertWorkflowMain($maxWorkflowMainID, $approveEmpNumber, $workFlowSequence, $wftype_id, $approveDate, $wfFlowID, $comment) {
        
        $wfMain = new WfMain();

        if (strlen($maxWorkflowMainID)) {
            $wfMain->setWfmain_id(trim($maxWorkflowMainID));
        } else {
            $wfMain->setWfmain_id(null);
        }
        if (strlen($approveEmpNumber)) {
            $wfMain->setWfmain_approving_emp_number(trim($approveEmpNumber));
        } else {
            $wfMain->setWfmain_approving_emp_number(null);
        }
        if (strlen($workFlowSequence)) {
            $wfMain->setWfmain_sequence(trim($workFlowSequence));
        } else {
            $wfMain->setWfmain_sequence(null);
        }
        if (strlen($wftype_id)) {
            $wfMain->setWftype_code(trim($wftype_id));
        } else {
            $wfMain->setWftype_code(null);
        }
        if (strlen($approveDate)) {
            $wfMain->setWfmain_current_date(trim($approveDate));
        } else {
            $wfMain->setWfmain_current_date(null);
        }
        if (strlen($approveDate)) {
            $wfMain->setWfmain_application_date(trim($approveDate));
        } else {
            $wfMain->setWfmain_application_date(null);
        }
        if (strlen($wfFlowID)) {
            $wfMain->setWfmain_flow_id(trim($wfFlowID));
        } else {
            $wfMain->setWfmain_flow_id(null);
        }
        if (strlen($comment)) {
            $wfMain->setWfmain_comments(trim($comment));
        } 

        $wfMain->setWfmain_iscomplete_flg("0");



        return $wfMain->save();
    }

    private function getMaxwfId() {
        $q = Doctrine_Query::create()
                ->select('MAX(wfmain_id)')
                ->from('WfMain');
        return $q->fetchArray();
    }

    private function isGroupApp($WfType_Id, $wfsequence) {

        $q = Doctrine_Query::create()
                ->select('pe.wfapper_sqlquery, ap.wfapper_iscompulsory_flg, pe.wfapper_is_group_flg')
                ->from('WfAppPerson pe ')
                ->leftJoin('pe.WfApproval ap ON ap.wfapper_code = pe.wfapper_code')
                ->andwhere('ap.wftype_code = ?', array($WfType_Id))
                ->andwhere('ap.wfa_sequence = ?', array($wfsequence));

        $resObject = $q->execute();
        if ($resObject[0]->wfapper_is_group_flg == 1) {
            return true;
        } else {
            return false;
        }
    }

    private function isPersonSet($WfType_Id, $wfsequence) {


        $sql = "select pe.wfapper_sqlquery, ap.wfapper_iscompulsory_flg, pe.wfapper_is_group_flg,ap.wfapper_lastlevel
              from  hs_hr_wf_approvel ap,hs_hr_wf_approval_person pe 
              where ap.wfapper_code=pe.wfapper_code
              and wftype_code={$WfType_Id}
              and wfa_sequence={$wfsequence}";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }

    private function getAppEmpObj($ssql, $empNumber, $wfid) {

        
        //replace the @Emp_Number with employeeId
        $toReplaceEmpNumber = array("@Emp_Number");
        $sqlWithEmpNumber = str_replace($toReplaceEmpNumber, $empNumber, $ssql);
        if (strlen($wfid)) {
            $toRepalceWf_id = array("@wf_id");
            $sqlWithEmpNumber = str_replace($toRepalceWf_id, $wfid, $sqlWithEmpNumber);
        }
        $query = $sqlWithEmpNumber;
        
        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            $results[] = $row;
        }

        
        return $results;
    }

    public function getAppEmpObjForGroup($ssql, $empNumber, $wfid) {

        //replace the @Emp_Number with employeeId
        $toReplaceEmpNumber = array("@Emp_Number");
        $sqlWithEmpNumber = str_replace($toReplaceEmpNumber, "''", $ssql);
        if (strlen($wfid)) {
            $toRepalceWf_id = array("@wf_id");
            $sqlWithEmpNumber = str_replace($toRepalceWf_id, $wfid, $sqlWithEmpNumber);
        }
        $query = $sqlWithEmpNumber;

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            $results[] = $row;
        }


        return $results;
    }

    public function applicationSummary($empNumber) {



        //replace the @Emp_Number with 

        $query = "select wfmod_id,wfmod_name,wfmod_name_si,wfmod_name_ta,COUNT(wfmod_name),wfmod_view_name,wfmain_sequence,wfmod_name_si,wfmod_name_ta
                 from vw_hs_hr_wf_main_data where wfmain_approving_emp_number=$empNumber GROUP BY wfmod_name";



        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $results[] = $row;
        }


        return $results;
    }

    public function getApprovalListbyModuleView($viewName, $approvingEmpName) {

        $sql = "select * from " . $viewName . " where Approving_Employee=$approvingEmpName";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $results[] = $row;
        }
        return $results;
        //print_r($results);die;
    }

    public function getWorkflowDetailViewDetails($WfmainID, $approvingEmpName) {
        //$WfmainID = 1;
        //$approvingEmpName = 9;
        $sql = "select * from vw_hs_hr_wf_main_data where wfmain_id=$WfmainID and wfmain_approving_emp_number=$approvingEmpName";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {
            $results = $row[wftype_view_name];
            $wfID = $row[wfmain_id];
        }
        if (strlen($results)) {
            $resultArr = array();
            $sql = "select * from " . $results . " where ID={$wfID}";

            $conn = Doctrine_Manager::getInstance()->connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

                $resultArr[] = $row;
            }
        }
        return $resultArr;
    }

    public function getRiderctUrl($wfTypeID) {

        $sql = "select wftype_redirect_url from hs_hr_wf_type where wftype_code=$wfTypeID";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $results[] = $row;
        }

        return $results[0]['wftype_redirect_url'];
    }
    
    public function getWorkFlowRecord($wfID) {
      
        $q = Doctrine_Query::create()
                        ->select('wm.*')
                        ->from('WfMain wm')
                        ->where('wm.wfmain_id = ?', $wfID)
                        ->orderBy('wm.wfmain_flow_id desc');

        return $q->fetchArray();
    
    }
    public function getWorkFlowRecordById($wfID) {
      
        $q = Doctrine_Query::create()
                        ->select('wm.*,e.*,ap.*')
                        ->from('WfMain wm')                        
                        ->leftJoin('wm.Employee e on e.emp_number=wm.wfmain_approving_emp_number ')
                        ->leftJoin('wm.WfMainAppPerson ap on ap.wfmain_id=wm.wfmain_id ')
                        ->where('wm.wfmain_id = ?', $wfID);
                        

        return $q->execute();
      
    
    }
    public function getEmployee($empList = array()){
        if (is_array($empList)) {
                $q = Doctrine_Query::create()
                                ->select('e.*')
                                ->from('Employee e')                                
                                ->whereIn('e.emp_number', $empList);

                return $q->fetchArray();
            }
    }
    
    public function GetListedEmpids($cid) {

        $q = Doctrine_Query::create()
                        ->select('u.*')
                        ->from('WFGroupAppPerson u')
                        ->where('u.wfappgrp_code = ?', $cid);


        return $q->fetchArray();
    }
    

}

?>
