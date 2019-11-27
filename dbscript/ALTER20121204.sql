CREATE TABLE `hs_hr_education_type` (
`edu_type_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`edu_type_name` VARCHAR( 200 ) NULL DEFAULT NULL ,
`edu_type_name_si` VARCHAR( 200 ) NULL DEFAULT NULL ,
`edu_type_name_ta` VARCHAR( 200 ) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `hs_hr_edu_subject` (
`subj_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`edu_type_id` INT NULL DEFAULT NULL ,
`subj_name` VARCHAR( 200 ) NULL DEFAULT NULL ,
`subj_name_si` VARCHAR( 200 ) NULL DEFAULT NULL ,
`subj_name_ta` VARCHAR( 200 ) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_edu_subject`
       	ADD CONSTRAINT `hs_hr_education_type_edu_type_id`
	FOREIGN KEY (`edu_type_id`)
        REFERENCES `hs_hr_education_type`(`edu_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE TABLE `hs_hr_edu_year_grade` (
`grd_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`edu_type_id` INT NULL DEFAULT NULL ,
`grd_year` INT NULL DEFAULT NULL ,
`grd_name` VARCHAR( 200 ) NULL DEFAULT NULL ,
`grd_desc` VARCHAR( 200 ) NULL DEFAULT NULL ,
`grd_mark` VARCHAR( 200 ) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_edu_year_grade`
       	ADD CONSTRAINT `education_type_year_grade_type_id`
	FOREIGN KEY (`edu_type_id`)
        REFERENCES `hs_hr_education_type`(`edu_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE TABLE `hs_hr_edu_emp_head` (
`eduh_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`edu_type_id` INT NULL DEFAULT NULL ,
`emp_number` INT(7) NULL DEFAULT NULL ,
`grd_year` INT(4) NULL DEFAULT NULL ,
`eduh_indexno` VARCHAR( 200 ) NULL DEFAULT NULL ,
`eduh_institute` VARCHAR( 200 ) NULL DEFAULT NULL 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_edu_emp_head`
       	ADD CONSTRAINT `hs_hr_edu_emp_head_year_grade_type_id`
	FOREIGN KEY (`edu_type_id`)
        REFERENCES `hs_hr_education_type`(`edu_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_edu_emp_head`
       	ADD CONSTRAINT `hs_hr_edu_emp_head_hs_hr_employee`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE TABLE `hs_hr_edu_emp_detail` (
`edud_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`eduh_id` INT NULL DEFAULT NULL ,
`subj_id` INT NULL DEFAULT NULL ,
`grd_id` INT NULL DEFAULT NULL ,
`lang_code` VARCHAR( 13 ) NULL DEFAULT NULL ,
`edud_comment` VARCHAR( 200 ) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_edu_emp_detail`
       	ADD CONSTRAINT `hs_hr_edu_emp_detail_hs_hr_edu_emp_head`
	FOREIGN KEY (`eduh_id`)
        REFERENCES `hs_hr_edu_emp_head`(`eduh_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_edu_emp_detail`
       	ADD CONSTRAINT `hs_hr_edu_emp_detail_hs_hr_edu_subject`
	FOREIGN KEY (`subj_id`)
        REFERENCES `hs_hr_edu_subject`(`subj_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_edu_emp_detail`
       	ADD CONSTRAINT `hs_hr_edu_year_grade_hs_hr_edu_emp_head`
	FOREIGN KEY (`grd_id`)
        REFERENCES `hs_hr_edu_year_grade`(`grd_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_edu_emp_detail`
       	ADD CONSTRAINT `hs_hr_edu_year_grade_hs_hr_language`
	FOREIGN KEY (`lang_code`)
        REFERENCES `hs_hr_language`(`lang_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_edu_emp_head` ADD `eduh_zscorgdp` FLOAT NULL DEFAULT NULL ,
ADD `eduh_slrank` INT NULL DEFAULT NULL ;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/pim/EmpEducation' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2015;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'deleteEmpEducation,saveEmpEducation,LoadSubjects,LoadGrade' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2015;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/admin/EducationType',
`sm_mnuitem_dependency` = 'SaveEducationType,DeleteEducationType' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1010;

INSERT INTO  `hs_hr_sm_mnuitem` (`sm_mnuitem_id` ,`sm_mnuitem_name` ,`sm_mnuitem_name_si` ,`sm_mnuitem_name_ta` ,`sm_mnuitem_parent` ,`sm_mnuitem_level` ,`sm_mnuitem_webpage_url` ,`sm_mnuitem_position` ,`mod_id` ,
`sm_mnuitem_dependency`)
VALUES (null ,  'Education Subject',  'විෂයන්',  'Education Subject ta',  '1009',  '2',  './symfony/web/index.php/admin/EducationSubject',  '01.03.05',  'MOD001',  'SaveEducationSubject,DeleteEducationSubject,UpdateEducationSubject');

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) 
VALUES (NULL, 'MOD001', ' hs_hr_edu_subject', '1', 'Education Subject', 'Education Subject si', 'Education Subject ta');

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) 
VALUES (NULL, 'MOD001', ' hs_hr_edu_year_grade', '1', 'Education Year Grade', 'Education Year Grade si', 'Education Year Grade ta');

INSERT INTO  `hs_hr_sm_mnuitem` (`sm_mnuitem_id` ,`sm_mnuitem_name` ,`sm_mnuitem_name_si` ,`sm_mnuitem_name_ta` ,`sm_mnuitem_parent` ,`sm_mnuitem_level` ,`sm_mnuitem_webpage_url` ,`sm_mnuitem_position` ,`mod_id` ,
`sm_mnuitem_dependency`)
VALUES (null ,  'Education Grade Year',  'වාර්ෂික විෂයන්',  'Education Grade Year ta',  '1009',  '2',  './symfony/web/index.php/admin/EducationYearGrade',  '01.03.06',  'MOD001',  'SaveEducationYearGrade,DeleteEducationYearGrade,UpdateEducationYearGrade');

-- EB Exams 2012-12-11
CREATE TABLE `hs_hr_eb_subject` (
`ebs_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`ebs_name` VARCHAR( 200 ) NULL DEFAULT NULL ,
`ebs_name_si` VARCHAR( 200 ) NULL DEFAULT NULL ,
`ebs_name_ta` VARCHAR( 200 ) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `hs_hr_eb_master_head` (
`ebh_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`grade_code` INT(4) NULL DEFAULT NULL ,
`ebh_exp_year` INT NULL DEFAULT NULL ,
`ebh_exam_name` VARCHAR( 200 ) NULL DEFAULT NULL ,
`ebh_exam_name_si` VARCHAR( 200 ) NULL DEFAULT NULL ,
`ebh_exam_name_ta` VARCHAR( 200 ) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_eb_master_head`
       	ADD CONSTRAINT `hs_hr_eb_master_head_edu_grade_code`
	FOREIGN KEY (`grade_code`)
        REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE TABLE `hs_hr_eb_master_detail` (
`ebd_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`ebh_id` INT NULL DEFAULT NULL ,
`ebs_id` INT NULL DEFAULT NULL ,
`ebd_pass_mark` INT NULL DEFAULT NULL 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_eb_master_detail`
       	ADD CONSTRAINT `hs_hr_eb_master_head_ebh_id`
	FOREIGN KEY (`ebh_id`)
        REFERENCES `hs_hr_eb_master_head`(`ebh_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_eb_master_detail`
       	ADD CONSTRAINT `hs_hr_eb_subject_ebs_id`
	FOREIGN KEY (`ebs_id`)
        REFERENCES `hs_hr_eb_subject`(`ebs_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE TABLE `hs_hr_eb_employee` (
`ebe_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`emp_number` INT(7) NULL DEFAULT NULL ,
`ebh_id` INT NULL DEFAULT NULL ,
`ebd_id` INT NULL DEFAULT NULL ,
`ebe_marks` INT NULL DEFAULT NULL ,
`ebe_start_date` date DEFAULT NULL,
`ebe_end_date` date DEFAULT NULL,
`ebe_complete_date` date DEFAULT NULL,
`ebe_flg_pass` INT NULL DEFAULT NULL ,
`ebe_attepmt` INT NULL DEFAULT NULL ,
`ebe_comment` VARCHAR( 200 ) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_eb_employee`
       	ADD CONSTRAINT `hs_hr_eb_employee_hs_hr_employee`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_eb_employee`
       	ADD CONSTRAINT `hs_hr_eb_employee_ebh_id`
	FOREIGN KEY (`ebh_id`)
        REFERENCES `hs_hr_eb_master_head`(`ebh_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_eb_employee`
       	ADD CONSTRAINT `hs_hr_eb_employee_ebd_id`
	FOREIGN KEY (`ebd_id`)
        REFERENCES `hs_hr_eb_master_detail`(`ebd_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/pim/Emp_EB_Exam',
`sm_mnuitem_dependency` = 'loadEmp_EB_Exam,deleteEmp_EB_Exam,saveEmp_EB_Exam' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2019;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'loadEmp_EB_Exam,deleteEmp_EB_Exam,saveEmp_EB_Exam,LoadEMPEBSubjects,LoadEMPEBSubjectHistory' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2019;

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) 
VALUES (NULL, 'MOD002', 'hs_hr_eb_employee', '1', 'Employee EB Exam', 'Employee EB Exam si', 'Employee EB Exam ta');

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) 
VALUES (NULL, 'MOD001', 'hs_hr_eb_master_head', '1', 'EB Exam', 'EB Exam si', 'EB Exam ta');

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) 
VALUES (NULL, 'MOD001', 'hs_hr_eb_subject', '1', 'EB Exam Subject', 'EB Exam Subject si', 'EB Exam Subject ta');

INSERT INTO  `hs_hr_sm_mnuitem` (`sm_mnuitem_id` ,`sm_mnuitem_name` ,`sm_mnuitem_name_si` ,`sm_mnuitem_name_ta` ,`sm_mnuitem_parent` ,`sm_mnuitem_level` ,`sm_mnuitem_webpage_url` ,`sm_mnuitem_position` ,`mod_id` ,
`sm_mnuitem_dependency`)
VALUES (null ,  'EB Exam',  'ඊ.බී විභාග',  'EB Exam ta',  '1009',  '2',  './symfony/web/index.php/admin/EB_Exam',  '01.03.07',  'MOD001',  'SaveEB_Exam,DeleteEB_Exam');

INSERT INTO  `hs_hr_sm_mnuitem` (`sm_mnuitem_id` ,`sm_mnuitem_name` ,`sm_mnuitem_name_si` ,`sm_mnuitem_name_ta` ,`sm_mnuitem_parent` ,`sm_mnuitem_level` ,`sm_mnuitem_webpage_url` ,`sm_mnuitem_position` ,`mod_id` ,
`sm_mnuitem_dependency`)
VALUES (null ,  'EB Exam Subject',  'ඊ.බී විභාග',  'EB Exam Subject ta',  '1009',  '2',  './symfony/web/index.php/admin/EBSubject',  '01.03.08',  'MOD001',  'SaveEBSubject,DeleteEBSubject');

-- 2013-01-17
INSERT INTO `hs_hr_religion` (`rlg_code` ,`rlg_name` ,`rlg_name_si` ,`rlg_name_ta`)
VALUES (NULL , 'Christian', 'ක්‍රිස්තියානි', 'Christian_ta');

ALTER TABLE `hs_hr_rec_candidate` CHANGE `rec_can_candidate_name` `rec_can_candidate_name` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; 

ALTER TABLE `hs_hr_rec_candidate` ADD `rec_can_candidate_name_si` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `rec_can_candidate_name` ,
ADD `rec_can_candidate_name_ta` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `rec_can_candidate_name_si` ;

ALTER TABLE `hs_hr_rec_candidate` ADD `rec_can_address_si` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `rec_can_address` ,
ADD `rec_can_address_ta` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `rec_can_address_si`; 

ALTER TABLE `hs_hr_edu_emp_head` ADD `eduh_flg` INT( 1 ) NULL DEFAULT NULL ,
ADD `eduh_descreption` VARCHAR( 1000 ) NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_leave_application` ADD `leave_app_act_apr_flg` VARCHAR( 1 ) NULL DEFAULT NULL;

ALTER TABLE `hs_hr_leave_type_config` ADD `leave_type_short_leave_flg` VARCHAR( 1 ) NULL DEFAULT NULL AFTER `leave_type_need_approval_flg`;
  
INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(12008, 'Leave Approve', 'නිවාඩු අනුමත කිරීම', 'Leave Approve ta', 12000, 1, './symfony/web/index.php/Leave/LeaveApprovalSearch', '12.08', 'MOD012', NULL);


INSERT INTO `hs_hr_district` (`district_id`, `district_name`, `district_name_si`, `district_name_ta`) VALUES
(null, 'Ampara', 'Ampara si ', 'Ampara ta'),
(null, 'Anuradhapura', 'Anuradhapura si ', 'Anuradhapura ta'),
(null, 'Badulla', 'Badulla si ', 'Badulla ta'),
(null, 'Batticaloa', 'Batticaloa si ', 'Batticaloa ta'),
(null, 'Colombo', 'Colombo si ', 'Colombo ta'),
(null, 'Galle', 'Galle si ', 'Galle ta'),
(null, 'Gampaha', 'Gampaha si ', 'Gampaha ta'),
(null, 'Hambantota', 'Hambantota si ', 'Hambantota ta'),
(null, 'Jaffna', 'Jaffna si ', 'Jaffna ta'),
(null, 'Kalutara', 'Kalutara si ', 'Kalutara ta'),
(null, 'Kandy', 'Kandy si ', 'Kandy ta'),
(null, 'Kegalle', 'Kegalle si ', 'Kegalle ta'),
(null, 'Kilinochchi', 'Kilinochchi si ', 'Kilinochchi ta'),
(null, 'Kurunegala', 'Kurunegala si ', 'Kurunegala ta'),
(null, 'Mannar', 'Mannar si ', 'Mannar ta'),
(null, 'Matale', 'Matale si ', 'Matale ta'),
(null, 'Matara', 'Matara si ', 'Matara ta'),
(null, 'Moneragala', 'Moneragala si ', 'Moneragala ta'),
(null, 'Mullaitivu', 'Mullaitivu si ', 'Mullaitivu ta'),
(null, 'Nuwara Eliya', 'Nuwara Eliya si ', 'Nuwara Eliya ta'),
(null, 'Polonnaruwa', 'Polonnaruwa si ', 'Polonnaruwa ta'),
(null, 'Puttalam', 'Puttalam si ', 'Puttalam ta'),
(null, 'Ratnapura', 'Ratnapura si ', 'Ratnapura ta'),
(null, 'Trincomalee', 'Trincomalee si ', 'Trincomalee ta'),
(null, 'Vavuniya', 'Vavuniya si ', 'Vavuniya ta');




drop view if exists  vw_hs_hr_employee;
CREATE VIEW vw_hs_hr_employee  as
select * from hs_hr_employee e where CASE WHEN getUser()=''
	THEN
	 e.emp_number is not null  
	ELSE
	e.emp_number = getUser() and ((select sm_capability_id from hs_hr_users where emp_number = e.emp_number) = 4 )

end;


-- employee null

drop view if exists  vw_hs_hr_employee;


CREATE VIEW vw_hs_hr_employee  as
select e.* from hs_hr_employee e 
 Left join hs_hr_users u on e.emp_number = u.emp_number
	WHERE CASE 
        WHEN getUser() = '' THEN 
        e.emp_number IS NOT NULL    
	ELSE 
	  CASE
        WHEN u.def_level = 4 THEN
		 e.emp_number = getUser()
	ELSE
		 e.emp_number IS NOT NULL
	 END  
END



-- Final View ICTA

drop view if exists  vw_hs_hr_employee;
CREATE VIEW vw_hs_hr_employee  as

select e.* from hs_hr_employee e 
	WHERE CASE 
        WHEN getUser() = '' THEN 
        e.emp_number IS NOT NULL
      ELSE 
           CASE 
            WHEN (select u.def_level from hs_hr_employee e 
Left join hs_hr_users u on e.emp_number = u.emp_number
where e.emp_number = getUser() ) = 1  THEN 
                  e.emp_number IS NOT NULL                 
            ELSE  
               e.emp_number = getUser()

    END
END

-- 20130305 Last function view

drop function getUserDef;

CREATE  FUNCTION `getUserDef`() RETURNS CHAR(7) DETERMINISTIC
RETURN (select u.def_level from hs_hr_employee e 
Left join hs_hr_users u on e.emp_number = u.emp_number
where e.emp_number = @empNumber)

-- drop view if exists  vw_hs_hr_employee;
CREATE VIEW vw_hs_hr_employee  as

select * from hs_hr_employee e 
	WHERE CASE 
        WHEN getUser() = '' THEN 
        e.emp_number IS NOT NULL
      ELSE 
           CASE 
            WHEN getUserDef() = 1  THEN 
                  e.emp_number IS NOT NULL   
            WHEN getUserDef() = 2  THEN 
                  e.emp_number IN (select r.erep_sub_emp_number from hs_hr_employee e 
Left join hs_hr_emp_reportto r on e.emp_number = r.erep_sub_emp_number
where r.erep_sup_emp_number = getUser() union select getUser())     
            ELSE  
               e.emp_number = getUser()

    END
END




-- Office Out OOnote

CREATE TABLE IF NOT EXISTS `hs_hr_leave_office_out` (
  `oo_id` int(11) NOT NULL AUTO_INCREMENT,
  `oo_emp_number` int(7) DEFAULT NULL,
  `oo_date` date DEFAULT NULL,
  `oo_from` varchar(10) DEFAULT NULL,
  `oo_to` varchar(10) DEFAULT NULL,
  `oo_category` varchar(1) DEFAULT NULL,
  `oo_comment` varchar(1000) DEFAULT NULL,
  `oo_vehicle_flg` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`oo_id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;


ALTER TABLE `hs_hr_leave_office_out`
	ADD CONSTRAINT `hs_hr_leave_office_out_emp_number`
	FOREIGN KEY(`oo_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;


INSERT INTO  `hs_hr_sm_mnuitem` (`sm_mnuitem_id` ,`sm_mnuitem_name` ,`sm_mnuitem_name_si` ,`sm_mnuitem_name_ta` ,`sm_mnuitem_parent` ,`sm_mnuitem_level` ,`sm_mnuitem_webpage_url` ,`sm_mnuitem_position` ,`mod_id` ,
`sm_mnuitem_dependency`)
VALUES ('12009' ,  'Out of Office Note',  'විෂයන්',  'Out of Office Note ta',  '12000',  '1',  './symfony/web/index.php/Leave/OONote',  '12.09',  'MOD012',  'DeleteOONote,UpdateOONote');

ALTER TABLE `hs_hr_leave_office_out` ADD `oo_cancel` VARCHAR( 1 ) NULL DEFAULT NULL ;
ALTER TABLE `hs_hr_leave_office_out` ADD `oo_authority` VARCHAR( 200 ) NULL DEFAULT NULL ;

ALTER TABLE `hs_hr_notice` CHANGE `notice_desc` `notice_desc` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `notice_desc_si` `notice_desc_si` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
CHANGE `notice_desc_ta` `notice_desc_ta` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `hs_hr_leave_attachment` (
  `leave_attach_id` int(20) NOT NULL AUTO_INCREMENT,
  `leave_attach_filename` varchar(200) DEFAULT NULL,
  `leave_attach_size` int(11) DEFAULT NULL,
  `leave_attach_attachment` mediumblob,
  `leave_attach_type` varchar(50) DEFAULT NULL,
  `leave_app_id` int(20) NOT NULL,
  PRIMARY KEY (`leave_attach_id`,`leave_app_id`),
  KEY `xif1hs_hr_leave_attachment` (`leave_app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_leave_attachment`
  ADD CONSTRAINT `hs_hr_leave_attachment_ibfk_1` FOREIGN KEY (`leave_app_id`) REFERENCES `hs_hr_leave_application` (`leave_app_id`);

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'AjaxLeaveValidation,AjaxLeaveHolydayValidation,SaveLeave,Leave,searchEmployee,UpdateLeave,imagepop' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =12005;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'searchEmployee,imagepop' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =12006;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'Dates,FormatDates,AjaxDaysload,EmpData,DefaultLeavedetails,AjaxEmpType,AjaxLeaveValidation,AjaxLeaveHolydayValidation,AjaxLeavecoveringEmployee,SaveLeaveuser,UpdateLeave,LeaveSearch,SaveLeaveApprove,searchEmployee,Leave,imagepop' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =12007;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'imagepop' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =12008;

-- Attendance no of working hours
ALTER TABLE `hs_hr_atn_dailyattendance` ADD `atn_work_hours` VARCHAR( 5 ) NULL DEFAULT NULL;

UPDATE hs_hr_atn_dailyattendance t, (SELECT TIMEDIFF( atn_outtime, atn_intime) as a,clk_no, emp_number, atn_date
                        FROM hs_hr_atn_dailyattendance) t1
   SET t.atn_work_hours = t1.a
 WHERE t.clk_no = t1.clk_no
   AND t.emp_number = t1.emp_number
   AND t.atn_date = t1.atn_date;

INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
    (null, 'Attendance Summary', 'පැමිනීමේ වාර්තාව', 'Attendance Summary ta', 'ICTA_Attendance_Worked_Hours_report.rptdesign', 'MOD008');

INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
    (null, 'Carder by Divisionwise', 'සේවක ව්‍යාප්තිය ', 'Carder by Divisionwise ta', 'ICTA_Carder_Divitionwise_report.rptdesign', 'MOD002');

INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
    (null, 'Carder by Employee', 'සේවක ව්‍යාප්තිය ', 'Carder by Employee ta', 'ICTA_Carder_Divition_Employee_report.rptdesign', 'MOD002');


-- notise modification 
ALTER TABLE `hs_hr_notice` ADD `email_flg` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `sms_flg` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `sms_text` VARCHAR( 200 ) NULL DEFAULT NULL;

ALTER TABLE `hs_hr_notice` ADD `create_emp_number` INT( 7 ) NULL DEFAULT NULL ,
ADD `create_date` DATE NULL ,
ADD `create_time` TIME NULL;

ALTER TABLE `hs_hr_notice`
	ADD CONSTRAINT `hs_hr_notice_emp_number`
	FOREIGN KEY(`create_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_notice_employee` (
  `ns_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_code` int(4) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `email` varchar(1) DEFAULT NULL,
  `sms` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ns_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_notice_employee`
	ADD CONSTRAINT `hs_hr_notice_employee_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_notice_employee`
	ADD CONSTRAINT `hs_hr_notice_employee_hs_hr_notice`
	FOREIGN KEY(`notice_code`)
	REFERENCES `hs_hr_notice`(`notice_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

-- Employee Notifications
CREATE TABLE IF NOT EXISTS `hs_hr_notification_employee` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_id` varchar(36) DEFAULT NULL,
  `not_message` varchar(500) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `create_emp_number` int(7) DEFAULT NULL,
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_notification_employee`
	ADD CONSTRAINT `hs_hr_notification_employee_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ; 

ALTER TABLE `hs_hr_notification_employee`
	ADD CONSTRAINT `hs_hr_notification_employee_create_emp_number`
	FOREIGN KEY(`create_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ; 

-- Leave Update
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'AjaxLeaveValidation,AjaxLeaveHolydayValidation,SaveLeave,Leave,searchEmployee,UpdateLeave,imagepop,AttachementUpdate' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 12005;

-- Leave Entitle Report
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
    (null, 'Employee Entitle Report', 'Employee Entitle Report si ', 'Employee Entitle Report ta', 'ICTA_Leave_Employee_Entitle_report.rptdesign', 'MOD012');

-- Attendance Miss punch Report
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
    (null, 'Invalid Attendance Report', 'Invalid Attendance Report si', 'Invalid Attendance Report ta', 'ICTA_Invalid_Attendance_report.rptdesign', 'MOD008');
INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(2024, 'Signature', 'අත්සන', 'Signature TA ', 2020, 2, './symfony/web/index.php/pim/Signature', '02.06.01', 'MOD002', 'Signature,searchEmployee');

-- Employee Signature
CREATE TABLE IF NOT EXISTS `hs_hr_emp_signature` (
  `emp_number` int(7) NOT NULL,
  `signature` longtext,
  PRIMARY KEY (`emp_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `hs_hr_emp_signature`
	ADD CONSTRAINT `hs_hr_emp_signature_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_signature` ADD `sig_image` MEDIUMBLOB DEFAULT NULL ;

-- Training Approval
ALTER TABLE `hs_hr_td_assignlist` ADD `app_emp_number` INT( 7 ) NULL DEFAULT NULL;
ALTER TABLE `hs_hr_td_assignlist` ADD `app_position` VARCHAR( 1 ) NULL DEFAULT NULL;
ALTER TABLE `hs_hr_td_assignlist` ADD `td_approval_type` VARCHAR( 1 ) NULL DEFAULT NULL;


ALTER TABLE `hs_hr_td_assignlist`
	ADD CONSTRAINT `hs_hr_td_assignlist_emp_number`
	FOREIGN KEY(`app_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_td_course` ADD `td_approval_type` VARCHAR( 1 ) NULL DEFAULT NULL;

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
('5016', 'Training Approve', 'Training Approve', 'Training Approve_ta', '5000', '1', './symfony/web/index.php/training/Adminapp', '05.16', 'MOD005', 'SaveAdminApp');

-- Inactive Employee List
INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(2025, 'Inactive Employee List', 'Inactive Employee List', 'Inactive Employee List TA ', 2020, 2, './symfony/web/index.php/pim/InactiveEmployeeList', '02.07', 'MOD002', 'personalDetail,addEmployee,personalDetails,employeeList,Delete,list,deleteEmployee,Jpagination,searchEmployee');

ALTER TABLE hs_hr_leave_holiday DROP INDEX leave_holiday_name_ta;
ALTER TABLE hs_hr_leave_holiday DROP INDEX leave_holiday_name_si;
ALTER TABLE hs_hr_leave_holiday DROP INDEX leave_holiday_name;

ALTER TABLE `hs_hr_leave_office_out` ADD `oo_to_date` DATE NULL DEFAULT NULL AFTER `oo_date`;

CREATE TABLE `hs_hr_leave_office_out_detail` (
`oo_id` INT NOT NULL ,
`emp_number` INT(7) NULL DEFAULT NULL ,
PRIMARY KEY (`oo_id`,`emp_number`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_leave_office_out_detail`
       	ADD CONSTRAINT `hs_hr_leave_office_out_detail_hs_hr_employee`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


ALTER TABLE `hs_hr_leave_office_out_detail`
       	ADD CONSTRAINT `hs_hr_leave_office_out_detail_hs_hr_leave_office_out`
	FOREIGN KEY (`oo_id`)
        REFERENCES `hs_hr_leave_office_out`(`oo_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
    (null, 'Attendance Less Than Summary', 'පැමිනීමේ වාර්තාව', 'Attendance Summary ta', 'ICTA_Attendance_Worked_Hours_Less_report.rptdesign', 'MOD008');
    
INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) VALUES
(NULL, 'MOD021', 'hs_hr_perf_duty', 1, 'Performance Duty', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_duty_group', 1, 'Performance Duty Group', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_evaluation', 1, 'Evaluation', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_evaluation_project', 1, 'Evaluation Project', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_evaluation_project_employee', 1, 'Evaluation Project Employee', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_evaluation_supervisor', 1, 'Evaluation Supervisor', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_evaluation_type', 1, 'Evaluation Type', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_eval_duty', 1, 'Evaluation Type', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_eval_employee', 1, 'Evaluation Employee', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_eval_employee_duty', 1, 'Evaluation Employee Duty', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_eval_employee_project', 1, 'Evaluation Employee Project', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_eval_job_role', 1, 'Evaluation Job Role', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_rate', 1, 'Evaluation Rate', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_perf_rate_detail', 1, 'Evaluation Rate Details', NULL, NULL);    

-- Performance Alters 
INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) VALUES
(NULL, 'MOD021', 'hs_hr_evl_evaluation', 1, 'Evaluation', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_evl_evaluation_employee', 1, 'Evaluation Employee', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_evl_evaluation_supervisor', 1, 'Evaluation Supervisor', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_evl_functions_tasks', 1, 'Evaluation Functions', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_evl_skill_emp', 1, 'Skill Employee', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_evl_skill_master', 1, 'Skill', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_evl_rate', 1, 'Evaluation Rate', NULL, NULL),
(NULL, 'MOD021', 'hs_hr_evl_rate_detail', 1, 'Evaluation Rate Details', NULL, NULL); 

ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `ev_employee_comment` VARCHAR( 500 ) NULL DEFAULT NULL ,
ADD `ev_employee_agree` VARCHAR( 1 ) NULL DEFAULT NULL; 


INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
(null, 'Performance Summary', 'perf', 'Performance Summary', 'ICTA_Performance_Employee_Complete_report.rptdesign', 'MOD021');

ALTER TABLE `hs_hr_evl_evaluation_employee` 
ADD `ev_name_client_1` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `ev_name_client_2` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_name_client_3` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_name_client_4` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_name_client_5` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_desg_client_1` VARCHAR( 100 ) NULL DEFAULT NULL,
ADD `ev_desg_client_2` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_desg_client_3` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_desg_client_4` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_desg_client_5` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_email_client_4` VARCHAR( 100 ) NULL DEFAULT NULL, 
ADD `ev_email_client_5` VARCHAR( 100 ) NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_evl_evaluation_employee` 
ADD `ev_level_client_1` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `ev_level_client_2` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `ev_level_client_3` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `ev_level_client_4` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `ev_level_client_5` VARCHAR( 1 ) NULL DEFAULT NULL;


ALTER TABLE `hs_hr_evl_ts_master` ADD `ts_level` VARCHAR( 1 ) NULL DEFAULT NULL;

ALTER TABLE `hs_hr_evl_ts_emp` ADD `emp_ts_email_client_4` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `emp_ts_send_url_client_4` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `emp_ts_marks_client_4` FLOAT NULL DEFAULT NULL,
ADD `emp_ts_send_url_date_client_4` DATETIME NULL DEFAULT NULL;

ALTER TABLE `hs_hr_evl_ts_emp` ADD `emp_ts_email_client_5` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `emp_ts_send_url_client_5` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `emp_ts_marks_client_5` FLOAT NULL DEFAULT NULL,
ADD `emp_ts_send_url_date_client_5` DATETIME NULL DEFAULT NULL;

CREATE TABLE `hs_hr_evl_functions_tasks_comment_detail` (
`ftc_id` INT(4) NOT NULL AUTO_INCREMENT,
`ft_id` INT(4) NULL DEFAULT NULL ,
`ftc_comment`  VARCHAR( 1000 ) NULL DEFAULT NULL ,
`ftc_date` date NULL DEFAULT NULL ,
`emp_number` INT(7) NULL DEFAULT NULL ,
PRIMARY KEY (`ftc_id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_evl_functions_tasks_comment_detail`
       	ADD CONSTRAINT `hs_hr_evl_functions_tasks_detail_hs_hr_employee`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


ALTER TABLE `hs_hr_evl_functions_tasks_comment_detail`
       	ADD CONSTRAINT `hs_hr_evl_functions_tasks_comment_detail_tasks`
	FOREIGN KEY (`ft_id`)
        REFERENCES `hs_hr_evl_functions_tasks`(`ft_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE TABLE `hs_hr_evl_skill_emp_comment_detail` (
`esc_id` INT(4) NOT NULL AUTO_INCREMENT,
`emp_skill_id` INT(4) NULL DEFAULT NULL ,
`esc_comment`  VARCHAR( 1000 ) NULL DEFAULT NULL ,
`esc_date` date NULL DEFAULT NULL ,
`emp_number` INT(7) NULL DEFAULT NULL ,
PRIMARY KEY (`esc_id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_evl_skill_emp_comment_detail`
       	ADD CONSTRAINT `hs_hr_evl_skill_emp_comment_detail_hs_hr_employee`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


ALTER TABLE `hs_hr_evl_skill_emp_comment_detail`
       	ADD CONSTRAINT `hs_hr_evl_skill_emp_detail_comment_detail_tasks`
	FOREIGN KEY (`emp_skill_id`)
        REFERENCES `hs_hr_evl_skill_emp`(`emp_skill_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE TABLE `hs_hr_evl_ts_emp_comment_detail` (
`etc_id` INT(4) NOT NULL AUTO_INCREMENT,
`emp_ts_id` INT(4) NULL DEFAULT NULL ,
`etc_comment`  VARCHAR( 1000 ) NULL DEFAULT NULL ,
`etc_date` date NULL DEFAULT NULL ,
`emp_number` INT(7) NULL DEFAULT NULL ,
PRIMARY KEY (`etc_id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_evl_ts_emp_comment_detail`
       	ADD CONSTRAINT `hs_hr_evl_ts_emp_comment_detail_hs_hr_employee`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


ALTER TABLE `hs_hr_evl_ts_emp_comment_detail`
       	ADD CONSTRAINT `hs_hr_evl_ts_emp`
	FOREIGN KEY (`emp_ts_id`)
        REFERENCES `hs_hr_evl_ts_emp`(`emp_ts_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency`='Dates,FormatDates,AjaxDaysload,EmpData,DefaultLeavedetails,AjaxEmpType,AjaxLeaveValidation,AjaxLeaveHolydayValidation,AjaxLeavecoveringEmployee,SaveLeaveuser,UpdateLeave,LeaveSearch,SaveLeaveApprove,searchEmployee,Leave,imagepop,ShortLeaveDisplayUpdate' WHERE `sm_mnuitem_id`='12007';

CREATE TABLE IF NOT EXISTS `evl_evaluation_employee_audit` (
  `audit_table_name` varchar(255) DEFAULT NULL,
  `audit_row_pk` varchar(50) DEFAULT NULL,
  `audit_field_name` varchar(255) DEFAULT NULL,
  `audit_old_value` blob,
  `audit_new_value` blob,
  `audit_datetime` datetime NOT NULL,
  `audit_user` varchar(255) DEFAULT NULL,
  `audit_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

UPDATE  `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency`='AjaxLeaveValidation,AjaxLeaveHolydayValidation,SaveLeave,Leave,searchEmployee,UpdateLeave,imagepop,AttachementUpdate,ShortLeaveDisplayUpdate' WHERE `sm_mnuitem_id`='12005';
-- Change Password 

INSERT INTO  `hs_hr_sm_mnuitem` (`sm_mnuitem_id` ,`sm_mnuitem_name` ,`sm_mnuitem_name_si` ,`sm_mnuitem_name_ta` ,`sm_mnuitem_parent` ,`sm_mnuitem_level` ,`sm_mnuitem_webpage_url` ,`sm_mnuitem_position` ,`mod_id` ,
`sm_mnuitem_dependency`)
VALUES ('13008', 'Change Password', 'Change Password', 'Change Password', '13000', '1', './symfony/web/index.php/security/ResetChangepassword', '13.08', 'MOD013', 'searchEmployee');

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(8005, 'Attendance Summary', 'පැමිණීම් සාරාංශය', 'Attendance Summary_ta', 8000, 1, './symfony/web/index.php/attendance/Summary', '08.05', 'MOD008', 'Summary');

DELIMITER $$
DROP TRIGGER hs_hr_leave_application_audit
$$
CREATE TRIGGER hs_hr_leave_application_audit AFTER UPDATE ON hs_hr_leave_application 
FOR EACH ROW 
BEGIN 
IF NOT( OLD.leave_app_id <=> NEW.leave_app_id) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id, "leave_app_id", OLD.leave_app_id, NEW.leave_app_id,NOW(),@user,"record updated"); 
END IF;

IF NOT( OLD.leave_app_applied_date <=> NEW.leave_app_applied_date) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id, "leave_app_applied_date", OLD.leave_app_applied_date, NEW.leave_app_applied_date,NOW(),@user,"record updated");
END IF;

IF NOT( OLD.emp_number<=> NEW.emp_number) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id,"emp_number",OLD.emp_number, NEW.emp_number,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_start_date<=> NEW.leave_app_start_date) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_start_date",OLD.leave_app_start_date, NEW.leave_app_start_date,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_end_date<=> NEW.leave_app_end_date) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_end_date",OLD.leave_app_end_date, NEW.leave_app_end_date,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_status<=> NEW.leave_app_status) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_status",OLD.leave_app_status, NEW.leave_app_status,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_type_id<=> NEW.leave_type_id) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_type_id",OLD.leave_type_id, NEW.leave_type_id,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_reason<=> NEW.leave_app_reason) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_reason",OLD.leave_app_reason, NEW.leave_app_reason,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_comment<=> NEW.leave_app_comment) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_comment",OLD.leave_app_comment, NEW.leave_app_comment,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_covemp_number<=> NEW.leave_app_covemp_number) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_covemp_number",OLD.leave_app_covemp_number, NEW.leave_app_covemp_number,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_type_wf_id<=> NEW.leave_type_wf_id) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_type_wf_id",OLD.leave_type_wf_id, NEW.leave_type_wf_id,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_workdays<=> NEW.leave_app_workdays) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_workdays",OLD.leave_app_workdays, NEW.leave_app_workdays,NOW(),@user,"record updated"); END IF;

IF NOT( OLD.leave_app_act_apr_flg<=> NEW.leave_app_act_apr_flg) THEN INSERT INTO hs_hr_leave_application_audit (audit_table_name, audit_row_pk, audit_field_name, audit_old_value, audit_new_value,audit_datetime,audit_user,audit_description) VALUES ( "hs_hr_leave_application", OLD.leave_app_id," leave_app_act_apr_flg",OLD.leave_app_act_apr_flg, NEW.leave_app_act_apr_flg,NOW(),@user,"record updated"); END IF;

END
