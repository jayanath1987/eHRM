<?php

/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
/**
 * Actions class for ESS module
 *
 *-------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 27 July 2011 
 *  Comments  - ESS main functions
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
**/

include ('../../lib/common/LocaleUtil.php');
class ESSActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        try{
        $this->getUser()->setCulture($_SESSION['language']);
        if (strlen($request->getParameter('empNumber'))) {

            $empNumber = $request->getParameter('empNumber');

            $_SESSION['PIM_EMPID'] = $empNumber;
        } elseif (strlen($_SESSION['PIM_EMPID'])) {
            
        } else {
            if (strlen($_SESSION['empNumber'])) {
                $_SESSION['PIM_EMPID'] = $_SESSION['empNumber'];
            }
        }

        $noticeDao = new NoticeDao();
        $this->today =  $today = date("Y-m-d");
        $this->notices = $noticeDao->getAllNotice($today,$_SESSION['empNumber']);
        if ($_SESSION['user'] == "USR001") {
            $this->redirect('pim/list');
        }
       
        //--temporary Activate employee details
        if ($_SESSION['user'] == "USR004") {
            $this->redirect('pim/list');
        }

        $this->Culture = $this->getUser()->getCulture();
        $employee = $_SESSION['empNumber'];
        $ESSDao = new ESSDao();
        /* make LDAP user session */
        $this->EmployeeReadForLdap = $ESSDao->readEmployee($_SESSION['PIM_EMPID']);
        if(!$this->EmployeeReadForLdap){
          $this->redirect('default/PermissionDenind');
        }

        $EmployeeData = $this->EmployeeReadForLdap;
        $_SESSION['LDAP_USERID']=$EmployeeData->employeeId;
        
        /* end */
        $this->Employee = $ESSDao->readEmployee($employee);
       
       /*WorkFlow */
        try{
        if($_SESSION['user']=="USR001"){
            throw new Exception("Invalid File Type", 200);
                              
        }else{
        $wfDao = new workflowDao();
        $approvingEmpID=$_SESSION['empNumber'];
        $this->apSummary = $wfDao->applicationSummary($approvingEmpID);
        $this->culture = $this->getUser()->getCulture();
        }
        }
        catch(sfStopException $sf){
            
        }
        catch (Doctrine_Connection_Exception $e) {
                
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('default/error');
            } catch (Exception $e) {               
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('default/error');
         }


	//Integration
	        //-------Attendance view
        $e = getdate();
        $today = date("Y-m-d", $e[0]);

        $fdate = new DateTime($today);
        $fdate->sub(new DateInterval('P6D'));
        $weekback = $fdate->format("Y-m-d");

        $atnda = new attendanceDao();
        $this->recordday = $atnda->readattendanceDay();

        $LeaveDao = new LeaveDao();
        $this->leaveholiday = $LeaveDao->readLeaveHolyDay();
        
        $EvaluationDao = new EvaluationDao();

        $attendanceDao = new attendanceDao();

        $res = $attendanceDao->viewall($weekback, $today, 1, $EmployeeData->empNumber, 1, 'a.atn_date', 'ASC');
        
        $this->attendance = $res['data'];
        //-------End Attendance view
        //-------Approval view
        $subordinates = $ESSDao->LoadsubordinateData($EmployeeData->empNumber);
        $i=0;
        foreach($subordinates as $row){
            if($i!=0){
                $defsubordin.= "_".$row['subordinateId'];
            }else{
            $defsubordin.= $row['subordinateId'];
            }
            $i++;
        }
 
        $this->defsubordin=$defsubordin;
        
        $pendingleaveEMP = $LeaveDao->getemployeePendingLeaveEMPLOYEE($defsubordin);

//        $this->PendingLeave+=$pendingleave[0]['count'];

        if($pendingleaveEMP){
        $i=0;
        foreach($pendingleaveEMP as $row){
            if($i!=0){
                $subordin.= "_".$row['emp_number'];
            }else{
            $subordin.= $row['emp_number'];
            }
            $i++;
        }
        $this->subordinateEmpno = $subordin;    
        }
//        die(print_r($subordin));
            
