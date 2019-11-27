SET NAMES 'UTF8';

ALTER TABLE `hs_hr_promotion`  ADD `class_code` INT(4) NULL DEFAULT NULL,  ADD `slt_id` INT(10) NULL DEFAULT NULL,  ADD `level_code` INT(4) DEFAULT NULL;

ALTER TABLE `hs_hr_promotion`  ADD `prm_prev_class_code` INT(4) NULL DEFAULT NULL,  ADD `prm_prev_slt_id` INT(10) NULL DEFAULT NULL,  ADD `prm_prev_level_code` INT(4) DEFAULT NULL;

ALTER TABLE `hs_hr_promotion`  ADD `emp_salary_inc_date` DATE NULL DEFAULT NULL,  ADD `prm_prev_emp_salary_inc_date` DATE NULL DEFAULT NULL;


ALTER TABLE `hs_hr_promotion`
  ADD CONSTRAINT `hs_hr_promotion_hs_hr_class` FOREIGN KEY (`class_code`) REFERENCES `hs_hr_class` (`class_code`),
  ADD CONSTRAINT `hs_hr_promotion_hs_hr_class1` FOREIGN KEY (`prm_prev_class_code`) REFERENCES `hs_hr_class` (`class_code`),
  ADD CONSTRAINT `hs_hr_promotion_hs_hr_grade_slot` FOREIGN KEY (`slt_id`) REFERENCES `hs_hr_grade_slot` (`slt_id`),
  ADD CONSTRAINT `hs_hr_promotion_hs_hr_grade_slot1` FOREIGN KEY (`prm_prev_slt_id`) REFERENCES `hs_hr_grade_slot` (`slt_id`),
  ADD CONSTRAINT `hs_hr_promotion_hs_hr_level` FOREIGN KEY (`level_code`) REFERENCES `hs_hr_level` (`level_code`),
  ADD CONSTRAINT `hs_hr_promotion_hs_hr_level1` FOREIGN KEY (`prm_prev_level_code`) REFERENCES `hs_hr_level` (`level_code`);

ALTER TABLE `hs_hr_promotion` ADD `prm_commencement_date` DATE NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_promotion` ADD `prm_prev_service_code` INT( 4 ) NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_promotion`
  ADD CONSTRAINT `hs_hr_promotion_hs_hr_service` FOREIGN KEY (`prm_prev_service_code`) REFERENCES `hs_hr_service` (`service_code`);

ALTER TABLE `hs_hr_promotion` DROP `prm_location`, DROP `prm_new_sal`, DROP `prm_dhscomment`;

DROP TABLE `hs_hr_promotion_ckecklist_detail`;

CREATE TABLE `hs_hr_promotion_ckecklist_detail` 
(`emp_number` INT(7) NOT NULL,
 `prm_checklist_id` INT(4) NOT NULL,
 `prm_value` VARCHAR(1) NULL DEFAULT NULL,
 `prm_complete_date` DATE NULL DEFAULT NULL) ENGINE = InnoDB;

ALTER TABLE `hs_hr_promotion_ckecklist_detail` ADD PRIMARY KEY ( `emp_number` , `prm_checklist_id` ) ;

