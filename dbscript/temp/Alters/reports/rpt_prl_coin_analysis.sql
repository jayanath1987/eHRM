drop PROCEDURE `rpt_prl_coin_analysis`;

DELIMITER $$

CREATE PROCEDURE `rpt_prl_coin_analysis`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.employee_id,e.emp_display_name,e.emp_display_name_si ,e.emp_display_name_ta, pa.pay_startdate,pa.emp_number,pa.pay_enddate,pa.pay_netpay,e.hie_code_2,e.hie_code_3,e.hie_code_4,e.hie_code_5,e.hie_code_6
FROM hs_pr_employee pe
INNER JOIN vw_hs_hr_employee e on e.emp_number = pe.emp_number
INNER JOIN hs_pr_payprocess pa on pa.emp_number = pe.emp_number;

END
