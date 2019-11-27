<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class pimDaoTest extends PHPUnit_Framework_TestCase {

    public $wbmDao;

    protected function setUp() {

        $this->testCases = sfYaml::load(sfConfig::get('sf_test_dir') . '/fixtures/pim/pim.yml');
    }

//-----Employee
    public function testSaveEmployee() {

        $EmployeeDao = new EmployeeDao();
        foreach ($this->testCases['Employee'] as $key => $user) {

            $bt = new Employee();

            $bt->setEmp_number($user['emp_number']);
            $bt->setEmployee_id($user['employee_id']);
            $bt->setTitle_code($user['title_code']);
            $bt->setEmp_initials($user['emp_initials']);
            $bt->setEmp_initials_si($user['emp_initials_si']);
            $bt->setEmp_initials_ta($user['emp_initials_ta']);
            $bt->setEmp_names_of_initials($user['emp_names_of_initials']);
            $bt->setEmp_names_of_initials_si($user['emp_names_of_initials_si']);
            $bt->setEmp_names_of_initials_ta($user['emp_names_of_initials_ta']);
            $bt->setEmp_firstname($user['emp_firstname']);
            $bt->setEmp_firstname_si($user['emp_firstname_si']);
            $bt->setEmp_firstname_ta($user['emp_firstname_ta']);
            $bt->setEmp_lastname($user['emp_lastname']);
            $bt->setEmp_lastname_si($user['emp_lastname_si']);
            $bt->setEmp_lastname_ta($user['emp_lastname_ta']);
            $bt->setEmp_display_name($user['emp_display_name']);
            $bt->setEmp_display_name_si($user['emp_display_name_si']);
            $bt->setEmp_display_name_ta($user['emp_display_name_ta']);
            $bt->setEmp_app_letter_no($user['emp_app_letter_no']);
            $bt->setEmp_personal_file_no($user['emp_personal_file_no']);
            $bt->setEthnic_race_code($user['ethnic_race_code']);
            $bt->setService_code($user['service_code']);
            $bt->setGrade_code($user['grade_code']);
            $bt->setNation_code($user['nation_code']);
            $bt->setGender_code($user['gender_code']);
            $bt->setClass_code($user['class_code']);
            $bt->setMarst_code($user['marst_code']);
            $bt->setEmp_married_date($user['emp_married_date']);
            $bt->setJob_title_code($user['job_title_code']);
            $bt->setWork_station($user['work_station']);
            $bt->setEmp_nic_no($user['emp_nic_no']);
            $bt->setEmp_nic_date($user['emp_nic_date']);
            $bt->setEmp_status($user['emp_status']);
            $bt->setRlg_code($user['rlg_code']);
            $bt->setLang_code($user['lang_code']);
            $bt->setCou_code($user['cou_code']);
            $bt->setEmp_birthday($user['emp_birthday']);
            $bt->setEmp_birth_location($user['emp_birth_location']);
            $bt->setEmp_birth_location_si($user['emp_birth_location_si']);
            $bt->setEmp_birth_location_ta($user['emp_birth_location_ta']);
            $bt->setEmp_passport_no($user['emp_passport_no']);
            $bt->setEmp_attendance_no($user['emp_attendance_no']);
            $bt->setEmp_other_file_no($user['emp_other_file_no']);
            $bt->setEmp_salary_no($user['emp_salary_no']);
            $bt->setEmp_barcode_no($user['emp_barcode_no']);
            $bt->setEmp_public_app_date($user['emp_public_app_date']);
            $bt->setEmp_public_com_date($user['emp_public_com_date']);
            $bt->setEmp_app_date($user['emp_app_date']);
            $bt->setEmp_com_date($user['emp_com_date']);
            $bt->setEmp_rec_method($user['emp_rec_method']);
            $bt->setEmp_rec_method_desc($user['emp_rec_method_desc']);
            $bt->setEmp_rec_method_desc_si($user['emp_rec_method_desc_si']);
            $bt->setEmp_rec_method_desc_ta($user['emp_rec_method_desc_ta']);
            $bt->setEmp_rec_medium($user['emp_rec_medium']);
            $bt->setEmp_active_hrm_flg($user['emp_active_hrm_flg']);
            $bt->setEmp_active_att_flg($user['emp_active_att_flg']);
            $bt->setEmp_wop_flg($user['emp_wop_flg']);
            $bt->setEmp_wop_no($user['emp_wop_no']);
            $bt->setEmp_confirm_flg($user['emp_confirm_flg']);
            $bt->setEmp_confirm_date($user['emp_confirm_date']);
            $bt->setEmp_prob_ext_flg($user['emp_prob_ext_flg']);
            $bt->setEmp_prob_from_date($user['emp_prob_from_date']);
            $bt->setEmp_prob_to_date($user['emp_prob_to_date']);
            $bt->setEmp_salary_scale($user['emp_salary_scale']);
            $bt->setEmp_salary_scale_si($user['emp_salary_scale_si']);
            $bt->setEmp_salary_scale_ta($user['emp_salary_scale_ta']);
            $bt->setEmp_basic_salary($user['emp_basic_salary']);
            $bt->setEmp_salary_inc_date($user['emp_salary_inc_date']);
            $bt->setTerminated_date($user['terminated_date']);
            $bt->setTermination_reason($user['termination_reason']);
            $bt->setCustom1($user['custom1']);
            $bt->setCustom2($user['custom2']);
            $bt->setCustom3($user['custom3']);
            $bt->setCustom4($user['custom4']);
            $bt->setCustom5($user['custom5']);
            $bt->setCustom6($user['custom6']);
            $bt->setCustom7($user['custom7']);
            $bt->setCustom8($user['custom8']);
            $bt->setCustom9($user['custom9']);
            $bt->setCustom10($user['custom10']);

            $result = $EmployeeDao->addEmployee($bt);

            $this->assertTrue($result);
        }
    }

    public function testreadEmployee() {

        $EmployeeDao = new EmployeeDao();

        $res = $EmployeeDao->getEmployeeList(null, null, "en", 1, 'e.emp_number', "ASC");
        $testCase = $this->testCases['Employee'];

        $abc = $res['data'];
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['emp_number'], $abc[$i]->getEmp_number());
                $this->assertEquals($testCase[$j + 1]['employee_id'], $abc[$i]->getEmployee_id());
                $this->assertEquals($testCase[$j + 1]['title_code'], $abc[$i]->getTitle_code());
                $this->assertEquals($testCase[$j + 1]['emp_initials'], $abc[$i]->getEmp_initials());
                $this->assertEquals($testCase[$j + 1]['emp_initials_si'], $abc[$i]->getEmp_initials_si());
                $this->assertEquals($testCase[$j + 1]['emp_initials_ta'], $abc[$i]->getEmp_initials_ta());
                $this->assertEquals($testCase[$j + 1]['emp_names_of_initials'], $abc[$i]->getEmp_names_of_initials());
                $this->assertEquals($testCase[$j + 1]['emp_names_of_initials_si'], $abc[$i]->getEmp_names_of_initials_si());
                $this->assertEquals($testCase[$j + 1]['emp_names_of_initials_ta'], $abc[$i]->getEmp_names_of_initials_ta());
                $this->assertEquals($testCase[$j + 1]['emp_firstname'], $abc[$i]->getEmp_firstname());
                $this->assertEquals($testCase[$j + 1]['emp_firstname_si'], $abc[$i]->getEmp_firstname_si());
                $this->assertEquals($testCase[$j + 1]['emp_firstname_ta'], $abc[$i]->getEmp_firstname_ta());
                $this->assertEquals($testCase[$j + 1]['emp_lastname'], $abc[$i]->getEmp_lastname());
                $this->assertEquals($testCase[$j + 1]['emp_lastname_si'], $abc[$i]->getEmp_lastname_si());
                $this->assertEquals($testCase[$j + 1]['emp_lastname_ta'], $abc[$i]->getEmp_lastname_ta());
                $this->assertEquals($testCase[$j + 1]['emp_display_name'], $abc[$i]->getEmp_display_name());
                $this->assertEquals($testCase[$j + 1]['emp_display_name_si'], $abc[$i]->getEmp_display_name_si());
                $this->assertEquals($testCase[$j + 1]['emp_display_name_ta'], $abc[$i]->getEmp_display_name_ta());
                $this->assertEquals($testCase[$j + 1]['emp_app_letter_no'], $abc[$i]->getEmp_app_letter_no());
                $this->assertEquals($testCase[$j + 1]['emp_personal_file_no'], $abc[$i]->getEmp_personal_file_no());
                $this->assertEquals($testCase[$j + 1]['ethnic_race_code'], $abc[$i]->getEthnic_race_code());
                $this->assertEquals($testCase[$j + 1]['service_code'], $abc[$i]->getService_code());
                $this->assertEquals($testCase[$j + 1]['grade_code'], $abc[$i]->getGrade_code());
                $this->assertEquals($testCase[$j + 1]['nation_code'], $abc[$i]->getNation_code());
                $this->assertEquals($testCase[$j + 1]['gender_code'], $abc[$i]->getGender_code());
                $this->assertEquals($testCase[$j + 1]['class_code'], $abc[$i]->getClass_code());
                $this->assertEquals($testCase[$j + 1]['marst_code'], $abc[$i]->getMarst_code());
                $this->assertEquals($testCase[$j + 1]['emp_married_date'], $abc[$i]->getEmp_married_date());
                $this->assertEquals($testCase[$j + 1]['job_title_code'], $abc[$i]->getJob_title_code());
                $this->assertEquals($testCase[$j + 1]['work_station'], $abc[$i]->getWork_station());
                $this->assertEquals($testCase[$j + 1]['emp_nic_no'], $abc[$i]->getEmp_nic_no());
                $this->assertEquals($testCase[$j + 1]['emp_nic_date'], $abc[$i]->getEmp_nic_date());
                $this->assertEquals($testCase[$j + 1]['emp_status'], $abc[$i]->getEmp_status());
                $this->assertEquals($testCase[$j + 1]['rlg_code'], $abc[$i]->getRlg_code());
                $this->assertEquals($testCase[$j + 1]['lang_code'], $abc[$i]->getLang_code());
                $this->assertEquals($testCase[$j + 1]['cou_code'], $abc[$i]->getCou_code());
                $this->assertEquals($testCase[$j + 1]['emp_birthday'], $abc[$i]->getEmp_birthday());
                $this->assertEquals($testCase[$j + 1]['emp_birth_location'], $abc[$i]->getEmp_birth_location());
                $this->assertEquals($testCase[$j + 1]['emp_birth_location_si'], $abc[$i]->getEmp_birth_location_si());
                $this->assertEquals($testCase[$j + 1]['emp_birth_location_ta'], $abc[$i]->getEmp_birth_location_ta());
                $this->assertEquals($testCase[$j + 1]['emp_passport_no'], $abc[$i]->getEmp_passport_no());
                $this->assertEquals($testCase[$j + 1]['emp_attendance_no'], $abc[$i]->getEmp_attendance_no());
                $this->assertEquals($testCase[$j + 1]['emp_other_file_no'], $abc[$i]->getEmp_other_file_no());
                $this->assertEquals($testCase[$j + 1]['emp_salary_no'], $abc[$i]->getEmp_salary_no());
                $this->assertEquals($testCase[$j + 1]['emp_barcode_no'], $abc[$i]->getEmp_barcode_no());
                $this->assertEquals($testCase[$j + 1]['emp_public_app_date'], $abc[$i]->getEmp_public_app_date());
                $this->assertEquals($testCase[$j + 1]['emp_public_com_date'], $abc[$i]->getEmp_public_com_date());
                $this->assertEquals($testCase[$j + 1]['emp_app_date'], $abc[$i]->getEmp_app_date());
                $this->assertEquals($testCase[$j + 1]['emp_com_date'], $abc[$i]->getEmp_com_date());
                $this->assertEquals($testCase[$j + 1]['emp_rec_method'], $abc[$i]->getEmp_rec_method());
                $this->assertEquals($testCase[$j + 1]['emp_rec_method_desc'], $abc[$i]->getEmp_rec_method_desc());
                $this->assertEquals($testCase[$j + 1]['emp_rec_method_desc_si'], $abc[$i]->getEmp_rec_method_desc_si());
                $this->assertEquals($testCase[$j + 1]['emp_rec_method_desc_ta'], $abc[$i]->getEmp_rec_method_desc_ta());
                $this->assertEquals($testCase[$j + 1]['emp_rec_medium'], $abc[$i]->getEmp_rec_medium());
                $this->assertEquals($testCase[$j + 1]['emp_active_hrm_flg'], $abc[$i]->getEmp_active_hrm_flg());
                $this->assertEquals($testCase[$j + 1]['emp_active_att_flg'], $abc[$i]->getEmp_active_att_flg());
                $this->assertEquals($testCase[$j + 1]['emp_wop_flg'], $abc[$i]->getEmp_wop_flg());
                $this->assertEquals($testCase[$j + 1]['emp_wop_no'], $abc[$i]->getEmp_wop_no());
                $this->assertEquals($testCase[$j + 1]['emp_confirm_flg'], $abc[$i]->getEmp_confirm_flg());
                $this->assertEquals($testCase[$j + 1]['emp_confirm_date'], $abc[$i]->getEmp_confirm_date());
                $this->assertEquals($testCase[$j + 1]['emp_prob_ext_flg'], $abc[$i]->getEmp_prob_ext_flg());
                $this->assertEquals($testCase[$j + 1]['emp_prob_from_date'], $abc[$i]->getEmp_prob_from_date());
                $this->assertEquals($testCase[$j + 1]['emp_prob_to_date'], $abc[$i]->getEmp_prob_to_date());
                $this->assertEquals($testCase[$j + 1]['emp_salary_scale'], $abc[$i]->getEmp_salary_scale());
                $this->assertEquals($testCase[$j + 1]['emp_salary_scale_si'], $abc[$i]->getEmp_salary_scale_si());
                $this->assertEquals($testCase[$j + 1]['emp_salary_scale_ta'], $abc[$i]->getEmp_salary_scale_ta());
                $this->assertEquals($testCase[$j + 1]['emp_basic_salary'], $abc[$i]->getEmp_basic_salary());
                $this->assertEquals($testCase[$j + 1]['emp_salary_inc_date'], $abc[$i]->getEmp_salary_inc_date());
                $this->assertEquals($testCase[$j + 1]['terminated_date'], $abc[$i]->getTerminated_date());
                $this->assertEquals($testCase[$j + 1]['termination_reason'], $abc[$i]->getTermination_reason());
                $this->assertEquals($testCase[$j + 1]['custom1'], $abc[$i]->getCustom1());
                $this->assertEquals($testCase[$j + 1]['custom2'], $abc[$i]->getCustom2());
                $this->assertEquals($testCase[$j + 1]['custom3'], $abc[$i]->getCustom3());
                $this->assertEquals($testCase[$j + 1]['custom4'], $abc[$i]->getCustom4());
                $this->assertEquals($testCase[$j + 1]['custom5'], $abc[$i]->getCustom5());
                $this->assertEquals($testCase[$j + 1]['custom6'], $abc[$i]->getCustom6());
                $this->assertEquals($testCase[$j + 1]['custom7'], $abc[$i]->getCustom7());
                $this->assertEquals($testCase[$j + 1]['custom8'], $abc[$i]->getCustom8());
                $this->assertEquals($testCase[$j + 1]['custom9'], $abc[$i]->getCustom9());
                $this->assertEquals($testCase[$j + 1]['custom10'], $abc[$i]->getCustom10());
            }
        }
    }

