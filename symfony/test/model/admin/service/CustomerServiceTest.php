<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test Class for CustomerService
 *
 * @author Sujith T
 */
class CustomerServiceTest extends PHPUnit_Framework_TestCase {

	private $testCases;
	private $customerService;
   private $customerDao;
	

	/**
	 * Set up method
	 * @return unknown_type
	 */
	protected function setUp(){
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/customer.yml');
		$this->customerService	=	new CustomerService();
	}


	/**
	 * Test Save Customer
	 * 
	 */
	public function testSaveCustomer(){
      foreach( $this->testCases['Customer'] as $key => $v){
         $customer	=	new Customer();
         $customer->setName($v['name']);

         $this->customerDao  =	$this->getMock('CustomerDao');
         $this->customerDao->expects($this->once())
               ->method('saveCustomer')
               ->will($this->returnValue(true));
         $this->customerService->setCustomerDao($this->customerDao);
         $result	=	$this->customerService->saveCustomer($customer);
         $this->assertTrue($result);
      }
	}
	
	/**
	 * Test Read Customer
	 * 
	 */
	public function testReadCustomer(){
		foreach( $this->testCases['Customer'] as $key => $v) {
         $customer	=	new Customer();
         $customer->setName($v['name']);
         
         $this->customerDao  =	$this->getMock('CustomerDao');
         $this->customerDao->expects($this->once())
               ->method('readCustomer')
               ->will($this->returnValue($customer));
         $this->customerService->setCustomerDao($this->customerDao);
         
			$result	=	$this->customerService->readCustomer($v['id']);
			$this->assertTrue($result instanceof Customer);
		}
	}

	/**
	 * Test Get Customer method
	 */
	public function testGetCustomerList(){
      $customerDao = new CustomerDao();
      $list = $customerDao->getCustomerList();

      $this->customerDao  =	$this->getMock('CustomerDao');
      $this->customerDao->expects($this->once())
               ->method('getCustomerList')
               ->will($this->returnValue($list));
      $this->customerService->setCustomerDao($this->customerDao);
      $customerList = $this->customerService->getCustomerList();
      $this->assertEquals($customerList, $list);
	}
   
	/**
	 * Test Delete Customer
	 */
	public function testDeleteCustomer(  ){
		$deleteList	=	array(1);
      $this->customerDao  =	$this->getMock('CustomerDao');
      $this->customerDao->expects($this->once())
               ->method('deleteCustomer')
               ->will($this->returnValue(true));
      $this->customerService->setCustomerDao($this->customerDao);
      
		$result = $this->customerService->deleteCustomer($deleteList);
		$this->assertTrue($result);
	}
}