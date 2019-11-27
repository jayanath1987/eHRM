<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class LeaveDaoTest extends PHPUnit_Framework_TestCase {

    public $LeaveDao;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/Leave/Leave.yml');
        $this->LeaveDao = new LeaveDao();

    }

    public function testsaveDocumentType() {

        foreach ($this->testCases['LeaveType'] as $key => $user) {

            $bt = new LeaveType();

            $bt->setLeave_type_id($user['leave_type_id']);
            $bt->setLeave_type_name($user['leave_type_name']);
            $bt->setLeave_type_name_si($user['leave_type_name_si']);
            $bt->setLeave_type_name_ta($user['leave_type_name_ta']);

            $result = $this->LeaveDao->saveDocumentType($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadDocumentType() {

        $LeaveDao = new LeaveDao();

        $res = $LeaveDao->searchDocumentType(null, null, "en", "b.leave_type_id", "ASC", 1);
        $testCase = $this->testCases['LeaveType'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['leave_type_id'], $abc[$i]->getLeave_type_id());
                $this->assertEquals($testCase[$j + 1]['leave_type_name'], $abc[$i]->getLeave_type_name());
                $this->assertEquals($testCase[$j + 1]['leave_type_name_si'], $abc[$i]->getLeave_type_name_si());
                $this->assertEquals($testCase[$j + 1]['leave_type_name_ta'], $abc[$i]->getLeave_type_name_ta());
            }
        }
    }

    public function testUpdateDocumentType($btid=1, $btname="CD", $btnsi="නසනසසනසසන", $btnta="ஸஸஸநஸஸ") {

        $LeaveDao = new LeaveDao();
        $abc = $LeaveDao->readDocumentType($btid);
        $this->abc = $abc;

        // $abc->setKnw_doc_id($btid);
        $abc->setLeave_type_name($btname);
        $abc->setLeave_type_name_si($btnsi);
        $abc->setLeave_type_name_ta($btnta);

        $result = $LeaveDao->saveDocumentType($abc);

        $this->assertTrue($result);
    }

        public function testsaveHoliday() {

        foreach ($this->testCases['LeaveHoliday'] as $key => $user) {

            $bt = new LeaveHoliday();

            $bt->setLeave_holiday_id($user['leave_holiday_id']);
            $bt->setLeave_holiday_name($user['leave_holiday_name']);
            $bt->setLeave_holiday_name_si($user['leave_holiday_name_si']);
            $bt->setLeave_holiday_name_ta($user['leave_holiday_name_ta']);
            $bt->setLeave_holiday_date($user['leave_holiday_date']);
            $bt->setLeave_holiday_annual($user['leave_holiday_annual']);
            $bt->setLeave_holiday_fulorhalf($user['leave_holiday_fulorhalf']);

            $result = $this->LeaveDao->saveHolyday($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadHoliday() {

        $LeaveDao = new LeaveDao();

        $res = $LeaveDao->searchHolyDay(null, null, "en", "b.leave_holiday_id", "ASC", 1);
        $testCase = $this->testCases['LeaveHoliday'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['leave_holiday_id'], $abc[$i]->getLeave_holiday_id());
                $this->assertEquals($testCase[$j + 1]['leave_holiday_name'], $abc[$i]->getLeave_holiday_name());
                $this->assertEquals($testCase[$j + 1]['leave_holiday_name_si'], $abc[$i]->getLeave_holiday_name_si());
                $this->assertEquals($testCase[$j + 1]['leave_holiday_name_ta'], $abc[$i]->getLeave_holiday_name_ta());
                $this->assertEquals($testCase[$j + 1]['leave_holiday_date'], $abc[$i]->getLeave_holiday_date());
                $this->assertEquals($testCase[$j + 1]['leave_holiday_annual'], $abc[$i]->getLeave_holiday_annual());
                $this->assertEquals($testCase[$j + 1]['leave_holiday_fulorhalf'], $abc[$i]->getLeave_holiday_fulorhalf());
            }
        }
    }

        public function testUpdateHoliday($btid=1, $btname="CD", $btnsi="නසනසසනසසන", $btnta="ஸஸஸநஸஸ",$btname1="2011-02-01", $btnsi1="1", $btnta1="1") {

        $LeaveDao = new LeaveDao();
        $abc = $LeaveDao->readHolyday($btid);
        $this->abc = $abc;

        // $abc->setKnw_doc_id($btid);
        $abc->setLeave_holiday_name($btname);
        $abc->setLeave_holiday_name_si($btnsi);
        $abc->setLeave_holiday_name_ta($btnta);
        $abc->setLeave_holiday_date($btname1);
        $abc->setLeave_holiday_annual($btnsi1);
        $abc->setLeave_holiday_fulorhalf($btnta1);

        $result = $LeaveDao->saveHolyday($abc);

        $this->assertTrue($result);
    }
        public function testsaveLeaveconfig() {

        foreach ($this->testCases['LeaveTypeConfig'] as $key => $user) {

            $bt = new LeaveTypeConfig();

            $bt->setLeave_type_id($user['leave_type_id']);
            $bt->setLeave_type_description($user['leave_type_description']);
            $bt->setLeave_type_active_flg($user['leave_type_active_flg']);
            $bt->setLeave_type_covering_employee_flg($user['leave_type_covering_employee_flg']);
            $bt->setLeave_type_allow_halfday_flg($user['leave_type_allow_halfday_flg']);
            $bt->setLeave_type_maternity_leave_flg($user['leave_type_maternity_leave_flg']);
            $bt->setLeave_type_need_approval_flg($user['leave_type_need_approval_flg']);
            $bt->setLeave_type_entitle_days($user['leave_type_entitle_days']);
            $bt->setLeave_type_max_days_without_medi($user['leave_type_max_days_without_medi']);
            $bt->setLeave_type_need_to_apply_before($user['leave_type_need_to_apply_before']);
            $bt->setLeave_type_wf_id($user['leave_type_wf_id']);
            $bt->setLeave_type_comment($user['leave_type_comment']);

            $result = $this->LeaveDao->saveLeaveTypeConfig($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadLeaveconfig() {

        $LeaveDao = new LeaveDao();

        $res = $LeaveDao->readLeaveTypeConfig(1);
        $testCase = $this->testCases['LeaveTypeConfig'];

        //$abc = $res['data'];
        foreach ($res as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['leave_type_id'], $abc[$i]->getLeave_type_id());
                $this->assertEquals($testCase[$j + 1]['leave_type_description'], $abc[$i]->getLeave_type_description());
                $this->assertEquals($testCase[$j + 1]['leave_type_active_flg'], $abc[$i]->getLeave_type_active_flg());
                $this->assertEquals($testCase[$j + 1]['leave_type_covering_employee_flg'], $abc[$i]->getLeave_type_covering_employee_flg());
                $this->assertEquals($testCase[$j + 1]['leave_type_allow_halfday_flg'], $abc[$i]->getLeave_type_allow_halfday_flg());
                $this->assertEquals($testCase[$j + 1]['leave_type_maternity_leave_flg'], $abc[$i]->getLeave_type_maternity_leave_flg());
                $this->assertEquals($testCase[$j + 1]['leave_type_need_approval_flg'], $abc[$i]->getLeave_type_need_approval_flg());
                $this->assertEquals($testCase[$j + 1]['leave_type_entitle_days'], $abc[$i]->getLeave_type_entitle_days());
                $this->assertEquals($testCase[$j + 1]['leave_type_max_days_without_medi'], $abc[$i]->getLeave_type_max_days_without_medi());
                $this->assertEquals($testCase[$j + 1]['leave_type_need_to_apply_before'], $abc[$i]->getLeave_type_need_to_apply_before());
                $this->assertEquals($testCase[$j + 1]['leave_type_wf_id'], $abc[$i]->getLeave_type_wf_id());
                $this->assertEquals($testCase[$j + 1]['leave_type_comment'], $abc[$i]->getLeave_type_comment());
            }
        }
    }

public function testUpdateLeaveconfig($btid=1, $btname="CD", $btnsi="1", $btnta="1",$btname1="1", $btnsi1="1", $btnta1="1",$btn22=20, $btn23=1, $btn24=1,$btn25=null,$btn26="sdf") {

        $LeaveDao = new LeaveDao();
        $bt = $LeaveDao->readLeaveTypeConfig($btid);
        $this->abc = $abc;

        // $abc->setKnw_doc_id($btid);
            //$bt->setLeave_type_id($user['leave_type_id']);
            $bt->setLeave_type_description($btname);
            $bt->setLeave_type_active_flg($btnsi);
            $bt->setLeave_type_covering_employee_flg($btnta);
            $bt->setLeave_type_allow_halfday_flg($btname1);
            $bt->setLeave_type_maternity_leave_flg($btnsi1);
            $bt->setLeave_type_need_approval_flg($btnta1);
            $bt->setLeave_type_entitle_days($btn22);
            $bt->setLeave_type_max_days_without_medi($btn23);
            $bt->setLeave_type_need_to_apply_before($btn24);
            $bt->setLeave_type_wf_id($btn25);
            $bt->setLeave_type_comment($btn26);

        $result = $LeaveDao->saveLeaveTypeConfig($bt);

        $this->assertTrue($result);
    }

    public function testsaveLeaveTypeDetails() {

        foreach ($this->testCases['LeaveTypeConfigDetail'] as $key => $user) {

            $bt = new LeaveTypeConfigDetail();

            $bt->setEstat_code($user['estat_code']);
            $bt->setLeave_type_id($user['leave_type_id']);

            $result = $this->LeaveDao->saveLeaveTypeConfigDetails($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadLeaveTypeDetails() {

        $LeaveDao = new LeaveDao();

        $res = $LeaveDao->readLeaveTypeConfigdetails(1);
        $testCase = $this->testCases['LeaveTypeConfigDetail'];

        $abc = $res['data'];
        foreach ($res as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['Estat_code'], $abc[$i]->getEstat_code());
                $this->assertEquals($testCase[$j + 1]['leave_type_id'], $abc[$i]->getLeave_type_id());

            }
        }
    }

        public function testsaveEntitle() {

        foreach ($this->testCases['LeaveEntitlement'] as $key => $user) {

            $bt = new LeaveEntitlement();

            $bt->setEmp_number($user['emp_number']);
            $bt->setLeave_type_id($user['leave_type_id']);
            $bt->setLeave_ent_day($user['leave_ent_day']);
            $bt->setLeave_ent_taken($user['leave_ent_taken']);
            $bt->setLeave_ent_sheduled($user['leave_ent_sheduled']);
            $bt->setLeave_ent_remain($user['leave_ent_remain']);
            $bt->setLeave_ent_year($user['leave_ent_year']);

            $result = $this->LeaveDao->saveEntitlement($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadEntitle() {

        $LeaveDao = new LeaveDao();

        $res = $LeaveDao->readLeaveEntitlementDisplay(1,2);
        $testCase = $this->testCases['LeaveEntitlement'];

        //$abc = $res['data'];
        foreach ($res as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['emp_number'], $abc[$i]->getEmp_number());
                $this->assertEquals($testCase[$j + 1]['leave_type_id'], $abc[$i]->getLeave_type_id());
                $this->assertEquals($testCase[$j + 1]['leave_ent_day'], $abc[$i]->getLeave_ent_day());
                $this->assertEquals($testCase[$j + 1]['leave_ent_taken'], $abc[$i]->getLeave_ent_taken());
                $this->assertEquals($testCase[$j + 1]['leave_ent_sheduled'], $abc[$i]->getLeave_ent_sheduled());
                $this->assertEquals($testCase[$j + 1]['leave_ent_remain'], $abc[$i]->getLeave_ent_remain());
                $this->assertEquals($testCase[$j + 1]['leave_ent_year'], $abc[$i]->getLeave_ent_year());

            }
        }
    }

public function testUpdateEntitle($btid=1, $btname=1, $btnsi="2011", $ed=15,$et=0, $es=0, $er=15) {

        $LeaveDao = new LeaveDao();
        $bt = $LeaveDao->readLeaveEntitlement($btid,$btname,$btnsi);
        $this->abc = $abc;


        $result = $LeaveDao->UpdateEntitlement($btid,$btname,$btnsi,$ed,$es,$et,$er);

        $this->assertTrue($result);
    }


public function testsaveLeave() {

        foreach ($this->testCases['LeaveApplication'] as $key => $user) {

            $bt = new LeaveApplication();

            $bt->setLeave_app_id($user['leave_app_id']);
            $bt->setLeave_app_applied_date($user['leave_app_applied_date']);
            $bt->setEmp_number($user['emp_number']);
            $bt->setLeave_app_start_date($user['leave_app_start_date']);
            $bt->setLeave_app_end_date($user['leave_app_end_date']);
            $bt->setLeave_app_status($user['leave_app_status']);
            $bt->setLeave_type_id($user['leave_type_id']);
            $bt->setLeave_app_reason($user['leave_app_reason']);
            $bt->setLeave_app_comment($user['leave_app_comment']);
            $bt->setLeave_app_covemp_number($user['leave_app_covemp_number']);
            $bt->setLeave_type_wf_id($user['leave_type_wf_id']);
            $bt->setLeave_app_workdays($user['leave_app_workdays']);
            $result = $this->LeaveDao->saveLeave($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadLeave() {

        $LeaveDao = new LeaveDao();

        $res = $LeaveDao->searchLeave(null, null, "en", "b.leave_app_id", "ASC", 1,1);
        $testCase = $this->testCases['LeaveApplication'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['leave_app_id'], $abc[$i]->getLeave_app_id());
                $this->assertEquals($testCase[$j + 1]['leave_app_applied_date'], $abc[$i]->getLeave_app_applied_date());
                $this->assertEquals($testCase[$j + 1]['emp_number'], $abc[$i]->getEmp_number());
                $this->assertEquals($testCase[$j + 1]['leave_app_start_date'], $abc[$i]->getLeave_app_start_date());
                $this->assertEquals($testCase[$j + 1]['leave_app_status'], $abc[$i]->getLeave_app_status());
                $this->assertEquals($testCase[$j + 1]['leave_type_id'], $abc[$i]->getLeave_type_id());
                $this->assertEquals($testCase[$j + 1]['leave_app_reason'], $abc[$i]->getLeave_app_reason());
                $this->assertEquals($testCase[$j + 1]['leave_app_comment'], $abc[$i]->getLeave_app_comment());
                $this->assertEquals($testCase[$j + 1]['leave_app_covemp_number'], $abc[$i]->getLeave_app_covemp_number());
                $this->assertEquals($testCase[$j + 1]['leave_type_wf_id'], $abc[$i]->getLeave_type_wf_id());
                $this->assertEquals($testCase[$j + 1]['leave_app_workdays'], $abc[$i]->getLeave_app_workdays());
            }
        }
    }

        public function testUpdateLeave($btid=1) {

        $LeaveDao = new LeaveDao();
        $bt = $LeaveDao->getLeaveload($btid);
        $this->abc = $abc;

        // $abc->setKnw_doc_id($btid);
            //$bt->setLeave_app_id($user['leave_app_id']);
            $bt->setLeave_app_applied_date("2011-01-02");
            $bt->setEmp_number(1);
            $bt->setLeave_app_start_date("2011-02-06");
            $bt->setLeave_app_end_date("2011-02-09");
            $bt->setLeave_app_status("1");
            $bt->setLeave_type_id(1);
            $bt->setLeave_app_reason(1);
            $bt->setLeave_app_comment("test");
            $bt->setLeave_app_covemp_number(2);
            $bt->setLeave_type_wf_id(null);
            $bt->setLeave_app_workdays(4);

        $result = $LeaveDao->saveLeave($bt);

        $this->assertTrue($result);
    }

    public function testDeleteLeave($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $LeaveDao = new LeaveDao();
            $result = $LeaveDao->deleteLeave($id[$i]);
            $this->assertTrue($result);
        }
    }




    
    public function testDeleteEntitlement($id=array(1,2),$aid=array(1,2),$yr=array("2011","2011")) {

        for ($i = 0; $i < 2; $i++) {
            $LeaveDao = new LeaveDao();
            $result = $LeaveDao->deleteEntitlement($id[$i]."|".$aid[$i]."|".$yr[$i]);
            $this->assertTrue($result);
        }
    }


        public function testDeleteLeaveconfigdetail($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $LeaveDao = new LeaveDao();
            $result = $LeaveDao->deletereclevtypeconfigdetail($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteLeaveconfig($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $LeaveDao = new LeaveDao();
            $result = $LeaveDao->DeleteLeaveconfig($id[$i]);
            $this->assertTrue($result);
        }
    }

    public function testDeleteHoliday($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $LeaveDao = new LeaveDao();
            $result = $LeaveDao->deleteHolyDay($id[$i]);
            $this->assertTrue($result);
        }
    }


    public function testDeleteDocumentType($id=array(1, 2)) {

        for ($i = 0; $i < 2; $i++) {
            $LeaveDao = new LeaveDao();
            $result = $LeaveDao->deleteDocumentType($id[$i]);
            $this->assertTrue($result);
        }
    }

}

?>
