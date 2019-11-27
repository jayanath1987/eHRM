<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PerformanceDaoTest extends PHPUnit_Framework_TestCase {

    private $performanceDao;
    private $testCases;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/performance/Performance.yml');
        $this->performanceDao = new performanceDao();
    }

    //test Save PerformanceDutyGroup
    public function testSavePerformanceDutyGroup() {

        foreach ($this->testCases['PerformanceDutyGroup'] as $key => $PerformanceDutyGroup) {

            $pdg = new PerformanceDutyGroup();

            $pdg->setDtg_id($PerformanceDutyGroup['dtg_id']);
            $pdg->setDtg_code($PerformanceDutyGroup['dtg_code']);
            $pdg->setDtg_name($PerformanceDutyGroup['dtg_name']);
            $pdg->setDtg_name_si($PerformanceDutyGroup['dtg_name_si']);
            $pdg->setDtg_name_ta($PerformanceDutyGroup['dtg_name_ta']);
            $pdg->setDtg_desc($PerformanceDutyGroup['dtg_desc']);
            $pdg->setDtg_desc_si($PerformanceDutyGroup['dtg_desc_si']);
            $pdg->setDtg_desc_ta($PerformanceDutyGroup['dtg_desc_ta']);

            $result = $this->performanceDao->saveDutyGroup($pdg);

            $this->assertTrue($result);
        }
    }

    //test getDutyGroup
    public function testGetPerformanceDutyGroup() {

        $performanceDao = new performanceDao();
        $dutyGroupList = $performanceDao->readDutyGroupList();
        $testCase = $this->testCases['PerformanceDutyGroup'];

        for ($i = 0; $i < count($dutyGroupList); $i++) {
            $j = $i;
            $this->assertEquals($testCase[$j + 1]['dtg_id'], $dutyGroupList[$i]->getDtg_id());
            $this->assertEquals($testCase[$j + 1]['dtg_code'], $dutyGroupList[$i]->getDtg_code());
            $this->assertEquals($testCase[$j + 1]['dtg_name'], $dutyGroupList[$i]->getDtg_name());
            $this->assertEquals($testCase[$j + 1]['dtg_name_si'], $dutyGroupList[$i]->getDtg_name_si());
            $this->assertEquals($testCase[$j + 1]['dtg_name_ta'], $dutyGroupList[$i]->getDtg_name_ta());
            $this->assertEquals($testCase[$j + 1]['dtg_desc'], $dutyGroupList[$i]->getDtg_desc());
            $this->assertEquals($testCase[$j + 1]['dtg_desc_si'], $dutyGroupList[$i]->getDtg_desc_si());
            $this->assertEquals($testCase[$j + 1]['dtg_desc_ta'], $dutyGroupList[$i]->getDtg_desc_ta());
        }
    }

    //test Save PerformanceDuty
    public function testSavePerformanceRate() {

        foreach ($this->testCases['PerformanceRate'] as $key => $PerformanceRate) {

            $pr = new PerformanceRate();

            $pr->setRate_id($PerformanceRate['rate_id']);
            $pr->setRate_code($PerformanceRate['rate_code']);
            $pr->setRate_name($PerformanceRate['rate_name']);
            $pr->setRate_name_si($PerformanceRate['rate_name_si']);
            $pr->setRate_name_ta($PerformanceRate['rate_name_ta']);
            $pr->setRate_desc($PerformanceRate['rate_desc']);
            $pr->setRate_desc_si($PerformanceRate['rate_desc_si']);
            $pr->setRate_desc_ta($PerformanceRate['rate_desc_ta']);
            $pr->setRate_option($PerformanceRate['rate_option']);

            $result = $this->performanceDao->saveRate($pr);

            $this->assertTrue($result);
        }
    }

    //test getRates
    public function testGetPerformanceRate() {

        $performanceDao = new performanceDao();
        $dutyRateList = $performanceDao->readRateList();
        $testCase = $this->testCases['PerformanceRate'];

//        foreach ($dutyRateList as $dutyRate) {
        for ($i = 0; $i < count($dutyRateList); $i++) {
            $j = $i;
            $this->assertEquals($testCase[$j + 1]['rate_id'], $dutyRateList[$i]->getRate_id());
            $this->assertEquals($testCase[$j + 1]['rate_code'], $dutyRateList[$i]->getRate_code());
            $this->assertEquals($testCase[$j + 1]['rate_name'], $dutyRateList[$i]->getRate_name());
            $this->assertEquals($testCase[$j + 1]['rate_name_si'], $dutyRateList[$i]->getRate_name_si());
            $this->assertEquals($testCase[$j + 1]['rate_name_ta'], $dutyRateList[$i]->getRate_name_ta());
            $this->assertEquals($testCase[$j + 1]['rate_desc'], $dutyRateList[$i]->getRate_desc());
            $this->assertEquals($testCase[$j + 1]['rate_desc_si'], $dutyRateList[$i]->getRate_desc_si());
            $this->assertEquals($testCase[$j + 1]['rate_desc_ta'], $dutyRateList[$i]->getRate_desc_ta());
            $this->assertEquals($testCase[$j + 1]['rate_option'], $dutyRateList[$i]->getRate_option());
        }
//        }
    }

    //test Save PerformanceDuty
    public function testSavePerformanceDuty() {

        foreach ($this->testCases['PerformanceDuty'] as $key => $PerformanceDuty) {

            $pd = new PerformanceDuty();

            $pd->setDut_id($PerformanceDuty['dut_id']);
            $pd->setDut_code($PerformanceDuty['dut_code']);
            $pd->setDut_name($PerformanceDuty['dut_name']);
            $pd->setDut_name_si($PerformanceDuty['dut_name_si']);
            $pd->setDut_name_ta($PerformanceDuty['dut_name_ta']);
            $pd->setDut_desc($PerformanceDuty['dut_desc']);
            $pd->setDut_desc_si($PerformanceDuty['dut_desc_si']);
            $pd->setDut_desc_ta($PerformanceDuty['dut_desc_ta']);
            $pd->setDtg_id($PerformanceDuty['dtg_id']);
            $pd->setRate_id($PerformanceDuty['rate_id']);

            $result = $this->performanceDao->saveDuty($pd);

            $this->assertTrue($result);
        }
    }

    //test getDuty
