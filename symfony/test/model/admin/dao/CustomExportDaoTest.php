<?php
require_once 'PHPUnit/Framework.php';
/**
 * CustomExportDao Test Class
 * @author Sujith T
 *
 */
class CustomExportDaoTest extends PHPUnit_Framework_TestCase {
	private $testCases;
	private $exportDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/customExport.yml');
		$this->exportDao	= new CustomExportDao();
	}

   public function testSaveCustomExport() {
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $customExport = new CustomExport();
         $idGenService = new IDGeneratorService();
         $idGenService->setEntity($customExport);

         $id = $idGenService->getNextID();
         $customExport->setExportId($id);
         $customExport->setName($v['name']);
         $customExport->setFields(str_replace("|", ",", $v['fields']));
         $customExport->setHeadings(str_replace("|", ",", $v['headings']));
         $this->testCases['CustomExport'][$k]['id'] = $id;

         $result = $this->exportDao->saveCustomExport($customExport);
         $this->assertTrue($result);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/customExport.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Testing Read Company By Id
    */
   public function testReadCustomExport() {
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $customExport = $this->exportDao->readCustomExport($v['id']);
         $this->assertTrue($customExport instanceof CustomExport);
      }
   }

   /**
    * Testing CustomExportList
    */
   public function testCustomExportList() {
      $exportList = $this->exportDao->getCustomExportList();
      $this->assertTrue($exportList instanceof Doctrine_Collection);
      foreach($exportList as $customExport) {
         $this->assertTrue($customExport instanceof CustomExport);
      }
   }

   /**
    * Testing SearchCustomExport
    */
   public function testSearchCustomExport() {
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $exportList = $this->exportDao->searchCustomExport("name", $v['name']);
         foreach($exportList as $customExport) {
            $pos = strpos($customExport->getName(), $v['name']);
            $this->assertTrue($pos > -1);
         }
      }
   }

   /**
    * Testing DeleteCustomExport
    */
   public function testDeleteCustomExport() {
      foreach($this->testCases['CustomExport'] as $k => $v) {
         $this->exportDao->deleteCustomExport($v['id']);
         $customExport = $this->exportDao->readCustomExport($v['id']);
         $this->assertTrue(!$customExport instanceof CustomExport);
      }
   }
}
?>