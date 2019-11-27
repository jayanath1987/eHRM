<?php
require_once 'PHPUnit/Framework.php';

class EmailServiceTest extends PHPUnit_Framework_TestCase{
	
	private $mailService;	
	/**
     * PHPUnit setup function
     */
    public function setup() {
    	$this->mailService = new EmailService();	
    }
    
    public function testSendMail()
    {
        $emails = array('P_pgdesigninggmail.com','priyantha-isupgdesigning.com', 'priyantha@pgdesigning.com','', 'test');
        if(! $emails = $this->mailService->checkValidEmails($emails, __FUNCTION__)){
           return false;
        }else{
            $this->mailService->setTo($emails);
            $this->mailService->setSubject("Messahe using the test - subject");
            $this->mailService->setMailBody("Message using test body");
            $result	=	$this->mailService->sendMail();
            $this->assertTrue($result);

        }
    }

    
}