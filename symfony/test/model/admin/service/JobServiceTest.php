<?php
require_once 'PHPUnit/Framework.php';
/**
 * Test cases for JobService
 * Since the class is huge, we test multiple function within one test cases rather than writing many testcase
 *
 * @author Sujith T
 */
class JobServiceTest extends PHPUnit_Framework_TestCase {
   private $testCases;
   private $jobDao;
	private $jobService;

	/**
	 * Set up method
	 */
	protected function setUp(){
		$this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/job.yml');
		$this->jobService	=	new JobService();
	}

   /**
    * Test saveJobCategory
    */
   public function testSaveJobCategory() {
      foreach($this->testCases['JobCategory'] as $k => $v) {
         $jobCategory = new JobCategory();
         $jobCategory->setEecDesc($v['desc']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
            ->method('saveJobCategory')
            ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         
         $result = $this->jobService->saveJobCategory($jobCategory);
         $this->assertTrue($result);
      }
   }

   /**
    * Test all read, search, delete functionality
    */
   public function testReadDeleteJobCategory() {
      $jobDao  = new JobDao();
      $list    = $jobDao->getJobCategoryList();
      
      $this->jobDao  =	$this->getMock('JobDao');
      $this->jobDao->expects($this->once())
           ->method('getJobCategoryList')
           ->will($this->returnValue($list));
      $this->jobService->setJobDao($this->jobDao);
      $result  = $this->jobService->getJobCategoryList();
      $this->assertEquals($result, $list);

      foreach($this->testCases['JobCategory'] as $k => $v) {
         $jobCategory = new JobCategory();
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('readJobCategory')
              ->will($this->returnValue($jobCategory));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->readJobCategory($v['id']);
         $this->assertEquals($result, $jobCategory);

         $list = $jobDao->searchJobCategory('eec_code', $v['id']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('searchJobCategory')
              ->will($this->returnValue($list));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->searchJobCategory('eec_code', $v['id']);
         $this->assertEquals($result, $list);
      }
   }

   /**
    * Test saveSaleryGrade
    */
   public function testSaveSaleryGrade() {
      foreach($this->testCases['SalaryGrade'] as $k => $v) {
         $salaryGrade = new SalaryGrade();
         $salaryGrade->setSalGrdName($v['name']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('saveSalaryGrade')
              ->will($this->returnValue($salaryGrade));
         $this->jobService->setJobDao($this->jobDao);
         $result = $this->jobService->saveSalaryGrade($salaryGrade);
         $this->assertEquals($result, $salaryGrade);
      }
   }

   /**
    * Test all read, search, delete functionality for SalaryGrade
    */
   public function testReadDeleteSaleryGrade() {
      $jobDao  = new JobDao();
      $list = $jobDao->getSalaryGradeList();
      $this->jobDao  =	$this->getMock('JobDao');
      $this->jobDao->expects($this->once())
           ->method('getSalaryGradeList')
           ->will($this->returnValue($list));
      $this->jobService->setJobDao($this->jobDao);
      $result  = $this->jobService->getSaleryGradeList();
      $this->assertEquals($result, $list);
      
      foreach($this->testCases['SalaryGrade'] as $k => $v) {
         $salaryGrade   = new SalaryGrade();
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('readSalaryGrade')
              ->will($this->returnValue($salaryGrade));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->readSalaryGrade($v['id']);
         $this->assertEquals($result, $salaryGrade);

         $list = $jobDao->searchSalaryGrade('sal_grd_code', $v['id']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('searchSalaryGrade')
              ->will($this->returnValue($list));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->searchSalaryGrade('sal_grd_code', $v['id']);
         $this->assertEquals($result, $list);

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('deleteSalaryGrade')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->deleteSalaryGrade(array($v['id']));
         $this->assertTrue($result);
      }
   }

   /**
    * Test saveSalleryGradeCurrency
    */
   public function testSaveSalleryGradeCurrency() {
      foreach($this->testCases['SalaryGrade'] as $k => $v) {
         $obj = new SalaryCurrencyDetail();
         $obj->setCurrencyId($v['currencyId']);
         $obj->setMinSalary($v['minSalary']);
         $obj->setSalaryStep($v['salaryStep']);
         $obj->setMaxSalary($v['maxSalary']);
         $obj->setSalGrdCode($v['salaryGradeCode']);

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('saveSalleryGradeCurrency')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->saveSalleryGradeCurrency($obj);
         $this->assertTrue($result);

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('isExistingSalleryGradeCurrency')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->isExistingSalleryGradeCurrency($obj);
         $this->assertTrue($result);
      }
   }

   /**
    * Test all read, search, delete functionality for SalaryCurrencyDetail
    */
   public function testReadDeleteSalaryCurrencyDetail() {
      $jobDao  = new JobDao();
      foreach($this->testCases['SalaryGrade'] as $k => $v) {
         $list = $jobDao->getSalaryGradeCurrency($v['salaryGradeCode']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('getSalaryGradeCurrency')
              ->will($this->returnValue($list));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->getSalleryGradeCurrency($v['salaryGradeCode']);
         $this->assertEquals($list, $result);

         $obj = $jobDao->getSalaryCurrencyDetail($v['salaryGradeCode'], $v['currencyId']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('getSalaryCurrencyDetail')
              ->will($this->returnValue($obj));
         $this->jobService->setJobDao($this->jobDao);
         $result = $this->jobService->getSalaryCurrencyDetail($v['salaryGradeCode'], $v['currencyId']);
         $this->assertEquals($obj, $result);

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('deleteSalaryGradeCurrency')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result = $this->jobService->deleteSalleryGradeCurrency($v['salaryGradeCode'], array($v['currencyId']));
         $this->assertTrue($result);
      }
   }

   /**
    * Test saveEmployeeStatus
    */
   public function testSaveEmployeeStatus() {
      foreach($this->testCases['EmployeeStatus'] as $k => $v) {
         $obj = new EmployeeStatus();
         $obj->setName($v['name']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('saveEmployeeStatus')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result = $this->jobService->saveEmployeeStatus($obj);
         $this->assertTrue($result);
      }
   }

   /**
    * Test all read, search, delete functionality for EmployeeStatus
    */
   public function testReadDeleteEmployeeStatus() {
      $jobDao  = new JobDao();
      $list = $jobDao->getEmployeeStatusList();
      $this->jobDao  =	$this->getMock('JobDao');
      $this->jobDao->expects($this->once())
           ->method('getEmployeeStatusList')
           ->will($this->returnValue($list));
      $this->jobService->setJobDao($this->jobDao);
      $result  = $this->jobService->getEmployeeStatusList();
      $this->assertEquals($result, $list);

      foreach($this->testCases['EmployeeStatus'] as $k => $v) {
         $list = $jobDao->searchEmployeeStatus('name', $v['name']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('searchEmployeeStatus')
              ->will($this->returnValue($list));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->searchEmployeeStatus('name', $v['name']);
         $this->assertEquals($result, $list);

         $obj = $jobDao->readEmployeeStatus($v['id']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('readEmployeeStatus')
              ->will($this->returnValue($obj));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->readEmployeeStatus($v['id']);
         $this->assertEquals($result, $obj);

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('deleteEmployeeStatus')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->deleteEmployeeStatus(array($v['id']));
         $this->assertTrue($result);
      }
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

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('saveJobSpecifications')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result = $this->jobService->saveJobSpecifications($obj);
         $this->assertTrue($result);
      }
   }

   /**
    * Test all read, search, delete functionality for JobSpecifications
    */
   public function testReadDeleteJobSpecifications() {
      $jobDao  = new JobDao();
      $list = $jobDao->getJobSpecificationsList();
      $this->jobDao  =	$this->getMock('JobDao');
      $this->jobDao->expects($this->once())
           ->method('getJobSpecificationsList')
           ->will($this->returnValue($list));
      $this->jobService->setJobDao($this->jobDao);
      $result  = $this->jobService->getJobSpecificationsList();
      $this->assertEquals($list, $result);

      foreach($this->testCases['JobSpecifications'] as $k => $v) {
         $obj = $jobDao->readJobSpecifications($v['id']);
         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('readJobSpecifications')
              ->will($this->returnValue($obj));
         $this->jobService->setJobDao($this->jobDao);
         $result  = $this->jobService->readJobSpecifications($v['id']);
         $this->assertEquals($obj, $result);

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('searchJobSpecifications')
              ->will($this->returnValue($list));
         $this->jobService->setJobDao($this->jobDao);
         $result = $this->jobService->searchJobSpecifications('jobspec_id', $v['id']);
         $this->assertEquals($list, $result);

         $this->jobDao  =	$this->getMock('JobDao');
         $this->jobDao->expects($this->once())
              ->method('deleteJobSpecifications')
              ->will($this->returnValue(true));
         $this->jobService->setJobDao($this->jobDao);
         $result = $this->jobService->deleteJobSpecifications(array($v['id']));
         $this->assertTrue($result);
      }
   }
}
?>