//    public function testUpdateEmployee($eno=1 ,$dd=1) {
//
//        $EmployeeDao=new EmployeeDao();
//       // $bt = new Employee();
////        $bt = $EmployeeDao->read($eno);
//       // $this->bt = $bt;
// $bt = $EmployeeDao->getEmployeeList(null,null,"en",1,'e.emp_number',"ASC");
//
//            $bt->setTitle_code(null);
//            $bt->setEmp_initials(null);
//            $bt->setEmp_initials_si(null);
//            $bt->setEmp_initials_ta(null);
//            $bt->setEmp_names_of_initials(null);
//            $bt->setEmp_names_of_initials_si(null);
//            $bt->setEmp_names_of_initials_ta(null);
//            $bt->setEmp_firstname("fghfghfg");
//            $bt->setEmp_firstname_si(null);
//            $bt->setEmp_firstname_ta(null);
//            $bt->setEmp_lastname("dfgdfgdg");
//            $bt->setEmp_lastname_si(null);
//            $bt->setEmp_lastname_ta(null);
//            $bt->setEmp_display_name(null);
//            $bt->setEmp_display_name_si(null);
//            $bt->setEmp_display_name_ta(null);
//            $bt->setEmp_app_letter_no(null);
//            $bt->setEmp_personal_file_no(null);
//            $bt->setEthnic_race_code(null);
//            $bt->setService_code(null);
//            $bt->setGrade_code(null);
//            $bt->setNation_code(null);
//            $bt->setGender_code(null);
//            $bt->setClass_code(null);
//            $bt->setMarst_code(null);
//            $bt->setEmp_married_date(null);
//            $bt->setJob_title_code(null);
//            $bt->setWork_station(null);
//            $bt->setEmp_nic_no(null);
//            $bt->setEmp_nic_date(null);
//            $bt->setEmp_status(null);
//            $bt->setRlg_code(null);
//            $bt->setLang_code(null);
//            $bt->setCou_code(null);
//            $bt->setEmp_birthday(null);
//            $bt->setEmp_birth_location(null);
//            $bt->setEmp_birth_location_si(null);
//            $bt->setEmp_birth_location_ta(null);
//            $bt->setEmp_passport_no(null);
//            $bt->setEmp_attendance_no(null);
//            $bt->setEmp_other_file_no(null);
//            $bt->setEmp_salary_no(null);
//            $bt->setEmp_barcode_no(null);
//            $bt->setEmp_public_app_date(null);
//            $bt->setEmp_public_com_date(null);
//            $bt->setEmp_app_date(null);
//            $bt->setEmp_com_date(null);
//            $bt->setEmp_rec_method(null);
//            $bt->setEmp_rec_method_desc(null);
//            $bt->setEmp_rec_method_desc_si(null);
//            $bt->setEmp_rec_method_desc_ta(null);
//            $bt->setEmp_rec_medium(null);
//            $bt->setEmp_active_hrm_flg(null);
//            $bt->setEmp_active_att_flg(null);
//            $bt->setEmp_wop_flg(null);
//            $bt->setEmp_wop_no(null);
//            $bt->setEmp_confirm_flg(null);
//            $bt->setEmp_confirm_date(null);
//            $bt->setEmp_prob_ext_flg(null);
//            $bt->setEmp_prob_from_date(null);
//            $bt->setEmp_prob_to_date(null);
//            $bt->setEmp_salary_scale(null);
//            $bt->setEmp_salary_scale_si(null);
//            $bt->setEmp_salary_scale_ta(null);
//            $bt->setEmp_basic_salary(null);
//            $bt->setEmp_salary_inc_date(null);
//            $bt->setTerminated_date(null);
//            $bt->setTermination_reason(null);
//            $bt->setCustom1(null);
//            $bt->setCustom2(null);
//            $bt->setCustom3(null);
//            $bt->setCustom4(null);
//            $bt->setCustom5(null);
//            $bt->setCustom6(null);
//            $bt->setCustom7(null);
//            $bt->setCustom8(null);
//            $bt->setCustom9(null);
//            $bt->setCustom10(null);
//
//        $result = $EmployeeDao->addEmployee($bt);
//
//        $this->assertTrue($result);
//    }


    public function testSaveContactDetails() {

        $service = new EmployeeService();

        foreach ($this->testCases['ContactDetails'] as $key => $user) {
            $contactDetails = new EmpContact();

            $contactDetails->setEmp_number($user['emp_number']);
            $contactDetails->con_off_addLine1 = $user['con_off_addLine1'];
            $contactDetails->con_off_addLine1_si = $user['con_off_addLine1_si'];
            $contactDetails->con_off_addLine1_ta = $user['con_off_addLine1_ta'];
            $contactDetails->con_off_addLine2 = $user['con_off_addLine2'];
            $contactDetails->con_off_addLine2_si = $user['con_off_addLine2_si'];
            $contactDetails->con_off_addLine2_ta = $user['con_off_addLine2_ta'];
            $contactDetails->con_off_del_postoffice = $user['con_off_del_postoffice'];
            $contactDetails->con_off_del_postoffice_si = $user['con_off_del_postoffice_si'];
            $contactDetails->con_off_del_postoffice_ta = $user['con_off_del_postoffice_ta'];
            $contactDetails->con_off_postal_code = $user['con_off_postal_code'];
            $contactDetails->con_off_country = $user['con_off_country'];
            $contactDetails->con_off_direct = $user['con_off_direct'];
            $contactDetails->con_off_ext = $user['con_off_ext'];
            $contactDetails->con_off_fax = $user['con_off_fax'];
            $contactDetails->con_off_email = $user['con_off_email'];
            $contactDetails->con_off_url = $user['con_off_url'];
            $contactDetails->con_res_addLine1 = $user['con_res_addLine1'];
            $contactDetails->con_res_addLine1_si = $user['con_res_addLine1_si'];
            $contactDetails->con_res_addLine1_ta = $user['con_res_addLine1_ta'];
            $contactDetails->con_res_addLine1_ta = $user['con_res_addLine1_ta'];
            $contactDetails->con_res_addLine2 = $user['con_res_addLine2'];
            $contactDetails->con_res_addLine2_si = $user['con_res_addLine2_si'];
            $contactDetails->con_res_addLine2_ta = $user['con_res_addLine2_ta'];
            $contactDetails->con_res_del_postoffice = $user['con_res_del_postoffice'];
            $contactDetails->con_res_del_postoffice_si = $user['con_res_del_postoffice_si'];
            $contactDetails->con_res_del_postoffice_ta = $user['con_res_del_postoffice_ta'];
            $contactDetails->con_res_postal_code = $user['con_res_postal_code'];
            $contactDetails->con_res_div_sectretariat = $user['con_res_div_sectretariat'];
            $contactDetails->con_res_div_sectretariat_si = $user['con_res_div_sectretariat_si'];
            $contactDetails->con_res_div_sectretariat_ta = $user['con_res_div_sectretariat_ta'];
            $contactDetails->con_res_policesation = $user['con_res_policesation'];
            $contactDetails->con_res_policesation_si = $user['con_res_policesation_si'];
            $contactDetails->con_res_policesation_ta = $user['con_res_policesation_ta'];
            $contactDetails->con_res_district = $user['con_res_district'];
            $contactDetails->con_res_district_si = $user['con_res_district_si'];
            $contactDetails->con_res_district_ta = $user['con_res_district_ta'];
            $contactDetails->con_res_phone = $user['con_res_phone'];
            $contactDetails->con_res_fax = $user['con_res_fax'];
            $contactDetails->con_res_mobile = $user['con_res_mobile'];
            $contactDetails->con_res_email = $user['con_res_email'];
            $contactDetails->con_per_addLine1 = $user['con_per_addLine1'];
            $contactDetails->con_per_addLine1_si = $user['con_per_addLine1_si'];
            $contactDetails->con_per_addLine1_ta = $user['con_per_addLine1_ta'];
            $contactDetails->con_per_addLine1_ta = $user['con_per_addLine1_ta'];
            $contactDetails->con_per_addLine2 = $user['con_per_addLine2'];
            $contactDetails->con_per_addLine2_si = $user['con_per_addLine2_si'];
            $contactDetails->con_per_addLine2_ta = $user['con_per_addLine2_ta'];
            $contactDetails->con_per_del_postoffice = $user['con_per_del_postoffice'];
            $contactDetails->con_per_del_postoffice_si = $user['con_per_del_postoffice_si'];
            $contactDetails->con_per_del_postoffice_ta = $user['con_per_del_postoffice_ta'];
            $contactDetails->con_per_postal_code = $user['con_per_postal_code'];
            $contactDetails->con_per_div_sectretariat = $user['con_per_div_sectretariat'];
            $contactDetails->con_per_div_sectretariat_si = $user['con_per_div_sectretariat_si'];
            $contactDetails->con_per_div_sectretariat_ta = $user['con_per_div_sectretariat_ta'];
            $contactDetails->con_per_policesation = $user['con_per_policesation'];
            $contactDetails->con_per_policesation_si = $user['con_per_policesation_si'];
            $contactDetails->con_per_policesation_ta = $user['con_per_policesation_ta'];
            $contactDetails->con_per_district = $user['con_per_district'];
            $contactDetails->con_per_district_si = $user['con_per_district_si'];
            $contactDetails->con_per_district_ta = $user['con_per_district_ta'];
            $contactDetails->con_per_phone = $user['con_per_phone'];
            $contactDetails->con_per_fax = $user['con_per_fax'];
            $contactDetails->con_per_mobile = $user['con_per_mobile'];
            $contactDetails->con_per_email = $user['con_per_email'];
            $contactDetails->con_oth_addLine1_si = $user['con_oth_addLine1_si'];
            $contactDetails->con_oth_addLine1_ta = $user['con_oth_addLine1_ta'];
            $contactDetails->con_oth_addLine1_ta = $user['con_oth_addLine1_ta'];
            $contactDetails->con_oth_addLine2 = $user['con_oth_addLine2'];
            $contactDetails->con_oth_addLine2_si = $user['con_oth_addLine2_si'];
            $contactDetails->con_oth_addLine2_ta = $user['con_oth_addLine2_ta'];
            $contactDetails->con_oth_del_postoffice = $user['con_oth_del_postoffice'];
            $contactDetails->con_oth_del_postoffice_si = $user['con_oth_del_postoffice_si'];
            $contactDetails->con_oth_del_postoffice_ta = $user['con_oth_del_postoffice_ta'];
            $contactDetails->con_oth_postal_code = $user['con_oth_postal_code'];
            $contactDetails->con_oth_div_sectretariat = $user['con_oth_div_sectretariat'];
            $contactDetails->con_oth_div_sectretariat_si = $user['con_oth_div_sectretariat_si'];
            $contactDetails->con_oth_div_sectretariat_ta = $user['con_oth_div_sectretariat_ta'];
            $contactDetails->con_oth_policesation = $user['con_oth_policesation'];
            $contactDetails->con_oth_policesation_si = $user['con_oth_policesation_si'];
            $contactDetails->con_oth_policesation_ta = $user['con_oth_policesation_ta'];
            $contactDetails->con_oth_district = $user['con_oth_district'];
            $contactDetails->con_oth_district_si = $user['con_oth_district_si'];
            $contactDetails->con_oth_district_ta = $user['con_oth_district_ta'];
            $contactDetails->con_oth_phone = $user['con_oth_phone'];
            $contactDetails->con_oth_fax = $user['con_oth_fax'];
            $contactDetails->con_oth_mobile = $user['con_oth_mobile'];
            $contactDetails->con_oth_email = $user['con_oth_email'];

            $result = $service->saveContactDetails($contactDetails);


            $this->assertTrue($result);
        }
    }

    public function testreadContactDetails() {


        $service = new EmployeeService();


        $res = $service->getEmployeeContact(1);
        $testCase = $this->testCases['ContactDetails'];

        $abc = $res;

        $this->assertEquals($testCase[1]['emp_number'], $abc->emp_number);
        $this->assertEquals($testCase[1]['con_off_addLine1'], $abc->con_off_addLine1);
    }

    public function testgetContactDetailsById() {

        $service = new EmployeeService();
        $result = $service->getContactDetailsById(1);

        // die(print_r($result));die;
        $testCase = $this->testCases['ContactDetails'];



        $this->assertEquals($testCase[1]['emp_number'], $result[0]['emp_number']);
        $this->assertEquals($testCase[1]['con_off_direct'], $result[0]['con_off_direct']);
    }
    
    public function testSaveWorkExprince(){

        $service = new EmployeeService();

        foreach ($this->testCases['WorkExperince'] as $key => $user) {

       $workExp = new EmpWorkExperience();

        $workExp->emp_number = $user['emp_number'];
         $workExp->eexp_seqno = $user['eexp_seqno'];
        $workExp->eexp_company = $user['eexp_company'];
        $workExp->eexp_company_si = $user['eexp_company_si'];
        $workExp->eexp_company_ta = $user['eexp_company_ta'];

        $workExp->eexp_jobtitle = $user['eexp_jobtitle'];
        $workExp->eexp_jobtitle_si = $user['eexp_jobtitle_si'];
        $workExp->eexp_jobtitle_ta =$user['eexp_jobtitle_ta'];

        $workExp->eexp_from_date = $user['eexp_from_date'];
        $workExp->eexp_to_date = $user['eexp_to_date'];

        $workExp->eexp_comments = $user['eexp_comments'];
        $workExp->eexp_comments_si = $user['eexp_comments_si'];
        $workExp->eexp_comments_ta = $user['eexp_comments_ta'];

    
        $workExp->eexp_internal_flg = $user['eexp_internal_flg'];

        $result = $service->saveWorkExperience($workExp);


            $this->assertTrue($result);
        }

    }
    public function testgetWorkExperinceById() {

            $service = new EmployeeService();
            $result = $service->getWorkExperienceById(1,1);

        // die(print_r($result));die;
        $testCase = $this->testCases['WorkExperince'];



        $this->assertEquals($testCase[1]['emp_number'], $result[0]['emp_number']);
        $this->assertEquals($testCase[1]['eexp_company'], $result[0]['eexp_company']);
    }


    public function testSaveEmrgancyContact() {

        $service = new EmployeeService();
 foreach ($this->testCases['EmergancyContacts'] as $key => $user) {
        $emgContact = new EmpEmergencyContact();
        $emgContact->emp_number = $user['emp_number'];
        $emgContact->seqno = $user['eec_seqno'];
        
        $emgContact->name = $user['eec_name'];
        $emgContact->name_si = $user['eec_name_si'];
        $emgContact->name_ta = $user['eec_name_ta'];
        $emgContact->relationship = $user['eec_relationship'];
        $emgContact->relationship_si = $user['eec_relationship_si'];
        $emgContact->relationship_ta = $user['eec_relationship_ta'];
        $emgContact->address = $user['eec_address'];
        $emgContact->address_si = $user['eec_address_si'];
        $emgContact->address_ta = $user['eec_address_ta'];
        $emgContact->home_phone = $user['eec_home_no'];
        $emgContact->office_phone = $user['eec_mobile_no'];
        $emgContact->mobile_phone =$user['eec_office_no'];
        

        
        $result=$service->saveEmergencyContact($emgContact);

         $this->assertTrue($result);
 }
    }

    public function testGetEmergencyContactById(){


        $service = new EmployeeService();
        $result = $service->getEmergencyContactById(1,1);

        // die(print_r($result));die;
        $testCase = $this->testCases['EmergancyContacts'];



        $this->assertEquals($testCase[1]['emp_number'], $result[0]['emp_number']);
        $this->assertEquals($testCase[1]['eec_name'], $result[0]['name']);
            

    }
    public function testSaveDependent(){


        $service = new EmployeeService();
 foreach ($this->testCases['Dependent'] as $key => $user) {

     $dependent = new EmpDependent();

        $dependent->emp_number = $user['emp_number'];
        $dependent->seqno = $user['ed_seqno'];
        $dependent->name = $user['ed_name'];
        $dependent->name_si = $user['ed_name_si'];
        $dependent->name_ta = $user['ed_name_ta'];

        
        $dependent->rel_code = $user['rel_code'];

        $dependent->birthday = $user['ed_birthdays'];

        $dependent->workplace = $user['ed_workplace'];
        $dependent->workplace_si = $user['ed_workplace_si'];
        $dependent->workplace_ta = $user['ed_workplace_ta'];

        $dependent->education_center = $user['ed_education_center'];
        $dependent->education_center_si = $user['ed_education_center_si'];
        $dependent->education_center_ta = $user['ed_education_center_ta'];

        $dependent->address = $user['ed_address'];
        $dependent->address_si = $user['ed_address_si'];
        $dependent->address_ta = $user['ed_address_ta'];

        $dependent->comments = $user['ed_comments'];
        $dependent->comments_si = $user['ed_comments_si'];
        $dependent->comments_ta = $user['ed_comments_ta'];


        $result=$service->saveEmergencyContact($dependent);

         $this->assertTrue($result);
 }
    }

    public function testGetdependentById(){


         $service = new EmployeeService();
            $result = $service->getDependentContactById(1,1);

        // die(print_r($result));die;
        $testCase = $this->testCases['Dependent'];



        $this->assertEquals($testCase[1]['emp_number'], $result[0]['emp_number']);
        $this->assertEquals($testCase[1]['ed_name'], $result[0]['name']);


    }

    public function testsaveJobSalDetails() {
        $EmployeeDao = new EmployeeDao();
        $service = new EmployeeService();



        foreach ($this->testCases['Employee'] as $key => $user) {

            $bt = new Employee();



            $bt->setEmp_number($user['emp_number']);

            //$bt->setEthnic_race_code($user['ethnic_race_code']);
            $bt->setService_code($user['service_code']);
            $bt->setGrade_code($user['grade_code']);
            $bt->setNation_code($user['nation_code']);

            $bt->setClass_code($user['class_code']);


            $bt->setJob_title_code($user['job_title_code']);
            $bt->setWork_station($user['work_station']);


            $bt->setEmp_status($user['emp_status']);
            $bt->setRlg_code($user['rlg_code']);
            $bt->setLang_code($user['lang_code']);
            $bt->setCou_code($user['cou_code']);


            $bt->setEmp_attendance_no($user['emp_attendance_no']);

            $bt->setEmp_salary_no($user['emp_salary_no']);

            $bt->setEmp_public_app_date($user['emp_public_app_date']);
            $bt->setEmp_public_com_date($user['emp_public_com_date']);
            $bt->setEmp_app_date($user['emp_app_date']);
            $bt->setEmp_com_date($user['emp_com_date']);
            $bt->setEmp_rec_method($user['emp_rec_method']);
            $bt->setEmp_rec_method_desc($user['emp_rec_method_desc']);
            $bt->setEmp_rec_method_desc_si($user['emp_rec_method_desc_si']);
            $bt->setEmp_rec_method_desc_ta($user['emp_rec_method_desc_ta']);
            $bt->setEmp_rec_medium($user['emp_rec_medium']);
            $bt->setEmp_active_hrm_flg($user['emp_active_hrm_flg']);
            $bt->setEmp_active_att_flg($user['emp_active_att_flg']);
            $bt->setEmp_wop_flg($user['emp_wop_flg']);
            $bt->setEmp_wop_no($user['emp_wop_no']);
            $bt->setEmp_confirm_flg($user['emp_confirm_flg']);
            $bt->setEmp_confirm_date($user['emp_confirm_date']);
            $bt->setEmp_prob_ext_flg($user['emp_prob_ext_flg']);
            $bt->setEmp_prob_from_date($user['emp_prob_from_date']);
            $bt->setEmp_prob_to_date($user['emp_prob_to_date']);
            $bt->setEmp_salary_scale($user['emp_salary_scale']);
            $bt->setEmp_salary_scale_si($user['emp_salary_scale_si']);
            $bt->setEmp_salary_scale_ta($user['emp_salary_scale_ta']);
            $bt->setEmp_basic_salary($user['emp_basic_salary']);
            $bt->setEmp_salary_inc_date($user['emp_salary_inc_date']);
            $bt->setTerminated_date($user['terminated_date']);
            $bt->setTermination_reason($user['termination_reason']);
            $bt->setWork_station($user['work_station']);

            $result = $service->saveJobDetails($bt);



            $this->assertTrue($result);
        }
    }

    public function testReadJobSalDetailbyId() {

        $service = new EmployeeService();

        $empDao = new EmployeeDao();
        $result = $service->getJobSalDetailsById(1);
        $testCase = $this->testCases['Employee'];


        $this->assertEquals($testCase[$j + 1]['empNumber'], $reasons[0]['empNumber']);
        $this->assertEquals($testCase[$j + 1]['employeeId'], $reasons[0]['employeeId']);
    }

    public function testsaveEbExam() {

        $service = new EmployeeService();
        foreach ($this->testCases['EBExam'] as $key => $user) {

            $ebExam = new EBExam();

            $ebExam->ebexam_id = $user['ebexam_id'];
            $ebExam->emp_number = $user['emp_number'];
            $ebExam->ebexam_date = $user['ebexam_date'];
            $ebExam->ebexam_description = $user['ebexam_description'];
            $ebExam->ebexam_description_si = $user['ebexam_description_si'];
            $ebExam->ebexam_description_ta = $user['ebexam_description_ta'];
            $ebExam->ebexam_results = $user['ebexam_results'];
            $ebExam->ebexam_results_si = $user['ebexam_results_si'];
            $ebExam->ebexam_results_ta = $user['ebexam_results_ta'];
            $ebExam->ebexam_status = $user['ebexam_status'];

            $result = $service->saveEMBexam($ebExam);

            $this->assertTrue($result);
        }
    }

    public function testReadEBExam() {

        $service = new EmployeeService();

        $result = $service->getEBexamById(1, 1);
        $testCase = $this->testCases['EBExam'];

        $abc = $result;
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['ebexam_id'], $reasons['ebexam_id']);
                $this->assertEquals($testCase[$j + 1]['ebexam_description'], $reasons['ebexam_description']);
            }
        }
    }

    public function testSaveServiceRecord() {


        $service = new EmployeeService();
        foreach ($this->testCases['ServiceRecord'] as $key => $user) {

            $serRec = new ServiceHistory();
            $serRec->esh_code = $user['esh_code'];

            $serRec->emp_number = $user['emp_number'];



            $serRec->esh_name = $user['esh_name'];
            $serRec->esh_name_si = $user['esh_name_si'];
            $serRec->esh_name_ta = $user['esh_name_ta'];

            $serRec->esh_designation = $user['esh_designation'];
            $serRec->esh_designation_si = $user['esh_designation_si'];
            $serRec->esh_designation_ta = $user['esh_designation_ta'];

            $serRec->esh_district = $user['esh_district'];
            $serRec->esh_district_si = $user['esh_district_si'];
            $serRec->esh_district_ta = $user['esh_district_ta'];
            $serRec->esh_from_date = $user['esh_from_date'];
            $serRec->esh_to_date = $user['esh_to_date'];
            $result = $service->saveServiceRecord($serRec);

            $this->assertTrue($result);
        }
    }

    public function testReadServiceRecord() {

        $service = new EmployeeService();

        $result = $service->getServiceRecordByID(1, 1);

        $testCase = $this->testCases['ServiceRecord'];

        $abc = $result;
        foreach ($abc as $reasons) {

            for ($i = 0; $i < count($abc); $i++) {
                $j = $i;
                $this->assertEquals($testCase[$j + 1]['esh_code'], $reasons['esh_code']);
                $this->assertEquals($testCase[$j + 1]['esh_name'], $reasons['esh_name']);
            }
        }
    }

    public function testSaveEducation() {

        $service = new EmployeeService();
        foreach ($this->testCases['Eduction'] as $key => $user) {

            $empEducation = new EmployeeEducation();
            $empEducation->emp_number = $user['emp_number'];
            $empEducation->edu_code = $user['edu_code'];
            $empEducation->edu_institute = $user['edu_institute'];
            $empEducation->edu_institute_si = $user['edu_institute_si'];
            $empEducation->edu_institute_ta = $user['edu_institute_ta'];
            $empEducation->edu_stream = $user['edu_stream'];
            $empEducation->edu_stream_si = $user['edu_stream_si'];
            $empEducation->edu_stream_ta = $user['edu_stream_ta'];
            $empEducation->edu_index_no = $user['edu_index_no'];
            $empEducation->edu_start_date = $user['edu_start_date'];
            $empEducation->edu_end_date = $user['edu_end_date'];


            $empEducation->edu_confirmed_flg = $user['edu_confirmed_flg'];


            $result = $service->saveEducation($empEducation);

            $this->assertTrue($result);
        }
    }

}

?>
