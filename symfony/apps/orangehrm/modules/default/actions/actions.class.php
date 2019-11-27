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
 * Actions class for Default module
 *
 *-------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 27 July 2011
 *  Comments  - Description on module action what is happen in the code 
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
**/

include ('../../lib/common/LocaleUtil.php');
require_once ROOT_PATH . '/symfony/lib/vendor/PHPMailer/class.phpmailer.php';
require_once ROOT_PATH . '/webservice/ICTASMS.php'; 
class defaultActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        //$this->forward('default', 'module');

        if ($request->getParameter('ln')) {

            $userDao = new userDao();

            $userId = $_SESSION['user'];

            $getUserbyID = $userDao->readUser($userId);

            $getUserbyID->setUser_prefered_language($request->getParameter('ln'));

            try {
                 $userDao->saveUser($getUserbyID);
            } catch (sfStopException $sf) {
                
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());

                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('pim/personalDetail');
            } catch (Exception $e) {

                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('pim/personalDetail');
            } 
            $_SESSION['language'] = $request->getParameter('ln');
            $this->getUser()->setCulture($request->getParameter('ln'));

            //echo "<script>document.write(window.history.previous.href);</script>";

            die;
        }

        header("Location: ../../../../index.php?lnc=yes"); //die;
        ob_flush();
        die();
    }

    public function executeError404(sfWebRequest $request) {
        die("404");
    }

    /**
     * Warning page for restricted area - requires login
     */
    public function executeSecure() {

    }

    /**
     * Error page
     */
    public function executeError() {

    }
    public function executeAccessDenied() {

    }


    public function executeLanugaeTranslator(sfWebRequest $request) {



        $sysConf=new sysConf();

        $serviceStatus=$sysConf->getLangTransStatus();

        if($serviceStatus=="ON"){
        

        $client = new soapclient($sysConf->getLangTransUrl());

        $inputName = $request->getParameter('inputName');
        $currentLang=$request->getParameter('currentLan');
        $sourceLanguage = $request->getParameter('sourceLanguage');
        // $targetLanguage=$request->getParameter('targetLanguage');
        $gender = "U";
        
        $sinhala = $client->transliterate(array('InputName' => $inputName, 'SourceLanguage' => $sourceLanguage, 'TargetLanguage' => 1, 'Gender' => $gender));
        $tamil = $client->transliterate(array('InputName' => $inputName, 'SourceLanguage' => $sourceLanguage, 'TargetLanguage' => 2, 'Gender' => $gender));
        $english=$client->transliterate(array('InputName' => $inputName, 'SourceLanguage' => $sourceLanguage, 'TargetLanguage' => 3, 'Gender' => $gender));

        if($currentLang=="E"){
            echo json_encode(array('sinhala' => $sinhala->return, 'tamil' => $tamil->return));
        }elseif($currentLang=="S"){
            echo json_encode(array('english' => $english->return, 'tamil' => $tamil->return));
        }else
            echo json_encode(array('sinhala' => $sinhala->return, 'english' => $english->return));
        die;
        }else{
            
        die;
        }
    }

    public function executeButtonSecurityCommon(sfWebRequest $request) {

      
        //$currentValidMenuId=$_SESSION['validCurrnetMenuID'];
        $currentValidMenuId=$_SESSION['currentMenuID'];
            
            $userDao = new userDao();
            
           
            $getButtonsecurity = $userDao->getButtonSecurity($currentValidMenuId);



            echo json_encode(array('save' => $getButtonsecurity[0][mnucapability]['sm_mnucapa_save'], 'add' => $getButtonsecurity[0][mnucapability]['sm_mnucapa_add'],'edit'=>$getButtonsecurity[0][mnucapability]['sm_mnucapa_edit'],'deleteb'=>$getButtonsecurity[0][mnucapability]['sm_mnucapa_delete']));

            die;

   
       
    }
    public function executeLoadonHoverImage(sfWebRequest $request){
        
    }
    public function executePermissionDenind(sfWebRequest $request){

    }
    public function executeTransLateText(sfWebRequest $request){
        
        $text=$request->getParameter('text');
        $string=$this->getContext()->getI18N()->__($text, $args, 'messages');
        echo json_encode($string);
            
        die;
        
    }
    
    public function executeSendEmail(sfWebRequest $request) { //die($request->getParameter('message'));

        
        $TO = $request->getParameter('TO');
        $CC = $request->getParameter('CC');
        $Subject = $request->getParameter('Subject');
        $Message = $request->getParameter('Message');
        
      //die(print_r($TO.$CC.$Subject.$Message));  
        $sysconf = new sysConf();   
        if($sysconf->EmailSend == "YES"){
        $mail = new PHPMailer();
        
        
			
	$mail->IsSMTP();                                        // set mailer to use SMTP
	$mail->Host = $sysconf->EmailHost;                      // specify main and backup server
	$mail->SMTPAuth = true;                                 // turn on SMTP authentication
        $mail->Username = $sysconf->EmailUsername;              // Make sure to replace this with your shell enabled user
        $mail->Password = $sysconf->EmailPassword;              // Make sure to use the proper password for your user
        
 		
	$mail->From = $sysconf->EmailFrom;
	$mail->FromName = $sysconf->EmailName;
        $mail->AddReplyTo($sysconf->EmailReplyToEmail, $sysconf->EmailReplyToName);
        
        
        
///	$mail->AddAddress("jayanath1987@gmail.com", "Jayanath");
///        $mail->AddCC("jayanathl@icta.lk","Jayanath");
///        $mail->AddCC("kasunr@icta.lk","Jayanath");
///	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
///	$mail->IsHTML(true);                                  // set email format to HTML			
///	$mail->Subject = "Commonhrm";
///	$mail->Body    = "This is a test of Commonhrm email";        
        
        $mail->AddAddress($TO);
        $mail->AddCC($CC);
			
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML
			
        $mail->Subject = $Subject;
	$mail->Body    = $Message;
        
        
						
	if(!$mail->Send()){
		die("Message could not be sent.");
		exit;
	}else{
                die("Message sent Successfully.");
                exit;
        }
        }

    }  
    
    
    
   public function executeSendSMS(sfWebRequest $request) {
       

       
//      $TO = $request->getParameter('mobile');
//      $From = $request->getParameter('deptcode');
//      $Message = $request->getParameter('Message');
        
      $TO="0716439452";
      $From="CommonHRM";
      $Message="Hi, You have a approve on Leave Mr.Jayanath3";
      
      $ICTASMS = new ICTASMS();
      $result=$ICTASMS->sendsms(array("recepient"=>$TO,"message"=>$Message));
      die(print_r($result)); 
      
   } 
   public function executeReadEmployeeNotification(sfWebRequest $request){
         //$empnumber=$request->getParameter('empnumber');
        if($_SESSION['empNumber']!= null){
        $sysConig = new sysConf();
        if($sysConig->EmployeeNotificationStatus == "ON"){
            $DefaultDao = new DefaultDao();
            $notifications=$DefaultDao->readReadEmployeeNotification($_SESSION['empNumber']);
            die(print_r($notifications));
        }
        }
   }
   
   public function executeListNotification(sfWebRequest $request) {

        try {
            $this->Culture = $this->getUser()->getCulture();
            $DefaultDao = new DefaultDao();

//            $this->sorter = new ListSorter('ListJobProgress', 'pim', $this->getUser(), array('n.not_id', ListSorter::ASCENDING));
//            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('default/ListNotification');
                }
                $this->var = 1;
            }

            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'n.not_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'DESC' : $request->getParameter('order');
            
            $this->emp = ($request->getParameter('txtEmpId') == null) ? $request->getParameter('emp') : $_POST['txtEmpId'];
            $this->type = ($request->getParameter('txtType') == null) ? $request->getParameter('type') : $_POST['txtType'];
            
            $res = $DefaultDao->ListNotification($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'), $this->emp, $this->type);
            $this->NotificationList = $res['data'];
            //die(print_r($this->NotificationList));
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
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
    
    public function executeAjaxApprove(sfWebRequest $request) {


        $id = $request->getParameter('ev_id');
        
        $DefaultDao = new DefaultDao();
        $NotificationEmployee = $DefaultDao->readJobProgress($id);
        $NotificationEmployee->setStatus(1);
        $NotificationEmployee->save();
        
        echo json_encode("Successfully Updated");
        die;
    }
    
}
