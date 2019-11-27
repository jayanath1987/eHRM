SET NAMES 'UTF8';

DROP TABLE `hs_ln_type_check`;

DROP TABLE `hs_ln_guarantee`;

DROP TABLE `hs_ln_entitlement_detail`;

ALTER TABLE  `hs_ln_type` DROP FOREIGN KEY  `hs_ln_type_ibfk_2` ;

ALTER TABLE  `hs_ln_type` DROP FOREIGN KEY  `hs_ln_type_ibfk_1` ;

ALTER TABLE  `hs_ln_type` DROP INDEX  `xif1hs_ln_type`;

ALTER TABLE  `hs_ln_settlement` DROP FOREIGN KEY  `hs_ln_settlement_ibfk_3` ;

ALTER TABLE  `hs_ln_settlement` DROP FOREIGN KEY  `hs_ln_settlement_ibfk_4` ;





-- Givantha Transfer Alters 2011-08-11

-- -------------------- Loan Module ----------------------------------------

INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD020', 'Loan', ' ණය ','Loan ta', NULL, NULL, NULL, NULL, NULL);

-- -------------------- Loan Module Menu Data  --------------------------------------------

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(20000, 'Loan','ණය' , 'Loan_ta', 0, 0, '#', '20.00', 'MOD020', NULL),
(20001, 'Administration', 'පරිපාලනය' ,  'Administration_ta', 20000, 1, '#', '20.01', 'MOD020', ''),
(20002, 'Define Loan Type', 'ණය වර්ග නිර්චණය', 'Define Loan Type_ta', 20001, 1, './symfony/web/index.php/loan/LoanType', '20.01.01', 'MOD020', 'LoanType,SaveLoanType,DeleteLoanType'),
(20003, 'Apply Loan', 'ණය ඉල්ලුම් කිරීම', 'Apply Loan_ta', 20000, 1, '#', '20.02', 'MOD020', ''),
(20004, 'Application', 'ඉල්ලුම් පත්‍රය', 'Application_ta', 20003, 1, './symfony/web/index.php/loan/AppliedLoan', '20.02.01', 'MOD020', 'AppliedLoan,SaveApplication,DeleteApplication'),
(20005, 'Loan Settlement', 'ණය පියවීම', 'Loan Settlement_ta', 20000, 1, './symfony/web/index.php/loan/LoanSettlement', '20.04', 'MOD020', 'SaveLoanSettlement,LoanSettlement'),
(20006, 'Loan History and Status', 'ණය ඉතිහාසය සහ තත්වය', 'Loan History and Status_ta', 20000, 1, './symfony/web/index.php/loan/LoanHistoryandStatus', '20.05', 'MOD020', 'LoanHistoryandStatus');

INSERT INTO  `hs_hr_formlock_details` (
`frmlock_id` ,
`mod_id` ,
`con_table_name` ,
`con_activity_id` ,
`frmlock_form_name`
)
VALUES (
null ,  'MOD020',  'hs_ln_application',  '1',  'Loan Application');

