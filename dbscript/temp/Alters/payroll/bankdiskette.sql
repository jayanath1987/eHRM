CREATE TABLE IF NOT EXISTS `hs_pr_bank_diskette` (
  `dsk_id` int(4) NOT NULL AUTO_INCREMENT,
  `dsk_name` varchar(200) DEFAULT NULL,
  `dsk_name_si` varchar(200) DEFAULT NULL,
  `dsk_name_ta` varchar(200) DEFAULT NULL,
  `dsk_start_date` date DEFAULT NULL,
  `dsk_end_date` date DEFAULT NULL,
  `dsk_view` varchar(200) DEFAULT NULL,
  `dsk_detail_type` varchar(100) DEFAULT NULL,
  `bank_code` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`dsk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `hs_pr_bank_diskette`
	ADD CONSTRAINT `hs_pr_bank_diskette_bank_code`
	FOREIGN KEY(`bank_code`)
	REFERENCES `hs_hr_bank`(`bank_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


CREATE TABLE IF NOT EXISTS `hs_pr_bank_diskette_detail` (
  `dskd_id` int(4) NOT NULL AUTO_INCREMENT,
  `dsk_id` int(4) DEFAULT NULL,
  `dskd_column` varchar(200) DEFAULT NULL,
  `dskd_length` varchar(4) DEFAULT NULL,
  `dskd_type` varchar(1) DEFAULT NULL,
  `dskd_alignment` varchar(1) DEFAULT NULL,
  `dskd_fillwith` varchar(1) DEFAULT NULL,
  `dskd_value` varchar(200) DEFAULT NULL,
  `dskd_order` varchar(100) DEFAULT NULL,
  `dskd_active` varchar(1) DEFAULT NULL,
  `dsk_detail_type` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`dskd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `hs_pr_bank_diskette_detail`
	ADD CONSTRAINT `hs_pr_bank_diskette_detail_dsk_id`
	FOREIGN KEY(`dsk_id`)
	REFERENCES `hs_pr_bank_diskette`(`dsk_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


CREATE TABLE IF NOT EXISTS `hs_pr_bank_diskette_process` (
  `bdp_id` int(4) NOT NULL AUTO_INCREMENT,
  `dsk_id` int(4) DEFAULT NULL,
  `id` int(6) DEFAULT NULL,
  `bdp_start_date` DATE NULL,
  `bdp_end_date` DATE NULL,
  `bdp_payment_date` DATE NULL,
  `bdp_processed` varchar(1) DEFAULT NULL,
  `bdp_flg` varchar(1) DEFAULT NULL,
  `bdp_payment_total` DECIMAL( 13, 2 ) NULL DEFAULT NULL,  
  PRIMARY KEY (`bdp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `hs_pr_bank_diskette_process`
	ADD CONSTRAINT `hs_hr_bank_diskette_process_id`
	FOREIGN KEY(`id`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_pr_bank_diskette_process`
	ADD CONSTRAINT `hs_pr_bank_diskette_dsk_id`
	FOREIGN KEY(`dsk_id`)
	REFERENCES `hs_pr_bank_diskette`(`dsk_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


CREATE TABLE IF NOT EXISTS `hs_pr_bank_diskette_process_employee` (
  `bdp_id` int(4) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) DEFAULT NULL,
  PRIMARY KEY (`bdp_id`,`emp_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `hs_pr_bank_diskette_process_employee`
	ADD CONSTRAINT `hs_hr_bank_diskette_process_emp_number`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

drop view if exists vw_pr_bd_bankdata;
CREATE VIEW vw_pr_bd_bankdata AS 
Select
de.emp_number AS EmployeeNo,
e.emp_display_name AS EmployeeName,
e.emp_nic_no AS EmployeeNIC,
e.work_station AS EmployeeWorkStation,
bt.bank_code AS BankCode,
bt.bbranch_code AS BranchCode,
bt.ebank_acc_no AS AccountNo,
bt.ebt_start_date AS StartDate,
bt.ebt_end_date AS EndDate,
bt.ebt_amount AS Amount,
bt.ebt_cur_base_amount AS BaseAmount,
dp.bdp_payment_total AS TotalAmount,
bt.bank_code AS BankWorkStation

from hs_pr_bank_diskette_process_employee de
left join hs_pr_bank_diskette_process dp on dp.bdp_id = de.bdp_id
left join hs_hr_employee e on e.emp_number = de.emp_number
left join hs_pr_bank_diskette bd on bd.dsk_id = dp.dsk_id 
left join hs_pr_bank_transfers bt on bt.emp_number = de.emp_number 
group by  EmployeeNo, BankCode, BranchCode,StartDate,EndDate;

-- 20120129
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'UpdateVoteDetails,DeleteVoteDetails,VoteDetails,DeleteEmployeeBankDetails' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 19016;

drop view if exists vw_pr_bd_bankdata;
CREATE VIEW vw_pr_bd_bankdata AS 
Select
de.emp_number AS EmployeeNo,
e.emp_display_name AS EmployeeName,
e.emp_nic_no AS EmployeeNIC,
e.work_station AS EmployeeWorkStation,
br.bbranch_code AS BranchCode,
bn.bank_code AS BankCode,
br.bbranch_user_code AS BranchUCode,
bn.bank_user_code AS BankUCode,
bt.ebank_acc_no AS AccountNo,
bt.ebt_start_date AS StartDate,
bt.ebt_end_date AS EndDate,
bt.ebt_amount AS Amount,
bt.ebt_cur_base_amount AS BaseAmount,
dp.bdp_payment_total AS TotalAmount,
bt.bank_code AS BankWorkStation

from hs_pr_bank_diskette_process_employee de
left join hs_pr_bank_diskette_process dp on dp.bdp_id = de.bdp_id
left join hs_hr_employee e on e.emp_number = de.emp_number
left join hs_pr_bank_diskette bd on bd.dsk_id = dp.dsk_id 
left join hs_pr_bank_transfers bt on bt.emp_number = de.emp_number 
left join hs_hr_branch br on br.bbranch_code = bt.bbranch_code
left join hs_hr_bank bn on bn.bank_code = bt.bank_code
group by  EmployeeNo, BankCode, BranchCode,StartDate,EndDate;

drop view if exists vw_pr_bd_bankdata;
CREATE VIEW vw_pr_bd_bankdata AS 
Select
de.emp_number AS EmployeeNo,
eb.ebank_comment AS EmployeeName,
e.emp_nic_no AS EmployeeNIC,
e.work_station AS EmployeeWorkStation,
br.bbranch_code AS BranchCode,
bn.bank_code AS BankCode,
br.bbranch_user_code AS BranchUCode,
bn.bank_user_code AS BankUCode,
bt.ebank_acc_no AS AccountNo,
bt.ebt_start_date AS StartDate,
bt.ebt_end_date AS EndDate,
bt.ebt_amount AS Amount,
bt.ebt_cur_base_amount AS BaseAmount,
dp.bdp_payment_total AS TotalAmount,
bt.bank_code AS BankWorkStation

from hs_pr_bank_diskette_process_employee de
left join hs_pr_bank_diskette_process dp on dp.bdp_id = de.bdp_id
left join hs_hr_employee e on e.emp_number = de.emp_number
left join hs_pr_bank_diskette bd on bd.dsk_id = dp.dsk_id 
left join hs_pr_bank_transfers bt on bt.emp_number = de.emp_number 
left join hs_hr_branch br on br.bbranch_code = bt.bbranch_code
left join hs_hr_bank bn on bn.bank_code = bt.bank_code
left join hs_hr_emp_bank eb on eb.ebank_acc_no = bt.ebank_acc_no and eb.emp_number = de.emp_number
group by  EmployeeNo, BankCode, BranchCode,StartDate,EndDate;