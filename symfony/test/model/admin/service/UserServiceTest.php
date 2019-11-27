<?php
require_once 'PHPUnit/Framework.php';



class UserServiceTest extends PHPUnit_Framework_TestCase
{
	private $testCases;
	private $userService ;
	

	/**
	 * Set up method
	 * @return unknown_type
	 */
	protected function setUp(){
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/user.yml');
		$this->userService	=	 new UserService();
	}


	/**
	 * Test Save User Group
	 * @return unknown_type
	 */
	public function testsaveUserGroup(){
		
		foreach( $this->testCases['UserGroup'] as $key=>$caseUserGroup){
			$userGroup	=	new UserGroup();
			$userGroup->setUsergName( $caseUserGroup['name']);
			
			$result = $this->userService->saveUserGroup( $userGroup );
			$this->testCases['UserGroup'][$key]["id"] = $userGroup->getUsergId();
			$this->assertTrue($result instanceof UserGroup);
		}
		file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/user.yml',sfYaml::dump($this->testCases));
		
		
	}
	
	/**
	 * Test Read User Group
	 * @return unknown_type
	 */
	public function testReadUserGroup(){
		foreach( $this->testCases['UserGroup'] as $key=>$caseUserGroup){
			$result	=	$this->userService->readUserGroup( $caseUserGroup['id']);
			$this->assertTrue($result instanceof UserGroup);
		}
	}
	
	/**
	 * Test Delete User group
	 */
	public function testDeleteUserGroup(  ){
		$deleteList	=	array();
		foreach( $this->testCases['UserGroup'] as $key=>$caseUserGroup){
			array_push($deleteList,$caseUserGroup['id']);
		}
		$result = $this->userService->deleteUserGroup( $deleteList );
		$this->assertTrue($result);
		
	}
	
	/**
	 * Test Get User group list
	 * @return unknown_type
	 */
	public function testGetUserGroupList(){
		foreach( $this->userService->getUserGroupList() as $userGroup){
			$this->assertTrue($userGroup instanceof UserGroup);
		}
	}
	
	
	
}