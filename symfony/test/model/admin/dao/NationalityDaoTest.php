<?php
require_once 'PHPUnit/Framework.php';

/**
 * Testing of NationalityDao
 *
 * @author Sujith T
 */
class NationalityDaoTest extends PHPUnit_Framework_TestCase {
   private $testCases;
	private $nationalityDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/nationality.yml');
		$this->nationalityDao   = new NationalityDao();
	}

	/**
	 * Test getNationalityList
	 */
   public function testGetNationalityList() {
      $list = $this->nationalityDao->getNationalityList();
      $this->assertTrue($list instanceof Doctrine_Collection);
      foreach($list as $nationality) {
         $this->assertTrue($nationality instanceof Nationality);
      }
   }

	/**
	 * Test saveNationality
	 */
   public function testSaveNationality() {
      foreach($this->testCases['Nationality'] as $k => $v) {
         $nationality = new Nationality();
         $nationality->setNatName($v['name']);
         $result = $this->nationalityDao->saveNationality($nationality);
         $this->assertTrue($result);
         $this->testCases['Nationality'][$k]['code'] = $nationality->getNatCode();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/nationality.yml',sfYaml::dump($this->testCases));
   }

	/**
	 * Test Search and Find Nationality
	 */
   public function testReadSearchNationality() {
      foreach($this->testCases['Nationality'] as $k => $v) {
         $result = $this->nationalityDao->searchNationality('nat_name', $v['name']);
         $this->assertTrue($result instanceof Doctrine_Collection);
         $result = $this->nationalityDao->readNationality($v['code']);
         $this->assertTrue($result instanceof Nationality);
      }
   }

	/**
	 * Test Delete Nationality
	 */
   public function testDeleteNationality() {
      foreach($this->testCases['Nationality'] as $k => $v) {
         $result = $this->nationalityDao->deleteNationality(array($v['code']));
         unset($this->testCases['Nationality'][$k]['code']);
         $this->assertTrue($result);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/nationality.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test Save EthnicRace
    */
   public function testSaveEthnicRace() {
      foreach($this->testCases['EthnicRace'] as $k => $v) {
         $ethnicalRace = new EthnicRace();
         $ethnicalRace->setEthnicRaceDesc($v['desc']);
         $result = $this->nationalityDao->saveEthnicRace($ethnicalRace);
         $this->assertTrue($result);
         $this->testCases['EthnicRace'][$k]['code'] = $ethnicalRace->getEthnicRaceCode();
      } 
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/nationality.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test GetEthnicRaceList
    */
   public function testGetEthnicRaceList() {
      $result = $this->nationalityDao->getEthnicRaceList();
      foreach($result as $obj) {
         $this->assertTrue($obj instanceof EthnicRace);
      }
   }

   /**
    * Test Search, DeleteEthnicRace
    */
   public function testSearchDeleteEthnicRace() {
      foreach($this->testCases['EthnicRace'] as $k => $v) {
         $result = $this->nationalityDao->searchEthnicRace('ethnic_race_desc', $v['desc']);
         $this->assertTrue($result instanceof Doctrine_Collection);
         $result = $this->nationalityDao->deleteEthnicRace(array($v['code']));
         $this->assertTrue($result);
         unset($this->testCases['EthnicRace'][$k]['code']);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/nationality.yml',sfYaml::dump($this->testCases));
   }
}
?>
