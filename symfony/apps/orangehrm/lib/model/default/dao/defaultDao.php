<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 26 July 2011
 *  Comments  - Disciplinary Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

require_once ROOT_PATH . '/symfony/lib/vendor/PHPMailer/class.phpmailer.php';
class DefaultDao extends BaseDao {
   function get_breadcrumb($node, $culture="") {
       

        $q = Doctrine_Query::create()
                        ->from('menuitem m')
                        ->where("m.sm_mnuitem_id = ?", $node);
       

        $row = $q->fetchArray();
        //die(print_r($row));
    
        $path = array();

        
        if ($row[0]['sm_mnuitem_parent'] != 0) {
           
            if ($culture == "si") {
                $title1 = $row[0]['sm_mnuitem_name_si'];
                if($title1==""){
                $path[] = $row[0]['sm_mnuitem_name'];
            }else{
                $path[] = $row[0]['sm_mnuitem_name_si'];
            }

               
            } elseif ($culture == "ta") {
                 
                $title2 = $row[0]['sm_mnuitem_name_ta'];
                if($title2==""){
                $path[] = $row[0]['sm_mnuitem_name'];
            }
            else{
                $path[] = $row[0]['sm_mnuitem_name_ta'];
            }
            } else {
                                 
                $path[] = $row[0]['sm_mnuitem_name'];

            }


            $path = array_merge($this->get_breadcrumb($row[0]['sm_mnuitem_parent'], $culture), $path);
           
        }else{
           if ($culture == "si") {
                $title1 = $row[0]['sm_mnuitem_name_si'];
                if($title1==""){
                $path[] = $row[0]['sm_mnuitem_name'];
            }else{
                $path[] = $row[0]['sm_mnuitem_name_si'];
            }

               
            } elseif ($culture == "ta") {
                 
                $title2 = $row[0]['sm_mnuitem_name_ta'];
                if($title2==""){
                $path[] = $row[0]['sm_mnuitem_name'];
            }
            else{
                $path[] = $row[0]['sm_mnuitem_name_ta'];
            }
            } else {
                                 
                $path[] = $row[0]['sm_mnuitem_name'];

            }
             //$path = array_merge($this->get_breadcrumb($row[0]['sm_mnuitem_parent'], $culture), $path);
        }

       
        return $path;
    }
    
    
        
    public function sendEmail($Message,$TO,$CC,$Subject) { 

      
        $TO = $TO;
        $CC = $CC;
        $Subject = $Subject;
        
//        $headers['Content-Type'] = "text/plain; charset=utf-8";
//        $headers['Content-Transfer-Encoding'] = "8bit";
//        $Subject = "=?UTF-8?B?" . base64_encode($Subject) . "?=";

    
        $Message = $Message;
        
//          die(print_r("to-".$TO."cc-".$CC."subject-".$Subject."message-".$Message));  
        $sysconf = new sysConf();   
        if($sysconf->EmailSend == "YES"){
        $mail = new PHPMailer();
        
//        $headers .= "MIME-Version: 1.0\r\n";
//	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        
			
	$mail->IsSMTP();                                        // set mailer to use SMTP
	$mail->Host = $sysconf->EmailHost;                      // specify main and backup server
	$mail->SMTPAuth = true;                                 // turn on SMTP authentication
        $mail->Username = $sysconf->EmailUsername;              // Make sure to replace this with your shell enabled user
        $mail->Password = $sysconf->EmailPassword;              // Make sure to use the proper password for your user
        
 		
	$mail->From = $sysconf->EmailFrom;
	$mail->FromName = $sysconf->EmailName;
        $mail->AddReplyTo($sysconf->EmailReplyToEmail, $sysconf->EmailReplyToName);
        
        
        
//	$mail->AddAddress("jayanath1987@gmail.com", "Jayanath");
//        $mail->AddCC("jayanathl@icta.lk","Jayanath");
//        $mail->AddCC("kasunr@icta.lk","Jayanath");
//	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//	$mail->IsHTML(true);                                  // set email format to HTML			
//	$mail->Subject = "Commonhrm";
//	$mail->Body    = "This is a test of Commonhrm email";        
        //die(print_r($CC));
        $mail->AddAddress($TO);
//        foreach ($CC as $row){
//            die(print_r($CC ));
//        $mail->AddCC($row);
//        }
        $mail->AddCC($CC[0]);
        $mail->AddCC($CC[1]);
        $mail->AddCC($CC[2]);
//			
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML
			
        $mail->Subject = $Subject;
	$mail->Body    = $Message;
        $mail->CharSet = 'UTF-8';
        $mail->ContentType = 'text/html';
//        die(print_r($mail));
        
						
	if(!$mail->Send()){
//		die("Message could not be sent.");
		exit;
                return true;
	}else{
//                die("Message sent Successfully.");
                return true;
                exit;
        }
        }
    }      
function readReadEmployeeNotification($empnumber) {
         
       $q = Doctrine_Query::create()
            ->select("n.*")  
           ->from('NotificationEmployee n')
           ->where("n.emp_number = ?", $empnumber)
           ->Andwhere("n.status = 0");    
       

        return $q->execute();
     }
     
     public function ListNotification($searchMode, $searchValue, $culture="en", $orderField = 'n.not_id ', $orderBy = 'DESC', $page = 1,  $emp, $type) {
        if($emp){
            //$emp = str_replace("_",',',$emp);
        }
          

       $q = Doctrine_Query::create()
           ->select("n.*")      
           ->from('NotificationEmployee n')
           ->where("n.emp_number = ".$emp)
           ->Andwhere("n.status = 0");  

        $q->orderBy($orderField . ' ' . $orderBy);
       //die(print_r($q->fetchArray())); 
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
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
    public function readJobProgress($id) {
        return Doctrine::getTable('NotificationEmployee')->find($id);
    } 
        public function getemployeeNotificationlCount($emp) {
        $q = Doctrine_Query::create()
                        ->select('count(l.not_id)')
                        ->from('NotificationEmployee l')
                        ->where('l.emp_number = ?', $emp)
                        ->andwhere('l.status = 0');
        return $q->fetchArray();
    }  
    
    public function employeeNotification($id) {
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('NotificationEmployee r')
                        ->where('r.emp_number = ?', $id)
                        ->andwhere('r.status = 0');

        return $q->fetchArray();
	}



}

?>
