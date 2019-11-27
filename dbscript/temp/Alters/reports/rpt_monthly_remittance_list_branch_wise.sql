drop procedure rpt_monthly_remittance_list_branch_wise;
DELIMITER $$

CREATE PROCEDURE `rpt_monthly_remittance_list_branch_wise`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT eb.*,b.*,br.*,e.*,c.id,c.title,c.title_si,c.title_ta
from hs_hr_emp_bank eb 
INNER JOIN hs_hr_branch br ON br.bbranch_code = eb.bbranch_code
INNER JOIN hs_hr_bank b ON b.bank_code = br.bank_code 
INNER JOIN vw_hs_hr_employee e ON e.emp_number = eb.emp_number
INNER JOIN hs_hr_compstructtree c ON c.id = e.work_station 
WHERE br.bbranch_sliptransfers_flg IS NULL;

END
