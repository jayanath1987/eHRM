<?php
require_once 'PHPUnit/Framework.php';

/**
 * Test Class for CompanyService
 * @author Sujith T
 *
 */
class CompanyServiceTest extends PHPUnit_Framework_TestCase
{

	private $testCases;
	private $companyService;
   private $companyDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/company.yml');
		$this->companyService	=	new CompanyService();
	}

   /**
    * Test getCompany
    */
   public function testGetCompany() {
      $company = new Company();
      $this->companyDao  =	$this->getMock('CompanyDao');
      $this->companyDao->expects($this->once())
        ->method('getCompany')
        ->will($this->returnValue($company));
      $this->companyService->setCompanyDao($this->companyDao);
      $result = $this->companyService->getCompany();
      $this->assertEquals($result, $company);
   }

   /**
    * Test Save Company
    */
   public function testSaveCompany() {
      $this->companyDao  =	$this->getMock('CompanyDao');
      $company = new Company();
      $this->companyDao->expects($this->once())
        ->method('getCompany')
        ->will($this->returnValue($company));
      $this->companyService->setCompanyDao($this->companyDao);
      $company = $this->companyService->getCompany();

      $company->comapanyName = $this->testCases['CompanyGenInfo']['companyName'];
      $company->taxId   = $this->testCases['CompanyGenInfo']['taxId'];
      $company->naics   = $this->testCases['CompanyGenInfo']['NAICS'];

      $this->companyDao->expects($this->once())
        ->method('saveCompany')
        ->will($this->returnValue(true));
      $this->companyService->setCompanyDao($this->companyDao);
      $result = $this->companyService->saveCompany($company);
      $this->assertTrue($result);
   }

   /**
    * Test getCompanyLocation
    */
   public function testGetCompanyLocation() {
      $this->companyDao  =	$this->getMock('CompanyDao');
      $this->companyDao->expects($this->once())
        ->method('getCompanyLocation')
        ->will($this->returnValue(Doctrine_Collection));
      $this->companyService->setCompanyDao($this->companyDao);
      $result = $this->companyService->getCompanyLocation();
      $this->assertEquals($result, "Doctrine_Collection");
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

         $this->companyDao  =	$this->getMock('CompanyDao');
         $this->companyDao->expects($this->once())
              ->method('saveCompanyLocation')
              ->will($this->returnValue(true));
         $this->companyService->setCompanyDao($this->companyDao);
         $result = $this->companyService->saveCompanyLocation($location);
         $this->assertTrue($result);
      }
   }

   /**
    * Test searchCompanyLocation
    */
   public function testSearchCompanyLocation() {
      foreach($this->testCases['ComLocation'] as $k => $v) {
         $this->companyDao  =	$this->getMock('CompanyDao');
         $this->companyDao->expects($this->once())
              ->method('searchCompanyLocation')
              ->will($this->returnValue(Doctrine_Collection));
         $this->companyService->setCompanyDao($this->companyDao);
         $result = $this->companyService->searchCompanyLocation('loc_name', $v['loc_name']);
         $this->assertEquals($result, "Doctrine_Collection");
      }
   }

   /**
    * Test readLocation
    */
   public function testReadLocation() {
      foreach($this->testCases['ComLocation'] as $k => $v) {
         $locations = array();
         $this->companyDao  =	$this->getMock('CompanyDao');
         $this->companyDao->expects($this->once())
                 ->method('readLocation')
                 ->will($this->returnValue($locations));
         $this->companyService->setCompanyDao($this->companyDao);
         $result = $this->companyService->readLocation($v['id']);
         $this->assertEquals($result, $locations);
      }
   }

   /**
    * Test Delete Location
    */
   public function testDeleteLocation() {
      $deleteList	=	array();
      $this->companyDao  =	$this->getMock('CompanyDao');
      $this->companyDao->expects($this->once())
              ->method('deleteCompanyLocation')
              ->will($this->returnValue(true));
      $this->companyService->setCompanyDao($this->companyDao);
      $result = $this->companyService->deleteCompanyLocation($deleteList);
      $this->assertTrue($result);
   }

	/**
	 * Test Save Company property
	 */
	public function testSaveCompanyProporty(){
      foreach($this->testCases['CompanyProperty'] as $key=>$testCase) {
         $companyProperty	= new CompanyProperty();
         $companyProperty->setPropName($testCase['prop_name']);

         $this->companyDao  =	$this->getMock('CompanyDao');
         $this->companyDao->expects($this->once())
              ->method('saveCompanyProperty')
              ->will($this->returnValue(true));
         $this->companyService->setCompanyDao($this->companyDao);
         $result = $this->companyService->saveCompanyProperty($companyProperty);
         $this->assertTrue($result);
      }
   }

   /**
    * Test GetCompanyProperty
    */
   public function testGetCompanyProperty(){
      $this->companyDao  =	$this->getMock('CompanyDao');
      $this->companyDao->expects($this->once())
           ->method('getCompanyProperty')
           ->will($this->returnValue(Doctrine_Collection));
      $this->companyService->setCompanyDao($this->companyDao);
      $collection = $this->companyService->getCompanyProperty();

      $this->assertEquals($collection, "Doctrine_Collection");
   }

   /**
	 * Test Delete Company property
	 */
	public function testDeleteCompanyProperty(){
      $deleteIds = array(1);
      $this->companyDao  =	$this->getMock('CompanyDao');
      $this->companyDao->expects($this->once())
           ->method('deleteCompanyProperty')
           ->will($this->returnValue(true));
      $this->companyService->setCompanyDao($this->companyDao);
      $result = $this->companyService->deleteCompanyProperty($deleteIds);
      $this->assertTrue($result);
   }

   /**
    * Testing CompanyStructure Saving
    */
   public function testCompanyStructureSave() {
      foreach($this->testCases['CompanyStructure'] as $k => $v) {
         $companyStructure = new CompanyStructure();
         $companyStructure->setTitle($v['title']);
         $companyStructure->setDescription($v['description']);
         $companyStructure->setParnt($v['parnt']);
         $companyStructure->setDeptId($v['dept_id']);

         $this->companyDao  =	$this->getMock('CompanyDao');
         $this->companyDao->expects($this->once())
               ->method('saveCompanyStructure')
               ->will($this->returnValue(true));
         $this->companyService->setCompanyDao($this->companyDao);
         $result = $this->companyService->saveCompanyStructure($companyStructure);
         $this->assertTrue($result);
      }
   }

   /**
    * Testing Read Company By Id
    */
   public function testReadCompanyStructure() {
      foreach($this->testCases['CompanyStructure'] as $k => $v) {
         $companyStructure = new CompanyStructure();
         $companyStructure->setTitle($v['title']);
         $companyStructure->setDescription($v['description']);
         $companyStructure->setParnt($v['parnt']);
         $companyStructure->setDeptId($v['dept_id']);

         $this->companyDao  =	$this->getMock('CompanyDao');
         $this->companyDao->expects($this->once())
               ->method('readCompanyStructure')
               ->will($this->returnValue($companyStructure));
         $this->companyService->setCompanyDao($this->companyDao);
         $result = $this->companyService->readCompanyStructure($v['id']);
         $this->assertEquals($result, $companyStructure);
      }
   }

   /**
    * Testing Get Company Structure List
    */
   public function tesGetCompanyStructureList() {
      $this->companyDao  =	$this->getMock('CompanyDao');
      $this->companyDao->expects($this->once())
            ->method('getCompanyStructureList')
            ->will($this->returnValue(Doctrine_Collection));
      $this->companyService->setCompanyDao($this->companyDao);
      $result = $this->companyService->getCompanyStructureList(1);
      $this->assertEquals($result, "Doctrine_Collection");
   }

   /**
    * Testing Delete Company Structure List
    */
   public function testDeleteCompanyStructure() {
      foreach($this->testCases['CompanyStructure'] as $k => $v) {
         $this->companyDao  =	$this->getMock('CompanyDao');
         $this->companyDao->expects($this->once())
               ->method('deleteCompanyStructure')
               ->will($this->returnValue(true));
         $this->companyService->setCompanyDao($this->companyDao);
         $result = $this->companyService->deleteCompanyStructure($v['id']);
         $this->assertTrue($result);
      }
   }
}