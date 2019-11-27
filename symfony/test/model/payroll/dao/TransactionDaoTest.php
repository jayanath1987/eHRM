<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TransactionDaoTest extends PHPUnit_Framework_TestCase {

 private $transactionDao;
    private $testCases;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/performance/Performance.yml');
        $this->transactionDao = new TransactionDao();
    }

}
?>
