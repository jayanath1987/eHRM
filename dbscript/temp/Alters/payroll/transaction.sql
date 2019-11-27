SET NAMES 'UTF8';

ALTER TABLE `hs_pr_transaction_type`
	ADD CONSTRAINT `trn_typ_name`
	UNIQUE (`trn_typ_name`);

ALTER TABLE `hs_pr_transaction_type`
	ADD CONSTRAINT `trn_typ_name_si`
	UNIQUE (`trn_typ_name_si`);

ALTER TABLE `hs_pr_transaction_type`
	ADD CONSTRAINT `trn_typ_name_ta`
	UNIQUE (`trn_typ_name_ta`);

INSERT INTO  `hs_hr_unique_id` (
`id` ,
`last_id` ,
`table_name` ,
`field_name`
)
VALUES (
NULL ,  '0',  'hs_pr_transaction_type',  'trn_typ_code'
);

DELETE FROM  `hs_hr_sm_mnuitem` WHERE mod_id =  'MOD019';

-- INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
-- ('MOD019', 'Payroll', 'පඩිපත ', ' Payroll ta', NULL, NULL, NULL, NULL, NULL),
-- ('MOD020', 'Loan', ' ණය ', 'Loan ta', NULL, NULL, NULL, NULL, NULL);


INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(19000, 'Payroll', 'පඩිපත', 'Payroll_ta', 0, 0, '#', '19.00', 'MOD019', NULL),
(19001, 'Employee Payroll Information', 'සේවක පඩිපත් තොරතුරු', 'Employee Payroll Information_ta', 19000, 1, './symfony/web/index.php/payroll/EmployeePayrollInformation', '19.01', 'MOD019', 'UpdateEmployeePayrollInformation,EmployeePayrollInformation,DeletePayrollInformation'),
(19002, 'Administration', 'පරිපාලන', 'Administration_ta', 19000, 1, '#', '19.02', 'MOD019', ''),
(19003, 'Transaction type information', 'Transaction type information', 'Transaction type information', 19002, 2, './symfony/web/index.php/payroll/TransActiontypeSummary', '19.02.01', 'MOD019', 'DeleteTransactionType,TransActionTypeInfo'),
(19004, 'Transaction detail information', 'Transaction detail information', 'Transaction detail information', 19002, 2, './symfony/web/index.php/payroll/TransActionDetailSummary', '19.02.02', 'MOD019', 'TransActDetails,DeleteTransactionDetails'),
(19005, 'Configuration', 'Configuration', 'Configuration', 19000, 1, './symfony/web/index.php/payroll/Configuration', '19.03', 'MOD019', ''),
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


INSERT INTO `hs_pr_transaction_type` (`trn_typ_code`, `trn_typ_name`, `trn_typ_name_si`, `trn_typ_name_ta`, `trn_typ_type`, `erndedcon`, `trn_typ_user_code`, `dbgroup_user_id`) VALUES
(4, 'Basic Salary', NULL, NULL, 1, 1, '001', NULL),
(5, 'Fixed Earning', NULL, NULL, 1, 2, '002', NULL),
(6, 'Variable Dedcution', NULL, NULL, 0, -1, '003', NULL),
(7, 'Contribution', NULL, NULL, 1, 0, '004', NULL),
(8, 'Varible Earning', NULL, NULL, 0, 2, '005', NULL),
(9, 'Fixed Dedcution', NULL, NULL, 1, -1, '007', NULL);



INSERT INTO `hs_hr_unique_id` (`id`, `last_id`, `table_name`, `field_name`) VALUES (NULL, '0', 'hs_pr_transaction_details', 'trn_dtl_code');


CREATE TABLE  `hs_pr_contribution_base` (
`trn_dtl_code` INT( 6 ) NOT NULL ,
`trn_dtl_base_code` INT NOT NULL ,
`dbgroup_user_id` VARCHAR( 30 ) NOT NULL
) engine=innodb default charset=utf8;

ALTER TABLE  `hs_pr_contribution_base` ADD PRIMARY KEY (  `trn_dtl_code` ,  `trn_dtl_base_code` ) ;

 alter table hs_pr_contribution_base
       add (foreign key (trn_dtl_code)
                             references hs_pr_transaction_details(trn_dtl_code))
;

ALTER TABLE  `hs_pr_contribution_base` DROP PRIMARY KEY ,
ADD PRIMARY KEY (  `trn_dtl_code` ,  `trn_dtl_base_code`) ;

INSERT INTO  `hs_pr_profile` (
`id` ,
`takehome_ptg`
)
VALUES (
'1',  '100'
);

DELETE FROM  `hs_hr_sm_mnuitem` WHERE mod_id =  'MOD020';

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(20000, 'Loan', 'ණය', 'Loan_ta', 0, 0, '#', '20.00', 'MOD020', NULL),
(20001, 'Administration', 'පරිපාලනය', 'Administration_ta', 20000, 1, '#', '20.01', 'MOD020', ''),
(20002, 'Define Loan Type', 'ණය වර්ග නිර්චණය', 'Define Loan Type_ta', 20001, 1, './symfony/web/index.php/loan/LoanType', '20.01.01', 'MOD020', 'LoanType,SaveLoanType,DeleteLoanType'),
(20003, 'Apply Loan', 'ණය ඉල්ලුම් කිරීම', 'Apply Loan_ta', 20000, 1, '#', '20.02', 'MOD020', ''),
(20004, 'Application', 'ඉල්ලුම් පත්‍රය', 'Application_ta', 20003, 1, './symfony/web/index.php/loan/AppliedLoan', '20.02.01', 'MOD020', 'AppliedLoan,SaveApplication,DeleteApplication'),
(20005, 'Loan Settlement', 'ණය පියවීම', 'Loan Settlement_ta', 20000, 1, './symfony/web/index.php/loan/LoanSettlement', '20.04', 'MOD020', 'SaveLoanSettlement,LoanSettlement'),
(20006, 'Loan
 History and Status', 'ණය ඉතිහාසය සහ තත්වය', 'Loan History and Status_ta', 20000, 1, './symfony/web/index.php/loan/LoanHistoryandStatus', '20.05', 'MOD020', 'LoanHistoryandStatus');

