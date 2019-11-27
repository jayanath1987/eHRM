delimiter //

drop procedure if exists rpt_emp_Report_to_option_report;
//
CREATE PROCEDURE `rpt_emp_Report_to_option_report`(param VARCHAR(255))

BEGIN   
SET @empNumber=param;  
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta, e1.emp_display_name,e1.emp_display_name_si,e1.emp_display_name_ta,er.erep_reporting_mode 
FROM hs_hr_emp_reportto as er  
LEFT JOIN hs_hr_employee as e on er.erep_sup_emp_number = e.emp_number 
LEFT JOIN hs_hr_compstructtree as c on c.comp_code = e.work_station 
LEFT JOIN hs_hr_employee as e1 on er.erep_sub_emp_number = e1.emp_number;  
END
//
delimiter ;
