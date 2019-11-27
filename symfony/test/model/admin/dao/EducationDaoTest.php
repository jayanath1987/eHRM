<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test class for EducationDao
 *
 * @author Sujith T
 */
class EducationDaoTest extends PHPUnit_Framework_TestCase {

	private $testCases;
	private $educationDao;

	/**
	 * Set up method
	 */
	protected function setUp(){
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/education.yml');
		$this->educationDao	=	new EducationDao();
	}

	/**
	 * Test Save Customer
	 */
	public function testSaveEducation(){

		foreach( $this->testCases['Education'] as $key=>$caseEducation){
			$education 	=	 new Education();
			$education->setEduUni( $caseEducation['Institute']);
			$education->setEduDeg( $caseEducation['course']);

			$result	=	$this->educationDao->saveEducation($education);

			$this->testCases['Education'][$key]["id"] = $education->getEduCode();
			$this->assertTrue($result);
		}
		file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/education.yml',sfYaml::dump($this->testCases));
	}

	/**
	 * Test Read Customer
	 */
	public function testReadEducation(){
		foreach( $this->testCases['Education'] as $key=>$caseEducation){
			$result	=	$this->educationDao->readEducation( $caseEducation['id']);
			$this->assertTrue($result instanceof Education);
		}
	}

	/**
	 * Test Get Customer method
	 */
	public function testGetEducationList(){
		foreach($this->educationDao->getEducationList() as $education){
			$this->assertTrue($education instanceof Education);
		}
	}
   
	/**
	 * Test Delete Customer
	 */
	public function testDeleteEducation() {
		$deleteList	=	array();
		foreach( $this->testCases['Education'] as $key=>$caseEducation){
			array_push($deleteList,$caseEducation['id']);
         unset($this->testCases['Education'][$key]['id']);
		}
		$result = $this->educationDao->deleteEducation($deleteList);
		$this->assertTrue($result);
	}

	/**
	 * Test Save Licenses
	 */
	public function testSaveLicenses(){
      foreach( $this->testCases['Licenses'] as $k => $v) {
         $licenses = new Licenses();
         $licenses->setLicensesDesc($v['desc']);
         $result = $this->educationDao->saveLicenses($licenses);
         $this->testCases['Licenses'][$k]["id"] = $licenses->getLicensesCode();
         $this->assertTrue($result);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/education.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test Read and Search Licenses
    */
   public function testReadSearchLicenses() {
      foreach( $this->testCases['Licenses'] as $k => $v) {
         $licenses = $this->educationDao->readLicenses($v['id']);
         $this->assertEquals($licenses->getLicensesCode(), $v['id']);
         $licenses = $this->educationDao->searchLicenses("licenses_code", $v['id']);
         $this->assertTrue($licenses instanceof Doctrine_Collection);
      }
   }

   /**
    * Test Delete Licenses
    */
   public function testDeleteLicenses() {
      foreach( $this->testCases['Licenses'] as $k => $v) {
         $result = $this->educationDao->deleteLicenses(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['Licenses'][$k]["id"]);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/education.yml',sfYaml::dump($this->testCases));
   }
}
?>