create table hs_ln_application (
       ln_app_number        numeric(10) not null,
       emp_number           int(7) not null,
       ln_ty_number         int(10) not null,
       ln_app_date          date null,
       ln_app_amount        numeric(18,2) null,
       ln_app_installment   numeric null,
       ln_app_no_of_Installments int(2) null,
       ln_app_elg_amount    numeric(18,2) null,
       ln_app_install_amount numeric(13,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_app_effective_date date null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_application on hs_ln_application
(
       ln_ty_number
)
;

create table hs_ln_checklist (
       ln_chk_cat_number    numeric not null,
       ln_chk_number        numeric not null,
       ln_chk_description   varchar(200) null,
       ln_chk_is_mandatory_flg numeric(1) null,
       ln_chk_type_flg      numeric(1) null,
       ln_chk_no_of_gurantee numeric null,
       module_code          varchar(20) null,
       formula_name         varchar(100) null,
       ln_chk_validate_req_flg numeric(1) null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_checklist on hs_ln_checklist
(
       ln_chk_cat_number
)
;


create table hs_ln_checklist_catagory (
       ln_chk_cat_number    numeric not null,
       ln_chk_cat_name      varchar(100) null,
       ln_chk_cat_type      numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;


create table hs_ln_document (
       ln_doc_number        numeric not null,
       ln_app_number        numeric(10) not null,
       ln_ty_number         int(10) not null,
       ln_doc_source        mediumblob null,
       ln_doc_ext           varchar(10) null,
       ln_chk_number        numeric null,
       ln_chk_cat_number    numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_document on hs_ln_document
(
       ln_chk_number,
       ln_chk_cat_number
)
;

create index xif2hs_ln_document on hs_ln_document
(
       ln_app_number,
       ln_ty_number
)
;



create table hs_ln_entitlement_detail (
       ln_ent_group_number  numeric not null,
       emp_number           int(7) not null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif2hs_ln_entitlement_detail on hs_ln_entitlement_detail
(
       ln_ent_group_number
)
;



create table hs_ln_entitlement_group (
       ln_ent_group_number  numeric not null,
       ln_ent_description   varchar(200) null,
       elgrp_id             numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;



create table hs_ln_guarantee (
       ln_gura_number       int(10) AUTO_INCREMENT NOT NULL,
       ln_app_number        numeric(10) not null,
       ln_ty_number         int(10) not null,
       ln_gura_external_flg int(1) null,
       emp_number           int(7) null,
       gura_nic_no          varchar(20) null,
       ln_gura_firstname    varchar(200) null,
       ln_gura_middle_name  varchar(200) null,
       ln_gura_surname      varchar(200) null,
       ln_gura_tel          varchar(20) null,
       ln_gura_address1     varchar(200) null,
       ln_gura_address2     varchar(200) null,
       ln_gura_address3     varchar(200) null,
       ln_gura_comment      varchar(400) null,
       ln_chk_number        numeric null,
       ln_chk_cat_number    numeric null,
       dbgroup_user_id      varchar(20) null,
       PRIMARY KEY (`ln_gura_number`)
)
engine=innodb default charset=utf8;

create index xif1hs_ln_guarantee on hs_ln_guarantee
(
       ln_app_number,
       ln_ty_number
)
;

create index xif3hs_ln_guarantee on hs_ln_guarantee
(
       ln_chk_number,
       ln_chk_cat_number
)
;



create table hs_ln_header (
       emp_number           int(7) not null,
       ln_app_number        numeric(10) null,
       ln_ty_number         int(10) not null,
       ln_hd_sequence       numeric not null,
       ln_hd_amount         numeric(18,2) null,
       ln_hd_bal_amount     numeric(18,2) null,
       ln_hd_installment    numeric null,
       ln_hd_is_active_flg  int(1) not null,
       ln_hd_settled_flg    int(1) not null,
       ln_hd_user           varchar(100) null,
       ln_hd_apply_date     date null,
       ln_hd_bal_installment numeric null,
       app_approved         numeric(1) null,
       wfmain_id            varchar(6) null,
       ln_hd_lst_proc_to_date date null,
       wfmain_sequence      numeric null,
       ln_hd_lst_proc_from_date date null,
       ln_hd_effective_date date null,
       ln_hd_inactive_period numeric null,
       ln_hd_install_amount numeric(13,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_hd_app_date       date null,
       cancel_approved      numeric(5) null,
       cancel_main_id       varchar(6) null
)
engine=innodb default charset=utf8;

create index xif2hs_ln_header on hs_ln_header
(
       ln_ty_number
)
;

create index xif4hs_ln_header on hs_ln_header
(
       ln_app_number,
       ln_ty_number
)
;


create table hs_ln_processed_loan (
       emp_number           int(7) not null,
       ln_hd_sequence       numeric not null,
       ln_sch_ins_no        numeric not null,
       ln_ty_number         int(10) not null,
       ln_processed_from_date date not null,
       ln_processed_to_date date not null,
       ln_processed_capital numeric(18,2) null,
       ln_processed_interest numeric(18,2) null,
       ln_interest_rate     numeric(13,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_bal_installment   numeric null,
       ln_bal_amount        numeric(18,2) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_processed_loan on hs_ln_processed_loan
(
       emp_number,
       ln_hd_sequence,
       ln_sch_ins_no,
       ln_ty_number
)
;


create table hs_ln_schedule (
       emp_number           int(7) not null,
       ln_hd_sequence       numeric not null,
       ln_sch_ins_no        numeric not null,
       ln_ty_number         int(10) not null,
       ln_sch_cap_amt       numeric(18,2) null,
       ln_sch_inst_amount   numeric(13,2) null,
       ln_st_number         int null,
       ln_sch_is_processed  int(1) null,
       ln_sch_inst_rate     numeric(5,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_sch_proc_to_date  date null,
       ln_sch_proc_from_date date null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_schedule on hs_ln_schedule
(
       emp_number,
       ln_hd_sequence,
       ln_ty_number
)
;

create index xif2hs_ln_schedule on hs_ln_schedule
(
       ln_st_number
)
;



create table hs_ln_settlement (
       ln_st_number         int AUTO_INCREMENT not null,
       emp_number           int(7) not null,
       ln_hd_sequence       numeric not null,
       ln_st_date           date null,
       ln_st_user           varchar(100) null,
       ln_st_amount         numeric(18,2) null,
       ln_st_installment    numeric null,
       ln_st_mode           int(2) null,
       ln_st_last_installment_number numeric null,
       ln_ty_number         int(10) null,
       dbgroup_user_id      varchar(20) null,
       ln_st_interest_amount numeric(13,2) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_settlement on hs_ln_settlement
(
       emp_number,
       ln_hd_sequence,
       ln_ty_number
)
;


create table hs_ln_type (
       ln_ty_number         int(10) AUTO_INCREMENT NOT NULL,
       elgrp_id             numeric null,
       ln_ty_code           varchar(13) null,
       ln_ty_name    	    varchar(20) null,
       ln_ty_name_si        varchar(20) null,
       ln_ty_name_ta        varchar(20) null,
       ln_ty_description    varchar(100) null,
       ln_ty_description_si  varchar(100) null,
       ln_ty_description_ta  varchar(100) null,
       ln_ty_max_installment numeric null,
       ln_ty_interest_rate  numeric(5,2) null,
       ln_ty_modified_date  date null,
       ln_ty_modified_user  varchar(100) null,
       ln_ty_amount         numeric(18,2) null,
       ln_ty_app_req_flg    numeric(1) null,
       wftype_code          numeric null,
       ln_ent_group_number  numeric null,
       ln_ty_entitlement_type_flg numeric(1) null,
       ln_ty_interest_fixed_amt numeric(13,2) null,
       ln_ty_interest_type  numeric(1) null,
       ln_ty_user_code      varchar(10) null,
       ln_ty_takehm_req_flg numeric(1) null,
       ln_ty_takehm_ptg     numeric(5,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_ty_inactive_type_flg numeric(1) null,
       PRIMARY KEY(`ln_ty_number`)
)
engine=innodb default charset=utf8;

create index xif1hs_ln_type on hs_ln_type
(
       ln_ent_group_number
);



create table hs_ln_type_check (
       ln_ty_number         int(10) not null,
       ln_chk_cat_number    numeric not null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_type_check on hs_ln_type_check
(
       ln_chk_cat_number
)
;

create index xif2hs_ln_type_check on hs_ln_type_check
(
       ln_ty_number
)
;

alter table hs_ln_application
       add primary key (ln_app_number, ln_ty_number)
;


alter table hs_ln_checklist
       add primary key (ln_chk_number, ln_chk_cat_number)
;


alter table hs_ln_checklist_catagory
       add primary key (ln_chk_cat_number)
;


alter table hs_ln_document
       add primary key (ln_doc_number)
;


alter table hs_ln_entitlement_detail
       add primary key (ln_ent_group_number, emp_number)
;


alter table hs_ln_entitlement_group
       add primary key (ln_ent_group_number)
;

alter table hs_ln_header
       add primary key (emp_number, ln_hd_sequence, ln_ty_number)
;


alter table hs_ln_processed_loan
       add primary key (emp_number, ln_hd_sequence, ln_sch_ins_no, 
               ln_ty_number, ln_processed_from_date, 
              ln_processed_to_date)
;


alter table hs_ln_schedule
       add primary key (emp_number, ln_hd_sequence, ln_sch_ins_no, 
              ln_ty_number)
;



alter table hs_ln_settlement
       add primary key (ln_st_number)
;

alter table hs_ln_type_check
       add primary key (ln_ty_number, ln_chk_cat_number)
;


alter table hs_ln_application
       add (foreign key (ln_ty_number)
                             references hs_ln_type(ln_ty_number))
;


alter table hs_ln_checklist
       add (foreign key (ln_chk_cat_number)
                             references hs_ln_checklist_catagory(ln_chk_cat_number))
;


alter table hs_ln_document
       add (foreign key (ln_app_number, ln_ty_number)
                             references hs_ln_application(ln_app_number, ln_ty_number))
;


alter table hs_ln_document
       add (foreign key (ln_chk_number, ln_chk_cat_number)
                             references hs_ln_checklist(ln_chk_number, ln_chk_cat_number))
;


alter table hs_ln_entitlement_detail
       add (foreign key (ln_ent_group_number)
                             references hs_ln_entitlement_group(ln_ent_group_number))
;


alter table hs_ln_guarantee
       add (foreign key (ln_chk_number, ln_chk_cat_number)
                             references hs_ln_checklist(ln_chk_number, ln_chk_cat_number))
;


alter table hs_ln_guarantee
       add (foreign key (ln_app_number, ln_ty_number)
                             references hs_ln_application(ln_app_number, ln_ty_number))
;


alter table hs_ln_header
       add (foreign key (ln_app_number, ln_ty_number)
                             references hs_ln_application(ln_app_number, ln_ty_number))
;


alter table hs_ln_header
       add (foreign key (ln_ty_number)
                             references hs_ln_type(ln_ty_number))
;


alter table hs_ln_processed_loan
       add (foreign key (emp_number, ln_hd_sequence, ln_sch_ins_no, 
              ln_ty_number)
                             references hs_ln_schedule(emp_number, ln_hd_sequence, ln_sch_ins_no, 
              ln_ty_number))
;


alter table hs_ln_schedule
       add (foreign key (ln_st_number)
                             references hs_ln_settlement(ln_st_number))
;


alter table hs_ln_schedule
       add (foreign key (emp_number, ln_hd_sequence, ln_ty_number)
                             references hs_ln_header(emp_number, ln_hd_sequence, ln_ty_number))
;


alter table hs_ln_settlement
       add (foreign key (emp_number, ln_hd_sequence, ln_ty_number)
                             references hs_ln_header(emp_number, ln_hd_sequence, ln_ty_number))
;


alter table hs_ln_type
       add (foreign key (ln_ent_group_number)
                             references hs_ln_entitlement_group(ln_ent_group_number))
;


alter table hs_ln_type_check
       add (foreign key (ln_ty_number)
                             references hs_ln_type(ln_ty_number))
;


alter table hs_ln_type_check
       add (foreign key (ln_chk_cat_number)
                             references hs_ln_checklist_catagory(ln_chk_cat_number))
;

--
-- Foreign Key Constraint for hs_pr_employee
--

alter table hs_ln_application
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;

alter table hs_ln_header
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;

alter table hs_ln_schedule
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;

alter table hs_ln_settlement
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;

alter table hs_ln_guarantee
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;

alter table hs_ln_settlement
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;

-- -------------------- Loan Form Lock -------------------------------------------

INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ( 'MOD020', ' hs_ln_type', '1', 'Loan Type');
INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ( 'MOD020', ' hs_ln_schedule', '1', 'Loan Schedule');
INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ( 'MOD020', ' hs_ln_header', '1', 'Loan Header');
INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ( 'MOD020', ' hs_ln_application', '1', 'Loan Application');
INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ( 'MOD020', ' hs_ln_schedule', '1', 'Loan Schedule');



--Bug Fixing Givantha bug Number 5061


DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 20001;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 20002;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 20003;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 20004;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 20005;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 20006;


DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20001;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20002;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20003;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20004;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20005;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20006;

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(20001, 'Loan Type', 'ණය වර්ග නිර්චණය', 'Loan Type_ta', 20000, 1, './symfony/web/index.php/loan/LoanType', '20.01', 'MOD020', 'LoanType,SaveLoanType,DeleteLoanType'),
(20002, 'Application', 'ඉල්ලුම් පත්‍රය', 'Application_ta', 20000, 1, './symfony/web/index.php/loan/AppliedLoan', '20.02', 'MOD020', 'AppliedLoan,SaveApplication,DeleteApplication'),
(20003, 'Loan Settlement', 'ණය පියවීම', 'Loan Settlement_ta', 20000, 1, './symfony/web/index.php/loan/LoanSettlement', '20.04', 'MOD020', 'SaveLoanSettlement,LoanSettlement'),
(20004, 'Loan History and Status', 'ණය ඉතිහාසය සහ තත්වය', 'Loan History and Status_ta', 20000, 1, './symfony/web/index.php/loan/LoanHistoryandStatus', '20.05', 'MOD020', 'LoanHistoryandStatus');


TRUNCATE TABLE `hs_ln_application`;


ALTER TABLE `hs_ln_application` ADD UNIQUE (
`ln_app_number`
);

-- 20120217
ALTER TABLE `hs_ln_application`  ADD `ln_app_user_number` VARCHAR(100) NULL DEFAULT NULL,  ADD UNIQUE (`ln_app_user_number`) ;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'AppliedLoan,SaveApplication,DeleteApplication,AjaxDeleteEmployeeGaranter' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20002;

-- JBL CR 2012-09-18

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'AppliedLoan,SaveApplication,DeleteApplication,AjaxDeleteEmployeeGaranter,LedgerDisplay' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 20002;

ALTER TABLE `hs_ln_type` CHANGE `ln_ty_interest_rate` `ln_ty_interest_rate` FLOAT NULL DEFAULT NULL; 

ALTER TABLE `hs_ln_schedule`  ADD `ln_starting_bal_amt` DECIMAL(18,2) NULL DEFAULT NULL,  ADD `ln_intrest_amt` DECIMAL(18,2) NULL DEFAULT NULL,  ADD `ln_cum_interest_amt` DECIMAL(18,2) NULL DEFAULT NULL,  ADD `ln_end_bal_amt` DECIMAL(18,2) NULL DEFAULT NULL,  ADD `ln_pay_by_com` DECIMAL(18,2) NULL DEFAULT NULL,  ADD `ln_usr_pay_amt` DECIMAL(18,2) NULL DEFAULT NULL,  ADD `ln_check_no` VARCHAR(20) NULL DEFAULT NULL,  ADD `ln_pay_by_com_date` DATE NULL DEFAULT NULL;

ALTER TABLE `hs_ln_schedule`  ADD `ln_pay_sch_date` DATE NULL DEFAULT NULL;

ALTER TABLE `hs_ln_schedule`  ADD `ln_end_bal_r_amt` DECIMAL(18,2) NULL DEFAULT NULL;

ALTER TABLE `hs_ln_schedule` ADD `ln_pay_check_no` VARCHAR(20) NULL DEFAULT NULL,  ADD `ln_bal_pay_com_date` DATE NULL DEFAULT NULL;