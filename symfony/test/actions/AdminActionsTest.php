<?php
/**
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
 */

require_once 'PHPUnit/Framework.php';
define('SYMFONY_ROOT', dirname(__FILE__) . '/../../');

require_once SYMFONY_ROOT . 'test/util/MockContext.class.php';
require_once SYMFONY_ROOT . 'test/util/MockWebRequest.class.php';
require_once SYMFONY_ROOT . 'apps/orangehrm/modules/admin/actions/actions.class.php';

class AdminActionsTest extends PHPUnit_Framework_TestCase {

    private $flash = array();
    
	/**
	 * Set up method
	 * @return unknown_type
	 */
	protected function setUp() {
        
        /* Create mock objects required for testing */
        $this->context = MockContext::getInstance();

        $request = new MockWebRequest();

        // In sfConfigCache, we just need checkConfig method
        $configCache = $this->getMock('sfConfigCache', array('checkConfig'), array(), '', false);

        // Mock of controller, with redirect method mocked.
        $controller = $this->getMock('sfController', array('redirect'), array(), '', false);
        
        $this->context->request = $request;
        $this->context->configCache = $configCache;
        $this->context->controller = $controller;
	}

    /**
     * Tests executeSaveCompanyLocation for HTTP GET requests.
     * @return void
     */
    public function testExecuteSaveCompanyLocationGet() {

        // List of countries and US provinces for mock service to return.
        $countries = array('US', 'LK', 'ND');
        $provinces = array('NY', 'TX', 'CA');

        $countryService = $this->getMock('CountryService');
        $countryService->expects($this->once())
                       ->method('getCountryList')
                       ->will($this->returnValue($countries));
        $countryService->expects($this->once())
                       ->method('getProvinceList')
                       ->will($this->returnValue($provinces));

        // create action class
        $adminAction = new adminActions($this->context, "admin", "saveCompanyLocation");
        $adminAction->setCountryService($countryService);

        // set request method to GET
        $request = $this->context->request;
        $request->setMethod(sfRequest::GET);

        // Call executeSaveCompanyLocation
        // For a Get request, the method should just fetch a list of countries and us states
        // and store them in two member variables in the action class (which are then accessible through the view)
        $adminAction->executeSaveCompanyLocation($request);

        // Verify retrieved countryList and provinceList have been retrieved        
        $this->assertEquals($countries, $adminAction->countryList);
        $this->assertEquals($provinces, $adminAction->provinceList);
    }

    /**
     * Tests executeSaveCompanyLocation with POST request
     * @return void
     */
    public function testExecuteSaveCompanyLocationPost() {

        // Mock company Service
        $companyService = $this->getMock('CompanyService');

        // Set up mock object to call callback method when saveCompanyLocation is called.
        $companyService->expects($this->once())
                       ->method('saveCompanyLocation')
                       ->will($this->returnCallback(array(&$this, 'saveCompanyLocationCallback')));

        // mock the User class -> expects 'SUCCESS' flash to be set -> see action class
        $user = $this->getMock('sfUser', array('setFlash'), array(), '', false);
        $user->expects($this->exactly(2))
             ->method('setFlash')
             ->will($this->returnCallback(array(&$this, 'setFlash')));
        $this->context->user = $user;

        // finally should redirect to list page
        $this->context->controller->expects($this->once())
                                  ->method('redirect')
                                  ->with($this->equalTo('admin/listCompanylocation'));
        
        // create action class
        $adminAction = new adminActions($this->context, "admin", "saveCompanyLocation");
        $adminAction->setCompanyService($companyService);


        // Set post parameters
    	$parameters = array('txtName'=>'utest loc',
                            'cmbCountry'=>'US',
                            'txtState'=>'CA',
                            'txtCity'=>'Long Beach',
                            'txtAddress'=>'88 Main St',
                            'txtZipCode'=>'889299',
                            'txtPhone'=>'576888299',
                            'txtFax'=>'576829929',
                            'txtComments'=>'none');

        $request = $this->context->request;
        $request->setPostParameters($parameters);

        // Set request to POST method
        $request->setMethod(sfRequest::POST);

        // call action.
        try {
            $adminAction->executeSaveCompanyLocation($request);
            $this->fail("Expected to redirect");
        } catch (sfStopException $e) {
            // expected. redirect throws stop exception in symfony.
        }

        // We verify that:
        // 1) The action gets the POST parameters, creates a CompanyLocation object, sets it's properties and
        //    calls companyService->saveCompanyLocation() passing that object.
        $this->assertTrue(isset($this->location), 'location not saved');
        $this->assertEquals($parameters['txtName'], $this->location->getLocName());
        $this->assertEquals($parameters['cmbCountry'], $this->location->getLocCountry());
        $this->assertEquals($parameters['txtState'], $this->location->getLocState());
        $this->assertEquals($parameters['txtCity'], $this->location->getLocCity());
        $this->assertEquals($parameters['txtAddress'], $this->location->getLocAdd());
        $this->assertEquals($parameters['txtZipCode'], $this->location->getLocZip());
        $this->assertEquals($parameters['txtPhone'], $this->location->getLocPhone());
        $this->assertEquals($parameters['txtFax'], $this->location->getLocFax());
        $this->assertEquals($parameters['txtComments'], $this->location->getLocComments());

        // 2) Sets 'SUCCESS' message
        $this->assertEquals(2, count($this->flashMessages));
        $this->assertTrue(isset($this->flashMessages['message']));
        $this->assertTrue(isset($this->flashMessages['messageType']));
        $this->assertEquals('SUCCESS', $this->flashMessages['messageType']);
        
        // 3) redirects to 'admin/listCompanylocation' (already checked by mock object above)
    }

    /**
     * Call back method for saveCompanyLocation
     * @return string
     */
    public function saveCompanyLocationCallback() {
        
        // verify only one parameter
        $args = func_get_args();
        $this->assertEquals(1, count($args), 'saveCompanyLocation should receive only 1 parameter');
        $location = $args[0];

        $this->assertTrue($location instanceof Location);

        // save to be further checked by test function
        $this->location = $location;
    }

    /**
     * Call back method for setFlash
     * @return string
     */
    public function setFlash() {

        // verify 2 parameters
        $args = func_get_args();
        $this->assertEquals(2, count($args), 'flash should receive 2 parameters');
        $name = $args[0];
        $value = $args[1];

        $this->flashMessages[$name] = $value; 
    }

}