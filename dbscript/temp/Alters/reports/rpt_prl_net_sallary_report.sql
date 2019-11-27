delimiter //

drop procedure if exists rpt_prl_net_sallary_report;
//
CREATE PROCEDURE `rpt_prl_net_sallary_report`(param VARCHAR(255))
BEGIN
 SET @empNumber=param;
SELECT pp.pay_netpay,pp.pay_bf_amt,pp.pay_cash_paid_amt,pp.pay_bank_paid_amt,pt.prl_type_code,pt.prl_type_name,pt.    prl_type_name_si,pt.prl_type_name_ta    
FROM hs_pr_payprocess pp
INNER JOIN vw_hs_hr_employee e ON e.emp_number = pp.emp_number
INNER JOIN hs_pr_employee pe ON pe.emp_number = e.emp_number
INNER JOIN hs_pr_payroll_type pt ON pe.prl_type_code = pt.prl_type_code;

END
//
delimiter ;
