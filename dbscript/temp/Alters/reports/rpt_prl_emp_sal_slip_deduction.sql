delimiter //

drop procedure if exists rpt_prl_emp_sal_slip_deduction;
//
CREATE PROCEDURE `rpt_prl_emp_sal_slip_deduction`(param VARCHAR(255),param2 VARCHAR(255),param3 VARCHAR(255))
BEGIN
 SET @empNumber=param;
 SET @date=param2;
 SET @empID=param3;

SELECT ptxn.*, td.*,ttp.*
FROM hs_pr_processedtxn ptxn

INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code

where ptxn.emp_number = (select e1.emp_number from vw_hs_hr_employee e1 where e1.employee_id= @empID) and ptxn.trn_startdate= @date and ttp.erndedcon=-1;

END
//
delimiter ;
