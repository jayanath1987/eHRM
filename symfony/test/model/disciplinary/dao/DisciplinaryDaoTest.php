<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DisciplinaryDaoTest extends PHPUnit_Framework_TestCase{

    public $disDao;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/disciplinary/disciplinary.yml');
        $this->disDao = new DisciplinaryDao();

    }
     public function testSaveactiontype(){

         foreach($this->testCases['DisciplinaryActionType'] as $key => $user){

            $dispDao=new DisciplinaryDao();
            $acttype=new DisciplinaryActionType();



            $acttype->setDis_acttype_id($user['dis_acttype_id']);
            $acttype->setDis_acttype_name($user['dis_acttype_name']);
            $acttype->setDis_acttype_name_si($user['dis_acttype_name_si']);
            $acttype->setDis_acttype_name_ta($user['dis_acttype_name_ta']);


            $result=$this->disDao->saveActiontype($acttype);

            $this->assertTrue($result);
        }

     }
     public function testSaveOffence(){

         foreach($this->testCases['Offence'] as $key => $user){

            $dispDao=new DisciplinaryDao();
            $offence=new Offence();



            $offence->setDis_offence_id($user['dis_offence_id']);
            $offence->setDis_acttype_id($user['dis_acttype_id']);
            $offence->setDis_offence_name($user['dis_offence_name']);
            $offence->setDis_offence_name_si($user['dis_offence_name_si']);
            $offence->setDis_offence_name_ta($user['dis_offence_name_ta']);


            $result=$this->disDao->saveOffence($offence);

            $this->assertTrue($result);
        }

     }
     public function testSaveIncident(){

         foreach($this->testCases['Incidents'] as $key => $user){

            $dispDao=new DisciplinaryDao();
            $inc=new Incidents();



            $inc->setDis_inc_id($user['dis_inc_id']);
            $inc->setemp_number($user['emp_number']);
            $inc->setDis_acttype_id($user['dis_acttype_id']);
            $inc->setDis_inc_level($user['dis_inc_level']);
            $inc->setDis_inc_isclosed($user['dis_inc_isclosed']);
            $inc->setDis_inc_pro_officer($user['dis_inc_pro_officer']);
            $inc->setDis_inc_inq_officer($user['dis_inc_inq_officer']);
            $inc->setDis_inc_defe_officer($user['dis_inc_defe_officer']);
            $inc->setDis_inc_filedate($user['dis_inc_filedate']);


            $result=$this->disDao->saveIncident($inc);

            $this->assertTrue($result);
        }

     }
     public function testSaveIncidentDetails(){

         foreach($this->testCases['IncidentDetails'] as $key => $user){

            $dispDao=new DisciplinaryDao();
            $incd=new IncidentDetails();



            $incd->setDis_inc_id($user['dis_inc_id']);
            $incd->setDis_indetail_level($user['dis_indetail_level']);
            $incd->setDis_indetail_takenby($user['dis_indetail_takenby']);
            $incd->setDis_indetail_takendate($user['dis_indetail_takendate']);
            $incd->setDis_indetail_comment($user['dis_indetail_comment']);
            


            $result=$this->disDao->saveIncidentDetails($incd);

            $this->assertTrue($result);
        }

     }
     public function testSaveOffenceList(){

         foreach($this->testCases['OffenceList'] as $key => $user){

            $dispDao=new DisciplinaryDao();
            $offcnceList=new OffenceList();

            $offcnceList->setDis_inc_id($user['dis_inc_id']);
            $offcnceList->setDis_offence_id($user['dis_offence_id']);
       
            $result=$this->disDao->saveOffenceList($offcnceList);

            $this->assertTrue($result);
        }

     }
     public function testSaveattachment(){

         foreach($this->testCases['DisAttachment'] as $key => $user){

            $dispDao=new DisciplinaryDao();
            $attach=new DisAttachment();

            $attach->setDis_attach_id($user['dis_attach_id']);
            $attach->setDis_attach_name($user['dis_attach_name']);
            $attach->setDis_attach_type($user['dis_attach_type']);
            $attach->setDis_attach_content($user['dis_attach_content']);
            $attach->setDis_inc_id($user['dis_inc_id']);

            $result=$this->disDao->saveDisAttachment($attach);

            $this->assertTrue($result);
        }

     }

      public function testactiontypeFetch(){

          $dispDao=new DisciplinaryDao();
            $acttype=new DisciplinaryActionType();
          $list=$dispDao->searchActionType();

         $testCase = $this->testCases['DisciplinaryActionType'];


        for ($i = 0; $i < count($list); $i++) {

        $this->assertEquals($testCase[$i+1]['dis_acttype_id'], $list[data][$i]->getDis_acttype_id());


        }
    }
     public function testOffenceFetch(){

          $dispDao=new DisciplinaryDao();
            $offence=new Offence();
          $list=$dispDao->searchOffence();

         $testCase = $this->testCases['Offence'];


        for ($i = 2; $i < count($list); $i--) {

        $this->assertEquals($testCase[$i+1]['dis_offence_id'], $list[data][$i]->getDis_offence_id());


        }
    }
    public function testIncidentFetch(){

          $dispDao=new DisciplinaryDao();
            $offence=new Incidents();
          $list=$dispDao->searchLevel0();

         $testCase = $this->testCases['Incidents'];


        for ($i = 2; $i < count($list); $i--) {

        $this->assertEquals($testCase[$i+1]['dis_inc_id'], $list[data][$i]->getDis_inc_id());


        }
    }
     public function testIncidentDetaiilsFetch(){

          $dispDao=new DisciplinaryDao();
            $offence=new Incidents();
          $list=$dispDao->searchLevel0();

         $testCase = $this->testCases['IncidentDetails'];


        for ($i = 2; $i < count($list); $i--) {

        $this->assertEquals($testCase[$i+1]['dis_inc_id'], $list[data][$i]->getDis_inc_id());


        }
    }
     public function testAtachmentFetch(){

          $dispDao=new DisciplinaryDao();
           // $offence=new Incidents();

         

         $testCase = $this->testCases['DisAttachment'];


        for ($i = 0; $i < count($list); $i++) {
        $list=$dispDao->getAttachment($i);
        $this->assertEquals($testCase[$i+1]['dis_attach_id'], $list[data][$i]->getDis_attach_id());


        }
    }
    



     public function testDeleteAttachment($id=array(1,2)){

        for($i=0;$i<2;$i++){
       $dispDao=new DisciplinaryDao();
	$result=$dispDao->deleteAttachment($id[$i]);
        $this->assertTrue($result);
        }

    }


    public function testDeleteOffenceList($id=array(1,2)){

        for($i=0;$i<2;$i++){
       $dispDao=new DisciplinaryDao();
	$result=$dispDao->deleteOffenceList($id[$i]);
        $this->assertTrue($result);
        }

    }

public function testDeleteIncidentDeteils($id=array(1,2)){

        for($i=0;$i<2;$i++){
       $dispDao=new DisciplinaryDao();
	$result=$dispDao->deleteIncidentdetails($id[$i]);
        $this->assertTrue($result);
        }

    }

public function testDeleteIncident($id=array(1,2)){

        for($i=0;$i<2;$i++){
       $dispDao=new DisciplinaryDao();
	$result=$dispDao->deleteIncidents($id[$i]);
        $this->assertTrue($result);
        }

    }

public function testDeleteOffence($id=array(1,2)){

       $dispDao=new DisciplinaryDao();
       for($i=0;$i<2;$i++){
	$result=$dispDao->deleteOffence($id[$i]);
       }
        $this->assertTrue($result);
    }
     
     public function testDeleteactiontype($id=array(1,2)){

       $dispDao=new DisciplinaryDao();
       for($i=0;$i<2;$i++){
	$result=$dispDao->deleteActiontype($id[$i]);
       }
        $this->assertTrue($result);
    }
    
}
?>