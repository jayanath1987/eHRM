<?php
require_once 'PHPUnit/Framework.php';

/**
 * Test Class for CurrencyDao
 * @author Sujith T
 *
 */
class CurrencyDaoTest extends PHPUnit_Framework_TestCase {

   private $currencyDao;

   /**
    * setUp Function
    */
   protected function setUp() {
      $this->currencyDao = new CurrencyDao();
   }

   /**
    * Test getCurrencyList
    */
   public function testGetCurrencyList() {
      $list = $this->currencyDao->getCurrencyList();
      $this->assertTrue($list instanceof Doctrine_Collection);
   }
}
?>