//    public function testGetPerformanceDuty() {
//
//        $performanceDao = new performanceDao();
//        $dutyList = $performanceDao->getDutyList();
//        $testCase = $this->testCases['PerformanceDuty'];
//
//        for ($i = 0; $i < count($dutyList); $i++) {
//            $j = $i;
//            $this->assertEquals($testCase[$j + 1]['dut_id'], $dutyList[$i]->getDut_id());
//            $this->assertEquals($testCase[$j + 1]['dut_code'], $dutyList[$i]->getDut_code());
//            $this->assertEquals($testCase[$j + 1]['dut_name'], $dutyList[$i]->getDut_name());
//            $this->assertEquals($testCase[$j + 1]['dut_name_si'], $dutyList[$i]->getDut_name_si());
//            $this->assertEquals($testCase[$j + 1]['dut_name_ta'], $dutyList[$i]->getDut_name_ta());
//            $this->assertEquals($testCase[$j + 1]['dut_desc'], $dutyList[$i]->getDut_desc());
//            $this->assertEquals($testCase[$j + 1]['dut_desc_si'], $dutyList[$i]->getDut_desc_si());
//            $this->assertEquals($testCase[$j + 1]['dut_desc_ta'], $dutyList[$i]->getDut_desc_ta());
//            $this->assertEquals($testCase[$j + 1]['dtg_id'], $dutyList[$i]->getDtg_id());
//            $this->assertEquals($testCase[$j + 1]['rate_id'], $dutyList[$i]->getRate_id());
//        }
//    }

    //test SaveEvaluationComInfo
    public function testSaveEvaluationComInfo() {

        foreach ($this->testCases['PerformanceEvaluation'] as $key => $EvaluationInfo) {

            $pe = new PerformanceEvaluation();

            $pe->setEval_id($EvaluationInfo['eval_id']);
            $pe->setEval_code($EvaluationInfo['eval_code']);
            $pe->setEval_name($EvaluationInfo['eval_name']);
            $pe->setEval_name_si($EvaluationInfo['eval_name_si']);
            $pe->setEval_name_ta($EvaluationInfo['eval_name_ta']);
            $pe->setEval_desc($EvaluationInfo['eval_desc']);
            $pe->setEval_desc_si($EvaluationInfo['eval_desc_si']);
            $pe->setEval_desc_ta($EvaluationInfo['eval_desc_ta']);
            $pe->setEval_id($EvaluationInfo['eval_id']);
            $pe->setEval_year($EvaluationInfo['eval_year']);
            $pe->setEval_active($EvaluationInfo['eval_active']);
            $pe->setRate_id($EvaluationInfo['rate_id']);

            $result = $this->performanceDao->saveEvaluationCompanyInfo($pe);

            $this->assertTrue($result);
        }
    }

    //test SaveEvaluationDetail
    public function testSaveEvaluationDetail() {

        foreach ($this->testCases['PerformanceEvaluationDetail'] as $key => $EvaluationDetail) {

            $ed = new PerformanceEvaluationDetail();

            $ed->setEval_dtl_id($EvaluationDetail['eval_dtl_id']);
            $ed->setEval_id($EvaluationDetail['eval_id']);
            $ed->setJobtit_code($EvaluationDetail['jobtit_code']);
            $ed->setLevel_code($EvaluationDetail['level_code']);
            $ed->setEval_dtl_project_percentage($EvaluationDetail['eval_dtl_project_percentage']);
            $ed->setEval_dtl_duty_percentage($EvaluationDetail['eval_dtl_duty_percentage']);
            $ed->setService_code($EvaluationDetail['service_code']);

            $result = $this->performanceDao->saveEvaluation($ed);

            $this->assertTrue($result);
        }
    }

    //test getEvaluationDetail
    public function testGetEvaluationDetail() {

        $performanceDao = new performanceDao();
        $readEvaluation = $performanceDao->getEvaluationList();
        $testCase = $this->testCases['PerformanceEvaluationDetail'];

        foreach ($readEvaluation as $Evaluation) {
            for ($i = 0; $i < count($readEvaluation); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['eval_dtl_id'], $Evaluation[$i]->getEval_dtl_id());
                $this->assertEquals($testCase[$j + 1]['eval_id'], $Evaluation[$i]->getEval_id());
                $this->assertEquals($testCase[$j + 1]['jobtit_code'], $Evaluation[$i]->getJobtit_code());
                $this->assertEquals($testCase[$j + 1]['level_code'], $Evaluation[$i]->getLevel_code());
                $this->assertEquals($testCase[$j + 1]['eval_dtl_project_percentage'], $Evaluation[$i]->getEval_dtl_project_percentage());
                $this->assertEquals($testCase[$j + 1]['eval_dtl_duty_percentage'], $Evaluation[$i]->getEval_dtl_duty_percentage());
                $this->assertEquals($testCase[$j + 1]['service_code'], $Evaluation[$i]->getService_code());
            }
        }
    }

    //test UpdateEvaluationComInfo
    public function testUpdateEvaluationComInfo($evalid= 3, $eval_code= 021, $eval_name= 'update_evaluation3', $eval_name_si= 'උපදඅතඑඇඑරඇඑර', $eval_name_ta='ඇඇඑරඇඑරඑරඇඑර', $eval_desc= 'update_evaluation Description', $eval_desc_si='ඇඑරඇඑරඇඑරඇඑරඇඑරඇඑරඇඑරඇඑර', $eval_desc_ta='ඇඑරඇඑඇඑරඇඑරඇඑරඇඑරරඇඑරඇඑර', $eval_year= 2012, $eval_active=0, $rate_id= '2') {

        $performanceDao = new performanceDao();
        $updateEvalComInfo = $performanceDao->readEvaluationCompanyInfo($evalid);
        $this->updateEvalComInfo = $updateEvalComInfo;

        $updateEvalComInfo->setEval_code($eval_code);
        $updateEvalComInfo->setEval_name($eval_name);
        $updateEvalComInfo->setEval_name_si($eval_name_si);
        $updateEvalComInfo->setEval_name_ta($eval_name_ta);
        $updateEvalComInfo->setEval_desc($eval_desc);
        $updateEvalComInfo->setEval_desc_si($eval_desc_si);
        $updateEvalComInfo->setEval_desc_ta($eval_desc_ta);
        $updateEvalComInfo->setEval_year($eval_year);
        $updateEvalComInfo->setEval_active($eval_active);
        $updateEvalComInfo->setRate_id($rate_id);

        $result = $this->performanceDao->saveEvaluationCompanyInfo($updateEvalComInfo);

        $this->assertTrue($result);
    }

    //test UpdateEvaluationDetail
    public function testUpdateEvaluationDetail($evDetid= 3, $eval_id= 002, $jobtit_code= 'JOB003', $level_code= '2', $eval_dtl_project_percentage= '20', $eval_dtl_duty_percentage= '80', $service_code='1') {

        $performanceDao = new performanceDao();
        $updateEvaluation = $performanceDao->readEvaluation($evDetid);
        $this->updateEvaluation = $updateEvaluation;

        $updateEvaluation->setEval_id($eval_id);
        $updateEvaluation->setJobtit_code($jobtit_code);
        $updateEvaluation->setEval_dtl_project_percentage($eval_dtl_project_percentage);
        $updateEvaluation->setEval_dtl_duty_percentage($eval_dtl_duty_percentage);

        $result = $this->performanceDao->saveEvaluation($updateEvaluation);

        $this->assertTrue($result);
    }

    //test save PerformanceEvaluationDuty
    public function testSavePerformanceEvaluationDuty() {

        foreach ($this->testCases['PerformanceEvaluationDuty'] as $key => $PerformanceEvaluationDuty) {

            $ped = new PerformanceEvaluationDuty();

            $ped->setEval_dtl_id($PerformanceEvaluationDuty['eval_dtl_id']);
            $ped->setDut_id($PerformanceEvaluationDuty['dut_id']);
            $ped->setDut_weightage($PerformanceEvaluationDuty['dut_weightage']);

            $result = $this->performanceDao->savePerformanceEvaluationDuty($ped);
            $this->assertTrue($result);
        }
    }

    //test getEvaluationAssignDuty
    public function testGetPerformanceEvaluationDuty() {

        $performanceDao = new performanceDao();

        $dutyGroupList = $performanceDao->getEvaluationAssignDutyList(1);
        $testCase = $this->testCases['PerformanceEvaluationDuty'];

        for ($i = 0; $i < count($dutyGroupList); $i++) {
            $j = $i;
            $this->assertEquals($testCase[$j + 1]['dut_id'], $dutyGroupList[$i]->getDut_id());
            $this->assertEquals($testCase[$j + 1]['dut_weightage'], $dutyGroupList[$i]->getDut_weightage());
        }
    }

    //test save PerformanceEvaluationEmployee
    public function testSavePerformanceEvaluationEmployee() {
        $performanceDao = new performanceDao();
        foreach ($this->testCases['PerformanceEvaluationEmployee'] as $key => $PerformanceEvaluationEmployee) {

            $EvalEmployee = new PerformanceEvaluationEmployee();

            $EvalEmployee->setEval_id($PerformanceEvaluationEmployee['eval_dtl_id']);
            $EvalEmployee->setEval_type_id($PerformanceEvaluationEmployee['eval_type_id']);
            $EvalEmployee->setEval_emp_status($PerformanceEvaluationEmployee['eval_emp_status']);
            $EvalEmployee->setEmp_number($PerformanceEvaluationEmployee['emp_number']);
            $EvalEmployee->setEval_dtl_id($PerformanceEvaluationEmployee['eval_id']);

            $result = $performanceDao->saveEvaluationEmpList($EvalEmployee);
            $this->assertTrue($result);
        }
    }

    //test Delete PerformanceEvaluationEmployee
    public function testDeletePerformanceEvaluationEmployee($emp=array(4, 5), $id=array(1, 2)) {


        for ($i = 0; $i < 2; $i++) {
            $performanceDao = new performanceDao();
            $result = $performanceDao->deleteAssingEmployee($emp[$i], $id[$i]);
            $this->assertTrue($result);
        }
    }

    //test Delete AssignDuty
    public function testDeleteAssignDuty($id=array(1, 2, 3)) {

        for ($i = 0; $i < 3; $i++) {
            $performanceDao = new performanceDao();
            $result = $performanceDao->deleteAssignDuty($id[$i], $id[$i]);
            $this->assertTrue($result);
        }
    }

    //test Delete EvaluationDetail
    public function testDeleteEvaluationDetail($id=array(1, 2, 3)) {

        for ($i = 0; $i < 3; $i++) {
            $performanceDao = new performanceDao();
            $result = $performanceDao->deleteEvaluation($id[$i]);
            $this->assertTrue($result);
        }
    }

    //test Delete EvaluationComInfo
    public function testDeleteEvaluationComInfo($id=array(1, 2, 3)) {

        for ($i = 0; $i < 3; $i++) {
            $performanceDao = new performanceDao();
            $result = $performanceDao->deleteEvaluationCompanyInfo($id[$i]);
            $this->assertTrue($result);
        }
    }

    //test DeleteEvaluationDetail
    public function testDeletePerformanceDuty($id=array(1, 2, 3)) {

        for ($i = 0; $i < 3; $i++) {
            $performanceDao = new performanceDao();
            $result = $performanceDao->deleteDuty($id[$i]);
            $this->assertTrue($result);
        }
    }

    //test Delete PerformanceRate
    public function testDeletePerformanceRate($id=array(1, 2, 3)) {

        for ($i = 0; $i < 3; $i++) {
            $performanceDao = new performanceDao();
            $result = $performanceDao->deleteRate($id[$i]);
            $this->assertTrue($result);
        }
    }

    //test Delete PerformanceDutyGroup
    public function testDeletePerformanceDutyGroup($id=array(1, 2, 3)) {

        for ($i = 0; $i < 3; $i++) {
            $performanceDao = new performanceDao();
            $result = $performanceDao->deleteDutyGroup($id[$i]);
            $this->assertTrue($result);
        }
    }

}
?>


}