ALTER TABLE `hs_hr_promotion_ckecklist_detail`
       	ADD CONSTRAINT `hs_hr_promotion_ckecklist_detail_employee`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion_ckecklist_detail`
       	ADD CONSTRAINT `hs_hr_promotion_ckecklist_detail_prm_checklist_id`
	FOREIGN KEY (`prm_checklist_id`)
        REFERENCES `hs_hr_promotion_ckecklist`(`prm_checklist_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion_ckecklist_detail` ADD `prm_comment` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `prm_complete_date`; 

-- 1693 

ALTER TABLE `hs_hr_ckecklist_detail` CHANGE `emp_number` `emp_number` INT( 7 ) NULL DEFAULT NULL ,
CHANGE `prm_checklist_id` `prm_checklist_id` INT( 4 ) NULL DEFAULT NULL ;

ALTER TABLE `hs_hr_promotion` DROP `prm_my_number` ;

-- Jayanath other institute table create 20110909

CREATE TABLE IF NOT EXISTS `hs_hr_other_institute` (
  `oth_inst_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) NOT NULL,
  `oth_institute_name` varchar(200) DEFAULT NULL,
  `oth_release_location` varchar(200) DEFAULT NULL,
  `oth_release_from` date DEFAULT NULL,
  `oth_release_to` date DEFAULT NULL,
  `oth_payroll_active_flg` int(1) NULL,
  `oth_reason` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`oth_inst_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_other_institute`
	ADD CONSTRAINT `hs_hr_employee_hs_hr_other_institute`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;


ALTER TABLE `hs_hr_promotion_ckecklist_detail`
ENGINE = InnoDB;

TRUNCATE TABLE `hs_hr_promotion_ckecklist_detail`;

ALTER TABLE `hs_hr_promotion_ckecklist_detail`
	ADD CONSTRAINT `hs_hr_promotion_ckecklist_detail_ibfk_2`
	FOREIGN KEY(`prm_checklist_id`)
	REFERENCES `hs_hr_promotion_ckecklist`(`prm_checklist_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Probationers Check List', `sm_mnuitem_name_ta` = 'Probationers Check List_ta' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 6003;



INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(6000, 'Promotion', 'උසස් වීම', 'Promotion_ta', 0, 0, '#', '06.00', 'MOD006', NULL),
(6001, 'Promotion Method', 'උසස් වීම් වර්ග', 'Promotion Method_ta', 6000, 1, './symfony/web/index.php/promotion/promotionMethod', '06.01', 'MOD006', 'updatePromotionMethod,savePromotionMethod,DeletePromotionMethod'),
(6002, 'Promotion', 'උසස් වීම', 'Promotion_ta', 6000, 1, './symfony/web/index.php/promotion/listPromotion', '06.02', 'MOD006', 'listPromotion,ListPromotion,savePromotion,updatePromotion,DeletePromotion,searchEmployee,AjaxCall,deletepop'),
(6003, 'Probationers Check List', 'පිරික්සුම් ලැයිස්තුව', 'Promotion Check List_ta', 6000, 1, './symfony/web/index.php/promotion/promotioncklist', '06.03', 'MOD006', 'promotioncklist,updatePromotioncklist,savePromotioncklist,DeletePromotioncklist'),
(6004, 'Probationers', 'පරිවාසික', 'Probationers_ta', 6000, 1, './symfony/web/index.php/promotion/probationlist', '06.04', 'MOD006', 'probationlist,checklist'),
(6005, 'Other Institutions', 'වෙනත් ආයතන', 'Other Institutions_ta', 6000, 1, './symfony/web/index.php/promotion/OtherInstitution', '06.05', 'MOD006', 'OtherInstitution,UpdateOtherInstitution,DeleteOtherInstitution'),
(6006, 'Promotion History', 'උසස් වීම ඉතිහාසය', 'Promotion History_ta', 6000, 1, './symfony/web/index.php/promotion/HistoryPromotion', '06.06', 'MOD006', 'HistoryPromotion,searchEmployee');


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'listPromotion,ListPromotion,savePromotion,updatePromotion,DeletePromotion,searchEmployee,AjaxCall,deletepop,DateValidation' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 6002;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'HistoryPromotion,searchEmployee,EBExam' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6006;

ALTER TABLE `hs_hr_promotion_ckecklist_detail` ADD `prm_ovr_comment` VARCHAR( 200 ) NULL DEFAULT NULL;

-- Alter 20120125

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'listPromotion,ListPromotion,savePromotion,updatePromotion,DeletePromotion,searchEmployee,AjaxCall,deletepop,DateValidation,empDisHistory' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 6002;


