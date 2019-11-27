SET NAMES 'UTF8';
INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES ('4008', 'Reinstatement', 'නැවත සේවයේ පිහිටුවීම', 'Reinstatement_ta', '4000', '1', './symfony/web/index.php/disciplinary/Reinstatement', '4.08000', 'MOD004', 'Reinstatement,UpdateReinstatement,DeleteReinstatement,AjaxCall,DisplayEmpHirache,LoadGradeSlot,SearchEmployee');

ALTER TABLE `hs_hr_reinstatement`  ADD `pre_emp_epf_number` VARCHAR(25) NULL DEFAULT NULL,  ADD `pre_job_title_code` VARCHAR(13) NULL DEFAULT NULL,  ADD `pre_grade_code` INT(4) NULL DEFAULT NULL,  ADD `pre_slt_id` INT(10) NULL DEFAULT NULL,  ADD `pre_work_station` INT(6) NULL DEFAULT NULL;

ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_pre_jobtit_code`
	FOREIGN KEY(`pre_job_title_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_pre_grade_code`
	FOREIGN KEY(`pre_grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_pre_work_station`
	FOREIGN KEY(`pre_work_station`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_pre_hs_hr_grade_slot`
	FOREIGN KEY (`pre_slt_id`)
	REFERENCES `hs_hr_grade_slot` (`slt_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
