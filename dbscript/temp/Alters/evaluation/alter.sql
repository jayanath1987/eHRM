SET NAMES 'UTF8';

INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD021', 'Evaluation', 'ඇගයීම', 'Evaluation_ta', 'JBL', 'jayanath@icta.lk', NULL, NULL, NULL);


CREATE TABLE IF NOT EXISTS `hs_hr_evl_rate` (
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

CREATE TABLE IF NOT EXISTS `hs_hr_evl_rate_detail` (
  `rate_id` int(4) NOT NULL DEFAULT '0',
  `rdt_grade` varchar(10) NOT NULL DEFAULT '',
  `rdt_mark` float NOT NULL DEFAULT '0',
  `rdt_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rate_id`,`rdt_grade`,`rdt_mark`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `hs_hr_evl_rate_detail`
  ADD CONSTRAINT  FOREIGN KEY (`rate_id`) REFERENCES `hs_hr_evl_rate` (`rate_id`);

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(21000, 'Evaluation', 'ඇගයීම', 'Evaluation_ta', 0, 0, '#', '21.00', 'MOD021', NULL),
(21001, 'Rating Method ', 'වටිනාකම මැන බැලීම ', 'Rating Method TA ', 21000, 1, './symfony/web/index.php/evaluation/Rate', '21.01', 'MOD021', 'SaveRate,DeleteRate,UpdateRate'),
(21002, 'Company Evaluation ', 'සමාගම් ඇගයීම්', 'Company Evaluation TA ', 21000, 1, './symfony/web/index.php/evaluation/CompanyEvaluationInfo', '21.02', 'MOD021', 'SaveCompanyEvaluationInfo,DeleteCompanyEvaluationInfo,UpdateCompanyEvaluationInfo'),
(21003, 'Evaluation Supervisor-Nominee', 'ඇගයීම ප්‍රධානියා තෙවන පාර්ශවය', 'Evaluation Supervisor-Nominee TA ', 21000, 1, './symfony/web/index.php/evaluation/SaveAssingEmployee', '21.03', 'MOD021', 'SaveAssingEmployee');

CREATE TABLE IF NOT EXISTS `hs_hr_evl_evaluation` (
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
  UNIQUE KEY `eval_code` (`eval_code`),
  KEY `hs_hr_evl_evaluation_hs_hr_evl_rate` (`rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


ALTER TABLE `hs_hr_evl_evaluation`
  ADD CONSTRAINT  FOREIGN KEY (`rate_id`) REFERENCES `hs_hr_evl_rate` (`rate_id`);

CREATE TABLE IF NOT EXISTS `hs_hr_evl_evaluation_supervisor` (
  `evl_id` int(4) NOT NULL AUTO_INCREMENT,
  `eval_id` int(4) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `sup_num` int(7) DEFAULT NULL,
  `eval_sup_flag` varchar(1) DEFAULT NULL,
  `evl_nomine_emp_number` int(7) DEFAULT NULL,
  PRIMARY KEY (`evl_id`),
  KEY `hs_hr_employee_hs_hr_evl_evaluation_supervisor_employee` (`emp_number`),
  KEY `hs_hr_employee_hs_hr_evl_evaluation_supervisor_nominee` (`evl_nomine_emp_number`),
  KEY `hs_hr_employee_hs_hr_evl_evaluation_supervisor` (`sup_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_evl_evaluation_supervisor`
  ADD CONSTRAINT  FOREIGN KEY (`emp_number`) REFERENCES `hs_hr_employee` (`emp_number`),
  ADD CONSTRAINT  FOREIGN KEY (`evl_nomine_emp_number`) REFERENCES `hs_hr_employee` (`emp_number`),
  ADD CONSTRAINT  FOREIGN KEY (`sup_num`) REFERENCES `hs_hr_employee` (`emp_number`),
  ADD CONSTRAINT  FOREIGN KEY (`eval_id`) REFERENCES `hs_hr_evl_evaluation` (`eval_id`);


-- Evaluation Functions / Tasks

CREATE TABLE IF NOT EXISTS `hs_hr_evl_functions_tasks` (
  `ft_id` int(4) NOT NULL AUTO_INCREMENT,
  `eval_id` int(4) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `ft_title` varchar(200) DEFAULT NULL,
  `ft_description` varchar(500) DEFAULT NULL,
  `ft_from_date` date DEFAULT NULL,
  `ft_to_date` date DEFAULT NULL,
  `ft_active_flg` varchar(1) DEFAULT NULL,
  `ft_approve_flg` varchar(1) DEFAULT NULL,
  `ft_target_indicater` varchar(100) DEFAULT NULL,
  `ft_sup_comment` varchar(500) DEFAULT NULL,
  `ft_mod_comment` varchar(500) DEFAULT NULL,
  `ft_sup_mid_achive` float DEFAULT NULL,
  `ft_sup_end_achive` float DEFAULT NULL,
  `ft_sup_mid_marks` float DEFAULT NULL,
  `ft_sup_end_marks` float DEFAULT NULL,
  `ft_mod_end_marks` float DEFAULT NULL,
  `ft_weight` float DEFAULT NULL,
  PRIMARY KEY (`ft_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_evl_functions_tasks`
	ADD CONSTRAINT `hs_hr_eval_functions_tasks_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_functions_tasks`
	ADD CONSTRAINT `hs_hr_eval_functions_tasks_eval_id`
	FOREIGN KEY(`eval_id`)
	REFERENCES `hs_hr_evl_evaluation`(`eval_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

 ALTER TABLE `hs_hr_evl_functions_tasks` ADD `ft_mod_end_achive` DECIMAL NULL DEFAULT NULL AFTER `ft_sup_end_marks`;

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(21004, 'Evaluation Functions Tasks', 'ඇගයීම ප්‍රධානියා තෙවන පාර්ශවය', 'Evaluation Functions Tasks TA ', 21000, 1, './symfony/web/index.php/evaluation/EvalFunctionTask', '21.04', 'MOD021', 'UpdateEvalFunctionTask,DeleteEvalFunctionTask');

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(21005, 'Functions Tasks Approval', 'ඇගයීම ප්‍රධානියා තහවුරු කිරීම', 'Functions Tasks Approval TA ', 21000, 1, './symfony/web/index.php/evaluation/FTApproveSearch', '21.05', 'MOD021', 'searchEmployee');

CREATE TABLE IF NOT EXISTS `hs_hr_evl_skill_master` (
  `skill_id` int(4) NOT NULL AUTO_INCREMENT,
  `skill_title` varchar(200) DEFAULT NULL,
  `skill_title_si` varchar(200) DEFAULT NULL,
  `skill_title_ta` varchar(200) DEFAULT NULL,
  `skill_description` varchar(500) DEFAULT NULL,
  `skill_description_si` varchar(500) DEFAULT NULL,
  `skill_description_ta` varchar(500) DEFAULT NULL,
  `skill_active_flg` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `hs_hr_evl_skill_emp` (
  `emp_skill_id` int(4) NOT NULL AUTO_INCREMENT,
  `eval_id` int(4) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `skill_id` int(4) DEFAULT NULL,
  `emp_skill_from_date` date DEFAULT NULL,
  `emp_skill_to_date` date DEFAULT NULL,
  `emp_skill_active_flg` varchar(1) DEFAULT NULL,
  `emp_skill_approve_flg` varchar(1) DEFAULT NULL,
  `emp_skill_target_indicater` varchar(100) DEFAULT NULL,
  `emp_skill_sup_comment` varchar(500) DEFAULT NULL,
  `emp_skill_mod_comment` varchar(500) DEFAULT NULL,
  `emp_skill_sup_mid_achive` float DEFAULT NULL,
  `emp_skill_sup_end_achive` float DEFAULT NULL,
  `emp_skill_sup_mid_marks` float DEFAULT NULL,
  `emp_skill_sup_end_marks` float DEFAULT NULL,
  `emp_skill_mod_end_marks` float DEFAULT NULL,
  `emp_skill_weight` float DEFAULT NULL,
  PRIMARY KEY (`emp_skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_evl_skill_emp`
	ADD CONSTRAINT `hs_hr_evl_skill_emp_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_skill_emp`
	ADD CONSTRAINT `hs_hr_evl_skill_emp_eval_id`
	FOREIGN KEY(`eval_id`)
	REFERENCES `hs_hr_evl_evaluation`(`eval_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_skill_emp`
	ADD CONSTRAINT `hs_hr_evl_skill_master_emp_skill_id`
	FOREIGN KEY(`skill_id`)
	REFERENCES `hs_hr_evl_skill_master`(`skill_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(21006, 'Define Employee Evaluation', 'ඇගයීම ප්‍රධානියා තහවුරු කිරීම', 'Define Employee Evaluation TA ', 21000, 1, './symfony/web/index.php/evaluation/DefineEmployeeEvaluation', '21.06', 'MOD021', 'searchEmployee,UpdateEmployeeEvaluation,DeleteEmployeeEvaluation');

CREATE TABLE IF NOT EXISTS `hs_hr_evl_ts_master` (
  `ts_id` int(4) NOT NULL AUTO_INCREMENT,
  `ts_title` varchar(200) DEFAULT NULL,
  `ts_title_si` varchar(200) DEFAULT NULL,
  `ts_title_ta` varchar(200) DEFAULT NULL,
  `ts_description` varchar(500) DEFAULT NULL,
  `ts_description_si` varchar(500) DEFAULT NULL,
  `ts_description_ta` varchar(500) DEFAULT NULL,
  `ts_active_flg` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hs_hr_evl_ts_emp` (
  `emp_ts_id` int(4) NOT NULL AUTO_INCREMENT,
  `eval_id` int(4) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `ts_id` int(4) DEFAULT NULL,
  `emp_ts_from_date` date DEFAULT NULL,
  `emp_ts_to_date` date DEFAULT NULL,
  `emp_ts_active_flg` varchar(1) DEFAULT NULL,
  `emp_ts_approve_flg` varchar(1) DEFAULT NULL,
  `emp_ts_target_indicater` varchar(100) DEFAULT NULL,
  `emp_ts_sup_comment` varchar(500) DEFAULT NULL,
  `emp_ts_mod_comment` varchar(500) DEFAULT NULL,
  `emp_ts_sup_mid_achive` float DEFAULT NULL,
  `emp_ts_sup_end_achive` float DEFAULT NULL,
  `emp_ts_sup_mid_marks` float DEFAULT NULL,
  `emp_ts_sup_end_marks` float DEFAULT NULL,
  `emp_ts_mod_end_marks` float DEFAULT NULL,
  `emp_ts_weight` float DEFAULT NULL,
  `emp_ts_client` int(4) DEFAULT NULL,
  PRIMARY KEY (`emp_ts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_evl_ts_emp`
	ADD CONSTRAINT 
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_ts_emp`
	ADD CONSTRAINT 
	FOREIGN KEY(`eval_id`)
	REFERENCES `hs_hr_evl_evaluation`(`eval_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_ts_emp`
	ADD CONSTRAINT 
	FOREIGN KEY(`ts_id`)
	REFERENCES `hs_hr_evl_ts_master`(`ts_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

CREATE TABLE IF NOT EXISTS `hs_hr_evl_evaluation_employee` (
  `ev_id` int(4) NOT NULL AUTO_INCREMENT,
  `eval_id` int(4) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `ev_start_date` date DEFAULT NULL,
  `ev_complete_date` date DEFAULT NULL,
  `ev_fn_rv_active_flg` varchar(1) DEFAULT NULL,
  `ev_ms_rv_active_flg` varchar(1) DEFAULT NULL,
  `ev_ts_rv_active_flg` varchar(1) DEFAULT NULL,
  `ev_fn_rv_percentage` float DEFAULT NULL,  
  `ev_ms_rv_percentage` float DEFAULT NULL,  
  `ev_ts_rv_percentage` float DEFAULT NULL,  
  `ev_fn_weight_total` float DEFAULT NULL, 
  `ev_fn_weight_avg` float DEFAULT NULL, 
  `ev_fn_sup_mid_ach_tot` float DEFAULT NULL, 
  `ev_fn_sup_mid_ach_avg` float DEFAULT NULL,
  `ev_fn_sup_mid_mark_tot` float DEFAULT NULL, 
  `ev_fn_sup_mid_mark_avg` float DEFAULT NULL,
  `ev_fn_sup_end_ach_tot` float DEFAULT NULL, 
  `ev_fn_sup_end_ach_avg` float DEFAULT NULL,
  `ev_fn_sup_end_mark_tot` float DEFAULT NULL, 
  `ev_fn_sup_end_mark_avg` float DEFAULT NULL,
  `ev_fn_mod_end_mark_tot` float DEFAULT NULL, 
  `ev_fn_mod_end_mark_avg` float DEFAULT NULL,
  `ev_fn_sup_mark_tot` float DEFAULT NULL, 
  `ev_fn_mod_mark_tot` float DEFAULT NULL,
  `ev_fn_sup_comment` float DEFAULT NULL, 
  `ev_fn_mod_comment` float DEFAULT NULL,
  `ev_ms_weight_total` float DEFAULT NULL, 
  `ev_ms_weight_avg` float DEFAULT NULL, 
  `ev_ms_sup_mid_ach_tot` float DEFAULT NULL, 
  `ev_ms_sup_mid_ach_avg` float DEFAULT NULL,
  `ev_ms_sup_mid_mark_tot` float DEFAULT NULL, 
  `ev_ms_sup_mid_mark_avg` float DEFAULT NULL,
  `ev_ms_sup_end_ach_tot` float DEFAULT NULL, 
  `ev_ms_sup_end_ach_avg` float DEFAULT NULL,
  `ev_ms_sup_end_mark_tot` float DEFAULT NULL, 
  `ev_ms_sup_end_mark_avg` float DEFAULT NULL,
  `ev_ms_mod_end_mark_tot` float DEFAULT NULL, 
  `ev_ms_mod_end_mark_avg` float DEFAULT NULL,
  `ev_ms_sup_mark_tot` float DEFAULT NULL, 
  `ev_ms_mod_mark_tot` float DEFAULT NULL,
  `ev_ms_sup_comment` float DEFAULT NULL, 
  `ev_ms_mod_comment` float DEFAULT NULL,
  `ev_ts_weight_total` float DEFAULT NULL, 
  `ev_ts_weight_avg` float DEFAULT NULL, 
  `ev_ts_sup_mid_ach_tot` float DEFAULT NULL, 
  `ev_ts_sup_mid_ach_avg` float DEFAULT NULL,
  `ev_ts_sup_mid_mark_tot` float DEFAULT NULL, 
  `ev_ts_sup_mid_mark_avg` float DEFAULT NULL,
  `ev_ts_sup_end_ach_tot` float DEFAULT NULL, 
  `ev_ts_sup_end_ach_avg` float DEFAULT NULL,
  `ev_ts_sup_end_mark_tot` float DEFAULT NULL, 
  `ev_ts_sup_end_mark_avg` float DEFAULT NULL,
  `ev_ts_mod_end_mark_tot` float DEFAULT NULL, 
  `ev_ts_mod_end_mark_avg` float DEFAULT NULL,
  `ev_ts_sup_mark_tot` float DEFAULT NULL, 
  `ev_ts_mod_mark_tot` float DEFAULT NULL,
  `ev_ts_sup_comment` float DEFAULT NULL, 
  `ev_ts_mod_comment` float DEFAULT NULL,
  `ev_appraisee_comment` varchar(500) DEFAULT NULL,
  `ev_appraiser_comment` varchar(500) DEFAULT NULL,
  `ev_final_mark` float DEFAULT NULL,
  `rate_id` int(4) DEFAULT NULL,
  `ev_aggree_rate_flg` varchar(1) DEFAULT NULL,
  `ev_mod_final_mark` float DEFAULT NULL,
  `ev_moderator_comment` varchar(500) DEFAULT NULL,
  `ev_complete_flg` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ev_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_evl_evaluation_employee`
	ADD CONSTRAINT `hs_hr_evl_evaluation_employee_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_evaluation_employee`
	ADD CONSTRAINT `hs_hr_evl_evaluation_employee_eval_id`
	FOREIGN KEY(`eval_id`)
	REFERENCES `hs_hr_evl_evaluation`(`eval_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_evaluation_employee`
        ADD CONSTRAINT `hs_hr_evl_evaluation_employee_rate_id`
        FOREIGN KEY (`rate_id`) 
        REFERENCES `hs_hr_evl_rate` (`rate_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `ev_fn_mod_end_ach_avg` FLOAT NULL DEFAULT NULL AFTER `ev_fn_mod_end_mark_avg` ,
ADD `ev_fn_mod_end_ach_tot` FLOAT NULL DEFAULT NULL AFTER `ev_fn_mod_end_ach_avg`;

ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `ev_ms_mod_end_ach_avg` FLOAT NULL DEFAULT NULL AFTER `ev_ms_mod_end_mark_avg` ,
ADD `ev_ms_mod_end_ach_tot` FLOAT NULL DEFAULT NULL AFTER `ev_ms_mod_end_ach_avg`;

ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `ev_ts_mod_end_ach_avg` FLOAT NULL DEFAULT NULL AFTER `ev_ts_mod_end_mark_avg` ,
ADD `ev_ts_mod_end_ach_tot` FLOAT NULL DEFAULT NULL AFTER `ev_ts_mod_end_ach_avg`;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'searchEmployee,UpdateEmployeeEvaluation,DeleteEmployeeEvaluation,EmployeeEvaluation' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =21006;

ALTER TABLE `hs_hr_evl_skill_emp` ADD `emp_skill_mod_end_achive` FLOAT NULL DEFAULT NULL AFTER `emp_skill_sup_end_marks` ;

ALTER TABLE `hs_hr_evl_ts_emp` ADD `emp_ts_mod_end_achive` FLOAT NULL DEFAULT NULL AFTER `emp_ts_sup_end_marks` ;

INSERT INTO `hs_hr_evl_skill_master` (`skill_id`, `skill_title`, `skill_title_si`, `skill_title_ta`, `skill_description`, `skill_description_si`, `skill_description_ta`, `skill_active_flg`) VALUES
(1, 'Strategic thinking and planing', NULL, NULL, NULL, NULL, NULL, '1'),
(2, 'Leadership and integrity', NULL, NULL, NULL, NULL, NULL, '1'),
(3, 'Corprate responsibility', NULL, NULL, NULL, NULL, NULL, '1'),
(4, 'Creativity', NULL, NULL, NULL, NULL, NULL, '1'),
(5, 'Problem solving and decesion making ', NULL, NULL, NULL, NULL, NULL, '1'),
(6, 'Product / Technical knowledge', NULL, NULL, NULL, NULL, NULL, '1'),
(7, 'Time management', NULL, NULL, NULL, NULL, NULL, '1');

INSERT INTO `hs_hr_evl_ts_master` (`ts_id`, `ts_title`, `ts_title_si`, `ts_title_ta`, `ts_description`, `ts_description_si`, `ts_description_ta`, `ts_active_flg`) VALUES
(1, 'Cooperation', NULL, NULL, NULL, NULL, NULL, '1'),
(2, 'Integrity', NULL, NULL, NULL, NULL, NULL, '1'),
(4, 'skills and competence', NULL, NULL, NULL, NULL, NULL, '1'),
(5, 'team work', NULL, NULL, NULL, NULL, NULL, '1');

ALTER TABLE `hs_hr_evl_ts_emp` ADD `emp_ts_email_client_1` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `emp_ts_send_url_client_1` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `emp_ts_marks_client_1` FLOAT NULL DEFAULT NULL,
ADD `emp_ts_send_url_date_client_1` DATETIME NULL DEFAULT NULL;

ALTER TABLE `hs_hr_evl_ts_emp` ADD `emp_ts_email_client_2` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `emp_ts_send_url_client_2` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `emp_ts_marks_client_2` FLOAT NULL DEFAULT NULL,
ADD `emp_ts_send_url_date_client_2` DATETIME NULL DEFAULT NULL;

ALTER TABLE `hs_hr_evl_ts_emp` ADD `emp_ts_email_client_3` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `emp_ts_send_url_client_3` VARCHAR( 1 ) NULL DEFAULT NULL ,
ADD `emp_ts_marks_client_3` FLOAT NULL DEFAULT NULL,
ADD `emp_ts_send_url_date_client_3` DATETIME NULL DEFAULT NULL;

ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `ev_email_client_1` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `ev_email_client_2` VARCHAR( 100 ) NULL DEFAULT NULL ,
ADD `ev_email_client_3` VARCHAR( 100 ) NULL DEFAULT NULL ;

-- INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
-- (21007, 'Client Evaluation', 'ඇගයීම පාරිභෝගික', 'Client Evaluation TA ', 21000, 1, './symfony/web/index.php/evaluation/UpdateClientEvaluation', '21.07', 'MOD021', '');

ALTER TABLE `hs_hr_evl_ts_emp` ADD `emp_ts_marks_client_summary` FLOAT NULL DEFAULT NULL;


ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `ev_avg_client_1` FLOAT NULL DEFAULT NULL ,
ADD `ev_avg_client_2` FLOAT NULL DEFAULT NULL ,
ADD `ev_avg_client_3` FLOAT NULL DEFAULT NULL ,
ADD `ev_tot_client_1` FLOAT NULL DEFAULT NULL ,
ADD `ev_tot_client_2` FLOAT NULL DEFAULT NULL ,
ADD `ev_tot_client_3` FLOAT NULL DEFAULT NULL ;

ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `emp_ts_marks_client_avg_summary` FLOAT NULL DEFAULT NULL;
ALTER TABLE `hs_hr_evl_evaluation_employee` ADD `emp_ts_marks_client_tot_summary` FLOAT NULL DEFAULT NULL;

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(21008, 'View Employee Evaluation', 'ඇගයීම', 'View Employee Evaluation TA ', 21000, 1, './symfony/web/index.php/evaluation/ViewEmployeeEvaluation', '21.07', 'MOD021', 'searchEmployee,UpdateEmployeeEvaluation,DeleteEmployeeEvaluation');

alter table hs_hr_evl_evaluation_employee add unique index(`eval_id`,`emp_number`);

UPDATE `hs_hr_evl_skill_master` SET `skill_title`='Leadership' WHERE `skill_id`='2';

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency`='searchEmployee,UpdateEmployeeEvaluation,DeleteEmployeeEvaluation,EmployeeEvaluation,Year' WHERE `sm_mnuitem_id`='21006';

ALTER TABLE `hs_hr_evl_functions_tasks` CHANGE `ft_target_indicater` `ft_target_indicater` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;


-- Menu update 2014-12-05
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Work/Professional Category', `sm_mnuitem_name_ta` = 'Work/Professional Category TA ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 21002;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Add Functions/Tasks', `sm_mnuitem_name_ta` = 'Add Functions/Tasks TA ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 21004;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Approve Functions/Tasks ', `sm_mnuitem_name_ta` = 'Approve Functions/Tasks TA ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 21005;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Define Evaluation Framework', `sm_mnuitem_name_ta` = 'Define Evaluation Framework TA ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 21006;
