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
/**
 * Actions class for Admin module
 *
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Hasha Peiris 
 *  On (Date) - 27 July 2011 
 *  Comments  - Admin main functions 
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
include ('../../lib/common/LocaleUtil.php');

class adminActions extends sfActions {

    protected $countryService;
    protected $companyService;

    /*
     * Return the Country service object
     *
     */

    public function getCountryService() {
        try {
            $countryService = new CountryService();
            $countryDao = new CountryDao();
            $countryService->setCountryDao($countryDao);

            return $countryService;
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        }
    }

    /*
     * set the Country service object
     *
     */

    public function setCountryService(CountryService $countryService) {
        try {
            $this->countryService = $countryService;
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        }
    }

    /*
     * Get the Company service object
     */

    public function getCompanyService() {
        try {
            $companyService = new CompanyService();
            return $companyService;
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        }
    }

    /*
     * Set the Company service object
     */

    public function setCompanyService(CompanyService $companyService) {
        try {
            $this->companyService = $companyService;
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        }
    }

    /*
     * Company general information controller
     */

    public function executeCompanygeninfo(sfWebRequest $request) {
        try {

            $userCulture = $this->getUser()->getCulture();

            //Define data columns according culture
            if ($userCulture == "en") {
                $this->countryName = "cou_name";
                $firstName = "firstName";
                $lastName = "lastName";
            } else {
                $this->countryName = "cou_name_" . $userCulture;
                $firstName = "firstName_" . $userCulture;
                $lastName = "lastName_" . $userCulture;
            }

            $this->form = new CompanygeninfoForm();

            $dao = new CompanyDao();
            $dao->getCompany();
            $countryService = $this->getCountryService();
            $adminService = $this->getCompanyService();

            $this->countryList = $countryService->getCountryList();
            $this->company = $adminService->getCompany();
            $this->companyStructure = $adminService->readCompanyStructure(1);
            $this->employeeName = "";

            if ($this->companyStructure->getEmpNumber() <> "") {
                $employeeService = new EmployeeService();
                $this->employee = $employeeService->getEmployee($this->companyStructure->getEmpNumber());

                $firstNameValue = ($this->employee->$firstName == "") ? $this->employee->firstName : $this->employee->$firstName;
                $lastNameValue = ($this->employee->$lastName == "") ? $this->employee->lastName : $this->employee->$lastName;

                $this->employeeName = $firstNameValue . ' ' . $lastNameValue;
            }

            if ($request->isMethod('post')) {

                $this->form->bind($request->getParameter($this->form->getName()));

                if ($this->form->isValid()) {

                    $company = new Company();
                    $company->setComCode($request->getParameter('txtCode'));
                    $company->setCompanyName($request->getParameter('txtCompanyName'));
                    $company->setCountry($request->getParameter('cmbCountry'));

                    $companyStructure = $adminService->readCompanyStructure($request->getParameter("txtCode"));
                    $companyStructure->setTitle($request->getParameter("txtCompanyName"));
                    $companyStructure->setTitleSI($request->getParameter("txtCompanyNameSI"));
                    $companyStructure->setTitleTA($request->getParameter("txtCompanyNameTA"));

                    $companyStructure->setAddress($request->getParameter("txtAddress"));
                    $companyStructure->setAddressSI($request->getParameter("txtAddressSI"));
                    $companyStructure->setAddressTA($request->getParameter("txtAddressTA"));
                    $companyStructure->setPhoneIntercom($request->getParameter("txtPhoneIntercom"));
                    $companyStructure->setPhoneVIP($request->getParameter("txtPhoneVIP"));
                    $companyStructure->setPhoneDirectLine($request->getParameter("txtPhoneDirectLine"));
                    $companyStructure->setPhoneExtension($request->getParameter("txtPhoneExtension"));
                    $companyStructure->setFax($request->getParameter("txtFax"));
                    $companyStructure->setEmail($request->getParameter("txtEmail"));
                    $companyStructure->setURL($request->getParameter("txtURL"));
                    $companyStructure->setDefLevel(1); // First Level

                    if ($request->getParameter("txtUnitHeadEmpId") == null) {
                        $companyStructure->setEmpNumber(null);
                    } else {
                        $companyStructure->setEmpNumber($request->getParameter("txtUnitHeadEmpId"));
                    }

                    $adminService->saveCompany($company, $companyStructure);
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Saved')));
                    $this->redirect('admin/companygeninfo');
                }
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/companygeninfo');
        }
    }

    /*
     * Get the Company service object
     */

    public function executeGetCompanyDetailsById(sfWebRequest $request) {

        try {


            $id = $request->getParameter('id', false);

            $service = new CompanyService();
            $result = $service->getCompanyDetailsById($id);


            echo json_encode($result[0]);
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    /*
     * Lock the company service
     */

    public function executeLockCompanyDetails(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->setTableLock('hs_hr_compstructtree', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    /*
     * unlock the company service
     */

    public function executeUnlockCompanyDetails(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->resetTableLock('hs_hr_compstructtree', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    /*
     * List Job service controller
     */

    public function executeListJobService(sfWebRequest $request) {
        try {
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];

            $jobDao = new JobDao();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('job.service_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/listJobService');
                }
                $this->var = 1;
            }

            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'job.service_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $jobDao->getJobService($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->listJobTitle = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeListJobCategory(sfWebRequest $request) {
        $jobService = new JobService();
        $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('eec_code', ListSorter::ASCENDING));

        if ($request->getParameter('sort')) {
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));
            $this->jobCategoryList = $jobService->getJobCategoryList($request->getParameter('sort'), $request->getParameter('order'));
        } else {
            if ($request->getParameter('mode') == 'search') {
                if ($request->getParameter('searchMode') != 'all' && $request->getParameter('searchValue') != '') {
                    $this->searchMode = $request->getParameter('searchMode');
                    $this->searchValue = $request->getParameter('searchValue');
                    $this->jobCategoryList = $jobService->searchJobCategory($this->searchMode, $this->searchValue);
                } else {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->jobCategoryList = $jobService->getJobCategoryList();
                }
            }else
                $this->jobCategoryList = $jobService->getJobCategoryList();
        }
    }

    public function executeDeleteJobCategory(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $jobService = new JobService();
            $jobService->deleteJobCategory($request->getParameter('chkLocID'));
            $this->setMessage('SUCCESS', array('Successfully Deleted'));
        }else
            $this->setMessage('NOTICE', array('Select at least one record to delete'));

        $this->redirect('admin/listJobCategory');
    }

    public function executeSaveJobCategory(sfWebRequest $request) {

        if ($request->isMethod('post')) {
            $jobService = new JobService();

            $jobCategory = new JobCategory();
            $jobCategory->setEecDesc($request->getParameter('txtName'));

            try {
                $jobService->saveJobCategory($jobCategory);
                $this->setMessage('SUCCESS', array('Successfully Added'));
                $this->redirect('admin/listJobCategory');
            } catch (DuplicateNameException $e) {
                $this->setMessage('WARNING', array('A job category with the given name already exists!'));
            }
        }
    }

    public function executeUpdateJobCategory(sfWebRequest $request) {
        $this->form = new UpdateJobCategoryForm(array(), array(), true);
        $jobService = new JobService();
        $jobCategory = $jobService->readJobCategory($request->getParameter('id'));
        $this->jobCategory = $jobCategory;

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $jobCategory->setEecDesc($request->getParameter('txtName'));
                try {
                    $jobService->saveJobCategory($jobCategory);
                    $this->setMessage('SUCCESS', array('Successfully Updated'));
                    $this->redirect('admin/listJobCategory');
                } catch (DuplicateNameException $e) {
                    $this->setMessage('WARNING', array('A job category with the given name already exists!'));
                }
            }
        }
    }

    public function executeListEmployeeStatus(sfWebRequest $request) {
        $jobService = new JobService();
        $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('estat_code', ListSorter::ASCENDING));

        if ($request->getParameter('sort')) {
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));
            $this->listEmpStatus = $jobService->getEmployeeStatusList($request->getParameter('sort'), $request->getParameter('order'));
        } else {
            if ($request->getParameter('mode') == 'search') {
                if ($request->getParameter('searchMode') != 'all' && $request->getParameter('searchValue') != '') {
                    $this->searchMode = $request->getParameter('searchMode');
                    $this->searchValue = $request->getParameter('searchValue');
                    $this->listEmpStatus = $jobService->searchEmployeeStatus($this->searchMode, $this->searchValue);
                } else {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/listEmployeeStatus');
                }
            }else
                $this->listEmpStatus = $jobService->getEmployeeStatusList();
        }
    }

    public function executeSaveEmployeeStatus(sfWebRequest $request) {
        if ($request->isMethod('post')) {
            $jobService = new JobService();

            $employeeStatus = new EmployeeStatus();
            $employeeStatus->setEstatName($request->getParameter('txtName'));
            $jobService->saveEmployeeStatus($employeeStatus);

            $this->setMessage('SUCCESS', array('Successfully Added'));
            $this->redirect('admin/listEmployeeStatus');
        }
    }

    public function executeUpdateEmployeeStatus(sfWebRequest $request) {
        $this->form = new UpdateEmployeeStatusForm(array(), array(), true);
        $jobService = new JobService();
        $employeeStatus = $jobService->readEmployeeStatus($request->getParameter('id'));
        $this->employeeStatus = $employeeStatus;
        if ($request->isMethod('post')) {

            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $employeeStatus->setEstatName($request->getParameter('txtName'));
                $jobService->saveEmployeeStatus($employeeStatus);
                $this->setMessage('SUCCESS', array('Successfully Updated'));
                $this->redirect('admin/listEmployeeStatus');
            }
        }
    }

    public function executeDeleteEmployeeStatus(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $jobService = new JobService();
            $jobService->deleteEmployeeStatus($request->getParameter('chkLocID'));

            $this->setMessage('SUCCESS', array('Successfully Deleted'));
        }else
            $this->setMessage('NOTICE', array('Select at least one record to delete'));

        $this->redirect('admin/listEmployeeStatus');
    }

    public function executeListJobTitle(sfWebRequest $request) { //print_r($request->getParameter('page'));
        try {
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];

            $jobDao = new JobDao();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('job.id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/listJobTitle');
                }
                $this->var = 1;
            }

            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'job.id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            //die(print_r($request));
            if($request->getParameter('pg')){//print("pg");
              $page=1;  
            }else{ //$page=1;
                //print("page");
            $page=$request->getParameter('page');
            }
            $res = $jobDao->getJobTitleList1($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order,$page );
            $this->listJobTitle = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveJobTitle(sfWebRequest $request) {
        $this->myCulture = $this->getUser()->getCulture();
        $jobDao = new JobDao();
        $knwdt = new JobTitle();

        if ($request->isMethod('post')) {

            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setName(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setName(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setName_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setName_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setName_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setName_ta(null);
            }







            try {
                $jobDao->saveJobTitle1($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobTitle');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobTitle');
            }

            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
            $this->redirect('admin/listJobTitle');
        }
    }

    public function executeUpdateJobTitle(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();
        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }
        $transPid = $encrypt->decrypt($request->getParameter('id'));
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_job_title', array($transPid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {

                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_job_title', array($transPid), 1);
                $this->lockMode = 0;
            }
        }


        $this->myCulture = $this->getUser()->getCulture();
        $jobDao = new JobDao();


        $knwdt = $jobDao->readJobTitle($transPid);


        $this->benifittypelist = $knwdt;
        if ($request->isMethod('post')) {

            if (strlen($request->getParameter('txtName'))) {
                $knwdt->setName(trim($request->getParameter('txtName')));
            } else {
                $knwdt->setName(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $knwdt->setName_si(trim($request->getParameter('txtNamesi')));
            } else {
                $knwdt->setName_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $knwdt->setName_ta(trim($request->getParameter('txtNameta')));
            } else {
                $knwdt->setName_ta(null);
            }

            try {
                $jobDao->saveJobTitle1($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/updateJobTitle?id=' . $encrypt->encrypt($knwdt->getId()) . '&lock=' . $encrypt->encrypt(0));
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/updateJobTitle?id=' . $encrypt->encrypt($knwdt->getId()) . '&lock=' . $encrypt->encrypt(0));
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('admin/updateJobTitle?id=' . $encrypt->encrypt($knwdt->getId()) . '&lock=' . $encrypt->encrypt(0));
        }
    }

    public function executeSaveJobTitleEmployeeStatus(sfWebRequest $request) {
        if ($request->isMethod('post')) {
            $id = $request->getParameter('id');
            $empStatusId = $request->getParameter('txtEmpStatID');

            $jobService = new JobService();

            if ($empStatusId == '')
                $employeeStatus = new EmployeeStatus();
            else
                $employeeStatus = $jobService->readEmployeeStatus($empStatusId);

            $employeeStatus->setEstatName($request->getParameter('txtEmpStatDesc'));
            $jobService->saveEmployeeStatus($employeeStatus);


            $this->redirect('admin/updateJobTitle?id=' . $id);
        }
    }

    public function executeDeleteJobTitle(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $jobDao = new JobDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_job_title', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $jobDao->deleteJobTitle1($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_job_title', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobTitle');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobTitle');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listJobTitle');
    }

    public function executeListLicenses(sfWebRequest $request) {
        $educationService = new EducationService();
        $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('eduCode', ListSorter::ASCENDING));

        if ($request->getParameter('sort')) {
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));
            $this->listLicenses = $educationService->getLicensesList($request->getParameter('sort'), $request->getParameter('order'));
        } else {
            if ($request->getParameter('mode') == 'search') {
                if ($request->getParameter('searchMode') != 'all' && $request->getParameter('searchValue') != '') {
                    $this->searchMode = $request->getParameter('searchMode');
                    $this->searchValue = $request->getParameter('searchValue');
                    $this->listLicenses = $educationService->searchLicenses($this->searchMode, $this->searchValue);
                } else {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/listLicenses');
                }
            }else
                $this->listLicenses = $educationService->getLicensesList();
        }
    }

    public function executeSaveLicenses(sfWebRequest $request) {
        $educationService = new EducationService();
        if ($request->isMethod('post')) {


            $licenses = new Licenses();
            $licenses->setLicensesDesc($request->getParameter('txtLicensesDesc'));

            try {
                $educationService->saveLicenses($licenses);

                $this->setMessage('SUCCESS', array('Successfully Added'));
                $this->redirect('admin/listLicenses');
            } catch (DuplicateNameException $e) {
                $this->setMessage('WARNING', array('A license with given description already exists!'));
            }
        }
    }

    public function executeUpdateLicenses(sfWebRequest $request) {
        $this->form = new UpdateLicensesForm(array(), array(), true);
        $educationService = new EducationService();
        $licenses = $educationService->readLicenses($request->getParameter('id'));
        $this->licenses = $licenses;
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                try {
                    $licenses->setLicensesDesc($request->getParameter('txtLicensesDesc'));
                    $educationService->saveLicenses($licenses);
                    $this->setMessage('SUCCESS', array('Successfully Updated'));
                    $this->redirect('admin/listLicenses');
                } catch (DuplicateNameException $e) {
                    $this->setMessage('WARNING', array('A license with given description already exists!'));
                }
            }
        }
    }

    public function executeDeleteLicenses(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $educationService = new EducationService();
            $educationService->deleteLicenses($request->getParameter('chkLocID'));
            $this->setMessage('SUCCESS', array('Successfully Deleted'));
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listLicenses');
    }

    public function executeListNationality(sfWebRequest $request) {
        $nationalityService = new NationalityService();
        $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('nat_code', ListSorter::ASCENDING));

        if ($request->getParameter('mode') == 'search') {
            if ($request->getParameter('searchMode') != 'all' && $request->getParameter('searchValue') != '') {
                $this->searchMode = $request->getParameter('searchMode');
                $this->searchValue = $request->getParameter('searchValue');
                $this->listNationality = $nationalityService->searchNationality($this->searchMode, $this->searchValue);
            } else {

                $this->setMessage('NOTICE', array('Select the field to search'));
                $this->redirect('admin/listNationality');
            }
        } else {
            if ($request->getParameter('sort')) {
                $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));
                $this->listNationality = $nationalityService->getNationalityList($request->getParameter('sort'), $request->getParameter('order'));
            }else
                $this->listNationality = $nationalityService->getNationalityList();
        }
    }

    public function executeSaveNationality(sfWebRequest $request) {
        $nationalityService = new NationalityService();
        if ($request->isMethod('post')) {


            $nationality = new Nationality();
            $nationality->setNatName($request->getParameter('txtNationalityInfoDesc'));
            $nationalityService->saveNationality($nationality);
            $this->setMessage('SUCCESS', array('Successfully Added'));
            $this->redirect('admin/listNationality');
        }
    }

    public function executeUpdateNationality(sfWebRequest $request) {
        $this->form = new UpdateNationalityForm(array(), array(), true);
        $nationalityService = new NationalityService();
        $nationality = $nationalityService->readNationality($request->getParameter('id'));
        $this->nationality = $nationality;

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $nationality->setNatName($request->getParameter('txtNationalityInfoDesc'));
                $nationalityService->saveNationality($nationality);
                $this->setMessage('SUCCESS', array('Successfully Updated'));
                $this->redirect('admin/listNationality');
            }
        }
    }

    public function executeDeleteNationality(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $nationalityService = new NationalityService();
            $nationalityService->deleteNationality($request->getParameter('chkLocID'));
            $this->setMessage('SUCCESS', array('Successfully Deleted'));
        }else
            $this->setMessage('NOTICE', array('Select at least one record to delete'));

        $this->redirect('admin/listNationality');
    }

    public function executeListEthnicRace(sfWebRequest $request) {
        $nationalityService = new NationalityService();
        $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('ethnic_race_code', ListSorter::ASCENDING));

        if ($request->getParameter('sort')) {
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));
            $this->listEthnicRace = $nationalityService->getEthnicRaceList($request->getParameter('sort'), $request->getParameter('order'));
        } else {
            if ($request->getParameter('mode') == 'search') {
                if ($request->getParameter('searchMode') != 'all' && $request->getParameter('searchValue') != '') {
                    $this->searchMode = $request->getParameter('searchMode');
                    $this->searchValue = $request->getParameter('searchValue');
                    $this->listEthnicRace = $nationalityService->searchEthnicRace($this->searchMode, $this->searchValue);
                } else {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/listEthnicRace');
                }
            }else
                $this->listEthnicRace = $nationalityService->getEthnicRaceList();
        }
    }

    public function executeSaveEthnicRace(sfWebRequest $request) {
        $nationalityService = new NationalityService();
        if ($request->isMethod('post')) {


            $ethnicRace = new EthnicRace();
            $ethnicRace->setEthnicRaceDesc($request->getParameter('txtEthnicRaceDesc'));
            $nationalityService->saveEthnicRace($ethnicRace);
            $this->setMessage('SUCCESS', array('Successfully Added'));
            $this->redirect('admin/listEthnicRace');
        }
    }

    public function executeUpdateEthnicRace(sfWebRequest $request) {
        $this->form = new UpdateEthnicRaceForm(array(), array(), true);
        $nationalityService = new NationalityService();
        $ethnicRace = $nationalityService->readEthnicRace($request->getParameter('id'));
        $this->ethnicRace = $ethnicRace;

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $ethnicRace->setEthnicRaceDesc($request->getParameter('txtEthnicRaceDesc'));
                $nationalityService->saveEthnicRace($ethnicRace);
                $this->setMessage('SUCCESS', array('Successfully Updated'));
                $this->redirect('admin/listEthnicRace');
            }
        }
    }

    public function executeDeleteEthnicRace(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $nationalityService = new NationalityService();
            $nationalityService->deleteEthnicRace($request->getParameter('chkLocID'));
            $this->setMessage('SUCCESS', array('Successfully Deleted'));
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listEthnicRace');
    }

    public function executeListUserGroup(sfWebRequest $request) {
        $userService = new UserService();

        $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('userg_id', ListSorter::ASCENDING));

        if ($request->getParameter('sort')) {
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));
            $this->listUserGroup = $userService->getUserGroupList($request->getParameter('sort'), $request->getParameter('order'));
        } else {
            if ($request->getParameter('mode') == 'search') {
                if ($request->getParameter('searchMode') != 'all' && $request->getParameter('searchValue') != '') {
                    $this->searchMode = $request->getParameter('searchMode');
                    $this->searchValue = $request->getParameter('searchValue');
                    $this->listUserGroup = $userService->searchUserGroup($this->searchMode, $this->searchValue);
                } else {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/listUserGroup');
                }
            }else
                $this->listUserGroup = $userService->getUserGroupList();
        }
    }

    public function executeSaveUserGroup(sfWebRequest $request) {
        $userService = new UserService();
        if ($request->isMethod('post')) {

            $userGroup = new UserGroup();
            $userGroup->setUsergName($request->getParameter('txtUserGroupName'));

            try {
                $userGroup = $userService->saveUserGroup($userGroup);

                $this->setMessage('SUCCESS', array('Successfully Added'));
                $this->redirect('admin/listUserGroupRight?id=' . $userGroup->getUsergId());
            } catch (DuplicateNameException $e) {
                $this->setMessage('WARNING', array('A user group with given name already exists!'));
            }
        }
    }

    public function executeUpdateUserGroup(sfWebRequest $request) {
        $this->form = new UpdateUserGroupForm(array(), array(), true);

        $userService = new UserService();
        $userGroup = $userService->readUserGroup($request->getParameter('id'));
        $this->userGroup = $userGroup;
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $userGroup->setUsergName($request->getParameter('txtUserGroupName'));
                try {
                    $userService->saveUserGroup($userGroup);
                    $this->setMessage('SUCCESS', array('Successfully Updated'));
                    $this->redirect('admin/listUserGroup');
                } catch (DuplicateNameException $e) {
                    $this->setMessage('WARNING', array('A user group with given name already exists!'));
                }
            }
        }
    }

    public function executeDeleteUserGroup(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $userService = new UserService();
            $userService->deleteUserGroup($request->getParameter('chkLocID'));
            $this->setMessage('SUCCESS', array('Successfully Deleted'));
        }else
            $this->setMessage('NOTICE', array('Select at least one record to delete'));

        $this->redirect('admin/listUserGroup');
    }

    public function executeListUserGroupRight(sfWebRequest $request) {
        $userService = new UserService();
        $userGroup = $userService->readUserGroup($request->getParameter('id'));
        $this->userGroup = $userGroup;
        $this->moduleList = $userService->getModuleList($userGroup);
        $this->moduleRights = $userService->getUserGroupModelRights($userGroup);
        $this->currentUserGroup = $_SESSION['userGroup'];
    }

    public function executeSaveUserGroupRight(sfWebRequest $request) {
        $userService = new UserService();
        $userGroup = $userService->readUserGroup($request->getParameter('id'));

        $moduleRights = new ModuleRights();
        $moduleRights->setUsergId($request->getParameter('id'));
        $moduleRights->setModId($request->getParameter('cmbModuleID'));
        $moduleRights->setAddition($request->getParameter('chkAdd'));
        $moduleRights->setEditing($request->getParameter('chkEdit'));
        $moduleRights->setDeletion($request->getParameter('chkDelete'));
        $moduleRights->setViewing($request->getParameter('chkView'));
        $userService->saveUserGroupModelRights($moduleRights);

        $this->redirect('admin/listUserGroupRight?id=' . $userGroup->getUsergId());
    }

    public function executeDeleteUserGroupRight(sfWebRequest $request) {
        $userService = new UserService();
        $userGroup = $userService->readUserGroup($request->getParameter('id'));
        $userService->deleteUserGroupModelRights($userGroup);

        $this->redirect('admin/listUserGroupRight?id=' . $userGroup->getUsergId());
    }

    public function executeListUser(sfWebRequest $request) {


        try {
            $this->Culture = $this->getUser()->getCulture();

            $userService = new UserService();

            $AdminSearchService=new AdminSearchService();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/listUser');
                }
                $this->var = 1;
            }

            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $res = $AdminSearchService->getUsersList($this->searchMode, $this->searchValue, $this->culture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listUser = $res['data'];

            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveUser(sfWebRequest $request) {
        try {
            $this->userCulture = $this->getUser()->getCulture();
            $userService = new UserService();
            $companyService = new CompanyService();
            if ($request->isMethod('post')) {

                if ($userService->isExistingUser($request->getParameter('txtUserName'))) {
                    $flag = 0;
                } elseif ($userService->isAlreadyAssign($request->getParameter('txtEmpId'))) {
                    $flag = 1;
                } else {
                    $flag = 2;
                }



                if ($flag == 2) {
                    $user = new Users();
                    $user->setIsAdmin("No");
                    $user->setCreated_by($_SESSION['user']);
                    $user->setUserName($request->getParameter('txtUserName'));
                    $user->setUserPassword(md5($request->getParameter('txtUserName')));
                    $user->setUsergId($request->getParameter('cmbUserGroupID'));
                    $user->setSm_capability_id($request->getParameter('cmbCapbilityName'));
                    $user->setStatus($request->getParameter('cmbUserStatus'));
                    $user->setDef_level($request->getParameter('cmbLevel'));
                    $user->setUser_prefered_language("en");
                    $user->setDate_entered(date("Y-m-d", time()));
                    if ($request->getParameter('txtEmpId') != '')
                        $user->setEmpNumber($request->getParameter('txtEmpId'));

                    $empDao = new EmployeeDao();
                    $empObj = $empDao->readEmployee($request->getParameter('txtEmpId'));
                    $userDefLevel = $userService->getUserDefLevel($empObj->work_station);
                    $userDefLevel = $userDefLevel[0]['def_level'];
                    if ($userDefLevel <= 3 && $request->getParameter('cmbLevel') == 3) {

                        throw new Exception("User is not allow to assign to this security level", 502);
                    }
                    $userService->saveUser($user);
                    $this->setMessage('SUCCESS', array('Successfully Added'));
                    $this->redirect('admin/listUser');
                } elseif ($flag == 0) {
                    $this->setMessage('NOTICE', array('User name already exists'));
                    $this->redirect('admin/saveUser');
                } else {
                    $this->setMessage('NOTICE', array('This Employee is already assigned'));
                    $this->redirect('admin/saveUser');
                }
            }

            $this->userType = $request->getParameter('isAdmin');

            $this->capabilityList = $userService->getCapabilityList();
            $this->secLevel = $userService->getSecurityLevel();
            $this->empJson = $companyService->getEmployeeListAsJson();
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listUser');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listUser');
        }
    }

    public function executeUpdateUser(sfWebRequest $request) {

        try {
            if (!strlen($request->getParameter('lock'))) {
                $this->lockMode = 0;
            } else {
                $this->lockMode = $request->getParameter('lock');
            }
            $userId = $request->getParameter('id');
            if (isset($this->lockMode)) {
                if ($this->lockMode == 1) {

                    $conHandler = new ConcurrencyHandler();

                    $recordLocked = $conHandler->setTableLock('hs_hr_users', array($userId), 2);

                    if ($recordLocked) {
                        // Display page in edit mode
                        $this->lockMode = 1;
                    } else {
                        $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                        $this->lockMode = 0;
                    }
                } else if ($this->lockMode == 0) {
                    $conHandler = new ConcurrencyHandler();
                    $recordLocked = $conHandler->resetTableLock('hs_hr_users', array($userId), 2);
                    $this->lockMode = 0;
                }
            }



            $this->userCulture = $this->getUser()->getCulture();
            $this->form = new UpdateUserForm(array(), array(), true);

            $companyService = new CompanyService();
            $userService = new UserService();

            $user = $userService->readUser($request->getParameter('id'));
            $this->user = $user;
            $this->userType = $request->getParameter('isAdmin');
            $this->capabilityList = $userService->getCapabilityList();
            $this->secLevel = $userService->getSecurityLevel();
            //$this->empJson = $companyService->getEmployeeListAsJson();
            if ($request->isMethod('post')) {


                $this->form->bind($request->getParameter($this->form->getName()));
                if ($this->form->isValid()) {
                    $user->setIsAdmin("No");
                    $user->setUserName($request->getParameter('txtUserName'));

                    $user->setUsergId($request->getParameter('cmbUserGroupID'));
                    $user->setStatus($request->getParameter('cmbUserStatus'));
                    $user->setSm_capability_id($request->getParameter('cmbCapbilityName'));
                    $user->setDef_level($request->getParameter('cmbLevel'));
                    $user->setDate_modified(date("Y-m-d", time()));
                    $user->setModified_user_id($_SESSION['user']);


                    if ($request->getParameter('txtEmpId') != '' || $request->getParameter('txtEmpId') != null) { // if its not an admin
                        $user->setEmpNumber($request->getParameter('txtEmpId'));
                    }

                    $empDao = new EmployeeDao();
                    $empObj = $empDao->readEmployee($request->getParameter('txtEmpId'));
                    $userDefLevel = $userService->getUserDefLevel($empObj->work_station);
                    $userDefLevel = $userDefLevel[0]['def_level'];
                    if ($userDefLevel <= 3 && $request->getParameter('cmbLevel') == 3) {

                        throw new Exception("Security Level is not allowed to select this division/department", 502);
                    }

                    $userService->saveUser($user);

                    $this->setMessage('SUCCESS', array('Successfully Updated'));
                    $this->redirect('admin/updateUser?lock=0&id=' . $user->getId());
                }
            }




        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listUser');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listUser');
        }
    }

    public function executeDeleteUser(sfWebRequest $request) {


        if (count($request->getParameter('chkLocID')) > 0) {
            $userService = new UserService();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');
                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_users', array($ids[$i]), 1);
                    if ($isRecordLocked) {
                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];

                        $userService->deleteUser("$ids[$i]");
                        $conHandler->resetTableLock('hs_hr_users', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {

                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listUser');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listUser');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listUser');
    }

    public function executeGetProvinceListJson(sfWebRequest $request) {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        sfConfig::set('sf_debug', false);

        $provinces = array();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
        }

        $countryCode = $request->getParameter('country');

        if (!empty($countryCode)) {
            $countryService = $this->getCountryService();

            // TODO: call method that returns data in array format (or pass parameter)
            $provinceList = $countryService->getProvinceList($countryCode);

            foreach ($provinceList as $province) {
                $provinces[] = array('code' => $province->province_code, 'name' => $province->province_name);
            }
        }

        return $this->renderText(json_encode($provinces));
    }

    public function executeGetJobSpecJson(sfWebRequest $request) {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        sfConfig::set('sf_debug', false);

        $jobSpec = array();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
        }

        $jobId = $request->getParameter('job');

        if (!empty($jobId)) {
            $jobService = new JobService();
            $jobSpec = $jobService->getJobSpecForJob($jobId, true);
        }

        return $this->renderText(json_encode($jobSpec));
    }

    public function executeGetEmpStatusesJson(sfWebRequest $request) {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        sfConfig::set('sf_debug', false);

        $empStatuses = array();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
        }

        $jobId = $request->getParameter('job');

        if (!empty($jobId)) {
            $jobService = new JobService();
            $empStatuses = $jobService->getEmployeeStatusForJob($jobId, true);
        }

        return $this->renderText(json_encode($empStatuses));
    }

    public function executeGetMinMaxSalaryJson(sfWebRequest $request) {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        sfConfig::set('sf_debug', false);

        $salaryGrade = $request->getParameter('salaryGrade');
        $currency = $request->getParameter('currency');

        $minMax = array();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
        }

        if (!empty($salaryGrade) && !empty($currency)) {
            $jobService = new JobService();

            $salaryCurrency = $jobService->getSalaryCurrencyDetail($salaryGrade, $currency);
            if ($salaryCurrency) {
                $minMax = array('min' => $salaryCurrency->min_salary, 'max' => $salaryCurrency->max_salary);
            }
        }

        return $this->renderText(json_encode($minMax));
    }

    public function executeUnauthorized(sfWebRequest $request) {
        sfConfig::set('sf_web_debug', false);
        sfConfig::set('sf_debug', false);

        $response = $this->getResponse();
        $response->setStatusCode(401, 'Not authorized');
        return $this->renderText("You do not have the proper credentials to access this page!");
    }

    public function setMessage($messageType, $message = array(), $persist = true) {
        $this->getUser()->setFlash('messageType', $messageType, $persist);
        $this->getUser()->setFlash('message', $message, $persist);
    }

    function executeListCompanyStructure(sfWebRequest $request) {

        try {
            $userCulture = $this->getUser()->getCulture();
            $this->userCulture = $this->getUser()->getCulture();
            //Define data columns according culture
            if ($userCulture == "en") {
                $this->titleCol = "title";
                $this->firstNameCol = "firstName";
                $this->lastNameCol = "lastName";
            } else {
                $this->titleCol = "title_" . $userCulture;
                $this->firstNameCol = "firstName_" . $userCulture;
                $this->lastNameCol = "lastName_" . $userCulture;
            }

            $companyService = $this->getCompanyService();
            $companayDao = new CompanyDao();
            $this->emprole = $companayDao->getEmpRole();
            $this->ProvinceList = $companayDao->getProvinceList();
            
            //$this->hie_list=$companayDao->getHirachyAllList();
            //$this->hie_html=$companayDao->getHieHtml();
            //check whether user clicks delete button
            if($request->getParameter('hiecodelevel')==null){
                $this->hiecodelevel= 7;
            }else{
                $this->hiecodelevel= $request->getParameter('hiecodelevel');
            }
            

            if ($request->isMethod('get') && $request->getParameter("mode") == "delete") {

                $node = $companyService->readCompanyStructure($request->getParameter("node_id"));
                if ($node) {
                    $children = $node->getChildren();

                    if (count($children) > 0) {
                        $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('This record may uses another place')));
                        $this->redirect('admin/listCompanyStructure');
                    } else {

                        foreach ($children as $child) {
                            $companayDao->deleteCompanyStructuredetails($child->getId());
                            $companyService->deleteCompanyStructure($child->getId());
                        }
                        $companayDao->deleteCompanyStructuredetails($node->getId());
                        $companyService->deleteCompanyStructure($node->getId());
                        $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
                        $this->redirect('admin/listCompanyStructure');
                    }
                }
            }



            $root = $companyService->readCompanyStructure(1);
            $rootName = "";
            if ($root instanceof CompanyStructure) {
                $rootName = $root->getTitle();
            }
            //$CSD = $root->getId();
            $this->rootName = $rootName;
            $this->root = $root;
            $this->list = $list;
            $this->mode = $request->getParameter('mode', null);
            $this->method = $request->getParameter('method', null);
            // Company Struture Grid is Loaded Here

