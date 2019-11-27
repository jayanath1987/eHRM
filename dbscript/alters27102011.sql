SET NAMES 'UTF8';

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
('5015', 'Training Calander ', 'පුහුණු දින දර්ශනය', 'Training Calander_ta', '5000', '1', './symfony/web/index.php/training/Calander', '05.15', 'MOD005', 'Calander');

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_name` =  'Training Institutes' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5001;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_name` =  'Training Courses' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5002;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_dependency` =  'trainingHistory,Deletetrainassiged,participations' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5006;

DELETE FROM  `hs_hr_sm_mnucapability` WHERE sm_mnuitem_id =  '5005';

DELETE FROM  `hs_hr_sm_mnuitem` WHERE sm_mnuitem_id =  '5005';

ALTER TABLE `hs_hr_td_tarining_plan` DROP `td_plan_institute_name` ,
DROP `td_plan_institute_name_si` ,
DROP `td_plan_institute_name_ta` ;

ALTER TABLE `hs_hr_td_tarining_plan` ADD `td_inst_id` INT( 6 ) NULL DEFAULT NULL AFTER `td_plan_year`;

ALTER TABLE `hs_hr_td_tarining_plan`
	ADD CONSTRAINT `hs_hr_td_tarining_plan_td_inst_id`
	FOREIGN KEY(`td_inst_id`)
	REFERENCES `hs_hr_td_institute`(`td_inst_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

UPDATE `hs_hr_module` SET `name` = 'Training & Development ' WHERE `hs_hr_module`.`mod_id` = 'MOD005';

DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 1 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 5009;

DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5009;

drop view if exists   vw_hs_hr_wf_traning_data;
CREATE VIEW vw_hs_hr_wf_traning_data
   AS select ma.wfmain_id AS ID,wtf.wfmod_id AS `Module ID`,ma.wfmain_flow_id
   AS `APPROVAL LEVEL`,ma.wftype_code AS `WorkFlow Type Code`,ma.wfmain_approving_emp_number
   AS `Approving_Employee`,e.emp_number AS `Employee Number`,e.employee_id
   AS `Employee ID`, e.emp_display_name
   AS `Employee Name`,
td.td_asl_year AS `Traning Year`,c.td_course_name_en AS `Course`,i.td_inst_name_en AS `Institute`
   from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id
   left join hs_hr_employee e on e.emp_number = td.emp_number
   left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
   left join hs_hr_module m on m.mod_id =wtf.wfmod_id
   left join hs_hr_td_course c on c.td_course_id =td.td_course_id
   left join hs_hr_td_institute i on i.td_inst_id =c.td_inst_id
   where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 6
   union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS   'WorkFlow Type Code',ma.wfmain_approving_emp_number
  AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.employee_id
   AS `Employee ID`,e.emp_display_name AS 'Employee Name',td.td_asl_year AS `Traning Year`,c.td_course_name_en AS `Course`,i.td_inst_name_en AS `Institute`
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id
  left join hs_hr_employee e on e.emp_number = td.emp_number
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id
  left join hs_hr_td_course c on c.td_course_id =td.td_course_id
  left join hs_hr_td_institute i on i.td_inst_id =c.td_inst_id
  where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 5
  union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.employee_id
   AS `Employee ID`,e.emp_display_name AS 'Employee Name' ,td.td_asl_year AS `Traning Year`,c.td_course_name_en AS `Course`,i.td_inst_name_en AS `Institute`
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on  ma.wfmain_id = td.wfmain_id
  left join hs_hr_employee e on e.emp_number = td.emp_number
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
  left join hs_hr_td_course c on c.td_course_id =td.td_course_id
  left join hs_hr_td_institute i on i.td_inst_id =c.td_inst_id
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg = 0 and            ma.wftype_code = 4
  union all select ma.wfmain_id AS 'ID',wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS `Employee Number`,e.employee_id
   AS `Employee ID`,e.emp_display_name AS 'Employee Name_en' ,td.td_asl_year AS `Traning Year`,c.td_course_name_en AS `Course`,i.td_inst_name_en AS `Institute`
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id
  left join hs_hr_employee e on e.emp_number = td.emp_number
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code
  left join hs_hr_td_course c on c.td_course_id =td.td_course_id
  left join hs_hr_td_institute i on i.td_inst_id =c.td_inst_id
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg = 0 and  ma.wftype_code = 3;

UPDATE `hs_hr_wf_module` SET `wfmod_name` = 'Training' WHERE `hs_hr_wf_module`.`wfmod_id` = 'MOD005';
