<?php
require_once 'PHPUnit/Framework.php';
/**
 * Testing NationalityService
 *
 * @author Sujith T
 */
class NationalityServiceTest extends PHPUnit_Framework_TestCase {
   private $testCases;
	private $nationalityDao;
   private $nationalityService;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/nationality.yml');
		$this->nationalityService	=	new NationalityService();
	}

	/**
	 * Test getNationalityList
	 */
   public function testGetNationalityList() {
      $nationalityDao	=	new NationalityDao();
      $list = $nationalityDao->getNationalityList();

      $this->nationalityDao  =	$this->getMock('NationalityDao');
      $this->nationalityDao->expects($this->once())
         ->method('getNationalityList')
         ->will($this->returnValue($list));
      $this->nationalityService->setNationalityDao($this->nationalityDao);
      $result = $this->nationalityService->getNationalityList();
      $this->assertEquals($list, $result);
   }

	/**
	 * Test saveNationality
	 */
   public function testSaveNationality() {
      foreach($this->testCases['Nationality'] as $k => $v) {
         $obj = new Nationality();
         $obj->setNatName($v['name']);

         $this->nationalityDao  =	$this->getMock('NationalityDao');
         $this->nationalityDao->expects($this->once())
            ->method('saveNationality')
            ->will($this->returnValue(true));
         $this->nationalityService->setNationalityDao($this->nationalityDao);
         $result = $this->nationalityService->saveNationality($obj);
         $this->assertTrue($result);
      }
   }

	/**
	 * Test Search and Find Nationality
	 */
   public function testReadSearchNationality() {
      $nationalityDao	=	new NationalityDao();
      foreach($this->testCases['Nationality'] as $k => $v) {
         $obj = new Nationality();
         $obj->setNatName($v['name']);

         $result = $nationalityDao->searchNationality('nat_name', $v['name']);
         $this->nationalityDao  =	$this->getMock('NationalityDao');
         $this->nationalityDao->expects($this->once())
            ->method('searchNationality')
            ->will($this->returnValue($result));
         $this->nationalityService->setNationalityDao($this->nationalityDao);
         $list = $this->nationalityDao->searchNationality('nat_name', $v['name']);
         $this->assertEquals($result, $list);

         $this->nationalityDao  =	$this->getMock('NationalityDao');
         $this->nationalityDao->expects($this->once())
            ->method('readNationality')
            ->will($this->returnValue($obj));
         $this->nationalityService->setNationalityDao($this->nationalityDao);
         $result = $this->nationalityDao->readNationality($v['code']);
         $this->assertEquals($obj, $result);
      }
   }

	/**
	 * Test Delete Nationality
	 */
   public function testDeleteNationality() {
      foreach($this->testCases['Nationality'] as $k => $v) {
         $this->nationalityDao  =	$this->getMock('NationalityDao');
         $this->nationalityDao->expects($this->once())
            ->method('deleteNationality')
            ->will($this->returnValue(true));
         $this->nationalityService->setNationalityDao($this->nationalityDao);
         $result = $this->nationalityService->deleteNationality(array($v['code']));
         $this->assertTrue($result);
      }
   }

   /**
    * Test Save EthnicRace
    */
   public function testSaveEthnicRace() {
      foreach($this->testCases['EthnicRace'] as $k => $v) {
         $this->nationalityDao  =	$this->getMock('NationalityDao');
         $this->nationalityDao->expects($this->once())
            ->method('saveEthnicRace')
            ->will($this->returnValue(true));
         $this->nationalityService->setNationalityDao($this->nationalityDao);
         
         $ethnicalRace = new EthnicRace();
         $ethnicalRace->setEthnicRaceDesc($v['desc']);
         $result = $this->nationalityService->saveEthnicRace($ethnicalRace);
         $this->assertTrue($result);
      }
   }

   /**
    * Test Search, DeleteEthnicRace, getEthnicRaceList
    */
   public function testSearchDeleteEthnicRace() {
      $nationalityDao	=	new NationalityDao();
      $list = $nationalityDao->getEthnicRaceList();

      $this->nationalityDao  =	$this->getMock('NationalityDao');
      $this->nationalityDao->expects($this->once())
         ->method('getEthnicRaceList')
         ->will($this->returnValue($list));
      $this->nationalityService->setNationalityDao($this->nationalityDao);
      $result = $this->nationalityService->getEthnicRaceList();
      $this->assertEquals($result, $list);

      foreach($this->testCases['EthnicRace'] as $k => $v) {
         $this->nationalityDao  =	$this->getMock('NationalityDao');
         $this->nationalityDao->expects($this->once())
            ->method('searchEthnicRace')
            ->will($this->returnValue($list));
         $this->nationalityService->setNationalityDao($this->nationalityDao);
         $result = $this->nationalityService->searchEthnicRace('ethnic_race_desc', $v['desc']);
         $this->assertEquals($result, $list);

         $this->nationalityDao  =	$this->getMock('NationalityDao');
         $this->nationalityDao->expects($this->once())
            ->method('deleteEthnicRace')
            ->will($this->returnValue(true));
         $this->nationalityService->setNationalityDao($this->nationalityDao);
         $result = $this->nationalityService->deleteEthnicRace(array($v['code']));
         $this->assertTrue($result);
      }
   }
}
?>