        foreach ($subordinates as $row) {
            $pendingleave = $LeaveDao->getemployeePendingLeave($row['subordinateId']);
            $this->PendingLeave+=$pendingleave[0]['count'];
            

            $pendingTransfer = $ESSDao->getemployeePendingTransfer($row['subordinateId']);
            $this->PendingTransfer+=$pendingTransfer[0]['count'];

            $pendingDisciplinary = $ESSDao->getemployeePendingDisciplinary($row['subordinateId']);
            $this->PendingDisciplinary+=$pendingDisciplinary[0]['count'];

            $pendingTraining = $ESSDao->getemployeePendingTraining($row['subordinateId']);
            $this->PendingTraining+=$pendingTraining[0]['count'];

            $pendingPromotion = $ESSDao->getemployeePendingPromotion($row['subordinateId']);
            $this->PendingPromotion+=$pendingPromotion[0]['count'];
            
            //$pendingEvlFT = $EvaluationDao->getemployeePendingFTESS($row['subordinateId']);
            //$this->PendingEvlFT+=$pendingEvlFT[0]['count'];
            

                
            }
            $Supervisor = $EvaluationDao->LoadsubordinateDataSupervisor($EmployeeData->empNumber);
            $j=0; 
	    //die(print_r($Supervisor));
            foreach($Supervisor as $row){
                if($j!=0){
                    $SupervisorEvl.= "_".$row['emp_number'];
                }else{
                $SupervisorEvl.= $row['emp_number'];
                }
                $j++;


             $this->SupervisorEvl=$SupervisorEvl; 
            
        } 
            $PendingEvaluationforSupervisor = $EvaluationDao->getemployeePendingEvaluationforSupervisor($SupervisorEvl);
            $this->PendingEvaluationforSupervisor=$PendingEvaluationforSupervisor[0]['count'];
//            die(print_r($PendingEvaluationforSupervisor));
            
        
        $Modsubordinates = $EvaluationDao->LoadsubordinateDataModerator($EmployeeData->empNumber);
            $j=0;
            foreach($Modsubordinates as $row){
                if($j!=0){
                    $Moderatorsubordin.= "_".$row['emp_number'];
                }else{
                $Moderatorsubordin.= $row['emp_number'];
                }
                $j++;
                
            }
            
             $this->Moderatorsubordin=$Moderatorsubordin;
             
            $PendingEvaluationforModerator = $EvaluationDao->getemployeePendingEvaluationforModerator($Moderatorsubordin);
                
                $this->PendingEvaluationforModerator=$PendingEvaluationforModerator[0]['count'];

           
            
            
        // Traning Approval    
        $TrainApprovalDao = new TrainApprovalDao();
        $PendingTraning = $TrainApprovalDao->getemployeePendingTrainingEMPLOYEE($_SESSION['empNumber']);        
                
         $this->employeePendingTrainingCount= $PendingTraning[0]['count'];   
            
            //die(print_r($this->PendingEvaluationforModerator));
        
        //die(print_r($subordinates));
        //-------End Approval view
        //------- Policy doc view
        //-------End Policy doc view
    

	//End of Integration

            //-- Approved Employee Notification
            $DefaultDao = new DefaultDao();
            $NotificationCount = $DefaultDao->getemployeeNotificationlCount($EmployeeData->empNumber);
            $this->employeeNotificationlCount=$NotificationCount[0]['count'];
            
            $employeeNotification = $DefaultDao->employeeNotification($EmployeeData->empNumber);
            $this->employeeNotification=$employeeNotification;
            //die(print_r( $employeeNotification));
            
        }catch(sfStopException $sf){
            
        }
        catch (Doctrine_Connection_Exception $e) {
                
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('default/error');
        } catch (Exception $e) {               
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('default/error');
         }

    }

    /**
     * Set message
     */
    public function setMessage($messageType, $message = array()) {
        $this->getUser()->setFlash('messageType', $messageType);
        $this->getUser()->setFlash('message', $message);
    }


}
