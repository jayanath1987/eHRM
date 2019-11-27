<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class adminDaoTest extends PHPUnit_Framework_TestCase {

    public $wbmDao;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/admin/admin.yml');
    }

//-----JOB




    public function testSaveCompany() {
        $company = new Company();


        $companyService = new CompanyService();
        foreach ($this->testCases['CompanyStructure'] as $key => $user) {

            $company->setComCode($user['comCode']);
            $company->setCompanyName($user['companyName']);
            $company->setCountry($user['comCode']);



            $companyStructure = $companyService->readCompanyStructure($user['comCode']);

            $companyStructure->setTitle($user['companyName']);
            $companyStructure->setTitleSI($user['companyName_si']);
            $companyStructure->setTitleTA($user['companyName_ta']);

            $companyStructure->setAddress($user['address']);
            $companyStructure->setAddressSI($user['address_si']);
            $companyStructure->setAddressTA($user['address_ta']);
            $companyStructure->setPhoneIntercom($user['phnIntercom']);
            $companyStructure->setPhoneVIP($user['phnVIP']);
            $companyStructure->setPhoneDirectLine($user['phnDirect']);
            $companyStructure->setPhoneExtension($user['phnExtensipm']);
            $companyStructure->setFax($user['fax']);
            $companyStructure->setEmail($user['email']);
            $companyStructure->setURL($user['url']);

            $result = $companyService->saveCompany($company, $companyStructure);
            $this->assertTrue($result);
        }
    }

    public function testSaveCompanyStructureTest() {


        $companyService = new CompanyService();
       
            
       

        foreach ($this->testCases['SaveCompanyStructure'] as $key => $user) {

 $companyStructure = new CompanyStructure();
            $companyStructure->setId($user['id']);
            $companyStructure->setParnt($user['parent']);
            $companyStructure->setTitle($user['compannyName']);
            $companyStructure->setTitleSI($user['companyName_si']);
            $companyStructure->setTitleTA($user['companyName_ta']);
            $companyStructure->setAddress($user['address']);
            $companyStructure->setAddressSI($user['address_si']);
            $companyStructure->setAddressTA($user['address_ta']);
            $companyStructure->setPhoneIntercom($user['phnIntercom']);
            $companyStructure->setPhoneVIP($user['phnVIP']);
            $companyStructure->setPhoneDirectLine($user['phnDirect']);
            $companyStructure->setPhoneExtension($user['phnExtensipm']);
            $companyStructure->setFax($user['fax']);
            $companyStructure->setEmail($user['email']);
            $companyStructure->setURL($user['url']);


            $result = $companyService->saveCompanyStructure($companyStructure);

            $this->assertTrue($result);
            
        }
    }
     public function testreadCompanyStructure() {

        

       
        $testCase = $this->testCases['SaveCompanyStructure'];        

        $service = new CompanyService();
        $res = $service->getCompanyDetailsById(2);
        
        $abc = $res;
        
        
        foreach ($abc as $reasons) {
            //print_r($abc[0]['parnt']);die;
            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['id'], $abc[$i]['id']);
                $this->assertEquals($testCase[$j + 1]['parent'], $abc[$i]['parnt']);
                $this->assertEquals($testCase[$j + 1]['compannyName'], $abc[$i]['title']);
                $this->assertEquals($testCase[$j + 1]['address'], $abc[$i]['address']);
            }
        }
    }

    public function testSaveJobtitle() {
        $jobDao = new JobDao();
        foreach ($this->testCases['JobTitle'] as $key => $user) {

            $bt = new JobTitle();

            $bt->setJobtit_code($user['jobtit_code']);
            $bt->setJobtit_name($user['jobtit_name']);
            $bt->setJobtit_name_si($user['jobtit_name_si']);
            $bt->setJobtit_name_ta($user['jobtit_name_ta']);

            $result = $jobDao->saveJobTitle1($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadJobtitle() {

        $jobDao = new JobDao();

        $res = $jobDao->getJobTitleList('job.id', "ASC");
        $testCase = $this->testCases['JobTitle'];

        $abc = $res;
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['jobtit_code'], $abc[$i]->getJobtit_code());
                $this->assertEquals($testCase[$j + 1]['jobtit_name'], $abc[$i]->getJobtit_name());
                $this->assertEquals($testCase[$j + 1]['jobtit_name_si'], $abc[$i]->getJobtit_name_si());
                $this->assertEquals($testCase[$j + 1]['jobtit_name_ta'], $abc[$i]->getJobtit_name_ta());
            }
        }
    }

    public function testUpdateJobtitle($btid=1, $btname="CD", $btnsi="නසනසසනසසන", $btnta="ஸஸஸநஸஸ") {

        $jobDao = new JobDao();
        $abc = $jobDao->readJobTitle($btid);
        $this->abc = $abc;


        $abc->setJobtit_name($btname);
        $abc->setJobtit_name_si($btnsi);
        $abc->setJobtit_name_ta($btnta);

        $result = $jobDao->saveJobTitle1($abc);

        $this->assertTrue($result);
    }

