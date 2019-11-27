drop procedure rpt_monthly_payments_analysis;
DELIMITER $$

CREATE PROCEDURE `rpt_monthly_payments_analysis`(param VARCHAR(255))
BEGIN
  
SELECT p.*,e.hie_code_2,e.hie_code_3,e.hie_code_4,e.hie_code_5,e.hie_code_6,(SELECT d.trn_proc_emp_amt 
FROM hs_pr_processedtxn d
INNER JOIN hs_pr_transaction_details t ON t.trn_dtl_code = d.trn_dtl_code
WHERE t.trn_dtl_code = 30 and d.trn_startdate = param) as EPF,
(SELECT d.trn_proc_emp_amt 
FROM hs_pr_processedtxn d
INNER JOIN hs_pr_transaction_details t ON t.trn_dtl_code = d.trn_dtl_code
WHERE t.trn_dtl_code = 31 and d.trn_startdate = param) as ETF
FROM hs_pr_payprocess p 
INNER JOIN hs_hr_employee e ON e.emp_number = p.emp_number
where p.pay_startdate = param;

END
