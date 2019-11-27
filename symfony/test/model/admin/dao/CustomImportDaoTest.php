<?php
require_once 'PHPUnit/Framework.php';

/**
 * Import DAO Test Case Class
 *
 * @author Sujith T
 */
class CustomImportDaoTest extends PHPUnit_Framework_TestCase {

	private $testCases;
	private $importDao ;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/customImport.yml');
		$this->importDao	=	new CustomImportDao();
	}

   public function testSaveCustomImport() {
      foreach($this->testCases['CustomImport'] as $k => $v) {
         $customImport  =  new CustomImport();
         $idGenService  = new IDGeneratorService();
         $idGenService->setEntity($customImport);

         $id = $idGenService->getNextID();
         $customImport->setImportId($id);
         $customImport->setName($v['name']);
         $customImport->setFields(str_replace("|", ",", $v['fields']));
         $customImport->setHasHeading($v['has_heading']);

         $this->testCases['CustomImport'][$k]['id'] = $id;
         $result = $this->importDao->saveCustomImport($customImport);
         $this->assertTrue($result);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/customImport.yml',sfYaml::dump($this->testCases));
   }

   public function testCustomImportList() {
      $importList = $this->importDao->getCustomImportList();
      $this->assertTrue($importList instanceof Doctrine_Collection);
      foreach($importList as $customImport) {
         $this->assertTrue($customImport instanceof CustomImport);
      }
   }

   public function testSearchCustomImport() {
      foreach($this->testCases['CustomImport'] as $k => $v) {
         $importList = $this->importDao->searchCustomImport("name", $v['name']);
         foreach($importList as $customImport) {
            $pos = strpos($customImport->getName(), $v['name']);
            $this->assertTrue($pos > -1);
         }
      }
   }

   public function testDeleteCustomImport() {
      foreach($this->testCases['CustomImport'] as $k => $v) {
         $this->importDao->deleteCustomImport($v['id']);
         $customImport = $this->importDao->readCustomImport($v['id']);
         $this->assertTrue(!$customImport instanceof CustomImport);
      }
   }
}
?>