<?php
require_once 'PHPUnit/Framework.php';

/**
 * Test cases for MembershipService.
 *
 * @author Sujith T
 */
class MembershipServiceTest extends PHPUnit_Framework_TestCase {
   private $testCases;
	private $membershipDao;
   private $membershipService;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/membership.yml');
		$this->membershipService	=	new MembershipService();
	}

   /**
    * test getMembershipTypeList
    */
   public function testGetMembershipTypeList() {
      $membershipDao = new MembershipDao();
      $list = $membershipDao->getMembershipTypeList();

      $this->membershipDao  =	$this->getMock('MembershipDao');
      $this->membershipDao->expects($this->once())
         ->method('getMembershipTypeList')
         ->will($this->returnValue($list));
      $this->membershipService->setMembershipDao($this->membershipDao);
      $result = $this->membershipService->getMembershipTypeList();
      $this->assertEquals($list, $result);
   }

   /**
    * test saveMembershipType
    */
   public function testSaveMembershipType() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $obj = new MembershipType();
         $obj->setMembtypeName($v['name']);

         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('saveMembershipType')
            ->will($this->returnValue(true));
         $this->membershipService->setMembershipDao($this->membershipDao);
         $result = $this->membershipService->saveMembershipType($obj);
         $this->assertTrue($result);
      }
   }

   /**
    * test readMembershipType
    */
   public function testReadMembershipType() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $obj = new MembershipType();
         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('readMembershipType')
            ->will($this->returnValue($obj));
         $this->membershipService->setMembershipDao($this->membershipDao);
         $result = $this->membershipService->readMembershipType($v['id']);
         $this->assertEquals($obj, $result);
      }
   }

   /**
    * test searchMembershipType
    */
   public function testSearchMembershipType() {
      $membershipDao = new MembershipDao();
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $list = $membershipDao->searchMembershipType("membtype_code", $v['id']);
         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('searchMembershipType')
            ->will($this->returnValue($list));
         $this->membershipService->setMembershipDao($this->membershipDao);
         $result = $this->membershipService->searchMembershipType("membtype_code", $v['id']);
         $this->assertEquals($list, $result);
      }
   }

   /**
    * test deleteMembershipType
    */
   public function testDeleteMembershipType() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('deleteMembershipType')
            ->will($this->returnValue(true));
         $this->membershipService->setMembershipDao($this->membershipDao);

         $result = $this->membershipService->deleteMembershipType(array($v['id']));
      }
   }

   /**
    * test getMembershipList
    */
   public function testGetMembershipList() {
      $membershipDao = new MembershipDao();
      $list = $membershipDao->getMembershipList();

      $this->membershipDao  =	$this->getMock('MembershipDao');
      $this->membershipDao->expects($this->once())
         ->method('getMembershipList')
         ->will($this->returnValue($list));
      $this->membershipService->setMembershipDao($this->membershipDao);

      $result = $this->membershipService->getMembershipList();
      $this->assertEquals($result, $list);
   }

   /**
    * test saveMembership
    */
   public function testSaveMembership() {
      foreach($this->testCases['MembershipType'] as $k => $v) {
         $obj = new Membership();
         $obj->setMembtypeCode($v['typeId']);
         $obj->setMembshipName($v['name']);

         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('saveMembership')
            ->will($this->returnValue(true));
         $this->membershipService->setMembershipDao($this->membershipDao);
         $result = $this->membershipService->saveMembership($obj);
         $this->assertTrue($result);
      }
   }

   /**
    * test readMembership
    */
   public function testReadMembership() {
      $membershipDao = new MembershipDao();
      foreach($this->testCases['Membership'] as $k => $v) {
         $obj = $membershipDao->readMembership($v['id']);
         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('readMembership')
            ->will($this->returnValue($obj));
         $this->membershipService->setMembershipDao($this->membershipDao);
         $result = $this->membershipService->readMembership($v['id']);
         $this->assertEquals($result, $obj);
      }
   }

   /**
    * test searchMembership
    */
   public function testSearchMembership() {
      $membershipDao = new MembershipDao();
      foreach($this->testCases['Membership'] as $k => $v) {
         $list = $membershipDao->searchMembership("membtype_code", $v['typeId']);
         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('searchMembership')
            ->will($this->returnValue($list));
         $this->membershipService->setMembershipDao($this->membershipDao);
         $result = $this->membershipService->searchMembership("membtype_code", $v['typeId']);
         $this->assertEquals($result, $list);
      }
   }

   /**
    * test deleteMembership
    */
   public function testDeleteMembership() {
      foreach($this->testCases['Membership'] as $k => $v) {
         $this->membershipDao  =	$this->getMock('MembershipDao');
         $this->membershipDao->expects($this->once())
            ->method('deleteMembership')
            ->will($this->returnValue(true));
         $this->membershipService->setMembershipDao($this->membershipDao);
         $result = $this->membershipService->deleteMembership(array($v['id']));
         $this->assertTrue($result);
      }
   }
}
?>