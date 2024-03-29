<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEmployee extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vw_hs_hr_employee');
        $this->hasColumn('emp_number as empNumber', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('employee_id as employeeId', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('title_code', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_initials', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('emp_initials_si', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('emp_initials_ta', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('emp_names_of_initials', 'string', 120, array(
             'type' => 'string',
             'length' => '120',
             ));
        $this->hasColumn('emp_names_of_initials_si', 'string', 120, array(
             'type' => 'string',
             'length' => '120',
             ));
        $this->hasColumn('emp_names_of_initials_ta', 'string', 120, array(
             'type' => 'string',
             'length' => '120',
             ));
        $this->hasColumn('emp_firstname as firstName', 'string', 100, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => '100',
             ));
        $this->hasColumn('emp_firstname_si as firstName_si', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_firstname_ta as firstName_ta', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_lastname as lastName', 'string', 100, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => '100',
             ));
        $this->hasColumn('emp_lastname_si as lastName_si', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_lastname_ta as lastName_ta', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_display_name', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('emp_display_name_si', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('emp_display_name_ta', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('emp_app_letter_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_personal_file_no', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             ));
        $this->hasColumn('ethnic_race_code', 'string', 13, array(
             'type' => 'string',
             'length' => '13',
             ));
        $this->hasColumn('service_code', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('grade_code', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('slt_scale_year', 'integer', 10, array(
             'type' => 'integer',
             'length' => '10',
             ));
        $this->hasColumn('level_code', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('nation_code', 'string', 13, array(
             'type' => 'string',
             'length' => '13',
             ));
        $this->hasColumn('gender_code', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('class_code', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('marst_code', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_married_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('job_title_code', 'string', 13, array(
             'type' => 'string',
             'length' => '13',
             ));
        $this->hasColumn('act_job_title_code', 'string', 13, array(
             'type' => 'string',
             'length' => '13',
             ));
        $this->hasColumn('work_station', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('act_work_station', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('emp_nic_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_nic_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_status', 'string', 13, array(
             'type' => 'string',
             'length' => '13',
             ));
        $this->hasColumn('rlg_code', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('lang_code', 'string', 13, array(
             'type' => 'string',
             'length' => '13',
             ));
        $this->hasColumn('cou_code', 'string', 2, array(
             'type' => 'string',
             'length' => '2',
             ));
        $this->hasColumn('emp_birthday', 'date', 25, array(
             'type' => 'date',
             'length' => '25',
             ));
        $this->hasColumn('emp_birth_location', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('emp_birth_location_si', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('emp_birth_location_ta', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('emp_passport_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_attendance_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_other_file_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_salary_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_barcode_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_public_app_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_public_com_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_app_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_com_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_rec_method', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_rec_method_desc', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_rec_method_desc_si', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_rec_method_desc_ta', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_rec_medium', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_active_hrm_flg', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_active_att_flg', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_active_pr_flg', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_wop_flg', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_wop_no', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('emp_confirm_flg', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_confirm_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_prob_ext_flg', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_prob_from_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_prob_to_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_salary_scale', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_salary_scale_si', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_salary_scale_ta', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_basic_salary', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
             ));
        $this->hasColumn('emp_salary_inc_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('terminated_date', 'date', 25, array(
             'type' => 'date',
             'length' => '25',
             ));
        $this->hasColumn('termination_reason', 'string', 256, array(
             'type' => 'string',
             'length' => '256',
             ));
        $this->hasColumn('emp_pension_no', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             ));
        $this->hasColumn('emp_resign_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_retirement_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('hie_code_1', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_2', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_3', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_4', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_5', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_6', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_7', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_8', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_9', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('hie_code_10', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_1', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_2', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_3', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_4', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_5', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_6', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_7', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_8', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_9', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('act_hie_code_10', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('emp_ldap_flag', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
        $this->hasColumn('emp_ispaydownload', 'integer', 1, array(
             'type' => 'integer',
             'length' => '1',
             ));
    }

    public function setUp()
    {
        $this->hasOne('CompanyStructure as subDivision', array(
             'local' => 'work_station',
             'foreign' => 'id'));

        $this->hasOne('JobTitle as jobTitle', array(
             'local' => 'job_title_code',
             'foreign' => 'jobtit_code'));

        $this->hasOne('JobTitle as actjobTitle', array(
             'local' => 'act_job_title_code',
             'foreign' => 'jobtit_code'));

        $this->hasOne('EmployeeStatus as employeeStatus', array(
             'local' => 'emp_status',
             'foreign' => 'estat_code'));

        $this->hasMany('Employee as supervisors', array(
             'refClass' => 'ReportTo',
             'local' => 'erep_sub_emp_number',
             'foreign' => 'erep_sup_emp_number'));

        $this->hasMany('EmpDependent as dependents', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpEmergencyContact as emergencyContacts', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpPassport as immigrationDocuments', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpWorkExperience as workExperience', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeEducation as educationList', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeSkill as skills', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeLanguage as languages', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeLicense as licenses', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeMemberDetail as memberships', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpBasicsalary as salaryDetails', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpDirectdebit as directDebits', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpLocationHistory as locationHistoryItems', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpJobtitleHistory as jobTitleHistoryItems', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpSubdivisionHistory as subdivisionHistoryItems', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpContract as contracts', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpAttachment as attachments', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('EmpPicture as picture', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('ReportTo as reportTo', array(
             'local' => 'empNumber',
             'foreign' => 'erep_sub_emp_number'));

        $this->hasOne('ServiceDetails', array(
             'local' => 'service_code',
             'foreign' => 'service_code'));

        $this->hasOne('Grade', array(
             'local' => 'grade_code',
             'foreign' => 'grade_code'));

        $this->hasOne('GradeSlot', array(
             'local' => 'slt_scale_year',
             'foreign' => 'slt_id'));

        $this->hasOne('EmpTitle', array(
             'local' => 'title_code',
             'foreign' => 'title_code'));

        $this->hasOne('Gender', array(
             'local' => 'gender_code',
             'foreign' => 'gender_code'));

        $this->hasOne('MaritalStatus', array(
             'local' => 'marst_code',
             'foreign' => 'marst_code'));

        $this->hasOne('Religion', array(
             'local' => 'rlg_code',
             'foreign' => 'rlg_code'));

        $this->hasOne('EmpClass', array(
             'local' => 'class_code',
             'foreign' => 'class_code'));

        $this->hasOne('EmpContact', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('EMPEBExam', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('Users', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('Level', array(
             'local' => 'level_code',
             'foreign' => 'level_code'));

        $this->hasOne('CompanyStructure as actsubDivision', array(
             'local' => 'act_work_station',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_1', array(
             'local' => 'hie_code_1',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_2', array(
             'local' => 'hie_code_2',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_3', array(
             'local' => 'hie_code_3',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_4', array(
             'local' => 'hie_code_4',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_5', array(
             'local' => 'hie_code_5',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_6', array(
             'local' => 'hie_code_6',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_7', array(
             'local' => 'hie_code_7',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_8', array(
             'local' => 'hie_code_8',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_9', array(
             'local' => 'hie_code_9',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as hie_code_10', array(
             'local' => 'hie_code_10',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_1', array(
             'local' => 'act_hie_code_1',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_2', array(
             'local' => 'act_hie_code_2',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_3', array(
             'local' => 'act_hie_code_3',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_4', array(
             'local' => 'act_hie_code_4',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_5', array(
             'local' => 'act_hie_code_5',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_6', array(
             'local' => 'act_hie_code_6',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_7', array(
             'local' => 'act_hie_code_7',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_8', array(
             'local' => 'act_hie_code_8',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_9', array(
             'local' => 'act_hie_code_9',
             'foreign' => 'id'));

        $this->hasOne('CompanyStructure as act_hie_code_10', array(
             'local' => 'act_hie_code_10',
             'foreign' => 'id'));

        $this->hasOne('PayrollEmployee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('Employee as subordinates', array(
             'refClass' => 'ReportTo',
             'local' => 'erep_sup_emp_number',
             'foreign' => 'erep_sub_emp_number'));

        $this->hasMany('EmpChild', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('EmpUsTax as usTax', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('Location as employees', array(
             'refClass' => 'EmpLocation',
             'local' => 'emp_number',
             'foreign' => 'loc_code'));

        $this->hasMany('CompanyStructure', array(
             'local' => 'empNumber',
             'foreign' => 'emp_number'));

        $this->hasMany('CompanyStructureDetails', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('JobCategory', array(
             'local' => 'eeo_cat_code',
             'foreign' => 'eec_code'));

        $this->hasMany('EmployeeLicense', array(
             'local' => 'empNumber',
             'foreign' => 'empNumber'));

        $this->hasOne('Nationality', array(
             'local' => 'nation_code',
             'foreign' => 'nat_code'));

        $this->hasOne('EthnicRace', array(
             'local' => 'ethnic_race_code',
             'foreign' => 'ethnic_race_code'));

        $this->hasMany('ProjectAdmin', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeWorkShift', array(
             'local' => 'empNumber',
             'foreign' => 'emp_number'));

        $this->hasMany('Transfer', array(
             'local' => 'empNumber',
             'foreign' => 'trans_emp_number'));

        $this->hasMany('Promotion', array(
             'local' => 'empNumber',
             'foreign' => 'emp_number'));

        $this->hasMany('TransferRequest', array(
             'local' => 'empNumber',
             'foreign' => 'emp_number'));

        $this->hasMany('PromotionChecklistDetail', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('RetirementExtension', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('TrainAssign', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('ServiceHistory', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('Benifit', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('Attendance', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('DisEmployeeInvolved', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('Incidents', array(
             'local' => 'emp_number',
             'foreign' => 'dis_inc_reportedby'));

        $this->hasMany('ChecklistDetail', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LeaveApplication', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LeaveEntitlement', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpDisAction', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PerformanceEvaluationSupervisor', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PerformanceEvaluationEmployee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PerformanceEvaluationEmployeeProject', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PerformanceEvaluationEmployeeDuty', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PerformanceEmployeeProject', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('WFGroupAppPerson', array(
             'local' => 'emp_number',
             'foreign' => 'wf_main_app_employee'));

        $this->hasMany('WfMainAppPerson', array(
             'local' => 'emp_number',
             'foreign' => 'wf_main_app_employee'));

        $this->hasMany('WfMain', array(
             'local' => 'emp_number',
             'foreign' => 'wfmain_approving_emp_number'));

        $this->hasMany('VacancyRequest', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LoanApplication', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LoanEntitlementDetail', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LoanHeader', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LoanProcessed', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LoanSchedule', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('LoanSettlement', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeDefLevel', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PayrollIncrement', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('OtherInstitute', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('Reinstatement', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PayRollEligibility', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmpActiveWorkstation', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PayRollBankTransfer', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PayRollEmployeeBank', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('Notice', array(
             'local' => 'emp_number',
             'foreign' => 'create_emp_number'));

        $this->hasMany('NoticeEmployee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PayRollProcessedEmp', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('hsPrBankDisketteProcessEmployee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('payprocessCapability', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('hsPrPayprocess', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('hsPrProcessedtxn', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('PayrollIncrementCancel', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EducationEMPHead', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('OfficeOut', array(
             'local' => 'emp_number',
             'foreign' => 'oo_emp_number'));

        $this->hasMany('OfficeOutDetails', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EvaluationFunctionsTaskComments', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EvaluationSkillEmployeeComments', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EvaluationTSEmployeeComments', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('NotificationEmployee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('EmployeeSignature', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));
    }
}