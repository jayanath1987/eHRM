delimiter //

drop procedure if exists sp_rpt_training_applicant_list_report_summary;
//

CREATE PROCEDURE `sp_rpt_training_applicant_list_report_summary`(param VARCHAR(255))
BEGIN
 SET @empNumber=param;
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,j.jobtit_name,j.jobtit_name_si,j.jobtit_name_ta,c.title,c.title_si,c.title_ta,a.td_asl_isapproved,e.emp_initials,e.emp_initials_si,e.emp_initials_ta,e.employee_id,e.emp_lastname,e.emp_lastname_si,e.emp_lastname_ta,e.hie_code_1,e.hie_code_2,e.hie_code_3,e.hie_code_4,e.hie_code_5,e.hie_code_6, i.td_inst_name_en,i.td_inst_name_si,i.td_inst_name_ta,t.td_course_year,t.td_course_name_en,t.td_course_name_si,t.td_course_name_ta,l.lang_code,l.lang_name,l.lang_name_si,lang_name_ta
,t.td_course_fromdate,t.td_course_todate,t.td_course_objective_en,t.td_course_objective_si,t.td_course_objective_ta,t.td_course_whom_en,t.td_course_whom_si,t.td_course_whom_ta,t.td_course_content_en,t.td_course_content_si,t.td_course_content_ta,t.td_course_fees,t.td_course_venue_en,t.td_course_venue_si,td_course_venue_ta

from hs_hr_td_assignlist a
left join vw_hs_hr_employee e on e.emp_number=a.emp_number
left join hs_hr_td_course t on a.td_course_id=t.td_course_id
left join hs_hr_td_institute i on t.td_inst_id=i.td_inst_id
left join hs_hr_language l on l.lang_code=t.lang_code
left join hs_hr_compstructtree c on c.id=e.work_station
left join hs_hr_job_title j on j.jobtit_code=e.job_title_code
ORDER BY  e.employee_id,t.td_course_id DESC;

END
//
delimiter ;
