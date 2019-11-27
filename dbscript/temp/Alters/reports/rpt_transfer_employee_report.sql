delimiter //

drop procedure if exists rpt_transfer_employee_report;
//
CREATE PROCEDURE `rpt_transfer_employee_report`(param VARCHAR(255))
BEGIN
SET @empNumber=param;
SELECT t.*,e.emp_number,e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,g.*,c.title,c.title_si,c.title_ta,cd.title,cd.title_si,cd.title_ta,e.employee_id
FROM hs_hr_transfer as t
LEFT JOIN hs_hr_employee as e on t.trans_emp_number = e.emp_number
LEFT JOIN hs_hr_grade_slot as g on e.slt_scale_year = g.slt_scale_year AND e.grade_code=g.grade_code
LEFT JOIN hs_hr_compstructtree as c on c.id = t.trans_currentdiv_id
LEFT JOIN hs_hr_compstructtree as cd on cd.id = t.trans_div_id;


END
//
delimiter ;
