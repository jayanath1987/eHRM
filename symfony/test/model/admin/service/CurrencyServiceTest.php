<?php
require_once 'PHPUnit/Framework.php';

/**
 * Test Class for CurrencyService
 * @author Sujith T
 *
 */
class CurrencyServiceTest extends PHPUnit_Framework_TestCase
{
	private $currencyService;
   private $currencyDao;

	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->currencyService =	new CurrencyService();
	}

   /**
    * Test getCurrencyList
    */
   public function testGetCurrencyList() {
      $this->currencyDao  =	$this->getMock('CurrencyDao');
      $this->currencyDao->expects($this->once())
            ->method('getCurrencyList')
            ->will($this->returnValue(Doctrine_Collection));
      
      $this->currencyService->setCurrencyDao($this->currencyDao);
      $result = $this->currencyService->getCurrencyList();
      $this->assertEquals($result, Doctrine_Collection);
   }
}
?>
