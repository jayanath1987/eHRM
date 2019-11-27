SET NAMES 'UTF8';


-- -------------------- Payroll Module ----------------------------------------

INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD019', 'Payroll', 'පඩිපත ',' Payroll ta', NULL, NULL, NULL, NULL, NULL);

-- Jayanath Payroll Menu Insert  2011-08-19  
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
VALUES 
(19000, 'Payroll', 'පඩිපත', 'Payroll_ta', 0, 0, '#', '19.00', 'MOD019', NULL),
(19001, 'Employee Payroll Information', 'සේවක පඩිපත් තොරතුරු', 'Employee Payroll Information_ta', 19000, 1, './symfony/web/index.php/payroll/EmployeePayrollInformation', '19.01', 'MOD019', 'UpdateEmployeePayrollInformation,EmployeePayrollInformation,DeletePayrollInformation'),
(19002, 'Administration', 'පරිපාලන', 'Administration_ta', 19000, 1, '#', '19.02', 'MOD019', ''),
(19003, 'Transaction type information', 'Transaction type information', 'Transaction type information', 19002, 2, './symfony/web/index.php/payroll/TransActiontypeSummary', '19.02.01', 'MOD019', 'DeleteTransactionType,TransActionTypeInfo'),
(19004, 'Transaction detail information', 'Transaction detail information', 'Transaction detail information', 19002, 2, './symfony/web/index.php/payroll/TransActionDetailSummary', '19.02.02', 'MOD019', 'TransActDetails,DeleteTransactionDetails'),
(19005, 'Configuration', 'Configuration', 'Configuration', 19000, 1, './symfony/web/index.php/payroll/Configuration', '19.03', 'MOD019', ''),
(19006, 'Employee transaction details', 'Employee transaction details', 'Employee transaction details', 19000, 1, './symfony/web/index.php/payroll/SalarayIncrement', '19.04', 'MOD019', ''),
(19007, 'Employee transaction details by transaction', 'Employee transaction details by transaction', 'Employee transaction details by transaction', 19000, 1, './symfony/web/index.php/payroll/AssignEmployees', '19.05', 'MOD019', ''),
(19008, 'Employee salary increment', 'Employee salary increment', 'Employee salary increment', 19000, 1, '#', '19.06', 'MOD019', ''),
(19009, 'Salary increment process', 'Salary increment process', 'Salary increment process', 19008, 2, './symfony/web/index.php/payroll/SalarayIncrement', '19.06.01', 'MOD019', 'UpdateSalarayIncrement,DeleteSalarayIncrement'),
(19011, 'Payroll process', 'Payroll process', 'Payroll process', 19000, 1, '#', '19.07', 'MOD009', NULL),
(19012, 'Payroll process', 'Payroll process', 'Payroll process', 19011, 2, './symfony/web/index.php/payroll/StartProcess', '19.07.01', 'MOD019', NULL),
(19013, 'Bank details', 'බැංකු විස්තර', 'Bank details', 19000, 1, '#', '19.08', 'MOD018', NULL),
(19014, 'Bank', 'බැංකු විස්තර', 'Bank', 19013, 2, './symfony/web/index.php/payroll/BankDetails', '19.08.01', 'MOD019', 'UpdateBankDetails,DeleteBankDetails,BankDetails'),
(19015, 'Branch', 'බැංකු ශාඛා', 'Branch', 19013, 2, './symfony/web/index.php/payroll/BranchDetails', '19.08.02', 'MOD019', 'UpdateBranchDetails,DeleteBranchDetails,BranchDetails'),
(19016, 'Employee vote Information', 'සේවක ඡන්ද තොරතුරු', 'Employee vote Information', 19002, 2, './symfony/web/index.php/payroll/VoteDetails', '19.02.03', 'MOD019', 'UpdateVoteDetails,DeleteVoteDetails,VoteDetails'),
(19017, 'Employee Bank Details', 'සේවක බැංකු විස්තර', 'Employee Bank Details_ta', 19013, 2, './symfony/web/index.php/payroll/EmployeeBankDetails', '19.08.03', 'MOD019', 'EmployeeBankDetails,AjaxEmployeeBankDetails'),
(19018, 'Bank Diskette', 'බැංකු තැටිය', 'Bank Diskette_ta', 19013, 2, './symfony/web/index.php/payroll/BankDiskette', '19.08.04', 'MOD019', 'EmployeeBankDetails,AjaxEmployeeBankDetails,UpdateBankDiskette,DeleteBankDiskette'),
(19019, 'Bank Diskette Process', 'බැංකු තැටිය සැකසීම', 'Bank Diskette Process_ta', 19013, 2, './symfony/web/index.php/payroll/BankDisketteProcess', '19.08.05', 'MOD019', 'BankDisketteProcess,AjaxBankDisketteProcess,UpdateBankDisketteProcess,BankDisketteCreation,DeleteBankDisketteProcess');


-- Jayanath Payroll vote type table create  2011-08-19 

