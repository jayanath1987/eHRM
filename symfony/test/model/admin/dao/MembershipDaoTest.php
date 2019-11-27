<?php
require_once 'PHPUnit/Framework.php';

/**
 * Test cases for MembershipDao.
 *
 * @author Sujith T
 */
class MembershipDaoTest extends PHPUnit_Framework_TestCase {
   private $testCases;
	private $membershipDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/membership.yml');
		$this->membershipDao	=	new MembershipDao();
	}

   /**
    * test getMembershipTypeList
    */
   public function testGetMembershipTypeList() {
      $result = $this->membershipDao->getMembershipTypeList();
      $this->assertTrue($result instanceof Doctrine_Collection);
      foreach($result as $k => $obj) {
         $this->assertTrue($obj instanceof MembershipType);
      }
   }

   /**
    * test saveMembershipType
    */
   public function testSaveMembershipType() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $obj = new MembershipType();
         $obj->setMembtypeName($v['name']);
         $result = $this->membershipDao->saveMembershipType($obj);
         $this->assertTrue($result);
         $this->testCases['MembershipType'][$k]['id'] = $obj->getMembtypeCode();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/membership.yml',sfYaml::dump($this->testCases));
   }

   /**
    * test readMembershipType
    */
   public function testReadMembershipType() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $obj = $this->membershipDao->readMembershipType($v['id']);
         $this->assertTrue($obj instanceof MembershipType);
      }
   }

   /**
    * test searchMembershipType
    */
   public function testSearchMembershipType() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $result = $this->membershipDao->searchMembershipType("membtype_code", $v['id']);
         $this->assertTrue($result instanceof Doctrine_Collection);
      }
   }

   /**
    * test deleteMembershipType
    */
   public function testDeleteMembershipType() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $result = $this->membershipDao->deleteMembershipType(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['MembershipType'][$k]['id']);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/membership.yml',sfYaml::dump($this->testCases));
   }

   /**
    * test getMembershipList
    */
   public function testGetMembershipList() {
      $result = $this->membershipDao->getMembershipList();
      $this->assertTrue($result instanceof Doctrine_Collection);
      foreach($result as $k => $obj) {
         $this->assertTrue($obj instanceof Membership);
      }
   }

   /**
    * test saveMembership
    */
   public function testSaveMembership() {
         $type = new MembershipType();
         $type->setMembtypeName("name" . rand(1, 1000));
         $this->membershipDao->saveMembershipType($type);
         
      foreach($this->testCases['Membership'] as $k => $v) {
         $obj = new Membership();
         $obj->setMembtypeCode($type->getMembtypeCode());
         $obj->setMembshipName($v['name']);
         $result = $this->membershipDao->saveMembership($obj);
         $this->assertTrue($result);
         $this->testCases['Membership'][$k]['id']     = $obj->getMembshipCode();
         $this->testCases['Membership'][$k]['typeId'] = $type->getMembtypeCode();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/membership.yml',sfYaml::dump($this->testCases));
   }

   /**
    * test readMembership
    */
   public function testReadMembership() {
      foreach($this->testCases['Membership'] as $k => $v) {
         $obj = $this->membershipDao->readMembership($v['id']);
         $this->assertTrue($obj instanceof Membership);
      }
   }

   /**
    * test searchMembership
    */
   public function testSearchMembership() {
      foreach($this->testCases['Membership'] as $k => $v) {
         $result = $this->membershipDao->searchMembership("membtype_code", $v['typeId']);
         $this->assertTrue($result instanceof Doctrine_Collection);
      }
   }

   /**
    * test deleteMembership
    */
   public function testDeleteMembership() {
      $typeId = "";
      foreach($this->testCases['Membership'] as $k => $v) {
         $result = $this->membershipDao->deleteMembership(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['Membership'][$k]['id']);
         $typeId = $v['typeId'];
      }
      $this->membershipDao->deleteMembershipType(array($typeId));
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/membership.yml',sfYaml::dump($this->testCases));
   }
}
?>