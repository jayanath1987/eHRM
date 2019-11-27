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
 * Actions class for Disciplinary module
 *
 *-------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
**/

include ('../../lib/common/LocaleUtil.php');

class disciplinaryActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

    }

    public function executeActiontype(sfWebRequest $request) {
        try {
            $this->culture = $this->getUser()->getCulture();


            $DisTypeOffceSubService=new DisTypeOffceSubService();
            $this->disciplinaryTypeOffenceService = $DisTypeOffceSubService;

            $this->sorter = new ListSorter('Disaction.sort', 'DS_module', $this->getUser(), array('dis_acttype_name', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'd.dis_acttype_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'DESC' : $request->getParameter('order');

            $res = $DisTypeOffceSubService->searchActionType($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order);
            $this->ActionTypeSummeryList = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0 )
            {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        
        }catch(sfStopException $e){
 
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());

            $this->redirect('default/error');
        }
    }

    public function executeSaveActiontype(sfWebRequest $request) {


        $this->culture = $this->getUser()->getCulture();


        if ($request->isMethod('post')) {

            $DiscAction = new DisciplinaryActionType();
            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;

            (strlen($request->getParameter('txtTypeen')  ? $DiscAction->setDis_acttype_name(trim($request->getParameter('txtTypeen'))) : $DiscAction->setTd_inst_name_en(null))); // returns true

            (strlen($request->getParameter('txtTypesi')  ? $DiscAction->setDis_acttype_name_si(trim($request->getParameter('txtTypesi'))) : $DiscAction->setDis_acttype_name_si(null))); // returns true

            (strlen($request->getParameter('txtTypeta')  ? $DiscAction->setDis_acttype_name_ta(trim($request->getParameter('txtTypeta'))) : $DiscAction->setDis_acttype_name_ta(null))); // returns true

            try {
                $disciplinaryTypeOffenceService->saveActiontype($DiscAction);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actiontype');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actiontype');
            }
            $this->lastid = $disciplinaryTypeOffenceService->getLastActiontype();

            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__('Successfully Added', $args, 'messages')));
            $this->redirect('disciplinary/actiontype');
        }
    }

    public function executeUpdateActiontype(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        try {
            $inId = $encrypt->decrypt($request->getParameter('id'));

            if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
                $this->lockMode = 0;
            } else {
                $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
            }


            if (isset($this->lockMode)) {
                if ($this->lockMode == 1) {

                    $conHandler = new ConcurrencyHandler();

                    $recordLocked = $conHandler->setTableLock('hs_hr_dis_action_type', array($inId), 1);

                    if ($recordLocked) {
                        // Display page in edit mode
                        $this->lockMode = 1;
                    } else {

                        $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                        $this->lockMode = 0;
                    }
                } else if ($this->lockMode == 0) {
                    $conHandler = new ConcurrencyHandler();
                     $conHandler->resetTableLock('hs_hr_dis_action_type', array($inId), 1);
                    $this->lockMode = 0;
                }
            }
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());

            $this->redirect('disciplinary/actiontype');
        }



        
             $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;

        $dActiontype = $disciplinaryTypeOffenceService->readActiontype($encrypt->decrypt($request->getParameter('id')));
        if (!$dActiontype) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('disciplinary/actiontype');
        }

        $this->dActiontype = $dActiontype;
        if ($request->isMethod('post')) {
            try {

                (strlen($request->getParameter('txtTypeen')  ? $dActiontype->setDis_acttype_name(trim($request->getParameter('txtTypeen'))) : $dActiontype->setTd_inst_name_en(null))); // returns true

                (strlen($request->getParameter('txtTypesi')  ? $dActiontype->setDis_acttype_name_si(trim($request->getParameter('txtTypesi'))) : $dActiontype->setDis_acttype_name_si(null))); // returns true

                (strlen($request->getParameter('txtTypeta')  ? $dActiontype->setDis_acttype_name_ta(trim($request->getParameter('txtTypeta'))) : $dActiontype->setDis_acttype_name_ta(null))); // returns true


            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actiontype');
            }
            try {

                $disciplinaryTypeOffenceService->saveActiontype($dActiontype);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/UpdateActiontype?lock=' . $encrypt->encrypt(0) . '&id=' . $encrypt->encrypt($dActiontype->getDis_acttype_id()));
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('disciplinary/UpdateActiontype?lock=' . $encrypt->encrypt(0) . '&id=' . $encrypt->encrypt($dActiontype->getDis_acttype_id()));
        }
    }

    public function executeDeleteActionType(sfWebRequest $request) {


        if (count($request->getParameter('chkLocID')) > 0) {

            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;
            $disCommonService=new DisCommonService();

            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_dis_action_type', array($ids[$i]), 1);
                    if ($isRecordLocked) {
                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];

                        $disCommonService->deleteActiontype($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_dis_action_type', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actiontype');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actiontype');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('disciplinary/actiontype');
    }

    public function executeDeleteIncident(sfWebRequest $request) {



        if (count($request->getParameter('chkLocID')) > 0) {

            $discDao = new DisciplinaryDao();
            $disciplinaryIncidentDaoService=new DisciplinaryIncidentService();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_dis_incidents', array($ids[$i]), 1);
                    if ($isRecordLocked) {
                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];

                        foreach ($_POST['chkLocID'] as $key => $value) {
                            $disciplinaryIncidentDaoService->deleteOffenceList($value);
                            $discDao->deleteInvolveEmployee($value);
                            $discDao->deleteAttachment($value);
                            $discDao->deleteIncidents($value);
                        }
                        $conHandler->resetTableLock('hs_hr_dis_incidents', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/IncidentSummary');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/IncidentSummary');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('disciplinary/IncidentSummary');
    }

    public function  executeActions(sfWebRequest $request) {
        try {
            $this->culture = $this->getUser()->getCulture();


              $DisTypeOffceSubService=new DisTypeOffceSubService();
            $this->disciplinaryTypeOffenceService = $DisTypeOffceSubService;

            $this->sorter = new ListSorter('Offence.sort', 'DS_module', $this->getUser(), array('dis_offence_name', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'o.dis_offence_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'DESC' : $request->getParameter('order');

            $res = $DisTypeOffceSubService->searchOffence($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order);
            $this->offenceList = $res['data'];

            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0 )
            {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        }catch(sfStopException $e){
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveActions(sfWebRequest $request) {
        $this->culture = $this->getUser()->getCulture();

        $offence = new Offence();
            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;

        $this->actiontypes = $disciplinaryTypeOffenceService->getActiontypes();

        if ($request->isMethod('post')) {

            $offence->setDis_acttype_id($request->getParameter('cmbActiontype'));

           
            (strlen($request->getParameter('txtOffence')  ? $offence->setDis_offence_name(trim($request->getParameter('txtOffence'))) : $offence->setDis_offence_name(null))); // returns true

            (strlen($request->getParameter('txtOffencesi')  ? $offence->setDis_offence_name_si(trim($request->getParameter('txtOffencesi'))) : $offence->setDis_offence_name_si(null))); // returns true

            (strlen($request->getParameter('txtOffenceta')  ? $offence->setDis_offence_name_ta(trim($request->getParameter('txtOffenceta'))) : $offence->setDis_offence_name_ta(null))); // returns true

            try {
                $disciplinaryTypeOffenceService->saveOffence($offence);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actions');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actions');
            }
            $this->lastid = $disciplinaryTypeOffenceService->getLastoffecnce();

            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__('Successfully Added', $args, 'messages')));
            $this->redirect('disciplinary/actions');
        }
    }

    public function executeUpdateActions(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();
        try {
            $inId = $encrypt->decrypt($request->getParameter('id'));

            if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
                $this->lockMode = 0;
            } else {
                $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
            }


            if (isset($this->lockMode)) {
                if ($this->lockMode == 1) {

                    $conHandler = new ConcurrencyHandler();

                    $recordLocked = $conHandler->setTableLock('hs_hr_dis_offence', array($inId), 1);

                    if ($recordLocked) {

                        $this->lockMode = 1;
                    } else {

                        $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                        $this->lockMode = 0;
                    }
                } else if ($this->lockMode == 0) {
                    $conHandler = new ConcurrencyHandler();
                     $conHandler->resetTableLock('hs_hr_dis_offence', array($inId), 1);
                    $this->lockMode = 0;
                }
            }
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('disciplinary/actions');
        }



        $id = $inId;
        $this->culture = $this->getUser()->getCulture();

        
            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;

        $this->actiontypes = $disciplinaryTypeOffenceService->getActiontypes();
        $dOffence = $disciplinaryTypeOffenceService->readOffence($id);
        if (!$dOffence) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('disciplinary/actions');
        }
        $this->dOffence = $dOffence;

        if ($request->isMethod('post')) {
           
            try {

                $disciplinaryTypeOffenceService->updateOffence($request,$dOffence);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actions');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actions');
            }


            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__('Successfully Updated', $args, 'messages')));

            $this->redirect('disciplinary/UpdateActions?lock=' . $encrypt->encrypt(0) . '&id=' . $encrypt->encrypt($dOffence->getDis_offence_id()));
        }
    }

    public function executeDeleteActions(sfWebRequest $request) {


        if (count($request->getParameter('chkLocID')) > 0) {

            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_dis_offence', array($ids[$i]), 1);
                    if ($isRecordLocked) {
                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];

                        $disciplinaryTypeOffenceService->deleteOffence($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_dis_offence', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actions');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/actions');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('disciplinary/actions');
    }

    public function executeIncidents(sfWebRequest $request) {

        try {
            $this->culture = $this->getUser()->getCulture();

            if (strlen($_GET['level'])) {
                $_SESSION['level'] = $_GET['level'];
            }

        $DisciplinaryIncidentServiceSub=new DisciplinaryIncidentServiceSub();
        $this->DisciplinaryIncidentServiceSub = $DisciplinaryIncidentServiceSub;

            $this->sorter = new ListSorter('Disaction.sort', 'DS_module', $this->getUser(), array('dis_acttype_name', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'r.dis_inc_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $res = $DisciplinaryIncidentServiceSub->searchLevel0($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order, $closed = "", $level = "1");
            $this->Level0SummeryList = $res['data'];

            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        
        }catch(sfStopException $e){    
            
        } catch (Exception $e) {

            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());

            $this->redirect('default/error');
        }
    }

    public function executeClosedIncidents(sfWebRequest $request) {
        try {
            $this->culture = $this->getUser()->getCulture();

            if (strlen($_GET['level'])) {
                $_SESSION['level'] = $_GET['level'];
            }

        



            //$discDao = new DisciplinaryDao();
            //$this->disciDao = $disciDao;
        $DisciplinaryIncidentServiceSub=new DisciplinaryIncidentServiceSub();
        $this->DisciplinaryIncidentServiceSub = $DisciplinaryIncidentServiceSub;

            $this->sorter = new ListSorter('Disaction.sort', 'DS_module', $this->getUser(), array('dis_acttype_name', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'r.dis_inc_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $res = $DisciplinaryIncidentServiceSub->searchLevel0($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order, $closed = "yes", $level = "");
            $this->Level0SummeryList = $res['data'];

            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0 )
            {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));

           
            }
        }catch(sfStopException $e){
            
        } catch (Exception $e) {

            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());

            $this->redirect('default/error');
        }
    }

    public function executeSaveInsident(sfWebRequest $request) {
       
        $lvl = $request->getParameter('lvl');
        $this->lvl = $lvl;

        $this->culture = $this->getUser()->getCulture();

        $incident = new Incidents();
       // $discDao = new DisciplinaryDao();
        

            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;

            $disciplinaryIncidentDaoService=new DisciplinaryIncidentService();
            $this->disciplinaryIncidentDaoService = $disciplinaryIncidentDaoService;

        $this->actiontypes = $disciplinaryTypeOffenceService->getActiontypes();

        if ($request->isMethod('post')) {
            try {

                

                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $disciplinaryIncidentDaoService->saveIncident($request,$incident);



                $maxIncid = $disciplinaryIncidentDaoService->getMaxIncidentId();


                foreach ($_POST['hiddenEmpNumber'] as $key => $value) {
                    $empInvol = new DisEmployeeInvolved();
                    $empInvol->setEmp_number($value);
                    $empInvol->setDis_inc_id($maxIncid[0]['MAX']);
                    $disciplinaryIncidentDaoService->saveInvolvedEmp($empInvol);
                }


                for ($i = 0; $i < count($_POST['checkList']); $i++) {

                    $offenceList = new OffenceList();
                    $offenceList->setDis_inc_id($maxIncid[0]['MAX']);
                    $offenceList->setDis_offence_id($_POST['checkList'][$i]);
                    $disciplinaryIncidentDaoService->saveOffenceList($offenceList);
                }



                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/SaveInsident');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/SaveInsident');
            }
            $this->lastid = $disciplinaryIncidentDaoService->getMaxIncidentId();

            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__('Successfully Added', $args, 'messages')));
            if ($lvl == 1) {
                $this->redirect('disciplinary/UpdateInsident?id=' . $this->lastid[0]['MAX']);
            } elseif ($lvl == 2) {
                $this->redirect('disciplinary/UpdateInsidentlevel2?id=' . $this->lastid[0]['MAX']);
            }

            $this->redirect('disciplinary/SaveInsident');
        }
    }

    public function executeIncidentSummary(sfWebRequest $request) {

        try {
            $this->culture = $this->getUser()->getCulture();


            
            $DisciplinaryIncidentServiceSub=new DisciplinaryIncidentServiceSub();
            $this->DisciplinaryIncidentServiceSub = $DisciplinaryIncidentServiceSub;

            $this->sorter = new ListSorter('Offence.sort', 'DS_module', $this->getUser(), array('i.dis_inc_date,i.dis_inc_reportedby', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'i.dis_inc_date,i.dis_inc_reportedby' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'DESC' : $request->getParameter('order');

            $res = $DisciplinaryIncidentServiceSub->searchIncidentSummary($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order);
            $this->inscidentList = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0 )
            {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        
        }catch(sfStopException $e){    
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executePendingInqSummary(sfWebRequest $request) {

        try {
            $this->culture = $this->getUser()->getCulture();

             $DisciplinaryIncidentServiceSub=new DisciplinaryIncidentServiceSub();
            $this->DisciplinaryIncidentServiceSub = $DisciplinaryIncidentServiceSub;

            $this->sorter = new ListSorter('Offence.sort', 'DS_module', $this->getUser(), array('i.dis_inc_date,i.dis_inc_reportedby', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'i.dis_inc_date,i.dis_inc_reportedby' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'DESC' : $request->getParameter('order');
            if($request->getParameter('flag')!=1){
            $res = $DisciplinaryIncidentServiceSub->searchPendingInqSummary($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order,"","");
           
            $this->inscidentList = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
             }
            if (count($res['data']) <= 0 && $request->getParameter('flag')!=1)
            {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
                $this->redirect('disciplinary/PendingInqSummary?flag=1');
                
            }
        } 
        catch(sfStopException $sf){
            
        }
        catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeGetListedEmpids(sfWebRequest $request) {
        $this->culture = $this->getUser()->getCulture();
        $discDao = new DisciplinaryDao();

        $id = $request->getParameter('incidentId');
        $empidList = $discDao->GetListedEmpids($id);
        $this->empidList = $empidList;
    }

    public function executeEditvalidation(sfWebRequest $request) {

        $this->culture = $this->getUser()->getCulture();
        $discDao = new DisciplinaryDao();
        $id = $request->getParameter('id');

        $this->inc_id = $id;
        $this->CurrentActiontype = $discDao->getCurrentActiontypes($id);
        $level = $this->CurrentActiontype[0]['dis_inc_level'];

        if ($level == 2) {
            $this->message = "error";
        } else {
            $this->message = "ok";
        }
    }

    public function executeUpdateInsident(sfWebRequest $request) {
        $this->culture = $this->getUser()->getCulture();
        $culture = $this->culture;
        
        $encrypt = new EncryptionHandler();
        $inId = $request->getParameter('id');

        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }


        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_dis_incidents', array($inId), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {

                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                 $conHandler->resetTableLock('hs_hr_dis_incidents', array($inId), 1);
                $this->lockMode = 0;
            }
        }


        $id = $encrypt->decrypt($request->getParameter('id'));

        $this->inc_id = $id;


        


        //$discDao = new DisciplinaryDao();
        $disciplinaryIncidentDaoService=new DisciplinaryIncidentService();
        $this->disciplinaryIncidentDaoService = $disciplinaryIncidentDaoService;

        $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
        $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;

        $this->actiontypes = $disciplinaryTypeOffenceService->getActiontypes();

        $currentIncident = $disciplinaryIncidentDaoService->readIncidentByID($id);

        $this->currentIncident = $currentIncident;

        if (!$this->currentIncident) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('disciplinary/incidentSummary');
        }

        /**
         * Riderect if not recoed found
         */
        $involvedEmpList = $disciplinaryIncidentDaoService->getInvolvedEmpListByID($id);

        $this->i = 0;
        $this->childDiv = "";

        $FinalActionType = $disciplinaryTypeOffenceService->getFinalActiontypes();

        foreach ($involvedEmpList as $list) {



            if ($culture == "en") {
                $empName = $list->Employee->emp_display_name;
                $jobName = $list->Employee->jobTitle->name;
                $section = $list->Employee->subDivision->title;
            } else {
                $e = "emp_display_name_" . $culture;
                $s = "title_" . $culture;
                $j = "name_" . $culture;

                $empName = $list->Employee->$e;
                if ($empName == "") {
                    $empName = $list->Employee->emp_display_name;
                }
                $section = $list->Employee->subDivision->$s;
                if ($section == "") {
                    $section = $list->Employee->subDivision->title;
                }
                $jobName = $list->Employee->jobTitle->$j;
                if ($jobName == "") {
                    $jobName = $list->Employee->jobTitle->name;
                }
            }
            $this->i = $this->i + 1;


            $this->childDiv.="<div id='row_" . $this->i . "' style='padding-top:5px;'>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:150px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>" . $empName . "</div>";
            $this->childDiv.="</div>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:100px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>" . $jobName . "</div>";
            $this->childDiv.="</div>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:110px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>" . $section . "</div>";
            $this->childDiv.="</div>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:75px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'><a href='#' style='width:50px;' onclick='disHistoryPopup(" . $list->Employee->empNumber . ")'>" . $this->getContext()->getI18N()->__('History', $args, 'messages') . "</a></div>";
            $this->childDiv.="</div>";

            $this->childDiv.="<div class='centerCol' id='master' style='width:65px;'>";
            $this->childDiv.="<select class='cmbmajmin' name='cmbMajor_Minor[]' id='cmbMajor_Minor[]' class='formSelect' style='width: 50px; margin-top:0px;'  onchange='getCFA(this.value,$this->i);' >";
            $temp='--Select--';
            $this->childDiv.="<option value='' >".$temp."</option>";
            $this->childDiv.="<option value='0'";
            if ($list->dis_inv_type == "0") {
                $this->childDiv.=" selected='selected' ";
            }
            $this->childDiv.=">" . $this->getContext()->getI18N()->__('Minor', $args, 'messages') . "</option>";
            $this->childDiv.="<option value='1'";
            if ($list->dis_inv_type == "1") {
                $this->childDiv.=" selected='selected' ";
            }
            $this->childDiv.=">" . $this->getContext()->getI18N()->__('Major', $args, 'messages') . "</option>";
            $this->childDiv.="</select></div>";


            $this->childDiv.="<div class='centerCol ss' id='CFA_" . $this->i . "' style='width:95px;'>";
            $this->childDiv.="<select class='selectfa'  name='cmbFinalAction[]' id='cmbFinalAction[]' class='formSelect' style='width: 95px; margin-top:0px;'";
            if($list->dis_fna_code== null){
            $this->childDiv.="onfocus='getCFA(0,$this->i);' >";
            }else{
                $this->childDiv.=">";
            }
            $temp='--Select--';
            $this->childDiv.="<option value='' >".$temp."</option>";
            foreach ($FinalActionType as $FinalAction) {
                $this->childDiv.="<option value='" . $FinalAction->dis_fna_code . "'";
                if ($FinalAction->dis_fna_code == $list->dis_fna_code) {
                    $this->childDiv.=" selected='selected' ";
                }
                $this->childDiv.=">";
                if ($culture == 'en') {
                    $this->childDiv.=$FinalAction->dis_fna_name;
                } else {
                    $column = 'dis_fna_name_' . $culture;
                    if ($FinalAction->$column == null) {
                        $this->childDiv.=$FinalAction->dis_fna_name;
                    } else {
                        $this->childDiv.=$FinalAction->$column;
                    }
                }
                $this->childDiv.="</option>";
            }
            $this->childDiv.="</select></div>";


            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'><input type='hidden' name='hiddenEmpNumber[]' value=" . $list->Employee->empNumber . " ></div></div>";
        }


        $this->actiontypes = $disciplinaryTypeOffenceService->getActiontypes();

        $offenceList = $disciplinaryIncidentDaoService->readOffenceList($id);
        $offlistArr = array();

        foreach ($offenceList as $offlist) {

            array_push($offlistArr, $offlist['dis_offence_id']);
        }
        $this->selctedList = $offlistArr;

        $actionType = $currentIncident->getDis_acttype_id();


        $this->offenceList = $this->displayOffenceList($actionType, $offlistArr);




        $isAttach = $disciplinaryIncidentDaoService->checkChargeSheet($id, "c");

        $isChargeSheet = $isAttach[0]['COUNT'];
        $this->isChargeSheet = $isChargeSheet;

        $this->chargeSheet = $disciplinaryIncidentDaoService->readChargeSheet($id, "c");

        if ($request->isMethod('post')) {//die(print_r($_POST));


            try {
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();

                if (array_key_exists('upCasefile', $_FILES)) {
                    foreach ($_FILES as $file) {

                        if ($file['tmp_name'] > '') {
                            if (!in_array(end(explode(".", strtolower($file['name']))), $sysConfs->allowedExtensions)) {
                                throw new Exception("Invalid File Type", 8);
                            }
                        }
                    }
                } else {
                    throw new Exception("Invalid File Type", 6);
                }

                $fileName = $_FILES['upCasefile']['name'];
                $tmpName = $_FILES['upCasefile']['tmp_name'];
                $fileSize = $_FILES['upCasefile']['size'];
                $fileType = $_FILES['upCasefile']['type'];

                $maxsize = $sysConfs->getMaxFilesizeDis();
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();
                if ($fileSize > $maxsize) {

                    throw new Exception("Maxfile size  Should be less than 10MB", 7);
                }






                $fp = fopen($tmpName, 'r');
                $content = fread($fp, filesize($tmpName));
                $content = addslashes($content);
                fclose($fp);
            } catch (Exception $e) {

                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());

                $this->redirect('disciplinary/IncidentSummary');
            }
            try {

               
            
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $disciplinaryIncidentDaoService->updateIncident($request,$currentIncident);

                $attachment = new DisAttachment();
                if (strlen($content)) {

                    $attachment->setDis_attach_name($fileName);
                    $attachment->setDis_attach_type($fileType);
                    $attachment->setDis_attach_content($content);
                    $attachment->setDis_inc_id($id);
                    $attachment->setDis_attach_category("c");





                    if ($isChargeSheet > 0) {


                        $this->chargeSheet[0]->setDis_attach_name($fileName);
                        $this->chargeSheet[0]->setDis_attach_type($fileType);
                        $this->chargeSheet[0]->setDis_attach_content($content);

                        $disciplinaryIncidentDaoService->saveDisAttachment($this->chargeSheet[0]);
                    } else {

                        $disciplinaryIncidentDaoService->saveDisAttachment($attachment);
                    }
                }


                $disciplinaryIncidentDaoService->deleteOffenceList($id);
                for ($i = 0; $i < count($_POST['checkList']); $i++) {

                    $offenceList = new OffenceList();
                    $offenceList->setDis_inc_id($id);
                    $offenceList->setDis_offence_id($_POST['checkList'][$i]);
                    $disciplinaryIncidentDaoService->saveOffenceList($offenceList);
                }

                $i = 0;
                foreach ($_POST['hiddenEmpNumber'] as $key => $value) {

                    $disciplinaryIncidentDaoService->updatedisemp($id, $value, $_POST['cmbMajor_Minor'][$i], $_POST['cmbFinalAction'][$i]);
                    $i++;
                }


                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));

                $conn->commit();
                $this->redirect('disciplinary/UpdateInsident?id=' . $encrypt->encrypt($id) . '&lock=' . $encrypt->encrypt(0));
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());

                $this->redirect('disciplinary/IncidentSummary');
            }
        }
    }

    public function executeEmpDisHistory(sfWebRequest $request) {

        try {
            $encryption=new EncryptionHandler();
            $empId = $encryption->decrypt($request->getParameter('empId'));
            $this->EncryptedEmp=$request->getParameter('empId');
            $this->culture = $this->getUser()->getCulture();


         $DisciplinaryIncidentServiceSub=new DisciplinaryIncidentServiceSub();
            $this->DisciplinaryIncidentServiceSub = $DisciplinaryIncidentServiceSub;

            $this->sorter = new ListSorter('Offence.sort', 'DS_module', $this->getUser(), array('i.dis_inc_id', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'i.dis_inc_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'DESC' : $request->getParameter('order');

            $res = $DisciplinaryIncidentServiceSub->empDisHistory($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order, $empId);
            $this->inscidentList = $res['data'];

            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        
        }catch(sfStopException $e){    
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeDeleteSavedRow(sfWebRequest $request) {

        $id = $request->getParameter('value');
        $insiId = $request->getParameter('insiId');

        $discDao = new DisCommonDao();
        
        $deleted = $discDao->deleteSavedInvolvedEmp($id, $insiId);

        echo json_encode($deleted);
        die;
    }

        public function executeUpdateInsidentlevel2(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        $inId = $encrypt->decrypt($request->getParameter('id'));

        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }


        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_dis_incidents', array($inId), 2);

                if ($recordLocked) {

                    $this->lockMode = 1;
                } else {

                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                 $conHandler->resetTableLock('hs_hr_dis_incidents', array($inId), 2);
                $this->lockMode = 0;
            }
        }


        $this->culture = $this->getUser()->getCulture();
        $culture = $this->culture;
        $id = $encrypt->decrypt($request->getParameter('id'));

        $this->inc_id = $id;


       


        //$discDao = new DisciplinaryDao();
        $disciplinaryIncidentDaoService=new DisciplinaryIncidentService();
        $this->disciplinaryIncidentDaoService = $disciplinaryIncidentDaoService;

        $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
        $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;

        $this->actiontypes = $disciplinaryTypeOffenceService->getActiontypes();

        $currentIncident = $disciplinaryIncidentDaoService->readIncidentByID($id);

        $time = $currentIncident->dis_inc_time;

        $timearr = explode(":", $time);

        $HH = $timearr[0];
        $MM = $timearr[1];

        $this->HH = $HH;
        $this->MM = $MM;


        $this->currentIncident = $currentIncident;

        if (!$this->currentIncident) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('disciplinary/PendingInqSummary');
        }

        /**
         * Riderect if not recoed found
         */
        $involvedEmpList = $disciplinaryIncidentDaoService->getInvolvedEmpListByID($id);

        $this->i = 0;
        $this->childDiv = "";

     
        foreach ($involvedEmpList as $list) {
            
        $FinalActionType = $disciplinaryTypeOffenceService->getFinalActiontypesfiltered($list->dis_inv_type);
        $this->FinalActionType=$FinalActionType;

            if ($culture == "en") {
                $empName = $list->Employee->emp_display_name;
                $jobName = $list->Employee->jobTitle->name;
                $section = $list->Employee->subDivision->title;
            } else {
                $e = "emp_display_name_" . $culture;
                $s = "title_" . $culture;
                $j = "name_" . $culture;

                $empName = $list->Employee->$e;
                if ($empName == "") {
                    $empName = $list->Employee->emp_display_name;
                }
                $section = $list->Employee->subDivision->$s;
                if ($section == "") {
                    $section = $list->Employee->subDivision->title;
                }
                $jobName = $list->Employee->jobTitle->$j;
                if ($jobName == "") {
                    $jobName = $list->Employee->jobTitle->name;
                }
            }



            if ($list->dis_inv_type == 0) {
                $minor = "selected";
                $major = "";
            } else {
                $major = "selected";
                $minor = "";
            }
            $this->i = $this->i + 1;


            $this->childDiv.="<div id='row_" . $this->i . "' style='padding-top:5px;'>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:175px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>" . $empName . "</div>";
            $this->childDiv.="</div>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:130px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>" . $jobName . "</div>";
            $this->childDiv.="</div>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:120px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>" . $section . "</div>";
            $this->childDiv.="</div>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:65px;'>";
            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'><a href='#' style='width:50px;' onclick='disHistoryPopup(" . $list->Employee->empNumber . ")'>" . $this->getContext()->getI18N()->__('History', $args, 'messages') . "</a></div>";
            $this->childDiv.="</div>";
            $this->childDiv.="<div class='centerCol' id='master' style='width:65px;'>";
            $this->childDiv.="<select name='cmbMajor_Minor[]' id='cmbMajor_Minor[]' class='formSelect' style='width: 50px; margin-top:0px;' disabled >";
            $this->childDiv.="<option value='0'";
            if ($list->dis_inv_type == "0") {
                $this->childDiv.=" selected='selected' ";
            }
            $this->childDiv.=">" . $this->getContext()->getI18N()->__('Minor', $args, 'messages') . "</option>";
            $this->childDiv.="<option value='1'";
            if ($list->dis_inv_type == "1") {
                $this->childDiv.=" selected='selected' ";
            }
            $this->childDiv.=">" . $this->getContext()->getI18N()->__('Major', $args, 'messages') . "</option>";
            $this->childDiv.="</select></div>";


            $this->childDiv.="<div class='centerCol' id='master' style='width:95px;'>";
            $this->childDiv.="<select name='cmbFinalAction[]' id='cmbFinalAction[]' class='formSelect' style='width: 95px; margin-top:0px;' disabled >";
//            $this->childDiv.="<option value='0'";
//            if ($list->dis_inv_type == "0") {
//                $this->childDiv.=" selected='selected' ";
//            }
//            $this->childDiv.=">" . $this->getContext()->getI18N()->__('Minor', $args, 'messages') . "</option>";
            foreach ($FinalActionType as $FinalAction) {
                $this->childDiv.="<option value='" . $FinalAction->dis_fna_code . "'";
                if ($FinalAction->dis_fna_code == $list->dis_fna_code) {
                    $this->childDiv.=" selected='selected' ";
                }
                $this->childDiv.=">";
                if ($culture == 'en') {
                    $this->childDiv.=$FinalAction->dis_fna_name;
                } else {
                    $column = 'dis_fna_name_' . $culture;
                    if ($FinalAction->$column == null) {
                        $this->childDiv.=$FinalAction->dis_fna_name;
                    } else {
                        $this->childDiv.=$FinalAction->$column;
                    }
                }
                $this->childDiv.="</option>";
            }
            $this->childDiv.="</select></div>";


            $this->childDiv.="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'><input type='hidden' name='hiddenEmpNumber[]' value=" . $list->Employee->empNumber . " ></div></div>";
        }


        $this->actiontypes = $disciplinaryTypeOffenceService->getActiontypes();

        $offenceList = $disciplinaryIncidentDaoService->readOffenceList($id);

        $offlistArr = array();

        foreach ($offenceList as $offlist) {

            array_push($offlistArr, $offlist['dis_offence_id']);
        }
        $this->selctedList = $offlistArr;

        $actionType = $currentIncident->getDis_acttype_id();


        $this->offenceList = $this->displayOffenceList($actionType, $offlistArr);


        //check Charge Sheet if there

        $isAttach = $disciplinaryIncidentDaoService->checkChargeSheet($id, "d");

        $isChargeSheet = $isAttach[0]['COUNT'];
        $this->isChargeSheet = $isChargeSheet;

        $this->chargeSheet = $disciplinaryIncidentDaoService->readChargeSheet($id, "d");

        if ($request->isMethod('post')) {


            try {
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();

                if (array_key_exists('upCasefile', $_FILES)) {
                    foreach ($_FILES as $file) {

                        if ($file['tmp_name'] > '') {
                            if (!in_array(end(explode(".", strtolower($file['name']))), $sysConfs->allowedExtensions)) {
                                throw new Exception("Invalid File Type", 8);
                            }
                        }
                    }
                } else {
                    throw new Exception("Invalid File Type", 6);
                }

                $fileName = $_FILES['upCasefile']['name'];
                $tmpName = $_FILES['upCasefile']['tmp_name'];
                $fileSize = $_FILES['upCasefile']['size'];
                $fileType = $_FILES['upCasefile']['type'];

                $maxsize = $sysConfs->getMaxFilesizeDis();
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();
                if ($fileSize > $maxsize) {

                    throw new Exception("Maxfile size  Should be less than 10MB", 7);
                }




                $timetoHR = $request->getParameter('cmbHH');
                $timetoMM = $request->getParameter('cmbMM');

                if ($timetoHR != -1 && $timetoMM != -1) {
                    $totime = $timetoHR . ":" . $timetoMM;
                } elseif ($timetoHR == -1 && $timetoMM != -1) {
                    $totime = "00:" . $timetoMM;
                } elseif ($timetoHR != -1 && $timetoMM == -1) {
                    $totime = $timetoHR . ":00";
                } else {

                    $totime = "";
                }
                $fp = fopen($tmpName, 'r');
                $content = fread($fp, filesize($tmpName));
                $content = addslashes($content);
                fclose($fp);
            } catch (Exception $e) {

                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());

                $this->redirect('disciplinary/PendingInqSummary');
            }
            try {
                


                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $disciplinaryIncidentDaoService->updateIncidentLevel2($request,$currentIncident);

                $attachment = new DisAttachment();
                if (strlen($content)) {

                    $attachment->setDis_attach_name($fileName);
                    $attachment->setDis_attach_type($fileType);
                    $attachment->setDis_attach_content($content);
                    $attachment->setDis_inc_id($id);
                    $attachment->setDis_attach_category("d");

                    if ($isChargeSheet > 0) {


                        $this->chargeSheet[0]->setDis_attach_name($fileName);
                        $this->chargeSheet[0]->setDis_attach_type($fileType);
                        $this->chargeSheet[0]->setDis_attach_content($content);

                        $disciplinaryIncidentDaoService->saveDisAttachment($this->chargeSheet[0]);
                    } else {

                        $disciplinaryIncidentDaoService->saveDisAttachment($attachment);
                    }
                }



                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));

                $conn->commit();

                $this->redirect('disciplinary/UpdateInsidentlevel2?id=' . $encrypt->encrypt($id) . '&lock=' . $encrypt->encrypt(0));
            } catch (sfStopException $sf) {
                    
                
          } catch (Doctrine_Connection_Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('disciplinary/PendingInqSummary');    
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());

                $this->redirect('disciplinary/PendingInqSummary');
            }
        }
    }

    public function executeIncidentlevel2Summery(sfWebRequest $request) {
        try {
            $this->culture = $this->getUser()->getCulture();

            if (strlen($_GET['level'])) {
                $_SESSION['level'] = $_GET['level'];
            }

           
            $DisciplinaryIncidentServiceSub=new DisciplinaryIncidentServiceSub();
            $this->DisciplinaryIncidentServiceSub = $DisciplinaryIncidentServiceSub;
           

            $this->sorter = new ListSorter('Disaction.sort', 'DS_module', $this->getUser(), array('i.dis_acttype_name', ListSorter::ASCENDING));

            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'i.dis_inc_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $res = $DisciplinaryIncidentServiceSub->searchLevel1($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order, $closed = "", $level = "2");
            $this->Level0SummeryList = $res['data'];

            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        
        }catch(sfStopException $e){    
            
        } catch (Exception $e) {

            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());

            $this->redirect('default/error');
        }
    }

    public function executeLoadoffence(sfWebRequest $request) {


        $id = $request->getParameter('atype');
        $offlistArray = $request->getParameter('offList');
        $disable = $request->getParameter('Active');
        if($disable=="disabled"){
            $Active="disabled=disabled";
        }else{
            $Active="";
        }
        $this->culture = $this->getUser()->getCulture();

        

        $disciplinaryIncidentDaoService=new DisciplinaryIncidentService();
        $this->disciplinaryIncidentDaoService = $disciplinaryIncidentDaoService;

        $this->offencelist = $disciplinaryIncidentDaoService->Loadoffence($id);
        $this->List = "";


        $count = count($this->offencelist);
        if ($count > 5) {
            $this->List.="<div style='width:400px; overflow: auto;' ".$Active." >";
        } else {
            $this->List.="<div>";
        }

        $this->List.="<table>";


        if (count($this->offencelist) < 1) {

            $this->List.="<tr>";
            $this->List.="<td>";
            $this->List.="<label style='width:250px;' for='txtLocationCode'>";
            $this->List.=$this->getContext()->getI18N()->__("There is No Offences in this Disciplinary Type", $args, 'messages');
            $this->List.="</label>";
            $this->List.="</td>";
            $this->List.="</tr>";
        } else {
            foreach ($this->offencelist as $list) {


                if ($this->culture == "en") {


                    $off_co = "dis_offence_name";
                } else {
                    $off_co = "dis_offence_name_" . $this->culture;
                    if ($list->$off_co == "") {
                        $off_co = "dis_offence_name";
                    } else {
                        $off_co = "dis_offence_name_" . $this->culture;
                    }
                }
                if ($offlistArray) {
                    if (in_array($list->getDis_offence_id(), $offlistArray)) {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    }
                }

                $this->List.="<tr >";
                $this->List.="<td style='width:30px;'>";
                $this->List.="<label class='controlLabel' for='txtLocationCode' style='width:30px'>";
                $this->List.="<input class='checkboxdisabled' type='checkbox' name='checkList[]'  ".$Active." value=" . $list->getDis_offence_id() . " " . $checked .  " >";
                $this->List.="</label>";
                $this->List.="</td>";
                $this->List.="<td>";
                $this->List.="<label style='width:250px;' for='txtLocationCode'>";
                $this->List.=$list->$off_co;
                $this->List.="</label>";
                $this->List.="</td>";
                $this->List.="</tr>";
            }
        }
        $this->List.="</table>";
        $this->List.="</div>";
    }

    public function displayOffenceList($id, array $offlistArr) {


        $id = $id;

        $this->culture = $this->getUser()->getCulture();

     
        $disciplinaryIncidentDaoService=new DisciplinaryIncidentService();
        $this->disciplinaryIncidentDaoService = $disciplinaryIncidentDaoService;

        $this->offencelist = $disciplinaryIncidentDaoService->Loadoffence($id);
        $this->List = "";

        $count = count($this->offencelist);
        if ($count > 5) {
            $this->List.="<div style='width:400px; overflow: auto;'>";
        } else {
            $this->List.="<div>";
        }

        $this->List.="<table style='width:300px;'>";


        foreach ($this->offencelist as $list) {
            if ($this->culture == "en") {
                $off_co = "dis_offence_name";
            } else {
                $off_co = "dis_offence_name_" . $this->culture;
                if ($list->$off_co == "") {
                    $off_co = "dis_offence_name";
                } else {
                    $off_co = "dis_offence_name_" . $this->culture;
                }
            }

            if (in_array($list->dis_offence_id, $offlistArr)) {
                $checked = "checked";
            } else {
                $checked = "";
            }

            $this->List.="<tr>";
            $this->List.="<td style='width:30px;'>";
            $this->List.="<label class='controlLabel' for='txtLocationCode' style='width:30px'>";
            $this->List.="<input class='checklistdesable' type='checkbox' id='checkList[]' name='checkList[]'  value=" . $list->dis_offence_id . " " . $checked;
            "/>";
            $this->List.="</label>";
            $this->List.="</td>";
            $this->List.="<td>";
            $this->List.="<label style='width:250px;' for='txtLocationCode'>";
            $this->List.=$list->$off_co;
            $this->List.="</label>";
            $this->List.="</td>";
            $this->List.="</tr>";
        }
        $this->List.="</table>";
        $this->List.="</div>";

        return $this->List;
    }

    public function executeImagePopup(sfWebRequest $request) {
        $disDao = new DisciplinaryDao();
        $encryptObj = new EncryptionHandler();

        $attachment = $disDao->getAttachment($encryptObj->decrypt($request->getParameter('id')));


        $outname = stripslashes($attachment[0]['dis_attach_content']);
        $type = stripslashes($attachment[0]['dis_attach_type']);

        $name = stripslashes($attachment[0]['dis_attach_name']);



        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header('Content-Description: File Transfer');
        header("Content-Type: $type");       
        header('Content-disposition: attachment; filename=' . $name);
        echo($outname);
        exit;
    }

    public function executeSummeryDis(sfWebRequest $request) {

        $this->culture = $this->getUser()->getCulture();
        $disDao = new DisciplinaryDao();
        $id = $request->getParameter('id');
        $this->close = $request->getParameter('close');

        $Incident = $disDao->getIncidentSummery($id);
        $this->incident = $Incident;
    }

    public function executeDeleteimage(sfWebRequest $request) {
        $encypt= new EncryptionHandler();
        $id = $request->getParameter('id');
        $type = $request->getParameter('type');





        $disDao = new DisciplinaryDao();
        $conn = Doctrine_Manager::getInstance()->connection();
        $conn->beginTransaction();
        try {
            $disDao->deleteImage($id, $type);


            $this->setMessage('SUCCESS', array('Successfully Deleted'));



            $conn->commit();
            $this->redirect('disciplinary/UpdateInsident?id=' . $encypt->encrypt($id));
        } catch (sfStopException $sfStop) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('disciplinary/IncidentSummary');
        } catch (Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('disciplinary/IncidentSummary');
        }
    }

    public function executeDeleteimageInquery(sfWebRequest $request) {
       $encypt= new EncryptionHandler();
        $id = $request->getParameter('id');
        $type = $request->getParameter('type');





        $disDao = new DisciplinaryDao();
        $conn = Doctrine_Manager::getInstance()->connection();
        $conn->beginTransaction();
        try {
            $disDao->deleteImage($id, $type);


            $this->setMessage('SUCCESS', array('Successfully Deleted'));



            $conn->commit();
            $this->redirect('disciplinary/UpdateInsidentlevel2?id=' . $encypt->encrypt($id));
            
        } catch (sfStopException $sfStop) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('disciplinary/IncidentSummary');
        } catch (Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('disciplinary/IncidentSummary');
        }
    }

    public function executeLoadGrid(sfWebRequest $request) {
        $this->culture = $this->getUser()->getCulture();
        $disDao = new DisciplinaryDao();
        $empId = $request->getParameter('empid');

        $this->emplist = $disDao->getEmployee($empId);
    }

    public function setMessage($messageType, $message = array(), $persist=true) {
        $this->getUser()->setFlash('messageType', $messageType, $persist);
        $this->getUser()->setFlash('message', $message, $persist);
    }

    public function executeError(sfWebRequest $request) {

        $this->redirect('default/error');
    }

    public function executeFinalAction(sfWebRequest $request) {

        try {
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];
            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;
            //$disCommonService=new DisCommonService();
            $DisciplinaryTypeOffenceDao=new DisciplinaryTypeOffenceDao();

            $this->sorter = new ListSorter('FinalAction', 'FinalAction', $this->getUser(), array('b.dis_fna_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));


            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'b.dis_fna_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $DisciplinaryTypeOffenceDao->searchFinalAction($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->FinalAction = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0 )
            {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
            
        }catch(sfStopException $e){
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveFinalAction(sfWebRequest $request) {
        $this->myCulture = $this->getUser()->getCulture();
            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;
        $knwdt = new DisiplinaryFinalAction();
        if ($request->isMethod('post')) {
            if (strlen($request->getParameter('txtCode'))) {
                $knwdt->setDis_fna_usercode(trim($request->getParameter('txtCode')));
            } else {
                $knwdt->setDis_fna_usercode(null);
            }
            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setDis_fna_name(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setDis_fna_name(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setDis_fna_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setDis_fna_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setDis_fna_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setDis_fna_name_ta(null);
            }
            if (strlen($request->getParameter('cmbType'))) {
                $knwdt->setDis_fna_type(trim($request->getParameter('cmbType')));
            } else {
                $knwdt->setDis_fna_type(null);
            }

            try {
                $disciplinaryTypeOffenceService->saveFinalAction($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/FinalAction');
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/FinalAction');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/FinalAction');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
            $this->redirect('disciplinary/FinalAction');
        }
    }

    public function executeUpdateFinalAction(sfWebRequest $request) {
        //Table Lock code is Open
        $encrypt = new EncryptionHandler();

        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }
        $transPid = $request->getParameter('id');
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_dis_finalaction', array($transPid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                 $conHandler->resetTableLock('hs_hr_dis_finalaction', array($transPid), 1);
                $this->lockMode = 0;
            }
        }

        //Table lock code is closed
        $this->myCulture = $this->getUser()->getCulture();
            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;
        $knwdt = new DisiplinaryFinalAction();

        $knwdt = $disciplinaryTypeOffenceService->readFinalAction($encrypt->decrypt($request->getParameter('id')));
        if (!$knwdt) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('disciplinary/FinalAction');
        }

        $this->FinalActionlist = $knwdt;
        if ($request->isMethod('post')) {
            if (strlen($request->getParameter('txtCode'))) {
                $knwdt->setDis_fna_usercode(trim($request->getParameter('txtCode')));
            } else {
                $knwdt->setDis_fna_usercode(null);
            }
            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setDis_fna_name(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setDis_fna_name(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setDis_fna_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setDis_fna_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setDis_fna_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setDis_fna_name_ta(null);
            }
            if (strlen($request->getParameter('cmbType'))) {
                $knwdt->setDis_fna_type(trim($request->getParameter('cmbType')));
            } else {
                $knwdt->setDis_fna_type(null);
            }
            try {
                $disciplinaryTypeOffenceService->saveFinalAction($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/UpdateFinalAction?id=' . $encrypt->encrypt($knwdt->dis_fna_code) . '&lock=' . $encrypt->encrypt(0));
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/UpdateFinalAction?id=' . $encrypt->encrypt($knwdt->dis_fna_code) . '&lock=' . $encrypt->encrypt(0));
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('disciplinary/UpdateFinalAction?id=' . $encrypt->encrypt($knwdt->dis_fna_code) . '&lock=' . $encrypt->encrypt(0));
        }
    }

    public function executeDeleteFinalAction(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $disciplinaryTypeOffenceService=new DisciplinaryTypeOffenceService();
            $this->disciplinaryTypeOffenceService = $disciplinaryTypeOffenceService;
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_dis_finalaction', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $disciplinaryTypeOffenceService->deleteFinalAction($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_dis_finalaction', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/FinalAction');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/FinalAction');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('disciplinary/FinalAction');
    }
    
    
        public function executeAjaxEncryption(sfWebRequest $request) {

        $empId = $request->getParameter('empId');
        $encrypt = new EncryptionHandler();
        echo json_encode($encrypt->encrypt($empId));
        die;
    }
    
        public function executeAjaxloadFinalActions(sfWebRequest $request) {

        $culture = $this->getUser()->getCulture();
        $id = $request->getParameter('cid');

        $disciplinaryTypeOffenceService = new DisciplinaryTypeOffenceService();
        $FinalActions = $disciplinaryTypeOffenceService->getFinalActiontypesfiltered($id);
        
        $arr = Array();


        foreach ($FinalActions as $row) {
            if($culture=="en"){
            $n = "dis_fna_name"; 
            }else{
             $n = "dis_fna_name_" . $culture;   
            }
            if ($row[$n] != null) {
                $n = $n;
            } else {
                $n = "dis_fna_name";
            }
            $arr[$row['dis_fna_code']] = $row[$n];
        }


        echo json_encode($arr);
        die;
    }
    
    public function executeReinstatement(sfWebRequest $request){
      try {
            $this->Culture = $this->getUser()->getCulture();
            $ReinstatementService = new ReinstatementService();

            $this->sorter = new ListSorter('Reinstatement', 'disciplinary', $this->getUser(), array('r.rei_id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));



            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'r.rei_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $ReinstatementService->searchReinstatement($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->ReinstatementList = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        
        }catch(sfStopException $e){    
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
      
  }
  
  public function executeUpdateReinstatement(sfWebRequest $request) {
        $ReinstatementService = new ReinstatementService(); 
        $this->myCulture = $this->getUser()->getCulture();
        $encrypt = new EncryptionHandler();
        //Table Lock code is Open
        if($request->getParameter('id')){  
        
        if (!strlen($request->getParameter('lock'))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $request->getParameter('lock');
        }
        $VTID = $encrypt->decrypt($request->getParameter('id'));
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_reinstatement', array($VTID), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $recordLocked = $conHandler->resetTableLock('hs_hr_reinstatement', array($VTID), 1);
                $this->lockMode = 0;
            }
        }

        //Table lock code is closed
        

        $Reinstatement = $ReinstatementService->readReinstatement($encrypt->decrypt($request->getParameter('id')));
        if (!$Reinstatement) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('disciplinary/UpdateReinstatement');
        }
        $this->update="Update";
        }else{
           $Reinstatement = new Reinstatement();
           $this->lockMode = 1;
           $this->update="";
        }
        $this->Reinstatement= $Reinstatement;
        $this->desgnation = $ReinstatementService->getDesignation();
        $this->Grade = $ReinstatementService->getGradeLoad();
        if ($request->isMethod('post')) {
            
            $PayrollEmployee=$ReinstatementService->readPayrollEmployee($request->getParameter('txtEmpId'));
            $PEmployee=$ReinstatementService->readPayrollEmployee($request->getParameter('txtEmpId'));
            $Employee=$ReinstatementService->readEmployee($request->getParameter('txtEmpId'));
            (strlen($request->getParameter('txtEmpId')  ? $Reinstatement->setEmp_number(trim($request->getParameter('txtEmpId'))) : $Reinstatement->setEmp_number(null))); 
            (strlen($request->getParameter('txtEPF')  ? $Reinstatement->setEmp_epf_number(trim($request->getParameter('txtEPF'))) : $Reinstatement->setEmp_epf_number(null)));
            (strlen($request->getParameter('txtReinstatementDate')  ? $Reinstatement->setRei_date(trim(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtReinstatementDate')))) : $Reinstatement->setRei_date(null)));
            (strlen($request->getParameter('cmbDesg')  ? $Reinstatement->setJob_title_code(trim($request->getParameter('cmbDesg'))) : $Reinstatement->setJob_title_code(null)));
            (strlen($request->getParameter('cmbGrade')  ? $Reinstatement->setGrade_code(trim($request->getParameter('cmbGrade'))) : $Reinstatement->setGrade_code(null)));
            (strlen($request->getParameter('cmbGradeSlot') ? $Reinstatement->setSlt_id(trim($request->getParameter('cmbGradeSlot'))) : $Reinstatement->setOth_payroll_active_flg(null)));
            (strlen($request->getParameter('txtNWorkStaion')  ? $Reinstatement->setWork_station(trim($request->getParameter('txtNWorkStaion'))) : $Reinstatement->setWork_station(null)));
            (strlen($request->getParameter('txtReason')  ? $Reinstatement->setRei_reason(trim($request->getParameter('txtReason'))) : $Reinstatement->setRei_reason(null)));
            if($Employee->job_title_code != null){ 
                $Reinstatement->setPre_job_title_code($Employee->job_title_code);
            }else{            
                $Reinstatement->setPre_job_title_code(null);
            }
            
            if($Employee->grade_code != null){ 
                $Reinstatement->setPre_grade_code($Employee->grade_code);
            }else{            
                $Reinstatement->setPre_grade_code(null);
            }
            
            if($Employee->slt_scale_year != null){ 
                $Reinstatement->setPre_slt_id($Employee->slt_scale_year);
            }else{            
                $Reinstatement->setPre_slt_id(null);
            }
            
            if($Employee->work_station != null){ 
                $Reinstatement->setPre_work_station($Employee->work_station);
            }else{            
                $Reinstatement->setPre_work_station(null);
            }
            
            if(strlen($request->getParameter('cmbDesg'))) { $Employee->setJob_title_code(trim($request->getParameter('cmbDesg'))); }
            if(strlen($request->getParameter('cmbGrade'))) { $Employee->setGrade_code(trim($request->getParameter('cmbGrade'))); }
            if(strlen($request->getParameter('cmbGradeSlot'))) { $Employee->setSlt_scale_year(trim($request->getParameter('cmbGradeSlot'))); }
            if(strlen($request->getParameter('txtNWorkStaion'))) {$Employee->setWork_station(trim($request->getParameter('txtNWorkStaion'))); }
            
            if($PayrollEmployee){
            (strlen($request->getParameter('txtEPF') ? $PayrollEmployee->setEmp_epf_number(trim($request->getParameter('txtEPF'))) : $PayrollEmployee->setEmp_active_pr_flg(null)));
            if($PEmployee->emp_epf_number!=null){
                $Reinstatement->setPre_emp_epf_number($PEmployee->emp_epf_number); 
                if(strlen($request->getParameter('txtEPF'))) {$PEmployee->setEmp_epf_number(trim($request->getParameter('txtEPF'))); }
            }else{
                $Reinstatement->setPre_emp_epf_number(null);
            }
            
            }
            
            try {
                
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ReinstatementService->saveReinstatement($Reinstatement);
                $PEmployee->save();
                $Employee->save();
                $e = getdate();
                $today = date("Y-m-d", $e[0]);
                if($PayrollEmployee && ($today >= LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtReinstatementDate')))){
                $ReinstatementService->savePayrollEmployee($PayrollEmployee);
                }
                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollback();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/UpdateReinstatement?id=' . $encrypt->encrypt($Reinstatement->rei_id ) . '&lock=0');
            } catch (Exception $e) {
                $conn->rollback();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/UpdateReinstatement?id=' . $encrypt->encrypt($Reinstatement->rei_id ) . '&lock=0');
            }
            if($request->getParameter('txtReinstatementID')){
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('disciplinary/UpdateReinstatement?id=' . $encrypt->encrypt($Reinstatement->rei_id ) . '&lock=0');
            }else{
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Saved", $args, 'messages')));
            $this->redirect('disciplinary/Reinstatement');
                
            }
            
        }
    }
    
    public function executeDeleteReinstatement(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $ReinstatementService = new ReinstatementService();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_reinstatement', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $ReinstatementService->deleteReinstatement($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_reinstatement', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/Reinstatement');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('disciplinary/Reinstatement');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('disciplinary/Reinstatement');
    }

  public function executeAjaxCall(sfWebRequest $request) {
        $this->culture = $this->getUser()->getCulture();
        $culture=$this->culture;
        $ReinstatementService = new ReinstatementService();
        $this->value = $request->getParameter('sendValue');
        $Employee = $ReinstatementService->readEmployee($this->value);
        $PayrollEmployee = $ReinstatementService->readPayrollEmployee($this->value);
        

        $EmpID = $Employee->employeeId;
        $EPF=$PayrollEmployee->emp_epf_number;
        
        echo json_encode(array("EmpNumber"=>$EmpID,"EPFNo"=>$EPF));
        
        die;

    }

public function executeDisplayEmpHirache(sfWebRequest $request) {

        $wst = $request->getParameter('wst');
        $companyService = new CompanyService();
        $CompanyDao = new CompanyDao();
        $userCulture = $this->getUser()->getCulture();

        $ActhieCode = $request->getParameter('wst');
        $name = array();
        $levelname = array();
        $Actdivision = $companyService->readCompanyStructure($ActhieCode);
        $ActdefLevel = $Actdivision->getDefLevel();
        while ($ActdefLevel > 0 && $ActhieCode > 0) {

            $ActhieCode = $Actdivision->getParnt();
            if ($userCulture == "en") {
                $name[] = $Actdivision['title'];
            } else {
                $Title = 'title_' . $userCulture;
                if ($Actdivision[$Title] == "") {
                    $name[] = $Actdivision['title'];
                } else {
                    $name[] = $Actdivision[$Title];
                }
            }
            $Levelofdivition = $CompanyDao->getDefLevelDetals($Actdivision['def_level']);
            if ($userCulture == "en") {
                $levelname[] = $Levelofdivition[0]->getDef_name();
            } else {
                $deflevel = 'getDef_name_' . $userCulture;
                if ($Levelofdivition[0]->$deflevel() == "") {
                    $levelname[] = $Levelofdivition[0]->getDef_name();
                } else {
                    $levelname[] = $Levelofdivition[0]->$deflevel();
                }
            }


            $Actdivision = $companyService->readCompanyStructure($ActhieCode);

            $ActdefLevel = $ActdefLevel - 1;
        }
        echo json_encode(array("name1" => $name[0], "name2" => $name[1], "name3" => $name[2], "name4" => $name[3], "name5" => $name[4], "name6" => $name[5], "name7" => $name[6], "name8" => $name[7], "name9" => $name[8], "name10" => $name[9], "nameLevel1" => $levelname[0], "nameLevel2" => $levelname[1], "nameLevel3" => $levelname[2], "nameLevel4" => $levelname[3], "nameLevel5" => $levelname[4], "nameLevel6" => $levelname[5], "nameLevel7" => $levelname[6], "nameLevel8" => $levelname[7], "nameLevel9" => $levelname[8], "nameLevel10" => $levelname[9]));
        die;
    }
    
  public function executeLoadGradeSlot(sfWebRequest $request) {

        $this->Culture = $this->getUser()->getCulture();
        $jobDao=new JobDao();

        $id = $request->getParameter('id');
        $Slot = $jobDao->getGradeSlotByID($id);
        $arr = Array();
        foreach ($Slot as $row) {

            $arr[]=$row->grade_code."|".$row->slt_scale_year."|".$row->slt_amount."|".$row->emp_basic_salary."|".$row->slt_id;
        }

        echo json_encode($arr);
        die;
    }   
    
        public function executeSearchEmployee(sfWebRequest $request) {
        try {

            $this->userCulture = $this->getUser()->getCulture();
            $ReinstatementService = new ReinstatementService();

            $this->type = $request->getParameter('type', isset($_SESSION["type"]) ? $_SESSION["type"] : 'single');
            $this->method = $request->getParameter('method', isset($_SESSION["method"]) ? $_SESSION["method"] : '');
            
            $reason = $request->getParameter('reason');
            if (strlen($reason)) {
                $this->reason = $reason;
            } else {
                $this->reason = '';
            }

            $att = $request->getParameter('att');
            if (strlen($att)) {
                $this->att = $att;
            } else {
                $this->att = '';
            }
            
            //payroll
            $payroll = $request->getParameter('payroll');
            if (strlen($payroll)) {
                $this->payroll = $payroll;
            } 
            else {
                $this->payroll = '';
            }
            
            
            $this->sort = ($request->getParameter('payroll') == '') ? $_SESSION["payroll"] : $request->getParameter('payroll');
            
            //Store in session to support sorting
            $_SESSION["type"] = $this->type;
            $_SESSION["method"] = $this->method;
            $_SESSION["payroll"] = $this->payroll;
            
            

            $this->sorter = new ListSorter('propoerty.sort', 'disciplinary', $this->getUser(), array('emp_number', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'e.emp_number' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $ReinstatementService->searchEmployee($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order, $this->type, $this->method, $this->reason, $this->att,$this->payroll);

            $this->listEmployee = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        } catch (sfStopException $sf) {
            $this->redirect('disciplinary/searchEmployee');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('disciplinary/searchEmployee');
        }
    }
}