CREATE TABLE IF NOT EXISTS `hs_pr_vote_info_type` (
  `vt_inf_type_code` int(11) NOT NULL,
  `vt_inf_type_name` varchar(200) DEFAULT NULL,
  `vt_inf_type_name_si` varchar(200) DEFAULT NULL,
  `vt_inf_type_name_ta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`vt_inf_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `hs_pr_vote_info_type` CHANGE `vt_inf_type_code` `vt_inf_type_code` INT( 11 ) NOT NULL AUTO_INCREMENT ;

-- Jayanath Payroll vote table alter  2011-08-19 

ALTER TABLE `hs_pr_vote_info` DROP `vt_typ_category` ;

ALTER TABLE `hs_pr_vote_info`  ADD `vt_typ_name_si` VARCHAR(200) NULL DEFAULT NULL AFTER `vt_typ_name`,  ADD `vt_typ_name_ta` VARCHAR(200) NULL DEFAULT NULL AFTER `vt_typ_name_si`,  ADD `vt_inf_type_code` INT(11) NULL DEFAULT NULL AFTER `vt_typ_name_ta`;

ALTER TABLE `hs_pr_vote_info`
       	ADD CONSTRAINT `hs_pr_vote_info_hs_pr_vote_info_type`
	FOREIGN KEY (`vt_inf_type_code`)
        REFERENCES `hs_pr_vote_info_type`(`vt_inf_type_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_vote_info` CHANGE `vt_typ_code` `vt_typ_code` INT( 11 ) NOT NULL AUTO_INCREMENT;

-- Jayanath Payroll vote type table Default insert  2011-08-19 

INSERT INTO `hs_pr_vote_info_type` (`vt_inf_type_code`, `vt_inf_type_name`, `vt_inf_type_name_si`, `vt_inf_type_name_ta`) VALUES 
(1, 'Salaray', 'වැටුප', 'Salaray_ta'), 
(2, 'EPF', 'ඊ.පී.එෆ්', 'EPF_ta'),
(3, 'ETF', 'ඊ.ටී.එෆ්', 'EPF_ta');

-- Jayanath Payroll type table crate  2011-08-22 

CREATE TABLE IF NOT EXISTS `hs_pr_payroll_type` (
  `prl_type_code` int(11) NOT NULL AUTO_INCREMENT,
  `prl_type_name` varchar(200) DEFAULT NULL,
  `prl_type_name_si` varchar(200) DEFAULT NULL,
  `prl_type_name_ta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`prl_type_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Jayanath Payroll employee table alter  2011-08-22 

ALTER TABLE `hs_pr_employee` ADD `prl_type_code` INT( 11 ) NULL DEFAULT NULL ;

ALTER TABLE `hs_pr_employee`
       	ADD CONSTRAINT `hs_pr_employee_hs_pr_payroll_type`
	FOREIGN KEY (`prl_type_code`)
        REFERENCES `hs_pr_payroll_type`(`prl_type_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

-- Jayanath Payroll type Default insert  2011-08-22 

INSERT INTO `hs_pr_payroll_type` (`prl_type_code`, `prl_type_name`, `prl_type_name_si`, `prl_type_name_ta`) 
VALUES 
(1, 'Manager Payroll', 'Manager Payroll_si', 'Manager Payroll_ta'), 
(2, 'SDO Payroll', 'SDO Payroll_si', 'SDO Payroll_ta'),
(3, 'Permanent Payroll', 'Permanent Payroll_si', 'Permanent Payroll_ta'), 
(4, 'Secondman Payroll', 'Secondman Payroll_si', 'Secondman Payroll_ta');

-- Jayanath Payroll employee table alter  2011-08-22 

alter table hs_pr_employee drop foreign key hs_pr_employee_ibfk_1;
alter table hs_pr_employee drop foreign key hs_pr_employee_ibfk_2;
alter table hs_pr_employee drop foreign key hs_pr_employee_ibfk_3;

ALTER TABLE `hs_pr_employee` DROP INDEX `vt_epf_code` ;
ALTER TABLE `hs_pr_employee` DROP INDEX `vt_etf_code` ;

ALTER TABLE `hs_pr_employee`
       	ADD CONSTRAINT `hs_pr_vote_info_vt_sal_code`
	FOREIGN KEY (`vt_sal_code`)
        REFERENCES `hs_pr_vote_info_type`(`vt_inf_type_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_employee`
       	ADD CONSTRAINT `hs_pr_vote_info_vt_epf_code`
	FOREIGN KEY (`vt_epf_code`)
        REFERENCES `hs_pr_vote_info_type`(`vt_inf_type_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_employee`
       	ADD CONSTRAINT `hs_pr_vote_info_vt_etf_code`
	FOREIGN KEY (`vt_etf_code`)
        REFERENCES `hs_pr_vote_info_type`(`vt_inf_type_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_employee` ADD `emp_epf_number` VARCHAR( 25 ) NULL DEFAULT NULL ,
ADD `emp_etf_number` VARCHAR( 25 ) NULL DEFAULT NULL ;

ALTER TABLE `hs_pr_employee` ADD `sal_cash_flag` VARCHAR( 1 ) NULL DEFAULT NULL; 

-- Jayanath Payroll pay shedule table alter  2011-08-23 

ALTER TABLE `hs_pr_pay_schedule` DROP PRIMARY KEY, ADD PRIMARY KEY (`pay_sch_id`);

ALTER TABLE `hs_pr_pay_schedule` CHANGE `pay_sch_id` `pay_sch_id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `hs_pr_pay_schedule` CHANGE `pay_sch_st_date` `pay_sch_st_date` DATE NOT NULL, 
CHANGE `pf_code` `pf_code` INT(11) NULL DEFAULT NULL, 
CHANGE `pay_sch_end_date` `pay_sch_end_date` DATE NULL DEFAULT NULL, 
CHANGE `pay_sch_processed_flg` `pay_sch_processed_flg` INT(1) NULL DEFAULT NULL, 
CHANGE `pay_sch_disabled_flg` `pay_sch_disabled_flg` INT(1) NULL DEFAULT NULL, 
CHANGE `pay_sch_year` `pay_sch_year` INT(4) NULL DEFAULT NULL, 
CHANGE `dbgroup_user_id` `dbgroup_user_id` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `hs_pr_pay_schedule` ADD `pay_sch_month` INT( 2 ) NULL DEFAULT NULL; 
ALTER TABLE `hs_pr_pay_schedule` DROP FOREIGN KEY `hs_pr_pay_schedule_ibfk_1` ;
ALTER TABLE `hs_pr_pay_schedule` DROP INDEX `xif1hs_pr_pay_schedule`;
ALTER TABLE `hs_pr_pay_schedule` DROP `pf_code` ; 

-- Jayanath Payroll pay shedule table alter  2011-08-26 

ALTER TABLE `hs_pr_pay_schedule` ADD `pay_hie_code` INT(6) NULL DEFAULT NULL;

ALTER TABLE `hs_pr_pay_schedule`
       	ADD CONSTRAINT `hs_pr_pay_schedule_hs_hr_compstructtree`
	FOREIGN KEY (`pay_hie_code`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

-- Jayanath Payroll pay shedule table view  2011-08-26 

drop view if exists  vw_hs_pr_payshedule;
CREATE VIEW vw_hs_pr_payshedule  as
select * from hs_pr_pay_schedule s 

where pay_hie_code=(
select  
CASE WHEN hie_code_4 is null
THEN 
e.hie_code_3 
ELSE 
         e.hie_code_4
end
from hs_hr_employee e where e.emp_number=getUser());

-- Jayanath Payroll pay shedule table alter 2011-08-29

ALTER TABLE `hs_pr_pay_schedule` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `pay_sch_st_date` , `pay_sch_end_date` , `pay_sch_year` , `pay_hie_code` );  

ALTER TABLE `hs_pr_pay_schedule` DROP `pay_sch_id` ;

ALTER TABLE `hs_pr_pay_schedule` ADD `pay_sch_id` INT( 11 ) NOT NULL FIRST; 

ALTER TABLE `hs_pr_pay_schedule` CHANGE `pay_sch_id` `pay_sch_id` INT( 11 ) NOT NULL DEFAULT '0';

-- Jayanath Payroll Incriment table alter  2011-08-30

ALTER TABLE `hs_pr_increment`  ADD `inc_previous_grade_code` INT(4) NULL DEFAULT NULL,  
ADD `inc_previous_slt_scale_year` INT(10) NULL DEFAULT NULL,  
ADD `inc_new_grade_code` INT(4) NULL DEFAULT NULL,  
ADD `inc_new_slt_scale_year` INT(10) NULL DEFAULT NULL,  
ADD `inc_comment` VARCHAR(200) NULL DEFAULT NULL;

ALTER TABLE `hs_pr_increment`
	ADD CONSTRAINT `hs_hr_grade_inc_new_slt_scale_year`
	FOREIGN KEY(`inc_new_slt_scale_year`)
	REFERENCES `hs_hr_grade_slot`(`slt_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment`
	ADD CONSTRAINT `hs_hr_grade_inc_new_grade_code`
	FOREIGN KEY(`inc_new_grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment`
	ADD CONSTRAINT `hs_hr_grade_slot_inc_previous_slt_scale_year`
	FOREIGN KEY(`inc_previous_slt_scale_year`)
	REFERENCES `hs_hr_grade_slot`(`slt_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment`
	ADD CONSTRAINT `hs_hr_grade_inc_previous_grade_code`
	FOREIGN KEY(`inc_previous_grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment` DROP PRIMARY KEY, ADD PRIMARY KEY (`emp_number`, `inc_new_grade_code`, `inc_new_slt_scale_year`);

ALTER TABLE `hs_pr_increment`  ADD `inc_confirm_flag` INT(1) NULL DEFAULT NULL;

ALTER TABLE `hs_pr_increment`  ADD `inc_effective_date` DATE NULL DEFAULT NULL;

ALTER TABLE `hs_pr_increment` DROP FOREIGN KEY `hs_pr_increment_ibfk_2` ;

ALTER TABLE `hs_pr_increment` DROP `inc_def_id` ;

-- Jayanath Payroll Incriment table alter 2011-09-06

ALTER TABLE `hs_pr_increment`  ADD `inc_cancel_flag` INT(1) NULL DEFAULT NULL,  ADD `inc_cancel_comment` VARCHAR(200) NULL DEFAULT NULL;

-- Jayanath Payroll Bank table alter 2011-10-03

ALTER TABLE `hs_hr_bank` CHANGE `bnk_main` `bnk_main` INT( 1 ) NULL DEFAULT NULL ;

ALTER TABLE `hs_hr_bank` CHANGE `bank_name` `bank_name` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_bank` ADD `bank_name_si` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `bank_name` ,
ADD `bank_name_ta` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `bank_name_si`;

ALTER TABLE `hs_hr_bank` ADD `bank_address_si` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `bank_address` ,
ADD `bank_address_ta` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `bank_address_si`;

-- Jayanath Payroll Bank Account Type table alter 2011-10-03

ALTER TABLE `hs_hr_bank_account_type` CHANGE `acctype_id` `acctype_id` INT( 6 ) NOT NULL;

ALTER TABLE `hs_hr_emp_bank` CHANGE `ebank_acc_type_flg` `ebank_acc_type_flg` INT( 6 ) NOT NULL;

ALTER TABLE `hs_hr_bank_account_type` CHANGE `acctype_name` `acctype_name` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `hs_hr_bank_account_type` ADD `acctype_name_si` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_bank_account_type` ADD `acctype_name_ta` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_emp_bank` CHANGE `ebank_active_flag` `ebank_active_flag` INT( 1 ) NULL DEFAULT NULL; 

ALTER TABLE `hs_pr_bank_transfers` CHANGE `ebank_acc_type_flg` `ebank_acc_type_flg` INT( 6 ) NOT NULL; 

ALTER TABLE `hs_hr_branch` ADD `bbranch_address_si` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `bbranch_address` ,
ADD `bbranch_address_ta` VARCHAR( 200 ) NULL AFTER `bbranch_address_si`;

ALTER TABLE `hs_hr_branch` ADD `bbranch_name_si` VARCHAR( 120 ) NULL DEFAULT NULL AFTER `bbranch_name` ,
ADD `bbranch_name_ta` VARCHAR( 120 ) NULL DEFAULT NULL AFTER `bbranch_name_si`;  

ALTER TABLE `hs_hr_branch` CHANGE `bbranch_sliptransfers_flg` `bbranch_sliptransfers_flg` INT( 1 ) NULL DEFAULT NULL; 

-- Jayanath Payroll vote table alter 2011-10-12

ALTER TABLE `hs_pr_vote_info` CHANGE `vt_typ_code` `vt_typ_code` INT( 11 ) NOT NULL AUTO_INCREMENT; 

-- Jayanath Payroll Bank table alter 2011-10-12

ALTER TABLE `hs_hr_bank` ADD `bank_user_code` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `bank_code`; 

ALTER TABLE `hs_hr_bank` ADD UNIQUE (`bank_user_code` ,`bank_name` ,`bank_address`);

ALTER TABLE `hs_hr_branch` ADD `bbranch_user_code` VARCHAR( 200 ) NULL DEFAULT NULL AFTER `bbranch_code` ,
ADD UNIQUE (
`bbranch_user_code`
);

-- Jayanath Payroll Employee Bank table alter 2011-10-13

ALTER TABLE `hs_hr_emp_bank` ADD `ebank_comment` VARCHAR( 200 ) NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_emp_bank`  DROP `ebank_acc_type_flg`;

ALTER TABLE `hs_hr_emp_bank` ADD `acctype_id` INT( 6 ) NULL DEFAULT NULL AFTER `ebank_acc_no`;

ALTER TABLE `hs_hr_emp_bank` CHANGE `ebank_order` `ebank_order` INT( 4 ) NULL DEFAULT NULL; 

DROP TABLE `hs_hr_bank_account_type`;

CREATE TABLE IF NOT EXISTS `hs_hr_bank_account_type` (
  `acctype_id` int(6) NOT NULL,
  `acctype_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `acctype_name_si` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `acctype_name_ta` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`acctype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE `hs_hr_emp_bank` ADD CONSTRAINT `hs_hr_bank_account_type_acctype_id`
	FOREIGN KEY(`acctype_id`)
	REFERENCES `hs_hr_bank_account_type`(`acctype_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;  

ALTER TABLE `hs_hr_emp_bank` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `emp_number` , `bbranch_code` , `ebank_acc_no` , `acctype_id` );


CREATE TABLE `hs_pr_tempprocessemp` (
`batch_id` INT NOT NULL ,
`emp_number` INT NOT NULL ,
`payroll_type` INT NOT NULL
) ENGINE = INNODB;


ALTER TABLE  `hs_pr_tempprocessemp` ADD PRIMARY KEY (  `batch_id` ,  `emp_number` ,  `payroll_type` ) ;



UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_dependency` =  'ViewProcessedEmp' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19012;

CREATE TABLE IF NOT EXISTS `hs_pr_exceptions` (
  `pro_startdate` date NOT NULL,
  `pro_enddate` date NOT NULL,
  `emp_number` int(10) NOT NULL,
  `pro_batch_id` varchar(100) CHARACTER SET latin1 NOT NULL,
  `exception_id` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`pro_startdate`,`pro_enddate`,`emp_number`,`pro_batch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `hs_pr_exceptions_def` (
  `exception_id` int(11) NOT NULL AUTO_INCREMENT,
  `exception_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `exception_name_si` varchar(100) NOT NULL,
  `exception_name_ta` varchar(100) NOT NULL,
  PRIMARY KEY (`exception_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


ALTER TABLE `hs_pr_processedemp`  ADD `pro_user` VARCHAR(6) NULL AFTER `pro_batch_id`;



ALTER TABLE `hs_pr_bank_transfers` CHANGE `ebt_start_date` `ebt_start_date` DATE NOT NULL ,
CHANGE `ebt_end_date` `ebt_end_date` DATE NOT NULL;

ALTER TABLE `hs_pr_employee` ADD UNIQUE (`emp_epf_number`);

ALTER TABLE `hs_pr_employee` ADD UNIQUE (`emp_etf_number`);



delete FROM `hs_hr_sm_mnuitem` where mod_id='MOD019';

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(19000, 'Payroll', 'පඩිපත', 'Payroll_ta', 0, 0, '#', '19.00', 'MOD019', NULL),
(19001, 'Employee Payroll Information', 'සේවක පඩිපත් තොරතුරු', 'Employee Payroll Information_ta', 19000, 1, './symfony/web/index.php/payroll/EmployeePayrollInformation', '19.01', 'MOD019', 'UpdateEmployeePayrollInformation,EmployeePayrollInformation,DeletePayrollInformation'),
(19002, 'Administration', 'පරිපාලන', 'Administration_ta', 19000, 1, '#', '19.02', 'MOD019', ''),
(19003, 'Transaction type information', 'Transaction type information', 'Transaction type information', 19002, 2, './symfony/web/index.php/payroll/TransActiontypeSummary', '19.02.01', 'MOD019', 'DeleteTransactionType,TransActionTypeInfo'),
(19004, 'Transaction detail information', 'Transaction detail information', 'Transaction detail information', 19002, 2, './symfony/web/index.php/payroll/TransActionDetailSummary', '19.02.02', 'MOD019', 'TransActDetails,DeleteTransactionDetails'),
(19005, 'Configuration', 'Configuration', 'Configuration', 19000, 1, './symfony/web/index.php/payroll/Configuration', '19.03', 'MOD019', ''),
(19006, 'Employee transaction details', 'Employee transaction details', 'Employee transaction details', 19000, 1, './symfony/web/index.php/payroll/SalarayIncrement', '19.04', 'MOD019', ''),
(19007, 'Employee transaction details by transaction', 'Employee transaction details by transaction', 'Employee transaction details by transaction', 19000, 1, './symfony/web/index.php/payroll/AssignEmployees', '19.05', 'MOD019', ''),
(19008, 'Employee salary increment', 'Employee salary increment', 'Employee salary increment', 19000, 1, '#', '19.06', 'MOD019', ''),
(19009, 'Salary increment process', 'Salary increment process', 'Salary increment process', 19008, 2, './symfony/web/index.php/payroll/SalarayIncrement', '19.06.01', 'MOD019', 'UpdateSalarayIncrement,DeleteSalarayIncrement'),
(19011, 'Payroll process', 'Payroll process', 'Payroll process', 19000, 1, '#', '19.07', 'MOD019', NULL),
(19012, 'Payroll process', 'Payroll process', 'Payroll process', 19011, 2, './symfony/web/index.php/payroll/StartProcess', '19.07.01', 'MOD019', 'ViewProcessedEmp,ViewPaySlip'),
(19013, 'Bank details', 'බැංකු විස්තර', 'Bank details', 19000, 1, '#', '19.08', 'MOD019', NULL),
(19014, 'Bank', 'බැංකු විස්තර', 'Bank', 19013, 2, './symfony/web/index.php/payroll/BankDetails', '19.08.01', 'MOD019', 'UpdateBankDetails,DeleteBankDetails,BankDetails'),
(19015, 'Branch', 'බැංකු ශාඛා', 'Branch', 19013, 2, './symfony/web/index.php/payroll/BranchDetails', '19.08.02', 'MOD019', 'UpdateBranchDetails,DeleteBranchDetails,BranchDetails'),
(19016, 'Employee vote Information', 'සේවක ඡන්ද තොරතුරු', 'Employee vote Information', 19002, 2, './symfony/web/index.php/payroll/VoteDetails', '19.02.03', 'MOD019', 'UpdateVoteDetails,DeleteVoteDetails,VoteDetails'),
(19017, 'Employee Bank Details', 'සේවක බැංකු විස්තර', 'Employee Bank Details_ta', 19013, 2, './symfony/web/index.php/payroll/EmployeeBankDetails', '19.08.03', 'MOD019', 'EmployeeBankDetails,AjaxEmployeeBankDetails,UpdateBankDiskette'),
(19018, 'Bank Diskette', 'බැංකු තැටිය', 'Bank Diskette_ta', 19013, 2, './symfony/web/index.php/payroll/BankDiskette', '19.08.04', 'MOD019', 'EmployeeBankDetails,AjaxEmployeeBankDetails,UpdateBankDiskette,DeleteBankDiskette'),
(19019, 'Bank Diskette Process', 'බැංකු තැටිය සැකසීම', 'Bank Diskette Process_ta', 19013, 2, './symfony/web/index.php/payroll/BankDisketteProcess', '19.08.05', 'MOD019', 'BankDisketteProcess,AjaxBankDisketteProcess,UpdateBankDisketteProcess,BankDisketteCreation,DeleteBankDisketteProcess');


ALTER TABLE  `hs_pr_transaction_details` CHANGE  `trn_dtl_code`  `trn_dtl_code` INT( 6 ) NOT NULL AUTO_INCREMENT;

drop TABLE IF EXISTS hs_pr_contribution_base;

CREATE TABLE IF NOT EXISTS `hs_pr_contribution_base` (
  `trn_dtl_code` int(6) NOT NULL,
  `trn_dtl_base_code` int(11) NOT NULL,
  `trn_contribute_code` int(10) DEFAULT NULL,
  `dbgroup_user_id` varchar(30) NOT NULL,
  PRIMARY KEY (`trn_dtl_code`,`trn_dtl_base_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `hs_hr_bank_account_type` (`acctype_id`, `acctype_name`, `acctype_name_si`, `acctype_name_ta`) VALUES
(1, 'Savings', NULL, NULL),
(2, 'Current', NULL, NULL);


-- to be release
UPDATE  `hs_pr_vote_info_type` SET  `vt_inf_type_name` =  'Salary' WHERE `hs_pr_vote_info_type`.`vt_inf_type_code` =1;

UPDATE  `hs_pr_transaction_type` SET  `trn_typ_name` =  'Variable Deductions' WHERE `hs_pr_transaction_type`.`trn_typ_code` =6;

UPDATE  `hs_pr_transaction_type` SET  `trn_typ_name` =  'Variable  Earning' WHERE `hs_pr_transaction_type`.`trn_typ_code` =8;

UPDATE  `hs_pr_transaction_type` SET  `trn_typ_name` =  'Fixed Deductions' WHERE `hs_pr_transaction_type`.`trn_typ_code` =9;


INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD020', 'Loan', 'ණය','Loan_ta', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(20000, 'Loan', 'ණය', 'Loan_ta', 0, 0, '#', '20.00', 'MOD020', NULL),
(20001, 'Administration', 'පරිපාලනය', 'Administration_ta', 20000, 1, '#', '20.01', 'MOD020', ''),
(20002, 'Define Loan Type', 'ණය වර්ග නිර්චණය', 'Define Loan Type_ta', 20001, 1, './symfony/web/index.php/loan/LoanType', '20.01.01', 'MOD020', 'LoanType,SaveLoanType,DeleteLoanType'),
(20003, 'Apply Loan', 'ණය ඉල්ලුම් කිරීම', 'Apply Loan_ta', 20000, 1, '#', '20.02', 'MOD020', ''),
(20004, 'Application', 'ඉල්ලුම් පත්‍රය', 'Application_ta', 20003, 1, './symfony/web/index.php/loan/AppliedLoan', '20.02.01', 'MOD020', 'AppliedLoan,SaveApplication,DeleteApplication'),
(20005, 'Loan Settlement', 'ණය පියවීම', 'Loan Settlement_ta', 20000, 1, './symfony/web/index.php/loan/LoanSettlement', '20.04', 'MOD020', 'SaveLoanSettlement,LoanSettlement'),
(20006, 'Loan History and Status', 'ණය ඉතිහාසය සහ තත්වය', 'Loan History and Status_ta', 20000, 1, './symfony/web/index.php/loan/LoanHistoryandStatus', '20.05', 'MOD020', 'LoanHistoryandStatus');


-- QA Release Alters Increment Cancel 2012-01-04

CREATE TABLE IF NOT EXISTS `hs_pr_increment_cancel` (
  `emp_number` int(7) NOT NULL,
  `inc_amount` decimal(13,2) DEFAULT NULL,
  `inc_previous_salary` decimal(13,2) DEFAULT NULL,
  `inc_new_salary` decimal(13,2) DEFAULT NULL,
  `app_approved` decimal(1,0) DEFAULT NULL,
  `inc_sal_grd_code` varchar(6) DEFAULT NULL,
  `wfmain_id` varchar(6) DEFAULT NULL,
  `inc_previous_point` decimal(10,0) DEFAULT NULL,
  `wfmain_sequence` decimal(10,0) DEFAULT NULL,
  `inc_new_point` decimal(10,0) DEFAULT NULL,
  `inc_isprocessed` smallint(6) DEFAULT NULL,
  `inc_points_increased` decimal(10,0) DEFAULT NULL,
  `wftype_code` decimal(10,0) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  `inc_previous_grade_code` int(4) DEFAULT NULL,
  `inc_previous_slt_scale_year` int(10) DEFAULT NULL,
  `inc_new_grade_code` int(4) NOT NULL DEFAULT '0',
  `inc_new_slt_scale_year` int(10) NOT NULL DEFAULT '0',
  `inc_comment` varchar(200) DEFAULT NULL,
  `inc_confirm_flag` int(1) DEFAULT NULL,
  `inc_effective_date` date DEFAULT NULL,
  `inc_cancel_flag` int(1) DEFAULT NULL,
  `inc_cancel_comment` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`inc_new_grade_code`,`inc_new_slt_scale_year`),
  KEY `xif5hs_pr_increment_can` (`emp_number`),
  KEY `hs_hr_grade_inc_new_slt_scale_year_can` (`inc_new_slt_scale_year`),
  KEY `hs_hr_grade_inc_new_grade_code_can` (`inc_new_grade_code`),
  KEY `hs_hr_grade_slot_inc_previous_slt_scale_year_can` (`inc_previous_slt_scale_year`),
  KEY `hs_hr_grade_inc_previous_grade_code_can` (`inc_previous_grade_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `hs_pr_increment_cancel`
	ADD CONSTRAINT `hs_pr_increment_cancel_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment_cancel`
	ADD CONSTRAINT `hs_hr_grade_inc_new_slt_scale_year_can`
	FOREIGN KEY(`inc_new_slt_scale_year`)
	REFERENCES `hs_hr_grade_slot`(`slt_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment_cancel`
	ADD CONSTRAINT `hs_hr_grade_inc_new_grade_code_can`
	FOREIGN KEY(`inc_new_grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment_cancel`
	ADD CONSTRAINT `hs_hr_grade_slot_inc_previous_slt_scale_year_can`
	FOREIGN KEY(`inc_previous_slt_scale_year`)
	REFERENCES `hs_hr_grade_slot`(`slt_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_increment_cancel`
	ADD CONSTRAINT `hs_hr_grade_inc_previous_grade_code_can`
	FOREIGN KEY(`inc_previous_grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

-- INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
-- (19010, 'Salary Increment Cancel Summary', 'Salary Increment Cancel Summary', 'Salary Increment Cancel Summary', 19008, 2, './symfony/web/index.php/payroll/SalarayIncrementCancel', '19.06.02', 'MOD019', 'UpdateSalarayIncrement,DeleteSalarayIncrement');

-- Bugs fixed 20120106
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Transaction Type Information', `sm_mnuitem_name_si` = 'Transaction Type Information', `sm_mnuitem_name_ta` = 'Transaction Type Information' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19003; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Transaction Detail Information', `sm_mnuitem_name_si` = 'Transaction Detail Information', `sm_mnuitem_name_ta` = 'Transaction Detail Information' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19004; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Employee Transaction Details By Transaction', `sm_mnuitem_name_si` = 'Employee Transaction Details By Transaction', `sm_mnuitem_name_ta` = 'Employee Transaction Details By Transaction' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Employee Salary Increment', `sm_mnuitem_name_si` = 'Employee Salary Increment', `sm_mnuitem_name_ta` = 'Employee Salary Increment' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19008; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Salary Increment Process', `sm_mnuitem_name_si` = 'Salary Increment Process', `sm_mnuitem_name_ta` = 'Salary Increment Process' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19009; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Payroll Process', `sm_mnuitem_name_si` = 'Payroll Process', `sm_mnuitem_name_ta` = 'Payroll Process' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19011; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Payroll Process', `sm_mnuitem_name_si` = 'Payroll Process', `sm_mnuitem_name_ta` = 'Payroll Process' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19012; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Bank Details', `sm_mnuitem_name_ta` = 'Bank Details' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19013; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Employee Vote Information', `sm_mnuitem_name_ta` = 'Employee Vote Information' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19016;

-- Bug 5008 

DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 1 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 19011;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 19011;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 1 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 19012;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 19012;

DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19011;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19012;

 INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
 (19012, 'Payroll process', 'Payroll process', 'Payroll process', 19000, 1, './symfony/web/index.php/payroll/StartProcess1', '19.07', 'MOD019', 'ViewProcessedEmp,ViewPaySlip');


-- bug 4995
SET NAMES 'UTF8';
UPDATE `hs_pr_payroll_type` SET `prl_type_name_si` = 'කාළමනාකරු පඩිපත' WHERE `hs_pr_payroll_type`.`prl_type_code` =1;
UPDATE `hs_pr_payroll_type` SET `prl_type_name_si` = 'සමෘද්ධි සංවර්දන නිලධාරී පඩිපත' WHERE `hs_pr_payroll_type`.`prl_type_code` =2;
UPDATE `hs_pr_payroll_type` SET `prl_type_name_si` = 'ස්ථාවර පඩිපත' WHERE `hs_pr_payroll_type`.`prl_type_code` =3;
UPDATE `hs_pr_payroll_type` SET `prl_type_name_si` = 'දෙවන පඩිපත' WHERE `hs_pr_payroll_type`.`prl_type_code` =4;

UPDATE `hs_pr_employee` SET `vt_sal_code` = NULL, `vt_epf_code` = NULL, `vt_etf_code` = NULL;
ALTER TABLE `hs_pr_employee`
       	ADD CONSTRAINT `hs_pr_employee_hs_pr_payroll_type`
	FOREIGN KEY (`prl_type_code`)
        REFERENCES `hs_pr_payroll_type`(`prl_type_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_employee`
	ADD CONSTRAINT `hs_pr_employee_vt_epf_code`
	FOREIGN KEY(`vt_epf_code`)
	REFERENCES `hs_pr_vote_info`(`vt_typ_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;


ALTER TABLE `hs_pr_employee`
	ADD CONSTRAINT `hs_pr_employee_vt_etf_code`
	FOREIGN KEY(`vt_etf_code`)
	REFERENCES `hs_pr_vote_info`(`vt_typ_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_employee`
	ADD CONSTRAINT `hs_pr_employee_vt_sal_code`
	FOREIGN KEY(`vt_sal_code`)
	REFERENCES `hs_pr_vote_info`(`vt_typ_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

-- ALTER TABLE hs_pr_employee DROP FOREIGN KEY `hs_pr_vote_info_vt_sal_code`;
-- show create table hs_pr_employee;



-- bug 5233
INSERT INTO  `hs_hr_formlock_details` (
`frmlock_id` ,
`mod_id` ,
`con_table_name` ,
`con_activity_id` ,
`frmlock_form_name`
)
VALUES (
NULL ,  'MOD019',  'hs_pr_employee',  '1',  'Employee Payroll'
);

-- 20120213 bugs
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'UpdateSalarayIncrement,DeleteSalarayIncrement,SalaryCancelTrue' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19009;

-- 20120214
TRUNCATE TABLE `hs_pr_increment_cancel`;

ALTER TABLE hs_pr_increment_cancel DROP PRIMARY KEY;

ALTER TABLE `hs_pr_increment_cancel`  ADD `inc_cancel_oder` INT NOT NULL AUTO_INCREMENT,  ADD PRIMARY KEY (`inc_cancel_oder`); 

-- Insert Payroll Exceptions 2012-03-14

INSERT INTO `hs_pr_exceptions_def` (`exception_id`, `exception_name`, `exception_name_si`, `exception_name_ta`) VALUES
(1, 'Negative Salary', 'Negative Salary_si', 'Negative Salary_ta'),
(2, 'Success', 'Success_si', 'Success_ta');


-- UAT 2012-03-29
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'TransdetailsIsBase,AssignEmployees,getTransdetailsByAjax,AssignEmployees' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19007;

-- UAT 2012-05-11
ALTER TABLE `hs_pr_transaction_details` ADD UNIQUE(`trn_dtl_user_code`);

--UAT 2012-05-24
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'වැටුප' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19000; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'සේවක වැටුප් තොරතුරු' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19001; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'සේවකයා අනුව ගනුදෙනු' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19007; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'සේවක වැටුප් වැඩිවීම ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19008; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'සේවක වැටුප් වැඩිවීම සැකසුම ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19009; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'සේවක වැටුප් වැඩිවීම අවලංගු කිරීම ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19010; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'වැටුප සැකසුම ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19012;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Add Transactions to Employee' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19007;

TRUNCATE TABLE `hs_hr_sm_payproccapbility`;

ALTER TABLE `hs_hr_sm_payproccapbility` DROP PRIMARY KEY, ADD PRIMARY KEY (`emp_number`, `prl_type_code`);


-- 2012-05-28 Process Bar
CREATE TABLE `hs_pr_progressbar_status` (`pb_user` VARCHAR(36) NULL, 
`pb_startdate` DATETIME NULL, `pb_enddate` DATETIME NULL,
 `pb_emp_total_count` INT NULL, `prl_type_code` INT NULL, 
 `pb_processtime` DATETIME NULL, `pb_emp_remain_count` INT NULL,
 `pb_status` INT NULL, 
PRIMARY KEY (`pb_user`, `pb_startdate`, `prl_type_code`)) ENGINE = InnoDB;

ALTER TABLE `hs_pr_progressbar_status` CHANGE `pb_startdate` `pb_startdate` DATE NULL DEFAULT NULL, CHANGE `pb_enddate` `pb_enddate` DATE NULL DEFAULT NULL;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'ViewProcessedEmp,ViewPaySlip,StartProcess1,ProgressBarReset' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19012;

-- UAT Bug Fixes 2012-07-10
ALTER TABLE `hs_pr_transaction_type` 
ADD UNIQUE INDEX `trn_typ_user_code_UNIQUE` (`trn_typ_user_code` ASC) ;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si`='සේවක වැය විස්තරය' WHERE `sm_mnuitem_id`='19016';

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si`='වැටුප්' WHERE `sm_mnuitem_id`='19000';

-- CR 2012-09-05 Agent add JBL

ALTER TABLE `hs_pr_transaction_details`  ADD `trn_dtl_agent_bank_flg` VARCHAR(1) NULL DEFAULT NULL,  ADD `trn_dtl_bank_code` VARCHAR(8) NULL DEFAULT NULL,  ADD `trn_dtl_branch_code` VARCHAR(6) NULL DEFAULT NULL,  ADD `trn_dtl_account_no` VARCHAR(20) NULL DEFAULT NULL;

ALTER TABLE `hs_pr_transaction_details`
	ADD CONSTRAINT `hs_pr_transaction_details_bank_code`
	FOREIGN KEY(`trn_dtl_bank_code`)
	REFERENCES `hs_hr_bank`(`bank_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_transaction_details`
	ADD CONSTRAINT `hs_pr_transaction_details_bbranch_code`
	FOREIGN KEY(`trn_dtl_branch_code`)
	REFERENCES `hs_hr_branch`(`bbranch_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
