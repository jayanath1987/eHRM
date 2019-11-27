<?php
require_once 'PHPUnit/Framework.php';

/**
 * Test class CustomerDaoTest
 *
 * @author Sujith T
 */
class CustomerDaoTest extends PHPUnit_Framework_TestCase {

	private $testCases;
	private $customerDao;


	/**
	 * Set up method
	 */
	protected function setUp() {
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/customer.yml');
		$this->customerDao	=	new CustomerDao();
	}

	/**
	 * Test Save Customer
	 * 
	 */
	public function testSaveCustomer() {
		foreach( $this->testCases['Customer'] as $key=>$customer){
			$customer   =	new Customer();
			$customer->setName($customer['name']);
			$result     =	$this->customerDao->saveCustomer($customer);

			$this->testCases['Customer'][$key]["id"] = $customer->getCustomerId();
			$this->assertTrue($result);
		}
		file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/customer.yml',sfYaml::dump($this->testCases));
	}

	/**
	 * Test Read Customer
	 */
	public function testReadCustomer(){
		foreach( $this->testCases['Customer'] as $key=>$customer){
			$result	=	$this->customerDao->readCustomer( $customer['id']);
			$this->assertTrue($result instanceof Customer);
		}
	}

	/**
	 * Test Delete Customer
	 */
	public function testDeleteCustomer(  ){
		$deleteList	=	array();
		foreach( $this->testCases['Customer'] as $key=>$customer){
			array_push($deleteList,$customer['id']);
         unset($this->testCases['Customer'][$key]["id"]);
		}
		$result = $this->customerDao->deleteCustomer( $deleteList );
		$this->assertTrue($result);
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/customer.yml',sfYaml::dump($this->testCases));
	}

	/**
	 * Test Get Customer method
	 */
	public function testGetCustomerList(){
		foreach( $this->customerDao->getCustomerList() as $customer){
			$this->assertTrue($customer instanceof Customer);
		}
	}
}
?>
