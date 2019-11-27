delimiter //

drop procedure if exists rpt_emp_master;
//

CREATE PROCEDURE `rpt_emp_master`(param VARCHAR(255))
BEGIN
 SET @empNumber=param;
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,j.jobtit_name, j.jobtit_name_si, j.jobtit_name_ta, g.grade_name, g.grade_name_si,co.title,co.title_si,co.title_ta,g.grade_name_ta,s.service_name, s.service_name_si, s.service_name_ta, e.emp_birthday,e.work_station,e.emp_app_date, e.emp_confirm_date, e.emp_com_date, e.emp_app_letter_no, c.title_si, c.title_ta, e.emp_lastname_si, e.emp_lastname_ta, e.emp_initials, e.emp_initials_si, e.emp_initials_ta, e.employee_id, e.emp_lastname
, c.title, s.service_code, g.grade_code, j.jobtit_code, DATEDIFF( CURRENT_DATE( ) , e.emp_com_date ) AS DiffDate, e.emp_nic_no,e.hie_code_1,e.hie_code_2,e.hie_code_3,e.hie_code_4,e.hie_code_5,e.hie_code_6
 FROM vw_hs_hr_employee e
 LEFT JOIN hs_hr_compstructtree c ON e.work_station = c.id
 LEFT JOIN hs_hr_service s ON s.service_code = e.service_code
 LEFT JOIN hs_hr_grade g ON g.grade_code = e.grade_code
 LEFT JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
 LEFT JOIN hs_hr_compstructtree co ON co.id = e.work_station
 LEFT JOIN hs_hr_users u ON e.emp_number=u.emp_number
 ORDER BY e.work_station ASC;

END
//
delimiter ;
