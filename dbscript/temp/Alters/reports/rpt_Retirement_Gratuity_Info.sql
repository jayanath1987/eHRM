drop procedure rpt_Retirement_Gratuity_Info;
DELIMITER $$

CREATE PROCEDURE `rpt_Retirement_Gratuity_Info`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT
e.employee_id,
e.emp_initials,
e.emp_initials_si,
e.emp_initials_ta,
e.emp_display_name,	
e.emp_display_name_si,	
e.emp_display_name_ta,
e.emp_number,
e.emp_public_com_date,
j.jobtit_code,
j.jobtit_name,
j.jobtit_name_si,
j.jobtit_name_ta,
t.title_code,
t.title_name,
t.title_name_si,
t.title_name_ta,
e.hie_code_2,
e.hie_code_3,
e.hie_code_4,
e.hie_code_5,
e.hie_code_6,
pe.emp_number,
pp.pay_gross_salary,
year(now()) - year(e.emp_public_com_date) AS working_years,
((pp.pay_gross_salary /2) * (year(now()) - year(e.emp_public_com_date))) AS gratuity
FROM vw_hs_hr_employee e
INNER JOIN hs_pr_employee pe ON e.emp_number = pe.emp_number
INNER JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
INNER JOIN hs_hr_title t ON t.title_code = e.title_code
INNER JOIN hs_pr_payprocess pp ON pp.emp_number = e.emp_number; 	
END
