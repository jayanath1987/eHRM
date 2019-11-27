<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test class for EducationService
 *
 * @author Sujith T
 */
class EducationServiceTest extends PHPUnit_Framework_TestCase {

	private $testCases;
	private $educationService;
   private $educationDao;
	

	/**
	 * Set up method
	 */
	protected function setUp(){
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/education.yml');
		$this->educationService	=	new EducationService();
	}


	/**
	 * Test Save Customer
	 */
   public function testSaveEducation(){
		foreach( $this->testCases['Education'] as $key=>$caseEducation){
			$education 	=	 new Education();
			$education->setEduUni( $caseEducation['Institute']);
			$education->setEduDeg( $caseEducation['course']);

         $this->educationDao  =	$this->getMock('EducationDao');
         $this->educationDao->expects($this->once())
               ->method('saveEducation')
               ->will($this->returnValue(true));
         $this->educationService->setEducationDao($this->educationDao);
			$result	=	$this->educationService->saveEducation($education);
			$this->assertTrue($result);
		}
	}
	
	/**
	 * Test Read Customer
	 */
	public function testReadEducation(){
		foreach( $this->testCases['Education'] as $k => $v){
         $education 	=	 new Education();
         $this->educationDao  =	$this->getMock('EducationDao');
         $this->educationDao->expects($this->once())
               ->method('readEducation')
               ->will($this->returnValue($education));
         $this->educationService->setEducationDao($this->educationDao);

			$result	=	$this->educationService->readEducation($v['id']);
			$this->assertTrue($result instanceof Education);
		}
	}
	
	/**
	 * Test Delete Customer
	 */
	public function testDeleteEducation(  ){
		$deleteList	=	array();
      $this->educationDao  =	$this->getMock('EducationDao');
      $this->educationDao->expects($this->once())
            ->method('deleteEducation')
            ->will($this->returnValue(true));
      $this->educationService->setEducationDao($this->educationDao);
		$result = $this->educationService->deleteEducation($deleteList);
		$this->assertTrue($result);
	}
	
	/**
	 * Test Get Customer method
	 */
	public function testGetEducationList(){
      $dao  = new EducationDao();
      $list = $dao->getEducationList();
      $this->educationDao  =	$this->getMock('EducationDao');
      $this->educationDao->expects($this->once())
            ->method('getEducationList')
            ->will($this->returnValue($list));
      $this->educationService->setEducationDao($this->educationDao);
		$result = $this->educationService->getEducationList();

      $this->assertEquals($result, $list);
	}

	/**
	 * Test Save Licenses
	 */
	public function testSaveLicenses() {
      foreach( $this->testCases['Licenses'] as $k => $v) {
         $licenses = new Licenses();
         $licenses->setLicensesDesc($v['desc']);
         $this->educationDao  =	$this->getMock('EducationDao');
         $this->educationDao->expects($this->once())
               ->method('saveLicenses')
               ->will($this->returnValue(true));
         $this->educationService->setEducationDao($this->educationDao);
         $result = $this->educationService->saveLicenses($licenses);
         $this->assertTrue($result);
      }
   }

   /**
    * Test Read and Search Licenses
    */
   public function testReadLicenses() {
      foreach( $this->testCases['Licenses'] as $k => $v) {
         $licenses = new Licenses();
         $this->educationDao  =	$this->getMock('EducationDao');
         $this->educationDao->expects($this->once())
               ->method('readLicenses')
               ->will($this->returnValue($licenses));
         $this->educationService->setEducationDao($this->educationDao);
         $result = $this->educationDao->readLicenses($v['id']);
         $this->assertEquals($result, $licenses);
      }
   }

   /**
    * Test Delete Licenses
    */
   public function testDeleteLicenses() {
      foreach( $this->testCases['Licenses'] as $k => $v) {
         $this->educationDao  =	$this->getMock('EducationDao');
         $this->educationDao->expects($this->once())
               ->method('deleteLicenses')
               ->will($this->returnValue(true));
         $this->educationService->setEducationDao($this->educationDao);
         $result = $this->educationService->deleteLicenses(array($v['id']));
         $this->assertTrue($result);
      }
   }
}