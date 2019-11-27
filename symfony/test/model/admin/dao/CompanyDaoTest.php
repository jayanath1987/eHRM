<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test Class for CompanyDao
 * @author Sujith T
 *
 */
class CompanyDaoTest extends PHPUnit_Framework_TestCase {
   
   private $testCases;
   private $companyDao;
   private $parentId;

   /**
    * Set Up function
   */
   protected function setUp() {
      $this->companyDao = new CompanyDao();
      $this->testCases  = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml');
   }

   /**
    * Test getCompany
    */
   public function testGetCompany() {
      $company = $this->companyDao->getCompany();
      $this->assertTrue($company instanceof Company);
   }

   /**
    * Test Save Company
    */
   public function testSaveCompany() {
      $company = $this->companyDao->getCompany();
      $company->comapanyName = $this->testCases['CompanyGenInfo']['companyName'];
      $company->taxId   = $this->testCases['CompanyGenInfo']['taxId'];
      $company->naics   = $this->testCases['CompanyGenInfo']['NAICS'];

      $result = $this->companyDao->saveCompany($company);
      $this->assertTrue($result);
   }

   /**
    * Test getCompanyLocation
    */
   public function testGetCompanyLocation() {
      $locations = $this->companyDao->getCompanyLocation();
      $this->assertTrue($locations instanceof Doctrine_Collection);
   }

   /**
    * Testing save Location
    */
   public function testSaveCompanyLocation() {
		foreach( $this->testCases['ComLocation'] as $key=>$comlocation){
			$location	=	new Location();
			$location->setLocName( $comlocation['loc_name']);
			$location->setLocState( $comlocation['loc_state']);
			$location->setLocCity( $comlocation['loc_city']);
			$location->setLocAdd( $comlocation['loc_add']);
			$location->setLocZip( $comlocation['loc_zip']);
			$location->setLocPhone( $comlocation['loc_phone']);
			$location->setLocFax( $comlocation['loc_fax']);
			$location->setLocComments( $comlocation['loc_comments']);
			$result	=	$this->companyDao->saveCompanyLocation($location);

			$this->testCases['ComLocation'][$key]["id"] = $location->getLocCode();
			$this->assertTrue($result);
		}
		file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test searchCompanyLocation
    */
   public function testSearchCompanyLocation() {
      foreach($this->testCases['ComLocation'] as $k => $v) {
         $locations = $this->companyDao->searchCompanyLocation('loc_name', $v['loc_name']);
         $this->assertTrue($locations instanceof Doctrine_Collection);
      }
   }

   /**
    * Test readLocation
    */
   public function testReadLocation() {
      foreach($this->testCases['ComLocation'] as $k => $v) {
         $location = $this->companyDao->readLocation($v['id']);
         $this->assertTrue($location instanceof Location);
      }
   }
   
   /**
    * Test Delete Location
    */
   public function testDeleteLocation() {
      $deleteList	=	array();
		foreach($this->testCases['ComLocation'] as $k => $v){
			array_push($deleteList,$v['id']);
         unset($this->testCases['ComLocation'][$k]['id']);
		}
      
		$result = $this->companyDao->deleteCompanyLocation($deleteList);
		$this->assertTrue($result);
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml',sfYaml::dump($this->testCases));
   }

	/**
	 * Test Save Company property
	 */
	public function testSaveCompanyProporty(){
		foreach($this->testCases['CompanyProperty'] as $key=>$testCase){
			 $companyProperty	= new CompanyProperty();
			 $companyProperty->setPropName($testCase['prop_name']);
			 $result = $this->companyDao->saveCompanyProperty($companyProperty);
			 $this->assertTrue($result);
			 $this->testCases['CompanyProperty'][$key]["id"] = $companyProperty->getPropId();
		}
		file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml',sfYaml::dump($this->testCases));
	}

   /**
    * Test GetCompanyProperty
    */
   public function testGetCompanyProperty(){
		foreach($this->companyDao->getCompanyProperty() as $companyProperty){
			$this->assertTrue($companyProperty instanceof CompanyProperty);
		}
	}
   
	/**
	 * Test Delete Company property
	 */
	public function testDeleteCompanyProperty(){
		$deleteList	=	array();
		foreach( $this->testCases['CompanyProperty'] as $key=>$testCase){
			array_push($deleteList, $testCase['id']);
         unset($this->testCases['CompanyProperty'][$key]["id"]);
		}
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml',sfYaml::dump($this->testCases));
		$result = $this->companyDao->deleteCompanyProperty( $deleteList );
		$this->assertTrue($result);
	}

   /**
    * Testing CompanyStructure Saving
    */
   function testCompanyStructureSave() {
      foreach($this->testCases['CompanyStructure'] as $k => $v) {
         $companyStructure = new CompanyStructure();
         $companyStructure->setTitle($v['title']);
         $companyStructure->setDescription($v['description']);
         $companyStructure->setParnt($v['parnt']);
         $companyStructure->setDeptId($v['dept_id']);
         $result = $this->companyDao->saveCompanyStructure($companyStructure);

         $this->testCases['CompanyStructure'][$k]["id"]    = $companyStructure->getId();
         $this->testCases['CompanyStructure'][$k]["title"] = $companyStructure->getTitle();
         $this->testCases['CompanyStructure'][$k]["description"] = $companyStructure->getDescription();
         $this->testCases['CompanyStructure'][$k]["dept_id"]     = $companyStructure->getDeptId();
			$this->assertTrue($result);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Testing Read Company By Id
    */
   function testReadCompanyStructure() {
      foreach($this->testCases['CompanyStructure'] as $k => $v) {
         $companyStructure = $this->companyDao->readCompanyStructure($v['id']);
         $this->parentId  = $v['parnt'];
         $this->assertTrue($companyStructure instanceof CompanyStructure);
      }
   }

   /**
    * Testing Get Company Structure List
    */
   function tesGetCompanyStructureList() {
      $list = $this->companyDao->getCompanyStructureList($this->parentId);
      foreach($list as $obj) {
         $this->assertEquals($obj->getParnt(), $this->parentId);
      }
   }

   /**
    * Testing Delete Company Structure List
    */
   function testDeleteCompanyStructure() {
      foreach($this->testCases['CompanyStructure'] as $k => $v) {
         $result = $this->companyDao->deleteCompanyStructure($v['id']);
          unset($this->testCases['CompanyStructure'][$k]["id"]);
         $this->assertTrue($result);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml',sfYaml::dump($this->testCases));
   }
}
?>