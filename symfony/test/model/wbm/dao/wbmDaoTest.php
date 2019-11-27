<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class wbmDaoTest extends PHPUnit_Framework_TestCase{

        public $wbmDao;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/wbm/wbm.yml');
        $this->wbmDao = new wbmDao();
        // $this->transService=new transferService();
    }

    public function testsaveBenifitType() {

         foreach($this->testCases['BenifitType'] as $key => $user){

            $bt=new BenifitType();

            $bt->setBt_id($user['bt_id']);
            $bt->setBt_name($user['bt_name']);
            $bt->setBt_name_si($user['bt_name_si']);
            $bt->setBt_name_ta($user['bt_name_ta']);

            $result=$this->wbmDao->saveBenifitType($bt);

            $this->assertTrue($result);
        }
     }

  public function testreadBenifitType(){

        $wbmDao = new wbmDao();
        //$bt=new BenifitType();
        $res=$wbmDao->getBenifitType();
        $testCase = $this->testCases['BenifitType'];
//print_r($abc->$list['data']);die;
        $abc=$res['data'];
foreach($abc as $reasons){

        for ($i = 2; $i < count($abc); $i++) {

         $this->assertEquals($testCase[$i+1]['bt_id'], $reasons->getBt_id());
         $this->assertEquals($testCase[$i]['bt_name'], $reasons->getBt_name());
         $this->assertEquals($testCase[$i]['bt_name_si'], $reasons->getBt_name_si());
         $this->assertEquals($testCase[$i]['bt_name_ta'], $reasons->getBt_name_ta());
        }}
    }

      public function testUpdateBenifitType($btid=1,$btname="sana",$btnsi="සනසන",$btnta="ஸநஸஸ"){

        $wbmDao = new wbmDao();
     //   $bt=new BenifitType();

        $abc=$wbmDao->readBenifitType($btid);
        $this->abc= $abc;

            $abc->setBt_id($btid);
            $abc->setBt_name($btname);
            $abc->setBt_name_si($btnsi);
            $abc->setBt_name_ta($btnta);

            $result=$this->wbmDao->saveBenifitType($abc);

            $this->assertTrue($result);
    }


//--------------------------------------Benifit

        public function testsaveBenifit() {

         foreach($this->testCases['BenifitSubType'] as $key => $user){

            $bt=new BenifitSubType();

            $bt->setBst_id($user['bst_id']);
            $bt->setBt_id($user['bt_id']);
            $bt->setBst_name($user['bst_name']);
            $bt->setBst_name_si($user['bst_name_si']);
            $bt->setBst_name_ta($user['bst_name_ta']);

            $result=$this->wbmDao->saveBenifit($bt);

            $this->assertTrue($result);
        }
     }

  public function testreadBenifit(){

        $wbmDao = new wbmDao();
        //$bt=new BenifitType();
        $res=$wbmDao->searchBenifit("","");
        $testCase = $this->testCases['BenifitSubType'];
//print_r($abc->$list['data']);die;
        $abc=$res['data'];
foreach($abc as $reasons){

        for ($i = 2; $i < count($abc); $i++) {

         $this->assertEquals($testCase[$i+1]['bst_id'], $reasons->getBst_id());
         $this->assertEquals($testCase[$i+1]['bt_id'], $reasons->getBt_id());
         $this->assertEquals($testCase[$i]['bst_name'], $reasons->getBst_name());
         $this->assertEquals($testCase[$i]['bst_name_si'], $reasons->getBst_name_si());
         $this->assertEquals($testCase[$i]['bst_name_ta'], $reasons->getBst_name_ta());
        }}
    }

       public function testUpdateBenifit($id=1,$btid=2,$bstname="sana",$bstnsi="සනසන",$bstnta="ஸநஸஸ"){

        $wbmDao = new wbmDao();
        $bt = new BenifitSubType();

        $bt=$wbmDao->readBenifit($id);
        $this->abc= $bt;
//echo($wbmDao->readBenifite($id));die;
          //  $abc->setBst_id($bstid);
            $bt->setBt_id($btid);
            $bt->setBst_name($bstname);
            $bt->setBst_name_si($bstnsi);
            $bt->setBst_name_ta($bstnta);

            $result=$wbmDao->saveBenifit($bt);

            $this->assertTrue($result);
    }

//--------------------------------------Disbusement

 public function testsaveDisbusement() {

         foreach($this->testCases['Benifit'] as $key => $user){

            $bt=new Benifit();

            $bt->setBen_id($user['ben_id']);
            $bt->setEmp_number($user['emp_number']);
            $bt->setBt_id($user['bt_id']);
            $bt->setBst_id($user['bst_id']);
            $bt->setBen_date($user['ben_date']);
            $bt->setBen_comment($user['ben_comment']);

            $result=$this->wbmDao->savedisbust($bt);

            $this->assertTrue($result);
        }
     }

       public function testreadDisbusement(){

        $wbmDao = new wbmDao();
        //$bt=new BenifitType();
        $res=$wbmDao->searchDisb("","");
        $testCase = $this->testCases['Benifit'];
//print_r($abc->$list['data']);die;
        $abc=$res['data'];
foreach($abc as $reasons){

        for ($i = 2; $i < count($abc); $i++) {

         $this->assertEquals($testCase[$i+1]['ben_id'], $reasons->getBen_id());
         $this->assertEquals($testCase[$i+1]['emp_number'], $reasons->getEmp_number());
         $this->assertEquals($testCase[$i+1]['bt_id'], $reasons->getBt_id());
         $this->assertEquals($testCase[$i]['bst_id'], $reasons->getBst_id());
         $this->assertEquals($testCase[$i]['ben_date'], $reasons->getBen_date());
         $this->assertEquals($testCase[$i]['ben_comment'], $reasons->getBen_comment());
        }}
    }

public function testUpdateDisbusement($benid=1,$eid=1,$btid=2,$bstid=1,$desdate="2010-03-01",$bencomment="sdfsdf"){

        $wbmDao = new wbmDao();
        $bt = new BenifitSubType();

        $bt=$wbmDao->readDisbrs($id);
        $this->abc= $bt;

        $result=$wbmDao->updateDisb($benid,$eid,$btid,$bstid,$desdate,$bencomment);
          //  $abc->setBst_id($bstid);


            //$result=$wbmDao->saveBenifit($bt);

            $this->assertTrue($result);
    }

   public function testDeleteDisbusement($id=array(1,2)){

        for ($i = 0; $i < 2; $i++) {
            $wbmDao = new wbmDao();
            $result = $wbmDao->deletedisb($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteBenifit($id=array(1,2)){

         for ($i = 0; $i < 2; $i++) {
            $wbmDao = new wbmDao();
            $result = $wbmDao->deleteBenifit($id[$i]);
            $this->assertTrue($result);
        }
    }

         public function testDeleteBenifitType($id=array(1,2)){

       for ($i = 0; $i < 2; $i++) {
            $wbmDao = new wbmDao();
            $result = $wbmDao->deleteBenifitType($id[$i]);
            $this->assertTrue($result);
        }
    }


}
?>
