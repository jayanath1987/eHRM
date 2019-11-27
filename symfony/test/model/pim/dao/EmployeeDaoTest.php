<?php
/*
 *
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 *
*/


class EmployeeDaoTest extends PHPUnit_Framework_TestCase{

    private $employeeDao ;
    private $testCases;

    protected function setUp(){

       
        $this->employeeDao	=	new EmployeeDao();
		
		
    }
    
	
    public function testAddEmployee() {
     	$dataEmployee = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/employee_test.yml');
    	foreach($dataEmployee as $empData){
    		$employee	=	new Employee();
    		$employee->setLastName($empData['lastName']);
    		$employee->setFirstName($empData['firstName']);
    		$result		=	$this->employeeDao->addEmployee($employee);
    		$this->assertTrue($result);
    		
    	}
    }
    
    /**
     * Test the GetSupervisorNames function
     */
    public function testGetSupervisorEmployeeChain() {
    	$this->_setSupervisors();
    	
    	$list	=	$this->employeeDao->getSupervisorEmployeeChain(7);
    	$this->assertEquals(count($list),2);
   		
    	$list	=	$this->employeeDao->getSupervisorEmployeeChain(3);
    	$this->assertEquals(count($list),5);
    	
    	$list	=	$this->employeeDao->getSupervisorEmployeeChain(2);
    	$this->assertEquals(count($list),8);
    	
    	$this->_removeSupervisors();
    }
    
    /**
     * Set Supervisors
     * @return unknown_type
     */
    private function _setSupervisors(){
    	 $dataReportTo = sfYaml::load(sfConfig::get('sf_test_dir').'/fixtures/db/50_ReportTo.yml');
    	 foreach($dataReportTo['ReportTo'] as $data){
    	 	$reportTo	=	new ReportTo();
    	 	$reportTo->setErepSupEmpNumber($data['supervisorId']);
    	 	$reportTo->setSubordinateId($data['subordinateId']);
    	 	$reportTo->setReportingMode($data['reportingMode']);
    	 	
    	 	$reportTo->save();
    	 	
    	 }
    	
    	
    }
    
    private function _removeSupervisors(){
    	$q = Doctrine_Query::create()
		    ->delete('ReportTo rt')
		    ->where('rt.reportingMode=1');
       
         $q->execute ();
    }
    
}