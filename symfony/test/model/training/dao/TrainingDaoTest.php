<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TrainingDaoTest extends PHPUnit_Framework_TestCase{

    public $transDao;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/training/training.yml');
        $this->trainDao = new TrainingDao();

    }
     public function testSaveInstitute(){

         foreach($this->testCases['TrainingInstitute'] as $key => $user){

            $trainDao=new TrainingDao();
            $ins=new TrainingInstitute();



            $ins->setTd_inst_id($user['td_inst_id']);
            $ins->setTd_inst_name_en($user['td_inst_name_en']);
            $ins->setTd_inst_name_si($user['td_inst_name_si']);
            $ins->setTd_inst_name_ta($user['td_inst_name_ta']);


            $result=$this->trainDao->saveTransIns($ins);

            $this->assertTrue($result);
        }

     }
    public function testSaveCourse() {

         foreach($this->testCases['TrainingCourse'] as $key => $user){

            $trainingcourse=new TrainingCourse();

                $trainingcourse->setTd_course_id($user['td_course_id']);
                $trainingcourse->setTd_course_code($user['td_course_id']);
                $trainingcourse->setTd_inst_id($user['td_inst_id']);
           	$trainingcourse->setTd_course_year($user['td_course_year']);
                $trainingcourse->setTd_course_code($user['td_course_code']);
                $trainingcourse->setTd_course_name_en($user['td_course_name_en']);
                $trainingcourse->setTd_course_name_si($user['td_course_name_si']);
                $trainingcourse->setTd_course_name_ta($user['td_course_name_ta']);
                $trainingcourse->setLang_code($user['lang_code']);
                $trainingcourse->setTd_course_venue_en($user['td_course_venue_en']);
                $trainingcourse->setTd_course_venue_si($user['td_course_venue_si']);
                $trainingcourse->setTd_course_venue_ta($user['td_course_venue_ta']);
                $trainingcourse->setTd_course_fromdate($user['td_course_fromdate']);
                $trainingcourse->setTd_course_todate($user['td_course_todate']);
                $trainingcourse->setTd_course_fromtime($user['td_course_fromtime']);
                $trainingcourse->setTd_course_totime($user['td_course_totime']);
                $trainingcourse->setTd_course_objective_en($user['td_course_objective_en']);
                $trainingcourse->setTd_course_objective_si($user['td_course_objective_si']);
                $trainingcourse->setTd_course_objective_ta($user['td_course_objective_ta']);
                $trainingcourse->setTd_course_whom_en($user['td_course_whom_en']);
                $trainingcourse->setTd_course_whom_si($user['td_course_whom_si']);
                $trainingcourse->setTd_course_whom_ta($user['td_course_whom_ta']);
                $trainingcourse->setTd_course_content_en($user['td_course_gencom_en']);
                $trainingcourse->setTd_course_content_si($user['td_course_gencom_si']);
                $trainingcourse->setTd_course_content_ta($user['td_course_gencom_ta']);
                $trainingcourse->setTd_course_fees($user['td_course_fees']);


            $result=$this->trainDao->saveCourse($trainingcourse);

            $this->assertTrue($result);
        }
     }

      public function testAssignCourse() {

         foreach($this->testCases['TrainAssign'] as $key => $user){

            $trainassign=new TrainAssign();

                $trainassign->setEmp_number($user['emp_number']);
                $trainassign->setTd_course_id($user['td_course_id']);
                $trainassign->setTd_asl_isattend($user['td_asl_isattend']);
           	$trainassign->setTd_asl_isapproved($user['td_asl_isapproved']);
                $trainassign->setTd_asl_ispending($user['td_asl_ispending']);
                $trainassign->setTd_asl_conductperson($user['td_asl_conductperson']);
                $trainassign->setTd_asl_duration($user['td_asl_duration']);
                $trainassign->setTd_asl_conductdate($user['td_asl_conductdate']);
                $trainassign->setTd_asl_remarks($user['td_asl_remarks']);
                $trainassign->setTd_asl_effectiveness($user['td_asl_effectiveness']);
                $trainassign->setTd_asl_adminremarks($user['td_asl_adminremarks']);
                $trainassign->setTd_asl_content($user['td_asl_content']);
                $trainassign->setTd_asl_isadcommented($user['td_asl_isadcommented']);
                $trainassign->setTd_asl_isempfb($user['td_asl_isempfb']);
                $trainassign->setTd_asl_year($user['td_asl_year']);
                $trainassign->setTd_asl_admincomment($user['td_asl_admincomment']);


            $result=$this->trainDao->saveAssignList($trainassign);

            $this->assertTrue($result);
        }
     }

      public function testFetch(){

          $trainingcourse=new TrainingCourse();
          $trainDao=new TrainingDao();
          $list=$trainDao->getCourseList();

         $testCase = $this->testCases['TrainingCourse'];


        for ($i = 2; $i < count($list); $i--) {

        $this->assertEquals($testCase[$i+1]['td_course_id'], $list[data][$i]->getTd_course_id());

        }
    }



      public function testassignFetch(){

          $trainingcourse=new TrainingCourse();
          $trainDao=new TrainingDao();
          $list=$trainDao->getTrainSummeryList();

         $testCase = $this->testCases['TrainAssign'];


        for ($i = 2; $i < count($list); $i--) {

        $this->assertEquals($testCase[$i+1]['td_course_id'], $list[data][$i]->getTd_course_id());


        }
    }

     public function testassign(){

        $trainDao=new TrainingDao();

	$result=$trainDao->deleteallAssign();
        $this->assertTrue($result);
    }

     public function testDelete(){

        $trainDao=new TrainingDao();
        for($i=1;$i<3;$i++){
	$result=$trainDao->deleteCourse($i);
        }
        $this->assertTrue($result);
    }
    public function testDeleteInstitute(){

        $trainDao=new TrainingDao();
        for($i=1;$i<3;$i++){
	$result=$trainDao->deleteInstitute($i);
        }
        $this->assertTrue($result);
    }


}



?>
