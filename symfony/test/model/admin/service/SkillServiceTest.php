<?php
require_once 'PHPUnit/Framework.php';



class SkillServiceTest extends PHPUnit_Framework_TestCase
{
	private $testCases;
	private $skillService ;
	

	/**
	 * Set up method
	 * @return unknown_type
	 */
	protected function setUp(){
		$this->testCases 	= 	sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/skill.yml');
		$this->skillService	=	 new SkillService();
	}


	/**
	 * Test Save Skill
	 * @return unknown_type
	 */
	public function testSaveSkill(){
		
		foreach( $this->testCases['Skill'] as $key=>$caseSkill){
			$skill		=	 new Skill();
			$skill->setSkillName($caseSkill['name']);
			$skill->setSkillDescription( $caseSkill['description']);
			
			
			$result = $this->skillService->saveSkill( $skill );
			$this->testCases['Skill'][$key]["id"] =  $skill->getSkillCode();
			$this->assertTrue($result);
		}
		file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/skill.yml',sfYaml::dump($this->testCases));
		
		
	}
	
	/**
	 * Test Read Skill
	 * @return unknown_type
	 */
	public function testReadSkill(){
		foreach( $this->testCases['Skill'] as $key=>$caseSkill){
			$result	=	$this->skillService->readSkill( $caseSkill['id']);
			$this->assertTrue($result instanceof Skill);
		}
	}
	
	/**
	 * Test Delete Skill
	 */
	public function testDeleteSkill(  ){
		$deleteList	=	array();
		foreach( $this->testCases['Skill'] as $key=>$caseSkill){
			array_push($deleteList,$caseSkill['id']);
		}
		$result = $this->skillService->deleteSkill( $deleteList );
		$this->assertTrue($result);
		
	}
	
	/**
	 * Test Get Skill List
	 * @return unknown_type
	 */
	public function testGetSkillList(){
		foreach( $this->skillService->getSkillList() as $skill){
			$this->assertTrue($skill instanceof Skill);
		}
	}
	
	
	
}
