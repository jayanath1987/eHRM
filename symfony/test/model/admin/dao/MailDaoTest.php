<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test cases for MailDao
 *
 * @author Sujith T
 */
class MailDaoTest extends PHPUnit_Framework_TestCase {
   private $testCases;
	private $mailDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/mail.yml');
		$this->mailDao	=	new MailDao();
	}

   /**
    * test saveMailNotification
    */
   public function testSaveMailNotification() {
      $userService = new UserService();

      foreach($this->testCases['MailNotification'] as $k => $v) {
         $user = new Users();
         $user->setUserName("name" . rand(1, 1000));
         $user->setIsAdmin(1);
         $user->setUserPassword("pass" . rand(1, 1000));
         $userService->saveUser($user);

         $obj = new MailNotification();
         $obj->setUserId($user->getId());
         $obj->setNotificationTypeId($v['typeId']);
         $obj->setStatus($v['status']);
         $result = $this->mailDao->saveMailNotification($obj);
         $this->assertTrue($result);
         $this->testCases['MailNotification'][$k]['userId'] = $user->getId();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/mail.yml',sfYaml::dump($this->testCases));
   }

   /**
    * test getMailNotificationList
    */
   public function testGetMailNotificationList() {
      foreach($this->testCases['MailNotification'] as $k => $v) {
         $arr = $this->mailDao->getMailNotificationList($v['userId']);
         $this->assertTrue(is_array($arr));
      }
   }

   /**
    * test deleteMailNotification
    */
   public function testDeleteMailNotification() {
      $userService = new UserService();
      foreach($this->testCases['MailNotification'] as $k => $v) {
         $result = $this->mailDao->deleteMailNotification($v['userId']);
         $this->assertTrue($result);

         $userService->deleteUser(array($v['userId']));
      }
   }
}
?>
