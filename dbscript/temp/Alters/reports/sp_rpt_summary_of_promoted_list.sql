delimiter //

drop procedure if exists sp_rpt_summary_of_promoted_list;
//

CREATE PROCEDURE `sp_rpt_summary_of_promoted_list`(param VARCHAR(255))
BEGIN
 SET @empNumber=param;
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,p.prm_divition,p.prm_effective_date,p.service_code,p.grade_code,p.prm_divition,p.estat_code,r.estat_name,r.estat_name_si,r.estat_name_ta,e.emp_confirm_flg ,e.emp_active_att_flg,e.emp_active_hrm_flg,j.jobtit_name, j.jobtit_name_si, j.jobtit_name_ta, g.grade_name, g.grade_name_si, g.grade_name_ta, s.service_name, s.service_name_si, s.service_name_ta, e.emp_birthday, e.emp_app_date, e.emp_confirm_date, e.emp_com_date, e.emp_app_letter_no, c.title_si, c.title_ta, e.emp_lastname_si, e.emp_lastname_ta, e.emp_initials, e.emp_initials_si, e.emp_initials_ta, e.employee_id, e.emp_lastname, e.emp_nic_no, c.title, s.service_code, g.grade_code, j.jobtit_code, DATEDIFF( CURRENT_DATE( ) , e.emp_com_date ) AS DiffDate,e.hie_code_1,e.hie_code_2,e.hie_code_3,e.hie_code_4,e.hie_code_5,e.hie_code_6
FROM hs_hr_promotion p
left join vw_hs_hr_employee e on p.emp_number=e.emp_number
LEFT JOIN hs_hr_compstructtree c ON p.prm_divition = c.id
LEFT JOIN hs_hr_service s ON s.service_code = p.service_code
LEFT JOIN hs_hr_grade g ON g.grade_code = p.grade_code
LEFT JOIN hs_hr_job_title j ON j.jobtit_code = p.jobtit_code
left join hs_hr_empstat r on r.estat_code=p.estat_code
WHERE p.prm_effective_date < CURDATE();

END
//
delimiter ;
