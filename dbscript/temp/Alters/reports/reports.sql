INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Employee Information Report', 'සේවක තොරතුරු වාර්තාව ', 'சீவக தொரதுரு வார்தவா', NULL, 'MOD002');
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Service extension report', 'සේවය දීර්ඝ කිරීමේ  වාර්තාව ', NULL, 'Emp_service_extesion.rptdesign', 'MOD002');
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Confirmation Report', 'ස්ථිර සේවක ලැය්ස්තුව ', NULL, 'Emp_confirmation.rptdesign', 'MOD001');

-- -------------------- Recruitment Report Procedure -------------------------------------------

--
-- Procedure for report `Individual_Candidate_Interview Details 01 Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Individual_Candidate_Interview`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT c.*,v.*
FROM hs_hr_rec_candidate c
INNER join hs_hr_rec_vacancy_request v on c.rec_req_id = v.rec_vac_req_id; 	
END


--
-- Procedure for report `Individual_Candidate_Interview Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Individual_Candidate_Interview`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT c.*,v.*
FROM hs_hr_rec_candidate c
INNER JOIN hs_hr_rec_vacancy_request v on c.rec_req_id = v.rec_vac_req_id 	
WHERE c.rec_can_interview_status_dg = 1;  
END

--
-- Procedure for report `Approved Vacancy Count Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Approved_Vacancy_Count`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT v.*,e.*
FROM hs_hr_rec_vacancy_request v
INNER JOIN vw_hs_hr_employee e on e.emp_number = v.emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
WHERE v.rec_vac_is_submit = 2;

END

--
-- Procedure for report `Employees Appointments Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Employees_Appointments`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT *
FROM hs_hr_employee e
INNER JOIN vw_hs_hr_employee ve ON ve.emp_number=e.emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
INNER JOIN hs_hr_compstructtree c ON e.work_station = c.id
INNER JOIN hs_hr_grade g ON g.grade_code = e.grade_code
INNER JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code;

END

--
-- Procedure for report `Short Listed Candidate Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Short_Listed_Candidate`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT c.*,v.*
FROM hs_hr_rec_candidate c
LEFT JOIN hs_hr_rec_vacancy_request v on c.rec_req_id = v.rec_vac_req_id; 

END

-- -------------------- Performance Report Procedure -------------------------------------------


--
-- Procedure for report `Evaluation Details Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Evaluation_Details`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.eval_code,e.eval_name,e.eval_name_si,e.eval_name_ta,e.eval_year,e.eval_active 
FROM hs_hr_perf_evaluation e;

END

