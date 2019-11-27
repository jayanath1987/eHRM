<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test cases for JobDao
 * Since the class is huge, we test multiple function within one test cases rather than writing many testcase
 *
 * @author Sujith T
 */
class JobDaoTest extends PHPUnit_Framework_TestCase {
   private $testCases;
	private $jobDao;

	/**
	 * Set up method
	 */
	protected function setUp(){
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml');
		$this->jobDao	=	new JobDao();
	}

   /**
    * Test saveJobCategory
    */
   public function testSaveJobCategory() {
      foreach($this->testCases['JobCategory'] as $k => $v) {
         $jobCategory = new JobCategory();
         $jobCategory->setEecDesc($v['desc']);
         $result = $this->jobDao->saveJobCategory($jobCategory);
         $this->assertTrue($result);
         $this->testCases['JobCategory'][$k]['id'] = $jobCategory->getEecCode();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test all read, search, delete functionality
    */
   public function testReadDeleteJobCategory() {
      $list = $this->jobDao->getJobCategoryList();
      $this->assertTrue($list instanceof Doctrine_Collection);
      
      foreach($this->testCases['JobCategory'] as $k => $v) {
         $jobCategory = $this->jobDao->readJobCategory($v['id']);
         $this->assertTrue($jobCategory instanceof JobCategory);

         $list1 = $this->jobDao->searchJobCategory('eec_code', $v['id']);
         $this->assertTrue($list1 instanceof Doctrine_Collection);

         $result = $this->jobDao->deleteJobCategory(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['JobCategory'][$k]['id']);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test saveSaleryGrade
    */
   public function testSaveSaleryGrade() {
      foreach($this->testCases['SalaryGrade'] as $k => $v) {
         $salaryGrade = new SalaryGrade();
         $salaryGrade->setSalGrdName($v['name']);
         $result = $this->jobDao->saveSalaryGrade($salaryGrade);
         $this->assertTrue($result instanceof SalaryGrade);
         $this->testCases['SalaryGrade'][$k]['id'] = $salaryGrade->getSalGrdCode();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test all read, search, delete functionality for SalaryGrade
    */
   public function testReadDeleteSaleryGrade() {
      $list = $this->jobDao->getSalaryGradeList();
      $this->assertTrue($list instanceof Doctrine_Collection);

      foreach($this->testCases['SalaryGrade'] as $k => $v) {
         $salaryGrade = $this->jobDao->readSalaryGrade($v['id']);
         $this->assertTrue($salaryGrade instanceof SalaryGrade);

         $list1 = $this->jobDao->searchSalaryGrade('sal_grd_code', $v['id']);
         $this->assertTrue($list1 instanceof Doctrine_Collection);

         $result = $this->jobDao->deleteSalaryGrade(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['SalaryGrade'][$k]['id']);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test saveSalleryGradeCurrency
    */
   public function testSaveSalleryGradeCurrency() {
         $salaryGrade = new SalaryGrade();
         $salaryGrade->setSalGrdName("name". rand(1,1000));
         $this->jobDao->saveSalaryGrade($salaryGrade);
         
      foreach($this->testCases['SalaryCurrencyDetail'] as $k => $v) {
         $obj = new SalaryCurrencyDetail();
         $obj->setCurrencyId($v['currencyId']);
         $obj->setMinSalary($v['minSalary']);
         $obj->setSalaryStep($v['salaryStep']);
         $obj->setMaxSalary($v['maxSalary']);
         $obj->setSalGrdCode($salaryGrade->getSalGrdCode());
         $result = $this->jobDao->saveSalleryGradeCurrency($obj);
         $this->assertTrue($result);
         $result = $this->jobDao->isExistingSalleryGradeCurrency($obj);
         $this->assertTrue($result);

         $this->testCases['SalaryCurrencyDetail'][$k]['salaryGradeCode'] = $salaryGrade->getSalGrdCode();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test all read, search, delete functionality for SalaryCurrencyDetail
    */
   public function testReadDeleteSalaryCurrencyDetail() {
      $salaryGradeCode = "";
      foreach($this->testCases['SalaryCurrencyDetail'] as $k => $v) {
         $list = $this->jobDao->getSalaryGradeCurrency($v['salaryGradeCode']);
         $this->assertTrue($list instanceof Doctrine_Collection);
         $obj = $this->jobDao->getSalaryCurrencyDetail($v['salaryGradeCode'], $v['currencyId']);
         $this->assertTrue($obj instanceof SalaryCurrencyDetail);
         $result = $this->jobDao->deleteSalaryGradeCurrency($v['salaryGradeCode'], array($v['currencyId']));
         $this->assertTrue($result);
         $salaryGradeCode = $v['salaryGradeCode'];
      }
      $this->jobDao->deleteSalaryGrade(array($salaryGradeCode));
   }

   /**
    * Test saveEmployeeStatus
    */
   public function testSaveEmployeeStatus() {
      foreach($this->testCases['EmployeeStatus'] as $k => $v) {
         $obj = new EmployeeStatus();
         $obj->setName($v['name']);
         $result = $this->jobDao->saveEmployeeStatus($obj);
         $this->assertTrue($result);
         $this->testCases['EmployeeStatus'][$k]['id'] = $obj->getId();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test all read, search, delete functionality for EmployeeStatus
    */
   public function testReadDeleteEmployeeStatus() {
      $list = $this->jobDao->getEmployeeStatusList();
      $this->assertTrue($list instanceof Doctrine_Collection);
      foreach($this->testCases['EmployeeStatus'] as $k => $v) {
         $list = $this->jobDao->searchEmployeeStatus('name', $v['name']);
         $this->assertTrue($list instanceof Doctrine_Collection);
         $result = $this->jobDao->readEmployeeStatus($v['id']);
         $this->assertTrue($result instanceof EmployeeStatus);
         $result = $this->jobDao->deleteEmployeeStatus(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['EmployeeStatus'][$k]['id']);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test saveJobSpecifications
    */
   public function testSaveJobSpecifications() {
      foreach($this->testCases['JobSpecifications'] as $k => $v) {
         $obj = new JobSpecifications();
         $obj->setJobspecName($v['name']);
         $obj->setJobspecDesc($v['desc']);
         $obj->setJobspecDuties($v['duties']);
         $result = $this->jobDao->saveJobSpecifications($obj);
         $this->assertTrue($result);
         $this->testCases['JobSpecifications'][$k]['id'] = $obj->getJobspecId();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test all read, search, delete functionality for JobSpecifications
    */
   public function testReadDeleteJobSpecifications() {
      $list = $this->jobDao->getJobSpecificationsList();
      $this->assertTrue($list instanceof Doctrine_Collection);
      
      foreach($this->testCases['JobSpecifications'] as $k => $v) {
         $result = $this->jobDao->readJobSpecifications($v['id']);
         $this->assertTrue($result instanceof JobSpecifications);
         $list = $this->jobDao->searchJobSpecifications('jobspec_id', $v['id']);
         $this->assertTrue($list instanceof Doctrine_Collection);
         $result = $this->jobDao->deleteJobSpecifications(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['JobSpecifications'][$k]['id']);
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test saveJobTitle
    */
   public function testSaveJobTitle() {
      $list    = $this->jobDao->getEmployeeStatusList();
      $status  = array();
      foreach($list as $stat) {
         $status[] = $stat;
      }

      //defining salary grade for foreign key referencing
      $salaryGrade = new SalaryGrade();
      $salaryGrade->setSalGrdName("name". rand(1,1000));
      $this->jobDao->saveSalaryGrade($salaryGrade);

      //defining JobSpecification for foreign key referencing
      $spec = new JobSpecifications();
      $spec->setJobspecName('name' . rand(1,1000));
      $spec->setJobspecDesc('desc' . rand(1,1000));
      $this->jobDao->saveJobSpecifications($spec);

      foreach($this->testCases['JobTitle'] as $k => $v) {
         $obj = new JobTitle();
         $obj->setName($v['name']);
         $obj->setDescription($v['desc']);
         $obj->setComments($v['comment']);
         $obj->setSalaryGradeId($salaryGrade->getSalGrdCode());
         $obj->setJobspecId($spec->getJobspecId());
         $result = $this->jobDao->saveJobTitle($obj, $status);
         $this->assertTrue($result);
         $this->testCases['JobTitle'][$k]['id'] = $obj->getId();
         $this->testCases['JobTitle'][$k]['salaryGradeCode'] = $salaryGrade->getSalGrdCode();
         $this->testCases['JobTitle'][$k]['jobSpecId'] = $spec->getJobspecId();
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }

   /**
    * Test all read, search, delete functionality for JobSpecifications
    */
   public function testReadDeleteJobTitle() {
      foreach($this->testCases['JobTitle'] as $k => $v) {
         $result = $this->jobDao->readJobTitle($v['id']);
         $this->assertTrue($result instanceof  JobTitle);
         
         $result = $this->jobDao->deleteJobTitleEmpStstus($result);
         $this->assertTrue($result);

         $result = $this->jobDao->searchJobTitle('id', $v['id']);
         $this->assertTrue($result instanceof Doctrine_Collection);

         $result = $this->jobDao->deleteJobTitle(array($v['id']));
         $this->assertTrue($result);
         unset($this->testCases['JobTitle'][$k]['id']);

         $this->jobDao->deleteSalaryGrade(array($v['salaryGradeCode']));
         $this->jobDao->deleteJobSpecifications(array($v['jobSpecId']));
      }
      file_put_contents(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml',sfYaml::dump($this->testCases));
   }
}
?>