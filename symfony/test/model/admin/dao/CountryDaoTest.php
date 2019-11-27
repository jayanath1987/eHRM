<?php
require_once 'PHPUnit/Framework.php';



class CountryDaoTest extends PHPUnit_Framework_TestCase{
	private $testCases;
	private $countryDao ;
	

	/**
	 * Set up method
	 * @return unknown_type
	 */
	protected function setUp(){
		
		$this->countryDao	=	new CountryDao();
	}
	
	/**
	 * Test Country list
	 * @return unknown_type
	 */
	public function testGetCountryList(){
		$countryList	=	$this->countryDao->getCountryList();
		foreach( $countryList as $country){
			$this->assertTrue($country instanceof Country);
		}
	}
	
	/**
	 * Test Country list
	 * @return unknown_type
	 */
	public function testGetProvinceList(){
		$provinceList	=	$this->countryDao->getProvinceList();
		foreach( $provinceList as $province){
			$this->assertTrue($province instanceof Province);
		}
	}
}