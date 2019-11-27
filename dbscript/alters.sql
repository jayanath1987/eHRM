SET NAMES 'UTF8';

ALTER TABLE  `hs_hr_compstructtree` ADD UNIQUE (
`comp_code`
);

DELETE FROM `hs_hr_formlock_details` WHERE `hs_hr_formlock_details`.`frmlock_id` = 1;


UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_dependency` =  'searchEmployee,saveCompanyStructure' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1003;

CREATE TABLE IF NOT EXISTS `hs_hr_level` (
  `level_code` int(4) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(100) NOT NULL,
  `level_name_si` varchar(100) DEFAULT NULL,
  `level_name_ta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`level_code`),
  UNIQUE KEY `level_name` (`level_name`),
  UNIQUE KEY `level_name_si` (`level_name_si`),
  UNIQUE KEY `level_name_ta` (`level_name_ta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `hs_hr_employee` ADD  `level_code` INT( 4 ) NULL DEFAULT NULL AFTER  `grade_code`;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_15`
	FOREIGN KEY(`level_code`)
	REFERENCES `hs_hr_level`(`level_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE  `hs_hr_employee` ADD  `emp_active_pr_flg` INT( 2 ) NULL DEFAULT NULL AFTER  `emp_active_att_flg`;
ALTER TABLE  `hs_hr_employee` ADD  `act_work_station` INT( 6 ) NULL DEFAULT NULL AFTER  `work_station`;
ALTER TABLE  `hs_hr_employee` ADD  `emp_work_station_hof_flg` INT( 2 ) NULL DEFAULT NULL AFTER  `act_work_station`;
ALTER TABLE  `hs_hr_employee` ADD  `emp_act_work_station_hof_flg` INT( 2 ) NULL DEFAULT NULL AFTER `emp_work_station_hof_flg`;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_16`
	FOREIGN KEY(`act_work_station`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_1` INT( 6 ) NULL DEFAULT NULL AFTER `hie_code_10`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_2` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_1`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_3` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_2`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_4` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_3`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_5` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_4`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_6` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_5`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_7` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_6`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_8` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_7`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_9` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_8`;
ALTER TABLE  `hs_hr_employee` ADD  `act_hie_code_10` INT( 6 ) NULL DEFAULT NULL AFTER `act_hie_code_9`;

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_1_ibfk_1`
	FOREIGN KEY (`act_hie_code_1`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_2_ibfk_2`
	FOREIGN KEY (`act_hie_code_2`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_3_ibfk_3`
	FOREIGN KEY (`act_hie_code_3`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_4_ibfk_4`
	FOREIGN KEY (`act_hie_code_4`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_5_ibfk_5`
	FOREIGN KEY (`act_hie_code_5`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_6_ibfk_6`
	FOREIGN KEY (`act_hie_code_6`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_7_ibfk_7`
	FOREIGN KEY (`act_hie_code_7`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_8_ibfk_8`
	FOREIGN KEY (`act_hie_code_8`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_9_ibfk_9`
	FOREIGN KEY (`act_hie_code_9`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `act_hie_code_10_ibfk_10`
	FOREIGN KEY (`act_hie_code_10`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_compstructtree_details` (
  `id` int(6) NOT NULL,
  `emp_number` int(7) NOT NULL,
  `role_group_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`,`emp_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `hs_hr_emp_role_group` (
  `role_group_id` int(4) NOT NULL AUTO_INCREMENT,
  `role_group_name` varchar(200) DEFAULT NULL,
  `role_group_name_si` varchar(200) DEFAULT NULL,
  `role_group_name_ta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`role_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_compstructtree_details`
       	ADD CONSTRAINT `hs_hr_compstructtree_details`
	FOREIGN KEY (`id`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_compstructtree_details`
       	ADD CONSTRAINT `hs_hr_compstructtree_details2`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_compstructtree_details`
       	ADD CONSTRAINT `hs_hr_compstructtree_details3`
	FOREIGN KEY (`role_group_id`)
        REFERENCES `hs_hr_emp_role_group`(`role_group_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE  `hs_hr_employee` ADD  `act_job_title_code` varchar(13) NULL DEFAULT NULL AFTER `job_title_code`;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_act_job_title_code`
	FOREIGN KEY(`act_job_title_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_grade_slot` (
  `grade_code` int(4) NOT NULL,
  `slt_scale_year` int(10) DEFAULT NULL,
  `slt_amount` float(13,2) DEFAULT NULL,
  `emp_basic_salary` float(13,2) DEFAULT NULL,
  PRIMARY KEY (`grade_code`,`slt_scale_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

ALTER TABLE `hs_hr_grade_slot`
	ADD CONSTRAINT `hs_hr_grade_slot_grade_code`
	FOREIGN KEY(`grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE  `hs_hr_employee` ADD  `slt_scale_year` INT( 10 ) NULL DEFAULT NULL AFTER `grade_code`;

ALTER TABLE  `hs_hr_grade_slot` ADD INDEX (  `slt_scale_year` );

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_grade_slot_hs_hr_employee`
	FOREIGN KEY(`slt_scale_year`)
	REFERENCES `hs_hr_grade_slot`(`slt_scale_year`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_emp_job_role` (
  `jrl_id` int(4) NOT NULL AUTO_INCREMENT,
  `jobtit_code` varchar(13) NULL,
  `level_code` int(4) NULL,
  `jrl_name` varchar(200)  NULL,
 `jrl_name_si` varchar(200)  NULL,
 `jrl_name_ta` varchar(200)  NULL,
  PRIMARY KEY (`jrl_id`),
  KEY `hs_hr_emp_job_role_jobtit_code` (`jobtit_code`),
  KEY `hs_hr_emp_job_role_level_code` (`level_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_emp_job_role`
  ADD CONSTRAINT `hs_hr_emp_job_role_jobtit_code` FOREIGN KEY (`jobtit_code`) REFERENCES `hs_hr_job_title` (`jobtit_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_job_role`
  ADD CONSTRAINT `hs_hr_emp_job_role_level_code` FOREIGN KEY (`level_code`) REFERENCES `hs_hr_level` (`level_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT ;

INSERT INTO  `hs_hr_sm_mnuitem` (
`sm_mnuitem_id` ,
`sm_mnuitem_name` ,
`sm_mnuitem_name_si` ,
`sm_mnuitem_name_ta` ,
`sm_mnuitem_parent` ,
`sm_mnuitem_level` ,
`sm_mnuitem_webpage_url` ,
`sm_mnuitem_position` ,
`mod_id` ,
`sm_mnuitem_dependency`
)
VALUES (
15002 ,  'Level',  'තරාතිරම',  'Level_ta',  '1004',  '2',  './symfony/web/index.php/admin/Level',  '1.05000',  'MOD001',  'SaveLevel,DeleteLevel,UpdateLevel'
);

INSERT INTO  `hs_hr_sm_mnuitem` (
`sm_mnuitem_id` ,
`sm_mnuitem_name` ,
`sm_mnuitem_name_si` ,
`sm_mnuitem_name_ta` ,
`sm_mnuitem_parent` ,
`sm_mnuitem_level` ,
`sm_mnuitem_webpage_url` ,
`sm_mnuitem_position` ,
`mod_id` ,
`sm_mnuitem_dependency`
)
VALUES (
15003 ,  'Job Role',  'කාර්යභාරය',  'Job Role_ta',  '1004',  '2',  './symfony/web/index.php/admin/JobRole',  '1.06000',  'MOD001',  'SaveJobRole,DeleteJobRole'
);

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES (NULL, 'MOD001', 'hs_hr_emp_job_role', '1', 'Job Role');
INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES (NULL, 'MOD001', 'hs_hr_level', '1', 'Level');


INSERT INTO `hs_hr_emp_role_group` (`role_group_id`, `role_group_name`, `role_group_name_si`, `role_group_name_ta`) VALUES
(1, 'General Manager', 'General Manager_si', 'General Manager_ta'),
(2, 'Director HR ', 'Director HR_si', 'Director HR_ta'),
(3, 'HR Admin', 'HR Admin_si', 'HR Admin_ta'),
(4, 'T & D HR', 'T & D HR_si', 'T & D HR_ta'),
(5, 'Divisional Director ', 'Divisional Director _si', 'Divisional Director _ta'),
(6, 'Head of Division ', 'Head of Division_si', 'Head of Division_ta'),
(7, 'Manager Divisional Samurdhi Authority Unit ', 'Manager Divisional Samurdhi Authority Unit_si', 'Manager Divisional Samurdhi Authority Unit_ta'),
(8, 'Subject Clerk ', 'Subject Clerk_si', 'Subject Clerk_ta'),
(9, 'Training Admin', 'Training Admin_si', 'Training Admin_ta'),
(10, 'District Secretary ', 'District Secretary_si', 'District Secretary_ta'),
(11, 'Divisional Secretary ', 'Divisional Secretary_si', 'Divisional Secretary_ta'),
(12, 'Secretory ', 'Secretory_si', 'Secretory_ta');


ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_reporteddate` DATE NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_reportedtime` TIME NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_todate` DATE NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_totime` TIME NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_major_mionor_flg` varchar( 1 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_investigation_auditfb` varchar( 200 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_ifchargesheetissued_flg` varchar( 1 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_chargesheet_comment` varchar( 200 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_caseclosed_comment` varchar( 10 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_furtheraction_flg` varchar( 10 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_furtheraction_comment` varchar( 200 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_intedicted_flg` varchar( 1 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_intedicted_comment` varchar( 200 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_inquery_comment` varchar( 200 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_fna_code` int( 10 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_finalaction_comment` varchar( 200 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_appeal_flg` varchar( 1 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_appeal_date` DATE NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_appeal_board_comment` varchar( 200 ) NULL DEFAULT NULL;
ALTER TABLE  `hs_hr_dis_incidents` ADD  `dis_inc_appeal_labour_comment` varchar( 200 ) NULL DEFAULT NULL;
CREATE TABLE IF NOT EXISTS `hs_hr_dis_finalaction` (
  `dis_fna_code` int(10) NOT NULL AUTO_INCREMENT,
  `dis_fna_usercode` varchar(10) DEFAULT NULL,
  `dis_fna_name` varchar(200) DEFAULT NULL,
  `dis_fna_name_si` varchar(200) DEFAULT NULL,
  `dis_fna_name_ta` varchar(200) DEFAULT NULL,
  `dis_fna_type` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`dis_fna_code`),
  UNIQUE KEY `dis_fna_usercode` (`dis_fna_usercode`),
  UNIQUE KEY `dis_fna_name` (`dis_fna_name`),
  UNIQUE KEY `dis_fna_name_si` (`dis_fna_name_si`),
  UNIQUE KEY `dis_fna_name_ta` (`dis_fna_name_ta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `hs_hr_dis_involved_emp` CHANGE  `dis_inv_finalaction`  `dis_fna_code` INT( 10 ) NULL DEFAULT NULL;

ALTER TABLE `hs_hr_dis_involved_emp`
	ADD CONSTRAINT `hs_hr_dis_involved_emp_dis_fna_code`
	FOREIGN KEY(`dis_fna_code`)
	REFERENCES `hs_hr_dis_finalaction`(`dis_fna_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_dis_incidents`
	ADD CONSTRAINT `hs_hr_dis_incidents_emp_dis_fna_code`
	FOREIGN KEY(`dis_fna_code`)
	REFERENCES `hs_hr_dis_finalaction`(`dis_fna_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_dis_involved_emp`
	ADD CONSTRAINT `hs_hr_dis_involved_employee`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '4.07000' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4006;
UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '4.06000' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4005;
UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '4.05000' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4004;
UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '4.04000' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4003;

INSERT INTO  `hs_hr_sm_mnuitem` (
`sm_mnuitem_id` ,
`sm_mnuitem_name` ,
`sm_mnuitem_name_si` ,
`sm_mnuitem_name_ta` ,
`sm_mnuitem_parent` ,
`sm_mnuitem_level` ,
`sm_mnuitem_webpage_url` ,
`sm_mnuitem_position` ,
`mod_id` ,
`sm_mnuitem_dependency`
)
VALUES (
4007 ,  'Final Action',  'අවසන් ක්‍රියාව',  'Final Action_ta',  '4000',  '1',  './symfony/web/index.php/disciplinary/FinalAction',  '4.03000',  'MOD004',  'SaveFinalAction,UpdateFinalAction,DeleteFinalAction'
);

INSERT INTO  `hs_hr_formlock_details` (
`frmlock_id` ,
`mod_id` ,
`con_table_name` ,
`con_activity_id` ,
`frmlock_form_name`
)
VALUES (
null ,  'MOD004',  'hs_hr_dis_finalaction',  '1',  'Final Action');

ALTER TABLE  `hs_hr_td_course` ADD  `td_course_fees_per_head` varchar( 20 ) NULL DEFAULT NULL AFTER  `td_course_fees`;
ALTER TABLE  `hs_hr_td_course` ADD  `td_course_fees_additional` varchar( 20 ) NULL DEFAULT NULL AFTER  `td_course_fees_per_head`;
ALTER TABLE  `hs_hr_td_course` ADD  `level_code` INT( 4 ) NULL DEFAULT NULL AFTER  `td_course_fees_additional`;
ALTER TABLE  `hs_hr_td_course` ADD  `td_course_resouse_person` varchar( 100 ) NULL DEFAULT NULL AFTER  `level_code`;

ALTER TABLE `hs_hr_td_course`
  ADD CONSTRAINT `hs_hr_td_course_level_code` FOREIGN KEY (`level_code`) REFERENCES `hs_hr_level` (`level_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT ;

ALTER TABLE  `hs_hr_td_tarining_plan` ADD  `td_plan_resource_person` varchar( 200 ) NULL DEFAULT NULL AFTER  `td_plan_training_frowhom`;
ALTER TABLE  `hs_hr_td_tarining_plan` ADD  `level_code` INT( 4 ) NULL DEFAULT NULL AFTER  `td_plan_resource_person`;

ALTER TABLE `hs_hr_td_tarining_plan`
  ADD CONSTRAINT `hs_hr_td_tarining_plan_level_code` FOREIGN KEY (`level_code`) REFERENCES `hs_hr_level` (`level_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT ;

ALTER TABLE  `hs_hr_td_assignlist` ADD  `td_asl_status` VARCHAR(1) NULL DEFAULT NULL AFTER  `td_asl_admincomment`;

UPDATE  `hs_hr_compstructtree` SET  `def_level` =  '1' WHERE  `hs_hr_compstructtree`.`id` =1;

ALTER TABLE  `hs_hr_td_assignlist` ADD  `td_asl_appr_emp_number` INT(7) NULL DEFAULT NULL AFTER  `td_asl_status`;
ALTER TABLE  `hs_hr_td_assignlist` ADD  `td_asl_appr_sub_emp_number` INT(7) NULL DEFAULT NULL AFTER  `td_asl_appr_emp_number`;

ALTER TABLE `hs_hr_td_assignlist`
	ADD CONSTRAINT `hs_hr_td_assignlist_sub_td_asl_appr_emp_number`
	FOREIGN KEY(`td_asl_appr_sub_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_td_assignlist`
	ADD CONSTRAINT `hs_hr_td_assignlist_td_asl_appr_emp_number`
	FOREIGN KEY(`td_asl_appr_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;



INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES ('5016', 'HR Team Training Approval', 'පුහුණුව අනුමතය මානව සම්පත් කණ්ඩායම', 'HR Team Training Approval_ta', '5000', '1', './symfony/web/index.php/training/AdminappHRTeam', '5.16000', 'MOD005', 'AdminappHRTeam,ajaxTableLock,SaveAdminAppHRTeam,trainingHistory');
INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES ('5017', 'HR Admin Training Approval', 'පුහුණුව අනුමතය මානව සම්පත් පරිපාලක', 'HR Team Admin Approval_ta', '5000', '1', './symfony/web/index.php/training/AdminappHRAdmin', '5.17000', 'MOD005', 'AdminappHRAdmin,ajaxTableLock,SaveAdminAppHRAdmin,trainingHistory');

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_dependency` =  'searchEmployee,saveCompanyStructure' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'deleteDependents,updateDependent' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2007;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_duty_group` (
  `dtg_id` int(4) NOT NULL AUTO_INCREMENT,
  `dtg_code` varchar(10) DEFAULT NULL,
  `dtg_name` varchar(100) DEFAULT NULL,
  `dtg_name_si` varchar(100) DEFAULT NULL,
  `dtg_name_ta` varchar(100) DEFAULT NULL,
  `dtg_desc` varchar(200) DEFAULT NULL,
  `dtg_desc_si` varchar(200) DEFAULT NULL,
  `dtg_desc_ta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`dtg_id`),
  UNIQUE KEY `dtg_name` (`dtg_name`),
  UNIQUE KEY `dtg_name_si` (`dtg_name_si`),
  UNIQUE KEY `dtg_name_ta` (`dtg_name_ta`),
  UNIQUE KEY `dtg_code` (`dtg_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_rate` (
  `rate_id` int(4) NOT NULL AUTO_INCREMENT,
  `rate_code` varchar(10) DEFAULT NULL,
  `rate_name` varchar(100) DEFAULT NULL,
  `rate_name_si` varchar(100) DEFAULT NULL,
  `rate_name_ta` varchar(100) DEFAULT NULL,
  `rate_desc` varchar(200) DEFAULT NULL,
  `rate_desc_si` varchar(200) DEFAULT NULL,
  `rate_desc_ta` varchar(200) DEFAULT NULL,
  `rate_option` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`rate_id`),
  UNIQUE KEY `rate_name` (`rate_name`),
  UNIQUE KEY `rate_name_si` (`rate_name_si`),
  UNIQUE KEY `rate_name_ta` (`rate_name_ta`),
  UNIQUE KEY `rate_code` (`rate_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_duty` (
  `dut_id` int(4) NOT NULL AUTO_INCREMENT,
  `dut_code` varchar(10) DEFAULT NULL,
  `dut_name` varchar(100) DEFAULT NULL,
  `dut_name_si` varchar(100) DEFAULT NULL,
  `dut_name_ta` varchar(100) DEFAULT NULL,
  `dut_desc` varchar(200) DEFAULT NULL,
  `dut_desc_si` varchar(200) DEFAULT NULL,
  `dut_desc_ta` varchar(200) DEFAULT NULL,
  `dtg_id` int(4) DEFAULT NULL,
  `rate_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`dut_id`),
  UNIQUE KEY `dut_name` (`dut_name`),
  UNIQUE KEY `dut_name_si` (`dut_name_si`),
  UNIQUE KEY `dut_name_ta` (`dut_name_ta`),
  UNIQUE KEY `dut_code` (`dut_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_perf_duty`
	ADD CONSTRAINT `hs_hr_perf_duty_hs_hr_perf_rate`
	FOREIGN KEY(`rate_id`)
	REFERENCES `hs_hr_perf_rate`(`rate_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_perf_duty`
	ADD CONSTRAINT `hs_hr_perf_duty_hs_hr_perf_duty_group`
	FOREIGN KEY(`dtg_id`)
	REFERENCES `hs_hr_perf_duty_group`(`dtg_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_rate_detail` (
  `rate_id` int(4) DEFAULT NULL,
  `rdt_grade` varchar(10) DEFAULT NULL,
  `rdt_mark` varchar(10) DEFAULT NULL,
  `rdt_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rate_id`,`rdt_grade`,`rdt_mark`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `hs_hr_perf_rate_detail`
	ADD CONSTRAINT `hs_hr_perf_rate_detail_hs_hr_perf_rate`
	FOREIGN KEY(`rate_id`)
	REFERENCES `hs_hr_perf_rate`(`rate_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation` (
  `eval_id` int(4) NOT NULL AUTO_INCREMENT,
  `eval_code` varchar(10) DEFAULT NULL,
  `eval_name` varchar(100) DEFAULT NULL,
  `eval_name_si` varchar(100) DEFAULT NULL,
  `eval_name_ta` varchar(100) DEFAULT NULL,
  `eval_desc` varchar(200) DEFAULT NULL,
  `eval_desc_si` varchar(200) DEFAULT NULL,
  `eval_desc_ta` varchar(200) DEFAULT NULL,
  `eval_year` varchar(4) DEFAULT NULL,
  `eval_active` varchar(1) DEFAULT NULL,
  `rate_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`eval_id`),
  UNIQUE KEY `eval_name` (`eval_name`),
  UNIQUE KEY `eval_name_si` (`eval_name_si`),
  UNIQUE KEY `eval_name_ta` (`eval_name_ta`),
  UNIQUE KEY `eval_code` (`eval_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_perf_evaluation`
	ADD CONSTRAINT `hs_hr_perf_evaluation_hs_hr_perf_rate`
	FOREIGN KEY(`rate_id`)
	REFERENCES `hs_hr_perf_rate`(`rate_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation_detail` (
  `eval_dtl_id` int(10) NOT NULL AUTO_INCREMENT,
  `eval_id` int(4) DEFAULT NULL,
  `jobtit_code` varchar(13) DEFAULT NULL,
  `level_code` int(4) DEFAULT NULL,
  `service_code` int(4) DEFAULT NULL,
  `eval_dtl_project_percentage` varchar(10) DEFAULT NULL,
  `eval_dtl_duty_percentage` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`eval_dtl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `hs_hr_perf_evaluation_detail`
	ADD CONSTRAINT `hs_hr_perf_evaluation_detail_hs_hr_perf_evaluation`
	FOREIGN KEY(`eval_id`)
	REFERENCES `hs_hr_perf_evaluation`(`eval_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_evaluation_detail`
	ADD CONSTRAINT `hs_hr_job_title_hs_hr_perf_evaluation`
	FOREIGN KEY(`jobtit_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_evaluation_detail`
	ADD CONSTRAINT `hs_hr_level_hs_hr_perf_evaluation`
	FOREIGN KEY(`level_code`)
	REFERENCES `hs_hr_level`(`level_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_evaluation_detail`
	ADD CONSTRAINT `hs_hr_service_hs_hr_perf_evaluation`
	FOREIGN KEY(`service_code`)
	REFERENCES `hs_hr_service`(`service_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_eval_job_role` (
  `eval_dtl_id` int(10) DEFAULT NULL,
  `jrl_id` int(4) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `hs_hr_perf_eval_job_role`
	ADD CONSTRAINT `hs_hr_perf_eval_job_role_hs_hr_perf_evaluation_detail`
	FOREIGN KEY(`eval_dtl_id`)
	REFERENCES `hs_hr_perf_evaluation_detail`(`eval_dtl_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_job_role`
	ADD CONSTRAINT `hs_hr_perf_eval_job_role_hs_hr_perf_eval_job_role`
	FOREIGN KEY(`jrl_id`)
	REFERENCES `hs_hr_emp_job_role`(`jrl_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_eval_duty` (
  `eval_dtl_id` int(10) DEFAULT NULL,
  `dut_id` int(4) DEFAULT NULL,
  `dut_weightage` varchar(10) DEFAULT NULL,
  PRIMARY KEY (  `eval_dtl_id` ,  `dut_id` )
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `hs_hr_perf_eval_duty`
	ADD CONSTRAINT `hs_hr_emp_job_role_hs_hr_perf_evaluation_detail`
	FOREIGN KEY(`eval_dtl_id`)
	REFERENCES `hs_hr_perf_evaluation_detail`(`eval_dtl_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_duty`
	ADD CONSTRAINT `hs_hr_perf_duty_hs_hr_perf_evaluation_detail`
	FOREIGN KEY(`dut_id`)
	REFERENCES `hs_hr_perf_duty`(`dut_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation_supervisor` (
  `eval_id` int(4) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `eval_sup_flag` varchar(1) DEFAULT NULL,
  PRIMARY KEY (  `eval_id` ,  `emp_number` )
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `hs_hr_perf_evaluation_supervisor`
	ADD CONSTRAINT `hs_hr_employee_hs_hr_perf_evaluation_supervisor`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_evaluation_supervisor`
	ADD CONSTRAINT `hs_hr_perf_evaluation_supervisor_hs_hr_perf_evaluation`
	FOREIGN KEY(`eval_id`)
	REFERENCES `hs_hr_perf_evaluation`(`eval_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation_type` (
  `eval_type_id` int(4) NOT NULL AUTO_INCREMENT,
  `eval_type_name` varchar(200) DEFAULT NULL,
  `eval_type_name_si` varchar(200) DEFAULT NULL,
  `eval_type_name_ta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`eval_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_eval_employee` (
  `emp_number` int(7) DEFAULT NULL,
  `eval_id` int(4) DEFAULT NULL,
  `eval_dtl_id` int(10) DEFAULT NULL,
  `eval_emp_project_rate` varchar(10) DEFAULT NULL,
  `eval_emp_duty_rate` varchar(10) DEFAULT NULL,
  `eval_emp_duty_comment` varchar(200) DEFAULT NULL,
  `eval_emp_overall_rate` varchar(10) DEFAULT NULL,
  `eval_emp_overall_grade` varchar(10) DEFAULT NULL,
  `eval_emp_overall_comment` varchar(200) DEFAULT NULL,
  `eval_emp_sujested_overall_rate` varchar(10) DEFAULT NULL,
  `eval_emp_sujested_overall_rate_comment` varchar(200) DEFAULT NULL,
  `eval_emp_status` varchar(1) DEFAULT NULL,
  `sup_emp_number` int(7) DEFAULT NULL,
  `eval_type_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`eval_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

ALTER TABLE `hs_hr_perf_eval_employee`
	ADD CONSTRAINT `hs_hr_perf_eval_employee_hs_hr_perf_evaluation`
	FOREIGN KEY(`eval_id`)
	REFERENCES `hs_hr_perf_evaluation`(`eval_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee`
	ADD CONSTRAINT `hs_hr_employee_hs_hr_perf_eval_employee`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee`
	ADD CONSTRAINT `hs_hr_perf_evaluation_detail_hs_hr_perf_eval_employee`
	FOREIGN KEY(`eval_dtl_id`)
	REFERENCES `hs_hr_perf_evaluation_detail`(`eval_dtl_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee`
	ADD CONSTRAINT `hs_hr_perf_evaluation_type_hs_hr_perf_eval_employee`
	FOREIGN KEY(`eval_type_id`)
	REFERENCES `hs_hr_perf_evaluation_type`(`eval_type_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee`
	ADD CONSTRAINT `sup_emp_number_hs_hr_perf_eval_employee`
	FOREIGN KEY(`sup_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation_project` (
  `eval_prj_id` varchar(10) DEFAULT NULL,
  `eval_prj_name` varchar(200) DEFAULT NULL,
  `eval_prj_name_si` varchar(200) DEFAULT NULL,
  `eval_prj_name_ta` varchar(200) DEFAULT NULL,
  `eval_prj_completed` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`eval_prj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_eval_employee_project` (
  `eval_dtl_id` int(10) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `eval_prj_id` varchar(10) DEFAULT NULL,
  `eval_prj_weight` varchar(10) DEFAULT NULL,
  `eval_prj_comment` varchar(200) DEFAULT NULL,
 PRIMARY KEY (`eval_dtl_id`,`emp_number`,`eval_prj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

ALTER TABLE `hs_hr_perf_eval_employee_project`
	ADD CONSTRAINT `hs_hr_perf_eval_employee_project_hs_hr_perf_eval_employee`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee_project`
	ADD CONSTRAINT `hs_hr_perf_eval_employee_project_hs_hr_perf_evaluation_detail`
	FOREIGN KEY(`eval_dtl_id`)
	REFERENCES `hs_hr_perf_evaluation_detail`(`eval_dtl_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee_project`
	ADD CONSTRAINT `hs_hr_perf_eval_employee_project_hs_hr_perf_evaluation_project`
	FOREIGN KEY(`eval_prj_id`)
	REFERENCES `hs_hr_perf_evaluation_project`(`eval_prj_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_eval_employee_duty` (
  `eval_dtl_id` int(10) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `dut_id` int(4) DEFAULT NULL,
  `eval_duty_rate` varchar(10) DEFAULT NULL,
  `eval_duty_comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

ALTER TABLE `hs_hr_perf_eval_employee_duty`
	ADD CONSTRAINT `hs_hr_perf_eval_employee_duty_hs_hr_perf_eval_employee`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee_duty`
	ADD CONSTRAINT `hs_hr_perf_eval_employee_duty_hs_hr_perf_evaluation_detail`
	FOREIGN KEY(`eval_dtl_id`)
	REFERENCES `hs_hr_perf_evaluation_detail`(`eval_dtl_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_eval_employee_duty`
	ADD CONSTRAINT `hs_hr_perf_duty_hs_hr_perf_evaluation_project`
	FOREIGN KEY(`dut_id`)
	REFERENCES `hs_hr_perf_duty`(`dut_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation_project_employee` (
  `eval_prj_id` varchar(10) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  PRIMARY KEY (`eval_prj_id`,`emp_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `hs_hr_perf_evaluation_project_employee`
	ADD CONSTRAINT `eval_prj_id_hs_hr_perf_evaluation_project`
	FOREIGN KEY(`eval_prj_id`)
	REFERENCES `hs_hr_perf_evaluation_project`(`eval_prj_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_perf_evaluation_project_employee`
	ADD CONSTRAINT `emp_number_employee_hs_hr_employee`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

INSERT INTO `hs_hr_perf_evaluation_type` (`eval_type_id`, `eval_type_name`, `eval_type_name_si`, `eval_type_name_ta`) VALUES
(1, 'Project/Duty Evaluation SDO', 'Project/Duty Evaluation SDO si', 'Project/Duty Evaluation SDO ta'),
(2, 'Project/Duty Evaluation Zonal Manager', 'Project/Duty Evaluation Zonal Manager si', 'Project/Duty Evaluation Zonal Manager ta'),
(3, 'Duty Evaluation', 'Duty Evaluation si', 'Duty Evaluation ta');


INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD016', 'Performance', ' කාර්ය සාධනය ','Performance ta', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(16000, 'Performance', 'කාර්ය සාධනය', 'Performance_TA', 0, 0, '#', '16.00', 'MOD016', NULL),
(16001, 'Define Duty Group', 'වාර්තා බැලීම', 'Define Duty Group_TA', 16000, 1, './symfony/web/index.php/performance/DutyGroup', '16.01', 'MOD016', 'SaveDutyGroup,DeleteDutyGroup,UpdateDutyGroup'),

(16002, 'Define Duty', 'Define Duty si', 'Define Duty Group_TA', 16000, 1, './symfony/web/index.php/performance/Duty', '16.02', 'MOD016', 'SaveDuty,DeleteDuty,UpdateDuty'),

(16003, 'Define Rate', 'Define Rate si', 'Define Rate TA', 16000, 1, './symfony/web/index.php/performance/Rate', '16.03', 'MOD016', 'SaveRate,DeleteRate,UpdateRate'),

(16004, 'Define Company Evaluation', 'Define Company Evaluation si', 'Define Company Evaluation TA', 16000, 1, './symfony/web/index.php/performance/CompanyEvaluationInfo', '16.04', 'MOD016', 'SaveCompanyEvaluationInfo,DeleteCompanyEvaluationInfo,UpdateCompanyEvaluationInfo'),

(16005, 'Evaluation', 'Evaluation si', 'Evaluation TA', 16000, 1, './symfony/web/index.php/performance/Evaluation', '16.05', 'MOD016', 'SaveEvaluation,DeleteEvaluation,UpdateEvaluation'),

(16006, 'Assign Employee', 'Assign Employee si', 'Assign Employee TA', 16000, 1, './symfony/web/index.php/performance/SaveAssingEmployee', '16.07', 'MOD016', 'SaveAssingEmployee,DeleteAssingEmployee,UpdateAssingEmployee,searchEmployee,LoadGrid'),

(16007, 'Assign Supervisor ', 'Assign Supervisor si', 'Assign Supervisor TA', 16000, 1, './symfony/web/index.php/performance/SaveSupervisor', '16.06', 'MOD016', 'SaveSupervisor,DeleteSupervisor,UpdateSupervisor,searchEmployee'),

(16008, 'Evaluation', 'Evaluation si', 'Evaluation TA', 16000, 1, './symfony/web/index.php/performance/SDOEvaluation', '16.08', 'MOD016', 'SaveSDOEvaluation,DeleteSDOEvaluation,UpdateSDOEvaluation');

INSERT INTO  `hs_hr_formlock_details` (
`frmlock_id` ,
`mod_id` ,
`con_table_name` ,
`con_activity_id` ,
`frmlock_form_name`
)
VALUES 
(null, 'MOD016', 'hs_hr_perf_evaluation', 1, 'Company Evaluation Information Summary'),
(null, 'MOD016', 'hs_hr_perf_evaluation_detail', 1, 'Evaluation Summary'),
(null, 'MOD016','hs_hr_perf_duty_group', 1, 'Performance Duty Group'),
(null, 'MOD016','hs_hr_perf_duty', 1, 'Performance Duty'),
(null, 'MOD016','hs_hr_perf_rate', 1, 'Performance Rate');


INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD017', 'Work Flow', 'Work Flow si ','Work Flow ta', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD018', 'Recruitment', ' අලුතෙන් බඳවා ගැනීම් ','Recruitment ta', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(18000, 'Recruitment', 'අලුතෙන් බඳවා ගැනීම්', 'Recruitment_TA', 0, 0, '#', '16.00', 'MOD018', NULL),

(18001, 'Define Vacancy Request', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සාරාංශය', 'Request Summary - HR_TA', 18000, 1, './symfony/web/index.php/recruitment/VacancyRequest', '18.01', 'MOD018', 'SaveVacancyRequest,DeleteVacancyRequest,UpdateVacancyRequest,UpdateVacancyRequestStatus'),

(18002, 'Vacancy Request Summary - HR', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සාරාංශය - මානව සම්පත්', 'Request Summary - HR_TA', 18000, 1, './symfony/web/index.php/recruitment/HRVacancyRequest', '18.02', 'MOD018', 'SaveVacancyReques,DeleteVacancyReques,UpdateHRVacancyRequest,ajaxTableLockCandidate,UpdateHRInterviewRequest,SubmitHRVacancyRequest'),

(18003, 'Vacancy Request Summary - DG', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සාරාංශය - අධ්‍යක්ෂ ජනරාල්', 'Request Summary - DG_TA', 18000, 1, './symfony/web/index.php/recruitment/DGVacancyRequest', '18.03', 'MOD018', 'OverallVacancyRequest,SubmitDGVacancyRequest,ajaxTableLockCandidate,UpdateDGInterviewRequest'),

(18004, 'Overall Vacancy Request Summary', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සමස්ත සාරාංශය', 'Overall Request Summary_TA', 18000, 1, './symfony/web/index.php/recruitment/OverallVacancyRequest', '18.04', 'MOD018', 'UpdateOverallVacancyRequest,OverallVacancyRequest,SubmitOverallVacancyRequest'),

(18005, 'Define Vacancy Requisition', 'පුරප්පාඩු නිර්වචන සාරාංශය', 'Define Vacancy Requisition_TA', 18000, 1, './symfony/web/index.php/recruitment/VacancyRequisition', '18.05', 'MOD018', 'SaveVacancyRequisition,DeleteVacancyRequisition,UpdateVacancyRequisition'),

(18006, 'Define Advertisement', 'දැන්වීම නිර්වචනය', 'Define Advertisement_TA', 18000, 1, './symfony/web/index.php/recruitment/Advertisement', '18.06', 'MOD018', 'SaveAdvertisement,DeleteAdvertisement,UpdateAdvertisement'),

(18007, 'Finalized Vacancy Summary', 'අවසන්වූ දැන්වීම සාරාංශය', 'Finalized Vacancy Summary_TA', 18000, 1, './symfony/web/index.php/recruitment/FinalizedVacancy', '18.07', 'MOD018', 'Candidate,SaveCandidate,SaveAdvertisement,DeleteAdvertisement,UpdateAdvertisement'),

(18008, 'Define Candidate Interview ', 'සම්මුඛ පරීක්ෂණ සාරාංශය', 'Define Candidate Interview_TA', 18000, 1, './symfony/web/index.php/recruitment/CandidateInterview', '18.08', 'MOD018', 'SaveCandidateInterview,DeleteCandidateInterview,UpdateCandidateInterview'),

(18009, 'Interview Summary – HR', 'සම්මුඛ පරීක්ෂණ සාරාංශය - මානව සම්පත්', 'Interview Summary – HR_TA', 18000, 1, './symfony/web/index.php/recruitment/HRCandidateInterview', '18.09', 'MOD018', 'SaveCandidateInterview,DeleteCandidate,UpdateCandidateInterview'),

(18010,  'Selected Candidate Summary – Approved by DG ',  'සම්මුඛ පරීක්ෂණ සාරාංශය - අධ්‍යක්ෂ ජනරාල්',  'Selected Candidate Summary – Approved by DG ',  '18000',  '1', './symfony/web/index.php/recruitment/DGCandidateInterview',  '18.10',  'MOD018',  'SaveCandidateInterview,DeleteCandidate,UpdateCandidateInterview,ajaxTableLockCandidate,UpdateDGCandidateRequest'),

(18011,'Selected Candidate Summary',  'තෝරාගත් ඉල්ලුම්කාරුවන් සාරාංශය',  'Selected Candidate Summary_TA ',  '18000',  '1', './symfony/web/index.php/recruitment/CandidatePIMRegistation',  '18.11',  'MOD018',  'CandidatePIMRegistation');

delete from hs_hr_sm_mnuitem where mod_id not in('MOD001','MOD002','MOD013','MOD004','MOD005','MOD014','MOD010','MOD018','MOD016');


ALTER TABLE `hs_hr_grade_slot` CHANGE `slt_amount` `slt_amount` FLOAT( 20, 2 ) NULL DEFAULT NULL ,
CHANGE `emp_basic_salary` `emp_basic_salary` FLOAT( 20, 2 ) NULL DEFAULT NULL ;

ALTER TABLE `hs_hr_employee` DROP FOREIGN KEY `hs_hr_grade_slot_hs_hr_employee` ;

ALTER TABLE `hs_hr_grade_slot` DROP INDEX `slt_scale_year` ;

DROP TABLE `hs_hr_grade_slot`;

CREATE TABLE IF NOT EXISTS `hs_hr_grade_slot` (
  `slt_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_code` int(4) NOT NULL,
  `slt_scale_year` int(10) DEFAULT NULL,
  `slt_amount` float(13,2) DEFAULT NULL,
  `emp_basic_salary` float(13,2) DEFAULT NULL,
  PRIMARY KEY (`slt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

ALTER TABLE `hs_hr_grade_slot`
	ADD CONSTRAINT `hs_hr_grade_slot_grade_code`
	FOREIGN KEY(`grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

UPDATE `hs_hr_employee` SET `slt_scale_year` = NULL;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_grade_year_slot_hs_hr_employee`
	FOREIGN KEY(`slt_scale_year`)
	REFERENCES `hs_hr_grade_slot`(`slt_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(5015, 'Divisional Secretary Training Approval', 'පුහුණුව අනුමතය ප්‍රාදේශීය ලේකම්', 'Divisional Secretary Training Approval_ta', 5000, 1, './symfony/web/index.php/training/AdminappDivSec', '5.15000', 'MOD005', 'AdminappDivSec,ajaxTableLock,SaveAdminAppDivSec,trainingHistory');

UPDATE  hs_hr_sm_mnuitem  SET  sm_mnuitem_dependency=  'UpdateAttachment,viewAttachment,deleteAttachments,Attachment,GetAttachmentDetails,updateAttachment' WHERE sm_mnuitem_id =2021;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Disciplinary Sub Type' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4002;


ALTER TABLE  `hs_hr_users` DROP FOREIGN KEY  `hs_hr_users_ibfk_1` ;

ALTER TABLE  `hs_hr_users` DROP FOREIGN KEY  `hs_hr_users_ibfk_2`;

ALTER TABLE `hs_hr_td_assignlist` ADD `wfmain_id` VARCHAR(50) NULL DEFAULT NULL;
ALTER TABLE `hs_hr_td_assignlist` ADD `wfmain_sequence` INT(50) NULL DEFAULT NULL;

ALTER TABLE  `hs_hr_td_assignlist` DROP FOREIGN KEY  `hs_hr_td_assignlist_sub_td_asl_appr_emp_number` ;

ALTER TABLE  `hs_hr_td_assignlist` DROP FOREIGN KEY  `hs_hr_td_assignlist_td_asl_appr_emp_number`;


ALTER TABLE `hs_hr_td_assignlist` DROP `td_asl_appr_emp_number`;
ALTER TABLE `hs_hr_td_assignlist` DROP `td_asl_appr_sub_emp_number` ;

ALTER TABLE `hs_hr_td_course` CHANGE `td_course_fromtime` `td_course_fromtime` TIME NULL DEFAULT NULL ,
CHANGE `td_course_totime` `td_course_totime` TIME NULL DEFAULT NULL;

-- WORK FLOW 2011/7/12 ADD BY ROSHAN -----

-- MENUS --- 

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(17000, 'Work Flow', 'අනුමත කිරීම්', 'Work Flow', 0, 0, '#', '17.00000', 'MOD017', NULL),
(17001, 'Approval Groups', 'අනුමත කිරීමේ කණ්ඩායම්', 'Approval Groups_ta', 17000, 1, './symfony/web/index.php/workflow/approvalGroupsSummary', '17.01000', 'MOD017', 'SaveAppGroup,DeleteGrpApp'),
(17002, 'Approval Summary', 'අනුමත කිරීමේ සාරාංශය.', 'Approval Summary', 17000, 1, './symfony/web/index.php/workflow/ApprovalSummary', '17.02000', 'MOD017', NULL),
(17003, 'Assign For Group', 'කණ්ඩායම් සදහා අනුයුක්ත කිරීම්', 'Assign For Group', 17000, 1, './symfony/web/index.php/workflow/AssignToGroup', '17.03000', 'MOD017', NULL);

-- TABLES --

CREATE TABLE IF NOT EXISTS `hs_hr_wf_actingperson_approval` (
  `actapp_id` int(50) NOT NULL,
  `actapp_date` date DEFAULT NULL,
  `actapp_time` time DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `actapp_empnumber` int(7) DEFAULT NULL,
  PRIMARY KEY (`actapp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hs_hr_wf_approval_group` (
  `wfappgrp_code` int(50) NOT NULL AUTO_INCREMENT,
  `wfappgrp_description` varchar(200) NOT NULL,
  `wfappgrp_description_si` varchar(200) DEFAULT NULL,
  `wfappgrp_description_ta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`wfappgrp_code`),
  KEY `wfappgrp_code` (`wfappgrp_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hs_hr_wf_approval_person` (
  `wfapper_decription` varchar(200) NOT NULL,
  `wfapper_code` varchar(20) NOT NULL,
  `wfapper_sqlquery` varchar(2000) NOT NULL,
  `wfapper_is_group_flg` int(10) NOT NULL,
  PRIMARY KEY (`wfapper_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hs_hr_wf_approvel` (
  `wftype_code` int(20) NOT NULL,
  `wfa_sequence` int(20) NOT NULL,
  `wfapper_code` varchar(20) NOT NULL,
  `wfapper_iscompulsory_flg` int(10) NOT NULL,
  `wfapper_lastlevel` int(10) NOT NULL,
  `wfapper_allowchange` varchar(10) NOT NULL,
  PRIMARY KEY (`wftype_code`,`wfa_sequence`),
  KEY `wfapper_code` (`wfapper_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hs_hr_wf_group_app_person` (
  `wfappgrp_code` int(50) NOT NULL,
  `wf_main_app_employee` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`wfappgrp_code`,`wf_main_app_employee`),
  KEY `wfappgrp_code` (`wfappgrp_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
       
--
-- Constraints for table `hs_hr_wf_group_app_person`
--
ALTER TABLE `hs_hr_wf_group_app_person`
  ADD CONSTRAINT `hs_hr_wf_group_app_person_ibfk_1` FOREIGN KEY (`wfappgrp_code`) REFERENCES `hs_hr_wf_approval_group`(`wfappgrp_code`);

CREATE TABLE IF NOT EXISTS `hs_hr_wf_main` (
  `wfmain_sequence` int(50) NOT NULL,
  `wfmain_app_date` date DEFAULT NULL,
  `wfmain_comments` varchar(200) DEFAULT NULL,
  `wfmain_flow_id` int(50) DEFAULT NULL,
  `wfmain_iscomplete_flg` int(10) DEFAULT NULL,
  `wfmain_id` int(50) NOT NULL,
  `wftype_code` int(50) DEFAULT NULL,
  `wfmain_approving_emp_number` int(7) DEFAULT NULL,
  `wfmain_orderid` int(50) DEFAULT NULL,
  `wfmain_application_date` date DEFAULT NULL,
  `wfmain_current_date` date DEFAULT NULL,
  `wfmain_is_hr_approved` int(10) DEFAULT NULL,
  `wfmain_previous_id` varchar(50) DEFAULT NULL,
  KEY `wfmain_id` (`wfmain_id`),
  KEY `hs_hr_wf_main_ibfk_1` (`wftype_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hs_hr_wf_main_app_person` (
  `wfmain_id` int(50) NOT NULL,
  `wfmain_sequence` varchar(25) NOT NULL,
  `wf_main_app_employee` varchar(200) NOT NULL,
  PRIMARY KEY (`wfmain_id`,`wfmain_sequence`,`wf_main_app_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hs_hr_wf_module` (
  `wfmod_id` varchar(36) NOT NULL,
  `wfmod_name` varchar(100) NOT NULL,
  `wfmod_view_name` varchar(100) NOT NULL,
  `wfmod_approve_reject` varchar(100) NOT NULL,
  PRIMARY KEY (`wfmod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hs_hr_wf_type` (
  `wftype_description` varchar(200) NOT NULL,
  `wftype_code` int(11) NOT NULL DEFAULT '0',
  `wftype_table_name` varchar(100) DEFAULT NULL,
  `wftype_view_name` varchar(100) DEFAULT NULL,
  `wfmod_id` varchar(20) DEFAULT NULL,
  `wftype_update_field` varchar(20) DEFAULT NULL,
  `wftype_class` varchar(20) DEFAULT NULL,
  `wftype_method_name` varchar(20) DEFAULT NULL,
  `wftype_redirect_url` varchar(100) DEFAULT NULL,
  `wftype_canclemain_field` varchar(20) DEFAULT NULL,
  `wftype_canclestatus_field` varchar(20) DEFAULT NULL,
  `wftype_appmain_field` varchar(20) DEFAULT NULL,
  `wftype_bulk_app_flg` varchar(20) DEFAULT NULL,
  `wftype_sort_field_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`wftype_code`),
  KEY `wfmod_id` (`wfmod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `hs_hr_wf_main` ADD INDEX ( `wfmain_id` );

ALTER TABLE `hs_hr_wf_main` ADD INDEX ( `wfmain_sequence` );

-- WORKFLOW CONSTRAINT --

ALTER TABLE `hs_hr_wf_approvel`
  ADD CONSTRAINT `hs_hr_wf_approvel_ibfk_1` FOREIGN KEY (`wftype_code`) REFERENCES `hs_hr_wf_type` (`wftype_code`),
  ADD CONSTRAINT `hs_hr_wf_approvel_ibfk_2` FOREIGN KEY (`wfapper_code`) REFERENCES `hs_hr_wf_approval_person` (`wfapper_code`),
  ADD CONSTRAINT `hs_hr_wf_approvel_ibfk_3` FOREIGN KEY (`wftype_code`) REFERENCES `hs_hr_wf_type` (`wftype_code`);


-- WORK FOLW VIEWS --

    CREATE VIEW 
    vw_hs_hr_wf_main_data
    AS select 
          mo.wfmod_id, mo.wfmod_name, mo.wfmod_view_name, ty.wftype_code,ma.wfmain_iscomplete_flg,
          ty.wftype_description, ty.wftype_table_name, ty.wftype_view_name,
          ma.wfmain_id,ma.wfmain_sequence, 
		CASE
             WHEN ap.wf_main_app_employee IS NULL
                THEN ma.wfmain_approving_emp_number
             ELSE ap.wf_main_app_employee
        END  AS wfmain_approving_emp_number,
		ma.wfmain_flow_id, ty.wftype_update_field, ty.wftype_class,
          ty.wftype_method_name, ma.wfmain_previous_id,
          ma.wfmain_application_date,
          ty.wftype_appmain_field,
          ty.wftype_bulk_app_flg, ty.wftype_sort_field_name
		 FROM hs_hr_wf_module mo INNER JOIN hs_hr_wf_type ty
          ON mo.wfmod_id = ty.wfmod_id
          INNER JOIN hs_hr_wf_main ma ON ty.wftype_code = ma.wftype_code
          LEFT JOIN hs_hr_wf_main_app_person ap
          ON ma.wfmain_id = ap.wfmain_id
        AND ma.wfmain_sequence = ap.wfmain_sequence
    WHERE (ma.wfmain_iscomplete_flg = 0);

--
-- Constraints for table `hs_hr_wf_main`
--
ALTER TABLE `hs_hr_wf_main`
  ADD CONSTRAINT `hs_hr_wf_main_ibfk_1` FOREIGN KEY (`wftype_code`) REFERENCES `hs_hr_wf_type` (`wftype_code`);

--
-- Constraints for table `hs_hr_wf_main_app_person`
--
ALTER TABLE `hs_hr_wf_main_app_person`
  ADD CONSTRAINT `hs_hr_wf_main_app_person_ibfk_1` FOREIGN KEY (`wfmain_id`) REFERENCES `hs_hr_wf_main` (`wfmain_id`);

--
-- Constraints for table `hs_hr_wf_type`
--
ALTER TABLE `hs_hr_wf_type`
  ADD CONSTRAINT `hs_hr_wf_type_ibfk_1` FOREIGN KEY (`wfmod_id`) REFERENCES `hs_hr_wf_module` (`wfmod_id`);

--
-- Recruitment report
--

INSERT INTO `hs_hr_rn_report`(`rn_rpt_id`,`rn_rpt_name`,`rn_rpt_name_si`,`rn_rpt_name_ta`,`rn_rpt_path` ,`mod_id`)
VALUES 
('29', 'Individual Candidate Interview Report', 'Individual Candidate Interview Report', 'Individual Candidate Interview Report', 'Individual_Candidate_Interview_Report.rptdesign', 'MOD018'),
('30', 'Candidate Finalization Report', 'Candidate Finalization Report', 'Candidate Finalization Report', 'Candidate_Finalization_Report.rptdesign', 'MOD018'),
('31', 'Approved Vacancy Count Report', 'Approved Vacancy Count Report', 'Approved Vacancy Count Report', 'Approved_Vacancy_Count_Report.rptdesign', 'MOD018'),
('32', 'Employees Who Have Taken Appointments for a Given Period Report', 'Employees Who Have Taken Appointments for a Given Period Report', 'Employees Who Have Taken Appointments for a Given Period Report', 'Employees_Appointments_Summary.rptdesign', 'MOD018');

drop view if exists   vw_hs_hr_wf_traning_data;
CREATE VIEW vw_hs_hr_wf_traning_data
   AS select ma.wfmain_id AS ID,wtf.wfmod_id AS `Module ID`,ma.wfmain_flow_id
   AS `APPROVAL LEVEL`,ma.wftype_code AS `WorkFlow Type Code`,ma.wfmain_approving_emp_number 
   AS `Approving_Employee`,e.emp_number AS `Employee Number`,e.emp_display_name 
   AS `Employee Name` 
   from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id 
   left join hs_hr_employee e on e.emp_number = td.emp_number 
   left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
   left join hs_hr_module m on m.mod_id =wtf.wfmod_id  
   where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 6 
   union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS   'WorkFlow Type Code',ma.wfmain_approving_emp_number 
  AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.emp_display_name AS 'Employee Name'
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id 
  left join hs_hr_employee e on e.emp_number = td.emp_number 
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id 
  where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 5
  union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.emp_display_name AS 'Employee Name' 
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on  ma.wfmain_id = td.wfmain_id 
  left join hs_hr_employee e on e.emp_number = td.emp_number 
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg = 0 and            ma.wftype_code = 4
  union all select ma.wfmain_id AS 'ID',wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS `Employee Number`,e.emp_display_name AS 'Employee Name' 
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id 
  left join hs_hr_employee e on e.emp_number = td.emp_number 
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg = 0 and  ma.wftype_code = 3;

INSERT INTO `hs_hr_wf_approval_group` (`wfappgrp_code`, `wfappgrp_description`, `wfappgrp_description_si`, `wfappgrp_description_ta`) VALUES
(3, 'Training_Divisional_Secrotory_Group', 'Training_Divisional_Secrotory_Group_si', 'Training_Divisional_Secrotory_Group_ta'),
(4, 'Training_District_Secrotory_Group', 'Training_District_Secrotory_Group_si', 'Training_District_Secrotory_Group_ta'),
(5, 'Training_HR_Team_Group', 'Training_HR_Team_Group_si', 'Training_HR_Team_Group_ta'),
(6, 'Training_HR_Admin_Group', 'Training_HR_Admin_Group_si', 'Training_HR_Admin_Group_ta');


INSERT INTO `hs_hr_wf_module` (`wfmod_id`, `wfmod_name`, `wfmod_view_name`, `wfmod_approve_reject`) VALUES
('MOD005', 'T & D', 'vw_hs_hr_wf_traning_data', 'vw_hs_hr_wf_traning_data');

INSERT INTO `hs_hr_wf_approval_person` (`wfapper_decription`, `wfapper_code`, `wfapper_sqlquery`, `wfapper_is_group_flg`) VALUES
('Training_Divisinal_Secretory', '003', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''3'' AND wf_main_app_employee != @Emp_Number', 1),
('Training_District_Secretory', '004', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''4'' AND wf_main_app_employee != @Emp_Number', 1),
('Training_HR_Team', '005', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''5'' AND wf_main_app_employee != @Emp_Number', 1),
('Training_HR_Admin', '006', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''6'' AND wf_main_app_employee != @Emp_Number', 1);

INSERT INTO `hs_hr_wf_type` (`wftype_description`, `wftype_code`, `wftype_table_name`, `wftype_view_name`, `wfmod_id`, `wftype_update_field`, `wftype_class`, `wftype_method_name`, `wftype_redirect_url`, `wftype_canclemain_field`, `wftype_canclestatus_field`, `wftype_appmain_field`, `wftype_bulk_app_flg`, `wftype_sort_field_name`) VALUES
('Training_Divisional_Head', 3, 'hs_hr_td_assignlist', 'vw_hs_hr_wf_training_divisonal_secretory', 'MOD005', 'td_asl_isapproved', NULL, NULL, 'training/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Training_District_Head', 4, 'hs_hr_td_assignlist', 'vw_hs_hr_wf_training_distric_secretory', 'MOD005', 'td_asl_isapproved', NULL, NULL, 'training/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Training_HRTeam', 5, 'hs_hr_td_assignlist', 'vw_hs_hr_wf_training_hr_team', 'MOD005', 'td_asl_isapproved', NULL, NULL, 'training/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Training_HRAdmin', 6, 'hs_hr_td_assignlist', 'vw_hs_hr_wf_training_hr_admin', 'MOD005', 'td_asl_isapproved', NULL, NULL, 'training/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `hs_hr_wf_approvel` (`wftype_code`, `wfa_sequence`, `wfapper_code`, `wfapper_iscompulsory_flg`, `wfapper_lastlevel`, `wfapper_allowchange`) VALUES
(3, 1, '003', 1, 0, ''),
(3, 2, '004', 1, 0, ''),
(3, 3, '005', 1, 0, ''),
(3, 4, '006', 1, 1, ''),
(4, 1, '004', 1, 0, ''),
(4, 2, '005', 1, 0, ''),
(4, 3, '006', 1, 1, ''),
(5, 1, '005', 1, 0, ''),
(5, 2, '006', 1, 1, ''),
(6, 1, '006', 1, 1, '');

UPDATE `hs_hr_module` SET `name` = 'Security' WHERE `hs_hr_module`.`mod_id` = 'MOD013';

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '1.05000' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15003;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '1.06000' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15002;


UPDATE `hs_hr_company_structure_def` SET `def_name` = 'Province Level' WHERE `hs_hr_company_structure_def`.`def_level` =2;

UPDATE `hs_hr_company_structure_def` SET `def_name` = 'District Level',
`def_name_si` = 'පලාත් මට්ටම' WHERE `hs_hr_company_structure_def`.`def_level` =3;

UPDATE `hs_hr_company_structure_def` SET `def_name` = 'Divisional Level',
`def_name_si` = 'ප්‍රාදේශීය මට්ටම' WHERE `hs_hr_company_structure_def`.`def_level` =4;

UPDATE `hs_hr_company_structure_def` SET `def_name` = 'Zonal Level',
`def_name_si` = 'කොට්ඨාශ මට්ටම' WHERE `hs_hr_company_structure_def`.`def_level` =5;

UPDATE `hs_hr_company_structure_def` SET `def_name` = 'Wasam Level',
`def_name_si` = 'වසම් මට්ටම' WHERE `hs_hr_company_structure_def`.`def_level` =6;


INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(10005, 'Transfer Request', 'මාරුවීම ඉල්ලීම', 'கோரிக்கை பரிமாற்றல்', 10000, 1, './symfony/web/index.php/Transfer/SaveTranserRequest', '10.01', 'MOD010', 'listCompanyStructure,searchEmployee');

UPDATE `hs_hr_formlock_details` SET `frmlock_form_name` = 'inquiry Summary' WHERE `hs_hr_formlock_details`.`frmlock_id` =62;

ALTER TABLE `hs_hr_td_assignlist` CHANGE `wfmain_id` `wfmain_id` INT( 50 ) NOT NULL; 

ALTER TABLE `hs_hr_td_assignlist` ADD CONSTRAINT `hs_hr_td_assignlist_hs_hr_wf_main` FOREIGN KEY ( `wfmain_id` ) REFERENCES `hs_hr_wf_main` ( `wfmain_id` )	
ON DELETE RESTRICT ON UPDATE RESTRICT ;

DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5015;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5016;



DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5017;


INSERT INTO  `hs_hr_formlock_details` (
`frmlock_id` ,
`mod_id` ,
`con_table_name` ,
`con_activity_id` ,
`frmlock_form_name`
)
VALUES (
'null',  'MOD017',  'hs_hr_wf_group_app_person',  '2',  'Assign to approval groups'
);

INSERT INTO  `hs_hr_formlock_details` (
`frmlock_id` ,
`mod_id` ,
`con_table_name` ,
`con_activity_id` ,
`frmlock_form_name`
)
VALUES (
NULL ,  'MOD017',  'hs_hr_wf_approval_group',  '1',  'Add Approval Group'
);

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '02.03.04' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2006;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '02.03.03' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2007;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '02.03.05' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2008;




DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5017;

-- add by roshan 15/8/2011 build 1730



-- Givantha Company Hierarchy Alters 2011-08-11

ALTER TABLE  `hs_hr_compstructtree` ADD  `comp_location_code` varchar(30) DEFAULT NULL;
ALTER TABLE  `hs_hr_compstructtree` ADD  `comp_reference_code` varchar(20) DEFAULT NULL;


ALTER TABLE  `hs_hr_compstructtree` ADD UNIQUE (
`comp_location_code`
);

-- Givantha Job Titles Data 2011-08-12

INSERT INTO `hs_hr_job_title` (`jobtit_code`, `jobtit_name`, `jobtit_name_si`, `jobtit_name_ta`) VALUES
('JOB001', 'Deputy Director', 'අනුනායක', 'ளனளயளன'),
('JOB002', 'System Analyst', 'විශ්ලේෂක', 'ளனளனள'),
('JOB003', 'Director Board', 'අධ්‍යක්ෂ', 'ளனயளனளய'),
('JOB004', 'Director General', 'අධ්‍යක්ෂ ෂ', NULL),
('JOB005', 'General Manager', 'සාමාන්‍යාධිකාරී', 'னளயயநற'),
('JOB006', 'Director', NULL, NULL),
('JOB007', 'Assistant Director', 'සහකාර', 'னறநறஙற'),
('JOB008', 'Manager Division', 'කළමනාකරු', 'நறறநசறசநசக'),
('JOB009', 'Administrative officer', 'පාලක', 'பாகபா'),
('JOB010', 'Chief Clerk', 'අධිපතියා', 'டழழழம'),
('JOB011', 'Computer Operator', NULL, NULL),
('JOB012', 'Clerk', NULL, NULL),
('JOB013', 'Driver', NULL, NULL),
('JOB014', 'Office Assistant', NULL, NULL),
('JOB015', 'Labour', NULL, NULL),
('JOB016', 'District Secretary - Director Level', NULL, NULL),
('JOB017', 'Assistant Samurdhi Commissioner - Deputy Director Level', NULL, NULL),
('JOB018', 'Samurdhi Manager - Admin', NULL, NULL),
('JOB019', 'Samurdhi Manager - Bank', NULL, NULL),
('JOB020', 'Samurdhi Manager - Livelihood Development', NULL, NULL),
('JOB021', 'Samurdhi Manager - Account', NULL, NULL),
('JOB022', 'SDO - District Secretary Office -Clerical Service', NULL, NULL),
('JOB023', 'Divisional Secretary -Deputy Director Level', NULL, NULL),
('JOB024', 'Samurdhi Head Quarter Manager', NULL, NULL),
('JOB025', 'SDO -Administration', NULL, NULL),
('JOB026', 'SDO -Accounting Activities', NULL, NULL),
('JOB027', 'SDO -Social Security/Insurance', NULL, NULL),
('JOB028', 'SDO - Project', NULL, NULL),
('JOB029', 'Mahasangam Managing Director', NULL, NULL),
('JOB030', 'Samurdhi Project Manager', NULL, NULL),
('JOB031', 'SDO - Assistant Manager Mahasangam', NULL, NULL),
('JOB032', 'SDO - Admin Assistant', NULL, NULL),
('JOB033', 'SDO - Account Assistant', NULL, NULL),
('JOB034', 'SDO - Social Security', NULL, NULL),
('JOB035', 'SDO - Project Assistant', NULL, NULL),
('JOB036', 'Samurdhi Bank manager /Zonal Manager', NULL, NULL),
('JOB037', 'SDO - Assistant Manager Bank', NULL, NULL),
('JOB038', 'SDO - Zone Assistant', NULL, NULL),
('JOB039', 'SDO - Accounts Clerk', NULL, NULL),
('JOB040', 'SDO-Cashier', NULL, NULL),
('JOB041', 'SDO-Book Keeper', NULL, NULL),
('JOB042', 'SDO-Gramaniladari Wasam', NULL, NULL),
('JOB043', 'Samurdhi Manager-Progress', NULL, NULL),
('JOB044', 'Samurdhi Co-ordinating Officer', NULL, NULL);

-- Jayanath Company Hierarchy Alters 2011-08-12

ALTER TABLE `hs_hr_compstructtree` CHANGE `comp_code` `comp_code` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;


-- training build 1730 added by roshan

ALTER TABLE `hs_hr_td_assignlist` CHANGE `wfmain_id` `wfmain_id` INT( 50 ) NULL DEFAULT NULL ;

drop view if exists   vw_hs_hr_wf_traning_data;
CREATE VIEW vw_hs_hr_wf_traning_data
   AS select ma.wfmain_id AS ID,wtf.wfmod_id AS `Module ID`,ma.wfmain_flow_id
   AS `APPROVAL LEVEL`,ma.wftype_code AS `WorkFlow Type Code`,ma.wfmain_approving_emp_number
   AS `Approving_Employee`,e.emp_number AS `Employee Number`,e.emp_display_name
   AS `Employee Name`
   from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id
   left join hs_hr_employee e on e.emp_number = td.emp_number
   left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
   left join hs_hr_module m on m.mod_id =wtf.wfmod_id
   where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 6
   union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS   'WorkFlow Type Code',ma.wfmain_approving_emp_number
  AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.emp_display_name AS 'Employee Name'
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id
  left join hs_hr_employee e on e.emp_number = td.emp_number
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id
  where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 5
  union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.emp_display_name AS 'Employee Name'
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on  ma.wfmain_id = td.wfmain_id
  left join hs_hr_employee e on e.emp_number = td.emp_number
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg = 0 and            ma.wftype_code = 4
  union all select ma.wfmain_id AS 'ID',wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS `Employee Number`,e.emp_display_name AS 'Employee Name'
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id
  left join hs_hr_employee e on e.emp_number = td.emp_number
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg = 0 and  ma.wftype_code = 3;

ALTER TABLE `hs_hr_td_assignlist` CHANGE `wfmain_id` `wfmain_id` INT( 50 ) NULL DEFAULT NULL;
-- 1693


