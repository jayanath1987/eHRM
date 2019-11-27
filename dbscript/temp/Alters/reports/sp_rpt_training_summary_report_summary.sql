delimiter //

drop procedure if exists sp_rpt_training_summary_report_summary;
//

CREATE PROCEDURE `sp_rpt_training_summary_report_summary`(param VARCHAR(255))
BEGIN
 SET @empNumber=param;

SELECT i.td_inst_name_en,i.td_inst_name_si,i.td_inst_name_ta,t.td_course_year,t.td_course_name_en,t.td_course_name_si,t.td_course_name_ta,l.lang_code,l.lang_name,l.lang_name_si,lang_name_ta
,t.td_course_fromdate,t.td_course_todate,t.td_course_objective_en,t.td_course_objective_si,t. td_course_objective_ta,t.td_course_whom_en,t.td_course_whom_si,t.td_course_whom_ta,t.td_course_content_en,t.td_course_content_si,t.td_course_content_ta,t.td_course_fees,t.td_course_venue_en,t.td_course_venue_si,td_course_venue_ta
from hs_hr_td_course t
INNER JOIN hs_hr_td_institute i on t.td_inst_id=i.td_inst_id
INNER JOIN hs_hr_language l on l.lang_code=t.lang_code;

end; 
//
delimiter ;
