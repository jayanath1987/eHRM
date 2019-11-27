drop table IF EXISTS hs_ln_application;
CREATE TABLE IF NOT EXISTS `hs_ln_application` (
  `ln_app_number` decimal(10,0) NOT NULL,
  `emp_number` int(7) NOT NULL,
  `ln_ty_number` int(10) NOT NULL,
  `ln_app_date` date DEFAULT NULL,
  `ln_app_amount` decimal(18,2) DEFAULT NULL,
  `ln_app_installment` decimal(10,0) DEFAULT NULL,
  `ln_app_no_of_Installments` int(2) DEFAULT NULL,
  `ln_app_elg_amount` decimal(18,2) DEFAULT NULL,
  `ln_app_install_amount` decimal(13,2) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  `ln_app_effective_date` date DEFAULT NULL,
  PRIMARY KEY (`ln_app_number`,`ln_ty_number`),
  KEY `xif1hs_ln_application` (`ln_ty_number`),
  KEY `emp_number` (`emp_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_checklist;
CREATE TABLE IF NOT EXISTS `hs_ln_checklist` (
  `ln_chk_cat_number` decimal(10,0) NOT NULL,
  `ln_chk_number` decimal(10,0) NOT NULL,
  `ln_chk_description` varchar(200) DEFAULT NULL,
  `ln_chk_is_mandatory_flg` decimal(1,0) DEFAULT NULL,
  `ln_chk_type_flg` decimal(1,0) DEFAULT NULL,
  `ln_chk_no_of_gurantee` decimal(10,0) DEFAULT NULL,
  `module_code` varchar(20) DEFAULT NULL,
  `formula_name` varchar(100) DEFAULT NULL,
  `ln_chk_validate_req_flg` decimal(1,0) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ln_chk_number`,`ln_chk_cat_number`),
  KEY `xif1hs_ln_checklist` (`ln_chk_cat_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



drop table IF EXISTS hs_ln_checklist_catagory;
CREATE TABLE IF NOT EXISTS `hs_ln_checklist_catagory` (
  `ln_chk_cat_number` decimal(10,0) NOT NULL,
  `ln_chk_cat_name` varchar(100) DEFAULT NULL,
  `ln_chk_cat_type` decimal(10,0) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ln_chk_cat_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_document;
CREATE TABLE IF NOT EXISTS `hs_ln_document` (
  `ln_doc_number` decimal(10,0) NOT NULL,
  `ln_app_number` decimal(10,0) NOT NULL,
  `ln_ty_number` int(10) NOT NULL,
  `ln_doc_source` mediumblob,
  `ln_doc_ext` varchar(10) DEFAULT NULL,
  `ln_chk_number` decimal(10,0) DEFAULT NULL,
  `ln_chk_cat_number` decimal(10,0) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ln_doc_number`),
  KEY `xif1hs_ln_document` (`ln_chk_number`,`ln_chk_cat_number`),
  KEY `xif2hs_ln_document` (`ln_app_number`,`ln_ty_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_entitlement_detail;
CREATE TABLE IF NOT EXISTS `hs_ln_entitlement_detail` (
  `ln_ent_group_number` decimal(10,0) NOT NULL,
  `emp_number` int(7) NOT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ln_ent_group_number`,`emp_number`),
  KEY `xif2hs_ln_entitlement_detail` (`ln_ent_group_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_entitlement_group;
CREATE TABLE IF NOT EXISTS `hs_ln_entitlement_group` (
  `ln_ent_group_number` decimal(10,0) NOT NULL,
  `ln_ent_description` varchar(200) DEFAULT NULL,
  `elgrp_id` decimal(10,0) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ln_ent_group_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_guarantee;
CREATE TABLE IF NOT EXISTS `hs_ln_guarantee` (
  `ln_gura_number` int(10) NOT NULL AUTO_INCREMENT,
  `ln_app_number` decimal(10,0) NOT NULL,
  `ln_ty_number` int(10) NOT NULL,
  `ln_gura_external_flg` int(1) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `gura_nic_no` varchar(20) DEFAULT NULL,
  `ln_gura_firstname` varchar(200) DEFAULT NULL,
  `ln_gura_middle_name` varchar(200) DEFAULT NULL,
  `ln_gura_surname` varchar(200) DEFAULT NULL,
  `ln_gura_tel` varchar(20) DEFAULT NULL,
  `ln_gura_address1` varchar(200) DEFAULT NULL,
  `ln_gura_address2` varchar(200) DEFAULT NULL,
  `ln_gura_address3` varchar(200) DEFAULT NULL,
  `ln_gura_comment` varchar(400) DEFAULT NULL,
  `ln_chk_number` decimal(10,0) DEFAULT NULL,
  `ln_chk_cat_number` decimal(10,0) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ln_gura_number`),
  KEY `xif1hs_ln_guarantee` (`ln_app_number`,`ln_ty_number`),
  KEY `xif3hs_ln_guarantee` (`ln_chk_number`,`ln_chk_cat_number`),
  KEY `emp_number` (`emp_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


drop table IF EXISTS hs_ln_header;
CREATE TABLE IF NOT EXISTS `hs_ln_header` (
  `emp_number` int(7) NOT NULL,
  `ln_app_number` decimal(10,0) DEFAULT NULL,
  `ln_ty_number` int(10) NOT NULL,
  `ln_hd_sequence` decimal(10,0) NOT NULL,
  `ln_hd_amount` decimal(18,2) DEFAULT NULL,
  `ln_hd_bal_amount` decimal(18,2) DEFAULT NULL,
  `ln_hd_installment` decimal(10,0) DEFAULT NULL,
  `ln_hd_is_active_flg` int(1) DEFAULT NULL,
  `ln_hd_settled_flg` int(1) DEFAULT NULL,
  `ln_hd_user` varchar(100) DEFAULT NULL,
  `ln_hd_apply_date` date DEFAULT NULL,
  `ln_hd_bal_installment` decimal(10,0) DEFAULT NULL,
  `app_approved` decimal(1,0) DEFAULT NULL,
  `wfmain_id` varchar(6) DEFAULT NULL,
  `ln_hd_lst_proc_to_date` datetime DEFAULT NULL,
  `wfmain_sequence` decimal(10,0) DEFAULT NULL,
  `ln_hd_lst_proc_from_date` date DEFAULT NULL,
  `ln_hd_effective_date` date DEFAULT NULL,
  `ln_hd_inactive_period` int(10) DEFAULT NULL,
  `ln_hd_install_amount` decimal(13,2) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  `ln_hd_app_date` date DEFAULT NULL,
  `cancel_approved` decimal(5,0) DEFAULT NULL,
  `cancel_main_id` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`ln_hd_sequence`,`ln_ty_number`),
  KEY `xif2hs_ln_header` (`ln_ty_number`),
  KEY `xif4hs_ln_header` (`ln_app_number`,`ln_ty_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_processed_loan;
CREATE TABLE IF NOT EXISTS `hs_ln_processed_loan` (
  `emp_number` int(7) NOT NULL,
  `ln_hd_sequence` decimal(10,0) NOT NULL,
  `ln_sch_ins_no` decimal(10,0) NOT NULL,
  `ln_ty_number` int(10) NOT NULL,
  `ln_processed_from_date` datetime NOT NULL,
  `ln_processed_to_date` datetime NOT NULL,
  `ln_processed_capital` decimal(18,2) DEFAULT NULL,
  `ln_processed_interest` decimal(18,2) DEFAULT NULL,
  `ln_interest_rate` decimal(13,2) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  `ln_bal_installment` decimal(10,0) DEFAULT NULL,
  `ln_bal_amount` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`ln_hd_sequence`,`ln_sch_ins_no`,`ln_ty_number`,`ln_processed_from_date`,`ln_processed_to_date`),
  KEY `xif1hs_ln_processed_loan` (`emp_number`,`ln_hd_sequence`,`ln_sch_ins_no`,`ln_ty_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_schedule;
CREATE TABLE IF NOT EXISTS `hs_ln_schedule` (
  `emp_number` int(7) NOT NULL,
  `ln_hd_sequence` decimal(10,0) NOT NULL,
  `ln_sch_ins_no` decimal(10,0) NOT NULL,
  `ln_ty_number` int(10) NOT NULL,
  `ln_sch_cap_amt` decimal(18,2) DEFAULT NULL,
  `ln_sch_inst_amount` decimal(13,2) DEFAULT NULL,
  `ln_st_number` int(11) DEFAULT NULL,
  `ln_sch_is_processed` int(1) DEFAULT NULL,
  `ln_sch_inst_rate` decimal(5,2) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  `ln_sch_proc_to_date` date DEFAULT NULL,
  `ln_sch_proc_from_date` date DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`ln_hd_sequence`,`ln_sch_ins_no`,`ln_ty_number`),
  KEY `xif1hs_ln_schedule` (`emp_number`,`ln_hd_sequence`,`ln_ty_number`),
  KEY `xif2hs_ln_schedule` (`ln_st_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


drop table IF EXISTS hs_ln_settlement;
CREATE TABLE IF NOT EXISTS `hs_ln_settlement` (
  `ln_st_number` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) NOT NULL,
  `ln_hd_sequence` decimal(10,0) NOT NULL,
  `ln_st_date` date DEFAULT NULL,
  `ln_st_user` varchar(100) DEFAULT NULL,
  `ln_st_amount` decimal(18,2) DEFAULT NULL,
  `ln_st_installment` decimal(10,0) DEFAULT NULL,
  `ln_st_mode` int(2) DEFAULT NULL,
  `ln_st_last_installment_number` decimal(10,0) DEFAULT NULL,
  `ln_ty_number` int(10) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  `ln_st_interest_amount` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`ln_st_number`),
  KEY `xif1hs_ln_settlement` (`emp_number`,`ln_hd_sequence`,`ln_ty_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

drop table IF EXISTS hs_ln_type;
CREATE TABLE IF NOT EXISTS `hs_ln_type` (
  `ln_ty_number` int(10) NOT NULL AUTO_INCREMENT,
  `elgrp_id` decimal(10,0) DEFAULT NULL,
  `ln_ty_code` varchar(13) DEFAULT NULL,
  `ln_ty_name` varchar(20) DEFAULT NULL,
  `ln_ty_name_si` varchar(20) DEFAULT NULL,
  `ln_ty_name_ta` varchar(20) DEFAULT NULL,
  `ln_ty_description` varchar(100) DEFAULT NULL,
  `ln_ty_description_si` varchar(100) DEFAULT NULL,
  `ln_ty_description_ta` varchar(100) DEFAULT NULL,
  `ln_ty_max_installment` decimal(10,0) DEFAULT NULL,
  `ln_ty_interest_rate` decimal(5,2) DEFAULT NULL,
  `ln_ty_modified_date` date DEFAULT NULL,
  `ln_ty_modified_user` varchar(100) DEFAULT NULL,
  `ln_ty_amount` decimal(18,2) DEFAULT NULL,
  `ln_ty_app_req_flg` decimal(1,0) DEFAULT NULL,
  `wftype_code` decimal(10,0) DEFAULT NULL,
  `ln_ent_group_number` decimal(10,0) DEFAULT NULL,
  `ln_ty_entitlement_type_flg` decimal(1,0) DEFAULT NULL,
  `ln_ty_interest_fixed_amt` decimal(13,2) DEFAULT NULL,
  `ln_ty_interest_type` decimal(1,0) DEFAULT NULL,
  `ln_ty_user_code` varchar(10) DEFAULT NULL,
  `ln_ty_takehm_req_flg` decimal(1,0) DEFAULT NULL,
  `ln_ty_takehm_ptg` decimal(5,2) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  `ln_ty_inactive_type_flg` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`ln_ty_number`),
  KEY `xif1hs_ln_type` (`ln_ent_group_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


drop table IF EXISTS hs_ln_type_check;
CREATE TABLE IF NOT EXISTS `hs_ln_type_check` (
  `ln_ty_number` int(10) NOT NULL,
  `ln_chk_cat_number` decimal(10,0) NOT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ln_ty_number`,`ln_chk_cat_number`),
  KEY `xif1hs_ln_type_check` (`ln_chk_cat_number`),
  KEY `xif2hs_ln_type_check` (`ln_ty_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE  `hs_ln_schedule` ADD  `ln_app_number` INT( 7 ) NOT NULL AFTER  `ln_sch_proc_from_date`;