<?php

/**
 * knw actions.
 *
 * @package    orangehrm
 * @subpackage Knowledge Base (KNW)
 * @author     JBL
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
//require_once '../../lib/common/LocaleUtil.php';
include ('../../lib/common/LocaleUtil.php');

class knwActions extends sfActions {

    public function executeDocumentType(sfWebRequest $request) {

        try {
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];
            $knwDao = new knwDao();

            $this->sorter = new ListSorter('DocumentType', 'knw', $this->getUser(), array('b.knw_doc_id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('knw/DocumentType');
                }
                $this->var = 1;
            }
            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'b.knw_doc_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $knwDao->searchDocumentType($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->knwdoctype = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveDocumentType(sfWebRequest $request) {
        $this->myCulture = $this->getUser()->getCulture();
        $knwDao = new knwDao();
        $knwdt = new KNWDocumentType();
        if ($request->isMethod('post')) {
            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setKnw_doc_name(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setKnw_atd_title(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setKnw_doc_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setKnw_doc_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setKnw_doc_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setKnw_doc_name_ta(null);
            }

            try {
                $knwDao->saveDocumentType($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/DocumentType');
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/DocumentType');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/DocumentType');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
            $this->redirect('knw/DocumentType');
        }
    }

    public function executeUpdateDocumentType(sfWebRequest $request) {
        //Table Lock code is Open


        if (!strlen($request->getParameter('lock'))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $request->getParameter('lock');
        }
        $transPid = $request->getParameter('id');
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_knw_doctype', array($transPid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {//dir("hgf");
                $conHandler = new ConcurrencyHandler();
                $recordLocked = $conHandler->resetTableLock('hs_hr_knw_doctype', array($transPid), 1);
                $this->lockMode = 0;
            }
        }

        //Table lock code is closed
        $this->myCulture = $this->getUser()->getCulture();
        $knwDao = new knwDao();
        $knwdt = new KNWDocumentType();

        $knwdt = $knwDao->readDocumentType($request->getParameter('id'));
        if (!$knwdt) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('knw/DocumentType');
        }

        $this->benifittypelist = $knwdt;
        if ($request->isMethod('post')) {
            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setKnw_doc_name(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setKnw_atd_title(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setKnw_doc_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setKnw_doc_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setKnw_doc_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setKnw_doc_name_ta(null);
            }
            try {
                $knwDao->saveDocumentType($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/UpdateDocumentType?id=' . $knwdt->getKnw_doc_id() . '&lock=0');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/UpdateDocumentType?id=' . $knwdt->getKnw_doc_id() . '&lock=0');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('knw/UpdateDocumentType?id=' . $knwdt->getKnw_doc_id() . '&lock=0');
        }
    }

    public function executeDeleteDocumentType(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $knwDao = new knwDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_knw_doctype', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $knwDao->deleteDocumentType($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_knw_doctype', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/DocumentType');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/DocumentType');
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
        $this->redirect('knw/DocumentType');
    }

    public function executeAttachment(sfWebRequest $request) {

        try {
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];
            $knwDao = new knwDao();

            $this->sorter = new ListSorter('DocumentType', 'knw', $this->getUser(), array('b.knw_atd_id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('knw/Attachment');
                }
                $this->var = 1;
            }

            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'b.knw_atd_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $knwDao->searchAttachment($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->knwAttachment = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeUpdateAttachment(sfWebRequest $request) {
        //Table Lock code is Open

        $i = 0;
        if (!strlen($request->getParameter('lock'))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $request->getParameter('lock');
        }
        $transPid = $request->getParameter('id');
        $transDid = $request->getParameter('did');
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_knw_attach_details', array($transPid, $transDid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                    $i = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                    $i = 1;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $recordLocked = $conHandler->resetTableLock('hs_hr_knw_attach_details', array($transPid, $transDid), 1);
                $this->lockMode = 0;
                $i = 1;
            }
        }

        //Table lock code is closed
        $this->myCulture = $this->getUser()->getCulture();
        $knwDao = new knwDao();
        $this->prm = new knwDao();
        $knwdt = new KNWDocumentType();
        $this->Doctype = $knwDao->getDoctype();

        $knwdt = $knwDao->readAttachment($request->getParameter('id'), $request->getParameter('did'));
        if (!strlen($request->getParameter('id')) || !strlen($request->getParameter('did'))) {

            $this->redirect('knw/Attachment');
        }
        if (!$knwdt) {
            $this->redirect('knw/Attachment');
        }

        $this->benifittypelist = $knwdt;
        if ($request->isMethod('post')) {

            try {
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();

                if (array_key_exists('txtletter', $_FILES)) {
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



                $fileName = $_FILES['txtletter']['name'];
                $tmpName = $_FILES['txtletter']['tmp_name'];
                $fileSize = $_FILES['txtletter']['size'];
                $fileType = $_FILES['txtletter']['type'];

                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();
                $maxFileSizeDis = $sysConfs->getMaxFileSizeDis();
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();
                //     $maxsize = 5242880;
                if ($fileSize > $maxFileSizeDis) {
                    throw new Exception("Maxfile size  Should be less than 10MB", 1);
                }
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
            }

            $fp = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            $content = addslashes($content);

            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setKnw_atd_title(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setKnw_atd_title(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setKnw_atd_title_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setKnw_atd_title_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setKnw_atd_title_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setKnw_atd_title_ta(null);
            }


            $kwe = $request->getParameter('txtkeyword');
            $delimiter = ",";
            $kwe1 = explode($delimiter, $kwe);
            foreach ($kwe1 as $kwer) {
                $kwec = $kwec . $kwer . " ";
            }
            $knwdt->setKnw_atd_keyword($kwec);

            $kws = $request->getParameter('txtkeywordsi');
            $kws1 = explode($delimiter, $kws);
            foreach ($kws1 as $kwsr) {
                $kwsc = $kwsc . $kwsr . " ";
            }
            $knwdt->setKnw_atd_keyword_si($kwsc);

            $kwt = $request->getParameter('txtkeywordta');
            $kwt1 = explode($delimiter, $kwt);
            foreach ($kwt1 as $kwtr) {
                $kwtc = $kwtc . $kwtr . " ";
            }
            $knwdt->setKnw_atd_keyword_ta($kwtc);
            if($request->getParameter('effdate')!= null){
            $knwdt->setKnw_atd_update_date(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('effdate')));
            }else{
             $knwdt->setKnw_atd_update_date(null);
            }
            try {
                $knwDao->saveAttachment($knwdt);
                if (strlen($content)) {

                    $caprmid = $knwDao->readattach($request->getParameter('id'), $request->getParameter('did'));
                    foreach ($caprmid as $rowca) {
                        if ($rowca['count'] == 1) {
                            $abcc = $knwDao->updatch($request->getParameter('id'), $request->getParameter('did'));
                            $Prmattach = new KNWAttachment();
                            $Prmattach->setKnw_atd_id($request->getParameter('id'));
                            $Prmattach->setKnw_doc_id($request->getParameter('did'));
                            $Prmattach->setKnw_att_filename($fileName);
                            $Prmattach->setKnw_att_type($fileType);
                            $Prmattach->setKnw_att_size($fileSize);
                            $Prmattach->setKnw_att_attachment($content);

                            $knwDao->saveNewAttachment($Prmattach);
                        } else {
                            $Prmattach = new KNWAttachment();
                            $Prmattach->setKnw_atd_id($request->getParameter('id'));
                            $Prmattach->setKnw_doc_id($request->getParameter('did'));
                            $Prmattach->setKnw_att_filename($fileName);
                            $Prmattach->setKnw_att_type($fileType);
                            $Prmattach->setKnw_att_size($fileSize);
                            $Prmattach->setKnw_att_attachment($content);

                            $knwDao->saveNewAttachment($Prmattach);
                        }
                    }
                }
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/UpdateAttachment?id=' . $request->getParameter('id') . '&did=' . $request->getParameter('did') . '&lock=0');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/UpdateAttachment?id=' . $request->getParameter('id') . '&did=' . $request->getParameter('did') . '&lock=0');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('knw/UpdateAttachment?id=' . $request->getParameter('id') . '&did=' . $request->getParameter('did') . '&lock=0');
        }
    }

    public function executeImagepop(sfWebRequest $request) {

        $knwDao = new knwDao();
        $attachment = $knwDao->getAttachdetails($request->getParameter('id'), $request->getParameter('did'));
        $desired_width = 75;
        $desired_height = 75;
        $outname = stripslashes($attachment[0]['knw_att_attachment']);
        $type = stripslashes($attachment[0]['knw_att_type']);
        $name = stripslashes($attachment[0]['knw_att_filename']);
        header("Content-type:" . $type);
        header('Content-disposition: attachment; filename=' . $name);
        echo($outname);
        exit;
    }

    public function executeDeletepop(sfWebRequest $request) {

        $knwDao = new knwDao();
        $attachment = $knwDao->deleteAttach($request->getParameter('id'), $request->getParameter('did'));
        $this->redirect('knw/UpdateAttachment?id=' . $request->getParameter('id') . '&did=' . $request->getParameter('did') . '&lock=0');
    }

    public function setMessage($messageType, $message = array(), $persist=true) {
        $this->getUser()->setFlash('messageType', $messageType, $persist);
        $this->getUser()->setFlash('message', $message, $persist);
    }

    public function executeSaveAttachment(sfWebRequest $request) {
        $this->myCulture = $this->getUser()->getCulture();
        $knwDao = new knwDao();
        $knwdt = new KNWAttachmentDetails();
        $this->Doctype = $knwDao->getDoctype();
        //Max
        $this->maxretid = $knwDao->readmaxretid();
        $this->retid = $this->maxretid[0]['MAX'] + 1;

        if ($request->isMethod('post')) {

            try {
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();

                if (array_key_exists('txtletter', $_FILES)) {
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


                $fileName = $_FILES['txtletter']['name'];
                $tmpName = $_FILES['txtletter']['tmp_name'];
                $fileSize = $_FILES['txtletter']['size'];
                $fileType = $_FILES['txtletter']['type'];

                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();
                $maxFileSizeDis = $sysConfs->getMaxFileSizeDis();
                $sysConfinst = OrangeConfig::getInstance()->getSysConf();
                $sysConfs = new sysConf();
                //$maxsize2 = 5242880;
                if ($fileSize > $maxFileSizeDis) {

                    throw new Exception("Maxfile size  Should be less than 10MB", 1);
                }
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
            }

            $fp = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            $content = addslashes($content);

            $knwdt->setKnw_atd_id($this->retid);
            $knwdt->setKnw_doc_id($request->getParameter('txtdoctype'));
            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setKnw_atd_title(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setKnw_atd_title(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setKnw_atd_title_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setKnw_atd_title_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setKnw_atd_title_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setKnw_atd_title_ta(null);
            }
            if (strlen($request->getParameter('txtkeyword'))) {
                $kwe = $request->getParameter('txtkeyword');
                $delimiter = ",";
                $kwe1 = explode($delimiter, $kwe);
                foreach ($kwe1 as $kwer) {
                    $kwec = $kwec . $kwer . " ";
                }
                $knwdt->setKnw_atd_keyword($kwec);
            } else {
                $knwdt->setKnw_atd_keyword(null);
            }
            if (strlen($request->getParameter('txtkeywordsi'))) {
                $kws = $request->getParameter('txtkeywordsi');
                $kws1 = explode($delimiter, $kws);
                foreach ($kws1 as $kwsr) {
                    $kwsc = $kwsc . $kwsr . " ";
                }
                $knwdt->setKnw_atd_keyword_si($kwsc);
            } else {
                $knwdt->setKnw_atd_keyword_si(null);
            }
            if (strlen($request->getParameter('txtkeywordta'))) {
                $kwt = $request->getParameter('txtkeywordta');
                $kwt1 = explode($delimiter, $kwt);
                foreach ($kwt1 as $kwtr) {
                    $kwtc = $kwtc . $kwtr . " ";
                }
                $knwdt->setKnw_atd_keyword_ta($kwtc);
            } else {
                $knwdt->setKnw_atd_keyword_ta(null);
            }
            if($request->getParameter('effdate')!= null){
            $knwdt->setKnw_atd_post_date(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('effdate')));
            }else{
             $knwdt->setKnw_atd_post_date(null);
            }
            $Prmattach = new KNWAttachment();
            $Prmattach->setKnw_atd_id($this->retid);
            $Prmattach->setKnw_doc_id($request->getParameter('txtdoctype'));
            $Prmattach->setKnw_att_filename($fileName);
            $Prmattach->setKnw_att_type($fileType);
            $Prmattach->setKnw_att_size($fileSize);
            $Prmattach->setKnw_att_attachment($content);




            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $knwDao->saveAttachment($knwdt);
                $knwDao->saveNewAttachment($Prmattach);
                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollback();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
            } catch (Exception $e) {
                $conn->rollback();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
            $this->redirect('knw/Attachment');
        }
    }

    public function executeDeleteAttachment(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $knwDao = new knwDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();

                $countArr = array();
                $saveArr = array();
                $splitcontents = $request->getParameter('chkLocID');
                foreach ($splitcontents as $row) {
                    $delimiter = "|";
                    $column = explode($delimiter, $row);
                    $id = $column[0];
                    $did = $column[1];
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_knw_attach_details', array($column[0], $column[1]), 1);
                    if ($isRecordLocked) {

                        $countArr = $column[0];
                    } else {
                        $saveArr = $column[0];
                        $knwDao->deleteAttach($column[0], $column[1]);
                        $knwDao->deleteAttachmentrec($column[0], $column[1]);

                        $conHandler->resetTableLock('hs_hr_knw_attach_details', array($column[0], $column[1]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
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
        $this->redirect('knw/Attachment');
    }

    public function executeKnowledgebase(sfWebRequest $request) {

        try {
            $this->knwDao = new knwDao();
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];
            $knwDao = new knwDao();
            $this->Doctype = $knwDao->getDoctype();
            $this->sorter = new ListSorter('Knowledgebase', 'knw', $this->getUser(), array('b.knw_atd_post_date', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('wbm/BenifitType');
                }
                $this->var = 1;
            }
            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');
            $this->searchValue1 = ($request->getParameter('searchValue1') == null) ? '' : $request->getParameter('searchValue1');
            $this->sort = ($request->getParameter('sort') == '') ? 'b.knw_atd_post_date' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $knwDao->searchknw($this->searchMode, $this->searchValue, $this->searchValue1, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->knwdoctype = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveArticle(sfWebRequest $request) {
        $knwDao = new knwDao();
        $this->knwDao = new knwDao();
        $this->Culture = $this->getUser()->getCulture();

        //Max
        $this->maxretid = $knwDao->readmaxretid();
        $this->retid = $this->maxretid[0]['MAX'] + 1;

        if ($request->isMethod('post')) {

            $knwdt = new KNWAttachmentDetails();
            $knwdt->setKnw_atd_id($this->retid);
            $knwdt->setKnw_doc_id(1);
            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setKnw_atd_title(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setKnw_atd_title(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setKnw_atd_title_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setKnw_atd_title_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setKnw_atd_title_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setKnw_atd_title_ta(null);
            }

            $kwe = $request->getParameter('txtkeyword');
            $delimiter = ",";
            $kwe1 = explode($delimiter, $kwe);
            foreach ($kwe1 as $kwer) {
                $kwec = $kwec . $kwer . " ";
            }
            $knwdt->setKnw_atd_keyword($kwec);

            $kws = $request->getParameter('txtkeywordsi');
            $kws1 = explode($delimiter, $kws);
            foreach ($kws1 as $kwsr) {
                $kwsc = $kwsc . $kwsr . " ";
            }
            $knwdt->setKnw_atd_keyword_si($kwsc);

            $kwt = $request->getParameter('txtkeywordta');
            $kwt1 = explode($delimiter, $kwt);
            foreach ($kwt1 as $kwtr) {
                $kwtc = $kwtc . $kwtr . " ";
            }
            $knwdt->setKnw_atd_keyword_ta($kwtc);

            $knwdt->setKnw_atd_post_date(date('Y-m-d', time()));


            $Prmattach = new KNWAttachment();
            $Prmattach->setKnw_atd_id($this->retid);
            $Prmattach->setKnw_doc_id(1);
            $Prmattach->setKnw_att_filename("Article");
            $Prmattach->setKnw_att_type("Article");
            $Prmattach->setKnw_att_size(null);
            $Prmattach->setKnw_att_attachment(null);
            $Prmattach->setKnw_att_article(trim($request->getParameter('txtbody')));



            try {
                $knwDao->saveAttachment($knwdt);
                $knwDao->saveNewAttachment($Prmattach);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('knw/Attachment');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
            $this->redirect('knw/Attachment');
        }
    }

    public function executeReadArticle(sfWebRequest $request) {

        $knwDao = new knwDao();
        $attachment = $knwDao->getAttachdetails($request->getParameter('id'), $request->getParameter('did'));
        $this->benifittypelist = $knwDao->readAttachment($request->getParameter('id'), $request->getParameter('did'));
    }

    public function executeError(sfWebRequest $request) {

        $this->redirect('default/error');
    }

}

?>