--
-- Procedure for report `Duty Evaluation Employee Specific Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Duty_Evaluation_Employee_Specific`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.employee_id,
e.emp_display_name,
e.emp_display_name_si,
e.emp_display_name_ta,
(SELECT e2.emp_display_name FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name,
(SELECT e2.emp_display_name_si FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name_si,
(SELECT e2.emp_display_name_ta FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name_ta,
ed.eval_duty_rate,
ev.eval_emp_overall_rate,
ed.eval_duty_comment,
d.dut_name,
d.dut_name_si,
d.dut_name_ta,
dg.dtg_name,
dg.dtg_name_si,
dg.dtg_name_ta,
pe.eval_name,
pe.eval_name_si,
pe.eval_name_ta	
FROM hs_hr_perf_eval_employee ev
INNER JOIN vw_hs_hr_employee e on e.employee_id=ev.emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
INNER JOIN hs_hr_perf_evaluation_detail ped on ped.eval_dtl_id=ev.eval_dtl_id
INNER JOIN hs_hr_perf_evaluation pe on pe.eval_id=ev.eval_id 
INNER JOIN hs_hr_perf_eval_employee_duty ed on (ed.eval_dtl_id=ev.eval_dtl_id AND ed.emp_number=ev.emp_number)
INNER JOIN hs_hr_perf_duty d on d.dut_id=ed.dut_id
INNER JOIN hs_hr_perf_duty_group dg on dg.dtg_id=d.dtg_id
WHERE ev.eval_emp_status = 2;

END



--
-- Procedure for report `Project Evaluation Employee Specific Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Project_Evaluation_Employee_Specific`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.employee_id,
e.emp_display_name,
e.emp_display_name_si,
e.emp_display_name_ta,
(SELECT e2.emp_display_name FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name,
(SELECT e2.emp_display_name_si FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name_si,
(SELECT e2.emp_display_name_ta FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name_ta,
ev.eval_emp_project_rate,
ev.eval_emp_overall_rate,
ep.eval_prj_name,
ep.eval_prj_name_si,
ep.eval_prj_name_ta,	
pe.eval_name,
pe.eval_name_si,
pe.eval_name_ta	
FROM hs_hr_perf_eval_employee ev
INNER JOIN vw_hs_hr_employee e on e.employee_id=ev.emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
INNER JOIN hs_hr_perf_evaluation_detail ped on ped.eval_dtl_id=ev.eval_dtl_id
INNER JOIN hs_hr_perf_evaluation pe on pe.eval_id=ev.eval_id 
INNER JOIN hs_hr_perf_eval_employee_project eep on (eep.eval_dtl_id=ev.eval_dtl_id AND eep.emp_number=ev.emp_number)
INNER JOIN hs_hr_perf_evaluation_project ep on ep.eval_prj_id=eep.eval_prj_id
WHERE ev.eval_emp_status = 2;

END

--
-- Procedure for report `Ongoing Evaluation Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Ongoing_Evaluation_Summary`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT 
(SELECT e2.emp_display_name FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name,
(SELECT e2.emp_display_name_si FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name_si,
(SELECT e2.emp_display_name_ta FROM hs_hr_employee e2 WHERE e2.employee_id = ev.sup_emp_number) AS supervisor_name_ta,
(SELECT e2.emp_display_name FROM hs_hr_employee e2 WHERE e2.employee_id = ev.emp_number) AS subordinate_name,
(SELECT e2.emp_display_name_si FROM hs_hr_employee e2 WHERE e2.employee_id = ev.emp_number) AS subordinate_name_si,
(SELECT e2.emp_display_name_ta FROM hs_hr_employee e2 WHERE e2.employee_id = ev.emp_number) AS subordinate_name_ta,	
pe.eval_name,
pe.eval_name_si,
pe.eval_name_ta
FROM hs_hr_perf_eval_employee ev
INNER JOIN vw_hs_hr_employee e on e.employee_id=ev.emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
INNER JOIN hs_hr_perf_evaluation pe on pe.eval_id=ev.eval_id
INNER JOIN hs_hr_perf_evaluation_supervisor es on es.eval_id=ev.eval_id
WHERE ev.sup_emp_number = es.emp_number AND ev.eval_emp_status = 1; 

END

--
-- Procedure for report `Overall Rating Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Overall_Rating_Summary`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.employee_id,
e.emp_display_name,
e.emp_display_name_si,
e.emp_display_name_ta,
ev.eval_emp_project_rate,
ed.eval_duty_rate,
ev.eval_emp_overall_rate,
pe.eval_name,
pe.eval_name_si,
l.level_code,
e.work_station,
pe.eval_name_ta	
FROM hs_hr_perf_eval_employee ev
INNER JOIN vw_hs_hr_employee e on e.employee_id=ev.emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
left join hs_hr_perf_evaluation_detail ped on ped.eval_dtl_id=ev.eval_dtl_id
left join hs_hr_perf_evaluation pe on pe.eval_id=ev.eval_id 
left join hs_hr_perf_eval_employee_duty ed on (ed.eval_dtl_id=ev.eval_dtl_id AND ed.emp_number=ev.emp_number)
left join hs_hr_compstructtree c on c.id=e.work_station
left join hs_hr_level l on l.level_code=c.def_level
WHERE ev.eval_emp_status = 2; 

END


-- -------------------- Transfer Report Procedure -------------------------------------------

--
-- Procedure for report `Transfer Details Summary Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Transfer_Details_Summary`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,h.start_date,e.emp_com_date, e.employee_id, j.jobtit_name, j.jobtit_name_si, j.jobtit_name_ta, e.emp_app_letter_no, c.title_si, c.title_ta, e.emp_lastname_si, e.emp_lastname_ta, e.emp_initials, e.emp_initials_si, e.emp_initials_ta, e.emp_lastname, e.emp_nic_no, c.title
FROM hs_hr_transfer t
LEFT JOIN hs_hr_emp_subdivision_history h ON h.emp_number = t.trans_emp_number
INNER JOIN vw_hs_hr_employee e on e.employee_id=t.trans_emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
INNER JOIN hs_hr_compstructtree c ON e.work_station = c.id
INNER JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
WHERE h.end_date IS NULL 
order by t.trans_id desc;

END


--
-- Procedure for report `Transfer List Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_Transfer_Details_Summary`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,h.start_date,e.emp_com_date, e.employee_id, j.jobtit_name, j.jobtit_name_si, j.jobtit_name_ta, e.emp_app_letter_no, c.title_si, c.title_ta, e.emp_lastname_si, e.emp_lastname_ta, e.emp_initials, e.emp_initials_si, e.emp_initials_ta, e.emp_lastname, e.emp_nic_no, c.title
FROM hs_hr_transfer t
LEFT JOIN hs_hr_emp_subdivision_history h ON h.emp_number = t.trans_emp_number
INNER JOIN vw_hs_hr_employee e on e.employee_id=t.trans_emp_number
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
INNER JOIN hs_hr_compstructtree c ON e.work_station = c.id
INNER JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
WHERE h.end_date IS NULL 
order by t.trans_id desc;

END

DELIMITER $$

CREATE  PROCEDURE `rpt_emp_master`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,j.jobtit_name, j.jobtit_name_si, j.jobtit_name_ta, g.grade_name, g.grade_name_si,co.title,co.title_si,co.title_ta,g.grade_name_ta,s.service_name, s.service_name_si, s.service_name_ta, e.emp_birthday,e.work_station,e.emp_app_date, e.emp_confirm_date, e.emp_com_date, e.emp_app_letter_no, c.title_si, c.title_ta, e.emp_lastname_si, e.emp_lastname_ta, e.emp_initials, e.emp_initials_si, e.emp_initials_ta, e.employee_id, e.emp_lastname, e.emp_nic_no, c.title, s.service_code, g.grade_code, j.jobtit_code, DATEDIFF( CURRENT_DATE( ) , e.emp_com_date ) AS DiffDate
  FROM vw_hs_hr_employee e
  LEFT JOIN hs_hr_compstructtree c ON e.work_station = c.id
  LEFT JOIN hs_hr_service s ON s.service_code = e.service_code
  LEFT JOIN hs_hr_grade g ON g.grade_code = e.grade_code
  LEFT JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
  LEFT JOIN hs_hr_compstructtree co ON co.id = e.work_station
  LEFT JOIN hs_hr_users u ON e.emp_number=u.emp_number

  ORDER BY e.work_station ASC;

END

DELIMITER $$

CREATE  PROCEDURE `sp_rpt_emp_confirmation`(param VARCHAR(255))
BEGIN
  SET @USER=param;
SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,e.emp_confirm_flg ,e.emp_prob_from_date,e.emp_prob_to_date,e.emp_active_att_flg,e.emp_active_hrm_flg,j.jobtit_name, j.jobtit_name_si, j.jobtit_name_ta, g.grade_name, g.grade_name_si, g.grade_name_ta, s.service_name, s.service_name_si, s.service_name_ta, e.emp_birthday, e.emp_app_date, e.emp_confirm_date, e.emp_com_date, e.emp_app_letter_no, c.title_si, c.title_ta, e.emp_lastname_si, e.emp_lastname_ta, e.emp_initials, e.emp_initials_si, e.emp_initials_ta, e.employee_id, e.emp_lastname, e.emp_nic_no, c.title, s.service_code, g.grade_code, j.jobtit_code, DATEDIFF( CURRENT_DATE( ) , e.emp_com_date ) AS DiffDate
FROM vw_hs_hr_employee e
LEFT JOIN hs_hr_compstructtree c ON e.work_station = c.id
LEFT JOIN hs_hr_service s ON s.service_code = e.service_code
LEFT JOIN hs_hr_grade g ON g.grade_code = e.grade_code
LEFT JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
LEFT JOIN hs_hr_users u ON e.emp_number=u.emp_number
where e.emp_confirwm_flg=1  and e.emp_active_hrm_flg=1;

END


-- -------------------- Loan Report Procedure -------------------------------------------

INSERT INTO `hs_hr_rn_report`(`rn_rpt_id`,`rn_rpt_name`,`rn_rpt_name_si`,`rn_rpt_name_ta`,`rn_rpt_path` ,`mod_id`)
VALUES 
('null', 'Monthly Loan Information(Loan 01) Summary Report', 'මාසික ණය තොරතුරු සාරාංශ වාර්තාව (01)', 'Monthly Loan Information(Loan 01) Summary Report', 'Monthly_Loan_Details_1.rptdesign', 'MOD020'),
('null', 'Monthly Loan Information(Loan 02) Summary Report', 'මාසික ණය තොරතුරු සාරාංශ වාර්තාව (02)', 'Monthly Loan Information(Loan 02) Summary Report', 'Monthly_Loan_Details_2.rptdesign', 'MOD020'),
('null', 'Monthly Loan Information(Loan 03) Summary Report', 'මාසික ණය තොරතුරු සාරාංශ වාර්තාව (03)', 'Monthly Loan Information(Loan 03) Summary Report', 'Monthly_Loan_Details_3.rptdesign', 'MOD020'),
('null', 'Annual Loan Information to Date Summary Report', 'වාර්ෂික ණය තොරතුරු සාරාංශ වාර්තාව', 'Annual Loan Information to Date Summary Report', 'Annual_Loan_Details.rptdesign', 'MOD020');

--
-- Procedure for report `Monthly Loan Details 01`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_monthly_loan_1`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT 
lt.ln_ty_number,
lt.ln_ty_code,
lt.ln_ty_name,
lt.ln_ty_name_si,
lt.ln_ty_name_ta,
lt.ln_ty_interest_rate,
lt.ln_ty_inactive_type_flg,
lh.ln_hd_amount,
lh.ln_hd_bal_amount,
lh.ln_hd_installment,
la.ln_app_number,
la.emp_number,
la.ln_ty_number,
la.ln_app_date,
la.ln_app_amount,
la.ln_app_effective_date,
la.ln_app_no_of_Installments, 
e.emp_display_name,
e.emp_display_name_si,
e.emp_display_name_ta,
e.emp_number,
e.employee_id,
e.work_station,
e.emp_nic_no,
c.comp_code,
c.title,
c.id,
c.title_si,
c.title_ta,
c.def_level,
e.emp_confirm_flg,
e.emp_active_hrm_flg,
e.emp_active_pr_flg,
pe.emp_epf_number,
j.jobtit_name,
j.jobtit_name_si,
j.jobtit_name_ta
FROM hs_ln_application la
INNER JOIN hs_ln_header lh ON lh.ln_app_number = la.ln_app_number AND lh.ln_ty_number = la.ln_ty_number
INNER JOIN hs_ln_type lt ON lh.ln_ty_number = lt.ln_ty_number 
INNER JOIN hs_pr_employee  pe ON pe.emp_number = la.emp_number 	
INNER JOIN vw_hs_hr_employee e ON e.emp_number = la.emp_number
INNER JOIN hs_hr_job_title j ON e.act_job_title_code = j.jobtit_code
INNER JOIN hs_hr_compstructtree c ON c.id = e.hie_code_3 
INNER JOIN hs_hr_users u ON e.emp_number=u.emp_number
where e.emp_active_hrm_flg=1 and e.emp_active_pr_flg=1;  
END


--
-- Procedure for report `Annual Loan Details`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_annual_loan`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT lt.ln_ty_number,lt.ln_ty_code,lt.ln_ty_name,lt.ln_ty_name_si,lt.ln_ty_name_ta,lt.ln_ty_interest_rate,lt.ln_ty_inactive_type_flg,
lh.ln_hd_amount,lh.ln_hd_bal_amount,lh.ln_hd_installment,
la.ln_app_number,la.emp_number,la.ln_ty_number,la.ln_app_date,la.ln_app_amount,la.ln_app_effective_date,la.ln_app_no_of_Installments, 
e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,e.emp_number,e.employee_id,e.work_station,e.emp_nic_no,pe.emp_epf_number,pe.emp_etf_number,
c.comp_code,c.title,c.id,c.title_si,c.title_ta,c.def_level
FROM hs_ln_application la
INNER JOIN hs_ln_header lh ON lh.ln_app_number = la.ln_app_number AND lh.ln_ty_number = la.ln_ty_number
INNER JOIN hs_ln_type lt ON lh.ln_ty_number = lt.ln_ty_number 
INNER JOIN hs_pr_employee  pe ON pe.emp_number = la.emp_number 	
INNER JOIN vw_hs_hr_employee e ON e.emp_number = pe.emp_number
INNER JOIN hs_hr_compstructtree c ON c.id = e.work_station
LEFT JOIN hs_hr_users u ON e.emp_number=u.emp_number;
  
END


-- -------------------- Payroll Report Procedure -------------------------------------------

INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Payslip Report', 'Payslip Report', 'Payslip Report', 'pay_slip.rptdesign', 'MOD019');


--
-- Procedure for report `Payslip Report`
--
DELIMITER $$

CREATE  PROCEDURE `sp_rpt_payroll_payslip`(param VARCHAR(255))
BEGIN
  SET @USER=param;
SELECT 
e.emp_number,
e.emp_display_name,
e.emp_display_name_si,
e.emp_display_name_ta,
e.emp_confirm_flg,
e.emp_active_hrm_flg,
e.emp_active_pr_flg,
j.jobtit_name,
j.jobtit_name_si, 
j.jobtit_name_ta,
p.pay_processed_date,
p.pay_gross_salary,
p.pay_cash_paid_amt,
p.pay_bank_paid_amt,
p.pay_cash_paid_amt,
p.pay_bank_paid_amt,
p.pay_netpay,
td.trn_dtl_payslipnarration,
td.trn_dtl_payslipnarration_si,
td.trn_dtl_payslipnarration_ta
FROM vw_hs_hr_employee e
LEFT JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
LEFT JOIN hs_pr_payprocess p ON p.emp_number = e.emp_number	
LEFT JOIN hs_pr_processedtxn pt ON pt.emp_number = e.emp_number	
LEFT JOIN hs_pr_transaction_details td ON td.trn_dtl_code = pt.trn_dtl_code	
LEFT JOIN hs_ln_schedule l ON l.emp_number = e.emp_number	
LEFT JOIN hs_hr_users u ON e.emp_number=u.emp_number
where e.emp_confirm_flg=1 and e.emp_active_hrm_flg=1 and e.emp_active_pr_flg=1;

END 




-- 2012-02-29 Report Menu Inser JBL
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
(37, 'Payroll - Employee Monthly Pay Report', 'Payroll - Employee Monthly Pay Report', 'Payroll - Employee Monthly Pay Report', 'EmployeeMonthlyPayReport.rptdesign', 'MOD019');

--
-- Procedure for report `Vacation_of_Post_Employee`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_dis_vac_post_emp`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;

SELECT i.* , ie.*, e.*, c.*,s.*, g.*, j.* 
FROM hs_hr_dis_incidents i
INNER JOIN hs_hr_dis_involved_emp ie ON ie.dis_inc_id = i.dis_inc_id 
INNER JOIN vw_hs_hr_employee e ON e.emp_number = ie.emp_number
INNER JOIN hs_hr_compstructtree c ON c.id = e.work_station
INNER JOIN hs_hr_service s ON s.service_code = e.service_code 
INNER JOIN hs_hr_grade g ON g.grade_code = e.grade_code
INNER JOIN hs_hr_job_title j ON j.jobtit_code = e.job_title_code
where i.dis_acttype_id = 1;
END


--
-- Procedure for report `Employee_Monthly_Pay_Report`
--
DELIMITER $$

CREATE  PROCEDURE `rpt_prl_emp_sal_slip`(param VARCHAR(255),param2 VARCHAR(255),param3 VARCHAR(255))
BEGIN
  SET @empNumber=param;
  SET @date=param2;
  SET @empID=param3;

SELECT ptxn.*, td.*,ttp.*, e.*,c.*
FROM hs_pr_processedtxn ptxn

INNER JOIN vw_hs_hr_employee e ON (select e1.emp_number from vw_hs_hr_employee e1 where e1.employee_id= @empID)= ptxn.emp_number
INNER JOIN hs_hr_compstructtree c ON c.id = e.work_station
INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code 


where ptxn.trn_startdate = @date;


END

DELIMITER $$
CREATE  PROCEDURE `rpt_prl_emp_sal_slip_basic_salary`(param VARCHAR(255),param2 VARCHAR(255),param3 VARCHAR(255))
BEGIN
  SET @empNumber=param;
  SET @date=param2;
  SET @empID=param3;


SELECT ptxn.*, td.*,ttp.*
FROM hs_pr_processedtxn ptxn

INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code 

where ptxn.emp_number = (select e1.emp_number from vw_hs_hr_employee e1 where e1.employee_id= @empID) and ptxn.trn_startdate= @date and ttp.erndedcon=1;

END

DELIMITER $$
CREATE  PROCEDURE `rpt_prl_emp_sal_slip_earnings`(param VARCHAR(255),param2 VARCHAR(255),param3 VARCHAR(255))
BEGIN
  SET @empNumber=param;
  SET @date=param2;
  SET @empID=param3;


SELECT ptxn.*, td.*,ttp.*
FROM hs_pr_processedtxn ptxn

INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code 

where ptxn.emp_number = (select e1.emp_number from vw_hs_hr_employee e1 where e1.employee_id= @empID) and ptxn.trn_startdate= @date and ttp.erndedcon=2;

END

DELIMITER $$
CREATE  PROCEDURE `rpt_prl_emp_sal_slip_contribution`(param VARCHAR(255),param2 VARCHAR(255),param3 VARCHAR(255))
BEGIN
  SET @empNumber=param;
  SET @date=param2;
  SET @empID=param3;

SELECT ptxn.*, td.*,ttp.*
FROM hs_pr_processedtxn ptxn

INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code 

where ptxn.emp_number = (select e1.emp_number from vw_hs_hr_employee e1 where e1.employee_id= @empID) and ptxn.trn_startdate= @date and ttp.erndedcon=0;

END

DELIMITER $$
CREATE  PROCEDURE `rpt_prl_emp_sal_slip_deduction`(param VARCHAR(255),param2 VARCHAR(255),param3 VARCHAR(255))
BEGIN
  SET @empNumber=param;
  SET @date=param2;
  SET @empID=param3;

SELECT ptxn.*, td.*,ttp.*
FROM hs_pr_processedtxn ptxn

INNER JOIN hs_pr_transaction_details td ON td.trn_dtl_code = ptxn.trn_dtl_code
INNER JOIN hs_pr_transaction_type ttp ON ttp.trn_typ_code = td.trn_typ_code 

where ptxn.emp_number = (select e1.emp_number from vw_hs_hr_employee e1 where e1.employee_id= @empID) and ptxn.trn_startdate= @date and ttp.erndedcon=-1;net

END

DELIMITER $$
CREATE  PROCEDURE `rpt_prl_emp_payprocess`(param VARCHAR(255),param2 VARCHAR(255),param3 VARCHAR(255))
BEGIN
  SET @empNumber=param;
  SET @date=param2;
  SET @empID=param3;


SELECT p.*
FROM hs_pr_payprocess p
where p.emp_number = (select e1.emp_number from vw_hs_hr_employee e1 where e1.employee_id= @empID) and p.pay_startdate= @date;

END




DELIMITER $$
CREATE  PROCEDURE `rpt_prl_net_sallary_report`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;

SELECT pp.pay_netpay,pp.pay_bf_amt,pp.pay_cash_paid_amt,pp.pay_bank_paid_amt,pt.prl_type_code,pt.prl_type_name,pt.	prl_type_name_si,pt.prl_type_name_ta	
FROM hs_pr_payprocess pp
INNER JOIN vw_hs_hr_employee pe ON pe.emp_number = pp.emp_number
INNER JOIN hs_pr_payroll_type pt ON pe.prl_type_code = pt.prl_type_code


END



DELIMITER $$
CREATE  PROCEDURE `rpt_emp_Report_to_option_report`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;

SELECT e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,
e1.emp_display_name,e1.emp_display_name_si,e1.emp_display_name_ta,er.erep_reporting_mode
FROM hs_hr_emp_reportto as er 
LEFT JOIN hs_hr_employee as e on er.erep_sup_emp_number = e.emp_number
LEFT JOIN hs_hr_compstructtree as c on c.comp_code = e.work_station
LEFT JOIN hs_hr_employee as e1 on er.erep_sub_emp_number = e1.emp_number;

END



DELIMITER $$
CREATE  PROCEDURE `rpt_emp_ldap_user_summary_report`(param VARCHAR(255))
BEGIN
SET @empNumber=param;
SELECT *
FROM `hs_hr_ldap_audit`;

END


DELIMITER $$
CREATE  PROCEDURE `rpt_transfer_employee_report`(param VARCHAR(255))
BEGIN
SET @empNumber=param;
SELECT t.*,e.emp_number,e.emp_display_name,e.emp_display_name_si,e.emp_display_name_ta,g.*,c.title,c.title_si,c.title_ta,cd.title,cd.title_si,cd.title_ta
FROM hs_hr_transfer as t 
LEFT JOIN hs_hr_employee as e on t.trans_emp_number = e.emp_number
LEFT JOIN hs_hr_grade_slot as g on e.slt_scale_year = g.slt_scale_year AND e.grade_code=g.grade_code
LEFT JOIN hs_hr_compstructtree as c on c.comp_code = t.trans_currentdiv_id
LEFT JOIN hs_hr_compstructtree as cd on cd.comp_code = t.trans_div_id;
END


INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'PIM - Report to Report', 'සේවක වාර්තාකරන වාර්තාව', NULL, 'Report_to_option.rptdesign', 'MOD002');
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'PIM - LDAP Log Report', 'සේවක LDAP Log වාර්තාව', NULL, 'Log_file_for_adminuser.rptdesign', 'MOD002');
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'PIM - Transfer Salary Report', 'සේවක මාරුවීම් වැටුප් වාර්තාව', NULL, 'Salary_particulars_of_transfer_employees.rptdesign', 'MOD002');
INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Total Employee Summary(Period)', 'සේවක තොරතුරු වාර්තාව ', 'சீவக தொரதுரு வார்தவா', 'SummaryEmployee_Total_Summary.rptdesign', 'MOD002');

INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
(null, 'Payroll - Monthly Coin Analysis Summary Report', 'පඩිපත - මුදල් විබෙදන වාර්තාව', 'Payroll - Monthly Coin Analysis Summary Report', 'Monthly_Coin_Analysis_Summary.rptdesign', 'MOD019');

INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
(null, 'Payroll - EPF Year first part', 'පඩිපත - මුදල් විබෙදන වාර්තාව', 'Payroll - EPF Year first part', 'EPF_six_month_part_ONE.rptdesign', 'MOD019');

INSERT INTO `hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES
(null, 'Payroll - Check Print', 'Payroll - Check Print', 'Payroll - Check Print_ta', 'checkprint.rptdesign', 'MOD019');