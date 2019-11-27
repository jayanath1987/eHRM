delimiter //

drop procedure if exists rpt_prl_final_emp_sal_slip;
//
CREATE PROCEDURE `rpt_prl_final_emp_sal_slip`(param VARCHAR(255))
BEGIN
SET @empNumber=param;

SELECT ptxn . *, td . * , ttp . * , e . * , c . *,j.*,pr.*
FROM hs_pr_processedtxn ptxn
INNER JOIN vw_hs_hr_employee e ON 
e.emp_number= ptxn.emp_number
INNER JOIN hs_hr_compstructtree c ON c.id = e.work_station
INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code
INNER JOIN hs_hr_job_title j on j.jobtit_code = e.job_title_code
INNER JOIN hs_pr_payprocess pr on pr.emp_number = ptxn.emp_number AND pr.pay_startdate = ptxn.trn_startdate

UNION ALL
	
SELECT ln.ln_processed_from_date as trn_startdate, ln.ln_processed_to_date as trn_enddate, ln.ln_ty_number as trn_dtl_code,ln.emp_number as emp_number,ln.ln_processed_interest as trn_proc_emp_amt , ln.ln_processed_capital as trn_proc_eyr_amt, 	ln.ln_bal_amount as trn_ytd_amount,null,null,"loan",null,null
,null,t.ln_ty_name as trn_dtl_name ,t.ln_ty_name_si as trn_dtl_name_si ,t.ln_ty_name_ta as trn_dtl_name_ta,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,e . * , c . *,j.*,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null
FROM  hs_ln_processed_loan ln
INNER JOIN vw_hs_hr_employee e ON 
e.emp_number= ln.emp_number
INNER JOIN hs_hr_compstructtree c ON c.id = e.work_station
INNER JOIN hs_ln_type t ON t.ln_ty_number = ln.ln_ty_number
INNER JOIN  hs_hr_job_title j on j.jobtit_code = e.job_title_code;


end
//
delimiter ;
