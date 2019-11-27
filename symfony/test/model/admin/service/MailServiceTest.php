<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test cases for MailDao
 *
 * @author Sujith T
 */
class MailServiceTest extends PHPUnit_Framework_TestCase {
   private $mailDao;
   private $testCases;
   private $mailService;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/mail.yml');
		$this->mailService	=	new MailService();
	}

   /**
    * test saveMailNotification
    */
   public function testSaveMailNotification() {
      foreach($this->testCases['MailNotification'] as $k => $v) {
         $obj = new MailNotification();
         $obj->setUserId($v['userId']);
         $obj->setNotificationTypeId($v['typeId']);
         $obj->setStatus($v['status']);

         $this->mailDao  =	$this->getMock('MailDao');
         $this->mailDao->expects($this->once())
               ->method('saveMailNotification')
               ->will($this->returnValue(true));
         $this->mailService->setMailDao($this->mailDao);
         $result = $this->mailService->saveMailNotification($obj);
         $this->assertTrue($result);
      }
   }

   /**
    * test getMailNotificationList
    */
   public function testGetMailNotificationList() {
      foreach($this->testCases['MailNotification'] as $k => $v) {
         $this->mailDao  =	$this->getMock('MailDao');
         $this->mailDao->expects($this->once())
               ->method('getMailNotificationList')
               ->will($this->returnValue(array()));
         $this->mailService->setMailDao($this->mailDao);
         $result = $this->mailService->getMailNotificationList($v['userId']);
         $this->assertTrue(is_array($result));
      }
   }

   /**
    * test deleteMailNotification
    */
   public function testDeleteMailNotification() {
      foreach($this->testCases['MailNotification'] as $k => $v) {
         $this->mailDao  =	$this->getMock('MailDao');
         $this->mailDao->expects($this->once())
               ->method('deleteMailNotification')
               ->will($this->returnValue(true));
         $this->mailService->setMailDao($this->mailDao);
         $result = $this->mailService->removeMailNotification($v['userId']);
         $this->assertTrue($result);
      }
   }
}
?>