//-----ServiceDetail
    public function testSaveServiceDetail() {
        $jobDao = new JobDao();
        foreach ($this->testCases['ServiceDetails'] as $key => $user) {

            $bt = new ServiceDetails();

            $bt->setService_code($user['service_code']);
            $bt->setService_name($user['service_name']);
            $bt->setService_name_si($user['service_name_si']);
            $bt->setService_name_ta($user['service_name_ta']);

            $result = $jobDao->saveJobservice($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadServiceDetail() {

        $jobDao = new JobDao();

        $res = $jobDao->getJobService(null, null, "en", 'job.service_code', "ASC", 1);
        $testCase = $this->testCases['ServiceDetails'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['service_code'], $abc[$i]->getService_code());
                $this->assertEquals($testCase[$j + 1]['service_name'], $abc[$i]->getService_name());
                $this->assertEquals($testCase[$j + 1]['service_name_si'], $abc[$i]->getService_name_si());
                $this->assertEquals($testCase[$j + 1]['service_name_ta'], $abc[$i]->getService_name_ta());
            }
        }
    }

    public function testUpdateServiceDetail($btid=1, $btname="CD", $btnsi="නසනසසනසසන", $btnta="ஸஸஸநஸஸ") {

        $jobDao = new JobDao();
        $abc = $jobDao->readJobService($btid);
        $this->abc = $abc;


        $abc->setService_name($btname);
        $abc->setService_name_si($btnsi);
        $abc->setService_name_ta($btnta);

        $result = $jobDao->saveJobservice($abc);

        $this->assertTrue($result);
    }

//-----Grade
    public function testSaveGrade() {
        $GradeDao = new GradeDao();
        foreach ($this->testCases['Grade'] as $key => $user) {

            $bt = new Grade();

            $bt->setGrade_code($user['grade_code']);
            $bt->setGrade_name($user['grade_name']);
            $bt->setGrade_name_si($user['grade_name_si']);
            $bt->setGrade_name_ta($user['grade_name_ta']);

            $result = $GradeDao->saveGrade($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadGrade() {

        $GradeDao = new GradeDao();

        $res = $GradeDao->SerachGrades(null, null, "en", 1, 'grade_code', "ASC");
        $testCase = $this->testCases['Grade'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['grade_code'], $abc[$i]->getGrade_code());
                $this->assertEquals($testCase[$j + 1]['grade_name'], $abc[$i]->getGrade_name());
                $this->assertEquals($testCase[$j + 1]['grade_name_si'], $abc[$i]->getGrade_name_si());
                $this->assertEquals($testCase[$j + 1]['grade_name_ta'], $abc[$i]->getGrade_name_ta());
            }
        }
    }

    public function testUpdateGrade($btid=1, $btname="CD", $btnsi="නසනසසනසසන", $btnta="ஸஸஸநஸஸ") {

        $GradeDao = new GradeDao();
        $abc = $GradeDao->getGradeById($btid);
        $this->abc = $abc;


        $abc->setGrade_name($btname);
        $abc->setGrade_name_si($btnsi);
        $abc->setGrade_name_ta($btnta);

        $result = $GradeDao->saveGrade($abc);

        $this->assertTrue($result);
    }

//-----Class
    public function testSaveClass() {
        $classDao = new classDao();
        foreach ($this->testCases['EmpClass'] as $key => $user) {

            $bt = new EmpClass();

            $bt->setClass_code($user['class_code']);
            $bt->setClass_name($user['class_name']);
            $bt->setClass_name_si($user['class_name_si']);
            $bt->setClass_name_ta($user['class_name_ta']);

            $result = $classDao->saveClass($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadClass() {

        $classDao = new classDao();

        $res = $classDao->SerachClass(null, null, "en", 1, 'class_code', "ASC");
        $testCase = $this->testCases['EmpClass'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['class_code'], $abc[$i]->getClass_code());
                $this->assertEquals($testCase[$j + 1]['class_name'], $abc[$i]->getClass_name());
                $this->assertEquals($testCase[$j + 1]['class_name_si'], $abc[$i]->getClass_name_si());
                $this->assertEquals($testCase[$j + 1]['class_name_ta'], $abc[$i]->getClass_name_ta());
            }
        }
    }

    public function testUpdateClass($btid=1, $btname="CD", $btnsi="නසනසසනසසන", $btnta="ஸஸஸநஸஸ") {

        $classDao = new classDao();
        $abc = $classDao->getClassById($btid);
        $this->abc = $abc;


        $abc->setClass_name($btname);
        $abc->setClass_name_si($btnsi);
        $abc->setClass_name_ta($btnta);

        $result = $classDao->saveClass($abc);

        $this->assertTrue($result);
    }

//-----Skill
    public function testSaveSkill() {
        $skillDao = new SkillDao();
        foreach ($this->testCases['Skill'] as $key => $user) {

            $bt = new Skill();

            $bt->setSkill_code($user['skill_code']);
            // $bt->setSkill_code(null);
            $bt->setSkill_name($user['skill_name']);
            $bt->setSkill_name_si($user['skill_name_si']);
            $bt->setSkill_name_ta($user['skill_name_ta']);

            $result = $skillDao->saveSkill($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadSkill() {

        $skillDao = new SkillDao();

        $res = $skillDao->searchSkill(null, null, "en", 1, 'skill_code', "ASC");
        $testCase = $this->testCases['Skill'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['skill_code'], $abc[$i]->getSkill_code());
                $this->assertEquals($testCase[$j + 1]['skill_name'], $abc[$i]->getSkill_name());
                $this->assertEquals($testCase[$j + 1]['skill_name_si'], $abc[$i]->getSkill_name_si());
                $this->assertEquals($testCase[$j + 1]['skill_name_ta'], $abc[$i]->getSkill_name_ta());
            }
        }
    }

    public function testUpdateSkill($btid=1, $btname="CD", $btnsi="නසනසසසසන", $btnta="ஸஸநஸஸ") {

        $skillDao = new SkillDao();
        $abc = $skillDao->readSkill($btid);
        $this->abc = $abc;


        $abc->setSkill_name($btname);
        $abc->setSkill_name_si($btnsi);
        $abc->setSkill_name_ta($btnta);

        $result = $skillDao->saveSkill($abc);

        $this->assertTrue($result);
    }

//-----Language
//    public function testSaveLanguage() {
//        $LanguageDao = new LanguageDao();
//        foreach ($this->testCases['Language'] as $key => $user) {
//
//            $bt = new Language();
//
//            $bt->setLang_code($user['lang_code']);
//            // $bt->setSkill_code(null);
//            $bt->setLang_name($user['lang_name']);
//            $bt->setLang_name_si($user['lang_name_si']);
//            $bt->setLang_name_ta($user['lang_name_ta']);
//
//            $result = $LanguageDao->saveLanguage($bt);
//
//            $this->assertTrue($result);
//        }
//    }

    public function testreadLanguage() {

        $LanguageDao = new LanguageDao();

        $res = $LanguageDao->searchLanguage(null, null, "en", 1, 'lang_code', "ASC");
        $testCase = $this->testCases['Language'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['lang_code'], $abc[$i]->getLang_code());
                $this->assertEquals($testCase[$j + 1]['lang_name'], $abc[$i]->getLang_name());
                $this->assertEquals($testCase[$j + 1]['lang_name_si'], $abc[$i]->getLang_name_si());
                $this->assertEquals($testCase[$j + 1]['lang_name_ta'], $abc[$i]->getLang_name_ta());
            }
        }
    }

 

//-----Education
    public function testSaveEducation() {
        $EducationDao = new EducationDao();
        foreach ($this->testCases['Education'] as $key => $user) {

            $bt = new Education();

            $bt->setEdu_code($user['edu_code']);
            // $bt->setSkill_code(null);
            $bt->setEdu_name($user['edu_name']);
            $bt->setEdu_name_si($user['edu_name_si']);
            $bt->setEdu_name_ta($user['edu_name_ta']);

            $result = $EducationDao->saveEducation($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadEducation() {

        $EducationDao = new EducationDao();

        $res = $EducationDao->searchEducation(null, null, "en", 1, 'edu_code', "ASC");
        $testCase = $this->testCases['Education'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['edu_code'], $abc[$i]->getEdu_code());
                $this->assertEquals($testCase[$j + 1]['edu_name'], $abc[$i]->getEdu_name());
                $this->assertEquals($testCase[$j + 1]['edu_name_si'], $abc[$i]->getEdu_name_si());
                $this->assertEquals($testCase[$j + 1]['edu_name_ta'], $abc[$i]->getEdu_name_ta());
            }
        }
    }

    public function testUpdateEducation($btid=1, $btname="CD", $btnsi="නසනසසසසන", $btnta="ஸஸநஸஸ") {

        $EducationDao = new EducationDao();
        $abc = $EducationDao->readEducation($btid);
        $this->abc = $abc;


        $abc->setEdu_name($btname);
        $abc->setEdu_name_si($btnsi);
        $abc->setEdu_name_ta($btnta);

        $result = $EducationDao->saveEducation($abc);

        $this->assertTrue($result);
    }




}

?>
