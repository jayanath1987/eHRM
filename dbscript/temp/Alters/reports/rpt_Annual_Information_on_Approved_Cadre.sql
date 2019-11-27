drop procedure rpt_Annual_Information_on_Approved_Cadre;
DELIMITER $$

CREATE PROCEDURE `rpt_Annual_Information_on_Approved_Cadre`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
select e.emp_number,e.employee_id,e.emp_display_name,e.emp_display_name_si,e.emp_public_app_date,e.emp_public_com_date,emp_app_date,e.emp_com_date,
e.emp_display_name_ta,com.title,com.title_si,com.title_ta,gs.emp_basic_salary,g.*,st.*,c.*,j.*
from hs_hr_employee e
INNER JOIN hs_hr_compstructtree com ON com.id = e.work_station
INNER JOIN hs_hr_carderplan c ON c.id = com.id
INNER JOIN hs_hr_empstat st ON st.estat_code = e.emp_status 
INNER JOIN hs_hr_grade g ON g.grade_code = e.grade_code
INNER JOIN hs_hr_grade_slot gs ON gs.slt_id = e.slt_scale_year
INNER JOIN hs_hr_job_title j ON j.jobtit_code = job_title_code 
group by e.employee_id;

END
