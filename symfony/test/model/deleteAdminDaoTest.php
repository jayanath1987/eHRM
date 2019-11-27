<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class deleteAdminDaoTest extends PHPUnit_Framework_TestCase {

    

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/admin.yml');
    }


    public function testDeleteWorkExperience($id=array(1,2),$SerRec=array(1,2)){
       $empService=new EmployeeService();
        for ($i = 0; $i < 2; $i++) {

            $result=$empService->deleteWorkExperience($id[$i],$SerRec);

            $this->assertTrue($result);
        }

    }

    public function testDeleteDerpendent($id=array(1,2),$SerRec=array(1,2)){
       $empService=new EmployeeService();
        for ($i = 0; $i < 2; $i++) {
             
            $result= $empService->deleteDependentContacts($id[$i],$SerRec[$i]);

            $this->assertTrue($result);
        }

    }

     public function testDeleteEmegencyContact($id=array(1,2),$SerRec=array(1,2)){
       $empService=new EmployeeService();
        for ($i = 0; $i < 2; $i++) {
             $result=$empService->deleteEmergencyContacts($id[$i],$SerRec[$i]);
          

            $this->assertTrue($result);
        }

    }

         public function testDeleteEducationEMp($id=array(1,2),$SerRec=array(1,2)){
           $EmployeeDao=new EmployeeDao();
        for ($i = 0; $i < 2; $i++) {

            $result = $EmployeeDao->deleteEducation($id[$i], $SerRec[$i]);
             
            $this->assertTrue($result);
        }

    }
        public function testDeleteServiceRecord($id=array(1,2),$SerRec=array(1,2)){
          $empService=new EmployeeService();
        for ($i = 0; $i < 2; $i++) {
            
            $result = $empService->deleteServiceRecord($id[$i], $SerRec[$i]);
            $this->assertTrue($result);
        }

    }

        public function testDeleteEmpContacts($id=array(1, 2)){
           $EmployeeDao=new EmployeeDao();
        for ($i = 0; $i < 2; $i++) {
            $LanguageDao = new LanguageDao();
            $result = $EmployeeDao->deleteEmployeeContacts($id[$i]);
            $this->assertTrue($result);
        }

    }
     public function testDeleteEBExam($empNum=array(1,2),$id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
           $empService=new EmployeeService();
            $result = $empService->deleteEBExam($empNum[$i], $id[$i]);
            $this->assertTrue($result);
        }
    }

     
        public function testDeleteEducation($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $EducationDao = new EducationDao();
            $result = $EducationDao->deleteEducation($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteLanguage($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $LanguageDao = new LanguageDao();
            $result = $LanguageDao->deleteLanguage($id[$i]);
            $this->assertTrue($result);
        }
    }
public function testDeleteEmployee($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
           $EmployeeDao=new EmployeeDao();
            $result = $EmployeeDao->deleteEmployee($id[$i]);
            $this->assertTrue($result);
        }
    }
    public function testDeleteSkill($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $skillDao = new SkillDao();
            $result = $skillDao->deleteSkill($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteClass($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $classDao = new classDao();
            $result = $classDao->deleteClass($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteGrade($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $GradeDao = new GradeDao();
            $result = $GradeDao->deleteGrade($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteServiceDetail($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $jobDao = new JobDao();
            $result = $jobDao->deleteJobService($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteJobtitle($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $jobDao = new JobDao();
            $result = $jobDao->deleteJobTitle1($id[$i]);
            $this->assertTrue($result);
        }
    }
    public function testDeletecompanystruture($id=array(2, 3)) {

        for ($i = 0; $i < 2; $i++) {
            $companyDao=new CompanyDao();
            $result = $companyDao->deleteCompanyStructure($id[$i]);
            $this->assertTrue($result);
        }
    }
       
}
?>
