<?php
require_once 'PHPUnit/Framework.php';
/**
 * Export Service Test Case Class
 *
 * @author Sujith T
 */
class CustomExportServiceTest extends PHPUnit_Framework_TestCase {

	private $testCases;
	private $exportService;
   private $exportDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/customExport.yml');
		$this->exportService	= new CustomExportService();
	}

	/**
	 * Test SaveCustomExport
	 */
   public function testSaveCustomExport() {
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $customExport = new CustomExport();
         $customExport->setName($v['name']);
         $customExport->setFields(str_replace("|", ",", $v['fields']));
         $customExport->setHeadings(str_replace("|", ",", $v['headings']));

         $this->exportDao  =	$this->getMock('CustomExportDao');
         $this->exportDao->expects($this->once())
            ->method('saveCustomExport')
            ->will($this->returnValue(true));
         $this->exportService->setCustomExportDao($this->exportDao);
         $result = $this->exportService->saveCustomExport($customExport);
         $this->assertTrue($result);
      }
   }

   /**
    * Testing Read Company By Id
    */
   function testReadCustomExport() {
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $customExport = new CustomExport();
         $customExport->setName($v['name']);
         $customExport->setFields(str_replace("|", ",", $v['fields']));
         $customExport->setHeadings(str_replace("|", ",", $v['headings']));
         
         $this->exportDao  =	$this->getMock('CustomExportDao');
         $this->exportDao->expects($this->once())
                 ->method('readCustomExport')
                 ->will($this->returnValue($customExport));
         $this->exportService->setCustomExportDao($this->exportDao);
         $customExport = $this->exportService->readCustomExport($v['id']);
         $this->assertTrue($customExport instanceof CustomExport);
      }
   }

	/**
	 * Test CustomExportList
	 */
   public function testCustomExportList() {
      $exportDao  = new CustomExportDao();
      $list       = $exportDao->getCustomExportList();

      $this->exportDao  =	$this->getMock('CustomExportDao');
      $this->exportDao->expects($this->once())
                 ->method('getCustomExportList')
                 ->will($this->returnValue($list));
      
      $this->exportService->setCustomExportDao($this->exportDao);
      $exportList = $this->exportService->getCustomExportList();
      $this->assertEquals($list, $exportList);
   }

	/**
	 * Test SearchCustomExport
	 */
   public function testSearchCustomExport() {
      $exportDao  = new CustomExportDao();
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $list             = $exportDao->searchCustomExport("name", $v['name']);
         $this->exportDao  =	$this->getMock('CustomExportDao');
         $this->exportDao->expects($this->once())
                 ->method('searchCustomExport')
                 ->will($this->returnValue($list));
         $this->exportService->setCustomExportDao($this->exportDao);
         
         $exportList = $this->exportService->searchCustomExport("name", $v['name']);
         $this->assertEquals($list, $exportList);
      }
   }

	/**
	 * Test DeleteCustomExport
	 */
   public function testDeleteCustomExport() {
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $this->exportDao  =	$this->getMock('CustomExportDao');
         $this->exportDao->expects($this->once())
                 ->method('deleteCustomExport')
                 ->will($this->returnValue(true));
         $this->exportService->setCustomExportDao($this->exportDao);
         $result = $this->exportService->deleteCustomExport($v['id']);
         $this->assertTrue($result);
      }
   }

	/**
	 * Test getAllFields()
	 */
   public function testGetAllFields() {
      $result = CustomExportService::getAllFields();
      $this->assertTrue(is_array($result));
   }
}

?>