//                if ($request->isMethod('post')) {
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];

            $jobDao = new JobDao();

            //$this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('job.id', ListSorter::ASCENDING));
            //$this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

//            if ($request->getParameter('mode') == 'search') {
//                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
//                    $this->setMessage('NOTICE', array('Select the field to search'));
//                    $this->redirect('default/error');
//                }
//                $this->var = 1;
//            }

            $this->searchMode = ($request->getParameter('cmbSearchMode') == null) ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == null) ? '' : $request->getParameter('txtSearchValue');
            $this->searchCategory = ($request->getParameter('cmbHicCategory') == null) ? '' : $request->getParameter('cmbHicCategory');
            if(strlen($this->searchCategory)){
                $this->selectedCat=$this->searchCategory;
            }
            $this->sort = ($request->getParameter('sort') == '') ? 'c.id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $res = $companayDao->loadHicStrutByType($this->searchCategory,$this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));

            $this->listComPanyStrut = $res['data'];
//            die(print_r($this->listComPanyStrut));
            if($this->searchCategory!="0"){
            $this->pglay = $res['pglay'];

            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            }
            if (count($res['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }



//                }
        } catch (sfStopException $sf) {
            
        }
        catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
        catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    function executeSaveCompanyStructure(sfWebRequest $request) {
        try {
            //data posted
            $CompanaDao = new CompanyDao();
            if ($request->isMethod('post')) {

                $companyStructure = null;
                $companyService = new CompanyService();

                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();

                //this is an insert else update
                if (trim($request->getParameter('id')) == "") {

                    $companyStructure = new CompanyStructure();
                    $last = $CompanaDao->getLastCompanyStructureTreeID();
                    $last = $last[0]['MAX'];
                    $Last = $last + 1;
                    $companyStructure->setId($Last);
                } else {

                    $companyStructure = $companyService->readCompanyStructure(trim($request->getParameter('id')));
                    $CompanaDao->deleteCompanyStructuredetails(trim($request->getParameter('id')));
                }

                $companyStructure->setComp_code($request->getParameter("txtDivisionCode"));
                $companyStructure->setParnt($request->getParameter("txtParnt"));
                if (strlen($request->getParameter('txtCompanyName'))) {
                    $companyStructure->setTitle(trim($request->getParameter('txtCompanyName')));
                } else {
                    $companyStructure->setTitle(Null);
                }
                if ($request->getParameter('txtCompanyNameSI') != null) {
                    $companyStructure->setTitleSI(trim($request->getParameter('txtCompanyNameSI')));
                } else {
                    $companyStructure->setTitleSI(Null);
                }
                if ($request->getParameter('txtCompanyNameTA') != null) {
                    $companyStructure->setTitleTA(trim($request->getParameter('txtCompanyNameTA')));
                } else {
                    $companyStructure->setTitleTA(Null);
                }


                $companyStructure->setAddress($request->getParameter("txtAddress"));
                $companyStructure->setAddressSI($request->getParameter("txtAddressSI"));
                $companyStructure->setAddressTA($request->getParameter("txtAddressTA"));
                $companyStructure->setPhoneIntercom($request->getParameter("txtPhoneIntercom"));
                $companyStructure->setPhoneVIP($request->getParameter("txtPhoneVIP"));
                $companyStructure->setPhoneDirectLine($request->getParameter("txtPhoneDirectLine"));
                $companyStructure->setPhoneExtension($request->getParameter("txtPhoneExtension"));
                $companyStructure->setFax($request->getParameter("txtFax"));
                $companyStructure->setEmail($request->getParameter("txtEmail"));
                $companyStructure->setURL($request->getParameter("txtURL"));
                $companyStructure->setDefLevel($request->getParameter("txtDefLevel"));
                if ($request->getParameter("txtLocationDBReferenceCode") != null) {
                    $companyStructure->setComp_location_code(trim($request->getParameter("txtLocationDBReferenceCode")));
                } else {
                    $companyStructure->setComp_location_code(null);
                }
                if ($request->getParameter("txtAdditionalReferenceCode") != null) {
                    $companyStructure->setComp_reference_code(trim($request->getParameter("txtAdditionalReferenceCode")));
                } else {
                    $companyStructure->setComp_reference_code(null);
                }

                if (!strlen($request->getParameter("txtUnitHeadEmpId"))) {

                    $companyStructure->setEmpNumber(Null);
                } else {

                    $companyStructure->setEmpNumber($request->getParameter("txtUnitHeadEmpId"));
                }
                if (!strlen($request->getParameter("radioFunctional"))) {

                    $companyStructure->setComp_isfunctional(Null);
                } else {

                    $companyStructure->setComp_isfunctional($request->getParameter("radioFunctional"));
                }


                $companyService->saveCompanyStructure($companyStructure);


                $companyDao = new CompanyDao();
                if (trim($request->getParameter('id')) == "") {

                    $lastid = $companyDao->getLastCompanyStructureTreeID();
                    $lastid = $lastid[0]['MAX'];
                    $deleteUnitHeads = $companyDao->deleteAllunitHeads($lastid);
                } else {

                    $lastid = $request->getParameter('id');
                    $deleteUnitHeads = $companyDao->deleteAllunitHeads($lastid);
                }

                $exploed = array();
                $count_rows = array();
                foreach ($_POST as $key => $value) {


                    $exploed = explode("_", $key);

                    if (strlen($exploed[1])) {
                        $count_rows[] = $exploed[1];

                        $arrname = "a_" . $exploed[1];

                        if (!is_array($$arrname)) {
                            $$arrname = Array();
                        }

                        ${$arrname}[$exploed[0]] = $value;
                    }
                }

                $uniqueRowIds = array_unique($count_rows);
                $uniqueRowIds = array_values($uniqueRowIds);

                for ($i = 0; $i < count($uniqueRowIds); $i++) {

                    $csd = new CompanyStructureDetails();


                    $v = "a_" . $uniqueRowIds[$i];

                    if (strlen(${$v}[CmbEmpRole])) {
                        $csd->setRole_group_id(${$v}[CmbEmpRole]);
                    } else {
                        $csd->setRole_group_id(null);
                    }
                    if (strlen(${$v}[hiddenEmpID])) {
                        $csd->setEmp_number(${$v}[hiddenEmpID]);
                    } else {
                        $csd->setEmp_numbere(null);
                    }

                    if (strlen($lastid)) {
                        $csd->setId($lastid);
                    } else {
                        $csd->setId(null);
                    }
                    $companyDao = new CompanyDao();
                    $companyDao->saveCompanyStructureTreeDetails($csd);
                }
                $conn->commit();
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Updated')));
                $this->redirect('admin/listCompanyStructure');
            } else {
                $this->redirect('admin/listCompanyStructure');
                die;
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listCompanyStructure');
        } catch (Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listCompanyStructure');
        }
    }

    public function executeGetUnitHeadListbyId(sfWebRequest $request) {
        $compHic_Id = $request->getParameter('id');

        $companyDao = new CompanyDao();
        $employeeArray = $companyDao->getheadEmployeeListbyID($compHic_Id);
        $employeeIds = array();
        foreach ($employeeArray as $key => $value) {
            $employeeIds[] = $employeeArray[$key]['emp_number'];
        }
        echo json_encode($employeeIds);
        die;
    }

    public function executeListLanguage(sfWebRequest $request) {
        try {
            $this->userCulture = $this->getUser()->getCulture();
            $languageService = new LanguageService();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('lang_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'lang_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $languageService->searchLanguage($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listLanguage = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeListClass(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $classDao = new classDao();


            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('class_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'class_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $classDao->SerachClass($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listClass = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveClass(sfWebRequest $request) {

        try {
            $classDao = new classDao();


            if ($request->isMethod('post')) {
                $empclass = new EmpClass();


                if (strlen($request->getParameter('txtName'))) {
                    $empclass->setClass_name(trim($request->getParameter('txtName')));
                } else {
                    $empclass->setClass_name(null);
                }
                if (($request->getParameter('txtNamesi')) != null) {
                    $empclass->setClass_name_si(trim($request->getParameter('txtNamesi')));
                } else {
                    $empclass->setClass_name_si(null);
                }
                if (($request->getParameter('txtNameta')) != null) {
                    $empclass->setClass_name_ta(trim($request->getParameter('txtNameta')));
                } else {
                    $empclass->setClass_name_ta(null);
                }

                $classDao->saveClass($empclass);
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                $this->redirect('admin/listClass');
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listClass');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listClass');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listClass');
        }
    }

    public function executeUpdateClass(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }
        $transPid = $encrypt->decrypt($request->getParameter('id'));
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_class', array($transPid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $recordLocked = $conHandler->resetTableLock('hs_hr_class', array($transPid), 1);
                $this->lockMode = 0;
            }
        }

        $classDao = new classDao();
        $class = $classDao->getClassById($transPid);

        $this->class = $class;

        if ($request->isMethod('post')) {

            if (strlen($request->getParameter('txtName'))) {
                $class->setClass_name(trim($request->getParameter('txtName')));
            } else {
                $class->setClass_name(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $class->setClass_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $class->setClass_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $class->setClass_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $class->setClass_name_ta(null);
            }


            try {
                $classDao->saveClass($class);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listClass');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/updateClass?id=' . $encrypt->encrypt($class->class_code) . '&lock=' . $encrypt->encrypt(0));
            }
            $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));

            $this->redirect('admin/updateClass?id=' . $encrypt->encrypt($class->class_code) . '&lock=' . $encrypt->encrypt(0));
        }
    }

    public function executeListAttachtype(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $attacDao = new attachTypeDao();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('eattach_type_id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'eattach_type_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $attacDao->SerachAttachtype($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listAttachtype = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveAttachmenttype(sfWebRequest $request) {
        try {
            $attachTypeDao = new attachTypeDao();


            if ($request->isMethod('post')) {
                $empAttachtype = new EmpAttahmentType();


                $empAttachtype->setEattach_type_name($request->getParameter('txtName'));
                $empAttachtype->setEattach_type_name_si($request->getParameter('txtNamesi'));
                $empAttachtype->setEattach_type_name_ta($request->getParameter('txtNameta'));

                $attachTypeDao->saveAttachType($empAttachtype);

                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                $this->redirect('admin/listAttachtype');
            }
        } catch (sfStopException $sf) {
            $this->redirect('admin/listAttachtype');
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listAttachtype');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listAttachtype');
        }
    }

    public function executeUpdateAttachmentType(sfWebRequest $request) {

        if (!strlen($request->getParameter('lock'))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $request->getParameter('lock');
        }
        $transPid = $request->getParameter('id');

        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_emp_attachment_type', array($transPid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {

                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_emp_attachment_type', array($transPid), 1);
                $this->lockMode = 0;
            }
        }

        $attachTypeDao = new attachTypeDao();

        $attachType = $attachTypeDao->getAttachmentById($request->getParameter('id'));

        $this->attachType = $attachType;


        if ($request->isMethod('post')) {


            $attachType->setEattach_type_name($request->getParameter('txtName'));
            $attachType->setEattach_type_name_si($request->getParameter('txtNamesi'));
            $attachType->setEattach_type_name_ta($request->getParameter('txtNameta'));


            try {
                $attachTypeDao->saveAttachType($attachType);
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/updateAttachmentType?id=' . $attachType->eattach_type_id . '&lock=0');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));

            $this->redirect('admin/updateAttachmentType?id=' . $attachType->eattach_type_id . '&lock=0');
        }
    }

    public function executeListGrade(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $gradeService = new GradeService();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('grade_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'grade_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $gradeService->SerachGrades($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listGrade = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {

            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveGrade(sfWebRequest $request) {


        try {
            $GradeDao = new GradeDao();
            $gradeService = new GradeService();
            $gradeId = $request->getParameter('id');
            $slot = $request->getParameter('SLTYR_');

            if ($request->isMethod('post')) {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();

                if (trim($request->getParameter('id')) == "") {
                    $grade = new Grade();
                } else {
                    $grade = $gradeService->getGradeById($request->getParameter('id'));
                    $this->grade = $grade;
                    $GradeDao->deleteGradeSlot(trim($request->getParameter('id')));
                }


                $grade->setGrade_name($request->getParameter('txtName'));
                $grade->setGrade_name_si($request->getParameter('txtNamesi'));
                $grade->setGrade_name_ta($request->getParameter('txtNameta'));

                $gradeService->saveGrade($grade);
                $GradeCode = $GradeDao->getLastGradeCode();
                $GradeCode[0]['MAX'];

                $no = count($slot);
                for ($i = 0; $i < $no; $i++) {
                    $GradeSlot = new GradeSlot();
                    $GradeSlot->setGrade_code($GradeCode[0]['MAX']);
                    $GradeSlot->setSlt_scale_year($request->getParameter("txtSY_" . $i . ""));
                    $GradeSlot->setSlt_amount($request->getParameter("txtAM_" . $i . ""));
                    $GradeSlot->setEmp_basic_salary($request->getParameter("lblBS_" . $i . ""));
                    $GradeDao->saveGradeSlot($GradeSlot);
                }
                $conn->commit();
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                $this->redirect('admin/listGrade');
            }
        } catch (Doctrine_Connection_Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listGrade');
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());

            $this->redirect('admin/listGrade');
        } catch (Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listGrade');
        }
    }

    public function executeUpdateGrade(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();
        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }

        $GradeCode = $encrypt->decrypt($request->getParameter('id'));


        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_grade', array($GradeCode), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_grade', array($GradeCode), 1);
                $this->lockMode = 0;
            }
        }




        $gradeService = new GradeService();
        $GradeDao = new GradeDao();
        $grade = $gradeService->getGradeById($GradeCode);
        $gradeId = $GradeCode;
        $slot = $request->getParameter('SLTYR_');

        $this->grade = $grade;
        $this->GradeDetailSlot = $GradeDao->readGradeSlot($GradeCode);

        if ($request->isMethod('post')) {


            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();

                $grade->setGrade_name($request->getParameter('txtName'));
                $grade->setGrade_name_si($request->getParameter('txtNamesi'));
                $grade->setGrade_name_ta($request->getParameter('txtNameta'));
                $gradeService->saveGrade($grade);

                $no = count($slot);
                for ($i = 0; $i < $no; $i++) {

                    if ($this->GradeDetailSlot[$i]['slt_scale_year'] == null) {
                        $GradeSlot = new GradeSlot();
                        $GradeSlot->setGrade_code($gradeId);
                        $GradeSlot->setSlt_scale_year($request->getParameter("txtSY_" . $i . ""));
                        $GradeSlot->setSlt_amount($request->getParameter("txtAM_" . $i . ""));
                        $GradeSlot->setEmp_basic_salary($request->getParameter("lblBS_" . $i . ""));
                        $GradeDao->saveGradeSlot($GradeSlot);
                    } else {
                        $GradeDao->updateGradeSlotRow($gradeId, $i, $request->getParameter("txtAM_" . $i . ""), $request->getParameter("lblBS_" . $i . ""));
                    }
                }
                $conn->commit();
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Updated')));
                $this->redirect('admin/UpdateGrade?id=' . $encrypt->encrypt($grade->grade_code) . '&lock=' . $encrypt->encrypt(0));
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/UpdateGrade?id=' . $encrypt->encrypt($grade->grade_code) . '&lock=' . $encrypt->encrypt(0));
            } catch (sfStopException $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/UpdateGrade?id=' . $encrypt->encrypt($grade->grade_code) . '&lock=' . $encrypt->encrypt(0));
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/UpdateGrade?id=' . $encrypt->encrypt($grade->grade_code) . '&lock=' . $encrypt->encrypt(0));
            }
        }
    }

    public function executeDeleteGrade(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $gradeDao = new GradeDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_grade', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $gradeDao->deleteGradeSlot($ids[$i]);
                        $gradeDao->deleteGrade($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_grade', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listGrade');
            } catch (Exception $e) {

                $conn->rollBack();

                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listGrade');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listGrade');
    }

    public function executeDeleteClass(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $classDao = new classDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_class', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $classDao->deleteClass($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_class', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listClass');
            } catch (Exception $e) {

                $conn->rollBack();

                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listClass');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listClass');
    }

    public function executeDeleteAttachType(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $attaTypedao = new attachTypeDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_emp_attachment_type', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $attaTypedao->deleteAttachType($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_emp_attachment_type', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Exception $e) {

                $conn->rollBack();

                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listAttachtype');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listAttachtype');
    }

    public function executeSaveLanguage(sfWebRequest $request) {
        try {
            $languageService = new LanguageService();
            if ($request->isMethod('post')) {
                $language = new Language();


                if (strlen($request->getParameter('txtLanguage'))) {
                    $language->setLangName(trim($request->getParameter('txtLanguage')));
                } else {

                    $language->setLangName(null);
                }
                if (strlen($request->getParameter('txtLanguageSI'))) {


                    $language->setLangNameSI(trim($request->getParameter('txtLanguageSI')));
                } else {

                    $language->setLangNameSI(null);
                }
                if (strlen($request->getParameter('txtLanguageTA'))) {
                    $language->setLangNameTA(trim($request->getParameter('txtLanguageTA')));
                } else {
                    $language->setLangNameTA(null);
                }

                $languageService->saveLanguage($language);
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                $this->redirect('admin/listLanguage');
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listLanguage');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listLanguage');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listLanguage');
        }
    }

    public function executeUpdateLanguage(sfWebRequest $request) {
        try {
            $encService = new EncryptionHandler();

            $this->form = new UpdateLanguageForm(array(), array(), true);

            $languageService = new LanguageService();
            $language = $languageService->readLanguage($encService->decrypt($request->getParameter('id')));

            if (is_object($language) == false) {
                $this->redirect('admin/listLanguage');
            }
            $this->language = $language;

            if ($request->isMethod('post')) {
                $this->form->bind($request->getParameter($this->form->getName()));
                if ($this->form->isValid()) {

                    if (strlen($request->getParameter('txtLanguage'))) {
                        $language->setLangName(trim($request->getParameter('txtLanguage')));
                    } else {
                        $language->setLangName(null);
                    }
                    if (strlen($request->getParameter('txtLanguageSI'))) {
                        $language->setLangNameSI(trim($request->getParameter('txtLanguageSI')));
                    } else {
                        $language->setLangNameSI(null);
                    }
                    if (strlen($request->getParameter('txtLanguageTA'))) {
                        $language->setLangNameTA(trim($request->getParameter('txtLanguageTA')));
                    } else {
                        $language->setLangNameTA(null);
                    }

                    $languageService->saveLanguage($language);
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Updated')));
                    $this->redirect('admin/listLanguage');
                }
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listLanguage');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listLanguage');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listLanguage');
        }
    }

    public function executeDeleteLanguage(sfWebRequest $request) {
        try {
            if (count($request->getParameter('chkLocID')) > 0) {
                $languageService = new LanguageService();
                $languageService->deleteLanguage($request->getParameter('chkLocID'));
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Deleted')));
            } else {
                $this->setMessage('NOTICE', array($this->getContext()->geti18n()->__('Select at least one record to delete')));
            }
            $this->redirect('admin/listLanguage');
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listLanguage');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listLanguage');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listLanguage');
        }
    }

    public function executeGetLanguageById(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $languageService = new LanguageService();
            $result = $languageService->getLanguageById($id);

            echo json_encode($result[0]);
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeLockLanguage(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->setTableLock('hs_hr_language', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeUnlockLanguage(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->resetTableLock('hs_hr_language', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeListEducation(sfWebRequest $request) {
        try {
            $this->userCulture = $this->getUser()->getCulture();
            $educationService = new EducationService();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('skill_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'edu_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $educationService->searchEducation($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listEducation = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveEducation(sfWebRequest $request) {
        try {
            $educationService = new EducationService();
            if ($request->isMethod('post')) {
                $education = new Education();

                if (strlen($request->getParameter('txtEducation'))) {
                    $education->edu_name = trim($request->getParameter('txtEducation'));
                } else {
                    $education->edu_name = null;
                }
                if (strlen($request->getParameter('txtEducationSI'))) {
                    $education->edu_name_si = trim($request->getParameter('txtEducationSI'));
                } else {
                    $education->edu_name_si = null;
                }
                if (strlen($request->getParameter('txtEducationTA'))) {
                    $education->edu_name_ta = trim($request->getParameter('txtEducationTA'));
                } else {
                    $education->edu_name_ta = null;
                }


                $educationService->saveEducation($education);
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                $this->redirect('admin/listEducation');
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listEducation');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listEducation');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listEducation');
        }
    }

    public function executeUpdateEducation(sfWebRequest $request) {
        try {
            $encrypt = new EncryptionHandler();
            $this->form = new UpdateEducationForm(array(), array(), true);

            $educationService = new EducationService();
            $education = $educationService->readEducation($encrypt->decrypt($request->getParameter('id')));

            if (is_object($education) == false) {
                $this->redirect('admin/listEducation');
            }
            $this->education = $education;

            if ($request->isMethod('post')) {
                $this->form->bind($request->getParameter($this->form->getName()));
                if ($this->form->isValid()) {
//                            
                    if (strlen($request->getParameter('txtEducation'))) {
                        $education->edu_name = trim($request->getParameter('txtEducation'));
                    } else {
                        $education->edu_name = null;
                    }
                    if (strlen($request->getParameter('txtEducationSI'))) {
                        $education->edu_name_si = trim($request->getParameter('txtEducationSI'));
                    } else {
                        $education->edu_name_si = null;
                    }
                    if (strlen($request->getParameter('txtEducationTA'))) {
                        $education->edu_name_ta = trim($request->getParameter('txtEducationTA'));
                    } else {
                        $education->edu_name_ta = null;
                    }

                    $educationService->saveEducation($education);
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Updated')));
                    $this->redirect('admin/listEducation');
                }
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listEducation');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listEducation');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listEducation');
        }
    }

    public function executeDeleteEducation(sfWebRequest $request) {

        if (count($request->getParameter('chkID')) > 0) {
            $educationService = new EducationService();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_education', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $educationService->deleteEducation($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_education', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listEducation');
            } catch (Exception $e) {

                $conn->rollBack();

                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listEducation');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listEducation');
    }

    public function executeGetEducationById(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $educationService = new EducationService();
            $result = $educationService->getEducationById($id);

            echo json_encode($result[0]);
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeLockEducation(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->setTableLock('hs_hr_education', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeUnlockEducation(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->resetTableLock('hs_hr_education', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeListSkill(sfWebRequest $request) {
        try {
            $this->userCulture = $this->getUser()->getCulture();
            $skillService = new SkillService();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('skill_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'skill_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $skillService->searchSkill($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listSkill = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveSkill(sfWebRequest $request) {
        try {
            $skillService = new SkillService();
            if ($request->isMethod('post')) {
                $skill = new Skill();

                if (strlen($request->getParameter('txtSkill'))) {
                    $skill->skill_name = trim($request->getParameter('txtSkill'));
                } else {
                    $skill->skill_name = null;
                }
                if (strlen($request->getParameter('txtSkillSI'))) {
                    $skill->skill_name_si = trim($request->getParameter('txtSkillSI'));
                } else {
                    $skill->skill_name_si = null;
                }
                if (strlen($request->getParameter('txtSkillTA'))) {
                    $skill->skill_name_ta = trim($request->getParameter('txtSkillTA'));
                } else {
                    $skill->skill_name_ta = null;
                }
                $skillService->saveSkill($skill);
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                $this->redirect('admin/listSkill');
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listSkill');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listSkill');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listSkill');
        }
    }

    public function executeUpdateSkill(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();
        try {
            $this->form = new UpdateSkillForm(array(), array(), true);

            $skillService = new SkillService();
            $skill = $skillService->readSkill($encrypt->decrypt($request->getParameter('id')));

            if (is_object($skill) == false) {
                $this->redirect('admin/listSkill');
            }
            $this->skill = $skill;

            if ($request->isMethod('post')) {
                $this->form->bind($request->getParameter($this->form->getName()));
                if ($this->form->isValid()) {

                    if (strlen($request->getParameter('txtSkill'))) {
                        $skill->skill_name = trim($request->getParameter('txtSkill'));
                    } else {
                        $skill->setSkill_name(null);
                    }
                    if (strlen($request->getParameter('txtSkillSI'))) {
                        $skill->skill_name_si = trim($request->getParameter('txtSkillSI'));
                    } else {
                        $skill->setSkill_name_si(null);
                    }
                    if (strlen($request->getParameter('txtSkillTA'))) {
                        $skill->skill_name_ta = trim($request->getParameter('txtSkillTA'));
                    } else {
                        $skill->setSkill_name_ta(null);
                    }

                    $skillService->saveSkill($skill);
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Updated')));
                    $this->redirect('admin/listSkill');
                }
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listSkill');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listSkill');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listSkill');
        }
    }

    public function executeDeleteSkill(sfWebRequest $request) {
        try {
            if (count($request->getParameter('chkID')) > 0) {
                $skillService = new SkillService();
                $skillService->deleteSkill($request->getParameter('chkID'));
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Deleted')));
            } else {
                $this->setMessage('NOTICE', array($this->getContext()->geti18n()->__('Select at least one record to delete')));
            }
            $this->redirect('admin/listSkill');
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listSkill');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listSkill');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listSkill');
        }
    }

    public function executeGetSkillById(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $skillService = new SkillService();
            $result = $skillService->getSkillById($id);

            echo json_encode($result[0]);
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeLockSkill(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->setTableLock('hs_hr_skill', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeUnlockSkill(sfWebRequest $request) {

        try {
            $id = $request->getParameter('id', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->resetTableLock('hs_hr_skill', array($id), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeSaveJobService(sfWebRequest $request) {
        $this->myCulture = $this->getUser()->getCulture();
        $jobDao = new JobDao();
        $knwdt = new ServiceDetails();

        if ($request->isMethod('post')) {
            $knwdt->setService_name($request->getParameter('txtName'));
            $knwdt->setService_name_si($request->getParameter('txtNamesi'));
            $knwdt->setService_name_ta($request->getParameter('txtNameta'));


            try {
                $jobDao->saveJobservice($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobService');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobService');
            }

            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
            $this->redirect('admin/listJobService');
        }
    }

    public function executeUpdateJobService(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();
        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }
        $transPid = $encrypt->decrypt($request->getParameter('id'));
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_service', array($transPid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_service', array($transPid), 1);
                $this->lockMode = 0;
            }
        }


        $this->myCulture = $this->getUser()->getCulture();
        $jobDao = new JobDao();


        $knwdt = $jobDao->readJobService($transPid);


        $this->benifittypelist = $knwdt;
        if ($request->isMethod('post')) {

            $knwdt->setService_name($request->getParameter('txtName'));
            $knwdt->setService_name_si($request->getParameter('txtNamesi'));
            $knwdt->setService_name_ta($request->getParameter('txtNameta'));

            try {
                $jobDao->saveJobservice($knwdt);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/updateJobService?id=' . $encrypt->encrypt($knwdt->getService_code()) . '&lock=' . $encrypt->encrypt(0));
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/updateJobService?id=' . $encrypt->encrypt($knwdt->getService_code()) . '&lock=' . $encrypt->encrypt(0));
            }

            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('admin/updateJobService?id=' . $encrypt->encrypt($knwdt->getService_code()) . '&lock=' . $encrypt->encrypt(0));
        }
    }

    public function executeDeleteJobService(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $jobDao = new JobDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_service', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $jobDao->deleteJobService($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_service', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobService');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listJobService');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
        }
        $this->redirect('admin/listJobService');
    }

    public function executeChangepassword(sfWebRequest $request) {
        try {

            $currentPwd = $request->getParameter('txtCurrentPwd');
            $newPwd = $request->getParameter('txtNewPwd');
            $confirmNewPwd = $request->getParameter('txtConfirmNewPwd');
            $encrypt = new EncryptionHandler();
            $userId = $encrypt->decrypt($request->getParameter('id'));

            if ($request->isMethod('post')) {
                $EmployeeDao = new EmployeeDao();

                $currentPwdByIDArray = $EmployeeDao->getCurrentByID($userId);
                $currentPwdByID = $currentPwdByIDArray[0]['user_password'];
                $userId = $currentPwdByIDArray[0]['id'];

                if ($currentPwdByID == md5($currentPwd)) {
                    $users = $EmployeeDao->getUserByID($userId);

                    $users->setUser_password(md5($newPwd));
                    $users->save();
                    
                    
                    $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("You have successfully change your password", $args, 'messages')));
                    //$this->redirect('admin/changepassword?id=' . $encrypt->encrypt($userId));
                    $this->redirect('ESS/index');
                } else {
                    $this->setMessage('NOTICE', array($this->getContext()->getI18N()->__("Current Password is Incorrect", $args, 'messages')));
                    //$this->redirect('admin/changepassword?id=' . $encrypt->encrypt($userId));
                    $this->redirect('ESS/index');
                }
            }
        } catch (sfStopException $sfStop) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/changepassword?id=' . $encrypt->encrypt($userId));
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/changepassword?id=' . $encrypt->encrypt($userId));
        }

    }

    public function executeError(sfWebRequest $request) {

        $this->redirect('default/error');
    }

    public function executeListDefineEbexam(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $ebExam = new EbExamDao();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'ebexam_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $ebExam->searchEbexamDefinitions($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listebExamdefinitions = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveEbExam(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        try {
            if (!strlen($request->getParameter('lock'))) {
                $this->mode = 0;
            } else {
                $this->mode = $request->getParameter('lock');
            }
            $ebLockid = $encrypt->decrypt($request->getParameter('ebExamId'));

            if (isset($this->mode)) {
                if ($this->mode == 1) {

                    $conHandler = new ConcurrencyHandler();

                    $recordLocked = $conHandler->setTableLock('hs_hr_ebexam', array($ebLockid), 1);

                    if ($recordLocked) {
                        // Display page in edit mode
                        $this->mode = 1;
                    } else {

                        $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                        $this->mode = 0;
                    }
                } else if ($this->mode == 0) {
                    $conHandler = new ConcurrencyHandler();
                    $recordLocked = $conHandler->resetTableLock('hs_hr_ebexam', array($ebLockid), 1);
                    $this->mode = 0;
                }
            }



            $this->userCulture = $this->getUser()->getCulture();
            $ebExamDao = new EbExamDao();

            $jobService = new JobService();
            $this->gradeList = $jobService->getJobGradeList();
            $this->serviceList = $jobService->getEmpServiceList();

            $ebExamId = $request->getParameter('ebExamId');
            if (strlen($ebExamId)) {
                $ebExamId = $encrypt->decrypt($request->getParameter('ebExamId'));
                if (!strlen($this->mode)) {
                    $this->mode = 0;
                }
                $this->ebExamGetById = $ebExamDao->readEbExam($ebExamId);
                if (!$this->ebExamGetById) {
                    $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                    $this->redirect('admin/listDefineEbexam');
                }
            } else {
                $this->mode = 1;
            }


            if ($request->isMethod('post')) {

                if (strlen($request->getParameter('txtHiddenEbID'))) {
                    $ebExam = $ebExamDao->readEbExam($request->getParameter('txtHiddenEbID'));
                } else {
                    $ebExam = new EBExam();
                }

                if (strlen($request->getParameter('cmbService'))) {
                    $ebExam->setService_code(trim($request->getParameter('cmbService')));
                } else {
                    $ebExam->setService_code(null);
                }
                if (($request->getParameter('cmbGrade')) != null) {
                    $ebExam->setGrade_code(trim($request->getParameter('cmbGrade')));
                } else {
                    $ebExam->setGrade_code(null);
                }
                if (($request->getParameter('txtEbexamName')) != null) {
                    $ebExam->setEbexam_name(trim($request->getParameter('txtEbexamName')));
                } else {
                    $ebExam->setEbexam_name(null);
                }
                if (($request->getParameter('txtEbexamNameSi')) != null) {
                    $ebExam->setEbexam_name_si(trim($request->getParameter('txtEbexamNameSi')));
                } else {
                    $ebExam->setEbexam_name_si(null);
                }
                if (($request->getParameter('txtEbexamNameTa')) != null) {
                    $ebExam->setEbexam_name_ta(trim($request->getParameter('txtEbexamNameTa')));
                } else {
                    $ebExam->setEbexam_name_ta(null);
                }
                if (($request->getParameter('txtEbexamDesc')) != null) {
                    $ebExam->setEbexam_description(trim($request->getParameter('txtEbexamDesc')));
                } else {
                    $ebExam->setEbexam_description(null);
                }

                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_ebexam', array($request->getParameter('txtHiddenEbID')), 1);
                $ebExamDao->saveEbexam($ebExam);
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));


                $this->redirect('admin/listDefineEbexam');
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listDefineEbexam');
        } catch (sfStopException $sf) {
            $this->redirect('admin/listDefineEbexam');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listDefineEbexam');
        }
    }

    public function executeDeleteEbExam(sfWebRequest $request) {
        if (count($request->getParameter('chkID')) > 0) {

            $ebexamDao = new EbExamDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_ebexam', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $ebexamDao->deleteEbexamDefinitions($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_ebexam', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listDefineEbexam');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listDefineEbexam');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listDefineEbexam');
    }

    public function executeCarderPlan(sfWebRequest $request) {

        try {
            $jobDao = new JobDao();
            $jobList = $jobDao->getJobtitleListCarder();
            $this->jobList = $jobList;

            if ($request->isMethod('post')) {

                $divId = $request->getParameter('txtDivisionid');
                $this->divId = $divId;
                $exploed = array();
                $count_rows = array();

                foreach ($_POST as $key => $value) {


                    $exploed = explode("_", $key);


                    if (strlen($exploed[1])) {

                        $count_rows[] = $exploed[1];

                        $arrname = "a_" . $exploed[1];

                        if (!is_array($$arrname)) {
                            $$arrname = Array();
                        }

                        ${$arrname}[$exploed[0]] = $value;
                    }
                }

                $uniqueRowIds = array_unique($count_rows);


                $uniqueRowIds = array_values($uniqueRowIds);
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();

                for ($i = 0; $i < count($uniqueRowIds); $i++) {




                    $v = "a_" . $uniqueRowIds[$i];

                    $isCarderPlan = $jobDao->readCarderPlanByKeys($divId, $uniqueRowIds[$i]);


                    if ((strlen($isCarderPlan->id))) {
                        $carderPlan = $isCarderPlan;
                    } else {
                        $carderPlan = new CarderPlan();
                    }


                    $actualId = "txtActualId_" . $uniqueRowIds[$i];

                    $carderPlan->setId($divId);
                    $carderPlan->setJobtit_code($uniqueRowIds[$i]);

                    if (!strlen(${$v}[txtActualId])) {
                        $carderPlan->setCarder_actual(null);
                    } else {
                        $carderPlan->setCarder_actual(${$v}[txtActualId]);
                    }
                    if (!strlen(${$v}[txtApprovedId])) {

                        $carderPlan->setCarder_approved(null);
                    } else {
                        $carderPlan->setCarder_approved(${$v}[txtApprovedId]);
                    }
                    $excessValue = ${$v}[txtActualId] - ${$v}[txtApprovedId];
                    if ($excessValue > 0) {
                        $excessValue = $excessValue;
                        $vacancy = "";
                    } else {
                        $vacancy = $excessValue;
                        $excessValue = "";
                    }



                    if (strlen($excessValue)) {
                        $carderPlan->setCarder_excess(abs($excessValue));
                    } else {
                        $carderPlan->setCarder_excess(null);
                    }


                    if ($vacancy == "0") {
                        $carderPlan->setCarder_vacancies(null);
                    } else {

                        $carderPlan->setCarder_vacancies(abs($vacancy));
                    }




                    $carderPlan->save();


                    $conHandler = new ConcurrencyHandler();
                    $recordLocked = $conHandler->resetTableLock('hs_hr_carderplan', array($divId), 1);
                }

                $conn->commit();

                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            }
        } catch (Doctrine_Connection_Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/carderPlan');
        } catch (Exception $e) {
            $conn->rollBack();
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/carderPlan');
        }
    }

    public function executeLoadCarderPlan(sfWebRequest $request) {

        $id = $request->getParameter('id');

        $this->culture = $this->getUser()->getCulture();

        $jobDao = new JobDao();
        $this->carderPlanList = $jobDao->getCarderList($id);

        if (strlen($this->carderPlanList[0]->id)) {

            $jobDao = new JobDao();
            $jobList = $jobDao->getJobtitleListCarder();
            $this->jobList = $jobList;
            $this->List = "";
            $this->List1 = "";




            foreach ($this->carderPlanList as $list) {
                if ($this->culture == "en") {
                    $jobtitleName = $list->JobTitle->name;
                } else {
                    $columName = "name_" . $this->culture;
                    if ($list->JobTitle->$columName == "") {

                        $jobtitleName = $list->JobTitle->name;
                    } else {
                        $jobtitleName = $list->JobTitle->$columName;
                    }
                }

                $this->List .= "<div class='leftCol' style='margin-top:10px; margin-left:2px;'>";
                $this->List .= "$jobtitleName";
                $this->List .= "</div>";
                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)'  id='txtActualId_" . $list->JobTitle->id . "' name='txtActualId_" . $list->JobTitle->id . "' type='text'  class='formInputText' value='" . $list->carder_actual . "' maxlength='6' onpaste='return false;' />";
                $this->List .= "</div>";
                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)' id='txtApprovedId_" . $list->JobTitle->id . "'  name='txtApprovedId_" . $list->JobTitle->id . "' type='text'  class='formInputText' value='" . $list->carder_approved . "' maxlength='6' onpaste='return false;' />";
                $this->List .= "</div>";
                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)' id='txtExcessId_" . $list->JobTitle->id . "'  name='txtExcessId_" . $list->JobTitle->id . "' type='text' readonly='readonly'  class='formInputText' value='" . $list->carder_excess . "' maxlength='6'onpaste='return false;'  />";
                $this->List .= "</div>";

                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)' id='txtVacncyId_" . $list->JobTitle->id . "'  name='txtVacncyId_" . $list->JobTitle->id . "' type='text' readonly='readonly'   class='formInputText' value='" . $list->carder_vacancies . "' maxlength='6' onpaste='return false;' />";

                $this->List .= "</div>";
                $this->List .= "<br class='clear'/>";
            }
        } else {

            $jobDao = new JobDao();
            $jobList = $jobDao->getJobtitleListCarder();
            $this->jobList = $jobList;
            $this->List = "";
            $this->List1 = "";




            foreach ($this->jobList as $list) {

                if ($this->culture == "en") {
                    $jobtitleName = $list->name;
                } else {
                    $columName = "name_" . $this->culture;
                    if ($list->$columName == "") {
                        $jobtitleName = $list->name;
                    } else {
                        $jobtitleName = $list->$columName;
                    }
                }

                $this->List .= "<div class='leftCol' style='margin-top:10px; margin-left:2px;'>";
                $this->List .= "$jobtitleName";
                $this->List .= "</div>";
                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)' id='txtActualId_" . $list->id . "' name='txtActualId_" . $list->id . "' type='text'   class='formInputText' value='' maxlength='6' onpaste='return false;' />";
                $this->List .= "</div>";
                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)'  id='txtApprovedId_" . $list->id . "'  name='txtApprovedId_" . $list->id . "' type='text'  class='formInputText' value='' maxlength='6' onpaste='return false;' />";
                $this->List .= "</div>";
                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)' id='txtExcessId_" . $list->id . "'  name='txtExcessId_" . $list->id . "' type='text' readonly='readonly'  class='formInputText' value='' maxlength='6' onpaste='return false;' />";
                $this->List .= "</div>";
                $this->List .= "<div class='leftCol' style='width: 100px; margin-top:10px;'>";
                $this->List .= "<input  style='width: 50px;' class='carderPlanInputs' onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationComment(event,this.id)' id='txtVacncyId_" . $list->id . "' name='txtVacncyId_" . $list->id . "' type='text' readonly='readonly'  class='formInputText' value='' maxlength='6' onpaste='return false;' />";

                $this->List .= "</div>";
                $this->List .= "<br class='clear'/>";
            }
        }

        if ($this->culture == "en") {

            $colName = "title";
        } else {
            $colName = "title_" . $this->culture;
        }
        if ($this->carderPlanList[0]->CompanyStructure->$colName == "") {
            $divisionName = $this->carderPlanList[0]->CompanyStructure->title;
        } else {
            $divisionName = $this->carderPlanList[0]->CompanyStructure->$colName;
        }

        $divisionId = $this->carderPlanList[0]->id;
        echo json_encode(array("list" => $this->List, "divisionName" => $divisionName));

        die;
    }

    public function executeLockCarderPlan(sfWebRequest $request) {

        try {
            $divID = $request->getParameter('divID', false);


            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->setTableLock('hs_hr_carderplan', array($divID), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeLoadGrid(sfWebRequest $request) {
        $this->culture = $this->getUser()->getCulture();
        $secDao = new CompanyDao();
        $empId = $request->getParameter('empid');
        $compId = $request->getParameter('compId');
        $this->compId = $compId;

        $this->emplist = $secDao->getEmployee($empId);
    }

    public function executeUnlockCarderPlan(sfWebRequest $request) {

        try {
            $divID = $request->getParameter('divID', false);

            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->resetTableLock('hs_hr_carderplan', array($divID), 1);

            echo json_encode(array('recordLocked' => $recordLocked));
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeGetCompanyStructureTreeDetailsById(sfWebRequest $request) {

        try {
            $userCulture = $this->getUser()->getCulture();

            $id = $request->getParameter('id', false);

            $CompanyDao = new CompanyDao();
            $CSD = $CompanyDao->getAjaxCompanyStructuredetails($id);
            $CSDetail = array();
            foreach ($CSD as $row) {

                $CSDetail[] = $row->getId() . "|" . $row->getEmp_number() . "|" . $row->getRole_group_id() . "|" . $row->EmployeeMaster->getEmp_display_name() . "|" . $row->EmployeeMaster->getEmployee_id();
            }

            echo json_encode($CSDetail);
            die;
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
        }
    }

    public function executeAjaxdeleteGradeSlot(sfWebRequest $request) {
        $gradeId = $request->getParameter('id');
        $i = $request->getParameter('year');
        $GradeDao = new GradeDao();
        try{
        $GradeDao->deleteGradeSlotRow($gradeId, $i);
        echo json_encode("true");
        } catch (Exception $e) {
            echo json_encode("false");
        }
        
        die;
    }

    public function executeJobRole(sfWebRequest $request) {

        try {
            $this->Culture = $this->getUser()->getCulture();
            $JobRoleDao = new JobDao();

            $this->sorter = new ListSorter('JobRole', 'admin', $this->getUser(), array('JR.jrl_id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/JobRole');
                }
                $this->var = 1;
            }

            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'JR.jrl_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $JobRoleDao->searchJobRole($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->JobRole = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveJobRole(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->mode = 0;
        } else {
            $this->mode = $encrypt->decrypt($request->getParameter('lock'));
        }
        $ebLockid = $encrypt->decrypt($request->getParameter('id'));

        if (isset($this->mode)) {
            if ($this->mode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_emp_job_role', array($ebLockid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->mode = 1;
                } else {

                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->mode = 0;
                    $this->redirect('admin/SaveJobRole?id=' . $encrypt->encrypt($Id) . '&lock=' . $encrypt->encrypt(0));
                }
            } else if ($this->mode == 0) {
                $conHandler = new ConcurrencyHandler();
                $recordLocked = $conHandler->resetTableLock('hs_hr_emp_job_role', array($ebLockid), 1);
                $this->mode = 0;
            }
        }
        $JobRoleDao = new JobDao();
        $this->myCulture = $this->getUser()->getCulture();
        $this->Designation = $JobRoleDao->getJobtitleCombo();
        $this->Level = $JobRoleDao->getLevelCombo();
        $this->Service = $JobRoleDao->getServiceDetailsCombo();

        if ($request->getParameter('id')) {
            $Id = $encrypt->decrypt($request->getParameter('id'));
        }

        if (strlen($Id)) {
            if (!strlen($this->mode)) {
                $this->mode = 0;
            }
            $JobRole = $JobRoleDao->readJobRole($Id);
            $this->JobRoleFetch = $JobRole;
            if (!$this->JobRoleFetch) {
                $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                $this->redirect('admin/JobRole');
            }
        } else {
            $JobRole = new JobRole();
            $this->JobRoleFetch = $JobRole;
            $this->mode = 1;
        }
        if ($request->isMethod('post')) {



            if (strlen($request->getParameter('txtName'))) {
                $JobRole->setJobtit_code(trim($request->getParameter('cmbDesignation')));
            } else {
                $JobRole->setJobtit_code(null);
            }
            if (strlen($request->getParameter('cmbLevel'))) {
                $JobRole->setLevel_code(trim($request->getParameter('cmbLevel')));
            } else {
                $JobRole->setLevel_code(null);
            }
            if (strlen($request->getParameter('cmbService'))) {
                $JobRole->setService_code(trim($request->getParameter('cmbService')));
            } else {
                $JobRole->setService_code(null);
            }
            if (strlen($request->getParameter('txtName'))) {
                $JobRole->setJrl_name(trim($request->getParameter('txtName')));
            } else {
                $JobRole->setJrl_name(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $JobRole->setJrl_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $JobRole->setJrl_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $JobRole->setJrl_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $JobRole->setJrl_name_ta(null);
            }

            try {
                $JobRoleDao->saveJobRole($JobRole);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/JobRole');
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/JobRole');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/JobRole');
            }

            if ($Id) {

                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));

                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated     ", $args, 'messages')));

                $this->redirect('admin/SaveJobRole?id=' . $encrypt->encrypt($Id) . '&lock=' . $encrypt->encrypt(0));
            } else {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
                $this->redirect('admin/JobRole');
            }
        }
    }

    public function executeDeleteJobRole(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $JobRoleDao = new JobDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_emp_job_role', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $JobRoleDao->deleteJobRole($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_emp_job_role', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {

                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/JobRole');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/JobRole');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/JobRole');
    }

    public function executeLevel(sfWebRequest $request) {

        try {
            $this->Culture = $this->getUser()->getCulture();
            $this->isAdmin = $_SESSION['isAdmin'];
            $JobDao = new JobDao();

            $this->sorter = new ListSorter('Level', 'admin', $this->getUser(), array('l.level_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            if ($request->getParameter('mode') == 'search') {
                if (($request->getParameter('searchMode') == 'all') && (trim($request->getParameter('searchValue')) != '')) {
                    $this->setMessage('NOTICE', array('Select the field to search'));
                    $this->redirect('admin/Level');
                }
                $this->var = 1;
            }

            $this->searchMode = ($request->getParameter('searchMode') == null) ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == null) ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'l.level_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');
            $res = $JobDao->searchLevel($this->searchMode, $this->searchValue, $this->Culture, $this->sort, $this->order, $request->getParameter('page'));
            $this->benifitlist = $res['data'];
            $this->pglay = $res['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($res['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveLevel(sfWebRequest $request) {
        $this->myCulture = $this->getUser()->getCulture();
        $JobDao = new JobDao();
        $level = new Level();
        if ($request->isMethod('post')) {
            if (strlen($request->getParameter('txtName'))) {
                $level->setLevel_name(trim($request->getParameter('txtName')));
            } else {
                $level->setLevel_name(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $level->setLevel_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $level->setLevel_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $level->setLevel_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $level->setLevel_name_ta(null);
            }

            try {
                $JobDao->saveLevel($level);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/Level');
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/Level');
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Added", $args, 'messages')));
            $this->redirect('admin/Level');
        }
    }

    public function executeUpdateLevel(sfWebRequest $request) {
        //Table Lock code is Open
        $encrypt = new EncryptionHandler();

        if (!strlen($encrypt->decrypt($request->getParameter('lock')))) {
            $this->lockMode = 0;
        } else {
            $this->lockMode = $encrypt->decrypt($request->getParameter('lock'));
        }
        $transPid = $encrypt->decrypt($request->getParameter('id'));
        if (isset($this->lockMode)) {
            if ($this->lockMode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_level', array($transPid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->lockMode = 1;
                } else {
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                    $this->lockMode = 0;
                }
            } else if ($this->lockMode == 0) {
                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_level', array($transPid), 1);
                $this->lockMode = 0;
            }
        }

        //Table lock code is closed
        $this->myCulture = $this->getUser()->getCulture();
        $JobDao = new JobDao();
        $level = new Level();

        $level = $JobDao->readLevel($transPid);
        if (!$level) {
            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record has been Deleted', $args, 'messages')));
            $this->redirect('admin/Level');
        }

        $this->level = $level;
        if ($request->isMethod('post')) {
            if (strlen($request->getParameter('txtName'))) {
                $level->setLevel_name(trim($request->getParameter('txtName')));
            } else {
                $level->setLevel_name(null);
            }
            if (strlen($request->getParameter('txtNamesi'))) {
                $level->setLevel_name_si(trim($request->getParameter('txtNamesi')));
            } else {
                $level->setLevel_name_si(null);
            }
            if (strlen($request->getParameter('txtNameta'))) {
                $level->setLevel_name_ta(trim($request->getParameter('txtNameta')));
            } else {
                $level->setLevel_name_ta(null);
            }

            try {
                $JobDao->saveLevel($level);
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/UpdateLevel?id=' . $encrypt->encrypt($level->getLevel_code()) . '&lock=' . $encrypt->encrypt(0));
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/UpdateLevel?id=' . $encrypt->encrypt($level->getLevel_code()) . '&lock=' . $encrypt->encrypt(0));
            }
            $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
            $this->redirect('admin/UpdateLevel?id=' . $encrypt->encrypt($level->getLevel_code()) . '&lock=' . $encrypt->encrypt(0));
        }
    }

    public function executeDeleteLevel(sfWebRequest $request) {
        if (count($request->getParameter('chkLocID')) > 0) {
            $JobDao = new JobDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_level', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $JobDao->deleteLevel($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_level', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/Level');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/Level');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/Level');
    }

    public function executeGraphicalstructure(sfWebRequest $request) {
        $companyDao = new CompanyDao();
        $this->list = $companyDao->getCompanystructurehierache();
    }

    public function executeValidateHieCode(sfWebRequest $request) {

        $companyDao = new CompanyDao();
        $id = $request->getParameter('id');
        $divisionId = $request->getParameter('divisionCode');
        $isValid = $companyDao->getValidateHieCode($id, $divisionId);

        if (count($isValid) > 0) {
            $msg = "0";
        } else {
            $msg = "1";
        }
        echo json_encode($msg);
        die;
    }

    public function executeTestLdap(sfWebRequest $request) {

        try {

            $ldap = new LdapConnect();
            $ldap->ldap_connect();
            $ldap->ldap_addEntry("004");
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            die(print_r($errMsg->display()));
            $this->setMessage('WARNING', $errMsg->display());
        }
        die;
    }
    
    
        public function executeAjaxloadData(sfWebRequest $request) {

        $this->Culture = $this->getUser()->getCulture();
        $Culture=$this->Culture; 
        $id = $request->getParameter('id');
        $def = $request->getParameter('def');

        $companyDao = new CompanyDao();
        $this->List = $companyDao->loadCompanyDataByID($id,$def);
        $arr = Array();

       
        foreach ($this->List as $row) {
            if($Culture=="en"){
                $n = "title";
            }else{
               $n = "title_" . $Culture;  
               if($row[$n]==""){
                   $n = "title";
               }else{
                   $n = "title_" . $Culture; 
               }
            }
            
           
            $arr[$row['id']] = $row[$n];
        }

        echo json_encode($arr);
        die;
    }
    
    
        public function executeListNotice(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $noticeDao = new NoticeDao();

            $this->sorter = new ListSorter('noticeAdmin', 'admin_module', $this->getUser(), array('no.notice_code', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('searchMode') == '') ? 'all' : $request->getParameter('searchMode');
            $this->searchValue = ($request->getParameter('searchValue') == '') ? '' : $request->getParameter('searchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'no.notice_code' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $noticeDao->getNotice($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->listNotice = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }


    public function executeSaveNotice(sfWebRequest $request) {
        $this->myCulture = $this->getUser()->getCulture();
        $noticeDao = new NoticeDao();

        if (!strlen($request->getParameter('lock'))) {
            $this->mode = 0;
        } else {
            $this->mode = $request->getParameter('lock');
        }
        
        $ebLockid = $request->getParameter('id');
        if (isset($this->mode)) {
            if ($this->mode == 1) {

                $conHandler = new ConcurrencyHandler();

                $recordLocked = $conHandler->setTableLock('hs_hr_notice', array($ebLockid), 1);

                if ($recordLocked) {
                    // Display page in edit mode
                    $this->mode = 1;
                } else {
                     
                    $this->mode = 0;
                    $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), true);
                    $this->redirect('admin/listNotice');
                }
            } else if ($this->mode == 0) {
                $conHandler = new ConcurrencyHandler();
                $recordLocked = $conHandler->resetTableLock('hs_hr_notice', array($ebLockid), 1);
                $this->mode = 0;
            }
        }
        $requestId = $request->getParameter('id');
        if (strlen($requestId)) {
            if (!strlen($this->mode)) {
                $this->mode = 0;
            }
            $this->disAct = $noticeDao->readNotice($requestId);

            if (!$this->disAct) {
                $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                $this->redirect('admin/listNotice');
            }
        } else {
            $this->mode = 1;
        }

        if ($request->isMethod('post')) {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $sysconf = new sysConf();
            try{
            if (strlen($request->getParameter('txtHiddenID'))) {
                $Notice = $noticeDao->readNotice($request->getParameter('txtHiddenID'));
            } else {
                $Notice = new Notice();
            }
                if (strlen($request->getParameter('txtName'))) {
                    $Notice->setNotice_name(mysql_real_escape_string(trim($request->getParameter('txtName'))));
                } else {
                    $Notice->setNotice_name(null);
                }
                if (strlen($request->getParameter('txtNamesi'))) {
                    $Notice->setNotice_name_si(mysql_real_escape_string(trim($request->getParameter('txtNamesi'))));
                } else {
                    $Notice->setNotice_name_si(null);
                }
                if (strlen($request->getParameter('txtNameta'))) {
                    $Notice->setNotice_name_ta(mysql_real_escape_string(trim($request->getParameter('txtNameta'))));
                } else {
                    $Notice->setNotice_name_ta(null);
                }
                if (strlen($request->getParameter('txtDes'))) {
                    $Notice->setNotice_desc(mysql_real_escape_string(trim($request->getParameter('txtDes'))));
                } else {
                    $Notice->setNotice_desc(null);
                }
                if (strlen($request->getParameter('txtDesSi'))) {
                    $Notice->setNotice_desc_si(mysql_real_escape_string(trim($request->getParameter('txtDesSi'))));
                } else {
                    $Notice->setNotice_desc_si(null);
                }
                if (strlen($request->getParameter('txtDesTa'))) {
                    $Notice->setNotice_desc_ta(mysql_real_escape_string(trim($request->getParameter('txtDesTa'))));
                } else {
                    $Notice->setNotice_desc_ta(null);
                }
                if (strlen($request->getParameter('fromdate'))) {
                    $Notice->setFrom_date(trim($request->getParameter('fromdate')));
                } else {
                    $Notice->setFrom_date(null);
                }
                if (strlen($request->getParameter('todate'))) {
                    $Notice->setTo_date(trim($request->getParameter('todate')));
                } else {
                    $Notice->setTo_date(null);
                }
                if (strlen($request->getParameter('chkEmail'))) {
                    $Notice->setEmail_flg(mysql_real_escape_string(trim($request->getParameter('chkEmail'))));
                } else {
                    $Notice->setEmail_flg(null);
                }
                if (strlen($request->getParameter('chkSMS'))) {
                    $Notice->setSms_flg(mysql_real_escape_string(trim($request->getParameter('chkSMS'))));
                } else {
                    $Notice->setSms_flg(null);
                }    
                if (strlen($request->getParameter('txtsmstext'))) {
                    $Notice->setSms_text(mysql_real_escape_string(trim($request->getParameter('txtsmstext'))));
                } else {
                    $Notice->setSms_text(null);
                }
                $Notice->setCreate_emp_number($_SESSION['empNumber']);
                $today = date("Y-m-d");
                $time = date('H:i:s');
                $Notice->setCreate_date($today);
                $Notice->setCreate_time($time);
                

                $Notice->save();
                //die(print_r());
                $MaxNotice=$noticeDao->getMaxNotice();
                if (strlen($request->getParameter('txtHiddenID'))) {
                    $notiseid=$request->getParameter('txtHiddenID');                
                }else{     
                    $notiseid=$MaxNotice[0]['MAX'];
                }
                $noticeDao->deleteNoticeEmployee($notiseid);
                foreach ($_POST['hiddenEmpNumber'] as $row){
                    $NoticeEMPMax=$noticeDao->getMaxNoticeEmployee();
                    $NoticeEmployee = new NoticeEmployee();
                    $NoticeEmployee->setNs_id($NoticeEMPMax[0]['MAX']+1);
                    $NoticeEmployee->setNotice_code($notiseid);
                    $NoticeEmployee->setEmp_number($row);
                    $NoticeEmployee->save();
                    $Employeee= $noticeDao->readEmployeeInformation($row);
                    if($Employeee->EmpContact->con_off_email!= null){
                        if($TO == null){
                            $TO = $Employeee->EmpContact->con_off_email;
                        }else{
                            $TO.= ",".$Employeee->EmpContact->con_off_email;
                        }
                    }
                     if($Employeee->EmpContact->con_per_mobile!= null){
                         $ToSMS[]= $Employeee->EmpContact->con_per_mobile;
                     }
                }
                
             $conn->commit();
             
//             if (strlen($request->getParameter('chkEmail'))) { 
//             $CC= "commonhrm@icta.lk";
//             $Message = trim($request->getParameter('txtDes'));
//             $Subject = trim($request->getParameter('txtName'));
//             $defaultDao = new DefaultDao();
//             $return=$defaultDao->sendEmail($Message,$TO,$CC,$Subject);
//             
//             }
//             if (strlen($request->getParameter('chkSMS'))) { 
//
//             //$TO = $request->getParameter('mobile');
//             $From = $sysconf->SMSDepartmentcode;
//             $Message = $request->getParameter('txtsmstext');
//             foreach(){
//             $ICTASMS = new ICTASMS();
//             $result=$ICTASMS->sendsms(array("recepient"=>$TO,"message"=>$Message));
//             }
//             
//             }
             
            
            if (strlen($requestId)) {
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Updated')));
                $this->redirect('admin/saveNotice?id=' . $requestId . '?lock=0');
            } else {
                $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                $this->redirect('admin/listNotice');
            }
            } catch (Doctrine_Connection_Exception $e) {
            $conn->rollback();
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listNotice');
            } catch (sfStopException $sf) {
            
        
        } catch (Exception $e) {
           $conn->rollback();
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/listNotice');
        }
        }
    }


    public function executeDeleteNotice(sfWebRequest $request) {


        if (count($request->getParameter('chkLocID')) > 0) {
            $noticeDao = new NoticeDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkLocID');
                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_notice', array($ids[$i]), 1);
                    if ($isRecordLocked) {
                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];

                        $noticeDao->deleteNotice("$ids[$i]");
                        $conHandler->resetTableLock('hs_hr_notice', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {

                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listNotice');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/listNotice');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/listNotice');
    }
    

    
    public function executeEducationType(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $EducationDao = new EducationDao();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'edu_type_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $EducationDao->searchEducationType($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->ListEducationType = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveEducationType(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        try {
            if (!strlen($request->getParameter('lock'))) {
                $this->mode = 0;
            } else {
                $this->mode = $request->getParameter('lock');
            }
            $ETId = $encrypt->decrypt($request->getParameter('ETId'));

            if (isset($this->mode)) {
                if ($this->mode == 1) {

                    $conHandler = new ConcurrencyHandler();

                    $recordLocked = $conHandler->setTableLock('hs_hr_education_type', array($ETId), 1);

                    if ($recordLocked) {
                        // Display page in edit mode
                        $this->mode = 1;
                    } else {

                        $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                        $this->mode = 0;
                    }
                } else if ($this->mode == 0) {
                    $conHandler = new ConcurrencyHandler();
                    $recordLocked = $conHandler->resetTableLock('hs_hr_education_type', array($ETId), 1);
                    $this->mode = 0;
                }
            }



            $this->userCulture = $this->getUser()->getCulture();
            $EducationDao = new EducationDao();


            $ETId = $request->getParameter('ETId');
            if (strlen($ETId)) {
                $ETId = $encrypt->decrypt($request->getParameter('ETId'));
                if (!strlen($this->mode)) {
                    $this->mode = 0;
                }
                $this->EducationType = $EducationDao->readEducationTypeID($ETId);
                if (!$this->EducationType) {
                    $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                    $this->redirect('admin/EducationType');
                }
            } else {
                $this->mode = 1;
            }


            if ($request->isMethod('post')) { //die(print_r($_POST));

                if (strlen($request->getParameter('txtHiddenETID'))) {
                    $EducationType = $EducationDao->readEducationTypeID($request->getParameter('txtHiddenETID'));
                } else {
                    $EducationType = new EducationType();
                }

                
                if (($request->getParameter('txtEducationTypeName')) != null) {
                    $EducationType->setEdu_type_name(trim($request->getParameter('txtEducationTypeName')));
                } else {
                    $EducationType->setEdu_type_name(null);
                }
                if (($request->getParameter('txtEducationTypeNameSi')) != null) {
                    $EducationType->setEdu_type_name_si(trim($request->getParameter('txtEducationTypeNameSi')));
                } else {
                    $EducationType->setEdu_type_name_si(null);
                }
                if (($request->getParameter('txtEducationTypeNameTa')) != null) {
                    $EducationType->setEdu_type_name_ta(trim($request->getParameter('txtEducationTypeNameTa')));
                } else {
                    $EducationType->setEdu_type_name_ta(null);
                }


                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_education_type', array($request->getParameter('txtHiddenETID')), 1);
                $EducationType->save();
                if(!strlen($request->getParameter('txtHiddenETID'))){
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                    $this->redirect('admin/EducationType');
                }else{
                    $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
                    $this->redirect('admin/SaveEducationType?ETId=' . $encrypt->encrypt($request->getParameter('txtHiddenETID')) . '&lock=0');
                }

                
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/EducationType');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/EducationType');
        }
    }

    public function executeDeleteEducationType(sfWebRequest $request) {
        if (count($request->getParameter('chkID')) > 0) {

            $EducationDao = new EducationDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_education_type', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $EducationDao->deleteEducationType($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_education_type', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EducationType');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EducationType');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/EducationType');
    }
    
    
    public function executeEducationSubject(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $EducationDao = new EducationDao();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 's.subj_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $EducationDao->searchEducationSubject($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->ListEducationSubject = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveEducationSubject(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        try {
            if (!strlen($request->getParameter('lock'))) {
                $this->mode = 0;
            } else {
                $this->mode = $request->getParameter('lock');
            }
            $ETId = $encrypt->decrypt($request->getParameter('ESId'));

            if (isset($this->mode)) {
                if ($this->mode == 1) {

                    $conHandler = new ConcurrencyHandler();

                    $recordLocked = $conHandler->setTableLock('hs_hr_edu_subject', array($ETId), 1);

                    if ($recordLocked) {
                        // Display page in edit mode
                        $this->mode = 1;
                    } else {

                        $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                        $this->mode = 0;
                    }
                } else if ($this->mode == 0) {
                    $conHandler = new ConcurrencyHandler();
                    $recordLocked = $conHandler->resetTableLock('hs_hr_edu_subject', array($ETId), 1);
                    $this->mode = 0;
                }
            }



            $this->userCulture = $this->getUser()->getCulture();
            $EducationDao = new EducationDao();


            $ETId = $request->getParameter('ESId');
            if (strlen($ETId)) {
                $ETId = $encrypt->decrypt($request->getParameter('ESId'));
                if (!strlen($this->mode)) {
                    $this->mode = 0;
                }
                $this->EducationSubject = $EducationDao->readEducationSubjectID($ETId);
                if (!$this->EducationSubject) {
                    $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                    $this->redirect('admin/EducationSubject');
                }
            } else {
                $this->mode = 1;
            }
            
            $this->EducationTypeList=$EducationDao->getEducationTypes();

            if ($request->isMethod('post')) { //die(print_r($_POST));

                if (strlen($request->getParameter('txtHiddenESID'))) {
                    $EducationSubject = $EducationDao->readEducationSubjectID($request->getParameter('txtHiddenESID'));
                } else {
                    $EducationSubject = new EducationSubject();
                }
                if (($request->getParameter('cmbEducationType')) != null) {
                    $EducationSubject->setEdu_type_id(trim($request->getParameter('cmbEducationType')));
                } else {
                    $EducationSubject->setEdu_type_id(null);
                }
                
                if (($request->getParameter('txtEducationSubjectName')) != null) {
                    $EducationSubject->setSubj_name(trim($request->getParameter('txtEducationSubjectName')));
                } else {
                    $EducationSubject->setSubj_name(null);
                }
                if (($request->getParameter('txtEducationSubjectNameSi')) != null) {
                    $EducationSubject->setSubj_name_si(trim($request->getParameter('txtEducationSubjectNameSi')));
                } else {
                    $EducationSubject->setSubj_name_si(null);
                }
                if (($request->getParameter('txtEducationSubjectNameTa')) != null) {
                    $EducationSubject->setSubj_name_ta(trim($request->getParameter('txtEducationSubjectNameTa')));
                } else {
                    $EducationSubject->setSubj_name_ta(null);
                }


                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_edu_subject', array($request->getParameter('txtHiddenESID')), 1);
                $EducationSubject->save();
                if(!strlen($request->getParameter('txtHiddenESID'))){
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                    $this->redirect('admin/EducationSubject');
                }else{
                    $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
                    $this->redirect('admin/SaveEducationSubject?ESId=' . $encrypt->encrypt($request->getParameter('txtHiddenESID')) . '&lock=0');
                }

                
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/hs_hr_edu_subject');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/EducationSubject');
        }
    }

    public function executeDeleteEducationSubject(sfWebRequest $request) {
        if (count($request->getParameter('chkID')) > 0) {

            $EducationDao = new EducationDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_edu_subject', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $EducationDao->deleteEducationSubject($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_edu_subject', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EducationSubject');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EducationSubject');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/EducationSubject');
    }

    public function executeEducationYearGrade(sfWebRequest $request) {
        

            try {
                $this->userCulture = $this->getUser()->getCulture();


                $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('', ListSorter::ASCENDING));
                $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

                $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
                $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

                $this->sort = ($request->getParameter('sort') == '') ? 'g.grd_id' : $request->getParameter('sort');
                $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

                $EducationDao = new EducationDao();
                $result = $EducationDao->searchEducationYearGrade($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

                $this->listEducationYearGrade = $result['data'];
                $this->pglay = $result['pglay'];
                $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
                $this->pglay->setSelectedTemplate('{%page}');
                if (count($result['data']) <= 0) {
                    $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
                }
            } catch (sfStopException $sf) {
                
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('default/error');
            }

    }



    public function executeSaveEducationYearGrade(sfWebRequest $request) {

            try {


                if (!strlen($request->getParameter('lock'))) {
                    $this->mode = 0;
                } else {
                    $this->mode = $request->getParameter('lock');
                }
                $ebLockid = $request->getParameter('disId');
                if (isset($this->mode)) {
                    if ($this->mode == 1) {

                        $conHandler = new ConcurrencyHandler();

                        $recordLocked = $conHandler->setTableLock('hs_hr_edu_year_grade', array($ebLockid), 1);

                        if ($recordLocked) {
                            // Display page in edit mode
                            $this->mode = 1;
                        } else {
                            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                            $this->mode = 0;
                        }
                    } else if ($this->mode == 0) {
                        $conHandler = new ConcurrencyHandler();
                        $recordLocked = $conHandler->resetTableLock('hs_hr_edu_year_grade', array($ebLockid), 1);
                        $this->mode = 0;
                    }
                }



                $this->userCulture = $this->getUser()->getCulture();
                $EducationDao = new EducationDao();


                $disId = $request->getParameter('disId');
                $year = $request->getParameter('year');
                $edut = $request->getParameter('edut');
                //die(print_r($year));
                if (strlen($disId)) {
                    if (!strlen($this->mode)) {
                        $this->mode = 0;
                    }
                    $this->EducationSubjectYear = $EducationDao->readEducationSubjectYear($disId);
                    if (!$this->EducationSubjectYear) {
                        $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                        $this->redirect('admin/EducationYearGrade');
                    }
                } else {
                    $this->mode = 1;
                }
                
                $this->EducationTypeList = $EducationDao->readEducationTypeList();
                $this->EmpEducationDetail = $EducationDao->readEducationGradeYear($year,$edut);
                //die(print_r($this->EmpEducationDetail));
                //$this->MediumList = $EducationDao->getLanguages();
                
                
                if ($request->isMethod('post')) { 
                    
                    //die(print_r($_POST));
                    $conn = Doctrine_Manager::getInstance()->connection();
                    $conn->beginTransaction();
                    $EducationDao->readEducationGradeYearID($year,$edut);                  
                    
    
                    
                                       
                    $exploed = array();
                    $count_rows = array();

                foreach ($_POST as $key => $value) {


                    $exploed = explode("_", $key);


                    if (strlen($exploed[1])) {

                        $count_rows[] = $exploed[1];

                        $arrname = "a_" . $exploed[1];

                        if (!is_array($$arrname)) {
                            $$arrname = Array();
                        }

                        ${$arrname}[$exploed[0]] = $value;
                    }
                }

                $uniqueRowIds = array_unique($count_rows);
                $uniqueRowIds = array_values($uniqueRowIds);

                for ($i = 0; $i < count($uniqueRowIds); $i++) {
                    
                    $EduGradeYear = new EducationYearGrade();
                    
                    if (!strlen($request->getParameter('cmbEduType'))) {
                        $EduGradeYear->setEdu_type_id(null);
                    } else {
                        $EduGradeYear->setEdu_type_id($request->getParameter('cmbEduType'));
                    }
                    if (!strlen($request->getParameter('cmbYear'))) {

                        $EduGradeYear->setGrd_year(null);
                    } else {
                        $EduGradeYear->setGrd_year($request->getParameter('cmbYear'));
                    }
                    
                    //$MaxEmpEduHead = $empDao->getLastEmpEducationHeadID(); 
                    //$EmpEduDetail->setEduh_id($MaxEmpEduHead[0]['MAX']);
                    



                    $v = "a_" . $uniqueRowIds[$i];


//                    die(print_r(${$v}[txtgrdname]));

                    if (!strlen(${$v}[txtgrdname])) { 

                        $EduGradeYear->setGrd_name(null);
                    } else { 
                        $EduGradeYear->setGrd_name((${$v}[txtgrdname]));
                    }
                    if (!strlen(${$v}[txtgrddesc])) {

                        $EduGradeYear->setGrd_desc(null);
                    } else {
                        $EduGradeYear->setGrd_desc((${$v}[txtgrddesc]));
                    }
                    if (!strlen(${$v}[txtgrdmark])) {

                        $EduGradeYear->setGrd_mark(null);
                    } else {
                        $EduGradeYear->setGrd_mark((${$v}[txtgrdmark]));
                    }
                    //die(print_r($EduGradeYear));
                    //$empDao->saveRateDetail($EmpEduDetail);
                    $EduGradeYear->save();
                }

                    
                    $conn->commit();
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                    $this->redirect('admin/EducationYearGrade');
                }
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EducationYearGrade');
            } catch (sfStopException $sf) {
                
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EducationYearGrade');
            }

    }

    public function executeDeleteEducationYearGrade(sfWebRequest $request) {

        $EmpHeadDelete = $request->getParameter('chkID', array());
        if ($EmpHeadDelete) {

            $EducationDao = new EducationDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();


                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($EmpHeadDelete); $i++) { 

                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_edu_year_grade', array($EmpHeadDelete[$i]), 1);


                    if ($isRecordLocked) {
                        $countArr = $EmpHeadDelete[$i];
                    } else {
                        $saveArr = $EmpHeadDelete[$i];

                        $EducationDao->deleteEducationGradeYear($EmpHeadDelete[$i]);
                        //$empDao->deleteEmpEducationHead($EmpHeadDelete[$i]);
                        $conHandler->resetTableLock(' hs_hr_edu_year_grade', array($EmpHeadDelete[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EmpEducation');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/EducationYearGrade');
    }    

    public function executeEB_Exam(sfWebRequest $request) {
        

            try {
                $this->userCulture = $this->getUser()->getCulture();


                $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('', ListSorter::ASCENDING));
                $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

                $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
                $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

                $this->sort = ($request->getParameter('sort') == '') ? 'g.ebh_id' : $request->getParameter('sort');
                $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

                $EducationDao = new EducationDao();
                $result = $EducationDao->searchEB_Exam($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

                $this->listEBExam = $result['data'];
                $this->pglay = $result['pglay'];
                $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
                $this->pglay->setSelectedTemplate('{%page}');
                if (count($result['data']) <= 0) {
                    $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
                }
            } catch (sfStopException $sf) {
                
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('default/error');
            }

    }



    public function executeSaveEB_Exam(sfWebRequest $request) {

            try {


                if (!strlen($request->getParameter('lock'))) {
                    $this->mode = 0;
                } else {
                    $this->mode = $request->getParameter('lock');
                }
                $ebLockid = $request->getParameter('disId');
                if (isset($this->mode)) {
                    if ($this->mode == 1) {

                        $conHandler = new ConcurrencyHandler();

                        $recordLocked = $conHandler->setTableLock('hs_hr_eb_master_head', array($ebLockid), 1);

                        if ($recordLocked) {
                            // Display page in edit mode
                            $this->mode = 1;
                        } else {
                            $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                            $this->mode = 0;
                        }
                    } else if ($this->mode == 0) {
                        $conHandler = new ConcurrencyHandler();
                        $recordLocked = $conHandler->resetTableLock('hs_hr_eb_master_head', array($ebLockid), 1);
                        $this->mode = 0;
                    }
                }



                $this->userCulture = $this->getUser()->getCulture();
                $EducationDao = new EducationDao();


                $disId = $request->getParameter('disId');

                //die(print_r($year));
                if (strlen($disId)) {
                    if (!strlen($this->mode)) {
                        $this->mode = 0;
                    }
                    $this->EBExam = $EducationDao->readEB_Exam_ID($disId);
                    if (!$this->EBExam) {
                        $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                        $this->redirect('admin/EB_Exam');
                    }
                } else {
                    $this->mode = 1;
                }
                 
                $this->GradeList = $EducationDao->readGradeList();
                if($this->EBExam->ebh_id){
                $this->EbExamDetail = $EducationDao->readEBExamDetails($this->EBExam->ebh_id);
                }
                //die(print_r($this->EmpEducationDetail));
                //$this->MediumList = $EducationDao->getLanguages();
                
                
                if ($request->isMethod('post')) { 
                    
                    //die(print_r($_POST));
                    $conn = Doctrine_Manager::getInstance()->connection();
                    $conn->beginTransaction();
                    $EBExamHead=$EducationDao->readEB_Exam_ID($request->getParameter('txtHiddenDisID'));                  
                    
                    if($EBExamHead->ebh_id == null){
                        $EBExamHead = new EBMasterHead();
                    }
                    
                    if (!strlen($request->getParameter('cmbGradeType'))) {
                        $EBExamHead->setGrade_code(null);
                    } else {
                        $EBExamHead->setGrade_code($request->getParameter('cmbGradeType'));
                    }
                    
                    if (!strlen($request->getParameter('txtEBName'))) {
                        $EBExamHead->setEbh_exam_name(null);
                    } else {
                        $EBExamHead->setEbh_exam_name($request->getParameter('txtEBName'));
                    }
                    
                    if (!strlen($request->getParameter('txtEBNameSi'))) {
                        $EBExamHead->setEbh_exam_name_si(null);
                    } else {
                        $EBExamHead->setEbh_exam_name_si($request->getParameter('txtEBNameSi'));
                    }
                    
                    if (!strlen($request->getParameter('txtEBNameTa'))) {
                        $EBExamHead->setEbh_exam_name_ta(null);
                    } else {
                        $EBExamHead->setEbh_exam_name_ta($request->getParameter('txtEBNameTa'));
                    }
                    
                    if (!strlen($request->getParameter('cmbYear'))) {
                        $EBExamHead->setEbh_exp_year(null);
                    } else {
                        $EBExamHead->setEbh_exp_year($request->getParameter('cmbYear'));
                    }
                    
                    $EBExamHead->save();
                    $EducationDao->deleteEBExamDetail($EBExamHead->ebh_id);
                    
                    $exploed = array();
                    $count_rows = array();

                foreach ($_POST as $key => $value) {


                    $exploed = explode("_", $key);


                    if (strlen($exploed[1])) {

                        $count_rows[] = $exploed[1];

                        $arrname = "a_" . $exploed[1];

                        if (!is_array($$arrname)) {
                            $$arrname = Array();
                        }

                        ${$arrname}[$exploed[0]] = $value;
                    }
                }

                $uniqueRowIds = array_unique($count_rows);
                $uniqueRowIds = array_values($uniqueRowIds);

                for ($i = 0; $i < count($uniqueRowIds); $i++) {
                    
                    
                    $EBDetail = new EBMasterDetail();
                    
                    if (!strlen($EBExamHead->ebh_id)) {
                        $EBExamHeadMax=$EducationDao->getEBExamHeadMaxId();
                        $EBDetail->setEbh_id($EBExamHeadMax[0]['Max']);
                    } else {
                        $EBDetail->setEbh_id($EBExamHead->ebh_id);
                    }
                    
                    
                    //$MaxEmpEduHead = $empDao->getLastEmpEducationHeadID(); 
                    //$EmpEduDetail->setEduh_id($MaxEmpEduHead[0]['MAX']);
                    



                    $v = "a_" . $uniqueRowIds[$i];

                    if (!strlen(${$v}[cmbSubject])) { 

                        $EBDetail->setEbs_id(null);
                    } else { 
                        $EBDetail->setEbs_id((${$v}[cmbSubject]));
                    }
                    if (!strlen(${$v}[txtPassMark])) { 

                        $EBDetail->setEbd_pass_mark(null);
                    } else { 
                        $EBDetail->setEbd_pass_mark((${$v}[txtPassMark]));
                    }

                    $EBDetail->save();
                }

                    
                    $conn->commit();
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                    $this->redirect('admin/EB_Exam');
                }
            } catch (Doctrine_Connection_Exception $e) {
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EB_Exam');
            } catch (sfStopException $sf) {
                
            } catch (Exception $e) {
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EB_Exam');
            }

    }

    public function executeDeleteEB_Exam(sfWebRequest $request) {

        $EmpHeadDelete = $request->getParameter('chkID', array());
        if ($EmpHeadDelete) {

            $EducationDao = new EducationDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();


                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($EmpHeadDelete); $i++) { 

                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_eb_master_head', array($EmpHeadDelete[$i]), 1);


                    if ($isRecordLocked) {
                        $countArr = $EmpHeadDelete[$i];
                    } else {
                        $saveArr = $EmpHeadDelete[$i];

                        $EducationDao->deleteEBExamDetail($EmpHeadDelete[$i]);
                        $EducationDao->deleteEBExamHead($EmpHeadDelete[$i]);
                        $conHandler->resetTableLock('hs_hr_eb_master_head', array($EmpHeadDelete[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EB_Exam');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/EB_Exam');
    }    

    public function executeLoadEBSubjects(sfWebRequest $request) {


        $Culture = $this->getUser()->getCulture();
        $EducationDao = new EducationDao();
        $Subjects = $EducationDao->getEBSubject();
        
        foreach ($Subjects as $row) {
            if($Culture=="en"){
                $n = "ebs_name";
            }else{
               $n = "ebs_name_" . $Culture;  
               if($row[$n]==""){
                   $n = "ebs_name";
               }else{
                   $n = "ebs_name_" . $Culture; 
               }
            }
            
           
            $arr[] = $row['ebs_id']."|".$row[$n];
        }

        echo json_encode($arr);
        die;
    }
    
        public function executeEBSubject(sfWebRequest $request) {

        try {
            $this->userCulture = $this->getUser()->getCulture();
            $EducationDao = new EducationDao();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'ebs_id' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            $result = $EducationDao->searchEBSubject($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order);

            $this->ListEBSubject = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');
            if (count($result['data']) <= 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Sorry,Your Search did not Match any Records.", $args, 'messages')));
            }
        } catch (sfStopException $sf) {
            
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    public function executeSaveEBSubject(sfWebRequest $request) {
        $encrypt = new EncryptionHandler();

        try {
            if (!strlen($request->getParameter('lock'))) {
                $this->mode = 0;
            } else {
                $this->mode = $request->getParameter('lock');
            }
            $ETId = $encrypt->decrypt($request->getParameter('ETId'));

            if (isset($this->mode)) {
                if ($this->mode == 1) {

                    $conHandler = new ConcurrencyHandler();

                    $recordLocked = $conHandler->setTableLock('hs_hr_eb_subject', array($ETId), 1);

                    if ($recordLocked) {
                        // Display page in edit mode
                        $this->mode = 1;
                    } else {

                        $this->setMessage('WARNING', array($this->getContext()->getI18N()->__('Can not update. Record locked by another user.', $args, 'messages')), false);
                        $this->mode = 0;
                    }
                } else if ($this->mode == 0) {
                    $conHandler = new ConcurrencyHandler();
                    $recordLocked = $conHandler->resetTableLock('hs_hr_eb_subject', array($ETId), 1);
                    $this->mode = 0;
                }
            }



            $this->userCulture = $this->getUser()->getCulture();
            $EducationDao = new EducationDao();


            $ETId = $request->getParameter('ETId');
            if (strlen($ETId)) {
                $ETId = $encrypt->decrypt($request->getParameter('ETId'));
                if (!strlen($this->mode)) {
                    $this->mode = 0;
                }
                $this->EducationType = $EducationDao->readEBSubjectID($ETId);
                if (!$this->EducationType) {
                    $this->setMessage('WARNING', array($this->getContext()->geti18n()->__('Record Not Found')));
                    $this->redirect('admin/SaveEBSubject');
                }
            } else {
                $this->mode = 1;
            }


            if ($request->isMethod('post')) { //die(print_r($_POST));

                if (strlen($request->getParameter('txtHiddenETID'))) {
                    $EBSubject = $EducationDao->readEBSubjectID($request->getParameter('txtHiddenETID'));
                } else {
                    $EBSubject = new EBSubject();
                }

                
                if (($request->getParameter('txtEducationTypeName')) != null) {
                    $EBSubject->setEbs_name(trim($request->getParameter('txtEducationTypeName')));
                } else {
                    $EBSubject->setEbs_name(null);
                }
                if (($request->getParameter('txtEducationTypeNameSi')) != null) {
                    $EBSubject->setEbs_name_si(trim($request->getParameter('txtEducationTypeNameSi')));
                } else {
                    $EBSubject->setEbs_name_si(null);
                }
                if (($request->getParameter('txtEducationTypeNameTa')) != null) {
                    $EBSubject->setEbs_name_ta(trim($request->getParameter('txtEducationTypeNameTa')));
                } else {
                    $EBSubject->setEbs_name_ta(null);
                }


                $conHandler = new ConcurrencyHandler();
                $conHandler->resetTableLock('hs_hr_eb_subject', array($request->getParameter('txtHiddenETID')), 1);
                $EBSubject->save();
                if(!strlen($request->getParameter('txtHiddenETID'))){
                    $this->setMessage('SUCCESS', array($this->getContext()->geti18n()->__('Successfully Added')));
                    $this->redirect('admin/EBSubject');
                }else{
                    $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Updated", $args, 'messages')));
                    $this->redirect('admin/SaveEBSubject?ETId=' . $encrypt->encrypt($request->getParameter('txtHiddenETID')) . '&lock=0');
                }

                
            }
        } catch (Doctrine_Connection_Exception $e) {
            $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/EBSubject');
        } catch (sfStopException $sf) {
            
        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('admin/EBSubject');
        }
    }

    public function executeDeleteEBSubject(sfWebRequest $request) {
        if (count($request->getParameter('chkID')) > 0) {

            $EducationDao = new EducationDao();
            try {
                $conn = Doctrine_Manager::getInstance()->connection();
                $conn->beginTransaction();
                $ids = array();
                $ids = $request->getParameter('chkID');

                $countArr = array();
                $saveArr = array();
                for ($i = 0; $i < count($ids); $i++) {
                    $conHandler = new ConcurrencyHandler();
                    $isRecordLocked = $conHandler->isTableLocked('hs_hr_eb_subject', array($ids[$i]), 1);
                    if ($isRecordLocked) {

                        $countArr = $ids[$i];
                    } else {
                        $saveArr = $ids[$i];
                        $EducationDao->deleteEBSubject($ids[$i]);
                        $conHandler->resetTableLock('hs_hr_eb_subject', array($ids[$i]), 1);
                    }
                }

                $conn->commit();
            } catch (Doctrine_Connection_Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getPortableMessage(), $e->getPortableCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EBSubject');
            } catch (Exception $e) {
                $conn->rollBack();
                $errMsg = new CommonException($e->getMessage(), $e->getCode());
                $this->setMessage('WARNING', $errMsg->display());
                $this->redirect('admin/EBSubject');
            }
            if (count($saveArr) > 0 && count($countArr) == 0) {
                $this->setMessage('SUCCESS', array($this->getContext()->getI18N()->__("Successfully Deleted", $args, 'messages')));
            } elseif (count($saveArr) > 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Some records are can not be deleted as them  Locked by another user ", $args, 'messages')));
            } elseif (count($saveArr) == 0 && count($countArr) > 0) {
                $this->setMessage('WARNING', array($this->getContext()->getI18N()->__("Can not delete as them  Locked by another user ", $args, 'messages')));
            }
        } else {
            $this->setMessage('NOTICE', array('Select at least one record to delete'));
        }
        $this->redirect('admin/EBSubject');
    }
    
    public function executeCurrentEmployee(sfWebRequest $request) {

        $NoticeDao = new NoticeDao();
        $notice_code = $request->getParameter('EVid');

        $emplist = $NoticeDao->getNoticeEmpList($notice_code);
//die(print_r($emplist));
        foreach ($emplist as $emp) {
            
            $employee=$NoticeDao->getEmployeeDetail($emp['emp_number']);
            


            
            $arr[$emp['emp_number']] = $employee->employeeId . "|" . $employee->emp_display_name."|". $employee->empNumber;
            
        }
        //die(print_r($arr));
        echo json_encode($arr);
        die;
    }
    
    
    
}