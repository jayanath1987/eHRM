delimiter //

drop procedure if exists rpt_section_wise_payroll_monthly;
//
CREATE PROCEDURE `rpt_section_wise_payroll_monthly`(param VARCHAR(255),param2 VARCHAR(255))
BEGIN
SET @empNumber=param;
SET @month=param2;


SELECT ptxn.*, td.*,ttp.*, e.*,c.*
FROM hs_pr_processedtxn ptxn
INNER JOIN vw_hs_hr_employee e ON e.emp_number = ptxn.emp_number
INNER JOIN hs_hr_compstructtree c ON c.id = e.work_station
INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code
WHERE DATE_FORMAT( ptxn.trn_startdate, '%Y-%m' ) = @month;

END
//
delimiter ;

