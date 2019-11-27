<?php
require_once 'PHPUnit/Framework.php';

/**
 * Import Service Test Case Class
 *
 * @author Sujith T
 */
class CustomImportServiceTest extends PHPUnit_Framework_TestCase {

	private $testCases;
	private $importService;
   private $importDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/customImport.yml');
		$this->importService	=	new CustomImportService();
	}

   /**
    * Test saveCustomImport
    */
   public function testSaveCustomImport() {
      foreach($this->testCases['CustomImport'] as $k => $v) {
         $customImport  =  new CustomImport();
         $customImport->setImportId($id);
         $customImport->setName($v['name']);
         $customImport->setFields(str_replace("|", ",", $v['fields']));
         $customImport->setHasHeading($v['has_heading']);

         $this->importDao  =	$this->getMock('CustomImportDao');
         $this->importDao->expects($this->once())
            ->method('saveCustomImport')
            ->will($this->returnValue(true));
         $this->importService->setCustomImportDao($this->importDao);

         $result = $this->importService->saveCustomImport($customImport);
         $this->assertTrue($result);
      }
   }

   /**
    * Test customImportList
    */
   public function testCustomImportList() {
      $importDao = new CustomImportDao();
      $list = $importDao->getCustomImportList();

      $this->importDao  =	$this->getMock('CustomImportDao');
      $this->importDao->expects($this->once())
            ->method('getCustomImportList')
            ->will($this->returnValue($list));
      $this->importService->setCustomImportDao($this->importDao);
      $importList = $this->importService->getCustomImportList();
      $this->assertEquals($list, $importList);
   }

   /**
    * Test searchCustomImport
    */
   public function testSearchCustomImport() {
      $importDao = new CustomImportDao();
      foreach($this->testCases['CustomImport'] as $k => $v) {
         $list = $importDao->searchCustomImport("name", $v['name']);

         $this->importDao  =	$this->getMock('CustomImportDao');
         $this->importDao->expects($this->once())
               ->method('searchCustomImport')
               ->will($this->returnValue($list));
         $this->importService->setCustomImportDao($this->importDao);
         $importList = $this->importService->searchCustomImport("name", $v['name']);
         $this->assertEquals($list, $importList);
      }
   }

   /**
    * Test getAllFields
    */
   public function testDeleteCustomImport() {
      foreach($this->testCases['CustomImport'] as $k => $v) {
         $this->importDao  =	$this->getMock('CustomImportDao');
         $this->importDao->expects($this->once())
               ->method('deleteCustomImport')
               ->will($this->returnValue(true));
         $this->importService->setCustomImportDao($this->importDao);
         $result = $this->importService->deleteCustomImport($v['id']);
         $this->assertTrue($result);
      }
   }

   /**
    * Test getAllFields()
    */
   public function testGetAllFields() {
      $result = CustomImportService::getAllFields();
      $this->assertTrue(is_array($result));
   }
}

?>