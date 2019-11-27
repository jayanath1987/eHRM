SET NAMES 'UTF8';

-- Givantha Performance Module Alters 2011-06-11

-- -------------------- Performance Module ------------------------------------------

-- --------------------  Performance Module Report Menu Data ------------------------------------------

INSERT INTO `hs_hr_rn_report`(`rn_rpt_id`,`rn_rpt_name`,`rn_rpt_name_si`,`rn_rpt_name_ta`,`rn_rpt_path` ,`mod_id`)
VALUES 
('24', 'Evaluation Details Summary Report ','ඇගයීම විස්තර සාරාංශ වාර්තාව ' ,  ' Evaluation Details Summary', 'Evaluation_Details.rptdesign', 'MOD016'),
('25', 'Duty Evaluation - Employee Specific Detail Report', 'කාර්ය අනුව සේවක කාර්ය ඇගයීම සාරාංශ වාර්තාව ', 'Duty Evaluation - Employee Specific Details', 'Duty_Evaluation_Employee_Specific_Details.rptdesign', 'MOD016'),
('26', 'Project Evaluation - Employee Specific Detail Report', 'ව්‍යාපෘති අනුව සේවක කාර්ය ඇගයීම සාරාංශ වාර්තාව ', 'Project Evaluation - Employee Specific Details', 'Project_Evaluation _Employee_Specific_Details.rptdesign','MOD016'),
('27', 'Ongoing Evaluation Details Summary Report', 'ඉදිරියට යන කාර්ය ඇගයීම පිළිබද සාරාංශ වාර්තාව', 'Evaluation Details - Ongoing Evaluation', 'Ongoing_Evaluation_Evaluation_Details.rptdesign', 'MOD016'),
('28', 'Overall Rating Summary Report', 'සමස්ත අනුපාත පිළබද සාරාංශ වාර්තාව', 'Overall Rating Summary Report', 'Overall_Rating_Summary.rptdesign', 'MOD016');

--
-- ADD PRIMARY KEY CONSTRAINT to hs_hr_perf_eval_job_role 
--
ALTER TABLE `hs_hr_perf_eval_job_role` ADD PRIMARY KEY ( `eval_dtl_id` , `jrl_id` ) ;

-- Change Menu Position Jayanath 2011-11-03 

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '16.03' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 16002; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '16.02' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 16003;

-- 2012-12-27 fist bugs release

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Duty Group', `sm_mnuitem_name_ta` = 'Duty Group_TA' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 16001; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Duty', `sm_mnuitem_name_si` = 'Duty si', `sm_mnuitem_name_ta` = 'Duty Group_TA' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 16002; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Rate', `sm_mnuitem_name_si` = 'Rate si', `sm_mnuitem_name_ta` = 'Rate TA' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 16003; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Company Evaluation', `sm_mnuitem_name_si` = 'Company Evaluation si', `sm_mnuitem_name_ta` = 'Company Evaluation TA' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 16004;

DROP TABLE IF EXISTS  `hs_hr_perf_eval_employee_project`;

DROP TABLE IF EXISTS  `hs_hr_perf_evaluation_project_employee`;

DROP TABLE IF EXISTS  `hs_hr_perf_evaluation_project`;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation_project` (
  `eval_prj_id` int(10) NOT NULL AUTO_INCREMENT,
  `eval_prj_name` varchar(200) DEFAULT NULL,
  `eval_prj_name_si` varchar(200) DEFAULT NULL,
  `eval_prj_name_ta` varchar(200) DEFAULT NULL,
  `eval_prj_completed` varchar(10) DEFAULT NULL,
  `eval_prj_user_code` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`eval_prj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hs_hr_perf_evaluation_project_employee` (
  `eval_prj_id` int(10) DEFAULT NULL,
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

CREATE TABLE IF NOT EXISTS `hs_hr_perf_eval_employee_project` (
  `eval_dtl_id` int(10) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `eval_prj_id` int(10) DEFAULT NULL,
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


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'SaveSDOEvaluation,DeleteSDOEvaluation,UpdateSDOEvaluation,EmployeeProjectWebService' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16008; 

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Evaluate' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16008;




ALTER TABLE `hs_hr_perf_rate_detail` CHANGE `rdt_mark` `rdt_mark` FLOAT( 10 ) NULL DEFAULT NULL ;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '16.06' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16006;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '16.07' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16007;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'Candidate,SaveCandidate,DeleteCandidate,DeleteImage2' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18007;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'SaveAssingEmployee,DeleteAssingEmployee,UpdateAssingEmployee,searchEmployee,LoadGrid,AjaxDeleteAssignEmployee' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16006;

ALTER TABLE  `hs_hr_perf_evaluation_supervisor` ADD  `sup_num` INT( 7 ) NULL AFTER  `emp_number`;

DELETE from `hs_hr_emp_reportto` where `erep_reporting_mode` = '1';

ALTER TABLE `hs_hr_perf_evaluation_supervisor` ADD `eval_type_id` INT( 4 ) NULL DEFAULT NULL; 

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Rating Method',
`sm_mnuitem_name_si` = 'Rating Method si',
`sm_mnuitem_name_ta` = 'Rating Method TA' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16003;

-- UAT Bug Fixed 5770 
SET NAMES 'UTF8';
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'ඇගයීම් ක්‍රමවේදය' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16003;

SET NAMES 'UTF8';
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'රාජකාරි කණ්ඩායම් ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16001;
